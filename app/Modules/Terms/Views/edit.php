<?= $this->extend('layouts/main_dashboard') ?>
<?= $this->section('content') ?>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <h4 class="fs-18 fw-semibold my-3">Editar Término: <?= esc($term['name']) ?></h4>
            <div class="card">
                <div class="card-body">
                    <form action="<?= base_url('admin/terms/update/' . $term['id']) ?>" method="post">
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
                            <label for="name" class="form-label">Nombre del Término</label>
                            <input type="text" id="name" name="name" class="form-control" value="<?= old('name', $term['name']) ?>" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="attr_id" class="form-label">Asociar al Atributo</label>
                            <select id="attr_id" name="attr_id" class="form-control" required>
                                <option value="">Selecciona un atributo...</option>
                                <?php foreach ($attributes as $attribute): ?>
                                    <option value="<?= esc($attribute['id']) ?>" <?= old('attr_id', $term['attr_id']) == $attribute['id'] ? 'selected' : '' ?>><?= esc($attribute['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="content" class="form-label">Descripción (Opcional)</label>
                            <textarea id="content" name="content" class="form-control" rows="5"><?= old('content', $term['content']) ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Actualizar Término</button>
                        <a href="<?= base_url('admin/terms') ?>" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>