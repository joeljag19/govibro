<?php
namespace App\Modules\Locations\Controllers;

use CodeIgniter\Controller;
use App\Modules\AdminTours\Models\LocationModel; // Reutilizamos el modelo que ya existe
use App\Modules\Commissions\Models\AuditLogModel;

class LocationsController extends Controller
{
    protected $locationModel;
    protected $auditLogModel;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->locationModel = new LocationModel();
        $this->auditLogModel = new AuditLogModel();
    }

    /**
     * Muestra la lista de todas las ubicaciones.
     */
    public function index()
    {
        $data['locations'] = $this->locationModel->orderBy('id', 'DESC')->paginate(15);
        $data['pager'] = $this->locationModel->pager;

        return view('App\Modules\Locations\Views\index', $data);
    }

    /**
     * Muestra el formulario para crear una nueva ubicación.
     */
    public function create()
    {
        return view('App\Modules\Locations\Views\create');
    }

    /**
     * Procesa el guardado de una nueva ubicación.
     */
    public function store()
    {
        $user = session('user');
        $rules = ['name' => 'required|min_length[3]|is_unique[locations.name]'];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'slug' => url_title($this->request->getPost('name'), '-', true),
            'content' => $this->request->getPost('content'),
            'status' => 'publish',
        ];

        $locationId = $this->locationModel->insert($data);
        $this->auditLogModel->log($user['id'], 'Creó ubicación', 'location', $locationId, $data);

        return redirect()->to('/admin/locations')->with('success', 'Ubicación creada exitosamente.');
    }

    /**
     * Muestra el formulario para editar una ubicación.
     */
    public function edit($id)
    {
        $data['location'] = $this->locationModel->find($id);
        if (!$data['location']) {
            return redirect()->to('/admin/locations')->with('error', 'Ubicación no encontrada.');
        }
        return view('App\Modules\Locations\Views\edit', $data);
    }

    /**
     * Procesa la actualización de una ubicación.
     */
    public function update($id)
    {
        $user = session('user');
        $rules = ['name' => "required|min_length[3]|is_unique[locations.name,id,{$id}]"];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'slug' => url_title($this->request->getPost('name'), '-', true),
            'content' => $this->request->getPost('content'),
        ];

        $this->locationModel->update($id, $data);
        $this->auditLogModel->log($user['id'], 'Actualizó ubicación', 'location', $id, $data);

        return redirect()->to('/admin/locations')->with('success', 'Ubicación actualizada exitosamente.');
    }

    /**
     * Elimina (soft delete) una ubicación.
     */
    public function delete($id)
    {
        $user = session('user');
        $location = $this->locationModel->find($id);

        if ($location) {
            $this->locationModel->delete($id); // Esto hará un soft delete si el modelo está configurado
            $this->auditLogModel->log($user['id'], 'Eliminó ubicación', 'location', $id, ['name' => $location['name']]);
            return redirect()->to('/admin/locations')->with('success', 'Ubicación movida a la papelera.');
        }
        return redirect()->to('/admin/locations')->with('error', 'Ubicación no encontrada.');
    }
}
