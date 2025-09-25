<?= $this->extend('layouts/main_dashboard') ?>
<?= $this->section('content') ?>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="py-3 d-flex justify-content-between align-items-center">
                <h4 class="fs-18 fw-semibold m-0">Generar Pago a Afiliados</h4>
                <a href="<?= base_url('payouts/admin/history') ?>" class="btn btn-outline-primary">Ver Historial de Pagos</a>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Seleccionar Criterios</h5>
                            <p class="text-muted">Selecciona un tipo de afiliado y un usuario específico para ver sus comisiones pendientes de pago.</p>
                            
                            <?php if (session()->getFlashdata('error')): ?>
                                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                            <?php endif; ?>

                            <form action="<?= base_url('payouts/admin/generate-report') ?>" method="post">
                                <?= csrf_field() ?>
                                <div class="row align-items-end">
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Tipo de Afiliado</label>
                                        <select name="payee_type" id="payee_type" class="form-control" required>
                                            <option value="">Selecciona un tipo...</option>
                                            <option value="reseller">Revendedor</option>
                                            <option value="seller">Vendedor</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Afiliado</label>
                                        <select name="payee_id" id="payee_id" class="form-control" required disabled>
                                            <option value="">Primero selecciona un tipo</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label class="form-label">Fecha Inicio</label>
                                        <input type="date" name="start_date" class="form-control">
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label class="form-label">Fecha Fin</label>
                                        <input type="date" name="end_date" class="form-control">
                                    </div>
                                    <div class="col-md-1 mb-3">
                                        <button type="submit" class="btn btn-primary w-100">Generar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const payeeTypeSelect = document.getElementById('payee_type');
    const payeeIdSelect = document.getElementById('payee_id');

    const resellers = <?= json_encode($resellers) ?>;
    const sellers = <?= json_encode($sellers) ?>;

    payeeTypeSelect.addEventListener('change', function() {
        const selectedType = this.value;
        payeeIdSelect.innerHTML = '<option value="">Selecciona un afiliado...</option>';
        payeeIdSelect.disabled = true;

        let options = [];
        if (selectedType === 'reseller') {
            options = resellers;
            payeeIdSelect.disabled = false;
        } else if (selectedType === 'seller') {
            options = sellers;
            payeeIdSelect.disabled = false;
        }

        options.forEach(option => {
            // Usamos seller.id y reseller.id para el valor, pero user_name para el texto
            const id = selectedType === 'seller' ? option.id : option.id; 
            const name = option.user_name;
            payeeIdSelect.innerHTML += `<option value="${id}">${name}</option>`;
        });
    });
});
</script>
<?= $this->endSection() ?>
