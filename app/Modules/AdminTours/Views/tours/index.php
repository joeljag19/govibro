<?= $this->extend('layouts/main_dashboard') ?>

<?= $this->section('content') ?>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="py-3 d-flex justify-content-between align-items-center">
                <h4 class="fs-18 fw-semibold m-0">Lista de Tours</h4>
                <div>
                    <a href="<?= base_url('admin/tours/create') ?>" class="btn btn-primary">Nuevo Tour</a>
                    <button type="submit" form="bulkEditForm" class="btn btn-warning ms-2">Edición Masiva</button>
                </div>
            </div>

            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#active-tours">Activos</a>
                </li>
                <?php if ($user['role'] === 'super_admin' && isset($deletedTours)): ?>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#deleted-tours">Papelera</a>
                </li>
                <?php endif; ?>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="active-tours">
                    <div class="card">
                        <div class="card-body">
                            <form id="bulkEditForm" action="<?= base_url('admin/tours/bulk-edit') ?>" method="get">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th><input type="checkbox" id="selectAll"></th>
                                                <th>ID</th>
                                                <th>Título</th>
                                                <?php if ($user['role'] === 'super_admin'): ?>
                                                    <th>Propietario</th>
                                                <?php endif; ?>
                                                <th>Categoría</th>
                                                <th>Precio</th>
                                                <th>Estado</th>
                                                <th>Aprobación</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (empty($toursWithCategories)): ?>
                                                <tr><td colspan="<?= $user['role'] === 'super_admin' ? '9' : '8' ?>" class="text-center py-4">No se encontraron tours.</td></tr>
                                            <?php else: ?>
                                                <?php foreach ($toursWithCategories as $tour): ?>
                                                    <tr>
                                                        <td><input type="checkbox" class="tourCheckbox" value="<?= esc($tour['id']) ?>"></td>
                                                        <td>#TR-<?= esc($tour['id']) ?></td>
                                                        <td><?= esc($tour['title']) ?></td>
                                                        <?php if ($user['role'] === 'super_admin'): ?>
                                                            <td><?= esc($tour['owner_name'] ?? 'N/A') ?></td>
                                                        <?php endif; ?>
                                                        <td><?= esc($tour['category_name'] ?? 'N/A') ?></td>
                                                        <td>$<?= number_format($tour['price'], 2) ?></td>
                                                        <td><span class="badge bg-<?= $tour['status'] === 'published' ? 'success' : 'secondary' ?>"><?= esc(ucfirst($tour['status'])) ?></span></td>
                                                        <td><span class="badge bg-<?= $tour['approval_status'] === 'approved' ? 'success' : ($tour['approval_status'] === 'pending' ? 'warning' : 'danger') ?>"><?= esc(ucfirst($tour['approval_status'])) ?></span></td>
                                                        <td>
                                                            <a href="<?= base_url('admin/tours/edit/' . $tour['id']) ?>" class="btn btn-sm btn-info">Editar</a>
                                                            
                                                            <!-- BOTÓN AÑADIDO -->
                                                            <a href="<?= base_url('owner/tours/availability/' . $tour['id']) ?>" class="btn btn-sm btn-warning">Disponibilidad</a>
                                                            
                                                            <?php if ($user['role'] === 'super_admin' && $tour['approval_status'] === 'pending'): ?>
                                                                <a href="<?= base_url('admin/tours/approve/' . $tour['id']) ?>" class="btn btn-sm btn-success">Aprobar</a>
                                                            <?php endif; ?>
                                                            <a href="<?= base_url('admin/tours/delete/' . $tour['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Mover este tour a la papelera?')">Eliminar</a>
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
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Pestaña de Tours Eliminados -->
                <?php if ($user['role'] === 'super_admin' && isset($deletedTours)): ?>
                <div class="tab-pane fade" id="deleted-tours">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr><th>ID</th><th>Título</th><th>Fecha de Eliminación</th><th>Acciones</th></tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($deletedTours)): ?>
                                            <tr><td colspan="4" class="text-center py-4">La papelera está vacía.</td></tr>
                                        <?php else: ?>
                                            <?php foreach ($deletedTours as $tour): ?>
                                                <tr>
                                                    <td>#TR-<?= esc($tour['id']) ?></td>
                                                    <td><?= esc($tour['title']) ?></td>
                                                    <td><?= esc($tour['deleted_at']) ?></td>
                                                    <td><a href="<?= base_url('admin/tours/restore/' . $tour['id']) ?>" class="btn btn-sm btn-success">Restaurar</a></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('custom-scripts') ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('selectAll').addEventListener('change', function() {
        document.querySelectorAll('.tourCheckbox').forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

    document.getElementById('bulkEditForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const selectedTours = Array.from(document.querySelectorAll('.tourCheckbox:checked')).map(cb => cb.value);
        if (selectedTours.length === 0) {
            alert('Por favor, selecciona al menos un tour.');
            return;
        }
        const ids = selectedTours.join(',');
        window.location.href = `<?= base_url('admin/tours/bulk-edit') ?>?ids=${ids}`;
    });
});
</script>
<?= $this->endSection() ?>
