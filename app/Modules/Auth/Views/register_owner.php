<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Conviértete en Proveedor</h3>
                    <p class="text-center text-muted mb-4">Regístrate para empezar a ofrecer tus tours y servicios en nuestra plataforma.</p>
                    
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>

                    <form action="<?= base_url('auth/register-owner') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="form-group mb-3">
                            <label for="name">Nombre Completo o de la Empresa</label>
                            <input type="text" class="form-control" name="name" value="<?= old('name') ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email de Contacto</label>
                            <input type="email" class="form-control" name="email" value="<?= old('email') ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password_confirm">Confirmar Contraseña</label>
                            <input type="password" class="form-control" name="password_confirm" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Enviar Solicitud</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>