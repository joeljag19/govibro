<?php
namespace App\Modules\Commissions\Models;

use CodeIgniter\Model;

class SaleModel extends Model
{
    protected $table = 'sales';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'tour_id',
        'customer_id',
        'reseller_id',
        'seller_id',
        'sale_amount',
        'sale_date',
        'interaction_id',
        'total_commission',
        'reseller_share',
        'seller_commission',
        'reseller_net_commission',
        'platform_commission',
        'owner_earning',
    ];

/**
     * Registra una venta.
     * ... (método recordSale que ya tienes) ...
     */
    public function recordSale($data)
    {
        $this->insert($data);
        return $this->insertID();
    }

    /**
     * Obtiene un reporte de comisiones agrupado por revendedor.
     * Calcula las comisiones netas totales y el número de ventas.
     * Opcionalmente filtra por un rango de fechas.
     *
     * @param string|null $startDate Fecha de inicio (YYYY-MM-DD)
     * @param string|null $endDate Fecha de fin (YYYY-MM-DD)
     * @return array
  */
    public function getCommissionReports($startDate = null, $endDate = null)
    {
        $builder = $this->select('sales.reseller_id, users.name as reseller_name, SUM(sales.reseller_net_commission) as total_commissions, COUNT(sales.id) as sales_count')
                        // --- AJUSTE CLAVE ---
                        ->join('resellers', 'resellers.id = sales.reseller_id', 'left') 
                        ->join('users', 'users.id = resellers.user_id', 'left')
                        // --- FIN DEL AJUSTE ---
                        ->where('sales.reseller_id IS NOT NULL')
                        ->groupBy('sales.reseller_id, users.name');

        if ($startDate && $endDate) {
            $builder->where('sales.sale_date >=', $startDate . ' 00:00:00')
                    ->where('sales.sale_date <=', $endDate . ' 23:59:59');
        }

        return $builder->findAll();
    }

    /**
     * Obtiene las estadísticas de ganancias netas para un revendedor específico.
     * @param int $resellerId
     * @return array
     */
    public function getEarningsByResellerId($resellerId)
    {
        return $this->select('SUM(reseller_net_commission) as total_earnings, COUNT(id) as total_sales')
                    ->where('reseller_id', $resellerId)
                    ->first();
    }

    /**
     * Obtiene un resumen de las ganancias generadas por cada vendedor de un revendedor.
     * @param int $resellerId
     * @return array
     */
    public function getEarningsBySellersOfReseller($resellerId)
    {
        return $this->select('sellers.id as seller_id, users.name as seller_name, SUM(sales.seller_commission) as total_commission, COUNT(sales.id) as sales_count')
                    ->join('sellers', 'sellers.id = sales.seller_id')
                    ->join('users', 'users.id = sellers.user_id')
                    ->where('sales.reseller_id', $resellerId)
                    ->groupBy('sales.seller_id, users.name')
                    ->findAll();
    }

    /**
     * Obtiene las estadísticas de ganancias para un vendedor específico.
     * Calcula la suma total de sus comisiones y el número de ventas que ha generado.
     *
     * @param int $sellerId
     * @return array
     */
    public function getEarningsBySellerId($sellerId)
    {
        return $this->select('SUM(seller_commission) as total_earnings, COUNT(id) as total_sales')
                    ->where('seller_id', $sellerId)
                    ->first();
    }

    /**
     * Obtiene las estadísticas de ganancias para un dueño de servicio (owner).
     * La consulta ahora suma directamente la columna 'owner_earning'.
     *
     * @param int $ownerId
     * @return array
     */
    public function getEarningsByOwnerId($ownerId)
    {
        return $this->select('
                            SUM(sales.sale_amount) as gross_revenue,
                            SUM(sales.total_commission) as total_commissions_paid,
                            SUM(sales.owner_earning) as net_earnings,
                            COUNT(sales.id) as total_sales
                        ')
                        ->join('tours', 'tours.id = sales.tour_id')
                        ->where('tours.owner_id', $ownerId)
                        ->first();
    }

    /**
     * Obtiene un resumen del rendimiento de cada tour para un owner específico.
     * La consulta ahora suma directamente la columna 'owner_earning'.
     *
     * @param int $ownerId
     * @return array
     */
    public function getTourPerformanceByOwner($ownerId)
    {
         return $this->select('
                            tours.title,
                            COUNT(sales.id) as sales_count,
                            SUM(sales.sale_amount) as total_revenue,
                            SUM(sales.owner_earning) as net_earnings
                        ')
                    ->join('tours', 'tours.id = sales.tour_id')
                    ->where('tours.owner_id', $ownerId)
                    ->groupBy('tours.id, tours.title')
                    ->orderBy('net_earnings', 'DESC')
                    ->findAll();
    }

    /**
     * Obtiene un resumen financiero global de toda la plataforma.
     * Calcula los ingresos brutos, lo pagado a dueños y afiliados,
     * y la ganancia neta final de GoVibro.
     *
     * @return array
     */
    public function getPlatformOverallSummary()
    {
        return $this->select('
                            SUM(sale_amount) as gross_revenue,
                            SUM(owner_earning) as total_paid_to_owners,
                            SUM(reseller_share) as total_paid_to_affiliates,
                            SUM(platform_commission) as platform_net_profit,
                            COUNT(id) as total_sales
                        ')
                        ->first();
    }


// Dentro de la clase SaleModel

    /**
     * Obtiene todas las comisiones netas de un revendedor que aún no han sido pagadas,
     * usando la nueva columna 'reseller_payout_id'.
     *
     * @param int $resellerId
     * @param string|null $startDate
     * @param string|null $endDate
     * @return array
     */
    public function getUnpaidCommissionsForReseller($resellerId, $startDate = null, $endDate = null)
    {
        $builder = $this->select('id, sale_date, reseller_net_commission AS commission_amount')
                        ->where('reseller_id', $resellerId)
                        ->where('reseller_payout_id IS NULL') // <-- Columna actualizada
                        ->where('reseller_net_commission >', 0);

        if ($startDate && $endDate) {
            $builder->where('sale_date >=', $startDate . ' 00:00:00')
                    ->where('sale_date <=', $endDate . ' 23:59:59');
        }

        return $builder->findAll();
    }

    /**
     * Obtiene todas las comisiones de un vendedor que aún no han sido pagadas,
     * usando la nueva columna 'seller_payout_id'.
     *
     * @param int $sellerId
     * @param string|null $startDate
     * @param string|null $endDate
     * @return array
     */
    public function getUnpaidCommissionsForSeller($sellerId, $startDate = null, $endDate = null)
    {
        $builder = $this->select('id, sale_date, seller_commission AS commission_amount')
                        ->where('seller_id', $sellerId)
                        ->where('seller_payout_id IS NULL') // <-- Columna actualizada
                        ->where('seller_commission >', 0);

        if ($startDate && $endDate) {
            $builder->where('sale_date >=', $startDate . ' 00:00:00')
                    ->where('sale_date <=', $endDate . ' 23:59:59');
        }

        return $builder->findAll();
    }


    /**
     * Obtiene un historial de ventas detallado para un revendedor específico,
     * incluyendo las ventas de sus vendedores.
     *
     * @param int $resellerId
     * @return array
     */
    public function getDetailedSalesForReseller($resellerId)
    {
        return $this->select('
                        sales.*, 
                        tours.title as tour_title, 
                        seller_user.name as seller_name
                    ')
                    ->join('tours', 'tours.id = sales.tour_id', 'left')
                    ->join('users as seller_user', 'seller_user.id = sales.seller_id', 'left')
                    ->where('sales.reseller_id', $resellerId)
                    ->orderBy('sales.created_at', 'DESC')
                    ->paginate(20);
    }

      /**
     * Obtiene un historial de todas las ventas del sistema con todos los detalles
     * de los usuarios asociados para el reporte maestro del super_admin.
     *
     * @return array
     */
    public function getAllDetailedSales()
    {
        return $this->select('
                        sales.*, 
                        tours.title as tour_title, 
                        owner_user.name as owner_name,
                        reseller_user.name as reseller_name,
                        seller_user.name as seller_name
                    ')
                    ->join('tours', 'tours.id = sales.tour_id', 'left')
                    ->join('users as owner_user', 'owner_user.id = tours.owner_id', 'left')
                    ->join('resellers', 'resellers.id = sales.reseller_id', 'left')
                    ->join('users as reseller_user', 'reseller_user.id = resellers.user_id', 'left')
                    ->join('sellers', 'sellers.id = sales.seller_id', 'left')
                    ->join('users as seller_user', 'seller_user.id = sellers.user_id', 'left')
                    ->orderBy('sales.created_at', 'DESC')
                    ->paginate(20);
    }
















}