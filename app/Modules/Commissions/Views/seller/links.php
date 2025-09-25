<?= $this->extend('layouts/main_dashboard') ?>
<?= $this->section('content') ?>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <h4 class="fs-18 fw-semibold my-3">Mis Enlaces de Seguimiento</h4>

            <div class="card">
                <div class="card-body">
                    <p class="text-muted">Usa este enlace para todas tus promociones. Cada cliente que haga clic en él quedará asociado a tu cuenta para el cálculo de comisiones.</p>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Enlace</th>
                                    <th class="text-center">Código QR</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- CORRECCIÓN: Se usa la variable $links en lugar de $reseller_links -->
                                <?php if (empty($links)): ?>
                                    <tr><td colspan="4" class="text-center py-4">No se ha generado un enlace de seguimiento para ti. Por favor, contacta a tu revendedor.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($links as $link): ?>
                                        <tr>
                                            <td><strong><?= esc($link['name'] ?? 'Enlace Principal') ?></strong></td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm" value="<?= esc($link['full_url']) ?>" readonly>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($link['qr_base64']): ?>
                                                    <img src="data:image/png;base64,<?= $link['qr_base64'] ?>" alt="QR Code" width="80">
                                                <?php else: ?>
                                                    <span class="text-danger">Error al generar QR</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-secondary" onclick="copyToClipboard(this, '<?= esc($link['full_url']) ?>')">Copiar Link</button>
                                                <button class="btn btn-sm btn-outline-info" onclick="copyToClipboard(this, '<?= esc($link['nfc_data']) ?>')">Copiar NFC</button>
                                                <?php if ($link['qr_base64']): ?>
                                                    <a href="data:image/png;base64,<?= $link['qr_base64'] ?>" download="qr_<?= esc($link['unique_code']) ?>.png" class="btn btn-sm btn-outline-success">Descargar QR</a>
                                                <?php endif; ?>
                                            </td>
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
function copyToClipboard(button, textToCopy) {
    navigator.clipboard.writeText(textToCopy).then(() => {
        const originalText = button.textContent;
        button.textContent = '¡Copiado!';
        setTimeout(() => { button.textContent = originalText; }, 2000);
    }).catch(err => {
        console.error('Error al copiar: ', err);
    });
}
</script>
<?= $this->endSection() ?>