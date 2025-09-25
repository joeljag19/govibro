<?php $this->extend('layouts/main') ?>

<?php $this->section('content') ?>
<div class="container mt-5">
    <h2>Crear Vendedor (Revendedor)</h2>

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

    <form id="create-seller-form" action="<?= base_url('commissions/reseller/create-seller') ?>" method="post">
        <div class="form-group">
            <label for="user_id">Usuario</label>
            <select class="form-control" id="user_id" name="user_id" required>
                <option value="">Seleccione un usuario</option>
                <?php foreach ($users as $user): ?>
                    <?php if ($user['role'] !== 'seller'): ?>
                        <option value="<?= esc($user['id']) ?>"><?= esc($user['name']) ?> (<?= esc($user['email']) ?>)</option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="commission_percentage">Porcentaje de Comisión (%)</label>
            <input type="number" class="form-control" id="commission_percentage" name="commission_percentage" min="0" max="100" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-primary">Crear Vendedor</button>
    </form>
</div>
<?php $this->endSection() ?>

<?php $this->section('scripts') ?>
<script>
document.getElementById('create-seller-form').addEventListener('submit', async function(event) {
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
            alert(result.message);
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