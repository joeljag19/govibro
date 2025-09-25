<?php
namespace App\Modules\Commissions\Controllers;

use CodeIgniter\Controller;
use App\Modules\Commissions\Models\AuditLogModel;
use App\Modules\Commissions\Models\CommissionProfileModel;
use App\Modules\Commissions\Models\CommissionRangeModel;
use App\Modules\Commissions\Models\ResellerModel;
use App\Modules\Commissions\Models\SellerModel;
use App\Modules\Commissions\Models\SellerInvitationModel;
use App\Modules\Commissions\Models\SaleModel; 
use App\Modules\Auth\Models\UserAuthModel;

class AdminCommissionController extends Controller
{
    protected $commissionProfileModel;
    protected $resellerModel;
    protected $sellerModel;
    protected $invitationModel;
    protected $auditLogModel;
    protected $userModel;

    public function __construct()
    {
        $this->commissionProfileModel = new CommissionProfileModel();
        $this->resellerModel = new ResellerModel();
        $this->sellerModel = new SellerModel();
        $this->invitationModel = new SellerInvitationModel();
        $this->auditLogModel = new AuditLogModel();
        $this->userModel = new UserAuthModel();
    }

    //====================================================================
    // GESTIÓN DE CANDIDATOS
    //====================================================================


    public function showCandidates()
    {
        $user = session('user');
        if (!$user || $user['role'] !== 'super_admin') {
            return redirect()->to('/')->with('error', 'No tienes permisos.');
        }

        // Obtenemos los 3 tipos de candidatos
        $resellerCandidates = $this->userModel->getCandidatesByRole('reseller_candidate');
        $sellerCandidates = $this->userModel->getCandidatesByRole('seller_candidate');
        $ownerCandidates = $this->userModel->getCandidatesByRole('owner_candidate'); // <-- LÍNEA AÑADIDA

        $profiles = $this->commissionProfileModel->findAll();
        $resellers = $this->resellerModel->findAll();

        return view('App\Modules\Commissions\Views\admin\candidates', [
            'resellerCandidates' => $resellerCandidates,
            'sellerCandidates'   => $sellerCandidates,
            'ownerCandidates'    => $ownerCandidates, // <-- Pasar los nuevos datos a la vista
            'profiles'           => $profiles,
            'resellers'          => $resellers
        ]);
    }
    /**
     * Aprueba a un candidato como revendedor o vendedor.
     */
    public function approveCandidate($userId, $type)
    {
        $user = session('user');
        if (!$user || $user['role'] !== 'super_admin') {
            return redirect()->to('/')->with('error', 'No tienes permisos.');
        }

        $candidate = $this->userModel->find($userId);
        if (!$candidate) {
            return redirect()->back()->with('error', 'Candidato no encontrado.');
        }

        if ($type === 'reseller' && $candidate['role'] === 'reseller_candidate') {
            $resellerData = [
                'user_id'                 => $userId,
                'first_name'              => $this->request->getPost('first_name'),
                'last_name'               => $this->request->getPost('last_name'),
                'address'                 => $this->request->getPost('address'),
                'phone'                   => $this->request->getPost('phone'),
                'identity_document'       => $this->request->getPost('identity_document'),
                'max_sellers'             => $this->request->getPost('max_sellers') ?: 10,
                'commission_profile_id'   => $this->request->getPost('commission_profile_id')
            ];

            if(empty($resellerData['commission_profile_id'])){
                 return redirect()->back()->with('error', 'Debe seleccionar un perfil de comisión.');
            }

            $this->userModel->updateRole($userId, 'reseller');
            $this->resellerModel->insert($resellerData);
            $this->auditLogModel->log($user['id'], 'Aprobó reseller', 'reseller', $this->resellerModel->insertID(), $resellerData);

        } elseif ($type === 'seller' && $candidate['role'] === 'seller_candidate') {
            // La lógica para aprobar vendedores se mantiene igual
            $resellerId = $this->request->getPost('reseller_id');
            $commissionPercentage = $this->request->getPost('commission_percentage');

            if (!$resellerId || !$commissionPercentage) {
                return redirect()->back()->with('error', 'Datos incompletos.');
            }
            
            $reseller = $this->resellerModel->find($resellerId);
            if (!$reseller || !$this->resellerModel->canCreateSeller($resellerId)) {
                return redirect()->back()->with('error', 'Revendedor inválido o límite alcanzado.');
            }

            $this->userModel->updateRole($userId, 'seller');
            $sellerData = [
                'user_id'                 => $userId,
                'reseller_id'             => $resellerId,
                'commission_percentage'   => $commissionPercentage,
                'first_name'              => $this->request->getPost('first_name'),
                'last_name'               => $this->request->getPost('last_name'),
                'address'                 => $this->request->getPost('address'),
                'phone'                   => $this->request->getPost('phone'),
                'identity_document'       => $this->request->getPost('identity_document'),
            ];
            $this->sellerModel->insert($sellerData);
            $this->auditLogModel->log($user['id'], 'Aprobó seller', 'seller', $this->sellerModel->insertID(), $sellerData);
        } else {
            return redirect()->back()->with('error', 'Tipo de candidato inválido.');
        }

        return redirect()->back()->with('success', 'Candidato aprobado exitosamente.');
    }

    /**
     * Rechaza a un candidato.
     */
    public function rejectCandidate($userId)
    {
        $user = session('user');
        if (!$user || $user['role'] !== 'super_admin') {
            return redirect()->to('/')->with('error', 'No tienes permisos.');
        }

        $candidate = $this->userModel->find($userId);
        if (!$candidate || !in_array($candidate['role'], ['reseller_candidate', 'seller_candidate'])) {
            return redirect()->back()->with('error', 'Candidato no encontrado o no válido.');
        }

        $this->userModel->updateRole($userId, 'customer');
        $this->auditLogModel->log(
            $user['id'],
            'Rechazó candidato',
            'user',
            $userId,
            ['email' => $candidate['email'], 'previous_role' => $candidate['role']]
        );

        return redirect()->back()->with('success', 'Candidato rechazado.');
    }

    //====================================================================
    // GESTIÓN DIRECTA DE RESELLERS Y SELLERS
    //====================================================================
    
    // En AdminCommissionController.php

    /**
     * Muestra el formulario para crear un revendedor manualmente desde cero.
     */
    public function showCreateReseller()
    {
        $user = session('user');
        if (!$user || $user['role'] !== 'super_admin') {
            return redirect()->to('/')->with('error', 'No tienes permisos.');
        }

        // Ya no necesitamos la lista de usuarios. Solo los perfiles de comisión.
        $profiles = $this->commissionProfileModel->findAll();

        return view('App\Modules\Commissions\Views\admin\create_reseller', ['profiles' => $profiles]);
    }

    /**
     * Procesa la creación manual de un nuevo revendedor (usuario + perfil de reseller).
     */
    public function createReseller()
    {
        $user = session('user');
        if (!$user || $user['role'] !== 'super_admin') {
            return redirect()->to('/')->with('error', 'No tienes permisos.');
        }

        // 1. Validar contraseñas
        $password = $this->request->getPost('password');
        if ($password !== $this->request->getPost('password_confirm')) {
            return redirect()->back()->withInput()->with('error', 'Las contraseñas no coinciden.');
        }

        // 2. Validar que el email no exista
        $email = $this->request->getPost('email');
        if ($this->userModel->getByEmail($email)) {
            return redirect()->back()->withInput()->with('error', 'El correo electrónico ya está en uso.');
        }

        // 3. Iniciar transacción
        $db = \Config\Database::connect();
        $db->transBegin();

        try {
            // 4. Crear el registro en la tabla 'users'
            $userData = [
                'name'     => $this->request->getPost('first_name') . ' ' . $this->request->getPost('last_name'),
                'email'    => $email,
                'password' => $password,
                'role'     => 'reseller', // Se crea directamente con el rol
            ];
            $userId = $this->userModel->register($userData);

            // 5. Crear el registro en la tabla 'resellers'
            $resellerData = [
                'user_id'                 => $userId,
                'first_name'              => $this->request->getPost('first_name'),
                'last_name'               => $this->request->getPost('last_name'),
                'commission_profile_id'   => $this->request->getPost('commission_profile_id'),
                'max_sellers'             => $this->request->getPost('max_sellers') ?: 10,
            ];
            $this->resellerModel->insert($resellerData);

            $db->transCommit();
            $this->auditLogModel->log($user['id'], 'Creó revendedor manualmente', 'reseller', $this->resellerModel->insertID(), $resellerData);
            return redirect()->to('/commissions/admin/candidates')->with('success', 'Revendedor creado exitosamente.');

        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'Error al crear reseller manualmente: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Error al crear el revendedor.');
        }
    }


    /**
     * Muestra el formulario para crear un vendedor manualmente desde cero.
     */
    public function showCreateSeller()
    {
        $user = session('user');
        if (!$user || $user['role'] !== 'super_admin') {
            return redirect()->to('/')->with('error', 'No tienes permisos.');
        }

        // Ya no necesitamos la lista de usuarios, solo la de revendedores.
        $resellers = $this->resellerModel->getResellersWithDetails(); // Usamos el método que ya trae el nombre

        return view('App\Modules\Commissions\Views\admin\create_seller', ['resellers' => $resellers]);
    }

    /**
     * Procesa la creación manual de un nuevo vendedor.
     */
    public function createSeller()
    {
        $user = session('user');
        if (!$user || $user['role'] !== 'super_admin') {
            return redirect()->to('/')->with('error', 'No tienes permisos.');
        }

        // 1. Validar contraseñas
        $password = $this->request->getPost('password');
        if ($password !== $this->request->getPost('password_confirm')) {
            return redirect()->back()->withInput()->with('error', 'Las contraseñas no coinciden.');
        }

        // 2. Validar que el email no exista
        $email = $this->request->getPost('email');
        if ($this->userModel->getByEmail($email)) {
            return redirect()->back()->withInput()->with('error', 'El correo electrónico ya está en uso.');
        }

        // 3. Iniciar transacción
        $db = \Config\Database::connect();
        $db->transBegin();

        try {
            // 4. Crear el registro en la tabla 'users'
            $firstName = $this->request->getPost('first_name');
            $lastName = $this->request->getPost('last_name');
            $userId = $this->userModel->register([
                'name'     => $firstName . ' ' . $lastName,
                'email'    => $email,
                'password' => $password,
                'role'     => 'seller',
            ]);

            // 5. Crear el registro en la tabla 'sellers'
            $sellerData = [
                'user_id'                 => $userId,
                'reseller_id'             => $this->request->getPost('reseller_id'),
                'commission_percentage'   => $this->request->getPost('commission_percentage'),
                'first_name'              => $firstName,
                'last_name'               => $lastName,
            ];
            $sellerId = $this->sellerModel->insert($sellerData);

            // 6. Generar el enlace de seguimiento por defecto
            $trackingLinkModel = new \App\Modules\Commissions\Models\TrackingLinkModel();
            $trackingLinkModel->generateDefaultLink($sellerData['reseller_id'], $sellerId);

            $db->transCommit();
            $this->auditLogModel->log($user['id'], 'Creó vendedor manualmente', 'seller', $sellerId, $sellerData);
            return redirect()->to('/commissions/admin/candidates')->with('success', 'Vendedor creado exitosamente.');

        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'Error al crear vendedor manualmente: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Error al crear el vendedor.');
        }
    }

    //====================================================================
    // GESTIÓN DE PERFILES DE COMISIÓN (CRUD)
    //====================================================================

  /**
     * Muestra la lista de perfiles de comisiones con sus rangos.
     */
    public function showProfiles()
    {
        $user = session('user');
        if (!$user || $user['role'] !== 'super_admin') {
            log_message('error', 'Acceso denegado a show-profiles: role=' . ($user['role'] ?? 'null'));
            return redirect()->to('/')->with('error', 'No tienes permisos.');
        }

        $profiles = $this->commissionProfileModel->getProfilesWithRanges();
        
        return view('App\Modules\Commissions\Views\admin\profiles', ['profiles' => $profiles]);
 
    }

    /**
     * Muestra el formulario para crear un perfil de comisiones.
     */
    public function showCreateProfile()
    {
        $user = session('user');
        if (!$user || $user['role'] !== 'super_admin') {
            log_message('error', 'Acceso denegado a show-create-profile: role=' . ($user['role'] ?? 'null'));
            return redirect()->to('/')->with('error', 'No permisos.');
        }

        return view('App\Modules\Commissions\Views\admin\create_profile');
    }

    /**
     * Crea un nuevo perfil de comisiones y sus rangos.
     */
    public function createProfile()
    {
        $user = session('user');
        if (!$user || $user['role'] !== 'super_admin') {
            return redirect()->to('/')->with('error', 'No tienes permisos.');
        }

        $db = \Config\Database::connect();
        $db->transBegin();

        try {
            $profileData = [
                'name'        => $this->request->getPost('name'),
                'description' => $this->request->getPost('description'),
                'type'        => 'percentage' // Tipo fijo, ya que la lógica depende de los rangos
            ];
            $this->commissionProfileModel->insert($profileData);
            $profileId = $this->commissionProfileModel->getInsertID();

            $ranges = $this->request->getPost('ranges');
            if (!empty($ranges)) {
                $rangeModel = new CommissionRangeModel();
                $sequence = 1;
                foreach ($ranges as $range) {
                    $rangeModel->insert([
                        'profile_id'     => $profileId,
                        'start_day'      => $range['start_day'],
                        'end_day'        => empty($range['end_day']) ? null : $range['end_day'],
                        'reseller_share' => $range['reseller_share'],
                        'sequence'       => $sequence++
                    ]);
                }
            }

            $db->transCommit();
            $this->auditLogModel->log($user['id'], 'Creó perfil de comisiones', 'commission_profile', $profileId, $profileData);
            return redirect()->to('/commissions/admin/profiles')->with('success', 'Perfil creado exitosamente.');

        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'Error al crear perfil: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al crear el perfil.');
        }
    }

    /**
     * Muestra el formulario para editar un perfil de comisiones.
     */
    public function showEditProfile($id)
    {
        $user = session('user');
        if (!$user || $user['role'] !== 'super_admin') {
            log_message('error', 'Acceso denegado a show-edit-profile: roleshowCandidates=' . ($user['role'] ?? 'null'));
            return redirect()->to('/')->with('error', 'No tienes permisos.');
        }

        $profile = $this->commissionProfileModel->find($id);
        if (!$profile) {
            log_message('error', 'Perfil no encontrado: id=' . $id);
            return redirect()->back()->with('error', 'Perfil no encontrado.');
        }
        
        // --- NUEVO: Cargar los rangos de comisiones ---
        $rangeModel = new CommissionRangeModel();
        $ranges = $rangeModel->where('profile_id', $id)->orderBy('sequence', 'ASC')->findAll();

        $data = [
            'profile' => $profile,
            'ranges' => $ranges // Pasar los rangos a la vista
        ];

        return view('App\Modules\Commissions\Views\admin\edit_profile', $data);
    }


    /**
     * Actualiza un perfil de comisiones y sus rangos.
     */
    public function updateProfile($id)
    {
        $user = session('user');
        if (!$user || $user['role'] !== 'super_admin') {
            log_message('error', 'Acceso denegado a update-profile: role=' . ($user['role'] ?? 'null'));
            return redirect()->to('/')->with('error', 'No permisos.');
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'type' => $this->request->getPost('type'),
            'fixed_amount' => $this->request->getPost('fixed_amount'),
            'total_commission_percentage' => $this->request->getPost('total_commission_percentage'),
            'period1_days' => $this->request->getPost('period1_days'),
            'period1_reseller_share' => $this->request->getPost('period1_reseller_share'),
            'period2_days' => $this->request->getPost('period2_days'),
            'period2_reseller_share' => $this->request->getPost('period2_reseller_share'),
            'period3_days' => $this->request->getPost('period3_days'),
            'period3_reseller_share' => $this->request->getPost('period3_reseller_share'),
            'max_period_days' => $this->request->getPost('max_period_days'),
            'description' => $this->request->getPost('description')
        ];

        if (empty($data['name']) || empty($data['type'])) {
            log_message('error', 'Datos incompletos en update-profile: ' . json_encode($data));
            return redirect()->back()->with('error', 'Datos incompletos.');
        }

        try {
            $this->commissionProfileModel->update($id, $data);
            $this->auditLogModel->log($user['id'], 'Actualizó perfil de comisiones', 'commission_profile', $id, $data);
            return redirect()->to('/commissions/admin/profiles')->with('success', 'Perfil actualizado.');
        } catch (\Exception $e) {
            log_message('error', 'Error al actualizar perfil: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al actualizar perfil: ' . $e->getMessage());
        }
    }

    //====================================================================
    // ASIGNACIÓN DE PERFILES Y REPORTES
    //====================================================================

    /**
     * Muestra la lista de resellers para asignar perfiles.
     */

    /**
     * Asigna un perfil a un reseller.
     */
    public function showAssignProfiles()
    {
        $user = session('user');
        if (!$user || $user['role'] !== 'super_admin') {
            log_message('error', 'Acceso denegado a show-assign-profiles: role=' . ($user['role'] ?? 'null'));
            return redirect()->to('/')->with('error', 'No permisos.');
        }

        $resellers = $this->resellerModel->getResellersWithDetails();
        $profiles = $this->commissionProfileModel->findAll();

        return view('App\Modules\Commissions\Views\admin\assign_profiles', [
            'resellers' => $resellers, 
            'profiles' => $profiles
        ]);

    }


    /**
     * Muestra los reportes de comisiones.
     */
    public function showReports()
    {
        $user = session('user');
        if (!$user || $user['role'] !== 'super_admin') {
            log_message('error', 'Acceso denegado a show-reports: role=' . ($user['role'] ?? 'null'));
            return redirect()->to('/')->with('error', 'No permisos.');
        }

        return view('App\Modules\Commissions\Views\admin\reports');
    }

 /**
     * Obtiene los reportes de comisiones para una solicitud AJAX.
     * La lógica de la consulta está encapsulada en el SaleModel.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function getReports()
    {
        $user = session('user');
        if (!$user || $user['role'] !== 'super_admin') {
            log_message('error', 'Acceso denegado a get-reports: role=' . ($user['role'] ?? 'null'));
            return $this->response->setJSON(['success' => false, 'message' => 'No tienes permisos.']);
        }

        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        $saleModel = new SaleModel();
        $reports = $saleModel->getCommissionReports($startDate, $endDate);

        return $this->response->setJSON(['success' => true, 'reports' => $reports]);
    }


        /**
     * Muestra el reporte de ventas maestro para el super_admin.
     */
    public function salesReport()
    {
        $saleModel = new \App\Modules\Commissions\Models\SaleModel();
        $data['sales'] = $saleModel->getAllDetailedSales();
        $data['pager'] = $saleModel->pager;

        return view('App\Modules\Commissions\Views\admin\sales_report', $data);
    }
}













