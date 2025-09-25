<?= $this->extend('layouts/main_dashboard') ?>
<?= $this->section('content') ?>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <h4 class="fs-18 fw-semibold my-3">Editar Ubicación: <?= esc($location['name']) ?></h4>
            <div class="card">
                <div class="card-body">
                    <form action="<?= base_url('admin/locations/update/' . $location['id']) ?>" method="post">
                        <?= csrf_field() ?>

                        <?php if (session()->getFlashdata('errors')): ?>
                            <div class="alert alert-danger">
                                <ul>
                                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Nombre de la Ubicación</label>
                            <input type="text" id="name" name="name" class="form-control" value="<?= old('name', $location['name']) ?>" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="content" class="form-label">Descripción (Opcional)</label>
                            <textarea id="content" name="content" class="form-control" rows="5"><?= old('content', $location['content']) ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Actualizar Ubicación</button>
                        <a href="<?= base_url('admin/locations') ?>" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
