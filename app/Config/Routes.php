<?php
$moduleRoutes = [
    APPPATH . 'Modules/Auth/Config/Routes.php',
    APPPATH . 'Modules/Services/Config/Routes.php',
    APPPATH . 'Modules/Sales/Config/Routes.php',
    APPPATH . 'Modules/Referrals/Config/Routes.php',
    APPPATH . 'Modules/Resellers/Config/Routes.php',
    APPPATH . 'Modules/QR/Config/Routes.php',
    APPPATH . 'Modules/Tours/Config/Routes.php',
    APPPATH . 'Modules/Commissions/Config/Routes.php',
    APPPATH . 'Modules/OwnerPanel/Config/Routes.php',
    APPPATH . 'Modules/Admin/Config/Routes.php',
    APPPATH . 'Modules/Payouts/Config/Routes.php',
    APPPATH . 'Modules/Locations/Config/Routes.php',
    APPPATH . 'Modules/Attributes/Config/Routes.php',
    APPPATH . 'Modules/Terms/Config/Routes.php',
    APPPATH . 'Modules/Bookings/Config/Routes.php', 




];

foreach ($moduleRoutes as $routeFile) {
    if (file_exists($routeFile)) {
        require $routeFile;
    }
}

$routes->group('api', ['namespace' => 'App\Controllers', 'filter' => 'auth'], function($routes) {
    $routes->post('generate-tour-content', 'AiController::generateTourContent');
});



// Ruta pública para la sincronización de calendarios iCal
$routes->get('ical/feed/(:hash)', 'IcalController::getOwnerFeed/$1');


// Ruta para cambiar el idioma, manejada por LanguageController
$routes->get('language/set/(:segment)', 'LanguageController::set/$1');

// Ruta para el sitemap XML
$routes->get('sitemap.xml', 'SitemapController::index');

//Ruta API Banco Popular
//$routes->post('bancopopular/webhook', 'App\Controllers\BancopopularContoller::webhook');

$routes->post('bancopopular/webhook', 'BancopopularController::webhook');

$routes->get('api/exchange-rate', 'CurrencyController::getExchangeRate');







// Rutas para las páginas principales (index y variaciones)
// $routes->get('/', 'Home::soon');

// $routes->get('index1', 'Frontend::index');

$routes->get('index-2', 'Home::index2');
$routes->get('index-3', 'Home::index3');
$routes->get('index-4', 'Home::index4');
$routes->get('index-5', 'Home::index5');
$routes->get('index-6', 'Home::index6');
$routes->get('index-rtl', 'Home::indexRTL');

$routes->get('dashboard', 'Home::dashboard');



// Rutas para páginas de dashboard
$routes->get('dashboard', 'Frontend::dashboard');
$routes->get('agent-dashboard', 'Frontend::agentDashboard');
$routes->get('agent-listings', 'Frontend::agentListings');
$routes->get('agent-hotel-booking', 'Frontend::agentHotelBooking');
$routes->get('agent-enquirers', 'Frontend::agentEnquirers');
$routes->get('agent-earnings', 'Frontend::agentEarnings');
$routes->get('agent-chat', 'Frontend::agentChat');



/*
 * --------------------------------------------------------------------
 * Admin Routes
 * --------------------------------------------------------------------
 */
// En app/Config/Routes.php

$routes->group('admin', ['namespace' => 'App\Controllers', 'filter' => 'auth:super_admin'], function($routes) {
    
    // Rutas para la gestión de usuarios
    $routes->get('users', 'AdminUserController::index'); // Página para listar todos los usuarios
    $routes->get('users/create', 'AdminUserController::showCreateUser'); // Muestra el formulario de creación
    $routes->post('users/create', 'AdminUserController::createUser'); // Procesa el formulario de creación
    $routes->get('users/approve-owner/(:num)', 'AdminUserController::approveOwner/$1');
    
});



$routes->get('/', 'Home::Index');

$routes->get('index', 'Home::AdminIndex');
$routes->get('/index-2', 'Home::Index2');

$routes->get('/index-3', 'Home::Index3');

$routes->get('/index-4', 'Home::Index4');

$routes->get('/index-5', 'Home::Index5');

$routes->get('/index-6', 'Home::Index6');

$routes->get('/add-flight', 'Home::AddFlight');

$routes->get('/flight-grid', 'Home::FlightGrid');

$routes->get('/flight-list', 'Home::FlightList');

$routes->get('/flight-details', 'Home::FlightDetails');

$routes->get('/flight-booking-confirmation', 'Home::FlightBookingConfirmation');

$routes->get('/hotel-grid', 'Home::HotelGrid');

$routes->get('/hotel-list', 'Home::HotelList');

$routes->get('/hotel-map', 'Home::HotelMap');

$routes->get('/hotel-details', 'Home::HotelDetails');

$routes->get('/booking-confirmation', 'Home::BookingConfirmation');

$routes->get('/add-hotel', 'Home::AddHotel');

$routes->get('/car-grid', 'Home::CarGrid');

$routes->get('/car-list', 'Home::CarList');

$routes->get('/car-map', 'Home::CarMap');

$routes->get('/car-details', 'Home::CarDetails');

$routes->get('/car-booking-confirmation', 'Home::CarBookingConfirmation');

$routes->get('/add-car', 'Home::AddCar');

$routes->get('/cruise-grid', 'Home::CruiseGrid');

$routes->get('/cruise-list', 'Home::CruiseList');

$routes->get('/cruise-map', 'Home::CruiseMap');

$routes->get('/cruise-details', 'Home::CruiseDetails');

$routes->get('/cruise-booking-confirmation', 'Home::CruiseBookingConfirmation');

$routes->get('/add-cruise', 'Home::AddCruise');

$routes->get('/tour-grid', 'Home::TourGrid');

$routes->get('/tour-list', 'Home::TourList');

$routes->get('/tour-map', 'Home::TourMap');

$routes->get('/tour-details', 'Home::TourDetails');

$routes->get('/tour-booking-confirmation', 'Home::TourBookingConfirmation');

$routes->get('/add-tour', 'Home::AddTour');

$routes->get('/about-us', 'Home::AboutUs');

$routes->get('/gallery', 'Home::Gallery');

$routes->get('/testimonial', 'Home::Testimonial');

$routes->get('/faq', 'Home::Faq');

$routes->get('/pricing-plan', 'Home::PricingPlan');

$routes->get('/team', 'Home::Team');

$routes->get('/invoices', 'Home::Invoices');

$routes->get('/blog-grid', 'Home::BlogGrid');

$routes->get('/blog-list', 'Home::BlogList');

$routes->get('/blog-details', 'Home::BlogDetails');

$routes->get('/contact-us', 'Home::ContactUs');

$routes->get('/destination', 'Home::Destination');

$routes->get('/terms-conditions', 'Home::TermsConditions');

$routes->get('/privacy-policy', 'Home::PrivacyPolicy');

$routes->get('/login', 'Home::Login');

$routes->get('/register', 'Home::Register');

$routes->get('/forgot-password', 'Home::ForgotPassword');

$routes->get('/change-password', 'Home::ChangePassword');

$routes->get('/error-404', 'Home::Error404');

$routes->get('/error-500', 'Home::Error500');

$routes->get('/under-maintenance', 'Home::UnderMaintenance');

$routes->get('/coming-soon', 'Home::ComingSoon');

$routes->get('/index-rtl', 'Home::IndexRtl');

$routes->get('/customer-flight-booking', 'Home::CustomerFlightBooking');

$routes->get('/dashboard', 'Home::Dashboard');

$routes->get('/customer-flight-booking', 'Home::CustomerFlightBooking');

$routes->get('/review', 'Home::Review');

$routes->get('/chat', 'Home::Chat');

$routes->get('/wishlist', 'Home::Wishlist');

$routes->get('/wallet', 'Home::Wallet');

$routes->get('/payment', 'Home::Payment');

$routes->get('/profile-settings', 'Home::ProfileSettings');

$routes->get('/notification-settings', 'Home::NotificationSettings');

$routes->get('/my-profile', 'Home::MyProfile');

$routes->get('/security-settings', 'Home::SecuritySettings');

$routes->get('/agent-dashboard', 'Home::AgentDashboard');

$routes->get('/agent-listings', 'Home::AgentListings');

$routes->get('/agent-hotel-booking', 'Home::AgentHotelBooking');

$routes->get('/agent-enquirers', 'Home::AgentEnquirers');

$routes->get('/agent-earnings', 'Home::AgentEarnings');

$routes->get('/agent-review', 'Home::AgentReview');

$routes->get('/agent-settings', 'Home::AgentSettings');

$routes->get('/agent-account-settings', 'Home::AgentAccountSettings');

$routes->get('/agent-car-booking', 'Home::AgentCarBooking');

$routes->get('/agent-chat', 'Home::AgentChat');

$routes->get('/agent-cruise-booking', 'Home::AgentCruiseBooking');

$routes->get('/agent-enquiry-details', 'Home::AgentEnquiryDetails');

$routes->get('/agent-flight-booking', 'Home::AgentFlightBooking');

$routes->get('/agent-notifications', 'Home::AgentNotifications');

$routes->get('/agent-plans', 'Home::AgentPlans');

$routes->get('/agent-plans-settings', 'Home::AgentPlansSettings');

$routes->get('/agent-security-settings', 'Home::AgentSecuritySettings');

$routes->get('/agent-tour-booking', 'Home::AgentTourBooking');

$routes->get('/become-an-expert', 'Home::BecomeAnExpert');

$routes->get('/car-booking', 'Home::CarBooking');

$routes->get('/customer-car-booking', 'Home::CustomerCarBooking');

$routes->get('/cruise-grid', 'Home::CruiseGrid');

$routes->get('/customer-cruise-booking', 'Home::CustomerCruiseBooking');

$routes->get('/customer-hotel-booking', 'Home::CustomerHotelBooking');

$routes->get('/customer-tour-booking', 'Home::CustomerTourBooking');

$routes->get('/edit-car', 'Home::EditCar');

$routes->get('/edit-cruise', 'Home::EditCruise');

$routes->get('/edit-flight', 'Home::EditFlight');

$routes->get('/edit-hotel', 'Home::EditHotel');

$routes->get('/edit-tour', 'Home::EditTour');

$routes->get('/flight-booking', 'Home::FlightBooking');

$routes->get('/hotel-booking', 'Home::HotelBooking');

$routes->get('/preferences-settings', 'Home::PreferencesSettings');

$routes->get('/cruise-booking', 'Home::CruiseBooking');

$routes->get('/integration-settings', 'Home::IntegrationSettings');

$routes->get('/notification', 'Home::Notification');
