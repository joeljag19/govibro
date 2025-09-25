<?php
// La lógica antigua para determinar la página se elimina, ya no es necesaria.
?>

<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/img/apple-touch-icon.png') ?>">

<link rel="icon" href="<?= base_url('assets/img/favicon.png') ?>" type="image/x-icon">
<link rel="shortcut icon" href="<?= base_url('assets/img/favicon.png') ?>" type="image/x-icon">

<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">

<script src="<?= base_url('assets/js/theme-script.js') ?>"></script>

<link rel="stylesheet" href="<?= base_url('assets/css/animate.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/meanmenu.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/plugins/tabler-icons/tabler-icons.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome/css/fontawesome.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome/css/all.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/plugins/owlcarousel/owl.carousel.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap-datetimepicker.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/plugins/select2/css/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/iconsax.css') ?>">

<?php if (isset($assets) && in_array('slick', $assets['css'] ?? [])): ?>
    <link rel="stylesheet" href="<?= base_url('assets/plugins/slick/slick.css') ?>">
<?php endif; ?>

<?php if (isset($assets) && in_array('fancybox', $assets['css'] ?? [])): ?>
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fancybox/jquery.fancybox.min.css') ?>">
<?php endif; ?>

<?php if (isset($assets) && in_array('rangeslider', $assets['css'] ?? [])): ?>
    <link rel="stylesheet" href="<?= base_url('assets/plugins/ion-rangeslider/css/ion.rangeSlider.min.css') ?>">
<?php endif; ?>

<?php if (isset($assets) && in_array('quill', $assets['css'] ?? [])): ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/quill/quill.core.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/quill/quill.snow.css">	
<?php endif; ?>

<?php if (isset($assets) && in_array('intltel', $assets['css'] ?? [])): ?>
    <link rel="stylesheet" href="<?= base_url('assets/plugins/intltelinput/css/intlTelInput.css') ?>">
<?php endif; ?>

<?php if (isset($assets) && in_array('daterangepicker', $assets['css'] ?? [])): ?>
    <link rel="stylesheet" href="<?= base_url('assets/plugins/daterangepicker/daterangepicker.css') ?>">
<?php endif; ?>

<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">