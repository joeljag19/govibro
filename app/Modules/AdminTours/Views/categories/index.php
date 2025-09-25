<?= $this->extend('layouts/main_dashboard') ?>
<?= $this->section('content') ?>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="py-3 d-flex justify-content-between align-items-center">
                <h4 class="fs-18 fw-semibold m-0">Gestión de Categorías de Tours</h4>
                <a href="<?= base_url('admin/tours/categories/create') ?>" class="btn btn-primary">Añadir Nueva Categoría</a>
            </div>

            <div class="card">
                <div class="card-body">
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Slug</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($categories)): ?>
                                    <tr><td colspan="4" class="text-center py-4">No hay categorías creadas.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($categories as $category): ?>
                                        <tr>
                                            <td><?= esc($category['id']) ?></td>
                                            <td><strong><?= esc($category['name']) ?></strong></td>
                                            <td><?= esc($category['slug']) ?></td>
                                            <td>
                                                <a href="<?= base_url('admin/tours/categories/edit/' . $category['id']) ?>" class="btn btn-sm btn-info">Editar</a>
                                                <a href="<?= base_url('admin/tours/categories/delete/' . $category['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas mover esta categoría a la papelera?')">Eliminar</a>
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
