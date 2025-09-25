<?php
$link = $_SERVER[ 'PHP_SELF' ];
$link_array = explode( '/', $link );
$page = end( $link_array );
?>

<?php if($page !== 'login' && $page !== 'register' && $page !== 'forgot-password' && $page !== 'change-password' && $page !== 'error-404' && $page !== 'error-500' && $page !== 'coming-soon' && $page !== 'under-maintenance' && $page !== 'lock-screen') {   ?>

    <?php include_once __DIR__ . '/topbar.php';?>

<?php }?>