<?= $this->extend('layouts/main_dashboard') ?>
<?= $this->section('content') ?>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="py-3 d-flex justify-content-between align-items-center">
                <h4 class="fs-18 fw-semibold m-0">Gestión de Términos</h4>
                <a href="<?= base_url('admin/terms/create') ?>" class="btn btn-primary">Añadir Nuevo Término</a>
            </div>

            <div class="card">
                <div class="card-body">
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                    <?php endif; ?>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre del Término</th>
                                    <th>Atributo Asociado</th>
                                    <th>Slug</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($terms)): ?>
                                    <tr><td colspan="5" class="text-center py-4">No hay términos creados.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($terms as $term): ?>
                                        <tr>
                                            <td><?= esc($term['id']) ?></td>
                                            <td><strong><?= esc($term['name']) ?></strong></td>
                                            <td><span class="badge bg-secondary"><?= esc($term['attr_name']) ?></span></td>
                                            <td><?= esc($term['slug']) ?></td>
                                            <td>
                                                <a href="<?= base_url('admin/terms/edit/' . $term['id']) ?>" class="btn btn-sm btn-info">Editar</a>
                                                <a href="<?= base_url('admin/terms/delete/' . $term['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <?= $pager->links() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>