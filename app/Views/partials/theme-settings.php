<?php
$link = $_SERVER[ 'PHP_SELF' ];
$link_array = explode( '/', $link );
$page = end( $link_array );

if($page == 'index-rtl') {
    echo '<html lang="en" dir="rtl">';
} else {
    echo '<html lang="en">';
}
?>
