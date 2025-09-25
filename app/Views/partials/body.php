<?php
$link = $_SERVER[ 'PHP_SELF' ];
$link_array = explode( '/', $link );
$page = end( $link_array );

if($page === 'login' || $page === 'register' || $page === 'forgot-password' || $page === 'change-password') {
    echo '<body class="bg-light-200">';
}
elseif($page === 'error-404' || $page === 'error-500' || $page === 'under-maintenance' || $page === 'coming-soon') {
    echo '<body class="bg-primary-transparent">';
}
elseif($page === 'coming-soon') {
    echo '<body class="coming-soon-bg">';
}
else {
    echo '<body>';
}
?>