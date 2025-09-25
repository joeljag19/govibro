<?php
$link = $_SERVER[ 'PHP_SELF' ];
$link_array = explode( '/', $link );
$page = end( $link_array );
?>

    <!-- Jquery JS -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>

    <!-- Wow JS -->
    <script src="<?php echo base_url(); ?>assets/js/wow.min.js"></script>

<?php if ($page == 'dashboard' || $page == 'chat'  || $page == 'agent-dashboard'  || $page == 'agent-listings' || $page == 'agent-hotel-booking' || $page == 'agent-enquirers' || $page == 'agent-earnings' || $page == 'agent-chat' ) { ?>
    <!-- Apex JS -->
    <script src="<?php echo base_url(); ?>assets/plugins/apexchart/apexcharts.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/apexchart/chart-data.js"></script>
<?php } ?>

    <!-- MeanMenu Js -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.meanmenu.min.js"></script>

<?php if($page !== 'login' && $page !== 'register' && $page !== 'forgot-password' && $page !== 'change-password' && $page !== 'error-404' && $page !== 'error-500' && $page !== 'coming-soon' && $page !== 'under-maintenance' && $page !== 'lock-screen') {   ?>    
    <!-- Swiper Js -->
    <script src="<?php echo base_url(); ?>assets/plugins/owlcarousel/owl.carousel.min.js"></script>
<?php } ?>

<?php if ($page == 'agent-account-settings' || $page == 'agent-car-booking' || $page == 'agent-chat' || $page == 'agent-cruise-booking' || $page == 'agent-dashboard' || $page == 'agent-listings' || $page == 'agent-notifications' || $page == 'agent-plans-settings' || $page == 'agent-plans' || $page == 'agent-security-settings' || $page == 'car-details' || $page == 'chat' || $page == 'cruise-details' || $page == 'customer-car-booking' || $page == 'customer-cruise-booking' || $page == 'customer-flight-booking' || $page == 'customer-hotel-booking' || $page == 'customer-tour-booking' || $page == 'dashboard' || $page == 'faq' || $page == 'flight-details' || $page == 'gallery' || $page == 'hotel-details' || $page == 'index-2' || $page == 'index-3' || $page == 'index-4' || $page == 'index-5' || $page == 'index-6' || $page == 'integratio-settings' || $page == 'my-profile' || $page == 'notification-settings' || $page == 'notification' || $page == 'preference-sttings' || $page == 'pricing-plan' || $page == 'profile-settings' || $page == 'security-settings' || $page == 'testimonial' || $page == 'tour-details' || $page == 'wallet' || $page == 'wishlist' ) {  ?>
    <!-- Fancybox JS -->
    <script src="<?php echo base_url(); ?>assets/plugins/fancybox/jquery.fancybox.min.js"></script>
<?php } ?>

<?php if ($page == 'index-2' || $page == 'car-details' || $page == 'cruise-details' || $page == 'tour-details' || $page == 'flight-details' ) {   ?>
    <!-- Slick Slider -->
    <script src="<?php echo base_url(); ?>assets/plugins/slick/slick.min.js"></script>
<?php } ?>

<?php if($page !== 'login' && $page !== 'register' && $page !== 'forgot-password' && $page !== 'change-password' && $page !== 'error-404' && $page !== 'error-500' && $page !== 'coming-soon' && $page !== 'under-maintenance' && $page !== 'lock-screen') {   ?>    
    <!-- Owlcarousel Js -->
    <script src="<?php echo base_url(); ?>assets/plugins/owlcarousel/owl.carousel.min.js"></script>

    <!-- Sticky Sidebar JS -->
    <script src="<?php echo base_url(); ?>assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>
<?php } ?>

<?php if ($page == 'about-us' || $page == 'become-an-artist' || $page == 'blog-details' || $page == 'blog-grid' || $page == 'blog-list' || $page == 'booking-confirmation' || $page == 'car-booking-information' || $page == 'card-booking' || $page == 'car-list' || $page == 'car-map' || $page == 'contact-us' || $page == 'cruise-booking-confirmation' || $page == 'cruise-booking' || $page == 'cruise-grid' || $page == 'cruise-list' || $page == 'cruise-map' || $page == 'error-404' || $page == 'error-500' || $page == 'faq' || $page == 'flight-booking-confirmation' || $page == 'flight-booking' || $page == 'flight-grid' || $page == 'flight-list' || $page == 'flight-map' || $page == 'gallery'  || $page == 'hotel-booking' || $page == 'hotel-grid' || $page == 'hotel-list' || $page == 'hotel-map' || $page == 'invoices' || $page == 'pricing-plan' || $page == 'privacy-policy' || $page == 'terms-conditions' || $page == 'testimonial' || $page == 'tour-booking-confirmation' || $page == 'tour-booking' || $page == 'tour-grid' || $page == 'tour-list' || $page == 'tour-map' ) {  ?>
    <!-- Rangeslider JS -->
    <script src="<?php echo base_url(); ?>assets/plugins/ion-rangeslider/js/ion.rangeSlider.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/ion-rangeslider/js/custom-rangeslider.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
<?php } ?>

<?php if($page !== 'login' && $page !== 'register' && $page !== 'forgot-password' && $page !== 'change-password' && $page !== 'error-404' && $page !== 'error-500' && $page !== 'coming-soon' && $page !== 'under-maintenance' && $page !== 'lock-screen') {   ?>    
    <!-- Select2 JS -->
    <script src="<?php echo base_url(); ?>assets/plugins/select2/js/select2.min.js"></script>
<?php } ?>

<?php if ($page == 'add-flight' || $page == 'add-hotel' || $page == 'add-car' || $page == 'add-cruise' || $page == 'add-tour' || $page == 'agent-enquiry-details' || $page == 'edit-flight' || $page == 'edit-hotel' || $page == 'edit-tour' || $page == 'edit-cruise' || $page == 'edit-car') {   ?>
    <!-- Quill Editor JS -->
    <script src="<?php echo base_url(); ?>assets/plugins/quill/quill.min.js"></script>
<?php } ?>

<?php if($page !== 'login' && $page !== 'register' && $page !== 'forgot-password' && $page !== 'change-password' && $page !== 'error-404' && $page !== 'error-500' && $page !== 'coming-soon' && $page !== 'under-maintenance' && $page !== 'lock-screen') {   ?>    
    <!-- Counter JS -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.counterup.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.waypoints.min.js"></script>

    <!-- Datepicker Core JS -->
    <script src="<?php echo base_url(); ?>assets/plugins/moment/moment.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.min.js"></script>
<?php } ?>

<?php if ($page == 'integration-settings' || $page == 'customer-tour-booking' || $page == 'customer-hotel-booking' || $page == 'customer-flight-booking' || $page == 'customer-cruise-booking' || $page == 'customer-car-booking' || $page == 'agent-tour-booking' || $page == 'agent-settings' || $page == 'agent-security-settings' || $page == 'agent-plans' || $page == 'agent-plans-settings' || $page == 'agent-flight-booking' || $page == 'agent-cruise-booking' || $page == 'agent-account-settings' || $page == 'wishlist' || $page == 'wallet' || $page == 'security-settings' || $page == 'review' || $page == 'profile-settings' || $page == 'payment' || $page == 'notification-settings' || $page == 'preferences-settings' || $page == 'destination' || $page == 'agent-enquirers' || $page == 'agent-earnings' || $page == 'agent-car-booking'  || $page == 'agent-hotel-booking' || $page == 'agent-review') { ?> 
    <!-- Daterangepikcer JS -->
    <script src="<?php echo base_url(); ?>assets/js/moment.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<?php } ?>

<?php if ($page == 'chat' || $page == 'agent-chat') {   ?>
    <!-- Slimscroll JS -->
    <script src="<?php echo base_url(); ?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<?php } ?>

<?php if ($page == 'hotel-map') {   ?>
    <!-- map JS -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6adZVdzTvBpE2yBRK8cDfsss8QXChK0I"></script>
    <script src="<?php echo base_url(); ?>assets/js/map-grid.js"></script>
<?php } ?>

<?php if ($page == 'car-map') {   ?>
    <!-- map JS -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6adZVdzTvBpE2yBRK8cDfsss8QXChK0I"></script>
    <script src="<?php echo base_url(); ?>assets/js/map-car.js"></script>
<?php } ?>

<?php if ($page == 'cruise-map') {   ?>
    <!-- map JS -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6adZVdzTvBpE2yBRK8cDfsss8QXChK0I"></script>
    <script src="<?php echo base_url(); ?>assets/js/map-cruise.js"></script>
<?php } ?>

<?php if ($page == 'tour-map') {   ?>
    <!-- map JS -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6adZVdzTvBpE2yBRK8cDfsss8QXChK0I"></script>
    <script src="<?php echo base_url(); ?>assets/js/map-tour.js"></script>
<?php } ?>

    <!-- cursor JS -->
    <script src="<?php echo base_url(); ?>assets/js/cursor.js"></script>

<?php if ($page == 'security-settings' || $page == 'agent-plans' || $page == 'agent-plans-settings' || $page == 'agent-account-settings' || $page == 'agent-security-settings') { ?> 
    <!-- Mobile Input -->
    <script src="<?php echo base_url(); ?>assets/plugins/intltelinput/js/intlTelInput.js"></script>
<?php } ?>

<?php if ($page !== 'index-rtl') {   ?>
    <!-- Script JS -->
    <script src="<?php echo base_url(); ?>assets/js/script.js"></script>
<?php } ?>

<?php if ($page == 'index-rtl') { ?> 
    <!-- Script JS -->   
    <script src="<?php echo base_url(); ?>assets/js/script-rtl.js"></script>
<?php } ?>