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
                    <h4 class="fs-18 fw-semibold m-0">Editar Disponibilidad del Tour: <?= esc($tour['title']) ?></h4>
                </div>

                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);" class="text-primary">Dusty</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/tours') ?>">Tours</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/tours/availability/' . $tour['id']) ?>">Disponibilidad</a></li>
                        <li class="breadcrumb-item active">Editar</li>
                    </ol>
                </div>
            </div>

            <!-- Formulario para Editar Fecha de Disponibilidad -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Editar Fecha de Disponibilidad</h5>

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

                            <form method="post" action="<?= base_url('admin/tours/update-availability/' . $availability['id']) ?>">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <label for="start_date">Fecha de Inicio</label>
                                            <input type="date" name="start_date" id="start_date" class="form-control" value="<?= esc($availability['start_date']) ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <label for="end_date">Fecha de Fin</label>
                                            <input type="date" name="end_date" id="end_date" class="form-control" value="<?= esc($availability['end_date']) ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <label for="max_people">Máximo de Personas</label>
                                            <input type="number" name="max_people" id="max_people" class="form-control" value="<?= esc($availability['max_people']) ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <label for="is_available">Disponible</label>
                                            <select name="is_available" id="is_available" class="form-control">
                                                <option value="1" <?= $availability['is_available'] ? 'selected' : '' ?>>Sí</option>
                                                <option value="0" <?= !$availability['is_available'] ? 'selected' : '' ?>>No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Actualizar Fecha</button>
                                <a href="<?= base_url('admin/tours/availability/' . $tour['id']) ?>" class="btn btn-secondary">Cancelar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Form -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- content -->
</div>
<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->

<?= $this->endSection() ?>