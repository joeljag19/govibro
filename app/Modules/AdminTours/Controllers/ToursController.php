<?php
namespace App\Modules\AdminTours\Controllers;

use CodeIgniter\Controller;

use App\Controllers\BaseController;

use App\Modules\AdminTours\Models\AttrsAdminModel;
use App\Modules\Commissions\Models\AuditLogModel;
use App\Modules\AdminTours\Models\BookingsAdminModel;
use App\Modules\AdminTours\Models\LocationsTranslationsAdminModel;
use App\Modules\AdminTours\Models\ReviewsAdminModel;
use App\Modules\AdminTours\Models\TourAdminModel;
use App\Modules\AdminTours\Models\TourCategoryModel;
use App\Modules\AdminTours\Models\LocationModel;
use App\Modules\AdminTours\Models\TermsAdminModel;
use App\Modules\AdminTours\Models\TourMetaAdminModel;
use App\Modules\AdminTours\Models\TourTranslationsAdminModel;
use App\Modules\AdminTours\Models\TourCategoriesTranslationsAdminModel;
use App\Modules\AdminTours\Models\UserWishlistAdminModel;


class ToursController  extends BaseController
{
    protected $tourModel;
    protected $tourMetaModel;
    protected $bookingsModel;
    protected $reviewsModel;
    protected $wishlistModel;
    protected $termsModel;
    protected $attrsModel;
    protected $tourTranslationsModel;
    protected $tourCategoriesTranslationsModel;
    protected $locationsTranslationsModel;
    protected $auditLogModel;
    protected $db;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->tourModel = new TourAdminModel();
        $this->tourMetaModel = new TourMetaAdminModel();
        $this->bookingsModel = new BookingsAdminModel();
        $this->reviewsModel = new ReviewsAdminModel();
        $this->wishlistModel = new UserWishlistAdminModel();
        $this->termsModel = new TermsAdminModel();
        $this->attrsModel = new AttrsAdminModel();
        $this->tourTranslationsModel = new TourTranslationsAdminModel();
        $this->tourCategoriesTranslationsModel = new TourCategoriesTranslationsAdminModel();
        $this->locationsTranslationsModel = new LocationsTranslationsAdminModel();
        $this->auditLogModel = new AuditLogModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $user = session('user');
        $data['user'] = $user;
    
        if ($user['role'] === 'owner') {
            $data['toursWithCategories'] = $this->tourModel->getToursByOwner($user['id']);
        } else {
            $data['toursWithCategories'] = $this->tourModel->getAllToursWithDetails();
        }
        
        $data['pager'] = $this->tourModel->pager;
        
        if ($user['role'] === 'super_admin') {
            $data['deletedTours'] = $this->tourModel->getDeletedToursWithDetails();
        }
    
        return view('App\Modules\AdminTours\Views\tours\index', $data);
    }

   public function create()
    {
        // Simplemente sobrescribes la configuración que necesitas
        $this->data['assets']['css'][] = 'quill';
        $this->data['assets']['js'][]  = 'quill';
        // Ya no es necesario $this->layoutOptions['header_style'] = 'default';
        // ni $this->layoutOptions['show_topbar'] = true; porque ya son el valor por defecto.
        
        // Datos específicos para esta vista
        $data = [
            'categories' => (new TourCategoryModel())->findAll(),
            'locations'  => (new LocationModel())->findAll(),
            'terms'      => (new TermsAdminModel())->getTermsWithAttributeName(),
        ];

        
        // Renderizamos la vista con la función render() del BaseController
        return $this->render('App\Modules\AdminTours\Views\tours\create-fe', $data);
    }

    // --- MÉTODOS ACTUALIZADOS DE store() Y update() EN ToursController ---
// En AdminTours/Controllers/ToursController.php

public function store()
{
    // 1. REGLAS DE VALIDACIÓN (dejamos 'include' comentado por ahora)
    $rules = [
        'title'       => 'required|min_length[5]|max_length[255]',
        'category_id' => 'required|is_natural_no_zero',
        'location_id' => 'required|is_natural_no_zero',
        'price'       => 'permit_empty|numeric',
        'image'       => [
            'label' => 'Imagen Principal',
            'rules' => 'uploaded[image]|max_size[image,2048]|is_image[image]',
        ],
        // 'include' => [ ... ], // Lo activaremos después
    ];

    $messages = [
        'title'       => ['required' => 'El título es obligatorio.', 'min_length' => 'El título debe tener al menos 5 caracteres.'],
        'category_id' => ['is_natural_no_zero' => 'Debes seleccionar una categoría.'],
        'location_id' => ['is_natural_no_zero' => 'Debes seleccionar una ubicación.'],
        'image'       => ['uploaded' => 'Debes subir una imagen principal.', 'max_size' => 'La imagen no debe superar los 2MB.']
    ];

    // 2. EJECUTAR VALIDACIÓN CON MANEJO DE AJAX
    if (! $this->validate($rules, $messages)) {
        // Si la validación falla y es una petición AJAX, devuelve los errores en JSON.
        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'errors'  => $this->validator->getErrors()
            ]);
        }
        // Comportamiento normal si no es AJAX.
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // 3. SI LA VALIDACIÓN ES EXITOSA, EJECUTAR LA LÓGICA DE GUARDADO
    $postData = $this->request->getPost();
    $files    = $this->request->getFiles();
    $user     = session('user');

    $auditLogModel = new AuditLogModel();
    $tourModel = new TourAdminModel();

    try {
        $tourId = $tourModel->createTourWithDetails($postData, $files, $user);
        
        if ($tourId) {
            $auditLogModel->log($user['id'], 'Tour creado', 'tour', $tourId, ['title' => $postData['title']]);
            
            // Si es una petición AJAX, devuelve una respuesta de éxito en JSON.
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success'      => true,
                    'redirect_url' => site_url('admin/tours')
                ]);
            }

            return redirect()->to('/admin/tours')->with('success', 'Tour creado y pendiente de aprobación.');

        } else {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['success' => false, 'errors' => ['general' => 'No se pudo crear el tour.']]);
            }
            return redirect()->back()->withInput()->with('error', 'No se pudo crear el tour. Revisa los logs.');
        }
    } catch (\Exception $e) {
        log_message('error', '[ToursController::store] ' . $e->getMessage());
        if ($this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false, 'errors' => ['general' => 'Ocurrió un error inesperado.']]);
        }
        return redirect()->back()->withInput()->with('error', 'Ocurrió un error inesperado al guardar el tour.');
    }
}

//  public function store()
//     {
//         $user = session('user');

//         // 1. Definir las reglas de validación
//         $rules = [
//             'title'       => 'required|min_length[5]|max_length[255]',
//             'category_id' => 'required|is_natural_no_zero',
//             'price'       => 'permit_empty|numeric',
//             'sale_price'  => 'permit_empty|numeric|less_than_field[price]',
//             'duration'    => 'permit_empty|max_length[50]',
//             'location_id' => 'required|is_natural_no_zero',
//             'image'       => [
//                 'label' => 'Imagen Principal',
//                 'rules' => 'uploaded[image]|max_size[image,2048]|is_image[image]'
//         ]
//         ];
        
//         // 2. Definir mensajes de error personalizados
//         $messages = [
//             'title' => [
//                 'required'   => 'El título del tour es obligatorio.',
//                 'min_length' => 'El título debe tener al menos 5 caracteres.'
//             ],
//             'category_id' => [
//                 'is_natural_no_zero' => 'Debes seleccionar una categoría válida.'
//             ],
//             'sale_price' => [
//                 'less_than_field' => 'El precio de oferta debe ser menor que el precio base.'
//             ],
//             'image' => [
//                 'uploaded' => 'Debes subir una imagen principal.',
//                 'max_size' => 'La imagen principal no debe superar los 2MB.',
//                 'is_image' => 'El archivo subido debe ser una imagen válida.'
//             ]
//         ];

//         // 3. Ejecutar la validación
//         if (!$this->validate($rules, $messages)) {
//             // Si falla, redirigir CON los errores y los datos del formulario
//             return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
//         }

//         // Si la validación pasa, continuar con la lógica de guardado...
//         $postData = $this->request->getPost();
//         $files = $this->request->getFiles();

//         try {
//             $tourId = $this->tourModel->createTourWithDetails($postData, $files, $user);
            
//             if ($tourId) {
//                 $this->auditLogModel->log($user['id'], 'Tour creado', 'tour', $tourId, ['title' => $postData['title']]);
//                 return redirect()->to('/admin/tours')->with('success', 'Tour creado y pendiente de aprobación.');
//             } else {
//                 return redirect()->back()->withInput()->with('error', 'No se pudo crear el tour. Revisa los logs.');
//             }
//         } catch (\Exception $e) {
//             log_message('error', '[ToursController::store] ' . $e->getMessage());
//             return redirect()->back()->withInput()->with('error', 'Ocurrió un error inesperado.');
//         }
//     }
    
    // public function edit($id)
    // {
    //     $user = session('user');
    //     $data = $this->tourModel->getDataForEditPage($id, $user);

    //     if (!$data || ($user['role'] === 'owner' && $data['tour']['owner_id'] != $user['id'])) {
    //         return redirect()->to('/admin/tours')->with('error', 'Acción no permitida o tour no encontrado.');
    //     }

    //     return view('App\Modules\AdminTours\Views\tours\edit', $data);
    // }


    // In app/Modules/AdminTours/Controllers/ToursController.php

public function edit($id)
{
    $user = session('user');
    // 1. OBTENER DATOS (Tu lógica original es perfecta y se mantiene)
    $data = $this->tourModel->getDataForEditPage($id, $user);

    // 2. VERIFICAR PERMISOS (Tu lógica original es perfecta y se mantiene)
    if (!$data || !$data['tour'] || ($user['role'] === 'owner' && $data['tour']['owner_id'] != $user['id'])) {
        return redirect()->to('/admin/tours')->with('error', 'Acción no permitida o tour no encontrado.');
    }

    // 3. SOLICITAR LOS ASSETS NECESARIOS PARA LA VISTA DE EDICIÓN
    $this->data['assets']['css'][] = 'quill';
    $this->data['assets']['js'][]  = 'quill';
    $this->data['assets']['js'][]  = 'googlemaps';



    // 4. RENDERIZAR LA NUEVA VISTA USANDO EL MÉTODO render()
    // Esto asegura que tanto los datos del tour ($data) como los assets ($this->assets) se pasen a la plantilla.
    return $this->render('App\Modules\AdminTours\Views\tours\edit-fe', $data);
}



    // En AdminTours/Controllers/ToursController.php

// En ToursController.php

public function update($id)
{
    // 1. VERIFICACIÓN DE PERMISOS
    $user = session('user');
    $tour = $this->tourModel->find($id);

    if (!$tour || ($user['role'] === 'owner' && $tour['owner_id'] != $user['id'])) {
        if ($this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Acción no permitida.'])->setStatusCode(403);
        }
        return redirect()->to('/admin/tours')->with('error', 'Acción no permitida o tour no encontrado.');
    }
    
    // 2. REGLAS DE VALIDACIÓN CORREGIDAS
    $rules = [
        'title'       => 'required|min_length[5]|max_length[255]',
        'category_id' => 'required|is_natural_no_zero',
        'location_id' => 'required|is_natural_no_zero',
        'price'       => 'permit_empty|numeric',
        'sale_price'  => 'permit_empty|numeric|less_than_equal_to[price]',
        'image'       => 'permit_empty|uploaded[image]|max_size[image,2048]|is_image[image]',
        
        // CORRECCIÓN: Eliminamos la regla 'is_json'
        'include'     => 'permit_empty|validate_inclusion_data',
        'exclude'     => 'permit_empty', // Puedes crear reglas más específicas si lo necesitas
        'itinerary'   => 'permit_empty',
        'faqs'        => 'permit_empty',
    ];

    $messages = [
        'title' => [
            'required'   => 'El título del tour es obligatorio.',
            'min_length' => 'El título debe tener al menos 5 caracteres.'
        ],
        // Mensaje de error para la nueva regla
        'sale_price' => ['less_than_equal_to' => 'El precio de oferta debe ser menor o igual que el precio base.'],
        'image' => ['max_size' => 'La imagen principal no debe superar los 2MB.']
    ];

    // 3. EJECUTAR LA VALIDACIÓN CON MANEJO DE AJAX
    if (!$this->validate($rules, $messages)) {
        if ($this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false, 'errors' => $this->validator->getErrors()]);
        }
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // 4. EJECUTAR LA LÓGICA DE GUARDADO
    $postData = $this->request->getPost();
    $files = $this->request->getFiles();

    try {
        if ($this->tourModel->updateTourWithDetails($id, $postData, $files, $user)) {
            $this->auditLogModel->log($user['id'], 'Tour actualizado', 'tour', $id, ['title' => $postData['title']]);
            
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['success' => true, 'message' => 'Tour actualizado exitosamente.']);
            }
            return redirect()->to('/admin/tours/edit/' . $id)->with('success', 'Tour actualizado exitosamente.');

        } else {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['success' => false, 'message' => 'No se pudo actualizar el tour.']);
            }
            return redirect()->back()->withInput()->with('error', 'No se pudo actualizar el tour.');
        }
    } catch (\Exception $e) {
        log_message('error', '[ToursController::update] ' . $e->getMessage());
        if ($this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Ocurrió un error inesperado al actualizar.']);
        }
        return redirect()->back()->withInput()->with('error', 'Ocurrió un error inesperado al actualizar.');
    }
}
    // public function update($id)
    // {
    //     $user = session('user');
    //     $tour = $this->tourModel->find($id);

    //     if (!$tour || ($user['role'] === 'owner' && $tour['owner_id'] != $user['id'])) {
    //         return redirect()->to('/admin/tours')->with('error', 'Acción no permitida.');
    //     }
        
    //     $rules = [
    //         'title'       => 'required|min_length[5]',
    //         'category_id' => 'required|is_natural_no_zero',
    //         'location_id' => 'required|is_natural_no_zero',
    //         'price'       => 'required|numeric'
    //     ];

    //     if (!$this->validate($rules)) {
    //         return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    //     }

    //     $postData = $this->request->getPost();
    //     $files = $this->request->getFiles();

    //     try {
    //         if ($this->tourModel->updateTourWithDetails($id, $postData, $files, $user)) {
    //             $this->auditLogModel->log($user['id'], 'Tour actualizado', 'tour', $id, ['title' => $postData['title']]);
    //             return redirect()->to('/admin/tours/edit/' . $id)->with('success', 'Tour actualizado exitosamente.');
    //         } else {
    //             return redirect()->back()->withInput()->with('error', 'No se pudo actualizar el tour.');
    //         }
    //     } catch (\Exception $e) {
    //         log_message('error', '[ToursController::update] ' . $e->getMessage());
    //         return redirect()->back()->withInput()->with('error', 'Ocurrió un error inesperado al actualizar.');
    //     }
    // }
    
    public function view($id)
    {
        $user = session('user');
        if ($user['role'] !== 'super_admin') {
            return redirect()->to('/admin/tours')->with('error', 'No tienes permiso para ver los detalles de este tour.');
        }

        $data = $this->tourModel->getDataForEditPage($id, $user);
        if (!$data) {
            return redirect()->to('/admin/tours')->with('error', 'Tour no encontrado.');
        }

        return view('App\Modules\AdminTours\Views\tours\view', $data);
    }

    public function approve($id)
    {
        $user = session('user');
        if ($user['role'] !== 'super_admin') { return redirect()->back()->with('error', 'No tienes permisos.'); }
        
        $this->tourModel->update($id, ['approval_status' => 'approved', 'status' => 'published']);
        $this->auditLogModel->log($user['id'], 'Aprobó y publicó el tour', 'tour', $id, []);
        
        return redirect()->to('/admin/tours')->with('success', 'Tour aprobado y publicado exitosamente.');
    }

    public function reject($id)
    {
        $user = session('user');
        if ($user['role'] !== 'super_admin') { return redirect()->back()->with('error', 'No tienes permisos.'); }
        
        $this->tourModel->update($id, ['approval_status' => 'rejected']);
        $this->auditLogModel->log($user['id'], 'Rechazó tour', 'tour', $id, []);
        
        return redirect()->to('/admin/tours')->with('success', 'Tour rechazado.');
    }

    public function publish($id)
    {
        $user = session('user');
        $tour = $this->tourModel->find($id);

        if (!$tour || ($user['role'] === 'owner' && $tour['owner_id'] != $user['id'])) { return redirect()->back()->with('error', 'Acción no permitida.'); }
        if ($tour['approval_status'] !== 'approved') { return redirect()->back()->with('error', 'Este tour debe ser aprobado primero.'); }

        $this->tourModel->update($id, ['status' => 'published']);
        $this->auditLogModel->log($user['id'], 'Publicó tour', 'tour', $id, []);

        return redirect()->to('/admin/tours')->with('success', 'Tour publicado exitosamente.');
    }
    
    public function delete($id)
    {
        $user = session('user');
        $tour = $this->tourModel->find($id);

        if (!$tour || ($user['role'] === 'owner' && $tour['owner_id'] != $user['id'])) { return redirect()->back()->with('error', 'Acción no permitida.'); }

        $this->tourModel->delete($id); // Soft delete
        $this->auditLogModel->log($user['id'], 'Eliminó tour', 'tour', $id, ['title' => $tour['title']]);

        return redirect()->to('/admin/tours')->with('success', 'Tour movido a la papelera.');
    }
    
    public function restore($id)
    {
        $user = session('user');
        if ($user['role'] !== 'super_admin') { return redirect()->back()->with('error', 'No tienes permisos.'); }
        
        $this->tourModel->update($id, ['deleted_at' => null]);
        $this->auditLogModel->log($user['id'], 'Restauró tour', 'tour', $id, []);

        return redirect()->to('/admin/tours')->with('success', 'Tour restaurado.');
    }

    public function cloneTour($id)
    {
        $user = session('user');
        $tour = $this->tourModel->find($id);

        if (!$tour || ($user['role'] === 'owner' && $tour['owner_id'] != $user['id'])) {
            return redirect()->to('/admin/tours')->with('error', 'No tienes permisos para clonar este tour.');
        }

        $this->db->transBegin();
        try {
            $newTourData = $tour;
            unset($newTourData['id']);
            $newTourData['title'] = $tour['title'] . ' (Clonado)';
            $newTourData['slug'] = $tour['slug'] . '-clonado-' . time();
            $newTourData['approval_status'] = 'pending';
            $newTourData['status'] = 'draft';
            
            $newTourId = $this->tourModel->insert($newTourData);

            if (!$newTourId) throw new \Exception('Error al clonar el tour.');

            $meta = $this->tourModel->getMeta($id);
            if ($meta) {
                unset($meta['id']);
                $meta['tour_id'] = $newTourId;
                $this->tourMetaModel->insert($meta);
            }

            if ($this->db->transStatus() === false) {
                throw new \Exception('Error en la transacción de clonación.');
            }

            $this->db->transCommit();
            $this->auditLogModel->log($user['id'], 'Clonó tour', 'tour', $newTourId, ['original_id' => $id]);
            return redirect()->to('/admin/tours')->with('success', 'Tour clonado exitosamente.');
        } catch (\Exception $e) {
            $this->db->transRollback();
            log_message('error', '[cloneTour] ' . $e->getMessage());
            return redirect()->to('/admin/tours')->with('error', 'Error al clonar el tour.');
        }
    }
    
    public function bulkEdit()
    {
        $user = session('user');
        $tourIds = $this->request->getGet('ids') ? explode(',', $this->request->getGet('ids')) : [];
        if (empty($tourIds)) {
            return redirect()->to('/admin/tours')->with('error', 'No se seleccionaron tours para edición masiva.');
        }
        $tours = $this->tourModel->whereIn('id', $tourIds)->findAll();
        if (empty($tours)) {
            return redirect()->to('/admin/tours')->with('error', 'No se encontraron los tours seleccionados.');
        }
        if ($user['role'] === 'owner') {
            foreach ($tours as $tour) {
                if ($tour['owner_id'] != $user['id']) {
                    return redirect()->to('/admin/tours')->with('error', 'No tienes permisos para editar algunos de los tours seleccionados.');
                }
            }
        }
        $data = [
            'tours' => $tours,
            'categories' => $this->db->table('tour_categories')->where('deleted_at', null)->get()->getResultArray(),
            'locations' => $this->db->table('locations')->where('deleted_at', null)->get()->getResultArray(),
        ];
        return view('App\Modules\AdminTours\Views\tours\bulk_edit', $data);
    }

    public function bulkUpdate()
    {
        $user = session('user');
        $tourIds = $this->request->getPost('tour_ids');
        $updates = $this->request->getPost(['status', 'price', 'category_id', 'location_id']);

        if (empty($tourIds)) {
            return redirect()->to('/admin/tours')->with('error', 'No se seleccionaron tours para actualizar.');
        }
        
        $updateData = [];
        if (!empty($updates['status'])) { $updateData['status'] = $updates['status']; }
        if (!empty($updates['price'])) { $updateData['price'] = $updates['price']; }
        if (!empty($updates['category_id'])) { $updateData['category_id'] = $updates['category_id']; }
        if (!empty($updates['location_id'])) { $updateData['location_id'] = $updates['location_id']; }

        if (!empty($updateData)) {
            $this->tourModel->whereIn('id', $tourIds)->set($updateData)->update();
            $this->auditLogModel->log($user['id'], 'Edición masiva de tours', 'tour', 0, ['tour_ids' => $tourIds, 'updates' => $updateData]);
        }

        return redirect()->to('/admin/tours')->with('success', 'Tours actualizados exitosamente.');
    }

    public function uploadImage($id)
    {
        $user = session('user');
        $tour = $this->tourModel->find($id);

        if (!$tour || ($user['role'] === 'owner' && $tour['owner_id'] != $user['id'])) {
            return redirect()->to('/admin/tours')->with('error', 'Acción no permitida.');
        }

        $imageFile = $this->request->getFile('image');
        if (!$imageFile || !$imageFile->isValid()) {
            return redirect()->to('/admin/tours/edit/' . $id)->with('error', 'Archivo no válido.');
        }

        try {
            $newName = $imageFile->getRandomName();
            $imageFile->move(FCPATH . 'uploads', $newName);
            
            $gallery = !empty($tour['gallery']) ? json_decode($tour['gallery'], true) : [];
            $gallery[] = $newName;

            if ($this->tourModel->update($id, ['gallery' => json_encode($gallery)])) {
                $this->auditLogModel->log($user['id'], 'Subió imagen a galería', 'tour', $id, ['image' => $newName]);
                return redirect()->to('/admin/tours/edit/' . $id)->with('success', 'Imagen subida a la galería.');
            } else {
                if (file_exists(FCPATH . 'uploads/' . $newName)) { unlink(FCPATH . 'uploads/' . $newName); }
                return redirect()->to('/admin/tours/edit/' . $id)->with('error', 'No se pudo guardar la imagen en la BD.');
            }
        } catch (\Exception $e) {
            log_message('error', '[uploadImage] ' . $e->getMessage());
            return redirect()->to('/admin/tours/edit/' . $id)->with('error', 'Error al subir la imagen.');
        }
    }

    //Funcion para eliminar imagenes de la galeria


// En app/Modules/AdminTours/Controllers/ToursController.php

// En app/Modules/AdminTours/Controllers/ToursController.php

public function deleteImage($tourId, $imageName)
{
    $user = session('user');
    $decodedImageName = urldecode($imageName);

    // Si el usuario no tiene permisos, devuelve un JSON de error.
    $tour = $this->tourModel->find($tourId);
    if (!$tour || ($user['role'] === 'owner' && $tour['owner_id'] != $user['id'])) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Acción no permitida.'
        ]);
    }

    // Intenta eliminar la imagen y devuelve un JSON de éxito o fracaso.
    if ($this->tourModel->removeImageFromGallery($tourId, $decodedImageName)) {
        $this->auditLogModel->log($user['id'], 'Eliminó imagen de galería', 'tour', $tourId, ['image_name' => $decodedImageName]);
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Imagen eliminada correctamente.'
        ]);
    } else {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'No se pudo eliminar la imagen.'
        ]);
    }
}

    public function manageAvailability($id)
    {
        $user = session('user');
        $tour = $this->tourModel->find($id);

        if (!$tour || ($user['role'] === 'owner' && $tour['owner_id'] != $user['id'])) {
            return redirect()->to('/admin/tours')->with('error', 'Acción no permitida.');
        }

        $data = [
            'tour' => $tour,
            'availability' => $this->db->table('tour_availability')->where('tour_id', $id)->get()->getResultArray(),
        ];
        return view('App\Modules\AdminTours\Views\tours\availability', $data);
    }























    // Agregar una nueva fecha de disponibilidad
    public function addAvailability($tourId)
    {
        $user = session('user');
    
        // Verificar permisos
        if (!in_array($user['role'], ['super_admin', 'owner'])) {
            log_message('error', 'Usuario no autorizado intentó agregar disponibilidad: ' . print_r($user, true));
            return redirect()->to('/')->with('error', 'No tienes permisos para realizar esta acción.');
        }
    
        $tour = $this->tourModel->getById($tourId);
        if (!$tour) {
            log_message('error', 'Tour no encontrado: ' . $tourId);
            return redirect()->to('/admin/tours')->with('error', 'Tour no encontrado.');
        }
    
        if ($user['role'] === 'owner' && $tour['owner_id'] != $user['id']) {
            log_message('error', 'Usuario no autorizado intentó agregar disponibilidad a un tour que no le pertenece: ' . print_r($user, true));
            return redirect()->to('/admin/tours')->with('error', 'No tienes permisos para modificar este tour.');
        }
    
        $data = [
            'tour_id' => $tourId,
            'start_date' => $this->request->getPost('start_date'),
            'end_date' => $this->request->getPost('end_date'),
            'price' => $this->request->getPost('price') ? (float)$this->request->getPost('price') : null,
            'min_guests' => $this->request->getPost('min_guests') ? (int)$this->request->getPost('min_guests') : null,
            'max_people' => $this->request->getPost('max_people') ? (int)$this->request->getPost('max_people') : null,
            'note_to_customer' => $this->request->getPost('note_to_customer') ?: null,
            'note_to_admin' => $this->request->getPost('note_to_admin') ?: null,
            'is_instant' => (int)$this->request->getPost('is_instant'),
            'is_available' => (int)$this->request->getPost('is_available'),
        ];
    
        $this->db->table('tour_availability')->insert($data);
        $availabilityId = $this->db->insertID();
    
        if ($availabilityId) {
            $this->db->table('audit_logs')->insert([
                'user_id' => $user['id'],
                'action' => 'Añadió disponibilidad al tour',
                'entity_type' => 'tour_availability',
                'entity_id' => $availabilityId,
                'details' => json_encode(['tour_id' => $tourId, 'start_date' => $data['start_date'], 'end_date' => $data['end_date']]),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            return redirect()->back()->with('success', 'Fecha de disponibilidad añadida exitosamente.');
        } else {
            return redirect()->back()->with('error', 'Error al añadir la fecha de disponibilidad.');
        }
    }
    


    // Editar una fecha de disponibilidad
    public function editAvailability($availabilityId)
    {
        $user = session('user');

        // Verificar si el usuario está autenticado
        if (!$user) {
            log_message('error', 'Intento de editar disponibilidad sin usuario autenticado.');
            return redirect()->to('/auth/login')->with('error', 'Debes iniciar sesión para acceder a esta página.');
        }

        // Verificar si el usuario tiene permisos
        if (!in_array($user['role'], ['super_admin', 'owner'])) {
            log_message('error', 'Usuario no autorizado intentó editar disponibilidad: ' . print_r($user, true));
            return redirect()->to('/')->with('error', 'No tienes permisos para acceder a esta página.');
        }

        // Obtener la disponibilidad
        $availability = $this->db->table('tour_availability')->where('id', $availabilityId)->get()->getRowArray();
        if (!$availability) {
            log_message('error', 'Fecha de disponibilidad no encontrada: ' . $availabilityId);
            return redirect()->to('/admin/tours')->with('error', 'Fecha de disponibilidad no encontrada.');
        }

        // Obtener el tour
        $tour = $this->tourModel->getById($availability['tour_id']);
        if (!$tour) {
            log_message('error', 'Tour no encontrado: ' . $availability['tour_id']);
            return redirect()->to('/admin/tours')->with('error', 'Tour no encontrado.');
        }

        // Si el usuario es owner, verificar que sea el propietario del tour
        if ($user['role'] === 'owner' && $tour['owner_id'] != $user['id']) {
            log_message('error', 'Usuario no autorizado intentó editar disponibilidad de tour que no le pertenece: ' . print_r($user, true));
            return redirect()->to('/admin/tours')->with('error', 'No tienes permisos para editar esta fecha de disponibilidad.');
        }

        // Verificar si el tour está en un estado que permita modificaciones
        if ($tour['approval_status'] === 'pending' && $user['role'] === 'owner') {
            return redirect()->to('/admin/tours')->with('error', 'No puedes editar disponibilidad mientras el tour está pendiente de aprobación.');
        }

        // Preparar datos para la vista
        $data = [
            'tour' => $tour,
            'availability' => $availability,
            'user' => $user,
            'loadDaterangepicker' => true,
        ];

        return view('App\Modules\AdminTours\Views\tours\edit_availability', $data);
    }

    // Actualizar una fecha de disponibilidad
    public function updateAvailability($availabilityId)
    {
        $user = session('user');

        // Verificar si el usuario está autenticado
        if (!$user) {
            log_message('error', 'Intento de actualizar disponibilidad sin usuario autenticado.');
            return redirect()->to('/auth/login')->with('error', 'Debes iniciar sesión para acceder a esta página.');
        }

        // Verificar si el usuario tiene permisos
        if (!in_array($user['role'], ['super_admin', 'owner'])) {
            log_message('error', 'Usuario no autorizado intentó actualizar disponibilidad: ' . print_r($user, true));
            return redirect()->to('/')->with('error', 'No tienes permisos para acceder a esta página.');
        }

        // Obtener la disponibilidad
        $availability = $this->db->table('tour_availability')->where('id', $availabilityId)->get()->getRowArray();
        if (!$availability) {
            log_message('error', 'Fecha de disponibilidad no encontrada: ' . $availabilityId);
            return redirect()->to('/admin/tours')->with('error', 'Fecha de disponibilidad no encontrada.');
        }

        // Obtener el tour
        $tour = $this->tourModel->getById($availability['tour_id']);
        if (!$tour) {
            log_message('error', 'Tour no encontrado: ' . $availability['tour_id']);
            return redirect()->to('/admin/tours')->with('error', 'Tour no encontrado.');
        }

        // Si el usuario es owner, verificar que sea el propietario del tour
        if ($user['role'] === 'owner' && $tour['owner_id'] != $user['id']) {
            log_message('error', 'Usuario no autorizado intentó actualizar disponibilidad de tour que no le pertenece: ' . print_r($user, true));
            return redirect()->to('/admin/tours')->with('error', 'No tienes permisos para actualizar esta fecha de disponibilidad.');
        }

        // Verificar si el tour está en un estado que permita modificaciones
        if ($tour['approval_status'] === 'pending' && $user['role'] === 'owner') {
            return redirect()->to('/admin/tours')->with('error', 'No puedes actualizar disponibilidad mientras el tour está pendiente de aprobación.');
        }

        // Obtener los datos actualizados
        $availabilityData = [
            'start_date' => $this->request->getPost('start_date'),
            'end_date' => $this->request->getPost('end_date'),
            'price' => $this->request->getPost('price') ?? null,
            'person_types' => json_encode($this->request->getPost('person_types') ?? []),
            'max_people' => $this->request->getPost('max_people'),
            'min_guests' => $this->request->getPost('min_guests') ?? null,
            'is_available' => $this->request->getPost('is_available') ?? 1,
            'note_to_customer' => $this->request->getPost('note_to_customer') ?? null,
            'note_to_admin' => $this->request->getPost('note_to_admin') ?? null,
            'is_instant' => $this->request->getPost('is_instant') ? 1 : 0,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // Validar fechas
        if (strtotime($availabilityData['end_date']) < strtotime($availabilityData['start_date'])) {
            return redirect()->to('admin/tours/availability/' . $tour['id'])->with('error', 'La fecha de fin debe ser posterior a la fecha de inicio.');
        }

        // Validar max_people
        if ($availabilityData['max_people'] && (!is_numeric($availabilityData['max_people']) || $availabilityData['max_people'] <= 0)) {
            return redirect()->to('admin/tours/availability/' . $tour['id'])->with('error', 'El número máximo de personas debe ser un valor positivo.');
        }

        // Validar min_guests
        if ($availabilityData['min_guests'] && (!is_numeric($availabilityData['min_guests']) || $availabilityData['min_guests'] <= 0)) {
            return redirect()->to('admin/tours/availability/' . $tour['id'])->with('error', 'El número mínimo de huéspedes debe ser un valor positivo.');
        }

        // Iniciar una transacción
        $this->db->transBegin();

        // Actualizar la fecha de disponibilidad
        try {
            $this->db->table('tour_availability')->where('id', $availabilityId)->update($availabilityData);
            if ($this->db->affectedRows() === 0 && !$this->db->error()) {
                $this->db->transRollback();
                log_message('error', 'No se realizaron cambios en la fecha de disponibilidad.');
                return redirect()->to('admin/tours/availability/' . $tour['id'])->with('error', 'No se realizaron cambios en la fecha de disponibilidad.');
            }
        } catch (\Exception $e) {
            $this->db->transRollback();
            log_message('error', 'Excepción al actualizar fecha de disponibilidad: ' . $e->getMessage());
            return redirect()->to('admin/tours/availability/' . $tour['id'])->with('error', 'Error al actualizar la fecha de disponibilidad: ' . $e->getMessage());
        }

        // Registrar en audit_logs
        $this->db->table('audit_logs')->insert([
            'user_id' => $user['id'],
            'action' => 'Actualizó fecha de disponibilidad',
            'entity_type' => 'tour_availability',
            'entity_id' => $availabilityId,
            'details' => json_encode($availabilityData),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        // Confirmar la transacción
        $this->db->transCommit();

        return redirect()->to('admin/tours/availability/' . $tour['id'])->with('success', 'Fecha de disponibilidad actualizada exitosamente.');
    }

    // Eliminar una fecha de disponibilidad
    public function deleteAvailability($availabilityId)
    {
        $user = session('user');

        // Verificar si el usuario está autenticado
        if (!$user) {
            log_message('error', 'Intento de eliminar disponibilidad sin usuario autenticado.');
            return redirect()->to('/auth/login')->with('error', 'Debes iniciar sesión para acceder a esta página.');
        }

        // Verificar si el usuario tiene permisos
        if (!in_array($user['role'], ['super_admin', 'owner'])) {
            log_message('error', 'Usuario no autorizado intentó eliminar disponibilidad: ' . print_r($user, true));
            return redirect()->to('/')->with('error', 'No tienes permisos para acceder a esta página.');
        }

        // Obtener la disponibilidad
        $availability = $this->db->table('tour_availability')->where('id', $availabilityId)->get()->getRowArray();
        if (!$availability) {
            log_message('error', 'Fecha de disponibilidad no encontrada: ' . $availabilityId);
            return redirect()->to('/admin/tours')->with('error', 'Fecha de disponibilidad no encontrada.');
        }

        // Obtener el tour
        $tour = $this->tourModel->getById($availability['tour_id']);
        if (!$tour) {
            log_message('error', 'Tour no encontrado: ' . $availability['tour_id']);
            return redirect()->to('/admin/tours')->with('error', 'Tour no encontrado.');
        }

        // Si el usuario es owner, verificar que sea el propietario del tour
        if ($user['role'] === 'owner' && $tour['owner_id'] != $user['id']) {
            log_message('error', 'Usuario no autorizado intentó eliminar disponibilidad de tour que no le pertenece: ' . print_r($user, true));
            return redirect()->to('/admin/tours')->with('error', 'No tienes permisos para eliminar esta fecha de disponibilidad.');
        }

        // Verificar si el tour está en un estado que permita modificaciones
        if ($tour['approval_status'] === 'pending' && $user['role'] === 'owner') {
            return redirect()->to('/admin/tours')->with('error', 'No puedes eliminar disponibilidad mientras el tour está pendiente de aprobación.');
        }

        // Iniciar una transacción
        $this->db->transBegin();

        // Eliminar la fecha de disponibilidad
        try {
            $this->db->table('tour_availability')->where('id', $availabilityId)->delete();
            if ($this->db->affectedRows() === 0) {
                $this->db->transRollback();
                log_message('error', 'Error al eliminar fecha de disponibilidad.');
                return redirect()->to('admin/tours/availability/' . $tour['id'])->with('error', 'Error al eliminar la fecha de disponibilidad.');
            }
        } catch (\Exception $e) {
            $this->db->transRollback();
            log_message('error', 'Excepción al eliminar fecha de disponibilidad: ' . $e->getMessage());
            return redirect()->to('admin/tours/availability/' . $tour['id'])->with('error', 'Error al eliminar la fecha de disponibilidad: ' . $e->getMessage());
        }

        // Registrar en audit_logs
        $this->db->table('audit_logs')->insert([
            'user_id' => $user['id'],
            'action' => 'Eliminó disponibilidad',
            'entity_type' => 'tour_availability',
            'entity_id' => $availabilityId,
            'details' => json_encode($availability),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        // Confirmar la transacción
        $this->db->transCommit();

        return redirect()->to('admin/tours/availability/' . $tour['id'])->with('success', 'Fecha de disponibilidad eliminada exitosamente.');
    }




    // Mostrar la lista de comisiones (solo para super_admin)
    public function commissions()
    {
        $user = session('user');

        // Verificar permisos
        if ($user['role'] !== 'super_admin') {
            return redirect()->to('/admin/tours')->with('error', 'No tienes permiso para gestionar comisiones.');
        }

        // Obtener todas las comisiones
        $commissions = $this->db->table('commissions')
                                ->select('commissions.*, tours.title as tour_title')
                                ->join('tours', 'tours.id = commissions.tour_id', 'left')
                                ->where('tours.deleted_at', null)
                                ->get()
                                ->getResultArray();

        // Depurar comisiones obtenidas
        log_message('debug', 'Comisiones obtenidas: ' . print_r($commissions, true));

        $data['commissions'] = $commissions;
        $data['tours'] = $this->tourModel->where('deleted_at', null)->findAll(); // Para el formulario de agregar/editar

        return view('App\Modules\AdminTours\Views\tours\commissions', $data);
    }

    // Agregar una nueva comisión (solo para super_admin)
    public function addCommission()
    {
        $user = session('user');

        // Verificar permisos
        if ($user['role'] !== 'super_admin') {
            return redirect()->to('/admin/tours')->with('error', 'No tienes permiso para agregar comisiones.');
        }

        $data = [
            'tour_id' => $this->request->getPost('tour_id') ?: null, // Puede ser null para comisiones globales
            'type' => $this->request->getPost('type'),
            'fixed_amount' => $this->request->getPost('fixed_amount') ?: 0,
            'percentage' => $this->request->getPost('percentage') ?: 0,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        // Validar el tipo de comisión
        if (!in_array($data['type'], ['fixed', 'percentage', 'combined'])) {
            return redirect()->to('/admin/tours/commissions')->with('error', 'Tipo de comisión no válido.');
        }

        // Validar valores numéricos
        if (!is_numeric($data['fixed_amount']) || !is_numeric($data['percentage'])) {
            return redirect()->to('/admin/tours/commissions')->with('error', 'Los valores de la comisión deben ser numéricos.');
        }

        // Validar que no sean negativos
        if ($data['fixed_amount'] < 0 || $data['percentage'] < 0) {
            return redirect()->to('/admin/tours/commissions')->with('error', 'Los valores de la comisión no pueden ser negativos.');
        }

        // Verificar que el tour exista y no esté eliminado (si se especifica un tour_id)
        if ($data['tour_id']) {
            $tour = $this->tourModel->getById($data['tour_id']);
            if (!$tour || $tour['deleted_at']) {
                return redirect()->to('/admin/tours/commissions')->with('error', 'El tour seleccionado no es válido o está eliminado.');
            }
        }

        // Iniciar una transacción
        $this->db->transBegin();

        // Insertar la nueva comisión
        try {
            $this->db->table('commissions')->insert($data);
            if ($this->db->affectedRows() === 0) {
                $this->db->transRollback();
                log_message('error', 'Error al agregar la comisión.');
                return redirect()->to('/admin/tours/commissions')->with('error', 'Error al agregar la comisión.');
            }
        } catch (\Exception $e) {
            $this->db->transRollback();
            log_message('error', 'Excepción al agregar la comisión: ' . $e->getMessage());
            return redirect()->to('/admin/tours/commissions')->with('error', 'Error al agregar la comisión: ' . $e->getMessage());
        }

        // Registrar en audit_logs
        $this->db->table('audit_logs')->insert([
            'user_id' => $user['id'],
            'action' => 'Agregó comisión',
            'entity_type' => 'commission',
            'entity_id' => $this->db->insertID(),
            'details' => json_encode($data),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        // Confirmar la transacción
        $this->db->transCommit();

        log_message('debug', "Comisión agregada por super_admin ID {$user['id']}: " . print_r($data, true));
        return redirect()->to('/admin/tours/commissions')->with('success', 'Comisión agregada exitosamente.');
    }

    // Actualizar una comisión existente (solo para super_admin)
    public function updateCommission($id)
    {
        $user = session('user');

        // Verificar permisos
        if ($user['role'] !== 'super_admin') {
            return redirect()->to('/admin/tours')->with('error', 'No tienes permiso para actualizar comisiones.');
        }

        $commission = $this->db->table('commissions')->where('id', $id)->get()->getRowArray();
        if (!$commission) {
            return redirect()->to('/admin/tours/commissions')->with('error', 'Comisión no encontrada.');
        }

        $data = [
            'tour_id' => $this->request->getPost('tour_id') ?: null,
            'type' => $this->request->getPost('type'),
            'fixed_amount' => $this->request->getPost('fixed_amount') ?: 0,
            'percentage' => $this->request->getPost('percentage') ?: 0,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // Validar el tipo de comisión
        if (!in_array($data['type'], ['fixed', 'percentage', 'combined'])) {
            return redirect()->to('/admin/tours/commissions')->with('error', 'Tipo de comisión no válido.');
        }

        // Validar valores numéricos
        if (!is_numeric($data['fixed_amount']) || !is_numeric($data['percentage'])) {
            return redirect()->to('/admin/tours/commissions')->with('error', 'Los valores de la comisión deben ser numéricos.');
        }

        // Validar que no sean negativos
        if ($data['fixed_amount'] < 0 || $data['percentage'] < 0) {
            return redirect()->to('/admin/tours/commissions')->with('error', 'Los valores de la comisión no pueden ser negativos.');
        }

        // Verificar que el tour exista y no esté eliminado (si se especifica un tour_id)
        if ($data['tour_id']) {
            $tour = $this->tourModel->getById($data['tour_id']);
            if (!$tour || $tour['deleted_at']) {
                return redirect()->to('/admin/tours/commissions')->with('error', 'El tour seleccionado no es válido o está eliminado.');
            }
        }

        // Iniciar una transacción
        $this->db->transBegin();

        // Actualizar la comisión
        try {
            $this->db->table('commissions')->where('id', $id)->update($data);
            if ($this->db->affectedRows() === 0 && !$this->db->error()) {
                $this->db->transRollback();
                log_message('error', 'No se realizaron cambios en la comisión.');
                return redirect()->to('/admin/tours/commissions')->with('error', 'No se realizaron cambios en la comisión.');
            }
        } catch (\Exception $e) {
            $this->db->transRollback();
            log_message('error', 'Excepción al actualizar la comisión: ' . $e->getMessage());
            return redirect()->to('/admin/tours/commissions')->with('error', 'Error al actualizar la comisión: ' . $e->getMessage());
        }

        // Registrar en audit_logs
        $this->db->table('audit_logs')->insert([
            'user_id' => $user['id'],
            'action' => 'Actualizó comisión',
            'entity_type' => 'commission',
            'entity_id' => $id,
            'details' => json_encode($data),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        // Confirmar la transacción
        $this->db->transCommit();

        log_message('debug', "Comisión ID $id actualizada por super_admin ID {$user['id']}: " . print_r($data, true));
        return redirect()->to('/admin/tours/commissions')->with('success', 'Comisión actualizada exitosamente.');
    }

    // Eliminar una comisión (solo para super_admin)
    public function deleteCommission($id)
    {
        $user = session('user');

        // Verificar permisos
        if ($user['role'] !== 'super_admin') {
            return redirect()->to('/admin/tours')->with('error', 'No tienes permiso para eliminar comisiones.');
        }

        $commission = $this->db->table('commissions')->where('id', $id)->get()->getRowArray();
        if (!$commission) {
            return redirect()->to('/admin/tours/commissions')->with('error', 'Comisión no encontrada.');
        }

        // Iniciar una transacción
        $this->db->transBegin();

        // Eliminar la comisión
        try {
            $this->db->table('commissions')->where('id', $id)->delete();
            if ($this->db->affectedRows() === 0) {
                $this->db->transRollback();
                log_message('error', 'Error al eliminar la comisión.');
                return redirect()->to('/admin/tours/commissions')->with('error', 'Error al eliminar la comisión.');
            }
        } catch (\Exception $e) {
            $this->db->transRollback();
            log_message('error', 'Excepción al eliminar la comisión: ' . $e->getMessage());
            return redirect()->to('/admin/tours/commissions')->with('error', 'Error al eliminar la comisión: ' . $e->getMessage());
        }

        // Registrar en audit_logs
        $this->db->table('audit_logs')->insert([
            'user_id' => $user['id'],
            'action' => 'Eliminó comisión',
            'entity_type' => 'commission',
            'entity_id' => $id,
            'details' => json_encode($commission),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        // Confirmar la transacción
        $this->db->transCommit();

        log_message('debug', "Comisión ID $id eliminada por super_admin ID {$user['id']}");
        return redirect()->to('/admin/tours/commissions')->with('success', 'Comisión eliminada exitosamente.');
    }

    /**
     * Muestra todas las reservas de un owner.
     *
     * @return string
     */
    public function ownerBookings()
    {
        $user = session('user');

        // Verificar si el usuario está autenticado
        if (!$user) {
            log_message('error', 'Intento de acceder a las reservas sin usuario autenticado.');
            return redirect()->to('/auth/login')->with('error', 'Debes iniciar sesión para acceder a esta página.');
        }

        // Verificar si el usuario tiene permisos
        if ($user['role'] !== 'super_admin') {
            log_message('error', 'Usuario no autorizado intentó acceder a las reservas: ' . print_r($user, true));
            return redirect()->to('/')->with('error', 'No tienes permisos para acceder a esta página.');
        }

        // Obtener todas las reservas del owner usando el modelo
        $bookings = $this->tourModel->getAllBookingsForOwner($user['id']);

        $data = [
            'bookings' => $bookings,
            'user' => $user,
        ];

        return view('App\Modules\AdminTours\Views\tours\owner_bookings', $data);
    }

    
    

}   