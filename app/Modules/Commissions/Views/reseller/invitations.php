<?= $this->extend('layouts/main_dashboard') ?>
<?= $this->section('content') ?>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <h4 class="fs-18 fw-semibold my-3">Invitar Vendedores</h4>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Enviar Nueva Invitación</h5>
                    <form action="<?= base_url('commissions/reseller/send-invitation') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-md-5 mb-3">
                                <label class="form-label">Email del Vendedor</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="col-md-5 mb-3">
                                <label class="form-label">Reparto de mi comisión para este vendedor (%)</label>
                                <input type="number" name="commission_share_percentage" class="form-control" min="0" max="100" step="1" required>
                                <small class="form-text text-muted">Ej: Si pones 50, el vendedor recibirá el 50% de la comisión que tú generes.</small>
                            </div>
                            <div class="col-md-2 d-flex align-items-end mb-3">
                                <button type="submit" class="btn btn-primary w-100">Enviar Invitación</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Invitaciones Enviadas</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Email</th>
                                    <th>Enlace de Registro (Copiar y Enviar)</th>
                                    <th>Estado</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($invitations)): ?>
                                    <tr><td colspan="4" class="text-center">No has enviado ninguna invitación.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($invitations as $invitation): ?>
                                        <tr>
                                            <td><?= esc($invitation['invitee_email']) ?></td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="<?= base_url('auth/register-candidate?invitation_code=' . $invitation['invitation_code']) ?>" readonly>
                                                    <button class="btn btn-outline-secondary" type="button" onclick="copyToClipboard(this)">Copiar</button>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-<?= $invitation['status'] === 'accepted' ? 'success' : 'warning' ?>"><?= esc(ucfirst($invitation['status'])) ?></span></td>
                                            <td><?= esc($invitation['created_at']) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function copyToClipboard(button) {
    const input = button.previousElementSibling;
    input.select();
    input.setSelectionRange(0, 99999); // Para móviles
    document.execCommand('copy');
    button.textContent = 'Copiado!';
    setTimeout(() => { button.textContent = 'Copiar'; }, 2000);
}
</script>
<?= $this->endSection() ?>