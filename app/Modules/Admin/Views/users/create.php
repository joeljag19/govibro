<?= $this->extend('layouts/main_dashboard') ?>
<?= $this->section('content') ?>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <h4 class="fs-18 fw-semibold my-3">Crear Nuevo Usuario</h4>
            <div class="card">
                <div class="card-body">
                    <form action="<?= base_url('admin/users/create') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="form-group mb-3">
                            <label class="form-label">Nombre Completo</label>
                            <input type="text" name="name" class="form-control" value="<?= old('name') ?>" required>
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
                        <div class="form-group mb-3">
                            <label class="form-label">Rol</label>
                            <select name="role" class="form-control" required>
                                <option value="customer" <?= old('role') === 'customer' ? 'selected' : '' ?>>Cliente</option>
                                <option value="owner" <?= old('role') === 'owner' ? 'selected' : '' ?>>Dueño de Servicio</option>
                                <option value="admin" <?= old('role') === 'admin' ? 'selected' : '' ?>>Administrador</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Crear Usuario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>