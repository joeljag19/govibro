<?php
namespace App\Modules\Commissions\Controllers;

use CodeIgniter\Controller;
use App\Modules\Commissions\Models\TrackingLinkModel;
use App\Modules\Commissions\Models\CustomerResellerInteractionModel;
use App\Modules\Commissions\Models\AuditLogModel;
use App\Modules\Commissions\Models\SellerModel;
use App\Modules\Commissions\Models\ResellerModel;
use App\Modules\Commissions\Models\LinkClickModel;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class TrackingController extends Controller
{
    protected $trackingLinkModel;
    protected $interactionModel;
    protected $auditLogModel;
    protected $sellerModel;
    protected $resellerModel;
    protected $request;
    protected $response;

    public function __construct()
    {
        $this->trackingLinkModel = new TrackingLinkModel();
        $this->interactionModel = new CustomerResellerInteractionModel();
        $this->auditLogModel = new AuditLogModel();
        $this->sellerModel = new SellerModel();
        $this->resellerModel = new ResellerModel();
        $this->request = \Config\Services::request();
        $this->response = \Config\Services::response();
    }

    /**
     * Genera un enlace único para un revendedor o vendedor.
     *
     * @param int $resellerId
     * @param int|null $sellerId
     * @return \CodeIgniter\HTTP\Response
     */
    public function generateLink($resellerId, $sellerId = null)
    {
        $user = session('user');
        log_message('debug', 'Generate link for resellerId: ' . $resellerId . ', sellerId: ' . ($sellerId ?? 'null'));
        if (!$user || !in_array($user['role'], ['super_admin', 'reseller'])) {
            log_message('error', 'Acceso denegado a generate-link: role=' . ($user['role'] ?? 'null'));
            return $this->response->setJSON(['success' => false, 'message' => 'No permisos.']);
        }

        // Validar reseller por user_id
        $reseller = $this->resellerModel->getByUserId($resellerId);
        if (!$reseller) {
            log_message('error', 'Revendedor no encontrado para user_id=' . $resellerId);
            return $this->response->setJSON(['success' => false, 'message' => 'Revendedor no encontrado.']);
        }

        // Validar seller si proporcionado
        if ($sellerId) {
            $seller = $this->sellerModel->find($sellerId);
            if (!$seller || $seller['reseller_id'] != $reseller['id']) {
                log_message('error', 'Vendedor no válido o no asociado al revendedor: seller_id=' . $sellerId);
                return $this->response->setJSON(['success' => false, 'message' => 'Vendedor no válido.']);
            }
        }

        try {
            $uniqueCode = $this->trackingLinkModel->generateLink($reseller['id'], $sellerId); // Usa $reseller['id']
            $link = base_url("commissions/track/{$uniqueCode}");

            // Generar QR
            $qrCode = QrCode::create($link)->setSize(300)->setMargin(10);
            $writer = new PngWriter();
            $qrImage = base64_encode($writer->write($qrCode)->getString());
            $nfcData = "vnd.url:$link";

            $this->auditLogModel->log(
                $user['id'] ?? null,
                'Generó enlace de seguimiento',
                'tracking_link',
                $this->trackingLinkModel->insertID(),
                ['unique_code' => $uniqueCode, 'reseller_id' => $reseller['id'], 'seller_id' => $sellerId]
            );

            return $this->response->setJSON([
                'success' => true,
                'link' => $link,
                'qr_base64' => $qrImage,
                'nfc_data' => $nfcData
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Error al generar enlace: ' . $e->getMessage());
            return $this->response->setJSON(['success' => false, 'message' => 'Error al generar enlace: ' . $e->getMessage()]);
        }
    }

    /**
     * Rastrear una interacción cuando un cliente accede a un enlace.
     *
     * @param string $uniqueCode
     * @return \CodeIgniter\HTTP\RedirectResponse
     */

 public function track($uniqueCode)
    {
        $link = $this->trackingLinkModel->getByCode($uniqueCode);
        if (!$link) {
            log_message('error', "Enlace de seguimiento no válido: {$uniqueCode}");
            return redirect()->to(base_url())->with('error', 'Enlace no válido.');
        }

        // --- LÓGICA PARA REGISTRAR EL CLIC ---
        $clickModel = new LinkClickModel();
        $clickData = [
            'tracking_link_id' => $link['id'],
            'reseller_id'      => $link['reseller_id'],
            'seller_id'        => $link['seller_id'],
            'user_id'          => session('user')['id'] ?? null,
            'ip_address'       => $this->request->getIPAddress(),
            'user_agent'       => (string) $this->request->getUserAgent(),
            'created_at'       => date('Y-m-d H:i:s')
        ];
        $clickModel->insert($clickData);
        
        // Opciones de la cookie
        $cookieOptions = [
            'expire'   => 31536000, // 1 año
            'path'     => '/',
            'secure'   => (ENVIRONMENT === 'production'),
            'httponly' => true,
            'samesite' => 'Lax'
        ];

        // Preparar las cookies
        $refCodeCookie = array_merge($cookieOptions, [
            'name'  => 'ref_code',
            'value' => $uniqueCode,
        ]);
        $refDateCookie = array_merge($cookieOptions, [
            'name'  => 'ref_date',
            'value' => date('Y-m-d H:i:s'),
        ]);

        // Registrar interacción si hay un usuario autenticado
        if (session('user')) {
            $interactionData = [
                'customer_id'      => session('user')['id'],
                'reseller_id'      => $link['reseller_id'],
                'seller_id'        => $link['seller_id'],
                'unique_code'      => $uniqueCode,
                'interaction_date' => date('Y-m-d H:i:s')
            ];
            $this->interactionModel->insert($interactionData);
        }

        // Redirigir y adjuntar las cookies en la misma acción
        return redirect()->to(base_url())
                         ->setCookie($refCodeCookie)
                         ->setCookie($refDateCookie);
    }
    /**
     * Elimina un enlace de seguimiento.
     *
     * @param int $id
     * @return \CodeIgniter\HTTP\Response
     */
    public function deleteLink($id)
    {
        $user = session('user');
        if (!$user || !in_array($user['role'], ['super_admin', 'reseller'])) {
            log_message('error', 'Acceso denegado a delete-link: role=' . ($user['role'] ?? 'null'));
            return $this->response->setJSON(['success' => false, 'message' => 'No permisos.']);
        }

        $link = $this->trackingLinkModel->find($id);
        if (!$link || $link['reseller_id'] != $user['id']) {
            log_message('error', 'Enlace no encontrado o no autorizado: id=' . $id);
            return $this->response->setJSON(['success' => false, 'message' => 'Enlace no encontrado o no autorizado.']);
        }

        try {
            $this->trackingLinkModel->delete($id);
            $this->auditLogModel->log(
                $user['id'],
                'Eliminó enlace de seguimiento',
                'tracking_link',
                $id,
                ['id' => $id]
            );
            return $this->response->setJSON(['success' => true, 'message' => 'Enlace eliminado.']);
        } catch (\Exception $e) {
            log_message('error', 'Error al eliminar enlace: ' . $e->getMessage());
            return $this->response->setJSON(['success' => false, 'message' => 'Error al eliminar enlace: ' . $e->getMessage()]);
        }
    }
}