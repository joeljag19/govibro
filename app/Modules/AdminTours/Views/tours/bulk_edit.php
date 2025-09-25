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
                    <h4 class="fs-18 fw-semibold m-0">Edición Masiva de Tours</h4>
                </div>

                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);" class="text-primary">Dusty</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Admin Tours</a></li>
                        <li class="breadcrumb-item active">Edición Masiva</li>
                    </ol>
                </div>
            </div>

            <!-- Start Form -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-0">Editar Tours Seleccionados</h5>
                                </div>
                            </div>

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

                            <form action="<?= base_url('/admin/tours/bulk-update') ?>" method="post">
                                <?php foreach ($tours as $tour): ?>
                                    <input type="hidden" name="tour_ids[]" value="<?= esc($tour['id']) ?>">
                                <?php endforeach; ?>

                                <div class="form-group mb-3">
                                    <label for="status">Estado</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="">No cambiar</option>
                                        <option value="draft">Borrador</option>
                                        <option value="published">Publicado</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="price">Precio</label>
                                    <input type="number" class="form-control" id="price" name="price" step="0.01" placeholder="No cambiar">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="category_id">Categoría</label>
                                    <select class="form-control" id="category_id" name="category_id">
                                        <option value="">No cambiar</option>
                                        <?php foreach ($categories as $category): ?>
                                            <option value="<?= esc($category['id']) ?>"><?= esc($category['name']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="location_id">Ubicación</label>
                                    <select class="form-control" id="location_id" name="location_id">
                                        <option value="">No cambiar</option>
                                        <?php foreach ($locations as $location): ?>
                                            <option value="<?= esc($location['id']) ?>"><?= esc($location['name']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Actualizar Tours</button>
                                <a href="<?= base_url('/admin/tours') ?>" class="btn btn-secondary">Cancelar</a>
                            </form>

                            <h5 class="card-title mt-4 mb-3">Tours Seleccionados</h5>
                            <table class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Título</th>
                                        <th>Categoría</th>
                                        <th>Ubicación</th>
                                        <th>Precio</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tours as $tour): ?>
                                        <tr>
                                            <td>#TR-<?= esc($tour['id']) ?></td>
                                            <td><?= esc($tour['title']) ?></td>
                                            <td><?= esc($tour['category_id']) ?></td>
                                            <td><?= esc($tour['location_id']) ?></td>
                                            <td>$<?= esc(number_format($tour['price'], 2)) ?></td>
                                            <td>
                                                <span class="badge <?= $tour['status'] == 'published' ? 'bg-success' : 'bg-warning' ?>">
                                                    <?= $tour['status'] == 'published' ? 'Publicado' : 'Borrador' ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
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