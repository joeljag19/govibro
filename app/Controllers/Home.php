<?php
namespace App\Controllers;
use App\Controllers\BaseController;


use CodeIgniter\Controller;

class Home extends BaseController
{

    // public function dashboard()
    // {
    //     // Aquí se pueden definir los datos para el dashboard
    //     $data = [
    //         'title' => 'Dashboard',
    //     ];

    //     return view('dashboard', $data);
    // }

    public function soon()
    {
        // Aquí se pueden definir los datos para la página "Acerca de"
        $data = [
            'title' => 'About Us',
        ];

        return view('soon', $data);
    }

    // public function index()
    // {
    //     // Datos para el carrusel de banners
    //     // Aquí se definirían los datos para el carrusel de imágenes del banner
    //     $banners = [];

    //     // Datos para las ofertas
    //     // Aquí se definirían los datos para la sección de ofertas
    //     $offers = [];

    //     // Datos para los hoteles
    //     // Aquí se definirían los datos para la sección de hoteles
    //     $hotels = [];

    //     // Datos para los destinos
    //     // Aquí se definirían los datos para la sección de destinos
    //     $locations = [];

    //     // Datos para los tours
    //     // Aquí se definirían los datos para la sección de tours
    //     $tours = [];

    //     // Datos para los espacios
    //     // Aquí se definirían los datos para la sección de espacios
    //     $spaces = [];

    //     // Datos para los coches
    //     // Aquí se definirían los datos para la sección de coches
    //     $cars = [];

    //     // Datos para los eventos
    //     // Aquí se definirían los datos para la sección de eventos
    //     $events = [];

    //     // Datos para los barcos
    //     // Aquí se definirían los datos para la sección de barcos
    //     $boats = [];

    //     // Datos para las noticias
    //     // Aquí se definirían los datos para la sección de noticias
    //     $news = [];

    //     // Datos para la llamada a la acción
    //     // Aquí se definirían los datos para la sección de llamada a la acción
    //     $call_to_action = [];

    //     // Datos para los testimonios
    //     // Aquí se definirían los datos para la sección de testimonios
    //     $testimonials = [];

    //     // Datos para los títulos y subtítulos de las secciones
    //     // Aquí se definirían los títulos y subtítulos para cada sección
    //     $hotel_section = [];
    //     $location_section = [];
    //     $tour_section = [];
    //     $space_section = [];
    //     $car_section = [];
    //     $event_section = [];
    //     $boat_section = [];
    //     $news_section = [];
    //     $testimonial_section = [];

    //     // Pasar los datos a la vista
    //     $data = [
    //         'title' => 'Home Page',
    //         'banners' => $banners,
    //         'offers' => $offers,
    //         'hotels' => $hotels,
    //         'locations' => $locations,
    //         'tours' => $tours,
    //         'spaces' => $spaces,
    //         'cars' => $cars,
    //         'events' => $events,
    //         'boats' => $boats,
    //         'news' => $news,
    //         'call_to_action' => $call_to_action,
    //         'testimonials' => $testimonials,
    //         'hotel_section' => $hotel_section,
    //         'location_section' => $location_section,
    //         'tour_section' => $tour_section,
    //         'space_section' => $space_section,
    //         'car_section' => $car_section,
    //         'event_section' => $event_section,
    //         'boat_section' => $boat_section,
    //         'news_section' => $news_section,
    //         'testimonial_section' => $testimonial_section,
    //     ];

    //     return view('pages/index', $data);
    // }

	public function Index(): string
{
		// $this->data['page'] = 'index-4'; 
		return $this->render('index-6', $this->data);
    }
	public function AdminIndex()
	{
		return view('index');
	}
	public function Index2()
	{
		return view('index-2');
	}
	public function Index3()
	{
		return view('index-3');
	}
	public function Index4()
	{
		return view('index-4');
	}
	public function Index5()
	{
		return view('index-5');
	}
	public function Index6()
	{
		return view('index-6');
	}
	public function AddFlight()
	{
		return view('add-flight');
	}
	public function FlightGrid()
	{
		return view('flight-grid');
	}
	public function FlightList()
	{
		return view('flight-list');
	}
	public function FlightDetails()
	{
		return view('flight-details');
	}
	public function FlightBookingConfirmation()
	{
		return view('flight-booking-confirmation');
	}
	public function HotelGrid()
	{
		return view('hotel-grid');
	}
	public function HotelList()
	{
		return view('hotel-list');
	}
	public function HotelMap()
	{
		return view('hotel-map');
	}
	public function HotelDetails()
	{
		return view('hotel-details');
	}
	public function BookingConfirmation()
	{
		return view('booking-confirmation');
	}
	public function AddHotel()
	{
		return view('add-hotel');
	}
	public function CarGrid()
	{
		return view('car-grid');
	}
	public function CarList()
	{
		return view('car-list');
	}
	public function CarMap()
	{
		return view('car-map');
	}
	public function CarDetails()
	{
		return view('car-details');
	}
	public function CarBookingConfirmation()
	{
		return view('car-booking-confirmation');
	}
	public function AddCar()
	{
		return view('add-car');
	}
	public function CruiseGrid()
	{
		return view('cruise-grid');
	}
	public function CruiseList()
	{
		return view('cruise-list');
	}
	public function CruiseMap()
	{
		return view('cruise-map');
	}
	public function CruiseDetails()
	{
		return view('cruise-details');
	}
	public function CruiseBookingConfirmation()
	{
		return view('cruise-booking-confirmation');
	}
	public function AddCruise()
	{
		return view('add-cruise');
	}
	public function TourGrid()
	{
		return view('tour-grid');
	}
	public function TourList()
	{
		return view('tour-list');
	}
	public function TourMap()
	{
		return view('tour-map');
	}
	public function TourDetails()
	{
		return view('tour-details');
	}
	public function TourBookingConfirmation()
	{
		return view('tour-booking-confirmation');
	}
	public function AddTour()
	{
		return view('add-tour');
	}
	public function AboutUs()
	{
		return view('about-us');
	}
	public function Gallery()
	{
		return view('gallery');
	}
	public function Testimonial()
	{
		return view('testimonial');
	}
	public function Faq()
	{
		return view('faq');
	}
	public function PricingPlan()
	{
		return view('pricing-plan');
	}
	public function Team()
	{
		return view('team');
	}
	public function Invoices()
	{
		return view('invoices');
	}
	public function BlogGrid()
	{
		return view('blog-grid');
	}
	public function BlogList()
	{
		return view('blog-list');
	}
	public function BlogDetails()
	{
		return view('blog-details');
	}
	public function ContactUs()
	{
		return view('contact-us');
	}
	public function Destination()
	{
		return view('destination');
	}
	public function TermsConditions()
	{
		return view('terms-conditions');
	}
	public function PrivacyPolicy()
	{
		return view('privacy-policy');
	}
	public function Login()
	{
		return view('login');
	}
	public function Register()
	{
		return view('register');
	}
	public function ForgotPassword()
	{
		return view('forgot-password');
	}
	public function ChangePassword()
	{
		return view('change-password');
	}
	public function Error404()
	{
		return view('error-404');
	}
	public function Error500()
	{
		return view('error-500');
	}
	public function UnderMaintenance()
	{
		return view('under-maintenance');
	}
	public function ComingSoon()
	{
		return view('coming-soon');
	}
	public function IndexRtl()
	{
		return view('index-rtl');
	}
	public function CustomerFlightBooking()
	{
		return view('customer-flight-booking');
	}
	public function Dashboard()
	{
		return view('dashboard');
	}
	public function Review()
	{
		return view('review');
	}
	public function Chat()
	{
		return view('chat');
	}
	
	public function Wishlist()
	{
		return view('wishlist');
	}
	public function Wallet()
	{
		return view('wallet');
	}
	public function Payment()
	{
		return view('payment');
	}
	public function ProfileSettings()
	{
		return view('profile-settings');
	}
	public function NotificationSettings()
	{
		return view('notification-settings');
	}
	public function MyProfile()
	{
		return view('my-profile');
	}
	public function SecuritySettings()
	{
		return view('security-settings');
	}
	public function AgentDashboard()
	{
		return view('agent-dashboard');
	}
	public function AgentListings()
	{
		return view('agent-listings');
	}
	public function AgentHotelBooking()
	{
		return view('agent-hotel-booking');
	}
	public function AgentEnquirers()
	{
		return view('agent-enquirers');
	}
	
	public function AgentEarnings()
	{
		return view('agent-earnings');
	}
	public function AgentReview()
	{
		return view('agent-review');
	}
	public function AgentSettings()
	{
		return view('agent-settings');
	}
	public function AgentAccountSettings()
	{
		return view('agent-account-settings');
	}
	public function AgentCarBooking()
	{
		return view('agent-car-booking');
	}
	public function AgentChat()
	{
		return view('agent-chat');
	}
	public function AgentCruiseBooking()
	{
		return view('agent-cruise-booking');
	}
	public function AgentEnquiryDetails()
	{
		return view('agent-enquiry-details');
	}
	public function AgentFlightBooking()
	{
		return view('agent-flight-booking');
	}
	public function AgentNotifications()
	{
		return view('agent-notifications');
	}
	public function AgentPlans()
	{
		return view('agent-plans');
	}
	public function AgentPlansSettings()
	{
		return view('agent-plans-settings');
	}
	
	public function AgentSecuritySettings()
	{
		return view('agent-security-settings');
	}
	
	public function AgentTourBooking()
	{
		return view('agent-tour-booking');
	}
	public function BecomeAnExpert()
	{
		return view('become-an-expert');
	}
	
	public function CarBooking()
	{
		return view('car-booking');
	}
	public function CustomerCarBooking()
	{
		return view('customer-car-booking');
	}
	
	public function CustomerCruiseBooking()
	{
		return view('customer-cruise-booking');
	}
	public function CustomerHotelBooking()
	{
		return view('customer-hotel-booking');
	}
	
	public function CustomerTourBooking()
	{
		return view('customer-tour-booking');
	}
	public function EditCar()
	{
		return view('edit-car');
	}
	public function EditCruise()
	{
		return view('edit-cruise');
	}
	public function EditFlight()
	{
		return view('edit-flight');
	}
	public function EditHotel()
	{
		return view('edit-hotel');
	}
	public function EditTour()
	{
		return view('edit-tour');
	}
	public function FlightBooking()
	{
		return view('flight-booking');
	}
	public function HotelBooking()
	{
		return view('hotel-booking');
	}
	public function PreferencesSettings()
	{
		return view('preferences-settings');
	}
	public function CruiseBooking()
	{
		return view('cruise-booking');
	}
	public function IntegrationSettings()
	{
		return view('integration-settings');
	}
	public function Notification()
	{
		return view('notification');
	}
}