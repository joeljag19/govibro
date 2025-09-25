<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo view("layouts/partials_dashboard/title-meta", array("title" => $title ?? "Dashboard")) ?>
    <?= $this->include('layouts/partials_dashboard/head-css') ?>
</head>

<?= $this->include('layouts/partials_dashboard/body') ?>

<!-- Begin page -->
<div id="app-layout">
    <?php echo view("layouts/partials_dashboard/topbar", array("pagetitle" => $title ?? "Dashboard")) ?>
    <?= $this->include('layouts/partials_dashboard/sidebar') ?>

    <!-- Contenido dinámico -->
    <?= $this->renderSection('content') ?>

    <?= $this->include('layouts/partials_dashboard/vendor') ?>

    <!-- Sección para scripts personalizados -->
    <?= $this->renderSection('custom-scripts') ?>
</div>
<!-- END wrapper -->

</body>
</html>