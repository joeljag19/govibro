<?php
// app/Views/layouts/main.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->renderSection('title') ?></title>
    <?= $this->include('layouts/partials/head-css') ?>
    <?= $this->renderSection('styles') ?>

</head>
<body>
    <!-- /Menu -->	
    <?= $this->include('layouts/partials/menu') ?>

    <!-- Loader -->
    <div id="loader-wrapper">        	
        <div id="loader">
            <span class="loader-line"></span>
        </div>
    </div>
   
    
    <!-- Contenido dinámico -->
    <?= $this->renderSection('content') ?>
    
    <?= $this->renderSection('custom-scripts') ?>

    <!-- Footer -->
    <?= $this->include('layouts/partials/footer') ?>
    
    <!-- Scripts -->
    <?= $this->include('layouts/partials/vendor-scripts') ?>
</body>
</html>