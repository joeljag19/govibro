<?= $this->extend('layouts/main_dashboard') ?>
<?= $this->section('content') ?>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <h4 class="fs-18 fw-semibold my-3">Crear Nuevo Revendedor (Manual)</h4>
            <div class="card">
                <div class="card-body">
                    <p class="text-muted">Utiliza este formulario para crear una cuenta de revendedor completa desde cero, sin pasar por el proceso de solicitud.</p>
                    
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>

                    <form action="<?= base_url('commissions/admin/create-reseller') ?>" method="post">
                        <?= csrf_field() ?>
                        
                        <h5 class="mt-4">Datos de la Cuenta</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nombre</label>
                                <input type="text" name="first_name" class="form-control" value="<?= old('first_name') ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Apellido</label>
                                <input type="text" name="last_name" class="form-control" value="<?= old('last_name') ?>" required>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?= old('email') ?>" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Contraseña</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Confirmar Contraseña</label>
                                <input type="password" name="password_confirm" class="form-control" required>
                            </div>
                        </div>

                        <hr>
                        <h5 class="mt-4">Datos del Perfil de Revendedor</h5>
                        <div class="form-group mb-3">
                            <label class="form-label">Perfil de Comisión</label>
                            <select class="form-control" name="commission_profile_id" required>
                                <option value="">Seleccione un perfil</option>
                                <?php foreach ($profiles as $profile): ?>
                                    <option value="<?= esc($profile['id']) ?>" <?= old('commission_profile_id') == $profile['id'] ? 'selected' : '' ?>><?= esc($profile['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Límite de Vendedores</label>
                            <input type="number" class="form-control" name="max_sellers" min="1" value="<?= old('max_sellers', 10) ?>" required>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Crear Revendedor</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>