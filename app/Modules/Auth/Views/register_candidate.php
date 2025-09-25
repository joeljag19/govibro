<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Registro de Candidato</h3>

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>

                    <form action="<?= base_url('auth/register-candidate') ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="invitation_code" value="<?= esc($invitation['invitation_code'] ?? '') ?>">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name">Nombre</label>
                                <!-- CAMBIO: Añadido old() -->
                                <input type="text" class="form-control" id="first_name" name="first_name" value="<?= old('first_name') ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="last_name">Apellido</label>
                                <!-- CAMBIO: Añadido old() -->
                                <input type="text" class="form-control" id="last_name" name="last_name" value="<?= old('last_name') ?>" required>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <!-- CAMBIO: Añadido old() como fallback -->
                            <input type="email" class="form-control" id="email" name="email"
                                   value="<?= esc($invitation['invitee_email'] ?? old('email')) ?>"
                                   <?= !empty($invitation) ? 'readonly' : '' ?> required>
                            <?php if (!empty($invitation)): ?>
                                <small class="form-text text-muted">Este email está asociado a una invitación y no puede ser modificado.</small>
                            <?php endif; ?>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password_confirm">Confirmar Contraseña</label>
                                <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
                            </div>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="phone">Teléfono (Opcional)</label>
                            <!-- CAMBIO: Añadido old() -->
                            <input type="text" class="form-control" id="phone" name="phone" value="<?= old('phone') ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label for="address">Dirección (Opcional)</label>
                            <!-- CAMBIO: Añadido old() -->
                            <textarea class="form-control" id="address" name="address" rows="2"><?= old('address') ?></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="identity_document">Documento de Identidad</label>
                            <!-- CAMBIO: Añadido old() -->
                            <input type="text" class="form-control" id="identity_document" name="identity_document" value="<?= old('identity_document') ?>" required>
                        </div>
                        
                        <?php if (empty($invitation)): ?>
                            <div class="form-group mb-3">
                                <label for="candidate_type">Tipo de Candidatura</label>
                                <select class="form-control" id="candidate_type" name="candidate_type" required>
                                    <option value="">Seleccione una opción</option>
                                    <!-- CAMBIO: Añadido old() para la selección -->
                                    <option value="seller_candidate" <?= old('candidate_type') === 'seller_candidate' ? 'selected' : '' ?>>Quiero ser Vendedor</option>
                                    <option value="reseller_candidate" <?= old('candidate_type') === 'reseller_candidate' ? 'selected' : '' ?>>Quiero ser Revendedor</option>
                                </select>
                            </div>
                        <?php endif; ?>

                        <button type="submit" class="btn btn-primary w-100 mt-3">Enviar Solicitud</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>