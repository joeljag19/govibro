<?php $this->extend('layouts/main_dashboard') ?>
<?php $this->section('content') ?>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Configuración de Comisiones</h4>
                </div>
                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('commissions/admin/candidates') ?>">Comisiones</a></li>
                        <li class="breadcrumb-item active">Configuración</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <?php if (session()->getFlashdata('error')): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?= session()->getFlashdata('error') ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>
                            <?php if (session()->getFlashdata('success')): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?= session()->getFlashdata('success') ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>
                            <form id="settings-form" action="<?= base_url('commissions/admin/update-settings') ?>" method="post">
                                <div class="form-group mb-3">
                                    <label class="form-label">Tipo de Comisión</label>
                                    <select class="form-control" name="type" required>
                                        <option value="percentage" <?= isset($settings['type']) && $settings['type'] === 'percentage' ? 'selected' : '' ?>>Porcentual</option>
                                        <option value="fixed" <?= isset($settings['type']) && $settings['type'] === 'fixed' ? 'selected' : '' ?>>Fija</option>
                                        <option value="combined" <?= isset($settings['type']) && $settings['type'] === 'combined' ? 'selected' : '' ?>>Mixta</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Porcentaje Total Comisión (%)</label>
                                    <input type="number" class="form-control" name="total_commission_percentage" value="<?= esc($settings['total_commission_percentage'] ?? 0) ?>" min="0" max="100" step="0.01" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Monto Fijo (si aplica)</label>
                                    <input type="number" class="form-control" name="fixed_amount" value="<?= esc($settings['fixed_amount'] ?? 0) ?>" min="0" step="0.01">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Periodo 1 (Días)</label>
                                    <input type="number" class="form-control" name="period1_days" value="<?= esc($settings['period1_days'] ?? 30) ?>" min="1" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Periodo 1: % Reseller</label>
                                    <input type="number" class="form-control" name="period1_reseller_share" value="<?= esc($settings['period1_reseller_share'] ?? 70) ?>" min="0" max="100" step="0.01" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Periodo 2 (Días)</label>
                                    <input type="number" class="form-control" name="period2_days" value="<?= esc($settings['period2_days'] ?? 60) ?>" min="1" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Periodo 2: % Reseller</label>
                                    <input type="number" class="form-control" name="period2_reseller_share" value="<?= esc($settings['period2_reseller_share'] ?? 50) ?>" min="0" max="100" step="0.01" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Periodo 3 (Días)</label>
                                    <input type="number" class="form-control" name="period3_days" value="<?= esc($settings['period3_days'] ?? 90) ?>" min="1" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Periodo 3: % Reseller</label>
                                    <input type="number" class="form-control" name="period3_reseller_share" value="<?= esc($settings['period3_reseller_share'] ?? 30) ?>" min="0" max="100" step="0.01" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Máximo Periodo (Días)</label>
                                    <input type="number" class="form-control" name="max_period_days" value="<?= esc($settings['max_period_days'] ?? 90) ?>" min="1" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>
<?php $this->section('scripts') ?>
<script>
    document.getElementById('settings-form').addEventListener('submit', async function(event) {
        event.preventDefault();
        const form = event.target;
        const formData = new FormData(form);
        try {
            const response = await fetch(form.action, { method: 'POST', body: formData });
            const result = await response.json();
            if (result.success) {
                alert(result.message);
                window.location.reload(); // Recarga para reflejar cambios
            } else {
                alert(result.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error al guardar configuraciones.');
        }
    });
</script>
<?php $this->endSection() ?>