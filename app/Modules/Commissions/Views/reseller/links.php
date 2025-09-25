<?= $this->extend('layouts/main_dashboard') ?>
<?= $this->section('content') ?>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <h4 class="fs-18 fw-semibold my-3">Dashboard de Enlaces</h4>

            <!-- Crear Nuevo Enlace de Campaña -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Crear Nuevo Enlace de Campaña</h5>
                    <p class="text-muted">Usa diferentes enlaces para medir de dónde vienen tus clientes (ej. "Campaña Facebook", "Blog de Viajes").</p>
                    <form action="<?= base_url('commissions/reseller/create-link') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="row align-items-end">
                            <div class="col-md-8 mb-3">
                                <label class="form-label">Nombre de la Campaña</label>
                                <input type="text" name="link_name" class="form-control" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <button type="submit" class="btn btn-primary w-100">Crear Enlace</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tabla de Tus Enlaces Personales -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Mis Enlaces Personales</h5>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr><th>Nombre/Campaña</th><th>Enlace</th><th class="text-center">QR</th><th>Acciones</th></tr>
                            </thead>
                            <tbody>
                                <?php if (empty($reseller_links)): ?>
                                    <tr><td colspan="4" class="text-center py-4">No has creado ningún enlace personal.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($reseller_links as $link): ?>
                                        <tr>
                                            <td><strong><?= esc($link['name'] ?? 'Enlace Principal') ?></strong></td>
                                            <td><input type="text" class="form-control form-control-sm" value="<?= esc($link['full_url']) ?>" readonly></td>
                                            <td class="text-center"><img src="data:image/png;base64,<?= $link['qr_base64'] ?>" alt="QR" width="80"></td>
                                            <td>
                                                <!-- BOTONES CORREGIDOS -->
                                                <button class="btn btn-sm btn-outline-secondary" onclick="copyToClipboard(this, '<?= esc($link['full_url']) ?>')">Copiar Link</button>
                                                <button class="btn btn-sm btn-outline-info" onclick="copyToClipboard(this, '<?= esc($link['nfc_data']) ?>')">Copiar NFC</button>
                                                <a href="data:image/png;base64,<?= $link['qr_base64'] ?>" download="qr_<?= esc($link['unique_code']) ?>.png" class="btn btn-sm btn-outline-success">Descargar QR</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tabla de Enlaces de Vendedores -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Enlaces de mi Equipo de Vendedores</h5>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr><th>Vendedor</th><th>Enlace</th><th class="text-center">QR</th><th>Acciones</th></tr>
                            </thead>
                            <tbody>
                                <?php if (empty($seller_links)): ?>
                                    <tr><td colspan="4" class="text-center py-4">Aún no tienes vendedores o no se han generado sus enlaces.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($seller_links as $link): ?>
                                        <tr>
                                            <td><?= esc($link['seller_name']) ?></td>
                                            <td><input type="text" class="form-control form-control-sm" value="<?= esc($link['full_url']) ?>" readonly></td>
                                            <td class="text-center"><img src="data:image/png;base64,<?= $link['qr_base64'] ?>" alt="QR" width="80"></td>
                                            <td>
                                                <!-- BOTONES CORREGIDOS -->
                                                <button class="btn btn-sm btn-outline-secondary" onclick="copyToClipboard(this, '<?= esc($link['full_url']) ?>')">Copiar Link</button>
                                                <button class="btn btn-sm btn-outline-info" onclick="copyToClipboard(this, '<?= esc($link['nfc_data']) ?>')">Copiar NFC</button>
                                                <a href="data:image/png;base64,<?= $link['qr_base64'] ?>" download="qr_<?= esc($link['unique_code']) ?>.png" class="btn btn-sm btn-outline-success">Descargar QR</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Historial de Clics -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Historial de Clics Recientes (Toda tu Red)</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr><th>Fecha</th><th>Vendedor Asociado</th><th>IP</th><th>Navegador</th></tr>
                            </thead>
                            <tbody>
                                <?php if(empty($clicks)): ?>
                                    <tr><td colspan="4" class="text-center py-4">No se han registrado clics.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($clicks as $click): ?>
                                        <tr>
                                            <td><?= esc($click['created_at']) ?></td>
                                            <td><?= $click['seller_id'] ? 'Vendedor ID: ' . esc($click['seller_id']) : 'Directo (Tú)' ?></td>
                                            <td><?= esc($click['ip_address']) ?></td>
                                            <td><?= esc(substr($click['user_agent'], 0, 70)) . '...' ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <?= $pager->links() ?>
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
        // Fallback para navegadores más antiguos
        const textArea = document.createElement("textarea");
        textArea.value = textToCopy;
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        try {
            document.execCommand('copy');
            const originalText = button.textContent;
            button.textContent = '¡Copiado!';
            setTimeout(() => { button.textContent = originalText; }, 2000);
        } catch (err) {
            alert('No se pudo copiar el texto.');
        }
        document.body.removeChild(textArea);
    });
}
</script>
<?= $this->endSection() ?>