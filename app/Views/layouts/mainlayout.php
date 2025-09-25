<!DOCTYPE html>
<?= $this->include('partials/theme-settings') ?>

<head>
    <?= $this->include('partials/title-meta') ?>
    <?= $this->include('partials/head-css') ?>
    <?= $this->renderSection('styles') ?>
    <style>
        /* =================================== */
/* FIX PARA MENÚ DE IDIOMAS EN MÓVIL  */
/* =================================== */
@media (max-width: 768px) {
  .flag-dropdown .dropdown-menu {
    /* Forzamos al menú a no ser más ancho que la pantalla */
    max-width: 90vw; /* El 90% del ancho de la pantalla del dispositivo */
    
    /* Aseguramos que el contenido se ajuste y no se desborde */
    white-space: normal;
    
    /* Si el menú usa columnas, lo forzamos a una sola columna */
    column-count: 1;
    
    /* Alineación para que no se corte en el borde derecho */
    right: 0 !important;
    left: auto !important;
  }
}
</style>
</head>

<?= $this->include('partials/body') ?>

    <?= $this->include('partials/loader') ?>

    <?= $this->include('partials/menu') ?>

        <?= $this->renderSection('content') ?>

    <?= $this->include('partials/footer') ?>

    <?= $this->include('partials/back-to-top') ?>

    <?= $this->include('partials/modal-popup') ?>

    <?= $this->include('partials/vendor-scripts') ?>
                <?= $this->renderSection('scripts') ?>

    <script type="text/javascript"> 
        function googleTranslateElementInit() {
          new google.translate.TranslateElement({pageLanguage: 'es', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>


</body>

</html>