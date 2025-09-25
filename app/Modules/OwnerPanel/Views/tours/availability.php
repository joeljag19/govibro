<?= $this->extend('layouts/main_dashboard') ?>

<?= $this->section('content') ?>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="py-3">
                <h4 class="fs-18 fw-semibold m-0">Gestionar Disponibilidad para: <?= esc($tour['title']) ?></h4>
            </div>

            <div class="card">
                <div class="card-body">
                    <p class="text-muted">Haz clic en una fecha o arrastra sobre varias fechas para establecer la disponibilidad. Haz clic en un evento existente para editarlo o eliminarlo.</p>
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Añadir/Editar Disponibilidad -->
<div class="modal fade" id="availabilityModal" tabindex="-1" aria-labelledby="availabilityModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="availabilityModalLabel">Gestionar Disponibilidad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="availabilityForm">
                    <input type="hidden" id="eventId" name="id">
                    <input type="hidden" id="tourIdInput" name="tour_id" value="<?= esc($tour['id']) ?>">
                    <input type="hidden" id="eventStartDate" name="start">
                    <input type="hidden" id="eventEndDate" name="end">
                    <p><strong>Fechas seleccionadas:</strong> <span id="selectedDates"></span></p>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="isAvailable" name="is_available" checked>
                        <label class="form-check-label" for="isAvailable">¿Está disponible?</label>
                    </div>
                    <div id="availability-details">
                        <div class="mb-3">
                            <label for="maxPeople" class="form-label">Plazas Disponibles</label>
                            <input type="number" class="form-control" id="maxPeople" name="max_people" placeholder="Ej: 20">
                        </div>
                        <div class="mb-3">
                            <label for="eventPrice" class="form-label">Precio (Opcional)</label>
                            <input type="number" class="form-control" id="eventPrice" name="price" step="0.01" placeholder="Dejar en blanco para usar el precio base">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" id="deleteEventButton" style="display: none;">Eliminar</button>
                <div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="saveEventButton">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('custom-scripts') ?>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const availabilityModal = new bootstrap.Modal(document.getElementById('availabilityModal'));
    const form = document.getElementById('availabilityForm');
    const deleteButton = document.getElementById('deleteEventButton');
    const tourId = "<?= esc($tour['id']) ?>";

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        selectable: true,
        editable: true,
        events: `<?= base_url('owner/tours/availability/events/') ?>/${tourId}`,

        select: function(info) {
            form.reset();
            document.getElementById('eventId').value = '';
            document.getElementById('isAvailable').checked = true;
            document.getElementById('availability-details').style.display = 'block';
            deleteButton.style.display = 'none';
            
            document.getElementById('eventStartDate').value = info.startStr;
            document.getElementById('eventEndDate').value = info.endStr;
            document.getElementById('selectedDates').textContent = `${info.startStr} a ${info.endStr.split('T')[0]}`;
            
            availabilityModal.show();
        },

        eventClick: function(info) {
            form.reset();
            const props = info.event.extendedProps;
            
            document.getElementById('eventId').value = info.event.id;
            document.getElementById('eventStartDate').value = info.event.startStr;
            document.getElementById('eventEndDate').value = info.event.endStr;
            document.getElementById('selectedDates').textContent = info.event.startStr;

            document.getElementById('isAvailable').checked = props.is_available == 1;
            document.getElementById('maxPeople').value = props.max_people || '';
            document.getElementById('eventPrice').value = props.price || '';
            
            document.getElementById('availability-details').style.display = props.is_available ? 'block' : 'none';
            deleteButton.style.display = 'block';

            availabilityModal.show();
        },
        
        eventDrop: function(info) { saveEventFromCalendar(info.event); },
        eventResize: function(info) { saveEventFromCalendar(info.event); }
    });

    calendar.render();

    document.getElementById('isAvailable').addEventListener('change', function() {
        document.getElementById('availability-details').style.display = this.checked ? 'block' : 'none';
    });

    document.getElementById('saveEventButton').addEventListener('click', function() {
        const eventData = {
            id: document.getElementById('eventId').value,
            // --- CORRECCIÓN: Leemos el valor directamente del input oculto ---
            tour_id: document.getElementById('tourIdInput').value,
            start: document.getElementById('eventStartDate').value,
            end: document.getElementById('eventEndDate').value,
            is_available: document.getElementById('isAvailable').checked,
            max_people: document.getElementById('maxPeople').value,
            price: document.getElementById('eventPrice').value,
        };
        saveEventToServer(eventData);
    });

    deleteButton.addEventListener('click', function() {
        const eventId = document.getElementById('eventId').value;
        if (eventId && confirm('¿Estás seguro de que deseas eliminar esta entrada de disponibilidad?')) {
            fetch('<?= base_url('owner/tours/availability/delete') ?>', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                body: JSON.stringify({ id: eventId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    calendar.refetchEvents();
                    availabilityModal.hide();
                } else { alert('Error: ' + data.message); }
            })
            .catch(error => console.error('Error:', error));
        }
    });

    function saveEventFromCalendar(event) {
        const eventData = {
            id: event.id,
            tour_id: tourId,
            start: event.startStr,
            end: event.endStr,
            is_available: event.extendedProps.is_available,
            max_people: event.extendedProps.max_people,
            price: event.extendedProps.price,
        };
        saveEventToServer(eventData);
    }

    function saveEventToServer(eventData) {
        fetch('<?= base_url('owner/tours/availability/save') ?>', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
            body: JSON.stringify(eventData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                calendar.refetchEvents();
                availabilityModal.hide();
            } else { alert('Error: ' + data.message); }
        })
        .catch(error => console.error('Error:', error));
    }
});
</script>
<?= $this->endSection() ?>
