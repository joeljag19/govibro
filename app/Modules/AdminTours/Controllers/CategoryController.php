<?php
// El namespace ahora pertenece a AdminTours
namespace App\Modules\AdminTours\Controllers;

use CodeIgniter\Controller;
use App\Modules\AdminTours\Models\TourCategoryModel;
use App\Modules\Commissions\Models\AuditLogModel;

class CategoryController extends Controller
{
    protected $categoryModel;
    protected $auditLogModel;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->categoryModel = new TourCategoryModel();
        $this->auditLogModel = new AuditLogModel();
    }

    public function index()
    {
        $data['categories'] = $this->categoryModel->orderBy('id', 'DESC')->paginate(15);
        $data['pager'] = $this->categoryModel->pager;
        // La ruta de la vista ahora apunta dentro del módulo AdminTours
        return view('App\Modules\AdminTours\Views\categories\index', $data);
    }

    public function create()
    {
        // La ruta de la vista ahora apunta dentro del módulo AdminTours
        return view('App\Modules\AdminTours\Views\categories\create');
    }

    public function store()
    {
        // ... (la lógica de este método no cambia) ...
        $user = session('user');
        $rules = ['name' => 'required|min_length[3]|is_unique[tour_categories.name]'];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'slug' => url_title($this->request->getPost('name'), '-', true),
            'content' => $this->request->getPost('content'),
            'status' => 'publish',
        ];

        $categoryId = $this->categoryModel->insert($data);
        $this->auditLogModel->log($user['id'], 'Creó categoría de tour', 'tour_category', $categoryId, $data);

        return redirect()->to('/admin/tours/categories')->with('success', 'Categoría creada exitosamente.');
    }

    public function edit($id)
    {
        $data['category'] = $this->categoryModel->find($id);
        if (!$data['category']) {
            return redirect()->to('/admin/tours/categories')->with('error', 'Categoría no encontrada.');
        }
        // La ruta de la vista ahora apunta dentro del módulo AdminTours
        return view('App\Modules\AdminTours\Views\categories\edit', $data);
    }

    public function update($id)
    {
        // ... (la lógica de este método no cambia) ...
        $user = session('user');
        $rules = ['name' => "required|min_length[3]|is_unique[tour_categories.name,id,{$id}]"];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'slug' => url_title($this->request->getPost('name'), '-', true),
            'content' => $this->request->getPost('content'),
        ];

        $this->categoryModel->update($id, $data);
        $this->auditLogModel->log($user['id'], 'Actualizó categoría de tour', 'tour_category', $id, $data);

        return redirect()->to('/admin/tours/categories')->with('success', 'Categoría actualizada exitosamente.');
    }

    public function delete($id)
    {
        // ... (la lógica de este método no cambia) ...
        $user = session('user');
        $category = $this->categoryModel->find($id);

        if ($category) {
            $this->categoryModel->delete($id);
            $this->auditLogModel->log($user['id'], 'Eliminó categoría de tour', 'tour_category', $id, ['name' => $category['name']]);
            return redirect()->to('/admin/tours/categories')->with('success', 'Categoría movida a la papelera.');
        }
        return redirect()->to('/admin/tours/categories')->with('error', 'Categoría no encontrada.');
    }
}
