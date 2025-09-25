<?= $this->extend('layouts/main_dashboard') ?>

<?= $this->section('content') ?>

<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Disponibilidad del Tour: <?= esc($tour['title']) ?></h4>
                </div>

                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);" class="text-primary">Dusty</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/tours') ?>">Tours</a></li>
                        <li class="breadcrumb-item active">Disponibilidad</li>
                    </ol>
                </div>
            </div>

            <!-- Lista de Fechas Existentes -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Fechas de Disponibilidad</h5>

                            <!-- Mensajes de Éxito o Error -->
                            <?php if (session()->getFlashdata('success')): ?>
                                <div class="alert alert-success">
                                    <?= session()->getFlashdata('success') ?>
                                </div>
                            <?php endif; ?>
                            <?php if (session()->getFlashdata('error')): ?>
                                <div class="alert alert-danger">
                                    <?= session()->getFlashdata('error') ?>
                                </div>
                            <?php endif; ?>

                            <table class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>Fecha de Inicio</th>
                                        <th>Fecha de Fin</th>
                                        <th>Precio</th>
                                        <th>Mínimo de Huéspedes</th>
                                        <th>Máximo de Personas</th>
                                        <th>Nota al Cliente</th>
                                        <th>Nota al Admin</th>
                                        <th>Reserva Instantánea</th>
                                        <th>Disponible</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($availability)): ?>
                                        <tr>
                                            <td colspan="10" class="text-center">No hay fechas de disponibilidad definidas.</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($availability as $avail): ?>
                                            <tr>
                                                <td><?= esc($avail['start_date']) ?></td>
                                                <td><?= esc($avail['end_date']) ?></td>
                                                <td>$<?= number_format($avail['price'] ?? 0, 2) ?></td>
                                                <td><?= esc($avail['min_guests'] ?? '-') ?></td>
                                                <td><?= esc($avail['max_people'] ?? '-') ?></td>
                                                <td><?= esc($avail['note_to_customer'] ?? '-') ?></td>
                                                <td><?= esc($avail['note_to_admin'] ?? '-') ?></td>
                                                <td>
                                                    <span class="badge <?= $avail['is_instant'] ? 'bg-success' : 'bg-warning' ?>">
                                                        <?= $avail['is_instant'] ? 'Sí' : 'No' ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge <?= $avail['is_available'] ? 'bg-success' : 'bg-warning' ?>">
                                                        <?= $avail['is_available'] ? 'Sí' : 'No' ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-primary edit-availability" data-id="<?= esc($avail['id']) ?>" data-toggle="modal" data-target="#editAvailabilityModal"><i class="fas fa-edit"></i></a>
                                                    <a href="<?= base_url('admin/tours/delete-availability/' . $avail['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta fecha de disponibilidad?')"><i class="fas fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                            <!-- Modal para Editar Disponibilidad -->
                            <div class="modal fade" id="editAvailabilityModal" tabindex="-1" role="dialog" aria-labelledby="editAvailabilityModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editAvailabilityModalLabel">Editar Fecha de Disponibilidad</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="edit-availability-form" method="post" action="<?= base_url('admin/tours/update-availability/' . $tour['id']) ?>">
                                            <div class="modal-body">
                                                <input type="hidden" name="id" id="edit-availability-id">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label for="edit_start_date">Fecha de Inicio</label>
                                                            <input type="date" name="start_date" id="edit_start_date" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label for="edit_end_date">Fecha de Fin</label>
                                                            <input type="date" name="end_date" id="edit_end_date" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label for="edit_price">Precio</label>
                                                            <input type="number" name="price" id="edit_price" class="form-control" step="0.01">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label for="edit_min_guests">Mínimo de Huéspedes</label>
                                                            <input type="number" name="min_guests" id="edit_min_guests" class="form-control" min="1">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label for="edit_max_people">Máximo de Personas</label>
                                                            <input type="number" name="max_people" id="edit_max_people" class="form-control" min="1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label for="edit_note_to_customer">Nota al Cliente</label>
                                                            <textarea name="note_to_customer" id="edit_note_to_customer" class="form-control" rows="2"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label for="edit_note_to_admin">Nota al Admin</label>
                                                            <textarea name="note_to_admin" id="edit_note_to_admin" class="form-control" rows="2"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label for="edit_is_instant">Reserva Instantánea</label>
                                                            <select name="is_instant" id="edit_is_instant" class="form-control">
                                                                <option value="1">Sí</option>
                                                                <option value="0">No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label for="edit_is_available">Disponible</label>
                                                            <select name="is_available" id="edit_is_available" class="form-control">
                                                                <option value="1">Sí</option>
                                                                <option value="0">No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Formulario para Agregar Nueva Fecha de Disponibilidad -->
                            <h5 class="card-title mt-4 mb-3">Agregar Nueva Fecha de Disponibilidad</h5>
                            <form method="post" action="<?= base_url('admin/tours/add-availability/' . $tour['id']) ?>" id="add-availability-form">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group mb-3">
                                            <label for="start_date">Fecha de Inicio</label>
                                            <input type="date" name="start_date" id="start_date" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group mb-3">
                                            <label for="end_date">Fecha de Fin</label>
                                            <input type="date" name="end_date" id="end_date" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group mb-3">
                                            <label for="price">Precio</label>
                                            <input type="number" name="price" id="price" class="form-control" step="0.01">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group mb-3">
                                            <label for="min_guests">Mínimo de Huéspedes</label>
                                            <input type="number" name="min_guests" id="min_guests" class="form-control" min="1">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group mb-3">
                                            <label for="max_people">Máximo de Personas</label>
                                            <input type="number" name="max_people" id="max_people" class="form-control" min="1">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group mb-3">
                                            <label for="note_to_customer">Nota al Cliente</label>
                                            <textarea name="note_to_customer" id="note_to_customer" class="form-control" rows="2"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group mb-3">
                                            <label for="note_to_admin">Nota al Admin</label>
                                            <textarea name="note_to_admin" id="note_to_admin" class="form-control" rows="2"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group mb-3">
                                            <label for="is_instant">Reserva Instantánea</label>
                                            <select name="is_instant" id="is_instant" class="form-control">
                                                <option value="1">Sí</option>
                                                <option value="0" selected>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group mb-3">
                                            <label for="is_available">Disponible</label>
                                            <select name="is_available" id="is_available" class="form-control">
                                                <option value="1" selected>Sí</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Agregar Fecha</button>
                                <a href="<?= base_url('admin/tours') ?>" class="btn btn-secondary">Volver a la Lista</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Table -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- content -->
</div>
<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->

<script>
$(document).ready(function() {
    // Inicializar tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Cargar datos en el modal de edición
    $('.edit-availability').click(function() {
        const id = $(this).data('id');
        const availability = <?= json_encode($availability ?? []) ?>;
        const avail = availability.find(item => item.id == id);

        if (avail) {
            $('#edit-availability-id').val(avail.id);
            $('#edit_start_date').val(avail.start_date);
            $('#edit_end_date').val(avail.end_date);
            $('#edit_price').val(avail.price || '');
            $('#edit_min_guests').val(avail.min_guests || '');
            $('#edit_max_people').val(avail.max_people || '');
            $('#edit_note_to_customer').val(avail.note_to_customer || '');
            $('#edit_note_to_admin').val(avail.note_to_admin || '');
            $('#edit_is_instant').val(avail.is_instant ? '1' : '0');
            $('#edit_is_available').val(avail.is_available ? '1' : '0');
        }
    });

    // Validar el formulario de edición
    $('#edit-availability-form').submit(function(event) {
        const startDate = $('#edit_start_date').val();
        const endDate = $('#edit_end_date').val();
        if (!startDate || !endDate) {
            event.preventDefault();
            alert('Por favor, proporciona una fecha de inicio y una fecha de fin.');
            return false;
        }
    });

    // Validar el formulario de agregar nueva fecha
    $('#add-availability-form').submit(function(event) {
        const startDate = $('#start_date').val();
        const endDate = $('#end_date').val();
        if (!startDate || !endDate) {
            event.preventDefault();
            alert('Por favor, proporciona una fecha de inicio y una fecha de fin.');
            return false;
        }
    });
});
</script>

<?= $this->endSection() ?>