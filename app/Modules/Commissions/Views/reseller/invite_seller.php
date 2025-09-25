<?php $this->extend('layouts/main') ?>

<?php $this->section('content') ?>
<div class="container mt-5">
    <h2>Invitar Vendedor</h2>

    <?php if (session()->has('error')): ?>
        <div class="alert alert-danger">
            <?= session('error') ?>
        </div>
    <?php endif; ?>
    <?php if (session()->has('success')): ?>
        <div class="alert alert-success">
            <?= session('success') ?>
        </div>
    <?php endif; ?>

    <form id="invite-seller-form" action="<?= base_url('commissions/reseller/invite-seller') ?>" method="post">
        <div class="form-group">
            <label for="invitee_email">Email del Invitado</label>
            <input type="email" class="form-control" id="invitee_email" name="invitee_email" required>
        </div>
        <div class="form-group">
            <label for="commission_percentage">Porcentaje de Comisión (%)</label>
            <input type="number" class="form-control" id="commission_percentage" name="commission_percentage" min="0" max="100" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-primary">Enviar Invitación</button>
    </form>
</div>
<?php $this->endSection() ?>

<?php $this->section('scripts') ?>
<script>
document.getElementById('invite-seller-form').addEventListener('submit', async function(event) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(form);

    try {
        const response = await fetch(form.action, {
            method: 'POST',
            body: formData
        });
        const result = await response.json();

        if (result.success) {
            alert(result.message + '\nEnlace de invitación: ' + result.invitation_link);
            form.reset();
        } else {
            alert(result.message);
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Ocurrió un error al procesar la solicitud.');
    }
});
</script>
<?php $this->endSection() ?>