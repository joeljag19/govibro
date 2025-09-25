<script src="<?= base_url('assets/js/jquery-3.7.1.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/js/wow.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.meanmenu.min.js') ?>"></script>

<script src="<?= base_url('assets/plugins/owlcarousel/owl.carousel.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/theia-sticky-sidebar/ResizeSensor.js') ?>"></script>
<script src="<?= base_url('assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') ?>"></script>
<script src="<?= base_url('assets/plugins/select2/js/select2.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.counterup.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.waypoints.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/moment/moment.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap-datetimepicker.min.js') ?>"></script>


<?php if (isset($assets) && in_array('apexcharts', $assets['js'] ?? [])): ?>
    <script src="<?= base_url('assets/plugins/apexchart/apexcharts.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/apexchart/chart-data.js') ?>"></script>
<?php endif; ?>

<?php if (isset($assets) && in_array('fancybox', $assets['js'] ?? [])): ?>
    <script src="<?= base_url('assets/plugins/fancybox/jquery.fancybox.min.js') ?>"></script>
<?php endif; ?>

<?php if (isset($assets) && in_array('slick', $assets['js'] ?? [])): ?>
    <script src="<?= base_url('assets/plugins/slick/slick.min.js') ?>"></script>
<?php endif; ?>

<?php if (isset($assets) && in_array('rangeslider', $assets['js'] ?? [])): ?>
    <script src="<?= base_url('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/ion-rangeslider/js/custom-rangeslider.js') ?>"></script>
<?php endif; ?>

<?php if (isset($assets) && in_array('quill', $assets['js'] ?? [])): ?>
    <script src="<?= base_url('assets/plugins/quill/quill.min.js') ?>"></script>
<?php endif; ?>

<?php if (isset($assets) && in_array('daterangepicker', $assets['js'] ?? [])): ?>
    <script src="<?= base_url('assets/plugins/daterangepicker/daterangepicker.js') ?>"></script>
<?php endif; ?>

<?php if (isset($assets) && in_array('slimscroll', $assets['js'] ?? [])): ?>
    <script src="<?= base_url('assets/plugins/slimscroll/jquery.slimscroll.min.js') ?>"></script>
<?php endif; ?>


    <?php if(isset($assets) && in_array('map-tour', $assets['js'] ?? [])) { echo '<script src="'.base_url('assets/js/map-tour.js').'"></script>'; } ?>
    <?php if(isset($assets) && in_array('map-car', $assets['js'] ?? [])) { echo '<script src="'.base_url('assets/js/map-car.js').'"></script>'; } ?>
    <?php if(isset($assets) && in_array('map-cruise', $assets['js'] ?? [])) { echo '<script src="'.base_url('assets/js/map-cruise.js').'"></script>'; } ?>


<?php if (isset($assets) && in_array('intltel', $assets['js'] ?? [])): ?>
    <script src="<?= base_url('assets/plugins/intltelinput/js/intlTelInput.js') ?>"></script>
<?php endif; ?>



<script src="<?= base_url('assets/js/cursor.js') ?>"></script>
<script src="<?= base_url('assets/js/script.js') ?>"></script>
