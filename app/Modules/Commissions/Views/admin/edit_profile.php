<?= $this->extend('layouts/main_dashboard') ?>

<?= $this->section('content') ?>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Editar Perfil de Comisiones</h4>
                </div>
                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('commissions/admin/profiles') ?>">Perfiles</a></li>
                        <li class="breadcrumb-item active">Editar</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <?php if (session()->getFlashdata('error')): ?>
                                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                            <?php endif; ?>
                            <?php if (session()->getFlashdata('success')): ?>
                                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                            <?php endif; ?>

                            <form action="<?= base_url('commissions/admin/update-profile/' . $profile['id']) ?>" method="post">
                                <?= csrf_field() ?>

                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Nombre del Perfil</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?= esc($profile['name']) ?>" required>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="description" class="form-label">Descripción</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"><?= esc($profile['description']) ?></textarea>
                                </div>

                                <hr>

                                <h5 class="mt-4">Rangos de Comisión por Período</h5>
                                <p class="text-muted">Define los porcentajes de comisión basados en el número de días desde la interacción del cliente.</p>

                                <div id="commission-ranges-container">
                                    </div>

                                <button type="button" class="btn btn-info mt-2" id="add-range-btn">
                                    <i class="fas fa-plus me-1"></i> Añadir Rango
                                </button>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary">Actualizar Perfil</button>
                                    <a href="<?= base_url('commissions/admin/profiles') ?>" class="btn btn-secondary">Cancelar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('custom-scripts') ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let rangeIndex = 0;
    const container = document.getElementById('commission-ranges-container');
    const existingRanges = <?= json_encode($ranges) ?>; // Cargar datos desde PHP

    // Función para añadir un nuevo rango (ahora con datos opcionales)
    function addRange(startDay = '', endDay = '', share = '') {
        // El campo endDay puede ser null, lo convertimos a string vacío para el input
        const endDayValue = endDay === null ? '' : endDay;

        const rangeHtml = `
            <div class="row align-items-center mb-3 p-2 border rounded range-item">
                <div class="col-md-3">
                    <label class="form-label">Día Inicio</label>
                    <input type="number" name="ranges[${rangeIndex}][start_day]" class="form-control" value="${startDay}" placeholder="Ej: 1" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Día Fin</label>
                    <input type="number" name="ranges[${rangeIndex}][end_day]" class="form-control" value="${endDayValue}" placeholder="Ej: 30 (vacío para infinito)">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Comisión del Reseller (%)</label>
                    <input type="number" name="ranges[${rangeIndex}][reseller_share]" class="form-control" step="0.01" value="${share}" placeholder="Ej: 10" required>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-danger w-100 remove-range-btn">Quitar</button>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', rangeHtml);
        rangeIndex++;
    }

    // Cargar los rangos existentes al iniciar la página
    if (existingRanges && existingRanges.length > 0) {
        existingRanges.forEach(range => {
            addRange(range.start_day, range.end_day, range.reseller_share);
        });
    } else {
        // Si no hay rangos, añadir uno vacío por defecto
        addRange();
    }

    // Evento para el botón de añadir
    document.getElementById('add-range-btn').addEventListener('click', () => addRange());

    // Evento para quitar un rango (usando delegación de eventos)
    container.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-range-btn')) {
            e.target.closest('.range-item').remove();
        }
    });
});
</script>
<?= $this->endSection() ?>