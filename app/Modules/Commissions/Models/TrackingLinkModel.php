<?php
namespace App\Modules\Commissions\Models;

use CodeIgniter\Model;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class TrackingLinkModel extends Model
{
    protected $table         = 'tracking_links';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'reseller_id',
        'seller_id',
        'unique_code',
        'name' // Campo para el nombre de la campaña
    ];

    // Usar 'true' para que CodeIgniter maneje created_at y updated_at automáticamente
    protected $useTimestamps = true;

    /**
     * Obtiene un enlace por su código único.
     *
     * @param string $uniqueCode
     * @return array|null
     */
    public function getByCode($uniqueCode)
    {
        return $this->where('unique_code', $uniqueCode)->first();
    }

    /**
     * Genera un enlace de seguimiento por defecto para un nuevo vendedor.
     * Este método se llama automáticamente cuando un vendedor se registra.
     *
     * @param int $resellerId
     * @param int $sellerId
     * @return bool
     */
    public function generateDefaultLink($resellerId, $sellerId)
    {
        $uniqueCode = bin2hex(random_bytes(16));
        $data = [
            'reseller_id' => $resellerId,
            'seller_id'   => $sellerId,
            'unique_code' => $uniqueCode,
            'name'        => 'Enlace Principal' // Nombre por defecto para el enlace del vendedor
        ];
        return $this->insert($data);
    }

    /**
     * Genera un nuevo enlace de campaña para un revendedor.
     *
     * @param int $resellerId El ID del revendedor que crea el enlace.
     * @param string $name El nombre descriptivo para la campaña (ej. "Campaña Facebook").
     * @return bool
     */
    public function createCampaignLink($resellerId, $name)
    {
        $uniqueCode = bin2hex(random_bytes(16));
        $data = [
            'reseller_id' => $resellerId,
            'seller_id'   => null, // Los enlaces de campaña son solo del revendedor
            'unique_code' => $uniqueCode,
            'name'        => $name
        ];
        return $this->insert($data);
    }

    /**
     * Obtiene todos los enlaces de los vendedores asociados a un revendedor,
     * incluyendo el nombre del vendedor y enriqueciendo cada enlace con QR y NFC.
     *
     * @param int $resellerId
     * @return array
     */
    public function getSellerLinksByReseller($resellerId)
    {
        $links = $this->select('tracking_links.*, users.name as seller_name')
                    ->join('sellers', 'sellers.id = tracking_links.seller_id')
                    ->join('users', 'users.id = sellers.user_id')
                    ->where('tracking_links.reseller_id', $resellerId)
                    ->where('tracking_links.seller_id IS NOT NULL')
                    ->findAll();

        // Enriquecer cada enlace con datos adicionales
        foreach ($links as &$link) {
            $fullUrl = base_url("commissions/track/{$link['unique_code']}");
            $link['full_url'] = $fullUrl;
            $link['nfc_data'] = "vnd.url:" . $fullUrl;

            try {
                $qrCode = QrCode::create($fullUrl)->setSize(300)->setMargin(10);
                $writer = new PngWriter();
                $qrImageString = $writer->write($qrCode)->getString();
                $link['qr_base64'] = base64_encode($qrImageString);
            } catch (\Exception $e) {
                log_message('error', 'Error al generar QR para el enlace ' . $link['id'] . ': ' . $e->getMessage());
                $link['qr_base64'] = null;
            }
        }
        
        return $links;
    }

    /**
     * Obtiene los enlaces de un revendedor (solo los suyos, sin los de sus vendedores)
     * y enriquece cada enlace con su URL completa, QR en base64 y datos NFC.
     *
     * @param int $resellerId
     * @return array
     */
    public function getResellerLinksWithDetails($resellerId)
    {
        $links = $this->where('reseller_id', $resellerId)
                      ->where('seller_id', null)
                      ->orderBy('created_at', 'DESC')
                      ->findAll();

        foreach ($links as &$link) {
            $fullUrl = base_url("commissions/track/{$link['unique_code']}");
            $link['full_url'] = $fullUrl;
            $link['nfc_data'] = "vnd.url:" . $fullUrl;

            try {
                $qrCode = QrCode::create($fullUrl)->setSize(300)->setMargin(10);
                $writer = new PngWriter();
                $qrImageString = $writer->write($qrCode)->getString();
                $link['qr_base64'] = base64_encode($qrImageString);
            } catch (\Exception $e) {
                log_message('error', 'Error al generar QR para el enlace ' . $link['id'] . ': ' . $e->getMessage());
                $link['qr_base64'] = null; // Asignar null si falla la generación
            }
        }
        
        return $links;
    }



    /**
     * Obtiene los enlaces de un vendedor y los enriquece con QR y NFC.
     * @param int $sellerId
     * @return array
     */
    public function getLinksBySellerId($sellerId)
    {
        $links = $this->where('seller_id', $sellerId)->findAll();

        foreach ($links as &$link) {
            $fullUrl = base_url("commissions/track/{$link['unique_code']}");
            $link['full_url'] = $fullUrl;
            $link['nfc_data'] = "vnd.url:" . $fullUrl;

            try {
                $qrCode = QrCode::create($fullUrl)->setSize(300)->setMargin(10);
                $writer = new PngWriter();
                $qrImageString = $writer->write($qrCode)->getString();
                $link['qr_base64'] = base64_encode($qrImageString);
            } catch (\Exception $e) {
                log_message('error', 'Error al generar QR para el enlace ' . $link['id'] . ': ' . $e->getMessage());
                $link['qr_base64'] = null;
            }
        }
        
        return $links;
    }





    
}