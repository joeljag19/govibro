<?php
$page = $page ?? 'default'; 
//$page ="index-3"; 

?>

<?php if ($page !== 'index-2' && $page !== 'index-3' && $page !== 'index-4' && $page !== 'index-5' && $page !== 'index-6' && $page !== 'index' && $page !== 'index-rtl' && $page !== '/') {   ?>
   
    <div class="main-header">
        <!-- Header Topbar-->
        <div class="header-topbar text-center bg-transparent">
            <div class="container">
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <p class="d-flex align-items-center fw-medium fs-14 mb-2"><i class="isax isax-call5 me-2"></i>Toll Free : +1 56565 56594</p>
                    <div class="d-flex align-items-center">
                        <p class="mb-2 me-3 d-flex align-items-center fw-medium fs-14"><i class="isax isax-message-text-15 me-2"></i>Email : info@example.com</p>
                        <div class="dropdown flag-dropdown mb-2 me-3">
                            <a href="javascript:void(0);" class="dropdown-toggle d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="<?php echo base_url(); ?>assets/img/flags/us-flag.svg" class="me-2" alt="flag">ENG
                            </a>
                            <ul class="dropdown-menu p-2 mt-2">
                                <li>
                                    <a class="dropdown-item rounded d-flex align-items-center" href="javascript:void(0);">
                                        <img src="<?php echo base_url(); ?>assets/img/flags/us-flag.svg" class="me-2" alt="flag">ENG
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item rounded d-flex align-items-center" href="javascript:void(0);">
                                        <img src="<?php echo base_url(); ?>assets/img/flags/arab-flag.svg" class="me-2" alt="flag">ARA
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item rounded d-flex align-items-center" href="javascript:void(0);">
                                        <img src="<?php echo base_url(); ?>assets/img/flags/france-flag.svg" class="me-2" alt="flag">FRA
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="dropdown mb-2 me-3">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
								USD
							</a>
                            <ul class="dropdown-menu p-2 mt-2">
                                <li><a class="dropdown-item rounded" href="javascript:void(0);">USD</a></li>
                                <li><a class="dropdown-item rounded" href="javascript:void(0);">YEN</a></li>
                                <li><a class="dropdown-item rounded" href="javascript:void(0);">EURO</a></li>
                            </ul>
                        </div>
                        <div class="fav-dropdown mb-2">
                            <a href="<?php echo base_url(); ?>wishlist" class="position-relative">
                                <i class="isax isax-heart"></i><span class="count-icon bg-secondary text-gray-9">0</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Header Topbar-->

        <!-- Header -->
        <header>
            <div class="container">
                <div class="offcanvas-info">
                    <div class="offcanvas-wrap">
                        <div class="offcanvas-detail">
                            <div class="offcanvas-head">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <a href="<?php echo base_url(); ?>index" class="black-logo-responsive">
                                        <img src="<?php echo base_url(); ?>assets/img/logo-dark.svg" alt="logo-img">
                                    </a>
                                    <a href="<?php echo base_url(); ?>index" class="white-logo-responsive">
                                        <img src="<?php echo base_url(); ?>assets/img/logo.svg" alt="logo-img">
                                    </a>
                                    <div class="offcanvas-close">
                                        <i class="ti ti-x"></i>
                                    </div>
                                </div>
                                <div class="wishlist-info d-flex justify-content-between align-items-center">
                                    <h6 class="fs-16 fw-medium">Wishlist</h6>
                                    <div class="d-flex align-items-center">
                                        <div class="fav-dropdown">
                                            <a href="<?php echo base_url(); ?>wishlist" class="position-relative">
                                                <i class="isax isax-heart"></i><span class="count-icon bg-secondary text-gray-9">0</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mobile-menu fix mb-3"></div>
                            <div class="offcanvas__contact">
                                <div class="mt-4">
                                    <a href="<?php echo base_url(); ?>add-car" class="btn btn-primary w-100">Add Listing</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="offcanvas-overlay"></div>
                <div class="header-nav">
                    <div class="main-menu-wrapper">
                        <div class="navbar-logo">
                            <a class="logo-white header-logo" href="<?php echo base_url(); ?>index">
                                <img src="<?php echo base_url(); ?>assets/img/logo.svg" class="logo" alt="Logo">
                            </a>
                            <a class="logo-dark header-logo" href="<?php echo base_url(); ?>index">
                                <img src="<?php echo base_url(); ?>assets/img/logo-dark.svg" class="logo" alt="Logo">
                            </a>
                        </div>
                        <nav id="mobile-menu">
                            <ul class="main-nav">
                                <li class="has-submenu megamenu <?php echo ($page == 'index' || $page == '/' || $page == 'index-2' || $page == 'index-3' || $page == 'index-4'|| $page == 'index-5'|| $page == 'index-6') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Home<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="d-none d-lg-flex align-items-center justify-content-between flex-wrap">
                                                    <h6 class="mb-3">Home Pages</h6>
                                                    <a href="javascript:void(0);" class="btn btn-dark btn-md mb-3 text-white d-inline-block w-auto">Purchase Template</a>
                                                </div>
                                                <div class="row g-lg-4">
                                                    <div class="col-lg-2">
                                                        <div class="single-demo <?php echo ($page == 'index' || $page == '/') ? 'active' : ''; ?>">
                                                            <div class="demo-img">
                                                                <a href="<?php echo base_url(); ?>index"><img src="<?php echo base_url(); ?>assets/img/menu/home-01.jpg" class="img-fluid" alt="img"></a>
                                                            </div>
                                                            <div class="demo-info">
                                                                <a href="<?php echo base_url(); ?>index">All Bookings</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="single-demo <?php echo ($page == 'index-2') ? 'active' : ''; ?>">
                                                            <div class="demo-img">
                                                                <a href="<?php echo base_url(); ?>index-2"><img src="<?php echo base_url(); ?>assets/img/menu/home-02.jpg" class="img-fluid" alt="img"></a>
                                                            </div>
                                                            <div class="demo-info">
                                                                <a href="<?php echo base_url(); ?>index-2">Hotels</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="single-demo <?php echo ($page == 'index-3') ? 'active' : ''; ?>">
                                                            <div class="demo-img">
                                                                <a href="<?php echo base_url(); ?>index-3"><img src="<?php echo base_url(); ?>assets/img/menu/home-03.jpg" class="img-fluid" alt="img"></a>
                                                            </div>
                                                            <div class="demo-info">
                                                                <a href="<?php echo base_url(); ?>index-3">Cars</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="single-demo <?php echo ($page == 'index-4') ? 'active' : ''; ?>">
                                                            <div class="demo-img">
                                                                <a href="<?php echo base_url(); ?>index-4"><img src="<?php echo base_url(); ?>assets/img/menu/home-04.jpg" class="img-fluid" alt="img"></a>
                                                            </div>
                                                            <div class="demo-info">
                                                                <a href="<?php echo base_url(); ?>index-4">Flight</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="single-demo <?php echo ($page == 'index-5') ? 'active' : ''; ?>">
                                                            <div class="demo-img">
                                                                <a href="<?php echo base_url(); ?>index-5"><img src="<?php echo base_url(); ?>assets/img/menu/home-05.jpg" class="img-fluid" alt="img"></a>
                                                            </div>
                                                            <div class="demo-info">
                                                                <a href="<?php echo base_url(); ?>index-5">Cruise</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="single-demo <?php echo ($page == 'index-6') ? 'active' : ''; ?>">
                                                            <div class="demo-img">
                                                                <a href="<?php echo base_url(); ?>index-6"><img src="<?php echo base_url(); ?>assets/img/menu/home-06.jpg" class="img-fluid" alt="img"></a>
                                                            </div>
                                                            <div class="demo-info">
                                                                <a href="<?php echo base_url(); ?>index-6">Tours</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu <?php echo ($page == 'flight-grid' || $page == 'flight-list' || $page == 'flight-details' || $page == 'flight-booking-confirmation'|| $page == 'add-flight') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Flight<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h6>Flight Bookings</h6>
                                                        <ul>
                                                            <li class="<?php echo ($page == 'flight-grid') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>flight-grid">Flight Grid</a></li>
                                                            <li class="<?php echo ($page == 'flight-list') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>flight-list">Flight List</a></li>
                                                            <li class="<?php echo ($page == 'flight-details') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>flight-details">Flight Details</a></li>
                                                            <li class="<?php echo ($page == 'flight-booking-confirmation') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>flight-booking-confirmation">Flight Booking</a></li>
                                                            <li class="<?php echo ($page == 'add-flight') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>add-flight">Add Flight</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="menu-img">
                                                            <img src="<?php echo base_url(); ?>assets/img/menu/flight.jpg" alt="img" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu <?php echo ($page == 'hotel-grid' || $page == 'hotel-list' || $page == 'hotel-map' || $page == 'hotel-details'|| $page == 'booking-confirmation'|| $page == 'add-hotel') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Hotel<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h6>Hotel Bookings</h6>
                                                        <ul>
                                                            <li class="<?php echo ($page == 'hotel-grid') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>hotel-grid">Hotel Grid</a></li>
                                                            <li class="<?php echo ($page == 'hotel-list') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>hotel-list">Hotel List</a></li>
                                                            <li class="<?php echo ($page == 'hotel-map') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>hotel-map">Hotel Map</a></li>
                                                            <li class="<?php echo ($page == 'hotel-details') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>hotel-details">Hotel Details</a></li>
                                                            <li class="<?php echo ($page == 'booking-confirmation') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>booking-confirmation">Hotel Booking</a></li>
                                                            <li class="<?php echo ($page == 'add-hotel') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>add-hotel">Add Hotel</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="menu-img">
                                                            <img src="<?php echo base_url(); ?>assets/img/menu/hotel.jpg" alt="img" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu <?php echo ($page == 'car-grid' || $page == 'car-list' || $page == 'car-map' || $page == 'car-details'|| $page == 'car-booking-confirmation'|| $page == 'add-car') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Car<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h6>Car Bookings</h6>
                                                        <ul>
                                                            <li class="<?php echo ($page == 'car-grid') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>car-grid">Car Grid</a></li>
                                                            <li class="<?php echo ($page == 'car-list') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>car-list">Car List</a></li>
                                                            <li class="<?php echo ($page == 'car-map') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>car-map">Car Map</a></li>
                                                            <li class="<?php echo ($page == 'car-details') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>car-details">Car Details</a></li>
                                                            <li class="<?php echo ($page == 'car-booking-confirmation') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>car-booking-confirmation">Car Booking</a></li>
                                                            <li class="<?php echo ($page == 'add-car') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>add-car">Add Car</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="menu-img">
                                                            <img src="<?php echo base_url(); ?>assets/img/menu/car.jpg" alt="img" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu <?php echo ($page == 'cruise-grid' || $page == 'cruise-list' || $page == 'cruise-map' || $page == 'cruise-details'|| $page == 'cruise-booking-confirmation'|| $page == 'add-cruise') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Cruise<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h6>Cruise Bookings</h6>
                                                        <ul>
                                                            <li class="<?php echo ($page == 'cruise-grid') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>cruise-grid">Cruise Grid</a></li>
                                                            <li class="<?php echo ($page == 'cruise-list') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>cruise-list">Cruise List</a></li>
                                                            <li class="<?php echo ($page == 'cruise-map') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>cruise-map">Cruise Map</a></li>
                                                            <li class="<?php echo ($page == 'cruise-details') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>cruise-details">Cruise Details</a></li>
                                                            <li class="<?php echo ($page == 'cruise-booking-confirmation') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>cruise-booking-confirmation">Cruise Booking</a></li>
                                                            <li class="<?php echo ($page == 'add-cruise') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>add-cruise">Add Cruise</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="menu-img">
                                                            <img src="<?php echo base_url(); ?>assets/img/menu/cruise.jpg" alt="img" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu <?php echo ($page == 'tour-grid' || $page == 'tour-list' || $page == 'tour-map' || $page == 'tour-details'|| $page == 'tour-booking-confirmation'|| $page == 'add-tour') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Tour<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h6>Tour Bookings</h6>
                                                        <ul>
                                                            <li class="<?php echo ($page == 'tour-grid') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>tour-grid">Tour Grid</a></li>
                                                            <li class="<?php echo ($page == 'tour-list') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>tour-list">Tour List</a></li>
                                                            <li class="<?php echo ($page == 'tour-map') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>tour-map">Tour Map</a></li>
                                                            <li class="<?php echo ($page == 'tour-details') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>tour-details">Tour Details</a></li>
                                                            <li class="<?php echo ($page == 'tour-booking-confirmation') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>tour-booking-confirmation">Tour Booking</a></li>
                                                            <li class="<?php echo ($page == 'add-tour') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>add-tour">Add Tour</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="menu-img">
                                                            <img src="<?php echo base_url(); ?>assets/img/menu/tour.jpg" alt="img" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu <?php echo ($page == 'about-us' || $page == 'gallery' || $page == 'testimonial' || $page == 'faq'|| $page == 'pricing-plan'|| $page == 'team'|| $page == 'invoices'|| $page == 'blog-grid'|| $page == 'blog-list'|| $page == 'blog-details'
                                || $page == 'contact-us'|| $page == 'booking-confirmation'|| $page == 'destination' || $page == 'terms-conditions'|| $page == 'privacy-policy'|| $page == 'login'|| $page == 'register'|| 
                                $page == 'forgot-password'|| $page == 'change-password'|| $page == 'error-404'|| $page == 'error-500'|| $page == 'under-maintenance'|| $page == 'coming-soon'|| $page == 'index-rtl') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Pages<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <h6>Pages</h6>
                                                <div class="row g-lg-4">
                                                    <div class="col-lg-6">
                                                        <ul>
                                                            <li class="<?php echo ($page == 'about-us') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>about-us">About</a></li>
                                                            <li class="<?php echo ($page == 'gallery') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>gallery">Gallery</a></li>
                                                            <li class="<?php echo ($page == 'testimonial') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>testimonial">Testimonials</a></li>
                                                            <li class="<?php echo ($page == 'faq') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>faq">Faq</a></li>
                                                            <li class="<?php echo ($page == 'pricing-plan') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>pricing-plan">Pricing Plan</a></li>
                                                            <li class="<?php echo ($page == 'team') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>team">Teams</a></li>
                                                            <li class="<?php echo ($page == 'invoices') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>invoices">Invoice</a></li>
                                                            <li class="<?php echo ($page == 'blog-grid') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>blog-grid">Blogs Grid</a></li>
                                                            <li class="<?php echo ($page == 'blog-list') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>blog-list">Blogs List</a></li>
                                                            <li class="<?php echo ($page == 'blog-details') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>blog-details">Blogs Details</a></li>
                                                            <li class="<?php echo ($page == 'contact-us') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>contact-us">Contact Us</a></li>
                                                            <li class="<?php echo ($page == 'booking-confirmation') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>booking-confirmation">Booking Confirmation</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <ul>
                                                            <li class="<?php echo ($page == 'destination') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>destination">Destination</a></li>
                                                            <li class="<?php echo ($page == 'terms-conditions') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>terms-conditions">Terms & Conditions</a></li>
                                                            <li class="<?php echo ($page == 'privacy-policy') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>privacy-policy">Privacy Policy</a></li>
                                                            <li class="<?php echo ($page == 'login') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>login">Login</a></li>
                                                            <li class="<?php echo ($page == 'register') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>register">Register</a></li>
                                                            <li class="<?php echo ($page == 'forgot-password') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>forgot-password">Forgot Password</a></li>
                                                            <li class="<?php echo ($page == 'change-password') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>change-password">Change Password</a></li>
                                                            <li class="<?php echo ($page == 'error-404') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>error-404">404 Error</a></li>
                                                            <li class="<?php echo ($page == 'error-500') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>error-500">500 Error</a></li>
                                                            <li class="<?php echo ($page == 'under-maintenance') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>under-maintenance">Under Maintenance</a></li>
                                                            <li class="<?php echo ($page == 'coming-soon') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>coming-soon">Coming Soon</a></li>
                                                            <li class="<?php echo ($page == 'index-rtl') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>index-rtl">RTL</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu <?php echo ($page == 'dashboard' || $page == 'customer-flight-booking' || $page == 'review' || $page == 'chat'|| $page == 'wishlist'|| $page == 'wallet'|| $page == 'payment'|| $page == 'profile-settings'|| $page == 'notification-settings'|| $page == 'my-profile'
                                || $page == 'security-settings'|| $page == 'agent-dashboard'|| $page == 'agent-listings' || $page == 'agent-hotel-booking'|| $page == 'agent-enquirers'|| $page == 'agent-earnings'|| $page == 'agent-review'|| 
                                $page == 'agent-settings') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Dashboard<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row g-lg-4">
                                                    <div class="col-lg-6">
                                                        <h6>User Dashboard</h6>
                                                        <ul>
                                                            <li class="<?php echo ($page == 'dashboard') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>
                                                            <li class="<?php echo ($page == 'customer-flight-booking') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>customer-flight-booking">My Bookings</a></li>
                                                            <li class="<?php echo ($page == 'review') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>review">Reviews</a></li>
                                                            <li class="<?php echo ($page == 'chat') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>chat">Message</a></li>
                                                            <li class="<?php echo ($page == 'wishlist') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>wishlist">Wishlist</a></li>
                                                            <li class="<?php echo ($page == 'wallet') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>wallet">Wallet</a></li>
                                                            <li class="<?php echo ($page == 'payment') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>payment">Payments</a></li>
                                                            <li class="<?php echo ($page == 'profile-settings') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>profile-settings">Profile Settings</a></li>
                                                            <li class="<?php echo ($page == 'notification-settings') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>notification-settings">Notifications</a></li>
                                                            <li class="<?php echo ($page == 'my-profile') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>my-profile">My Profile</a></li>
                                                            <li class="<?php echo ($page == 'security-settings') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>security-settings">Settings</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <h6>Agent Dashboard</h6>
                                                        <ul>
                                                            <li class="<?php echo ($page == 'agent-dashboard') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-dashboard">Dashboard</a></li>
                                                            <li class="<?php echo ($page == 'agent-listings') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-listings">Listings</a></li>
                                                            <li class="<?php echo ($page == 'agent-hotel-booking') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-hotel-booking">Bookings</a></li>
                                                            <li class="<?php echo ($page == 'agent-enquirers') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-enquirers">Enquiries</a></li>
                                                            <li class="<?php echo ($page == 'agent-earnings') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-earnings">Earnings</a></li>
                                                            <li class="<?php echo ($page == 'agent-review') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-review">Reviews</a></li>
                                                            <li class="<?php echo ($page == 'agent-settings') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-settings">Settings</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        <div class="header-btn d-flex align-items-center">
                            <div class="me-3">
                                <a href="javascript:void(0);" id="dark-mode-toggle" class="theme-toggle">
                                    <i class="isax isax-moon"></i>
                                </a>
                                <a href="javascript:void(0);" id="light-mode-toggle" class="theme-toggle">
                                    <i class="isax isax-sun-1"></i>
                                </a>
                            </div>
                            <div class="dropdown profile-dropdown">
                                <a href="javascript:void(0);" class="d-flex align-items-center" data-bs-toggle="dropdown">
                                    <span class="avatar avatar-md">
										<img src="<?php echo base_url(); ?>assets/img/users/user-05.jpg" alt="Img" class="img-fluid rounded-circle border border-white border-4">
									</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                    <li>
                                        <a class="dropdown-item d-inline-flex align-items-center rounded fw-medium p-2" href="<?php echo base_url(); ?>dashboard">Dashboard</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-inline-flex align-items-center rounded fw-medium p-2" href="<?php echo base_url(); ?>customer-hotel-booking">My Booking</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-inline-flex align-items-center rounded fw-medium p-2" href="<?php echo base_url(); ?>my-profile">My Profile</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider my-2">
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-inline-flex align-items-center rounded fw-medium p-2" href="<?php echo base_url(); ?>profile-settings">Settings</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-inline-flex align-items-center rounded fw-medium p-2" href="<?php echo base_url(); ?>login">Logout</a>
                                    </li>
                                </ul>
                            </div>
                            <a href="<?php echo base_url(); ?>add-car" class="btn btn-primary me-0">Add Listing</a>
                            <div class="header__hamburger d-xl-none my-auto">
                                <div class="sidebar-menu">
                                    <i class="isax isax-menu5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- /Header -->
    </div>

<?php } ?>

<?php if ($page == 'index' || $page == '/' || $page == 'index-rtl') {   ?>
    <div class="main-header">
        <!-- Header Topbar-->
        <div class="header-topbar text-center bg-transparent">
            <div class="container">
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <p class="d-flex align-items-center fw-medium fs-14 mb-2"><i class="isax isax-call5 me-2"></i>Toll Free : +1 56565 56594</p>
                    <div class="d-flex align-items-center">
                        <p class="mb-2 me-3 d-flex align-items-center fw-medium fs-14"><i class="isax isax-message-text-15 me-2"></i>Email : info@example.com</p>
                        <div class="dropdown flag-dropdown mb-2 me-3">
                            <a href="javascript:void(0);" class="dropdown-toggle d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="<?php echo base_url(); ?>assets/img/flags/us-flag.svg" class="me-2" alt="flag">ENG
                            </a>
                            <ul class="dropdown-menu p-2 mt-2">
                                <li>
                                    <a class="dropdown-item rounded d-flex align-items-center" href="javascript:void(0);">
                                        <img src="<?php echo base_url(); ?>assets/img/flags/us-flag.svg" class="me-2" alt="flag">ENG
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item rounded d-flex align-items-center" href="javascript:void(0);">
                                        <img src="<?php echo base_url(); ?>assets/img/flags/arab-flag.svg" class="me-2" alt="flag">ARA
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item rounded d-flex align-items-center" href="javascript:void(0);">
                                        <img src="<?php echo base_url(); ?>assets/img/flags/france-flag.svg" class="me-2" alt="flag">FRE
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="dropdown mb-2 me-3">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
								USD
							</a>
                            <ul class="dropdown-menu p-2 mt-2">
                                <li><a class="dropdown-item rounded" href="javascript:void(0);">USD</a></li>
                                <li><a class="dropdown-item rounded" href="javascript:void(0);">YEN</a></li>
                                <li><a class="dropdown-item rounded" href="javascript:void(0);">EURO</a></li>
                            </ul>
                        </div>
                        <div class="fav-dropdown mb-2">
                            <a href="<?php echo base_url(); ?>wishlist" class="position-relative">
                                <i class="isax isax-heart"></i><span class="count-icon bg-secondary text-gray-9">0</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Header Topbar-->

        <!-- Header -->
        <header>
            <div class="container">
                <div class="offcanvas-info">
                    <div class="offcanvas-wrap">
                        <div class="offcanvas-detail">
                            <div class="offcanvas-head">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <a href="<?php echo base_url(); ?>index" class="black-logo-responsive">
                                        <img src="<?php echo base_url(); ?>assets/img/logo-dark.svg" alt="logo-img">
                                    </a>
                                    <a href="<?php echo base_url(); ?>index" class="white-logo-responsive">
                                        <img src="<?php echo base_url(); ?>assets/img/logo.svg" alt="logo-img">
                                    </a>
                                    <div class="offcanvas-close">
                                        <i class="ti ti-x"></i>
                                    </div>
                                </div>
                                <div class="wishlist-info d-flex justify-content-between align-items-center">
                                    <h6 class="fs-16 fw-medium">Wishlist</h6>
                                    <div class="d-flex align-items-center">
                                        <div class="fav-dropdown">
                                            <a href="<?php echo base_url(); ?>wishlist" class="position-relative">
                                                <i class="isax isax-heart"></i><span class="count-icon bg-secondary text-gray-9">0</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mobile-menu fix mb-3"></div>
                            <div class="offcanvas__contact">
                                <div class="mt-4">
                                    <div class="header-dropdown d-flex flex-fill">
                                        <div class="w-100">
                                            <div class="dropdown flag-dropdown mb-2">
                                                <a href="javascript:void(0);" class="dropdown-toggle bg-white border d-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <img src="<?php echo base_url(); ?>assets/img/flags/us-flag.svg" class="me-2" alt="flag">ENG
                                                </a>
                                                <ul class="dropdown-menu p-2">
                                                    <li>
                                                        <a class="dropdown-item rounded d-flex align-items-center" href="javascript:void(0);">
                                                            <img src="<?php echo base_url(); ?>assets/img/flags/us-flag.svg" class="me-2" alt="flag">ENG
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item rounded d-flex align-items-center" href="javascript:void(0);">
                                                            <img src="<?php echo base_url(); ?>assets/img/flags/arab-flag.svg" class="me-2" alt="flag">ARA
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item rounded d-flex align-items-center" href="javascript:void(0);">
                                                            <img src="<?php echo base_url(); ?>assets/img/flags/france-flag.svg" class="me-2" alt="flag">FRE
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="dropdown">
                                                <a href="javascript:void(0);" class="dropdown-toggle bg-white border d-block" data-bs-toggle="dropdown" aria-expanded="false">
													USD
												</a>
                                                <ul class="dropdown-menu p-2">
                                                    <li><a class="dropdown-item rounded" href="javascript:void(0);">USD</a></li>
                                                    <li><a class="dropdown-item rounded" href="javascript:void(0);">YEN</a></li>
                                                    <li><a class="dropdown-item rounded" href="javascript:void(0);">EURO</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div><a href="javascript:void(0);" class="text-white btn btn-dark w-100 mb-3" data-bs-toggle="modal" data-bs-target="#login-modal">Sign In</a></div>
                                    <a href="<?php echo base_url(); ?>become-an-expert" class="btn btn-primary w-100">Become Expert</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="offcanvas-overlay"></div>
                <div class="header-nav">
                    <div class="main-menu-wrapper">
                        <div class="navbar-logo">
                            <a class="logo-white header-logo" href="<?php echo base_url(); ?>index">
                                <img src="<?php echo base_url(); ?>assets/img/logo.svg" class="logo" alt="Logo">
                            </a>
                            <a class="logo-dark header-logo" href="<?php echo base_url(); ?>index">
                                <img src="<?php echo base_url(); ?>assets/img/logo-dark.svg" class="logo" alt="Logo">
                            </a>
                        </div>
                        <nav id="mobile-menu">
                            <ul class="main-nav">
                                <li class="has-submenu megamenu <?php echo ($page == 'index' || $page == '/') ? 'active' : ''; ?>">
                                    <a href="javascript:void(0);">Home<i class="fa-solid fa-plus"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="d-none d-lg-flex align-items-center justify-content-between flex-wrap">
                                                    <h6 class="mb-3">Home Pages</h6>
                                                    <a href="javascript:void(0);" class="btn btn-dark btn-md mb-3 text-white d-inline-block w-auto">Purchase Template</a>
                                                </div>
                                                <div class="row g-lg-4">
                                                    <div class="col-lg-2">
                                                        <div class="single-demo <?php echo ($page == 'index' || $page == '/') ? 'active' : ''; ?>">
                                                            <div class="demo-img">
                                                                <a href="<?php echo base_url(); ?>index"><img src="<?php echo base_url(); ?>assets/img/menu/home-01.jpg" class="img-fluid" alt="img"></a>
                                                            </div>
                                                            <div class="demo-info">
                                                                <a href="<?php echo base_url(); ?>index">All Bookings</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="single-demo">
                                                            <div class="demo-img">
                                                                <a href="<?php echo base_url(); ?>index-2"><img src="<?php echo base_url(); ?>assets/img/menu/home-02.jpg" class="img-fluid" alt="img"></a>
                                                            </div>
                                                            <div class="demo-info">
                                                                <a href="<?php echo base_url(); ?>index-2">Hotels</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="single-demo">
                                                            <div class="demo-img">
                                                                <a href="<?php echo base_url(); ?>index-3"><img src="<?php echo base_url(); ?>assets/img/menu/home-03.jpg" class="img-fluid" alt="img"></a>
                                                            </div>
                                                            <div class="demo-info">
                                                                <a href="<?php echo base_url(); ?>index-3">Cars</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="single-demo">
                                                            <div class="demo-img">
                                                                <a href="<?php echo base_url(); ?>index-4"><img src="<?php echo base_url(); ?>assets/img/menu/home-04.jpg" class="img-fluid" alt="img"></a>
                                                            </div>
                                                            <div class="demo-info">
                                                                <a href="<?php echo base_url(); ?>index-4">Flight</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="single-demo">
                                                            <div class="demo-img">
                                                                <a href="<?php echo base_url(); ?>index-5"><img src="<?php echo base_url(); ?>assets/img/menu/home-05.jpg" class="img-fluid" alt="img"></a>
                                                            </div>
                                                            <div class="demo-info">
                                                                <a href="<?php echo base_url(); ?>index-5">Cruise</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="single-demo">
                                                            <div class="demo-img">
                                                                <a href="<?php echo base_url(); ?>index-6"><img src="<?php echo base_url(); ?>assets/img/menu/home-06.jpg" class="img-fluid" alt="img"></a>
                                                            </div>
                                                            <div class="demo-info">
                                                                <a href="<?php echo base_url(); ?>index-6">Tours</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu">
                                    <a href="javascript:void(0);">Flight<i class="fa-solid fa-plus"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h6>Flight Bookings</h6>
                                                        <ul>
                                                            <li><a href="<?php echo base_url(); ?>flight-grid">Flight Grid</a></li>
                                                            <li><a href="<?php echo base_url(); ?>flight-list">Flight List</a></li>
                                                            <li><a href="<?php echo base_url(); ?>flight-details">Flight Details</a></li>
                                                            <li><a href="<?php echo base_url(); ?>flight-booking-confirmation">Flight Booking</a></li>
                                                            <li><a href="<?php echo base_url(); ?>add-flight">Add Flight</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="menu-img">
                                                            <img src="<?php echo base_url(); ?>assets/img/menu/flight.jpg" alt="img" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu">
                                    <a href="javascript:void(0);">Hotel<i class="fa-solid fa-plus"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h6>Hotel Bookings</h6>
                                                        <ul>
                                                            <li><a href="<?php echo base_url(); ?>hotel-grid">Hotel Grid</a></li>
                                                            <li><a href="<?php echo base_url(); ?>hotel-list">Hotel List</a></li>
                                                            <li><a href="<?php echo base_url(); ?>hotel-map">Hotel Map</a></li>
                                                            <li><a href="<?php echo base_url(); ?>hotel-details">Hotel Details</a></li>
                                                            <li><a href="<?php echo base_url(); ?>booking-confirmation">Hotel Booking</a></li>
                                                            <li><a href="<?php echo base_url(); ?>add-hotel">Add Hotel</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="menu-img">
                                                            <img src="<?php echo base_url(); ?>assets/img/menu/hotel.jpg" alt="img" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu">
                                    <a href="javascript:void(0);">Car<i class="fa-solid fa-plus"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h6>Car Bookings</h6>
                                                        <ul>
                                                            <li><a href="<?php echo base_url(); ?>car-grid">Car Grid</a></li>
                                                            <li><a href="<?php echo base_url(); ?>car-list">Car List</a></li>
                                                            <li><a href="<?php echo base_url(); ?>car-map">Car Map</a></li>
                                                            <li><a href="<?php echo base_url(); ?>car-details">Car Details</a></li>
                                                            <li><a href="<?php echo base_url(); ?>car-booking-confirmation">Car Booking</a></li>
                                                            <li><a href="<?php echo base_url(); ?>add-car">Add Car</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="menu-img">
                                                            <img src="<?php echo base_url(); ?>assets/img/menu/car.jpg" alt="img" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu">
                                    <a href="javascript:void(0);">Cruise<i class="fa-solid fa-plus"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h6>Cruise Bookings</h6>
                                                        <ul>
                                                            <li><a href="<?php echo base_url(); ?>cruise-grid">Cruise Grid</a></li>
                                                            <li><a href="<?php echo base_url(); ?>cruise-list">Cruise List</a></li>
                                                            <li><a href="<?php echo base_url(); ?>cruise-map">Cruise Map</a></li>
                                                            <li><a href="<?php echo base_url(); ?>cruise-details">Cruise Details</a></li>
                                                            <li><a href="<?php echo base_url(); ?>cruise-booking-confirmation">Cruise Booking</a></li>
                                                            <li><a href="<?php echo base_url(); ?>add-cruise">Add Cruise</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="menu-img">
                                                            <img src="<?php echo base_url(); ?>assets/img/menu/cruise.jpg" alt="img" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu">
                                    <a href="javascript:void(0);">Tour<i class="fa-solid fa-plus"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h6>Tour Bookings</h6>
                                                        <ul>
                                                            <li><a href="<?php echo base_url(); ?>tour-grid">Tour Grid</a></li>
                                                            <li><a href="<?php echo base_url(); ?>tour-list">Tour List</a></li>
                                                            <li><a href="<?php echo base_url(); ?>tour-map">Tour Map</a></li>
                                                            <li><a href="<?php echo base_url(); ?>tour-details">Tour Details</a></li>
                                                            <li><a href="<?php echo base_url(); ?>tour-booking-confirmation">Tour Booking</a></li>
                                                            <li><a href="<?php echo base_url(); ?>add-tour">Add Tour</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="menu-img">
                                                            <img src="<?php echo base_url(); ?>assets/img/menu/tour.jpg" alt="img" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu <?php echo ($page == 'index-rtl') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Pages<i class="fa-solid fa-plus"></i></a>
                                    <ul class="submenu mega-submenu ">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <h6>Pages</h6>
                                                <div class="row g-lg-4">
                                                    <div class="col-lg-6">
                                                        <ul>
                                                            <li><a href="<?php echo base_url(); ?>about-us">About</a></li>
                                                            <li><a href="<?php echo base_url(); ?>gallery">Gallery</a></li>
                                                            <li><a href="<?php echo base_url(); ?>testimonial">Testimonials</a></li>
                                                            <li><a href="<?php echo base_url(); ?>faq">Faq</a></li>
                                                            <li><a href="<?php echo base_url(); ?>pricing-plan">Pricing Plan</a></li>
                                                            <li><a href="<?php echo base_url(); ?>team">Teams</a></li>
                                                            <li><a href="<?php echo base_url(); ?>invoices">Invoice</a></li>
                                                            <li><a href="<?php echo base_url(); ?>blog-grid">Blogs Grid</a></li>
                                                            <li><a href="<?php echo base_url(); ?>blog-list">Blogs List</a></li>
                                                            <li><a href="<?php echo base_url(); ?>blog-details">Blogs Details</a></li>
                                                            <li><a href="<?php echo base_url(); ?>contact-us">Contact Us</a></li>
                                                            <li><a href="<?php echo base_url(); ?>booking-confirmation">Booking Confirmation</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <ul>
                                                            <li><a href="<?php echo base_url(); ?>destination">Destination</a></li>
                                                            <li><a href="<?php echo base_url(); ?>terms-conditions">Terms & Conditions</a></li>
                                                            <li><a href="<?php echo base_url(); ?>privacy-policy">Privacy Policy</a></li>
                                                            <li><a href="<?php echo base_url(); ?>login">Login</a></li>
                                                            <li><a href="<?php echo base_url(); ?>register">Register</a></li>
                                                            <li><a href="<?php echo base_url(); ?>forgot-password">Forgot Password</a></li>
                                                            <li><a href="<?php echo base_url(); ?>change-password">Change Password</a></li>
                                                            <li><a href="<?php echo base_url(); ?>error-404">404 Error</a></li>
                                                            <li><a href="<?php echo base_url(); ?>error-500">500 Error</a></li>
                                                            <li><a href="<?php echo base_url(); ?>under-maintenance">Under Maintenance</a></li>
                                                            <li><a href="<?php echo base_url(); ?>coming-soon">Coming Soon</a></li>
                                                            <li class="<?php echo ($page == 'index-rtl') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>index-rtl">RTL</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu">
                                    <a href="javascript:void(0);">Dashboard<i class="fa-solid fa-plus"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row g-lg-4">
                                                    <div class="col-lg-6">
                                                        <h6>User Dashboard</h6>
                                                        <ul>
                                                            <li><a href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>
                                                            <li><a href="<?php echo base_url(); ?>customer-flight-booking">My Bookings</a></li>
                                                            <li><a href="<?php echo base_url(); ?>review">Reviews</a></li>
                                                            <li><a href="<?php echo base_url(); ?>chat">Message</a></li>
                                                            <li><a href="<?php echo base_url(); ?>wishlist">Wishlist</a></li>
                                                            <li><a href="<?php echo base_url(); ?>wallet">Wallet</a></li>
                                                            <li><a href="<?php echo base_url(); ?>payment">Payments</a></li>
                                                            <li><a href="<?php echo base_url(); ?>profile-settings">Profile Settings</a></li>
                                                            <li><a href="<?php echo base_url(); ?>notification-settings">Notifications</a></li>
                                                            <li><a href="<?php echo base_url(); ?>my-profile">My Profile</a></li>
                                                            <li><a href="<?php echo base_url(); ?>security-settings">Settings</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <h6>Agent Dashboard</h6>
                                                        <ul>
                                                            <li><a href="<?php echo base_url(); ?>agent-dashboard">Dashboard</a></li>
                                                            <li><a href="<?php echo base_url(); ?>agent-listings">Listings</a></li>
                                                            <li><a href="<?php echo base_url(); ?>agent-hotel-booking">Bookings</a></li>
                                                            <li><a href="<?php echo base_url(); ?>agent-enquirers">Enquiries</a></li>
                                                            <li><a href="<?php echo base_url(); ?>agent-earnings">Earnings</a></li>
                                                            <li><a href="<?php echo base_url(); ?>agent-review">Reviews</a></li>
                                                            <li><a href="<?php echo base_url(); ?>agent-settings">Settings</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        <div class="header-btn d-flex align-items-center">
                            <div class="me-3">
                                <a href="javascript:void(0);" id="dark-mode-toggle" class="theme-toggle">
                                    <i class="isax isax-moon"></i>
                                </a>
                                <a href="javascript:void(0);" id="light-mode-toggle" class="theme-toggle">
                                    <i class="isax isax-sun-1"></i>
                                </a>
                            </div>
                            <div><a href="javascript:void(0);" class="btn btn-white me-3" data-bs-toggle="modal" data-bs-target="#login-modal">Sign In</a></div>
                            <a href="<?php echo base_url(); ?>become-an-expert" class="btn btn-primary me-0">Become Expert</a>
                            <div class="header__hamburger d-xl-none my-auto">
                                <div class="sidebar-menu">
                                    <i class="isax isax-menu5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- /Header -->
    </div>
<?php } ?>

<?php if ($page == 'index-2') {   ?>

    <div class="main-header main-header-four">
        <!-- Header -->
        <header class="header-four">
            <div class="container">
                <div class="offcanvas-info">
                    <div class="offcanvas-wrap">
                        <div class="offcanvas-detail">
                            <div class="offcanvas-head">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <a href="<?php echo base_url(); ?>index" class="black-logo-responsive">
                                        <img src="<?php echo base_url(); ?>assets/img/logo-dark.svg" alt="logo-img">
                                    </a>
                                    <a href="<?php echo base_url(); ?>index" class="white-logo-responsive">
                                        <img src="<?php echo base_url(); ?>assets/img/logo.svg" alt="logo-img">
                                    </a>
                                    <div class="offcanvas-close">
                                        <i class="ti ti-x"></i>
                                    </div>
                                </div>
                                <div class="wishlist-info d-flex justify-content-between align-items-center">
                                    <h6 class="fs-16 fw-medium">Wishlist</h6>
                                    <div class="d-flex align-items-center">
                                        <div class="fav-dropdown">
                                            <a href="<?php echo base_url(); ?>wishlist" class="position-relative">
                                                <i class="isax isax-heart"></i><span class="count-icon bg-secondary text-gray-9">0</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mobile-menu fix mb-3"></div>
                            <div class="offcanvas__contact">
                                <div class="mt-4">
                                    <div class="header-dropdown d-flex flex-fill">
                                        <div class="w-100">
                                            <div class="dropdown flag-dropdown mb-2">
                                                <a href="javascript:void(0);" class="dropdown-toggle bg-white border d-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <img src="<?php echo base_url(); ?>assets/img/flags/us-flag.svg" class="me-2" alt="flag">ENG
                                                </a>
                                                <ul class="dropdown-menu p-2">
                                                    <li>
                                                        <a class="dropdown-item rounded d-flex align-items-center" href="javascript:void(0);">
                                                            <img src="<?php echo base_url(); ?>assets/img/flags/us-flag.svg" class="me-2" alt="flag">ENG
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item rounded d-flex align-items-center" href="javascript:void(0);">
                                                            <img src="<?php echo base_url(); ?>assets/img/flags/arab-flag.svg" class="me-2" alt="flag">ARA
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item rounded d-flex align-items-center" href="javascript:void(0);">
                                                            <img src="<?php echo base_url(); ?>assets/img/flags/france-flag.svg" class="me-2" alt="flag">FRE
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="dropdown">
                                                <a href="javascript:void(0);" class="dropdown-toggle bg-white border d-block" data-bs-toggle="dropdown" aria-expanded="false">
													USD
												</a>
                                                <ul class="dropdown-menu p-2">
                                                    <li><a class="dropdown-item rounded" href="javascript:void(0);">USD</a></li>
                                                    <li><a class="dropdown-item rounded" href="javascript:void(0);">YEN</a></li>
                                                    <li><a class="dropdown-item rounded" href="javascript:void(0);">EURO</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn btn-dark w-100 mb-3"><a href="javascript:void(0);" class="text-white" data-bs-toggle="modal" data-bs-target="#login-modal">Sign In</a> / <a href="javascript:void(0);" class="text-white" data-bs-toggle="modal" data-bs-target="#register-modal">Sign Up</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="offcanvas-overlay"></div>
                <div class="header-nav">
                    <div class="main-menu-wrapper">
                        <div class="navbar-logo">
                            <a class="logo-white header-logo" href="<?php echo base_url(); ?>index">
                                <img src="<?php echo base_url(); ?>assets/img/logo-dark.svg" class="logo" alt="Logo">
                            </a>
                            <a class="logo-dark header-logo" href="<?php echo base_url(); ?>index">
                                <img src="<?php echo base_url(); ?>assets/img/logo.svg" class="logo" alt="Logo">
                            </a>
                        </div>
                        <nav id="mobile-menu">
                            <ul class="main-nav">
                                <li class="has-submenu megamenu <?php echo ($page == 'index' || $page == 'index-2' || $page == 'index-3' || $page == 'index-4'|| $page == 'index-5'|| $page == 'index-6') ? 'active subdrop' : ''; ?> ">
                                    <a href="javascript:void(0);">Home<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="d-none d-lg-flex align-items-center justify-content-between flex-wrap">
                                                    <h6 class="mb-3">Home Pages</h6>
                                                    <a href="javascript:void(0);" class="btn btn-dark btn-md mb-3 text-white d-inline-block w-auto">Purchase Template</a>
                                                </div>
                                                <div class="row g-lg-4">
                                                    <div class="col-lg-2">
                                                        <div class="single-demo <?php echo ($page == 'index' || $page == '/') ? 'active' : ''; ?>">
                                                            <div class="demo-img">
                                                                <a href="<?php echo base_url(); ?>index"><img src="<?php echo base_url(); ?>assets/img/menu/home-01.jpg" class="img-fluid" alt="img"></a>
                                                            </div>
                                                            <div class="demo-info">
                                                                <a href="<?php echo base_url(); ?>index">All Bookings</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="single-demo <?php echo ($page == 'index-2') ? 'active' : ''; ?> ">
                                                            <div class="demo-img">
                                                                <a href="<?php echo base_url(); ?>index-2"><img src="<?php echo base_url(); ?>assets/img/menu/home-02.jpg" class="img-fluid" alt="img"></a>
                                                            </div>
                                                            <div class="demo-info">
                                                                <a href="<?php echo base_url(); ?>index-2">Hotels</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="single-demo <?php echo ($page == 'index-3') ? 'active' : ''; ?>">
                                                            <div class="demo-img">
                                                                <a href="<?php echo base_url(); ?>index-3"><img src="<?php echo base_url(); ?>assets/img/menu/home-03.jpg" class="img-fluid" alt="img"></a>
                                                            </div>
                                                            <div class="demo-info">
                                                                <a href="<?php echo base_url(); ?>index-3">Cars</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="single-demo <?php echo ($page == 'index-4') ? 'active' : ''; ?>">
                                                            <div class="demo-img">
                                                                <a href="<?php echo base_url(); ?>index-4"><img src="<?php echo base_url(); ?>assets/img/menu/home-04.jpg" class="img-fluid" alt="img"></a>
                                                            </div>
                                                            <div class="demo-info">
                                                                <a href="<?php echo base_url(); ?>index-4">Flight</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="single-demo <?php echo ($page == 'index-5') ? 'active' : ''; ?>">
                                                            <div class="demo-img">
                                                                <a href="<?php echo base_url(); ?>index-5"><img src="<?php echo base_url(); ?>assets/img/menu/home-05.jpg" class="img-fluid" alt="img"></a>
                                                            </div>
                                                            <div class="demo-info">
                                                                <a href="<?php echo base_url(); ?>index-5">Cruise</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="single-demo <?php echo ($page == 'index-6') ? 'active' : ''; ?>">
                                                            <div class="demo-img">
                                                                <a href="<?php echo base_url(); ?>index-6"><img src="<?php echo base_url(); ?>assets/img/menu/home-06.jpg" class="img-fluid" alt="img"></a>
                                                            </div>
                                                            <div class="demo-info">
                                                                <a href="<?php echo base_url(); ?>index-6">Tours</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu <?php echo ($page == 'flight-grid' || $page == 'flight-list' || $page == 'flight-details' || $page == 'flight-booking-confirmation'|| $page == 'add-flight') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Flight<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h6>Flight Bookings</h6>
                                                        <ul>
                                                        <li class="<?php echo ($page == 'flight-grid') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>flight-grid">Flight Grid</a></li>
                                                            <li class="<?php echo ($page == 'flight-list') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>flight-list">Flight List</a></li>
                                                            <li class="<?php echo ($page == 'flight-details') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>flight-details">Flight Details</a></li>
                                                            <li class="<?php echo ($page == 'flight-booking-confirmation') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>flight-booking-confirmation">Flight Booking</a></li>
                                                            <li class="<?php echo ($page == 'add-flight') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>add-flight">Add Flight</a></li>                                                        
                                                    </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="menu-img">
                                                            <img src="<?php echo base_url(); ?>assets/img/menu/flight.jpg" alt="img" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu <?php echo ($page == 'hotel-grid' || $page == 'hotel-list' || $page == 'hotel-map' || $page == 'hotel-details'|| $page == 'booking-confirmation'|| $page == 'add-hotel') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Hotel<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h6>Hotel Bookings</h6>
                                                        <ul>
                                                        <li class="<?php echo ($page == 'hotel-grid') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>hotel-grid">Hotel Grid</a></li>
                                                            <li class="<?php echo ($page == 'hotel-list') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>hotel-list">Hotel List</a></li>
                                                            <li class="<?php echo ($page == 'hotel-map') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>hotel-map">Hotel Map</a></li>
                                                            <li class="<?php echo ($page == 'hotel-details') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>hotel-details">Hotel Details</a></li>
                                                            <li class="<?php echo ($page == 'booking-confirmation') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>booking-confirmation">Hotel Booking</a></li>
                                                            <li class="<?php echo ($page == 'add-hotel') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>add-hotel">Add Hotel</a></li>  
                                                    </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="menu-img">
                                                            <img src="<?php echo base_url(); ?>assets/img/menu/hotel.jpg" alt="img" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu <?php echo ($page == 'car-grid' || $page == 'car-list' || $page == 'car-map' || $page == 'car-details'|| $page == 'car-booking-confirmation'|| $page == 'add-car') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Car<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h6>Car Bookings</h6>
                                                        <ul>
                                                        <li class="<?php echo ($page == 'car-grid') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>car-grid">Car Grid</a></li>
                                                            <li class="<?php echo ($page == 'car-list') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>car-list">Car List</a></li>
                                                            <li class="<?php echo ($page == 'car-map') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>car-map">Car Map</a></li>
                                                            <li class="<?php echo ($page == 'car-details') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>car-details">Car Details</a></li>
                                                            <li class="<?php echo ($page == 'car-booking-confirmation') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>car-booking-confirmation">Car Booking</a></li>
                                                            <li class="<?php echo ($page == 'add-car') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>add-car">Add Car</a></li> 
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="menu-img">
                                                            <img src="<?php echo base_url(); ?>assets/img/menu/car.jpg" alt="img" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu <?php echo ($page == 'cruise-grid' || $page == 'cruise-list' || $page == 'cruise-map' || $page == 'cruise-details'|| $page == 'cruise-booking-confirmation'|| $page == 'add-cruise') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Cruise<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h6>Cruise Bookings</h6>
                                                        <ul>
                                                        <li class="<?php echo ($page == 'cruise-grid') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>cruise-grid">Cruise Grid</a></li>
                                                            <li class="<?php echo ($page == 'cruise-list') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>cruise-list">Cruise List</a></li>
                                                            <li class="<?php echo ($page == 'cruise-map') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>cruise-map">Cruise Map</a></li>
                                                            <li class="<?php echo ($page == 'cruise-details') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>cruise-details">Cruise Details</a></li>
                                                            <li class="<?php echo ($page == 'cruise-booking-confirmation') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>cruise-booking-confirmation">Cruise Booking</a></li>
                                                            <li class="<?php echo ($page == 'add-cruise') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>add-cruise">Add Cruise</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="menu-img">
                                                            <img src="<?php echo base_url(); ?>assets/img/menu/cruise.jpg" alt="img" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu  <?php echo ($page == 'tour-grid' || $page == 'tour-list' || $page == 'tour-map' || $page == 'tour-details'|| $page == 'tour-booking-confirmation'|| $page == 'add-tour') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Tour<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h6>Tour Bookings</h6>
                                                        <ul>
                                                        <li class="<?php echo ($page == 'tour-grid') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>tour-grid">Tour Grid</a></li>
                                                            <li class="<?php echo ($page == 'tour-list') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>tour-list">Tour List</a></li>
                                                            <li class="<?php echo ($page == 'tour-map') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>tour-map">Tour Map</a></li>
                                                            <li class="<?php echo ($page == 'tour-details') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>tour-details">Tour Details</a></li>
                                                            <li class="<?php echo ($page == 'tour-booking-confirmation') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>tour-booking-confirmation">Tour Booking</a></li>
                                                            <li class="<?php echo ($page == 'add-tour') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>add-tour">Add Tour</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="menu-img">
                                                            <img src="<?php echo base_url(); ?>assets/img/menu/tour.jpg" alt="img" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu <?php echo ($page == 'about-us' || $page == 'gallery' || $page == 'testimonial' || $page == 'faq'|| $page == 'pricing-plan'|| $page == 'team'|| $page == 'invoices'|| $page == 'blog-grid'|| $page == 'blog-list'|| $page == 'blog-details'
                                || $page == 'contact-us'|| $page == 'booking-confirmation'|| $page == 'destination' || $page == 'terms-conditions'|| $page == 'privacy-policy'|| $page == 'login'|| $page == 'register'|| 
                                $page == 'forgot-password'|| $page == 'change-password'|| $page == 'error-404'|| $page == 'error-500'|| $page == 'under-maintenance'|| $page == 'coming-soon'|| $page == 'index-rtl') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Pages<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <h6>Pages</h6>
                                                <div class="row g-lg-4">
                                                    <div class="col-lg-6">
                                                        <ul>
                                                        <li class="<?php echo ($page == 'about-us') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>about-us">About</a></li>
                                                            <li class="<?php echo ($page == 'gallery') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>gallery">Gallery</a></li>
                                                            <li class="<?php echo ($page == 'testimonial') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>testimonial">Testimonials</a></li>
                                                            <li class="<?php echo ($page == 'faq') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>faq">Faq</a></li>
                                                            <li class="<?php echo ($page == 'pricing-plan') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>pricing-plan">Pricing Plan</a></li>
                                                            <li class="<?php echo ($page == 'team') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>team">Teams</a></li>
                                                            <li class="<?php echo ($page == 'invoices') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>invoices">Invoice</a></li>
                                                            <li class="<?php echo ($page == 'blog-grid') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>blog-grid">Blogs Grid</a></li>
                                                            <li class="<?php echo ($page == 'blog-list') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>blog-list">Blogs List</a></li>
                                                            <li class="<?php echo ($page == 'blog-details') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>blog-details">Blogs Details</a></li>
                                                            <li class="<?php echo ($page == 'contact-us') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>contact-us">Contact Us</a></li>
                                                            <li class="<?php echo ($page == 'booking-confirmation') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>booking-confirmation">Booking Confirmation</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <ul>
                                                        <li class="<?php echo ($page == 'destination') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>destination">Destination</a></li>
                                                            <li class="<?php echo ($page == 'terms-conditions') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>terms-conditions">Terms & Conditions</a></li>
                                                            <li class="<?php echo ($page == 'privacy-policy') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>privacy-policy">Privacy Policy</a></li>
                                                            <li class="<?php echo ($page == 'login') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>login">Login</a></li>
                                                            <li class="<?php echo ($page == 'register') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>register">Register</a></li>
                                                            <li class="<?php echo ($page == 'forgot-password') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>forgot-password">Forgot Password</a></li>
                                                            <li class="<?php echo ($page == 'change-password') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>change-password">Change Password</a></li>
                                                            <li class="<?php echo ($page == 'error-404') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>error-404">404 Error</a></li>
                                                            <li class="<?php echo ($page == 'error-500') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>error-500">500 Error</a></li>
                                                            <li class="<?php echo ($page == 'under-maintenance') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>under-maintenance">Under Maintenance</a></li>
                                                            <li class="<?php echo ($page == 'coming-soon') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>coming-soon">Coming Soon</a></li>
                                                            <li class="<?php echo ($page == 'index-rtl') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>index-rtl">RTL</a></li>                                                         
                                                    </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu <?php echo ($page == 'dashboard' || $page == 'customer-flight-booking' || $page == 'review' || $page == 'chat'|| $page == 'wishlist'|| $page == 'wallet'|| $page == 'payment'|| $page == 'profile-settings'|| $page == 'notification-settings'|| $page == 'my-profile'
                                || $page == 'security-settings'|| $page == 'agent-dashboard'|| $page == 'agent-listings' || $page == 'agent-hotel-booking'|| $page == 'agent-enquirers'|| $page == 'agent-earnings'|| $page == 'agent-review'|| 
                                $page == 'agent-settings') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Dashboard<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row g-lg-4">
                                                    <div class="col-lg-6">
                                                        <h6>User Dashboard</h6>
                                                        <ul>
                                                        <li class="<?php echo ($page == 'dashboard') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>
                                                            <li class="<?php echo ($page == 'customer-flight-booking') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>customer-flight-booking">My Bookings</a></li>
                                                            <li class="<?php echo ($page == 'review') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>review">Reviews</a></li>
                                                            <li class="<?php echo ($page == 'chat') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>chat">Message</a></li>
                                                            <li class="<?php echo ($page == 'wishlist') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>wishlist">Wishlist</a></li>
                                                            <li class="<?php echo ($page == 'wallet') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>wallet">Wallet</a></li>
                                                            <li class="<?php echo ($page == 'payment') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>payment">Payments</a></li>
                                                            <li class="<?php echo ($page == 'profile-settings') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>profile-settings">Profile Settings</a></li>
                                                            <li class="<?php echo ($page == 'notification-settings') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>notification-settings">Notifications</a></li>
                                                            <li class="<?php echo ($page == 'my-profile') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>my-profile">My Profile</a></li>
                                                            <li class="<?php echo ($page == 'security-settings') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>security-settings">Settings</a></li>

                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <h6>Agent Dashboard</h6>
                                                        <ul>
                                                        <li class="<?php echo ($page == 'agent-dashboard') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-dashboard">Dashboard</a></li>
                                                            <li class="<?php echo ($page == 'agent-listings') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-listings">Listings</a></li>
                                                            <li class="<?php echo ($page == 'agent-hotel-booking') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-hotel-booking">Bookings</a></li>
                                                            <li class="<?php echo ($page == 'agent-enquirers') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-enquirers">Enquiries</a></li>
                                                            <li class="<?php echo ($page == 'agent-earnings') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-earnings">Earnings</a></li>
                                                            <li class="<?php echo ($page == 'agent-review') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-review">Reviews</a></li>
                                                            <li class="<?php echo ($page == 'agent-settings') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-settings">Settings</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        <div class="header-btn d-flex align-items-center">
                            <div class="dropdown flag-dropdown me-3">
                                <a href="javascript:void(0);" class="d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="<?php echo base_url(); ?>assets/img/flags/us-flag.svg" alt="flag">
                                </a>
                                <ul class="dropdown-menu p-2 mt-2">
                                    <li>
                                        <a class="dropdown-item rounded d-flex align-items-center" href="javascript:void(0);">
                                            <img src="<?php echo base_url(); ?>assets/img/flags/us-flag.svg" class="me-2" alt="flag">ENG
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item rounded d-flex align-items-center" href="javascript:void(0);">
                                            <img src="<?php echo base_url(); ?>assets/img/flags/arab-flag.svg" class="me-2" alt="flag">ARA
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item rounded d-flex align-items-center" href="javascript:void(0);">
                                            <img src="<?php echo base_url(); ?>assets/img/flags/france-flag.svg" class="me-2" alt="flag">FRE
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="dropdown me-3">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
									USD
								</a>
                                <ul class="dropdown-menu p-2 mt-2">
                                    <li><a class="dropdown-item rounded" href="javascript:void(0);">USD</a></li>
                                    <li><a class="dropdown-item rounded" href="javascript:void(0);">YEN</a></li>
                                    <li><a class="dropdown-item rounded" href="javascript:void(0);">EURO</a></li>
                                </ul>
                            </div>
                            <div class="me-3">
                                <a href="<?php echo base_url(); ?>dashboard">
                                    <i class="isax isax-user"></i>
                                </a>
                            </div>
                            <div class="me-3">
                                <a href="javascript:void(0);" id="dark-mode-toggle" class="theme-toggle">
                                    <i class="isax isax-moon"></i>
                                </a>
                                <a href="javascript:void(0);" id="light-mode-toggle" class="theme-toggle">
                                    <i class="isax isax-sun-1"></i>
                                </a>
                            </div>
                            <div class="fav-dropdown me-3">
                                <a href="<?php echo base_url(); ?>wishlist" class="position-relative">
                                    <i class="isax isax-heart"></i><span class="count-icon bg-secondary text-gray-9">0</span>
                                </a>
                            </div>
                            <a href="<?php echo base_url(); ?>become-an-expert" class="btn btn-primary">Become Expert</a>
                            <div class="header__hamburger d-xl-none my-auto">
                                <div class="sidebar-menu">
                                    <i class="isax isax-menu5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- /Header -->
    </div>
<?php } ?>

<?php if ($page == 'index-3') {   ?>

    <div class="main-header">
        <!-- Header -->
        <header class="header-three wow fadeInDown" data-wow-delay="0.3">
            <div class="container">
                <div class="offcanvas-info">
                    <div class="offcanvas-wrap">
                        <div class="offcanvas-detail">
                            <div class="offcanvas-head">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <a href="<?php echo base_url(); ?>index" class="black-logo-responsive">
                                        <img src="<?php echo base_url(); ?>assets/img/logo-dark.svg" alt="logo-img">
                                    </a>
                                    <a href="<?php echo base_url(); ?>index" class="white-logo-responsive">
                                        <img src="<?php echo base_url(); ?>assets/img/logo.svg" alt="logo-img">
                                    </a>
                                    <div class="offcanvas-close">
                                        <i class="ti ti-x"></i>
                                    </div>
                                </div>
                                <div class="wishlist-info d-flex justify-content-between align-items-center">
                                    <h6 class="fs-16 fw-medium">Wishlist</h6>
                                    <div class="d-flex align-items-center">
                                        <div class="fav-dropdown">
                                            <a href="<?php echo base_url(); ?>wishlist" class="position-relative">
                                                <i class="isax isax-heart"></i><span class="count-icon bg-secondary text-gray-9">0</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mobile-menu fix mb-3"></div>
                            <div class="offcanvas__contact">
                                <div class="mt-4">
                                    <div class="header-dropdown d-flex flex-fill">
                                        <div class="w-100">
                                            <div class="dropdown flag-dropdown mb-2">
                                                <a href="javascript:void(0);" class="dropdown-toggle bg-white border d-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <img src="<?php echo base_url(); ?>assets/img/flags/us-flag.svg" class="me-2" alt="flag">ENG
                                                </a>
                                                <ul class="dropdown-menu p-2">
                                                    <li>
                                                        <a class="dropdown-item rounded d-flex align-items-center" href="javascript:void(0);">
                                                            <img src="<?php echo base_url(); ?>assets/img/flags/us-flag.svg" class="me-2" alt="flag">ENG
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item rounded d-flex align-items-center" href="javascript:void(0);">
                                                            <img src="<?php echo base_url(); ?>assets/img/flags/arab-flag.svg" class="me-2" alt="flag">ARA
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item rounded d-flex align-items-center" href="javascript:void(0);">
                                                            <img src="<?php echo base_url(); ?>assets/img/flags/france-flag.svg" class="me-2" alt="flag">FRA
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="dropdown">
                                                <a href="javascript:void(0);" class="dropdown-toggle bg-white border d-block" data-bs-toggle="dropdown" aria-expanded="false">
													USD
												</a>
                                                <ul class="dropdown-menu p-2">
                                                    <li><a class="dropdown-item rounded" href="javascript:void(0);">USD</a></li>
                                                    <li><a class="dropdown-item rounded" href="javascript:void(0);">YEN</a></li>
                                                    <li><a class="dropdown-item rounded" href="javascript:void(0);">EURO</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div><a href="javascript:void(0);" class="text-white btn btn-dark w-100 mb-3" data-bs-toggle="modal" data-bs-target="#login-modal">Sign In</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="offcanvas-overlay"></div>
                <div class="header-nav">
                    <div class="main-menu-wrapper">
                        <div class="navbar-logo">
                            <a class="logo-white header-logo" href="<?php echo base_url(); ?>index">
                                <img src="<?php echo base_url(); ?>assets/img/logo-dark.svg" class="logo" alt="Logo">
                            </a>
                            <a class="logo-dark header-logo" href="<?php echo base_url(); ?>index">
                                <img src="<?php echo base_url(); ?>assets/img/logo.svg" class="logo" alt="Logo">
                            </a>
                        </div>
                        <nav id="mobile-menu">
                            <ul class="main-nav">
                                <li class="has-submenu megamenu <?php echo ($page == 'index' || $page == 'index-2' || $page == 'index-3' || $page == 'index-4'|| $page == 'index-5'|| $page == 'index-6') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Home<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="d-none d-lg-flex align-items-center justify-content-between flex-wrap">
                                                    <h6 class="mb-3">Home Pages</h6>
                                                    <a href="javascript:void(0);" class="btn btn-dark btn-md mb-3 text-white d-inline-block w-auto">Purchase Template</a>
                                                </div>
                                                <div class="row g-lg-4">
                                                    <div class="col-lg-2">
                                                        <div class="single-demo <?php echo ($page == 'index') ? 'active' : ''; ?>">
                                                            <div class="demo-img">
                                                                <a href="<?php echo base_url(); ?>index"><img src="<?php echo base_url(); ?>assets/img/menu/home-01.jpg" class="img-fluid" alt="img"></a>
                                                            </div>
                                                            <div class="demo-info">
                                                                <a href="<?php echo base_url(); ?>index">All Bookings</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="single-demo <?php echo ($page == 'index-2') ? 'active' : ''; ?>">
                                                            <div class="demo-img">
                                                                <a href="<?php echo base_url(); ?>index-2"><img src="<?php echo base_url(); ?>assets/img/menu/home-02.jpg" class="img-fluid" alt="img"></a>
                                                            </div>
                                                            <div class="demo-info">
                                                                <a href="<?php echo base_url(); ?>index-2">Hotels</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="single-demo <?php echo ($page == 'index-3') ? 'active' : ''; ?>">
                                                            <div class="demo-img">
                                                                <a href="<?php echo base_url(); ?>index-3"><img src="<?php echo base_url(); ?>assets/img/menu/home-03.jpg" class="img-fluid" alt="img"></a>
                                                            </div>
                                                            <div class="demo-info">
                                                                <a href="<?php echo base_url(); ?>index-3">Cars</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="single-demo <?php echo ($page == 'index-4') ? 'active' : ''; ?>">
                                                            <div class="demo-img">
                                                                <a href="<?php echo base_url(); ?>index-4"><img src="<?php echo base_url(); ?>assets/img/menu/home-04.jpg" class="img-fluid" alt="img"></a>
                                                            </div>
                                                            <div class="demo-info">
                                                                <a href="<?php echo base_url(); ?>index-4">Flight</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="single-demo <?php echo ($page == 'index-5') ? 'active' : ''; ?>">
                                                            <div class="demo-img">
                                                                <a href="<?php echo base_url(); ?>index-5"><img src="<?php echo base_url(); ?>assets/img/menu/home-05.jpg" class="img-fluid" alt="img"></a>
                                                            </div>
                                                            <div class="demo-info">
                                                                <a href="<?php echo base_url(); ?>index-5">Cruise</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="single-demo <?php echo ($page == 'index-6') ? 'active' : ''; ?>">
                                                            <div class="demo-img">
                                                                <a href="<?php echo base_url(); ?>index-6"><img src="<?php echo base_url(); ?>assets/img/menu/home-06.jpg" class="img-fluid" alt="img"></a>
                                                            </div>
                                                            <div class="demo-info">
                                                                <a href="<?php echo base_url(); ?>index-6">Tours</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu <?php echo ($page == 'flight-grid' || $page == 'flight-list' || $page == 'flight-details' || $page == 'flight-booking-confirmation'|| $page == 'add-flight') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Flight<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h6>Flight Bookings</h6>
                                                        <ul>
                                                            <li class="<?php echo ($page == 'flight-grid') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>flight-grid">Flight Grid</a></li>
                                                            <li class="<?php echo ($page == 'flight-list') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>flight-list">Flight List</a></li>
                                                            <li class="<?php echo ($page == 'flight-details') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>flight-details">Flight Details</a></li>
                                                            <li class="<?php echo ($page == 'flight-booking-confirmation') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>flight-booking-confirmation">Flight Booking</a></li>
                                                            <li class="<?php echo ($page == 'add-flight') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>add-flight">Add Flight</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="menu-img">
                                                            <img src="<?php echo base_url(); ?>assets/img/menu/flight.jpg" alt="img" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu <?php echo ($page == 'hotel-grid' || $page == 'hotel-list' || $page == 'hotel-map' || $page == 'hotel-details'|| $page == 'booking-confirmation'|| $page == 'add-hotel') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Hotel<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h6>Hotel Bookings</h6>
                                                        <ul>
                                                            <li class="<?php echo ($page == 'hotel-grid') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>hotel-grid">Hotel Grid</a></li>
                                                            <li class="<?php echo ($page == 'hotel-list') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>hotel-list">Hotel List</a></li>
                                                            <li class="<?php echo ($page == 'hotel-map') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>hotel-map">Hotel Map</a></li>
                                                            <li class="<?php echo ($page == 'hotel-details') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>hotel-details">Hotel Details</a></li>
                                                            <li class="<?php echo ($page == 'booking-confirmation') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>booking-confirmation">Hotel Booking</a></li>
                                                            <li class="<?php echo ($page == 'add-hotel') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>add-hotel">Add Hotel</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="menu-img">
                                                            <img src="<?php echo base_url(); ?>assets/img/menu/hotel.jpg" alt="img" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu <?php echo ($page == 'car-grid' || $page == 'car-list' || $page == 'car-map' || $page == 'car-details'|| $page == 'car-booking-confirmation'|| $page == 'add-car') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Car<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h6>Car Bookings</h6>
                                                        <ul>
                                                            <li class="<?php echo ($page == 'car-grid') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>car-grid">Car Grid</a></li>
                                                            <li class="<?php echo ($page == 'car-list') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>car-list">Car List</a></li>
                                                            <li class="<?php echo ($page == 'car-map') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>car-map">Car Map</a></li>
                                                            <li class="<?php echo ($page == 'car-details') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>car-details">Car Details</a></li>
                                                            <li class="<?php echo ($page == 'car-booking-confirmation') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>car-booking-confirmation">Car Booking</a></li>
                                                            <li class="<?php echo ($page == 'add-car') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>add-car">Add Car</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="menu-img">
                                                            <img src="<?php echo base_url(); ?>assets/img/menu/car.jpg" alt="img" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu <?php echo ($page == 'cruise-grid' || $page == 'cruise-list' || $page == 'cruise-map' || $page == 'cruise-details'|| $page == 'cruise-booking-confirmation'|| $page == 'add-cruise') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Cruise<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h6>Cruise Bookings</h6>
                                                        <ul>
                                                            <li class="<?php echo ($page == 'cruise-grid') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>cruise-grid">Cruise Grid</a></li>
                                                            <li class="<?php echo ($page == 'cruise-list') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>cruise-list">Cruise List</a></li>
                                                            <li class="<?php echo ($page == 'cruise-map') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>cruise-map">Cruise Map</a></li>
                                                            <li class="<?php echo ($page == 'cruise-details') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>cruise-details">Cruise Details</a></li>
                                                            <li class="<?php echo ($page == 'cruise-booking-confirmation') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>cruise-booking-confirmation">Cruise Booking</a></li>
                                                            <li class="<?php echo ($page == 'add-cruise') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>add-cruise">Add Cruise</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="menu-img">
                                                            <img src="<?php echo base_url(); ?>assets/img/menu/cruise.jpg" alt="img" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu <?php echo ($page == 'tour-grid' || $page == 'tour-list' || $page == 'tour-map' || $page == 'tour-details'|| $page == 'tour-booking-confirmation'|| $page == 'add-tour') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Tour<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h6>Tour Bookings</h6>
                                                        <ul>
                                                        <li class="<?php echo ($page == 'tour-grid') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>tour-grid">Tour Grid</a></li>
                                                            <li class="<?php echo ($page == 'tour-list') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>tour-list">Tour List</a></li>
                                                            <li class="<?php echo ($page == 'tour-map') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>tour-map">Tour Map</a></li>
                                                            <li class="<?php echo ($page == 'tour-details') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>tour-details">Tour Details</a></li>
                                                            <li class="<?php echo ($page == 'tour-booking-confirmation') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>tour-booking-confirmation">Tour Booking</a></li>
                                                            <li class="<?php echo ($page == 'add-tour') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>add-tour">Add Tour</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="menu-img">
                                                            <img src="<?php echo base_url(); ?>assets/img/menu/tour.jpg" alt="img" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu <?php echo ($page == 'about-us' || $page == 'gallery' || $page == 'testimonial' || $page == 'faq'|| $page == 'pricing-plan'|| $page == 'team'|| $page == 'invoices'|| $page == 'blog-grid'|| $page == 'blog-list'|| $page == 'blog-details'
                                || $page == 'contact-us'|| $page == 'booking-confirmation'|| $page == 'destination' || $page == 'terms-conditions'|| $page == 'privacy-policy'|| $page == 'login'|| $page == 'register'|| 
                                $page == 'forgot-password'|| $page == 'change-password'|| $page == 'error-404'|| $page == 'error-500'|| $page == 'under-maintenance'|| $page == 'coming-soon'|| $page == 'index-rtl') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Pages<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <h6>Pages</h6>
                                                <div class="row g-lg-4">
                                                    <div class="col-lg-6">
                                                        <ul>
                                                        <li class="<?php echo ($page == 'about-us') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>about-us">About</a></li>
                                                            <li class="<?php echo ($page == 'gallery') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>gallery">Gallery</a></li>
                                                            <li class="<?php echo ($page == 'testimonial') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>testimonial">Testimonials</a></li>
                                                            <li class="<?php echo ($page == 'faq') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>faq">Faq</a></li>
                                                            <li class="<?php echo ($page == 'pricing-plan') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>pricing-plan">Pricing Plan</a></li>
                                                            <li class="<?php echo ($page == 'team') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>team">Teams</a></li>
                                                            <li class="<?php echo ($page == 'invoices') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>invoices">Invoice</a></li>
                                                            <li class="<?php echo ($page == 'blog-grid') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>blog-grid">Blogs Grid</a></li>
                                                            <li class="<?php echo ($page == 'blog-list') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>blog-list">Blogs List</a></li>
                                                            <li class="<?php echo ($page == 'blog-details') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>blog-details">Blogs Details</a></li>
                                                            <li class="<?php echo ($page == 'contact-us') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>contact-us">Contact Us</a></li>
                                                            <li class="<?php echo ($page == 'booking-confirmation') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>booking-confirmation">Booking Confirmation</a></li>

                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                    <ul>
                                                            <li class="<?php echo ($page == 'destination') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>destination">Destination</a></li>
                                                            <li class="<?php echo ($page == 'terms-conditions') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>terms-conditions">Terms & Conditions</a></li>
                                                            <li class="<?php echo ($page == 'privacy-policy') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>privacy-policy">Privacy Policy</a></li>
                                                            <li class="<?php echo ($page == 'login') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>login">Login</a></li>
                                                            <li class="<?php echo ($page == 'register') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>register">Register</a></li>
                                                            <li class="<?php echo ($page == 'forgot-password') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>forgot-password">Forgot Password</a></li>
                                                            <li class="<?php echo ($page == 'change-password') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>change-password">Change Password</a></li>
                                                            <li class="<?php echo ($page == 'error-404') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>error-404">404 Error</a></li>
                                                            <li class="<?php echo ($page == 'error-500') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>error-500">500 Error</a></li>
                                                            <li class="<?php echo ($page == 'under-maintenance') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>under-maintenance">Under Maintenance</a></li>
                                                            <li class="<?php echo ($page == 'coming-soon') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>coming-soon">Coming Soon</a></li>
                                                            <li class="<?php echo ($page == 'index-rtl') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>index-rtl">RTL</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu <?php echo ($page == 'dashboard' || $page == 'customer-flight-booking' || $page == 'review' || $page == 'chat'|| $page == 'wishlist'|| $page == 'wallet'|| $page == 'payment'|| $page == 'profile-settings'|| $page == 'notification-settings'|| $page == 'my-profile'
                                || $page == 'security-settings'|| $page == 'agent-dashboard'|| $page == 'agent-listings' || $page == 'agent-hotel-booking'|| $page == 'agent-enquirers'|| $page == 'agent-earnings'|| $page == 'agent-review'|| 
                                $page == 'agent-settings') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Dashboard<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row g-lg-4">
                                                    <div class="col-lg-6">
                                                        <h6>User Dashboard</h6>
                                                        <ul>
                                                            <li class="<?php echo ($page == 'dashboard') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>
                                                            <li class="<?php echo ($page == 'customer-flight-booking') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>customer-flight-booking">My Bookings</a></li>
                                                            <li class="<?php echo ($page == 'review') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>review">Reviews</a></li>
                                                            <li class="<?php echo ($page == 'chat') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>chat">Message</a></li>
                                                            <li class="<?php echo ($page == 'wishlist') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>wishlist">Wishlist</a></li>
                                                            <li class="<?php echo ($page == 'wallet') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>wallet">Wallet</a></li>
                                                            <li class="<?php echo ($page == 'payment') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>payment">Payments</a></li>
                                                            <li class="<?php echo ($page == 'profile-settings') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>profile-settings">Profile Settings</a></li>
                                                            <li class="<?php echo ($page == 'notification-settings') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>notification-settings">Notifications</a></li>
                                                            <li class="<?php echo ($page == 'my-profile') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>my-profile">My Profile</a></li>
                                                            <li class="<?php echo ($page == 'security-settings') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>security-settings">Settings</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <h6>Agent Dashboard</h6>
                                                        <ul>
                                                            <li class="<?php echo ($page == 'agent-dashboard') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-dashboard">Dashboard</a></li>
                                                            <li class="<?php echo ($page == 'agent-listings') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-listings">Listings</a></li>
                                                            <li class="<?php echo ($page == 'agent-hotel-booking') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-hotel-booking">Bookings</a></li>
                                                            <li class="<?php echo ($page == 'agent-enquirers') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-enquirers">Enquiries</a></li>
                                                            <li class="<?php echo ($page == 'agent-earnings') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-earnings">Earnings</a></li>
                                                            <li class="<?php echo ($page == 'agent-review') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-review">Reviews</a></li>
                                                            <li class="<?php echo ($page == 'agent-settings') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-settings">Settings</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        <div class="header-btn d-flex align-items-center">
                            <div class="cart-dropdown me-3">
                                <a href="<?php echo base_url(); ?>dashboard" class="position-relative">
                                    <i class="isax isax-user"></i>
                                </a>
                            </div>
                            <div class="me-3">
                                <a href="javascript:void(0);" id="dark-mode-toggle" class="theme-toggle">
                                    <i class="isax isax-moon"></i>
                                </a>
                                <a href="javascript:void(0);" id="light-mode-toggle" class="theme-toggle">
                                    <i class="isax isax-sun-1"></i>
                                </a>
                            </div>
                            <div class="fav-dropdown me-3">
                                <a href="<?php echo base_url(); ?>wishlist" class="position-relative">
                                    <i class="isax isax-heart"></i><span class="count-icon bg-secondary text-gray-9">0</span>
                                </a>
                            </div>
                            <div><a href="javascript:void(0);" class="text-white fs-13 btn btn-dark btn-md" data-bs-toggle="modal" data-bs-target="#login-modal">Sign In</a></div>
                            <div class="header__hamburger d-xl-none my-auto">
                                <div class="sidebar-menu">
                                    <i class="isax isax-menu5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- /Header -->
    </div>

<?php } ?>

<?php if ($page == 'index-4') {   ?>

    <div class="main-header main-header-four">
        <!-- Header Topbar-->
        <div class="header-topbar topbar-four text-center bg-transparent">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <div class="d-flex align-items-center flex-wrap">
                        <p class="d-flex align-items-center fs-14 mb-2 me-3 "><i class="isax isax-call5 me-2"></i>Numero de Contacto : +1 56565 56594</p>
                        <p class="mb-2 d-flex align-items-center fs-14"><i class="isax isax-message-text-15 me-2"></i>Email : info@example.com</p>
                    </div>
                    <div class="d-flex align-items-center">
                        
                         <?php
                        $locale = service('request')->getLocale();
                        ?>

                        <div class="dropdown flag-dropdown mb-2 me-3">
                            <a href="javascript:void(0);" class="dropdown-toggle d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                
                                <?php // Lógica para mostrar la bandera y el texto del idioma activo ?>
                                <?php if ($locale === 'es'): ?>
                                    <img src="<?= base_url('assets/img/flags/es.png') ?>" class="me-2" alt="Bandera de España"> ESP
                                <?php else: ?>
                                    <img src="<?= base_url('assets/img/flags/us-flag.svg') ?>" class="me-2" alt="Bandera de EE.UU."> ENG
                                <?php endif; ?>

                            </a>
                            <ul class="dropdown-menu p-2 mt-2">
                              
                            
                                <li>
                                    <?php // Enlace para cambiar a Inglés ?>
                                    <a class="dropdown-item rounded d-flex align-items-center" href="<?= site_url('language/set/en') ?>">
                                        <img src="<?= base_url('assets/img/flags/us-flag.svg') ?>" class="me-2" alt="Bandera de EE.UU.">ENG
                                    </a>
                                </li>
                                <li>
                                    <?php // Enlace para cambiar a Español ?>
                                    <a class="dropdown-item rounded d-flex align-items-center" href="<?= site_url('language/set/es') ?>">
                                        <img src="<?= base_url('assets/img/flags/es.png') ?>" class="me-2" alt="Bandera de España">ESP
                                    </a>
                                </li>
                                <?php // Puedes añadir más idiomas aquí en el futuro cuando los soportes ?>
                            </ul>
                        </div>
                        <div class="dropdown mb-2">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
								USD
							</a>
                            <ul class="dropdown-menu p-2 mt-2">
                                <li><a class="dropdown-item rounded" href="javascript:void(0);">USD</a></li>
                                <li><a class="dropdown-item rounded" href="javascript:void(0);">YEN</a></li>
                                <li><a class="dropdown-item rounded" href="javascript:void(0);">EURO</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Header Topbar-->

        <!-- Header -->
        <header class="header-four">
            <div class="container-fluid">
                <div class="offcanvas-info">
                    <div class="offcanvas-wrap">
                        <div class="offcanvas-detail">
                            <div class="offcanvas-head">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <a href="<?php echo base_url(); ?>index" class="black-logo-responsive">
                                        <img src="<?php echo base_url(); ?>assets/img/logo-dark.svg" alt="logo-img">
                                    </a>
                                    <a href="<?php echo base_url(); ?>index" class="white-logo-responsive">
                                        <img src="<?php echo base_url(); ?>assets/img/logo.svg" alt="logo-img">
                                    </a>
                                    <div class="offcanvas-close">
                                        <i class="ti ti-x"></i>
                                    </div>
                                </div>
                                <div class="wishlist-info d-flex justify-content-between align-items-center">
                                    <h6 class="fs-16 fw-medium">Wishlist</h6>
                                    <div class="d-flex align-items-center">
                                        <div class="fav-dropdown">
                                            <a href="<?php echo base_url(); ?>wishlist" class="position-relative">
                                                <i class="isax isax-heart"></i><span class="count-icon bg-secondary text-gray-9">0</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mobile-menu fix mb-3"></div>
                            <div class="offcanvas__contact">
                                <div class="mt-4">
                                    <div class="header-dropdown d-flex flex-fill">
                                        <div class="w-100">
                                            <div class="dropdown flag-dropdown mb-2">
                                                <a href="javascript:void(0);" class="dropdown-toggle bg-white border d-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <img src="<?php echo base_url(); ?>assets/img/flags/us-flag.svg" class="me-2" alt="flag">ENG
                                                </a>
                                                <ul class="dropdown-menu p-2">
                                                    <li>
                                                        <a class="dropdown-item rounded d-flex align-items-center" href="javascript:void(0);">
                                                            <img src="<?php echo base_url(); ?>assets/img/flags/us-flag.svg" class="me-2" alt="flag">ENG
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item rounded d-flex align-items-center" href="javascript:void(0);">
                                                            <img src="<?php echo base_url(); ?>assets/img/flags/arab-flag.svg" class="me-2" alt="flag">ARA
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item rounded d-flex align-items-center" href="javascript:void(0);">
                                                            <img src="<?php echo base_url(); ?>assets/img/flags/france-flag.svg" class="me-2" alt="flag">FRA
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="dropdown">
                                                <a href="javascript:void(0);" class="dropdown-toggle bg-white border d-block" data-bs-toggle="dropdown" aria-expanded="false">
													USD
												</a>
                                                <ul class="dropdown-menu p-2">
                                                    <li><a class="dropdown-item rounded" href="javascript:void(0);">USD</a></li>
                                                    <li><a class="dropdown-item rounded" href="javascript:void(0);">YEN</a></li>
                                                    <li><a class="dropdown-item rounded" href="javascript:void(0);">EURO</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn btn-dark w-100 mb-3"><a href="javascript:void(0);" class="text-white" data-bs-toggle="modal" data-bs-target="#login-modal">Sign In</a> / <a href="javascript:void(0);" class="text-white" data-bs-toggle="modal" data-bs-target="#register-modal">Sign Up</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="offcanvas-overlay"></div>
                <div class="header-nav">
                    <div class="main-menu-wrapper">
                        <div class="navbar-logo">
                            <a class="logo-white header-logo" href="<?php echo base_url(); ?>index">
                                <img src="<?php echo base_url(); ?>assets/img/logo-dark.svg" class="logo" alt="Logo">
                            </a>
                            <a class="logo-dark header-logo" href="<?php echo base_url(); ?>index">
                                <img src="<?php echo base_url(); ?>assets/img/logo.svg" class="logo" alt="Logo">
                            </a>
                        </div>
                        <nav id="mobile-menu">
                            <ul class="main-nav">
                                
                            
                      
                                <li class="has-submenu megamenu <?php echo ($page == 'index' ? 'active subdrop' : ''); ?>">
                                    <a href="<?= site_url('/') ?>"><?= lang('Site.menu.home') ?><i class="fa-solid"></i></a>
                                </li>

                                <li class="has-submenu megamenu <?php echo ($page == 'tours' ? 'active subdrop' : ''); ?>">
                                    <a href="<?= site_url('tours') ?>"><?= lang('Site.menu.tours') ?><i class="fa-solid "></i></a>
                                </li>
                                <li class="has-submenu mega-innermenu <?php echo ($page == 'flight-grid' || $page == 'flight-list' || $page == 'flight-details' || $page == 'flight-booking-confirmation'|| $page == 'add-flight') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Flight<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h6>Flight Bookings</h6>
                                                        <ul>
                                                            <li class="<?php echo ($page == 'flight-grid') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>flight-grid">Flight Grid</a></li>
                                                            <li class="<?php echo ($page == 'flight-list') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>flight-list">Flight List</a></li>
                                                            <li class="<?php echo ($page == 'flight-details') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>flight-details">Flight Details</a></li>
                                                            <li class="<?php echo ($page == 'flight-booking-confirmation') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>flight-booking-confirmation">Flight Booking</a></li>
                                                            <li class="<?php echo ($page == 'add-flight') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>add-flight">Add Flight</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="menu-img">
                                                            <img src="<?php echo base_url(); ?>assets/img/menu/flight.jpg" alt="img" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu <?php echo ($page == 'hotel-grid' || $page == 'hotel-list' || $page == 'hotel-map' || $page == 'hotel-details'|| $page == 'booking-confirmation'|| $page == 'add-hotel') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Hotel<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h6>Hotel Bookings</h6>
                                                        <ul>
                                                            <li class="<?php echo ($page == 'hotel-grid') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>hotel-grid">Hotel Grid</a></li>
                                                            <li class="<?php echo ($page == 'hotel-list') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>hotel-list">Hotel List</a></li>
                                                            <li class="<?php echo ($page == 'hotel-map') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>hotel-map">Hotel Map</a></li>
                                                            <li class="<?php echo ($page == 'hotel-details') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>hotel-details">Hotel Details</a></li>
                                                            <li class="<?php echo ($page == 'booking-confirmation') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>booking-confirmation">Hotel Booking</a></li>
                                                            <li class="<?php echo ($page == 'add-hotel') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>add-hotel">Add Hotel</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="menu-img">
                                                            <img src="<?php echo base_url(); ?>assets/img/menu/hotel.jpg" alt="img" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu <?php echo ($page == 'car-grid' || $page == 'car-list' || $page == 'car-map' || $page == 'car-details'|| $page == 'car-booking-confirmation'|| $page == 'add-car') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Car<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h6>Car Bookings</h6>
                                                        <ul>
                                                            <li class="<?php echo ($page == 'car-grid') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>car-grid">Car Grid</a></li>
                                                            <li class="<?php echo ($page == 'car-list') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>car-list">Car List</a></li>
                                                            <li class="<?php echo ($page == 'car-map') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>car-map">Car Map</a></li>
                                                            <li class="<?php echo ($page == 'car-details') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>car-details">Car Details</a></li>
                                                            <li class="<?php echo ($page == 'car-booking-confirmation') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>car-booking-confirmation">Car Booking</a></li>
                                                            <li class="<?php echo ($page == 'add-car') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>add-car">Add Car</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="menu-img">
                                                            <img src="<?php echo base_url(); ?>assets/img/menu/car.jpg" alt="img" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu <?php echo ($page == 'cruise-grid' || $page == 'cruise-list' || $page == 'cruise-map' || $page == 'cruise-details'|| $page == 'cruise-booking-confirmation'|| $page == 'add-cruise') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Cruise<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h6>Cruise Bookings</h6>
                                                        <ul>
                                                            <li class="<?php echo ($page == 'cruise-grid') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>cruise-grid">Cruise Grid</a></li>
                                                            <li class="<?php echo ($page == 'cruise-list') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>cruise-list">Cruise List</a></li>
                                                            <li class="<?php echo ($page == 'cruise-map') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>cruise-map">Cruise Map</a></li>
                                                            <li class="<?php echo ($page == 'cruise-details') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>cruise-details">Cruise Details</a></li>
                                                            <li class="<?php echo ($page == 'cruise-booking-confirmation') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>cruise-booking-confirmation">Cruise Booking</a></li>
                                                            <li class="<?php echo ($page == 'add-cruise') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>add-cruise">Add Cruise</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="menu-img">
                                                            <img src="<?php echo base_url(); ?>assets/img/menu/cruise.jpg" alt="img" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu <?php echo ($page == 'tour-grid' || $page == 'tour-list' || $page == 'tour-map' || $page == 'tour-details'|| $page == 'tour-booking-confirmation'|| $page == 'add-tour') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Tour<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h6>Tour Bookings</h6>
                                                        <ul>
                                                            <li class="<?php echo ($page == 'tour-grid') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>tour-grid">Tour Grid</a></li>
                                                            <li class="<?php echo ($page == 'tour-list') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>tour-list">Tour List</a></li>
                                                            <li class="<?php echo ($page == 'tour-map') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>tour-map">Tour Map</a></li>
                                                            <li class="<?php echo ($page == 'tour-details') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>tour-details">Tour Details</a></li>
                                                            <li class="<?php echo ($page == 'tour-booking-confirmation') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>tour-booking-confirmation">Tour Booking</a></li>
                                                            <li class="<?php echo ($page == 'add-tour') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>add-tour">Add Tour</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="menu-img">
                                                            <img src="<?php echo base_url(); ?>assets/img/menu/tour.jpg" alt="img" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu <?php echo ($page == 'about-us' || $page == 'gallery' || $page == 'testimonial' || $page == 'faq'|| $page == 'pricing-plan'|| $page == 'team'|| $page == 'invoices'|| $page == 'blog-grid'|| $page == 'blog-list'|| $page == 'blog-details'
                                || $page == 'contact-us'|| $page == 'booking-confirmation'|| $page == 'destination' || $page == 'terms-conditions'|| $page == 'privacy-policy'|| $page == 'login'|| $page == 'register'|| 
                                $page == 'forgot-password'|| $page == 'change-password'|| $page == 'error-404'|| $page == 'error-500'|| $page == 'under-maintenance'|| $page == 'coming-soon'|| $page == 'index-rtl') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Pages<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <h6>Pages</h6>
                                                <div class="row g-lg-4">
                                                    <div class="col-lg-6">
                                                    <ul>
                                                            <li class="<?php echo ($page == 'about-us') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>about-us">About</a></li>
                                                            <li class="<?php echo ($page == 'gallery') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>gallery">Gallery</a></li>
                                                            <li class="<?php echo ($page == 'testimonial') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>testimonial">Testimonials</a></li>
                                                            <li class="<?php echo ($page == 'faq') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>faq">Faq</a></li>
                                                            <li class="<?php echo ($page == 'pricing-plan') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>pricing-plan">Pricing Plan</a></li>
                                                            <li class="<?php echo ($page == 'team') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>team">Teams</a></li>
                                                            <li class="<?php echo ($page == 'invoices') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>invoices">Invoice</a></li>
                                                            <li class="<?php echo ($page == 'blog-grid') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>blog-grid">Blogs Grid</a></li>
                                                            <li class="<?php echo ($page == 'blog-list') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>blog-list">Blogs List</a></li>
                                                            <li class="<?php echo ($page == 'blog-details') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>blog-details">Blogs Details</a></li>
                                                            <li class="<?php echo ($page == 'contact-us') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>contact-us">Contact Us</a></li>
                                                            <li class="<?php echo ($page == 'booking-confirmation') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>booking-confirmation">Booking Confirmation</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                    <ul>
                                                            <li class="<?php echo ($page == 'destination') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>destination">Destination</a></li>
                                                            <li class="<?php echo ($page == 'terms-conditions') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>terms-conditions">Terms & Conditions</a></li>
                                                            <li class="<?php echo ($page == 'privacy-policy') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>privacy-policy">Privacy Policy</a></li>
                                                            <li class="<?php echo ($page == 'login') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>login">Login</a></li>
                                                            <li class="<?php echo ($page == 'register') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>register">Register</a></li>
                                                            <li class="<?php echo ($page == 'forgot-password') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>forgot-password">Forgot Password</a></li>
                                                            <li class="<?php echo ($page == 'change-password') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>change-password">Change Password</a></li>
                                                            <li class="<?php echo ($page == 'error-404') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>error-404">404 Error</a></li>
                                                            <li class="<?php echo ($page == 'error-500') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>error-500">500 Error</a></li>
                                                            <li class="<?php echo ($page == 'under-maintenance') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>under-maintenance">Under Maintenance</a></li>
                                                            <li class="<?php echo ($page == 'coming-soon') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>coming-soon">Coming Soon</a></li>
                                                            <li class="<?php echo ($page == 'index-rtl') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>index-rtl">RTL</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu  <?php echo ($page == 'dashboard' || $page == 'customer-flight-booking' || $page == 'review' || $page == 'chat'|| $page == 'wishlist'|| $page == 'wallet'|| $page == 'payment'|| $page == 'profile-settings'|| $page == 'notification-settings'|| $page == 'my-profile'
                                || $page == 'security-settings'|| $page == 'agent-dashboard'|| $page == 'agent-listings' || $page == 'agent-hotel-booking'|| $page == 'agent-enquirers'|| $page == 'agent-earnings'|| $page == 'agent-review'|| 
                                $page == 'agent-settings') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Dashboard<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row g-lg-4">
                                                    <div class="col-lg-6">
                                                        <h6>User Dashboard</h6>
                                                        <ul>
                                                            <li class="<?php echo ($page == 'dashboard') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>
                                                            <li class="<?php echo ($page == 'customer-flight-booking') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>customer-flight-booking">My Bookings</a></li>
                                                            <li class="<?php echo ($page == 'review') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>review">Reviews</a></li>
                                                            <li class="<?php echo ($page == 'chat') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>chat">Message</a></li>
                                                            <li class="<?php echo ($page == 'wishlist') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>wishlist">Wishlist</a></li>
                                                            <li class="<?php echo ($page == 'wallet') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>wallet">Wallet</a></li>
                                                            <li class="<?php echo ($page == 'payment') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>payment">Payments</a></li>
                                                            <li class="<?php echo ($page == 'profile-settings') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>profile-settings">Profile Settings</a></li>
                                                            <li class="<?php echo ($page == 'notification-settings') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>notification-settings">Notifications</a></li>
                                                            <li class="<?php echo ($page == 'my-profile') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>my-profile">My Profile</a></li>
                                                            <li class="<?php echo ($page == 'security-settings') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>security-settings">Settings</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <h6>Agent Dashboard</h6>
                                                        <ul>
                                                            <li class="<?php echo ($page == 'agent-dashboard') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-dashboard">Dashboard</a></li>
                                                            <li class="<?php echo ($page == 'agent-listings') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-listings">Listings</a></li>
                                                            <li class="<?php echo ($page == 'agent-hotel-booking') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-hotel-booking">Bookings</a></li>
                                                            <li class="<?php echo ($page == 'agent-enquirers') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-enquirers">Enquiries</a></li>
                                                            <li class="<?php echo ($page == 'agent-earnings') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-earnings">Earnings</a></li>
                                                            <li class="<?php echo ($page == 'agent-review') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-review">Reviews</a></li>
                                                            <li class="<?php echo ($page == 'agent-settings') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-settings">Settings</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        <div class="header-btn d-flex align-items-center">
                            <div class="me-3">
                                <a href="javascript:void(0);" id="dark-mode-toggle" class="theme-toggle">
                                    <i class="isax isax-moon"></i>
                                </a>
                                <a href="javascript:void(0);" id="light-mode-toggle" class="theme-toggle">
                                    <i class="isax isax-sun-1"></i>
                                </a>
                            </div>
                            <div class="fav-dropdown me-3">
                                <a href="<?php echo base_url(); ?>wishlist" class="position-relative">
                                    <i class="isax isax-heart"></i><span class="count-icon bg-secondary text-gray-9">0</span>
                                </a>
                            </div>
                            <!-- <a href="<?php echo base_url(); ?>add-flight" class="btn btn-dark d-inline-flex align-items-center me-3"><i class="isax isax-lock me-2"></i>Add Your Listing</a> -->
                            <?php if (session()->has('user')): ?>
                                


                                <?php // --- El usuario SÍ ha iniciado sesión --- ?>
                                <a href="<?= site_url('auth/logout') ?>" class="btn btn-dark d-inline-flex align-items-center me-0">
                                    <i class="isax isax-logout me-2"></i><?= lang('Site.menu.logout') ?>
                                </a>

                            <?php else: ?>

                                <?php // --- El usuario NO ha iniciado sesión --- ?>
                                <!-- <a href="<?= site_url('auth/login') ?>" class="btn btn-dark d-inline-flex align-items-center me-0">
                                    <i class="isax isax-login me-2"></i><?= lang('Site.menu.login') ?>
                                </a> -->
                                <div><a href="javascript:void(0);" class="btn btn-white me-3" data-bs-toggle="modal" data-bs-target="#login-modal"><?= lang('Site.menu.login') ?></a></div>

                            <!-- <a href="javascript:void(0);" class="btn btn-dark d-inline-flex align-items-center me-0"><i class="isax isax-lock me-2" data-bs-toggle="modal" data-bs-target="#login-modal"></i><?= lang('Site.menu.login') ?></a> -->
                            <?php endif; ?>
                            <div class="header__hamburger d-xl-none my-auto">
                                <div class="sidebar-menu">
                                    <i class="isax isax-menu5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- /Header -->
    </div>

<?php } ?>

<?php if ($page == 'index-5') {   ?>

    <div class="main-header">
        <!-- Header -->
        <header class="header-five wow fadeInDown" data-wow-delay="0.3">
            <div class="container">
                <div class="offcanvas-info">
                    <div class="offcanvas-wrap">
                        <div class="offcanvas-detail">
                            <div class="offcanvas-head">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <a href="<?php echo base_url(); ?>index" class="black-logo-responsive">
                                        <img src="<?php echo base_url(); ?>assets/img/logo-dark.svg" alt="logo-img">
                                    </a>
                                    <a href="<?php echo base_url(); ?>index" class="white-logo-responsive">
                                        <img src="<?php echo base_url(); ?>assets/img/logo.svg" alt="logo-img">
                                    </a>
                                    <div class="offcanvas-close">
                                        <i class="ti ti-x"></i>
                                    </div>
                                </div>
                                <div class="wishlist-info d-flex justify-content-between align-items-center">
                                    <h6 class="fs-16 fw-medium">Wishlist</h6>
                                    <div class="d-flex align-items-center">
                                        <div class="fav-dropdown">
                                            <a href="<?php echo base_url(); ?>wishlist" class="position-relative">
                                                <i class="isax isax-heart"></i><span class="count-icon bg-secondary text-gray-9">0</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mobile-menu fix mb-3"></div>
                            <div class="offcanvas__contact">
                                <div class="mt-4">
                                    <div class="header-dropdown d-flex flex-fill">
                                        <div class="w-100">
                                            <div class="dropdown flag-dropdown mb-2">
                                                <a href="javascript:void(0);" class="dropdown-toggle bg-white border d-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <img src="<?php echo base_url(); ?>assets/img/flags/us-flag.svg" class="me-2" alt="flag">ENG
                                                </a>
                                                <ul class="dropdown-menu p-2">
                                                    <li>
                                                        <a class="dropdown-item rounded d-flex align-items-center" href="javascript:void(0);">
                                                            <img src="<?php echo base_url(); ?>assets/img/flags/us-flag.svg" class="me-2" alt="flag">ENG
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item rounded d-flex align-items-center" href="javascript:void(0);">
                                                            <img src="<?php echo base_url(); ?>assets/img/flags/arab-flag.svg" class="me-2" alt="flag">ARA
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item rounded d-flex align-items-center" href="javascript:void(0);">
                                                            <img src="<?php echo base_url(); ?>assets/img/flags/france-flag.svg" class="me-2" alt="flag">FRA
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="dropdown">
                                                <a href="javascript:void(0);" class="dropdown-toggle bg-white border d-block" data-bs-toggle="dropdown" aria-expanded="false">
													USD
												</a>
                                                <ul class="dropdown-menu p-2">
                                                    <li><a class="dropdown-item rounded" href="javascript:void(0);">USD</a></li>
                                                    <li><a class="dropdown-item rounded" href="javascript:void(0);">YEN</a></li>
                                                    <li><a class="dropdown-item rounded" href="javascript:void(0);">EURO</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div><a href="javascript:void(0);" class="text-white btn btn-dark w-100 mb-2" data-bs-toggle="modal" data-bs-target="#login-modal">Sign In</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="offcanvas-overlay"></div>
                <div class="header-nav">
                    <div class="main-menu-wrapper">
                        <div class="navbar-logo">
                            <a class="logo-white header-logo" href="<?php echo base_url(); ?>index">
                                <img src="<?php echo base_url(); ?>assets/img/logo-dark.svg" class="logo" alt="Logo">
                            </a>
                            <a class="logo-dark header-logo" href="<?php echo base_url(); ?>index">
                                <img src="<?php echo base_url(); ?>assets/img/logo.svg" class="logo" alt="Logo">
                            </a>
                        </div>
                        <nav id="mobile-menu">
                            <ul class="main-nav">
                                <li class="has-submenu megamenu <?php echo ($page == 'index' || $page == 'index-2' || $page == 'index-3' || $page == 'index-4'|| $page == 'index-5'|| $page == 'index-6') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Home<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="d-none d-lg-flex align-items-center justify-content-between flex-wrap">
                                                    <h6 class="mb-3">Home Pages</h6>
                                                    <a href="javascript:void(0);" class="btn btn-dark btn-md mb-3 text-white d-inline-block w-auto">Purchase Template</a>
                                                </div>
                                                <div class="row g-lg-4">
                                                    <div class="col-lg-2">
                                                        <div class="single-demo <?php echo ($page == 'index') ? 'active' : ''; ?>">
                                                            <div class="demo-img">
                                                                <a href="<?php echo base_url(); ?>index"><img src="<?php echo base_url(); ?>assets/img/menu/home-01.jpg" class="img-fluid" alt="img"></a>
                                                            </div>
                                                            <div class="demo-info">
                                                                <a href="<?php echo base_url(); ?>index">All Bookings</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="single-demo <?php echo ($page == 'index-2') ? 'active' : ''; ?></div>">
                                                            <div class="demo-img">
                                                                <a href="<?php echo base_url(); ?>index-2"><img src="<?php echo base_url(); ?>assets/img/menu/home-02.jpg" class="img-fluid" alt="img"></a>
                                                            </div>
                                                            <div class="demo-info">
                                                                <a href="<?php echo base_url(); ?>index-2">Hotels</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="single-demo <?php echo ($page == 'index-3') ? 'active' : ''; ?>">
                                                            <div class="demo-img">
                                                                <a href="<?php echo base_url(); ?>index-3"><img src="<?php echo base_url(); ?>assets/img/menu/home-03.jpg" class="img-fluid" alt="img"></a>
                                                            </div>
                                                            <div class="demo-info">
                                                                <a href="<?php echo base_url(); ?>index-3">Cars</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="single-demo <?php echo ($page == 'index-4') ? 'active' : ''; ?>">
                                                            <div class="demo-img">
                                                                <a href="<?php echo base_url(); ?>index-4"><img src="<?php echo base_url(); ?>assets/img/menu/home-04.jpg" class="img-fluid" alt="img"></a>
                                                            </div>
                                                            <div class="demo-info">
                                                                <a href="<?php echo base_url(); ?>index-4">Flight</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="single-demo <?php echo ($page == 'index-5') ? 'active' : ''; ?>">
                                                            <div class="demo-img">
                                                                <a href="<?php echo base_url(); ?>index-5"><img src="<?php echo base_url(); ?>assets/img/menu/home-05.jpg" class="img-fluid" alt="img"></a>
                                                            </div>
                                                            <div class="demo-info">
                                                                <a href="<?php echo base_url(); ?>index-5">Cruise</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="single-demo <?php echo ($page == 'index-6') ? 'active' : ''; ?></div>">
                                                            <div class="demo-img">
                                                                <a href="<?php echo base_url(); ?>index-6"><img src="<?php echo base_url(); ?>assets/img/menu/home-06.jpg" class="img-fluid" alt="img"></a>
                                                            </div>
                                                            <div class="demo-info">
                                                                <a href="<?php echo base_url(); ?>index-6">Tours</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu <?php echo ($page == 'flight-grid' || $page == 'flight-list' || $page == 'flight-details' || $page == 'flight-booking-confirmation'|| $page == 'add-flight') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Flight<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h6>Flight Bookings</h6>
                                                        <ul>
                                                            <li class="<?php echo ($page == 'flight-grid') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>flight-grid">Flight Grid</a></li>
                                                            <li class="<?php echo ($page == 'flight-list') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>flight-list">Flight List</a></li>
                                                            <li class="<?php echo ($page == 'flight-details') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>flight-details">Flight Details</a></li>
                                                            <li class="<?php echo ($page == 'flight-booking-confirmation') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>flight-booking-confirmation">Flight Booking</a></li>
                                                            <li class="<?php echo ($page == 'add-flight') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>add-flight">Add Flight</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="menu-img">
                                                            <img src="<?php echo base_url(); ?>assets/img/menu/flight.jpg" alt="img" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu <?php echo ($page == 'hotel-grid' || $page == 'hotel-list' || $page == 'hotel-map' || $page == 'hotel-details'|| $page == 'booking-confirmation'|| $page == 'add-hotel') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Hotel<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h6>Hotel Bookings</h6>
                                                        <ul>
                                                            <li class="<?php echo ($page == 'hotel-grid') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>hotel-grid">Hotel Grid</a></li>
                                                            <li class="<?php echo ($page == 'hotel-list') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>hotel-list">Hotel List</a></li>
                                                            <li class="<?php echo ($page == 'hotel-map') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>hotel-map">Hotel Map</a></li>
                                                            <li class="<?php echo ($page == 'hotel-details') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>hotel-details">Hotel Details</a></li>
                                                            <li class="<?php echo ($page == 'booking-confirmation') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>booking-confirmation">Hotel Booking</a></li>
                                                            <li class="<?php echo ($page == 'add-hotel') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>add-hotel">Add Hotel</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="menu-img">
                                                            <img src="<?php echo base_url(); ?>assets/img/menu/hotel.jpg" alt="img" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu <?php echo ($page == 'car-grid' || $page == 'car-list' || $page == 'car-map' || $page == 'car-details'|| $page == 'car-booking-confirmation'|| $page == 'add-car') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Car<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h6>Car Bookings</h6>
                                                        <ul>
                                                            <li class="<?php echo ($page == 'car-grid') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>car-grid">Car Grid</a></li>
                                                            <li class="<?php echo ($page == 'car-list') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>car-list">Car List</a></li>
                                                            <li class="<?php echo ($page == 'car-map') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>car-map">Car Map</a></li>
                                                            <li class="<?php echo ($page == 'car-details') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>car-details">Car Details</a></li>
                                                            <li class="<?php echo ($page == 'car-booking-confirmation') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>car-booking-confirmation">Car Booking</a></li>
                                                            <li class="<?php echo ($page == 'add-car') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>add-car">Add Car</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="menu-img">
                                                            <img src="<?php echo base_url(); ?>assets/img/menu/car.jpg" alt="img" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu<?php echo ($page == 'cruise-grid' || $page == 'cruise-list' || $page == 'cruise-map' || $page == 'cruise-details'|| $page == 'cruise-booking-confirmation'|| $page == 'add-cruise') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Cruise<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h6>Cruise Bookings</h6>
                                                        <ul>
                                                            <li class="<?php echo ($page == 'cruise-grid') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>cruise-grid">Cruise Grid</a></li>
                                                            <li class="<?php echo ($page == 'cruise-list') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>cruise-list">Cruise List</a></li>
                                                            <li class="<?php echo ($page == 'cruise-map') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>cruise-map">Cruise Map</a></li>
                                                            <li class="<?php echo ($page == 'cruise-details') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>cruise-details">Cruise Details</a></li>
                                                            <li class="<?php echo ($page == 'cruise-booking-confirmation') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>cruise-booking-confirmation">Cruise Booking</a></li>
                                                            <li class="<?php echo ($page == 'add-cruise') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>add-cruise">Add Cruise</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="menu-img">
                                                            <img src="<?php echo base_url(); ?>assets/img/menu/cruise.jpg" alt="img" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu <?php echo ($page == 'tour-grid' || $page == 'tour-list' || $page == 'tour-map' || $page == 'tour-details'|| $page == 'tour-booking-confirmation'|| $page == 'add-tour') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Tour<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h6>Tour Bookings</h6>
                                                        <ul>
                                                            <li class="<?php echo ($page == 'tour-grid') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>tour-grid">Tour Grid</a></li>
                                                            <li class="<?php echo ($page == 'tour-list') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>tour-list">Tour List</a></li>
                                                            <li class="<?php echo ($page == 'tour-map') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>tour-map">Tour Map</a></li>
                                                            <li class="<?php echo ($page == 'tour-details') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>tour-details">Tour Details</a></li>
                                                            <li class="<?php echo ($page == 'tour-booking-confirmation') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>tour-booking-confirmation">Tour Booking</a></li>
                                                            <li class="<?php echo ($page == 'add-tour') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>add-tour">Add Tour</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="menu-img">
                                                            <img src="<?php echo base_url(); ?>assets/img/menu/tour.jpg" alt="img" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu <?php echo ($page == 'about-us' || $page == 'gallery' || $page == 'testimonial' || $page == 'faq'|| $page == 'pricing-plan'|| $page == 'team'|| $page == 'invoices'|| $page == 'blog-grid'|| $page == 'blog-list'|| $page == 'blog-details'
                                || $page == 'contact-us'|| $page == 'booking-confirmation'|| $page == 'destination' || $page == 'terms-conditions'|| $page == 'privacy-policy'|| $page == 'login'|| $page == 'register'|| 
                                $page == 'forgot-password'|| $page == 'change-password'|| $page == 'error-404'|| $page == 'error-500'|| $page == 'under-maintenance'|| $page == 'coming-soon'|| $page == 'index-rtl') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Pages<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <h6>Pages</h6>
                                                <div class="row g-lg-4">
                                                    <div class="col-lg-6">
                                                    <ul>
                                                            <li class="<?php echo ($page == 'about-us') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>about-us">About</a></li>
                                                            <li class="<?php echo ($page == 'gallery') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>gallery">Gallery</a></li>
                                                            <li class="<?php echo ($page == 'testimonial') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>testimonial">Testimonials</a></li>
                                                            <li class="<?php echo ($page == 'faq') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>faq">Faq</a></li>
                                                            <li class="<?php echo ($page == 'pricing-plan') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>pricing-plan">Pricing Plan</a></li>
                                                            <li class="<?php echo ($page == 'team') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>team">Teams</a></li>
                                                            <li class="<?php echo ($page == 'invoices') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>invoices">Invoice</a></li>
                                                            <li class="<?php echo ($page == 'blog-grid') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>blog-grid">Blogs Grid</a></li>
                                                            <li class="<?php echo ($page == 'blog-list') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>blog-list">Blogs List</a></li>
                                                            <li class="<?php echo ($page == 'blog-details') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>blog-details">Blogs Details</a></li>
                                                            <li class="<?php echo ($page == 'contact-us') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>contact-us">Contact Us</a></li>
                                                            <li class="<?php echo ($page == 'booking-confirmation') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>booking-confirmation">Booking Confirmation</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                    <ul>
                                                            <li class="<?php echo ($page == 'destination') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>destination">Destination</a></li>
                                                            <li class="<?php echo ($page == 'terms-conditions') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>terms-conditions">Terms & Conditions</a></li>
                                                            <li class="<?php echo ($page == 'privacy-policy') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>privacy-policy">Privacy Policy</a></li>
                                                            <li class="<?php echo ($page == 'login') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>login">Login</a></li>
                                                            <li class="<?php echo ($page == 'register') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>register">Register</a></li>
                                                            <li class="<?php echo ($page == 'forgot-password') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>forgot-password">Forgot Password</a></li>
                                                            <li class="<?php echo ($page == 'change-password') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>change-password">Change Password</a></li>
                                                            <li class="<?php echo ($page == 'error-404') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>error-404">404 Error</a></li>
                                                            <li class="<?php echo ($page == 'error-500') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>error-500">500 Error</a></li>
                                                            <li class="<?php echo ($page == 'under-maintenance') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>under-maintenance">Under Maintenance</a></li>
                                                            <li class="<?php echo ($page == 'coming-soon') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>coming-soon">Coming Soon</a></li>
                                                            <li class="<?php echo ($page == 'index-rtl') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>index-rtl">RTL</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu <?php echo ($page == 'dashboard' || $page == 'customer-flight-booking' || $page == 'review' || $page == 'chat'|| $page == 'wishlist'|| $page == 'wallet'|| $page == 'payment'|| $page == 'profile-settings'|| $page == 'notification-settings'|| $page == 'my-profile'
                                || $page == 'security-settings'|| $page == 'agent-dashboard'|| $page == 'agent-listings' || $page == 'agent-hotel-booking'|| $page == 'agent-enquirers'|| $page == 'agent-earnings'|| $page == 'agent-review'|| 
                                $page == 'agent-settings') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Dashboard<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row g-lg-4">
                                                    <div class="col-lg-6">
                                                        <h6>User Dashboard</h6>
                                                        <ul>
                                                            <li class="<?php echo ($page == 'dashboard') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>
                                                            <li class="<?php echo ($page == 'customer-flight-booking') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>customer-flight-booking">My Bookings</a></li>
                                                            <li class="<?php echo ($page == 'review') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>review">Reviews</a></li>
                                                            <li class="<?php echo ($page == 'chat') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>chat">Message</a></li>
                                                            <li class="<?php echo ($page == 'wishlist') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>wishlist">Wishlist</a></li>
                                                            <li class="<?php echo ($page == 'wallet') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>wallet">Wallet</a></li>
                                                            <li class="<?php echo ($page == 'payment') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>payment">Payments</a></li>
                                                            <li class="<?php echo ($page == 'profile-settings') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>profile-settings">Profile Settings</a></li>
                                                            <li class="<?php echo ($page == 'notification-settings') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>notification-settings">Notifications</a></li>
                                                            <li class="<?php echo ($page == 'my-profile') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>my-profile">My Profile</a></li>
                                                            <li class="<?php echo ($page == 'security-settings') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>security-settings">Settings</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <h6>Agent Dashboard</h6>
                                                        <ul>
                                                            <li class="<?php echo ($page == 'agent-dashboard') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-dashboard">Dashboard</a></li>
                                                            <li class="<?php echo ($page == 'agent-listings') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-listings">Listings</a></li>
                                                            <li class="<?php echo ($page == 'agent-hotel-booking') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-hotel-booking">Bookings</a></li>
                                                            <li class="<?php echo ($page == 'agent-enquirers') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-enquirers">Enquiries</a></li>
                                                            <li class="<?php echo ($page == 'agent-earnings') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-earnings">Earnings</a></li>
                                                            <li class="<?php echo ($page == 'agent-review') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-review">Reviews</a></li>
                                                            <li class="<?php echo ($page == 'agent-settings') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-settings">Settings</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        <div class="header-btn d-flex align-items-center">
                            <div class="cart-dropdown me-3">
                                <a href="<?php echo base_url(); ?>dashboard" class="position-relative">
                                    <i class="isax isax-user"></i>
                                </a>
                            </div>
                            <div class="me-3">
                                <a href="javascript:void(0);" id="dark-mode-toggle" class="theme-toggle">
                                    <i class="isax isax-moon"></i>
                                </a>
                                <a href="javascript:void(0);" id="light-mode-toggle" class="theme-toggle">
                                    <i class="isax isax-sun-1"></i>
                                </a>
                            </div>
                            <div class="fav-dropdown me-3">
                                <a href="<?php echo base_url(); ?>wishlist" class="position-relative">
                                    <i class="isax isax-heart"></i><span class="count-icon bg-secondary text-gray-9">0</span>
                                </a>
                            </div>
                            <div>
                                <a href="javascript:void(0);" class="text-white btn btn-dark w-100" data-bs-toggle="modal" data-bs-target="#login-modal">Sign In</a>
                            </div>
                            <div class="header__hamburger d-xl-none my-auto">
                                <div class="sidebar-menu">
                                    <i class="isax isax-menu5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- /Header -->
    </div>

<?php } ?>

<?php if ($page == 'index-6') {   ?>

    <div class="main-header main-header-four">
        <!-- Header Topbar-->
        <div class="header-topbar header-top-six text-center bg-transparent">
            <div class="container">
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <div class="d-flex align-items-center flex-wrap">
                        <p class="d-flex align-items-center fs-14 mb-2 me-3 "><i class="isax isax-call5 me-2"></i>Toll Free : +1 56565 56594</p>
                        <p class="mb-2 d-flex align-items-center fs-14"><i class="isax isax-message-text-15 me-2"></i>Email : info@example.com</p>
                    </div>
                    <div class="navbar-logo mb-2">
                        <a class="logo-dark header-logo" href="<?php echo base_url(); ?>index">
                            <img src="<?php echo base_url(); ?>assets/img/logo-dark.svg" class="logo" alt="Logo">
                        </a>
                        <a class="logo-white header-logo" href="<?php echo base_url(); ?>index">
                            <img src="<?php echo base_url(); ?>assets/img/logo.svg" class="logo" alt="Logo">
                        </a>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="dropdown mb-2 me-3">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
								USD
							</a>
                            <ul class="dropdown-menu p-2 mt-2">
                                <li><a class="dropdown-item rounded" href="javascript:void(0);">USD</a></li>
                                <li><a class="dropdown-item rounded" href="javascript:void(0);">YEN</a></li>
                                <li><a class="dropdown-item rounded" href="javascript:void(0);">EURO</a></li>
                            </ul>
                        </div>
                        <div class="me-3 mb-2">
                            <a href="javascript:void(0);" id="dark-mode-toggle" class="theme-toggle">
                                <i class="isax isax-moon"></i>
                            </a>
                            <a href="javascript:void(0);" id="light-mode-toggle" class="theme-toggle">
                                <i class="isax isax-sun-1"></i>
                            </a>
                        </div>
                        <div class="fav-dropdown mb-2 me-3">
                            <a href="<?php echo base_url(); ?>wishlist" class="position-relative">
                                <i class="isax isax-heart"></i><span class="count-icon bg-secondary text-gray-9">0</span>
                            </a>
                        </div>
                        <div>
                            <a href="javascript:void(0);" class="text-white btn btn-dark w-100 mb-2" data-bs-toggle="modal" data-bs-target="#login-modal">Sign In</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Header Topbar-->

        <!-- Header -->
        <header class="header-six">
            <div class="container">
                <div class="offcanvas-info">
                    <div class="offcanvas-wrap">
                        <div class="offcanvas-detail">
                            <div class="offcanvas-head">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <a href="<?php echo base_url(); ?>index" class="black-logo-responsive">
                                        <img src="<?php echo base_url(); ?>assets/img/logo-dark.svg" alt="logo-img">
                                    </a>
                                    <a href="<?php echo base_url(); ?>index" class="white-logo-responsive">
                                        <img src="<?php echo base_url(); ?>assets/img/logo.svg" alt="logo-img">
                                    </a>
                                    <div class="offcanvas-close">
                                        <i class="ti ti-x"></i>
                                    </div>
                                </div>
                                <div class="wishlist-info d-flex justify-content-between align-items-center">
                                    <h6 class="fs-16 fw-medium">Wishlist</h6>
                                    <div class="d-flex align-items-center">
                                        <div class="fav-dropdown">
                                            <a href="<?php echo base_url(); ?>wishlist" class="position-relative">
                                                <i class="isax isax-heart"></i><span class="count-icon bg-secondary text-gray-9">0</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mobile-menu fix mb-3"></div>
                            <div class="offcanvas__contact">
                                <div class="mt-4">
                                    <div class="header-dropdown d-flex flex-fill">
                                        <div class="w-100">
                                            <div class="dropdown">
                                                <a href="javascript:void(0);" class="dropdown-toggle bg-white border d-block" data-bs-toggle="dropdown" aria-expanded="false">
													USD
												</a>
                                                <ul class="dropdown-menu p-2">
                                                    <li><a class="dropdown-item rounded" href="javascript:void(0);">USD</a></li>
                                                    <li><a class="dropdown-item rounded" href="javascript:void(0);">YEN</a></li>
                                                    <li><a class="dropdown-item rounded" href="javascript:void(0);">EURO</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div><a href="javascript:void(0);" class="text-white btn btn-dark w-100 mb-3" data-bs-toggle="modal" data-bs-target="#login-modal">Sign In</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="offcanvas-overlay"></div>
                <div class="header-nav">
                    <div class="main-menu-wrapper">
                        <div class="navbar-logo">
                            <a class="logo-white header-logo" href="<?php echo base_url(); ?>index">
                                <img src="<?php echo base_url(); ?>assets/img/logo.svg" class="logo" alt="Logo">
                            </a>
                        </div>
                        <nav id="mobile-menu">
                            <ul class="main-nav">
                                <li class="has-submenu megamenu  <?php echo ($page == 'index' || $page == 'index-2' || $page == 'index-3' || $page == 'index-4'|| $page == 'index-5'|| $page == 'index-6') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Home<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="d-none d-lg-flex align-items-center justify-content-between flex-wrap">
                                                    <h6 class="mb-3">Home Pages</h6>
                                                    <a href="javascript:void(0);" class="btn btn-dark btn-md mb-3 text-white d-inline-block w-auto">Purchase Template</a>
                                                </div>
                                                <div class="row g-lg-4">
                                                    <div class="col-lg-2">
                                                        <div class="single-demo <?php echo ($page == 'index') ? 'active' : ''; ?>">
                                                            <div class="demo-img">
                                                                <a href="<?php echo base_url(); ?>index"><img src="<?php echo base_url(); ?>assets/img/menu/home-01.jpg" class="img-fluid" alt="img"></a>
                                                            </div>
                                                            <div class="demo-info">
                                                                <a href="<?php echo base_url(); ?>index">All Bookings</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="single-demo  <?php echo ($page == 'index-2') ? 'active' : ''; ?>">
                                                            <div class="demo-img">
                                                                <a href="<?php echo base_url(); ?>index-2"><img src="<?php echo base_url(); ?>assets/img/menu/home-02.jpg" class="img-fluid" alt="img"></a>
                                                            </div>
                                                            <div class="demo-info">
                                                                <a href="<?php echo base_url(); ?>index-2">Hotels</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="single-demo  <?php echo ($page == 'index-3') ? 'active' : ''; ?>">
                                                            <div class="demo-img">
                                                                <a href="<?php echo base_url(); ?>index-3"><img src="<?php echo base_url(); ?>assets/img/menu/home-03.jpg" class="img-fluid" alt="img"></a>
                                                            </div>
                                                            <div class="demo-info">
                                                                <a href="<?php echo base_url(); ?>index-3">Cars</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="single-demo <?php echo ($page == 'index-4') ? 'active' : ''; ?>">
                                                            <div class="demo-img">
                                                                <a href="<?php echo base_url(); ?>index-4"><img src="<?php echo base_url(); ?>assets/img/menu/home-04.jpg" class="img-fluid" alt="img"></a>
                                                            </div>
                                                            <div class="demo-info">
                                                                <a href="<?php echo base_url(); ?>index-4">Flight</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="single-demo  <?php echo ($page == 'index-5') ? 'active' : ''; ?>">
                                                            <div class="demo-img">
                                                                <a href="<?php echo base_url(); ?>index-5"><img src="<?php echo base_url(); ?>assets/img/menu/home-05.jpg" class="img-fluid" alt="img"></a>
                                                            </div>
                                                            <div class="demo-info">
                                                                <a href="<?php echo base_url(); ?>index-5">Cruise</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="single-demo  <?php echo ($page == 'index-6') ? 'active' : ''; ?>">
                                                            <div class="demo-img">
                                                                <a href="<?php echo base_url(); ?>index-6"><img src="<?php echo base_url(); ?>assets/img/menu/home-06.jpg" class="img-fluid" alt="img"></a>
                                                            </div>
                                                            <div class="demo-info">
                                                                <a href="<?php echo base_url(); ?>index-6">Tours</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu  <?php echo ($page == 'flight-grid' || $page == 'flight-list' || $page == 'flight-details' || $page == 'flight-booking-confirmation'|| $page == 'add-flight') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Flight<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h6>Flight Bookings</h6>
                                                        <ul>
                                                            <li class="<?php echo ($page == 'flight-grid') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>flight-grid">Flight Grid</a></li>
                                                            <li class="<?php echo ($page == 'flight-list') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>flight-list">Flight List</a></li>
                                                            <li class="<?php echo ($page == 'flight-details') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>flight-details">Flight Details</a></li>
                                                            <li class="<?php echo ($page == 'flight-booking-confirmation') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>flight-booking-confirmation">Flight Booking</a></li>
                                                            <li class="<?php echo ($page == 'add-flight') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>add-flight">Add Flight</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="menu-img">
                                                            <img src="<?php echo base_url(); ?>assets/img/menu/flight.jpg" alt="img" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu <?php echo ($page == 'hotel-grid' || $page == 'hotel-list' || $page == 'hotel-map' || $page == 'hotel-details'|| $page == 'booking-confirmation'|| $page == 'add-hotel') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Hotel<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h6>Hotel Bookings</h6>
                                                        <ul>
                                                            <li class="<?php echo ($page == 'hotel-grid') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>hotel-grid">Hotel Grid</a></li>
                                                            <li class="<?php echo ($page == 'hotel-list') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>hotel-list">Hotel List</a></li>
                                                            <li class="<?php echo ($page == 'hotel-map') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>hotel-map">Hotel Map</a></li>
                                                            <li class="<?php echo ($page == 'hotel-details') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>hotel-details">Hotel Details</a></li>
                                                            <li class="<?php echo ($page == 'booking-confirmation') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>booking-confirmation">Hotel Booking</a></li>
                                                            <li class="<?php echo ($page == 'add-hotel') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>add-hotel">Add Hotel</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="menu-img">
                                                            <img src="<?php echo base_url(); ?>assets/img/menu/hotel.jpg" alt="img" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu <?php echo ($page == 'car-grid' || $page == 'car-list' || $page == 'car-map' || $page == 'car-details'|| $page == 'car-booking-confirmation'|| $page == 'add-car') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Car<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h6>Car Bookings</h6>
                                                        <ul>
                                                            <li class="<?php echo ($page == 'car-grid') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>car-grid">Car Grid</a></li>
                                                            <li class="<?php echo ($page == 'car-list') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>car-list">Car List</a></li>
                                                            <li class="<?php echo ($page == 'car-map') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>car-map">Car Map</a></li>
                                                            <li class="<?php echo ($page == 'car-details') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>car-details">Car Details</a></li>
                                                            <li class="<?php echo ($page == 'car-booking-confirmation') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>car-booking-confirmation">Car Booking</a></li>
                                                            <li class="<?php echo ($page == 'add-car') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>add-car">Add Car</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="menu-img">
                                                            <img src="<?php echo base_url(); ?>assets/img/menu/car.jpg" alt="img" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu <?php echo ($page == 'cruise-grid' || $page == 'cruise-list' || $page == 'cruise-map' || $page == 'cruise-details'|| $page == 'cruise-booking-confirmation'|| $page == 'add-cruise') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Cruise<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h6>Cruise Bookings</h6>
                                                        <ul>
                                                            <li class="<?php echo ($page == 'cruise-grid') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>cruise-grid">Cruise Grid</a></li>
                                                            <li class="<?php echo ($page == 'cruise-list') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>cruise-list">Cruise List</a></li>
                                                            <li class="<?php echo ($page == 'cruise-map') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>cruise-map">Cruise Map</a></li>
                                                            <li class="<?php echo ($page == 'cruise-details') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>cruise-details">Cruise Details</a></li>
                                                            <li class="<?php echo ($page == 'cruise-booking-confirmation') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>cruise-booking-confirmation">Cruise Booking</a></li>
                                                            <li class="<?php echo ($page == 'add-cruise') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>add-cruise">Add Cruise</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="menu-img">
                                                            <img src="<?php echo base_url(); ?>assets/img/menu/cruise.jpg" alt="img" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu <?php echo ($page == 'tour-grid' || $page == 'tour-list' || $page == 'tour-map' || $page == 'tour-details'|| $page == 'tour-booking-confirmation'|| $page == 'add-tour') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Tour<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h6>Tour Bookings</h6>
                                                        <ul>
                                                            <li class="<?php echo ($page == 'tour-grid') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>tour-grid">Tour Grid</a></li>
                                                            <li class="<?php echo ($page == 'tour-list') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>tour-list">Tour List</a></li>
                                                            <li class="<?php echo ($page == 'tour-map') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>tour-map">Tour Map</a></li>
                                                            <li class="<?php echo ($page == 'tour-details') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>tour-details">Tour Details</a></li>
                                                            <li class="<?php echo ($page == 'tour-booking-confirmation') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>tour-booking-confirmation">Tour Booking</a></li>
                                                            <li class="<?php echo ($page == 'add-tour') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>add-tour">Add Tour</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="menu-img">
                                                            <img src="<?php echo base_url(); ?>assets/img/menu/tour.jpg" alt="img" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu <?php echo ($page == 'about-us' || $page == 'gallery' || $page == 'testimonial' || $page == 'faq'|| $page == 'pricing-plan'|| $page == 'team'|| $page == 'invoices'|| $page == 'blog-grid'|| $page == 'blog-list'|| $page == 'blog-details'
                                || $page == 'contact-us'|| $page == 'booking-confirmation'|| $page == 'destination' || $page == 'terms-conditions'|| $page == 'privacy-policy'|| $page == 'login'|| $page == 'register'|| 
                                $page == 'forgot-password'|| $page == 'change-password'|| $page == 'error-404'|| $page == 'error-500'|| $page == 'under-maintenance'|| $page == 'coming-soon'|| $page == 'index-rtl') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Pages<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <h6>Pages</h6>
                                                <div class="row g-lg-4">
                                                    <div class="col-lg-6">
                                                    <ul>
                                                            <li class="<?php echo ($page == 'about-us') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>about-us">About</a></li>
                                                            <li class="<?php echo ($page == 'gallery') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>gallery">Gallery</a></li>
                                                            <li class="<?php echo ($page == 'testimonial') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>testimonial">Testimonials</a></li>
                                                            <li class="<?php echo ($page == 'faq') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>faq">Faq</a></li>
                                                            <li class="<?php echo ($page == 'pricing-plan') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>pricing-plan">Pricing Plan</a></li>
                                                            <li class="<?php echo ($page == 'team') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>team">Teams</a></li>
                                                            <li class="<?php echo ($page == 'invoices') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>invoices">Invoice</a></li>
                                                            <li class="<?php echo ($page == 'blog-grid') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>blog-grid">Blogs Grid</a></li>
                                                            <li class="<?php echo ($page == 'blog-list') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>blog-list">Blogs List</a></li>
                                                            <li class="<?php echo ($page == 'blog-details') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>blog-details">Blogs Details</a></li>
                                                            <li class="<?php echo ($page == 'contact-us') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>contact-us">Contact Us</a></li>
                                                            <li class="<?php echo ($page == 'booking-confirmation') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>booking-confirmation">Booking Confirmation</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                    <ul>
                                                            <li class="<?php echo ($page == 'destination') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>destination">Destination</a></li>
                                                            <li class="<?php echo ($page == 'terms-conditions') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>terms-conditions">Terms & Conditions</a></li>
                                                            <li class="<?php echo ($page == 'privacy-policy') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>privacy-policy">Privacy Policy</a></li>
                                                            <li class="<?php echo ($page == 'login') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>login">Login</a></li>
                                                            <li class="<?php echo ($page == 'register') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>register">Register</a></li>
                                                            <li class="<?php echo ($page == 'forgot-password') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>forgot-password">Forgot Password</a></li>
                                                            <li class="<?php echo ($page == 'change-password') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>change-password">Change Password</a></li>
                                                            <li class="<?php echo ($page == 'error-404') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>error-404">404 Error</a></li>
                                                            <li class="<?php echo ($page == 'error-500') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>error-500">500 Error</a></li>
                                                            <li class="<?php echo ($page == 'under-maintenance') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>under-maintenance">Under Maintenance</a></li>
                                                            <li class="<?php echo ($page == 'coming-soon') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>coming-soon">Coming Soon</a></li>
                                                            <li class="<?php echo ($page == 'index-rtl') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>index-rtl">RTL</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-submenu mega-innermenu <?php echo ($page == 'dashboard' || $page == 'customer-flight-booking' || $page == 'review' || $page == 'chat'|| $page == 'wishlist'|| $page == 'wallet'|| $page == 'payment'|| $page == 'profile-settings'|| $page == 'notification-settings'|| $page == 'my-profile'
                                || $page == 'security-settings'|| $page == 'agent-dashboard'|| $page == 'agent-listings' || $page == 'agent-hotel-booking'|| $page == 'agent-enquirers'|| $page == 'agent-earnings'|| $page == 'agent-review'|| 
                                $page == 'agent-settings') ? 'active subdrop' : ''; ?>">
                                    <a href="javascript:void(0);">Dashboard<i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="submenu mega-submenu">
                                        <li>
                                            <div class="megamenu-wrapper">
                                                <div class="row g-lg-4">
                                                    <div class="col-lg-6">
                                                        <h6>User Dashboard</h6>
                                                        <ul>
                                                            <li class="<?php echo ($page == 'dashboard') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>
                                                            <li class="<?php echo ($page == 'customer-flight-booking') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>customer-flight-booking">My Bookings</a></li>
                                                            <li class="<?php echo ($page == 'review') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>review">Reviews</a></li>
                                                            <li class="<?php echo ($page == 'chat') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>chat">Message</a></li>
                                                            <li class="<?php echo ($page == 'wishlist') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>wishlist">Wishlist</a></li>
                                                            <li class="<?php echo ($page == 'wallet') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>wallet">Wallet</a></li>
                                                            <li class="<?php echo ($page == 'payment') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>payment">Payments</a></li>
                                                            <li class="<?php echo ($page == 'profile-settings') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>profile-settings">Profile Settings</a></li>
                                                            <li class="<?php echo ($page == 'notification-settings') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>notification-settings">Notifications</a></li>
                                                            <li class="<?php echo ($page == 'my-profile') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>my-profile">My Profile</a></li>
                                                            <li class="<?php echo ($page == 'security-settings') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>security-settings">Settings</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <h6>Agent Dashboard</h6>
                                                        <ul>
                                                            <li class="<?php echo ($page == 'agent-dashboard') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-dashboard">Dashboard</a></li>
                                                            <li class="<?php echo ($page == 'agent-listings') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-listings">Listings</a></li>
                                                            <li class="<?php echo ($page == 'agent-hotel-booking') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-hotel-booking">Bookings</a></li>
                                                            <li class="<?php echo ($page == 'agent-enquirers') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-enquirers">Enquiries</a></li>
                                                            <li class="<?php echo ($page == 'agent-earnings') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-earnings">Earnings</a></li>
                                                            <li class="<?php echo ($page == 'agent-review') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-review">Reviews</a></li>
                                                            <li class="<?php echo ($page == 'agent-settings') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>agent-settings">Settings</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        <div class="header-btn align-items-center">
                            <div class="dropdown me-3">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
									USD
								</a>
                                <ul class="dropdown-menu p-2 mt-2">
                                    <li><a class="dropdown-item rounded" href="javascript:void(0);">USD</a></li>
                                    <li><a class="dropdown-item rounded" href="javascript:void(0);">YEN</a></li>
                                    <li><a class="dropdown-item rounded" href="javascript:void(0);">EURO</a></li>
                                </ul>
                            </div>
                            <div class="me-3">
                                <a href="<?php echo base_url(); ?>dashboard">
                                    <i class="isax isax-user"></i>
                                </a>
                            </div>
                            <div class="fav-dropdown  me-3">
                                <a href="<?php echo base_url(); ?>wishlist" class="position-relative">
                                    <i class="isax isax-heart"></i><span class="count-icon bg-secondary text-gray-9">0</span>
                                </a>
                            </div>
                            <div>
                                <a href="javascript:void(0);" class="text-white btn btn-dark w-100 mb-2" data-bs-toggle="modal" data-bs-target="#register-modal">Sign In</a>
                            </div>
                        </div>
                        <div class="header__hamburger d-xl-none my-auto">
                            <div class="sidebar-menu">
                                <i class="isax isax-menu5"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- /Header -->
    </div>

<?php } ?>




 