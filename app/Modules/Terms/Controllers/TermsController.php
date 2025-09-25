<?php
namespace App\Modules\Terms\Controllers;

use CodeIgniter\Controller;
use App\Modules\AdminTours\Models\TermsAdminModel; // Reutilizamos el modelo existente
use App\Modules\AdminTours\Models\AttrsAdminModel; // Necesitamos este modelo para el dropdown
use App\Modules\Commissions\Models\AuditLogModel;

class TermsController extends Controller
{
    protected $termsModel;
    protected $attrsModel;
    protected $auditLogModel;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->termsModel = new TermsAdminModel();
        $this->attrsModel = new AttrsAdminModel();
        $this->auditLogModel = new AuditLogModel();
    }

    public function index()
    {
        $data['terms'] = $this->termsModel->getTermsWithAttributeName();
        $data['pager'] = $this->termsModel->pager;
        return view('App\Modules\Terms\Views\index', $data);
    }

    public function create()
    {
        $data['attributes'] = $this->attrsModel->findAll();
        return view('App\Modules\Terms\Views\create', $data);
    }

    public function store()
    {
        $user = session('user');
        $rules = [
            'name'    => 'required|min_length[2]',
            'attr_id' => 'required|is_natural_no_zero'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name'    => $this->request->getPost('name'),
            'slug'    => url_title($this->request->getPost('name'), '-', true),
            'attr_id' => $this->request->getPost('attr_id'),
            'content' => $this->request->getPost('content'),
        ];

        $termId = $this->termsModel->insert($data);
        $this->auditLogModel->log($user['id'], 'Creó término', 'term', $termId, $data);

        return redirect()->to('/admin/terms')->with('success', 'Término creado exitosamente.');
    }

    public function edit($id)
    {
        $data['term'] = $this->termsModel->find($id);
        if (!$data['term']) {
            return redirect()->to('/admin/terms')->with('error', 'Término no encontrado.');
        }
        $data['attributes'] = $this->attrsModel->findAll();
        return view('App\Modules\Terms\Views\edit', $data);
    }

    public function update($id)
    {
        $user = session('user');
        $rules = [
            'name'    => 'required|min_length[2]',
            'attr_id' => 'required|is_natural_no_zero'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name'    => $this->request->getPost('name'),
            'slug'    => url_title($this->request->getPost('name'), '-', true),
            'attr_id' => $this->request->getPost('attr_id'),
            'content' => $this->request->getPost('content'),
        ];

        $this->termsModel->update($id, $data);
        $this->auditLogModel->log($user['id'], 'Actualizó término', 'term', $id, $data);

        return redirect()->to('/admin/terms')->with('success', 'Término actualizado exitosamente.');
    }

    public function delete($id)
    {
        $user = session('user');
        $term = $this->termsModel->find($id);

        if ($term) {
            $this->termsModel->delete($id);
            $this->auditLogModel->log($user['id'], 'Eliminó término', 'term', $id, ['name' => $term['name']]);
            return redirect()->to('/admin/terms')->with('success', 'Término movido a la papelera.');
        }
        return redirect()->to('/admin/terms')->with('error', 'Término no encontrado.');
    }
}
