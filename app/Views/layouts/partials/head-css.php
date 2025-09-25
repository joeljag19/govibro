<?php
$link = $_SERVER[ 'PHP_SELF' ];
$link_array = explode( '/', $link );
$page = end( $link_array );
if ($page === '' || $page === 'index.php') $page = 'index';
?>

    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url(); ?>assets/img/apple-touch-icon.png">

    <!-- Favicon -->
    <link rel="icon" href="<?php echo base_url(); ?>assets/img/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.png" type="image/x-icon">

<?php if ($page !== 'index-rtl') {   ?>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
<?php } ?>

<?php if ($page == 'index-rtl') {   ?>
	<!-- Bootstrap RTL CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.rtl.min.css">
<?php } ?>

<?php if ($page !== 'login' && $page !== 'register' && $page !== 'forgot-password' && $page !== 'change-password' && $page !== 'error-404' && $page !== 'error-500' && $page !== 'under-maintenance' && $page !== 'coming-soon' && $page !== 'index-rtl') { ?>
    <!-- Theme Settings Js -->
    <script src="<?php echo base_url(); ?>assets/js/theme-script.js"></script>
<?php } ?>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/animate.css">

    <!-- Main.css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/meanmenu.css">

    <!-- Tabler Icon CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/tabler-icons/tabler-icons.css">

    <!-- Fontawesome Icon CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome/css/all.min.css">

<?php if ($page == 'index-2' || $page == 'car-details' || $page == 'cruise-details' || $page == 'tour-details' || $page == 'flight-details' ) {   ?>
    <!-- Slick CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/slick/slick.css">
<?php } ?>

<?php if ($page == 'agent-account-settings' || $page == 'agent-car-booking' || $page == 'agent-chat' || $page == 'agent-cruise-booking' || $page == 'agent-dashboard' || $page == 'agent-listings' || $page == 'agent-notifications' || $page == 'agent-plans-settings' || $page == 'agent-plans' || $page == 'agent-security-settings' || $page == 'car-details' || $page == 'chat' || $page == 'cruise-details' || $page == 'customer-car-booking' || $page == 'customer-cruise-booking' || $page == 'customer-flight-booking' || $page == 'customer-hotel-booking' || $page == 'customer-tour-booking' || $page == 'dashboard' || $page == 'faq' || $page == 'flight-details' || $page == 'gallery' || $page == 'hotel-details' || $page == 'index-2' || $page == 'index-3' || $page == 'index-4' || $page == 'index-5' || $page == 'index-6' || $page == 'integratio-settings' || $page == 'my-profile' || $page == 'notification-settings' || $page == 'notification' || $page == 'preference-sttings' || $page == 'pricing-plan' || $page == 'profile-settings' || $page == 'security-settings' || $page == 'testimonial' || $page == 'tour-details' || $page == 'wallet' || $page == 'wishlist' ) {  ?>
    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fancybox/jquery.fancybox.min.css">
<?php } ?>

<?php if($page !== 'login' && $page !== 'register' && $page !== 'forgot-password' && $page !== 'change-password' && $page !== 'error-404' && $page !== 'error-500' && $page !== 'coming-soon' && $page !== 'under-maintenance' && $page !== 'lock-screen') {   ?>    
    <!-- Owlcarousel CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/owlcarousel/owl.carousel.min.css">

    <!-- Datepicker CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.min.css">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/css/select2.min.css">
<?php } ?>

    <!-- Iconsax CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/iconsax.css">

<?php if ($page == 'about-us' || $page == 'become-an-artist' || $page == 'blog-details' || $page == 'blog-grid' || $page == 'blog-list' || $page == 'booking-confirmation' || $page == 'car-booking-information' || $page == 'card-booking' || $page == 'car-list' || $page == 'car-map' || $page == 'contact-us' || $page == 'cruise-booking-confirmation' || $page == 'cruise-booking' || $page == 'cruise-grid' || $page == 'cruise-list' || $page == 'cruise-map' || $page == 'error-404' || $page == 'error-500' || $page == 'faq' || $page == 'flight-booking-confirmation' || $page == 'flight-booking' || $page == 'flight-grid' || $page == 'flight-list' || $page == 'flight-map' || $page == 'gallery'  || $page == 'hotel-booking' || $page == 'hotel-grid' || $page == 'hotel-list' || $page == 'hotel-map' || $page == 'invoices' || $page == 'pricing-plan' || $page == 'privacy-policy' || $page == 'terms-conditions' || $page == 'testimonial' || $page == 'tour-booking-confirmation' || $page == 'tour-booking' || $page == 'tour-grid' || $page == 'tour-list' || $page == 'tour-map' ) {  ?>
    <!-- Rangeslider CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/ion-rangeslider/css/ion.rangeSlider.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/ion-rangeslider/css/ion.rangeSlider.min.css">
<?php } ?>

<?php if ($page == 'add-flight' || $page == 'add-hotel' || $page == 'add-car' || $page == 'add-cruise' || $page == 'add-tour' || $page == 'agent-enquiry-details' || $page == 'edit-flight' || $page == 'edit-hotel' || $page == 'edit-tour' || $page == 'edit-cruise' || $page == 'edit-car') {   ?>
    <!-- Quill css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/quill/quill.core.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/quill/quill.snow.css">	
<?php } ?>

<?php if ($page == 'security-settings' || $page == 'agent-plans' || $page == 'agent-plans-settings' || $page == 'agent-account-settings' || $page == 'agent-security-settings') { ?> 
    <!-- Mobile CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/intltelinput/css/intlTelInput.css">
<?php } ?>

<?php if ($page == 'integration-settings' || $page == 'customer-tour-booking' || $page == 'customer-hotel-booking' || $page == 'customer-flight-booking' || $page == 'customer-cruise-booking' || $page == 'customer-car-booking' || $page == 'agent-tour-booking' || $page == 'agent-settings' || $page == 'agent-security-settings' || $page == 'agent-plans' || $page == 'agent-plans-settings' || $page == 'agent-flight-booking' || $page == 'agent-cruise-booking' || $page == 'agent-account-settings' || $page == 'wishlist' || $page == 'wallet' || $page == 'security-settings' || $page == 'review' || $page == 'profile-settings' || $page == 'payment' || $page == 'notification-settings' || $page == 'preferences-settings' || $page == 'destination' || $page == 'agent-enquirers' || $page == 'agent-earnings' || $page == 'agent-car-booking'  || $page == 'agent-hotel-booking' || $page == 'agent-review') { ?> 
    <!-- Daterangepikcer CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.css">
<?php } ?>

    <!-- Style CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
	
