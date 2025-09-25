<?= $this->extend('layouts/main_dashboard') ?>
<?= $this->section('content') ?>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="py-3">
                <h4 class="fs-18 fw-semibold m-0">Panel de Dueño de Servicio</h4>
            </div>
            
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title text-muted">Ingresos Brutos</h5>
                            <p class="text-muted mb-2">(Ventas totales de tus tours)</p>
                            <h3 class="display-5 mt-2">$<?= number_format($summary['gross_revenue'] ?? 0, 2) ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title text-muted">Comisiones Pagadas</h5>
                            <p class="text-muted mb-2">(Pagos a plataforma y afiliados)</p>
                            <h3 class="display-5 mt-2 text-danger">-$<?= number_format($summary['total_commissions_paid'] ?? 0, 2) ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    <div class="card bg-success text-white">
                        <div class="card-body text-center">
                            <h5 class="card-title text-white-50">Ganancias Netas</h5>
                            <p class="text-white-50 mb-2">(Lo que recibes)</p>
                            <h3 class="display-5 mt-2">$<?= number_format($summary['net_earnings'] ?? 0, 2) ?></h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección de Sincronización de Calendario -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Sincronización de Calendario</h5>
                            <p class="text-muted">Usa el siguiente enlace para sincronizar tus reservas de GoVibro con tu calendario personal (Google Calendar, Outlook, etc.). Mantenlo privado.</p>
                            
                            <?php 
                                $token = $ownerProfile['ical_token'] ?? null;
                                if ($token): 
                            ?>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="<?= base_url('ical/feed/' . $token) ?>" readonly>
                                    <button class="btn btn-outline-secondary" type="button" onclick="copyToClipboard(this)">Copiar</button>
                                </div>
                            <?php else: ?>
                                <p class="text-danger">No se ha podido generar tu enlace de sincronización. Contacta con el soporte.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <h5 class="mt-4">Rendimiento por Tour</h5>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Tour</th>
                                    <th>Ventas</th>
                                    <th>Ingresos Brutos</th>
                                    <th>Ganancia Neta</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($tour_performance)): ?>
                                    <tr><td colspan="4" class="text-center py-4">Aún no tienes ventas registradas para tus tours.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($tour_performance as $tour): ?>
                                        <tr>
                                            <td><?= esc($tour['title']) ?></td>
                                            <td><?= esc($tour['sales_count']) ?></td>
                                            <td>$<?= number_format($tour['total_revenue'], 2) ?></td>
                                            <td><strong>$<?= number_format($tour['net_earnings'], 2) ?></strong></td>
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
<?= $this->endSection() ?>

<?= $this->section('custom-scripts') ?>
<script>
function copyToClipboard(button) {
    const input = button.previousElementSibling;
    navigator.clipboard.writeText(input.value).then(() => {
        const originalText = button.textContent;
        button.textContent = '¡Copiado!';
        setTimeout(() => { button.textContent = originalText; }, 2000);
    }).catch(err => {
        console.error('Error al copiar: ', err);
    });
}
</script>
<?= $this->endSection() ?>
