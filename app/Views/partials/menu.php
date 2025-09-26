<?php
$page = $page ?? ''; 

if ($layoutOptions['show_topbar'] ?? true):
    // Pasamos la variable $page a la vista topbar.php
    echo $this->include('partials/topbar', ['page' => $page]);
endif;