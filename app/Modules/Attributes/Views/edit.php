<?= $this->extend('layouts/main_dashboard') ?>
<?= $this->section('content') ?>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <h4 class="fs-18 fw-semibold my-3">Editar Atributo: <?= esc($attribute['name']) ?></h4>
            <div class="card">
                <div class="card-body">
                    <form action="<?= base_url('admin/attributes/update/' . $attribute['id']) ?>" method="post">
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
                            <label for="name" class="form-label">Nombre del Atributo</label>
                            <input type="text" id="name" name="name" class="form-control" value="<?= old('name', $attribute['name']) ?>" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Actualizar Atributo</button>
                        <a href="<?= base_url('admin/attributes') ?>" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
