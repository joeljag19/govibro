<?php
$link = $_SERVER[ 'PHP_SELF' ];
$link_array = explode( '/', $link );
$page = end( $link_array );
?>

<?php if($page === 'index' || $page === 'index-2' || $page === 'index-3' || $page === 'index-4' || $page === 'index-5' || $page === 'index-6') { ?>
    <!-- Loader -->
    <div id="loader-wrapper">        	
        <div id="loader">
            <span class="loader-line"></span>
        </div>
    </div>
    <!-- /Loader -->
<?php } ?>