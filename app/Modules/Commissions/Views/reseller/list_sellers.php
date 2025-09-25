<?php $this->extend('layouts/main') ?>
<?php $this->section('content') ?>
<div class="container mt-5">
    <h2>Mis Vendedores</h2>
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
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Porcentaje de Comisión</th>
                <th>Fecha de Creación</th>
            </tr>
        </thead>
        <tbody id="sellers-table-body"></tbody>
    </table>
</div>

<script>
    async function loadSellers() {
        try {
            const response = await fetch('<?= base_url('commissions/reseller/get-sellers') ?>');
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            const result = await response.json();
            console.log('Load sellers result:', result);
            if (result.success) {
                const tbody = document.getElementById('sellers-table-body');
                tbody.innerHTML = '';
                if (result.sellers.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="3">No hay vendedores asociados.</td></tr>';
                } else {
                    result.sellers.forEach(seller => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${seller.id}</td>
                            <td>${seller.commission_percentage}%</td>
                            <td>${seller.created_at}</td>
                        `;
                        tbody.appendChild(row);
                    });
                }
            } else {
                alert(result.message);
            }
        } catch (error) {
            console.error('Error al cargar vendedores:', error);
            alert('Error al cargar vendedores: ' + error.message);
        }
    }

    document.addEventListener('DOMContentLoaded', loadSellers);
</script>
<?php $this->endSection() ?>