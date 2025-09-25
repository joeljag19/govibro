<?php
namespace App\Modules\Commissions\Controllers;

use CodeIgniter\Controller;
use App\Modules\Commissions\Models\TrackingLinkModel;
use App\Modules\Commissions\Models\ResellerModel;
use App\Modules\Commissions\Models\SellerModel;
use App\Modules\Commissions\Models\AuditLogModel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class TestController extends Controller
{
    protected $trackingLinkModel;
    protected $resellerModel;
    protected $sellerModel;
    protected $auditLogModel;

    public function __construct()
    {
        $this->trackingLinkModel = new TrackingLinkModel();
        $this->resellerModel = new ResellerModel();
        $this->sellerModel = new SellerModel();
        $this->auditLogModel = new AuditLogModel();
    }

    /**
     * Genera tracking links retroactivos para vendedores existentes.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function generateLinksRetro()
    {
        $user = session('user');
        if (!$user || !in_array($user['role'], ['super_admin', 'reseller']) || $user['id'] != 4) {
            log_message('error', 'Acceso denegado a generate-links-retro: role=' . ($user['role'] ?? 'null') . ', user_id=' . ($user['id'] ?? 'null'));
            return $this->response->setJSON(['success' => false, 'message' => 'No permisos.']);
        }

        $reseller = $this->resellerModel->getByUserId($user['id']);
        if (!$reseller) {
            log_message('error', 'No reseller registrado para user_id=' . $user['id']);
            return $this->response->setJSON(['success' => false, 'message' => 'No reseller registrado.']);
        }

        $results = [];
        $sellerIds = [1, 2]; // Vendedores existentes

        foreach ($sellerIds as $sellerId) {
            try {
                // Validar seller
                $seller = $this->sellerModel->find($sellerId);
                if (!$seller || $seller['reseller_id'] != $reseller['id']) {
                    $results[] = [
                        'seller_id' => $sellerId,
                        'success' => false,
                        'message' => 'Vendedor no válido o no asociado al revendedor.'
                    ];
                    continue;
                }

                // Generar link
                $uniqueCode = $this->trackingLinkModel->generateLink($reseller['id'], $sellerId);
                $link = base_url("commissions/track/{$uniqueCode}");

                // Generar QR
                $qrCode = QrCode::create($link)->setSize(300)->setMargin(10);
                $writer = new PngWriter();
                $qrImage = base64_encode($writer->write($qrCode)->getString());
                $nfcData = "vnd.url:$link";

                // Registrar en audit_logs
                $this->auditLogModel->log(
                    $user['id'],
                    'Generó enlace retroactivo para vendedor',
                    'tracking_link',
                    $this->trackingLinkModel->insertID(),
                    ['unique_code' => $uniqueCode, 'reseller_id' => $reseller['id'], 'seller_id' => $sellerId]
                );

                $results[] = [
                    'seller_id' => $sellerId,
                    'success' => true,
                    'message' => 'Link generado: ' . $link,
                    'link' => $link,
                    'qr_base64' => $qrImage,
                    'nfc_data' => $nfcData
                ];
            } catch (\Exception $e) {
                log_message('error', 'Error al generar link para seller_id=' . $sellerId . ': ' . $e->getMessage());
                $results[] = [
                    'seller_id' => $sellerId,
                    'success' => false,
                    'message' => 'Error: ' . $e->getMessage()
                ];
            }
        }

        return $this->response->setJSON(['success' => true, 'results' => $results]);
    }



      /**
     * Simula una venta para probar el cálculo de comisiones.
     * Esta ruta es solo para fines de desarrollo.
     */
    public function simulateSale()
    {
        // 1. Instanciamos el controlador de ventas que queremos probar.
        $saleController = new SaleController();
        
        // 2. Simulamos los datos que llegarían de un formulario de compra.
        //    - customer_id: El ID del usuario que está comprando.
        //    - tour_id: El ID del tour que se está vendiendo.
        //    - sale_amount: El precio final de la venta.
        $postData = [
            'customer_id' => 7,  // Simula que el cliente con ID 7 está comprando.
            'tour_id'     => 4,  // Simula la venta del tour "Salto Alto".
            'sale_amount' => 3000.00
        ];

        // 3. Falsificamos la solicitud para que sea de tipo POST con los datos de arriba.
        //    Esto permite que el método processSale() funcione como si viniera de un formulario real.
        service('request')->setMethod('post')->setGlobal('post', $postData);

        echo "<h1>Simulando Venta...</h1>";
        echo "<pre>Datos de la venta simulada:\n" . print_r($postData, true) . "</pre>";
        echo "<hr>";
        echo "<h2>Respuesta del Controlador:</h2>";
        
        // 4. Ejecutamos el método y devolvemos la respuesta JSON para ver el resultado.
        return $saleController->processSale();
    }

     /**
     * AÑADE ESTE NUEVO MÉTODO
     * Simula una venta para un CLIENTE INVITADO (no registrado).
     */
    public function simulateGuestSale()
    {
        $saleController = new SaleController();
        
        // Datos que un invitado proporcionaría en el checkout
        $postData = [
            'customer_id'    => null, // El ID de cliente es nulo
            'customer_email' => 'invitado_'.time().'@test.com', // Un email de prueba
            'tour_id'        => 6,
            'sale_amount'    => 10000.00
        ];

        service('request')->setMethod('post')->setGlobal('post', $postData);

        echo "<h1>Simulando Venta (INVITADO)...</h1>";
        echo "<pre>Datos de la venta simulada:\n" . print_r($postData, true) . "</pre><hr>";
        echo "<h2>Respuesta del Controlador:</h2>";
        
        return $saleController->processSale();
    }
}