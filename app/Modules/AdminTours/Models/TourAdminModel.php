<?php
namespace App\Modules\AdminTours\Models;

use App\Models\TourModel as BaseTourModel;
use App\Models\TourTranslationsModel;
use App\Services\CurrencyService;  //Servicio de cambio de moneda
use App\Modules\OwnerPanel\Models\OwnerModel; //Modelo de propietarios


class TourAdminModel extends BaseTourModel
{
    // Tus propiedades de tablas relacionadas se mantienen
    protected $translationTable = 'tour_translations';
    protected $metaTable = 'tour_meta';
    protected $termTable = 'tour_terms';
    protected $termsTable = 'terms';
    protected $bookingsTable = 'bookings';
    protected $reviewsTable = 'reviews';
    protected $wishlistTable = 'user_wishlist';



    // --- MÉTODOS DE LISTADO (Refactorizados) ---

    public function getAllToursWithDetails()
    {
        return $this->select('tours.*, tour_categories.name as category_name, users.name as owner_name')
                    ->join('tour_categories', 'tour_categories.id = tours.category_id', 'left')
                    ->join('users', 'users.id = tours.owner_id', 'left')
                    ->where('tours.deleted_at IS NULL')
                    ->orderBy('tours.created_at', 'DESC')
                    ->paginate(10);
    }

    public function getToursByOwner($ownerId)
    {
        return $this->select('tours.*, tour_categories.name as category_name')
                    ->join('tour_categories', 'tour_categories.id = tours.category_id', 'left')
                    ->where('tours.owner_id', $ownerId)
                    ->where('tours.deleted_at IS NULL')
                    ->orderBy('tours.created_at', 'DESC')
                    ->paginate(10);
    }
    
    public function getDeletedToursWithDetails()
    {
        return $this->select('tours.*, tour_categories.name as category_name, users.name as owner_name')
                    ->join('tour_categories', 'tour_categories.id = tours.category_id', 'left')
                    ->join('users', 'users.id = tours.owner_id', 'left')
                    ->onlyDeleted()
                    ->orderBy('tours.deleted_at', 'DESC')
                    ->paginate(10);
    }


/**
 * Crea un nuevo tour con todos sus detalles, incluyendo la subida de archivos,
 * redimensionamiento de imágenes y conversión de moneda.
 *
 * @param array $postData Datos del formulario ($_POST)
 * @param array $files    Archivos subidos ($_FILES)
 * @param array $user     Datos del usuario en sesión
 * @return int|null       El ID del tour creado, o null si falla.
 */
public function createTourWithDetails(array $postData, array $files, array $user): ?int
{
    // Cargar helpers necesarios. (Asegúrate de que 'text' esté en app/Config/Autoload.php)
    helper(['Imagenredimension', 'text']);

    $this->db->transStart();

    try {
        // --- 1. OBTENER LA MONEDA DEL OWNER ---
        $ownerModel = new OwnerModel();
        $ownerProfile = $ownerModel->where('user_id', $user['id'])->first();
        // Si no tiene perfil o moneda, se usa USD por defecto.
        $ownerCurrency = $ownerProfile['currency'] ?? 'USD';

        // --- 2. CONVERSIÓN DE MONEDA ---
        $currencyService = new CurrencyService();
        $ownerPrice = (float)($postData['owner_price'] ?? 0);
        $priceBase = null;

        if ($ownerCurrency === 'USD') {
            $priceBase = $ownerPrice;
        } else {
            // Usamos el servicio para obtener la tasa de conversión a USD
            $rate = $currencyService->getConversionRate($ownerCurrency, 'USD');
            if ($rate === null) {
                // Si la API falla, detenemos la operación de forma segura.
                throw new \Exception("No se pudo obtener la tasa de cambio para {$ownerCurrency}.");
            }
            $priceBase = $ownerPrice / $rate; // Tasa de venta del dólar en DOP
        }

        // --- 3. PROCESAR IMÁGENES USANDO EL HELPER ---
        $imageName = null;
        $imageFile = $files['image'] ?? null;
        if ($imageFile && $imageFile->isValid()) {
            $imageName = processAndResizeImage($imageFile, 'tours'); 
        }

        $galleryImageNames = [];
        $galleryFiles = $files['gallery'] ?? [];
        foreach ($galleryFiles as $file) {
            if ($processedName = processAndResizeImage($file, 'tours')) {
                $galleryImageNames[] = $processedName;
            }
        }
        
        // --- 4. PREPARAR Y GUARDAR DATOS ---
        $tourData = [
            'title'          => $postData['title'],
            'slug'           => mb_url_title($postData['title'], '-', true), // Usamos la función nativa más robusta
            'category_id'    => $postData['category_id'],
            'location_id'    => $postData['location_id'],
            'short_desc'     => $postData['short_desc'] ?? null,
            'content'        => $postData['content'] ?? null,
            'video'          => $postData['video'] ?? null,
            'duration_value' => $postData['duration_value'] ?? null,
            'duration_unit'  => $postData['duration_unit'] ?? 'hour',
            
            // Campos de moneda
            'owner_price'    => $ownerPrice,
            'owner_currency' => $ownerCurrency,
            'price_base'     => round($priceBase, 2), // Guardamos el precio en USD redondeado
            'sale_price'     => !empty($postData['sale_price']) ? (float)$postData['sale_price'] : null, // Asumimos que sale_price también se ingresa en la moneda del owner

            'address'        => $postData['address'] ?? null,
            'map_lat'        => $postData['map_lat'] ?? null,
            'map_lng'        => $postData['map_lng'] ?? null,
            'map_zoom'       => $postData['map_zoom'] ?? 12,
            'status'         => $postData['status'] ?? 'draft',
            'is_featured'    => $postData['is_featured'] ?? 0,
            'owner_id'       => $user['id'],
            'image_id'       => $imageName,
            'gallery'        => json_encode($galleryImageNames),
            'include'        => json_encode($postData['include'] ?? []),
            'exclude'        => json_encode($postData['exclude'] ?? []),
            'itinerary'      => json_encode($postData['itinerary'] ?? []),
            'faqs'           => json_encode($postData['faqs'] ?? []),
            'seo_title'      => $postData['seo_title'] ?? null,
            'seo_description'=> $postData['seo_description'] ?? null,
        ];

        $this->insert($tourData);
        $tourId = $this->getInsertID();

        if (!$tourId) {
            throw new \Exception('Error al crear el tour principal en la base de datos.');
        }

        // ... después de la validación if (!$tourId) { ... }

        // 5. PREPARAR Y GUARDAR DATOS EN tour_meta
        $tourMetaModel = new \App\Modules\AdminTours\Models\TourMetaAdminModel();
        $metaData = [
            'tour_id'             => $tourId,
            'enable_person_types' => !empty($postData['enable_person_types']) ? 1 : 0,
            'person_types'        => json_encode($postData['person_types'] ?? []),
            
            // Aquí hacemos lo mismo para los otros campos que también son arrays
            'extra_price'         => json_encode($postData['extra_price'] ?? []),
            'service_fees'        => json_encode($postData['service_fees'] ?? []),
            'discount_by_people'  => json_encode($postData['discount_by_people'] ?? [])
        ];
        $tourMetaModel->insert($metaData);
        // --- FIN: CÓDIGO A AÑADIR ---

        
        $this->db->transComplete();
        
        if ($this->db->transStatus() === false) {
            return null;
        }

        return $tourId;

    } catch (\Exception $e) {
        $this->db->transRollback();
        log_message('error', '[TourAdminModel::createTourWithDetails] ' . $e->getMessage());
        return null;
    }
}


public function updateTourWithDetails($tourId, array $postData, array $files, array $user)
{
    helper(['Imagenredimension','Slug']);

    $this->db->transBegin();
    try {
        $uploadPath = ROOTPATH . 'public/uploads/tours/';
        $currentTour = $this->find($tourId);
        if (!$currentTour) {
            throw new \Exception('Tour no encontrado para actualizar.');
        }

        // --- MANEJAR IMAGEN PRINCIPAL ---
        $imageFile = $files['image'] ?? null;
        $imageName = $currentTour['image_id']; // Mantener la imagen actual por defecto
        if ($imageFile && $imageFile->isValid()) {
            // Si se sube una nueva imagen, procesarla y eliminar la antigua
            if (!empty($currentTour['image_id'])) {
                $thumbPath = $uploadPath . pathinfo($currentTour['image_id'], PATHINFO_FILENAME) . '_thumb.' . pathinfo($currentTour['image_id'], PATHINFO_EXTENSION);
                if (file_exists($uploadPath . $currentTour['image_id'])) unlink($uploadPath . $currentTour['image_id']);
                if (file_exists($thumbPath)) unlink($thumbPath);
            }
            $imageName = processAndResizeImage($imageFile, 'tours');
        }

        // --- MANEJAR GALERÍA ---
        $existingGallery = json_decode($currentTour['gallery'] ?? '[]', true);
        $newGalleryFiles = $files['gallery'] ?? [];
        foreach ($newGalleryFiles as $file) {
            if ($processedName = processAndResizeImage($file, 'tours')) {
                $existingGallery[] = $processedName;
            }
        }
        
        // --- PREPARAR DATOS PARA LA ACTUALIZACIÓN ---
        $tourData = [
            'title'         => $postData['title'],
            //'slug'          => generate_slug($postData['title']), // Actualizamos el slug también
            'category_id'   => $postData['category_id'],
            'location_id'   => $postData['location_id'],
            'price'         => (float)($postData['price'] ?? 0),
            'sale_price'    => !empty($postData['sale_price']) ? (float)$postData['sale_price'] : null,
            'short_desc'    => $postData['short_desc'] ?? null,
            'content'       => $postData['content'] ?? null,
            'video'         => $postData['video'] ?? null,
            'duration_value' => $postData['duration_value'] ?? null,
            'duration_unit'  => $postData['duration_unit'] ?? 'hour',
            'address'       => $postData['address'] ?? null,
            'map_lat'       => $postData['map_lat'] ?? null,
            'map_lng'       => $postData['map_lng'] ?? null,
            'map_zoom'      => $postData['map_zoom'] ?? null,
            'updated_by'    => $user['id'],
            
            // CORRECCIÓN: Asegurarse de que TODOS los arrays se conviertan a JSON
            'include'       => json_encode($postData['include'] ?? []),
            'exclude'       => json_encode($postData['exclude'] ?? []),
            'itinerary'     => json_encode($postData['itinerary'] ?? []),
            'faqs'          => json_encode($postData['faqs'] ?? []),
            'gallery'       => json_encode($existingGallery),
            'image_id'      => $imageName,
        ];
        
        // --- ACTUALIZAR BASE DE DATOS Y FINALIZAR ---
        $this->update($tourId, $tourData);

        // 6. ACTUALIZAR O CREAR DATOS EN tour_meta
        $tourMetaModel = new \App\Modules\AdminTours\Models\TourMetaAdminModel();
        $metaData = [
            'tour_id'             => $tourId,
            'enable_person_types' => !empty($postData['enable_person_types']) ? 1 : 0,
            'person_types'        => json_encode($postData['person_types'] ?? []),
            
            // Aquí hacemos lo mismo para los otros campos que también son arrays
            'extra_price'         => json_encode($postData['extra_price'] ?? []),
            'service_fees'        => json_encode($postData['service_fees'] ?? []),
            'discount_by_people'  => json_encode($postData['discount_by_people'] ?? [])
        ];

        // Buscar si ya existe un registro meta para este tour
        $existingMeta = $tourMetaModel->where('tour_id', $tourId)->first();

        if ($existingMeta) {
            // Si existe, lo actualizamos
            $tourMetaModel->update($existingMeta['id'], $metaData);
        } else {
            // Si no existe (caso raro para un tour que se está actualizando), lo insertamos
            $tourMetaModel->insert($metaData);
        }
        
        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            return false;
        }
        return true;

    } catch (\Exception $e) {
        $this->db->transRollback();
        log_message('error', '[TourAdminModel::updateTourWithDetails] ' . $e->getMessage());
        return false;
    }
}

   
    // --- MÉTODOS DE SOPORTE ---
    
    public function getDeleted() { return $this->onlyDeleted()->findAll(); }
    public function getMeta($tourId) { return $this->db->table($this->metaTable)->where('tour_id', $tourId)->get()->getRowArray(); }
    public function getTerms($tourId) { return $this->db->table($this->termTable)->select('terms.*')->join($this->termsTable, 'terms.id = tour_terms.term_id', 'left')->where('tour_terms.tour_id', $tourId)->where('terms.deleted_at', null)->get()->getResultArray(); }
    public function getBookings($tourId) { return $this->db->table($this->bookingsTable)->where('object_id', $tourId)->where('object_model', 'tour')->where('deleted_at', null)->get()->getResultArray(); }
    public function getReviews($tourId) { return $this->db->table($this->reviewsTable)->where('object_id', $tourId)->where('object_model', 'tour')->where('deleted_at', null)->get()->getResultArray(); }
    public function isInWishlist($tourId, $userId) { return $this->db->table($this->wishlistTable)->where('object_id', $tourId)->where('object_model', 'tour')->where('user_id', $userId)->countAllResults() > 0; }
    public function getAllBookingsForOwner($ownerId) { return $this->db->table($this->bookingsTable)->select('bookings.*, tours.title as tour_title')->join('tours', 'tours.id = bookings.object_id')->where('bookings.object_model', 'tour')->where('bookings.deleted_at', null)->where('tours.owner_id', $ownerId)->where('tours.deleted_at', null)->get()->getResultArray(); }
   

    public function getDataForEditPage($tourId, $user)
    {
        // 1. Obtener el tour principal
        $tour = $this->find($tourId);
        if (!$tour) {
            return null;
        }

        // 2. Cargar los modelos necesarios
        $categoryModel = new \App\Modules\AdminTours\Models\TourCategoryModel();
        $locationModel = new \App\Modules\AdminTours\Models\LocationModel();
        $termsModel = new \App\Modules\AdminTours\Models\TermsAdminModel();

        // 3. Obtener todos los datos relacionados
        $selectedTerms = array_column($this->getTerms($tourId), 'id');

        // 4. Construir el array de datos final
        $data = [
            'tour'             => $tour,
            'categories'       => $categoryModel->findAll(),
            'locations'        => $locationModel->findAll(),
            'tourMeta'         => $this->getMeta($tourId) ?? [],
            'availabilityData' => $this->db->table('tour_availability')->where('tour_id', $tourId)->get()->getResultArray(),
             // Usamos el método que incluye el nombre del atributo
            'terms'            => $termsModel->getTermsWithAttributeName(),
            'selectedTerms'    => $selectedTerms,
            'bookings'         => $this->getBookings($tourId),
            'reviews'          => $this->getReviews($tourId),
            'isInWishlist'     => $this->isInWishlist($tourId, $user['id']),
            'user'             => $user,
        ];

        return $data;
    }


    /**
     * Elimina una imagen específica de la galería de un tour por su nombre de archivo.
     *
     * @param int    $tourId    El ID del tour.
     * @param string $imageName El nombre del archivo a eliminar.
     * @return bool             True si tuvo éxito, False si falló.
     */
    public function removeImageFromGallery(int $tourId, string $imageName): bool
    {
        $tour = $this->find($tourId);
        if (!$tour || empty($tour['gallery'])) {
            return false;
        }

        $gallery = json_decode($tour['gallery'], true);

        // Buscamos la imagen por su valor (nombre) en el array
        $key = array_search($imageName, $gallery);

        if ($key === false) {
            return false; // La imagen no se encontró en la lista
        }

        // Eliminamos la imagen del array
        unset($gallery[$key]);

        // Usamos una transacción para garantizar la integridad
        $this->db->transStart();
        $this->update($tourId, ['gallery' => json_encode(array_values($gallery))]);
        $this->db->transComplete();

        // Si la transacción falló, devuelve false
        if ($this->db->transStatus() === false) {
            return false;
        }

        // Si todo salió bien, ahora borramos los archivos físicos
        $uploadPath = ROOTPATH . 'public/uploads/tours/';
        $thumbName = pathinfo($imageName, PATHINFO_FILENAME) . '_thumb.' . pathinfo($imageName, PATHINFO_EXTENSION);

        if (file_exists($uploadPath . $imageName)) {
            unlink($uploadPath . $imageName);
        }
        if (file_exists($uploadPath . $thumbName)) {
            unlink($uploadPath . $thumbName);
        }

        return true; // ¡Éxito!
        }
}
