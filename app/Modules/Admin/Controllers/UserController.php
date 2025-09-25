<?php
namespace App\Modules\Admin\Controllers; // <-- NAMESPACE CORREGIDO

use CodeIgniter\Controller;
use App\Modules\Auth\Models\UserAuthModel;
use App\Modules\Commissions\Models\AuditLogModel;
use App\Modules\OwnerPanel\Models\OwnerModel;

class UserController extends Controller
{
    protected $userModel;
    protected $auditLogModel;

    public function __construct()
    {
        $this->userModel = new UserAuthModel();
        $this->auditLogModel = new AuditLogModel();
    }

    public function index()
    {
        $data['users'] = $this->userModel->orderBy('id', 'DESC')->paginate(20);
        $data['pager'] = $this->userModel->pager;
        return view('App\Modules\Admin\Views\users\index', $data);
    }

    public function showCreateUser()
    {
        return view('App\Modules\Admin\Views\users\create');
    }

    public function createUser()
    {
        $sessionUser = session('user');

        $password = $this->request->getPost('password');
        if ($password !== $this->request->getPost('password_confirm')) {
            return redirect()->back()->withInput()->with('error', 'Las contraseñas no coinciden.');
        }

        if ($this->userModel->getByEmail($this->request->getPost('email'))) {
            return redirect()->back()->withInput()->with('error', 'El correo electrónico ya está en uso.');
        }

        $data = [
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'password' => $password,
            'role'     => $this->request->getPost('role'),
        ];

        $userId = $this->userModel->register($data);

        if ($userId) {
            $this->auditLogModel->log($sessionUser['id'], 'Creó usuario manualmente', 'user', $userId, $data);
            return redirect()->to('/admin/users')->with('success', 'Usuario creado exitosamente.');
        } else {
            return redirect()->back()->withInput()->with('error', 'No se pudo crear el usuario.');
        }
    }

    public function approveOwner($userId)
    {
        $sessionUser = session('user');
        if (!$sessionUser || $sessionUser['role'] !== 'super_admin') {
            return redirect()->to('/')->with('error', 'No tienes permisos.');
        }

        $candidate = $this->userModel->find($userId);
        if (!$candidate || $candidate['role'] !== 'owner_candidate') {
            return redirect()->back()->with('error', 'Candidato no válido.');
        }

        $db = \Config\Database::connect();
        $db->transBegin();
        try {
            $this->userModel->updateRole($userId, 'owner');

            $ownerModel = new OwnerModel();
            $ownerData = [
                'user_id' => $userId,
                'platform_commission_percentage' => $this->request->getPost('platform_commission_percentage')
            ];
            $ownerModel->insert($ownerData);

            $db->transCommit();
            $this->auditLogModel->log($sessionUser['id'], 'Aprobó owner', 'user', $userId, $ownerData);
            return redirect()->to('/commissions/admin/candidates')->with('success', 'Dueño de servicio aprobado exitosamente.');

        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', '[approveOwner] ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al aprobar al dueño.');
        }
    }
}