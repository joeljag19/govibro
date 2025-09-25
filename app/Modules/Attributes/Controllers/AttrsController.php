<?php
namespace App\Modules\Attributes\Controllers;

use CodeIgniter\Controller;
use App\Modules\AdminTours\Models\AttrsAdminModel; // Reutilizamos el modelo existente
use App\Modules\Commissions\Models\AuditLogModel;

class AttrsController extends Controller
{
    protected $attrsModel;
    protected $auditLogModel;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->attrsModel = new AttrsAdminModel();
        $this->auditLogModel = new AuditLogModel();
    }

    public function index()
    {
        $data['attributes'] = $this->attrsModel->orderBy('id', 'DESC')->paginate(15);
        $data['pager'] = $this->attrsModel->pager;
        return view('App\Modules\Attributes\Views\index', $data);
    }

    public function create()
    {
        return view('App\Modules\Attributes\Views\create');
    }

    public function store()
    {
        $user = session('user');
        $rules = ['name' => 'required|min_length[3]|is_unique[attrs.name]'];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'slug' => url_title($this->request->getPost('name'), '-', true),
            'service' => 'tour', // Por ahora, lo asignamos a 'tour'
        ];

        $attrId = $this->attrsModel->insert($data);
        $this->auditLogModel->log($user['id'], 'Creó atributo', 'attribute', $attrId, $data);

        return redirect()->to('/admin/attributes')->with('success', 'Atributo creado exitosamente.');
    }

    public function edit($id)
    {
        $data['attribute'] = $this->attrsModel->find($id);
        if (!$data['attribute']) {
            return redirect()->to('/admin/attributes')->with('error', 'Atributo no encontrado.');
        }
        return view('App\Modules\Attributes\Views\edit', $data);
    }

    public function update($id)
    {
        $user = session('user');
        $rules = ['name' => "required|min_length[3]|is_unique[attrs.name,id,{$id}]"];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'slug' => url_title($this->request->getPost('name'), '-', true),
        ];

        $this->attrsModel->update($id, $data);
        $this->auditLogModel->log($user['id'], 'Actualizó atributo', 'attribute', $id, $data);

        return redirect()->to('/admin/attributes')->with('success', 'Atributo actualizado exitosamente.');
    }

    public function delete($id)
    {
        $user = session('user');
        $attribute = $this->attrsModel->find($id);

        if ($attribute) {
            $this->attrsModel->delete($id);
            $this->auditLogModel->log($user['id'], 'Eliminó atributo', 'attribute', $id, ['name' => $attribute['name']]);
            return redirect()->to('/admin/attributes')->with('success', 'Atributo movido a la papelera.');
        }
        return redirect()->to('/admin/attributes')->with('error', 'Atributo no encontrado.');
    }
}
