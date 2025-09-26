<?php
namespace App\Modules\Tours\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Controller;
use App\Modules\Tours\Models\TourModel;
use App\Modules\Tours\Models\TourMetaModel;
use App\Modules\Tours\Models\TourAvailabilityModel;
use App\Modules\Tours\Models\TourCategoryModel;
use App\Modules\Tours\Models\LocationModel;
use App\Modules\Commissions\Controllers\SaleController;
use App\Modules\AdminTours\Models\BookingsAdminModel;

class Tours extends BaseController
{
    protected $tourModel;
    protected $tourMetaModel;
    protected $tourAvailabilityModel;
    protected $tourCategoryModel;
    protected $locationModel;

    public function __construct()
    {
        helper(['text','form', 'url']);
        $this->tourModel = new TourModel();
        $this->tourMetaModel = new TourMetaModel();
        $this->tourAvailabilityModel = new TourAvailabilityModel();
        $this->tourCategoryModel = new TourCategoryModel();
        $this->locationModel = new LocationModel();
    }

    public function AdminIndex()
	{
        return view('App\Modules\Tours\Views\tour-grid');
		//return view('index');
	}

    public function index()
    {
        $search = $this->request->getGet('search');
        $selectedCategories = $this->request->getGet('category') ? explode(',', $this->request->getGet('category')) : [];

        $categories = $this->tourCategoryModel->findAll();
        $categoryCounts = [];
        foreach ($categories as $category) {
            $categoryCounts[$category['id']] = $this->tourModel->countToursByCategory($category['id']);
        }

        $data = [
            'categories'         => $categories,
            'categoryCounts'     => $categoryCounts,
            'search'             => $search,
            'selectedCategories' => $selectedCategories,
        ];



        $this->data['assets']['css'][] = 'slick';
        $this->data['assets']['css'][] = 'rangeslider';
        $this->data['assets']['css'][] = 'fancybox';

        $this->data['assets']['js'][]  = 'slick';
        $this->data['assets']['js'][]  = 'fancybox';
        $this->data['assets']['js'][]  = 'rangeslider';
        
        return $this->render('App\Modules\Tours\Views\tour-grid', $data);
    }

    /**
     * Procesa la solicitud AJAX de los filtros y devuelve JSON
     * con el HTML de la vista solicitada (grid, list) o los datos del mapa.
     */
    public function filter()
    {
        $viewType = $this->request->getGet('view') ?: 'grid';

        $filters = [
            'search'     => $this->request->getGet('search'),
            'price_min'  => $this->request->getGet('price_min'),
            'price_max'  => $this->request->getGet('price_max'),
            'categories' => $this->request->getGet('categories') ? explode(',', $this->request->getGet('categories')) : [],
        ];
        
        if ($viewType === 'map') {
            $tours = $this->tourModel->getFilteredTours($filters, false); // No paginar
            return $this->response->setJSON(['success' => true, 'tours' => $tours]);
        }

        $tours = $this->tourModel->getFilteredTours($filters, true); // Paginar
        
        $data = [
            'tours' => $tours,
            'pager' => $this->tourModel->pager
        ];

        $partialView = 'App\Modules\Tours\Views\list-grid-partial';
        if ($viewType === 'list') {
            $partialView = 'App\Modules\Tours\Views\list-list-partial';
        }
        
        $response = [
            'tours_html'      => view($partialView, $data),
            'pagination_html' => $this->tourModel->pager->links('tours', 'default_full'),
            'total_tours'     => $this->tourModel->pager->getTotal('tours')
        ];
        
        return $this->response->setJSON($response);
    }

    /**
     * Muestra los detalles de un tour específico.
     */
    public function detail($slug = null)
    {
        //$tour = $this->tourModel->getTourDetails($id);
        $tour = $this->tourModel->getTourBySlug($slug);

        if (!$tour) {
            //return redirect()->to('/tours')->with('error', 'Tour no encontrado o no está publicado.');
            throw new \CodeIgniter\Exceptions\PageNotFoundException('No se pudo encontrar el tour: ' . esc($slug));
        }

        $availabilityRanges = $this->tourAvailabilityModel
            ->where('tour_id', $tour['id'])
            ->where('start_date >=', date('Y-m-d'))
            ->where('is_available', 1)
            ->findAll();
        
        $availableDates = [];
        foreach ($availabilityRanges as $range) {
            $current = new \DateTime($range['start_date']);
            $end = new \DateTime($range['end_date']);
            while ($current <= $end) {
                $availableDates[] = $current->format('Y-m-d');
                $current->modify('+1 day');
            }
        }

        $data = [
            'tour' => $tour,
            'tourMeta'       => $this->tourMetaModel->where('tour_id', $tour['id'])->first() ?? [],
            'availableDates' => $availableDates
        ];

        // PASO 3: Solicita los assets que esta página necesita
        $this->data['assets']['css'][] = 'slick';
        $this->data['assets']['css'][] = 'fancybox';
        $this->data['assets']['js'][]  = 'slick';
        $this->data['assets']['js'][]  = 'fancybox';

        $this->layoutOptions['seo_title'] = $tour['seo_title'] ?: $tour['title'];
        $this->layoutOptions['seo_description'] = $tour['seo_description'] ?: ellipsize($tour['short_desc'], 150);

        // PASO 4: Usa el método render() de BaseController para cargar la vista
        return $this->render('App\Modules\Tours\Views\tour-detail', $data);
    }
    
    /**
     * Muestra el formulario de reserva y prepara las fechas disponibles para el calendario.
     */
    public function book($id)
    {
        $tour = $this->tourModel->where('status', 'published')->find($id);
        if (!$tour) {
            return redirect()->to('/tours')->with('error', 'Tour no encontrado o no está publicado.');
        }

        // 1. Obtener los rangos de disponibilidad
        $availabilityRanges = $this->tourAvailabilityModel->where('tour_id', $id)
                                                           ->where('start_date >=', date('Y-m-d'))
                                                           ->where('is_available', 1)
                                                           ->findAll();
        
        // 2. Procesar los rangos para crear una lista de fechas individuales permitidas
        $availableDates = [];
        foreach ($availabilityRanges as $range) {
            $current = new \DateTime($range['start_date']);
            $end = new \DateTime($range['end_date']);
            while ($current <= $end) {
                $availableDates[] = $current->format('Y-m-d');
                $current->modify('+1 day');
            }
        }

        $data = [
            'tour' => $tour,
            'tourMeta' => $this->tourMetaModel->where('tour_id', $id)->first() ?? [],
            'availableDates' => $availableDates // 3. Pasar la lista de fechas a la vista
        ];

        return view('App\Modules\Tours\Views\booking', $data);
    }

    public function saveBooking($id)
    {
        // 1. Encontrar el tour, igual que antes
        $tour = $this->tourModel->where('status', 'published')->find($id);
        if (!$tour) {
            return redirect()->to('/tours')->with('error', 'Tour no encontrado o no está publicado.');
        }

        // 2. Definir las reglas de validación para los datos del formulario
        $rules = [
            'start_date'       => 'required|valid_date[Y-m-d]',
            'number_of_people' => 'required|integer|greater_than[0]',
            'customer_name'    => 'required|string|max_length[255]',
            'customer_email'   => 'required|valid_email',
            'customer_phone'   => 'permit_empty|string|max_length[20]',
        ];

        // 3. Ejecutar la validación
        if (!$this->validate($rules)) {
            // Si la validación falla, redirige al usuario de vuelta al formulario con los errores
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 4. Obtener los datos validados y sanitizados
        $validatedData = $this->validator->getValidated();
        $bookingDate = $validatedData['start_date'];

        // 5. Verificar la disponibilidad de la fecha (Lógica de negocio clave)
        $isAvailable = $this->tourAvailabilityModel
                            ->where('tour_id', $id)
                            ->where('start_date <=', $bookingDate)
                            ->where('end_date >=', $bookingDate)
                            ->where('is_available', 1)
                            ->first();

        if (!$isAvailable) {
            return redirect()->back()->withInput()->with('error', 'La fecha seleccionada no está disponible para este tour.');
        }

        // 6. Iniciar la transacción en la base de datos
        $this->db->transStart();

        // 7. Preparar y guardar los datos de la reserva
        $totalPrice = $tour['price'] * $validatedData['number_of_people'];
        $bookingData = [
            'vendor_id'    => $tour['owner_id'],
            'customer_id'  => session('user')['id'] ?? null,
            'object_id'    => $id,
            'object_model' => 'tour',
            'start_date'   => $bookingDate,
            'end_date'     => $this->request->getPost('end_date') ?: $bookingDate, // Usar fecha de inicio si end_date está vacío
            'total'        => $totalPrice,
            'total_guests' => $validatedData['number_of_people'],
            'status'       => 'confirmed',
            'first_name'   => $validatedData['customer_name'],
            'last_name'    => '',
            'email'        => $validatedData['customer_email'],
            'phone'        => $validatedData['customer_phone'],
        ];

        $bookingsModel = new BookingsAdminModel();
        $bookingId = $bookingsModel->insert($bookingData);

        // 8. Procesar la venta (si la reserva se creó correctamente)
        if ($bookingId) {
            $saleDataForController = [
                'tour_id'     => $id,
                'sale_amount' => $totalPrice,
            ];
            // Es mejor pasar los datos directamente en lugar de modificar el servicio request global
            $saleController = new SaleController();
            $saleController->processSale($saleDataForController);
        }

        // 9. Completar la transacción
        $this->db->transComplete();

        // 10. Verificar si la transacción fue exitosa
        if ($this->db->transStatus() === false || !$bookingId) {
            // La transacción falló, se hizo un rollback automático
            return redirect()->back()->withInput()->with('error', 'Hubo un problema al procesar tu reserva. Por favor, intenta de nuevo.');
        }

        // Si todo fue exitoso, redirigir a la página de confirmación
        return redirect()->to('/tours/booking-confirmation/' . $bookingId)->with('success', 'Reserva realizada exitosamente.');
    }
    public function confirmation($bookingId)
    {
        $bookingsModel = new BookingsAdminModel();
        $booking = $bookingsModel->find($bookingId);

        if (!$booking) {
            return redirect()->to('/tours')->with('error', 'Reserva no encontrada.');
        }

        $tour = $this->tourModel->find($booking['object_id']);
        
        $data = [
            'booking' => $booking,
            'tour' => $tour,
        ];

        return view('App\Modules\Tours\Views\booking_confirmation', $data);
    }

}
