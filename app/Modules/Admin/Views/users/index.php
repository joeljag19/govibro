<?= $this->extend('layouts/main_dashboard') ?>
<?= $this->section('content') ?>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="py-3 d-flex justify-content-between align-items-center">
                <h4 class="fs-18 fw-semibold m-0">Gestión de Usuarios</h4>
                <a href="<?= base_url('admin/users/create') ?>" class="btn btn-primary">Crear Usuario</a>
            </div>

            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr><th>ID</th><th>Nombre</th><th>Email</th><th>Rol</th><th>Fecha de Registro</th></tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= esc($user['id']) ?></td>
                                    <td><?= esc($user['name']) ?></td>
                                    <td><?= esc($user['email']) ?></td>
                                    <td><span class="badge bg-info"><?= esc($user['role']) ?></span></td>
                                    <td><?= esc($user['created_at']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?= $pager->links() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>