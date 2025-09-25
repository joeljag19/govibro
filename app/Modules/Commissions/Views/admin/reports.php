<?php $this->extend('layouts/main_dashboard') ?>
<?php $this->section('content') ?>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Reportes de Comisiones</h4>
                </div>
                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('commissions/admin/candidates') ?>">Comisiones</a></li>
                        <li class="breadcrumb-item active">Reportes</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <?php if (session()->getFlashdata('error')): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?= session()->getFlashdata('error') ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>
                            <?php if (session()->getFlashdata('success')): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?= session()->getFlashdata('success') ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>
                            <form id="filter-form" class="mb-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Fecha Inicio</label>
                                            <input type="date" class="form-control" name="start_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Fecha Fin</label>
                                            <input type="date" class="form-control" name="end_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-end">
                                        <button type="submit" class="btn btn-primary">Filtrar</button>
                                    </div>
                                </div>
                            </form>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Reseller ID</th>
                                        <th>Nombre</th>
                                        <th>Total Comisiones</th>
                                        <th>Ventas</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="reports-table-body"></tbody>
                            </table>
                            <canvas id="commission-chart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    async function loadReports(startDate = '', endDate = '') {
        try {
            const url = '<?= base_url('commissions/admin/get-reports') ?>' + (startDate && endDate ? `?start_date=${startDate}&end_date=${endDate}` : '');
            const response = await fetch(url);
            const result = await response.json();
            if (result.success) {
                const tbody = document.getElementById('reports-table-body');
                tbody.innerHTML = '';
                result.reports.forEach(report => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${report.reseller_id}</td>
                        <td>${report.reseller_name}</td>
                        <td>$${parseFloat(report.total_commissions).toFixed(2)}</td>
                        <td>${report.sales_count}</td>
                        <td><a href="<?= base_url('commissions/admin/report-details/') ?>${report.reseller_id}" class="btn btn-info btn-sm">Detalles</a></td>
                    `;
                    tbody.appendChild(row);
                });

                // Generar gráfico
                const ctx = document.getElementById('commission-chart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: result.reports.map(r => r.reseller_name),
                        datasets: [{
                            label: 'Total Comisiones ($)',
                            data: result.reports.map(r => parseFloat(r.total_commissions)),
                            backgroundColor: ['#007bff', '#28a745', '#dc3545', '#ffc107'],
                            borderColor: ['#0056b3', '#218838', '#c82333', '#e0a800'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: { beginAtZero: true }
                        }
                    }
                });
            } else {
                alert(result.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error al cargar reportes.');
        }
    }

    document.getElementById('filter-form').addEventListener('submit', async function(event) {
        event.preventDefault();
        const formData = new FormData(event.target);
        const startDate = formData.get('start_date');
        const endDate = formData.get('end_date');
        loadReports(startDate, endDate);
    });

    document.addEventListener('DOMContentLoaded', () => loadReports());
</script>
<?php $this->endSection() ?>