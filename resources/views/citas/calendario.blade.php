<x-app-layout>
    <div class="container py-4">
        <h1 class="h2 mb-3">Calendario de citas</h1>

        <p class="text-secondary">
            Bienvenido, Dr. {{ Auth::user()->name }}
        </p>

        <a href="{{ route('admin.citas') }}" class="btn btn-primary mb-3">
            Volver a las citas
        </a>

        <div class="card shadow-sm">
            <div class="card-body">
                <div id="calendario"></div>

                <div class="modal fade" id="modalDentallesCita" tabindex="-1" aria-labelledby="tituloModalCita"
                    aria-hidden="true">

                    <div class="modal-dialog modal-dialog-centered">

                        <div class="modal-content">

                            <div class="modal-header bg-primary text-white">

                                <h5 class="modal-title" id="tituloModalCita">
                                    Detalles de la cita
                                </h5>

                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Cerrar">

                                </button>

                            </div>

                            <div class="modal-body">
                                <p>
                                    <strong>Paciente: </strong><span id="detallePaciente"></span>
                                </p>
                                <p>
                                    <strong>Fecha: </strong><span id="detalleFecha"></span>
                                </p>
                                <p>
                                    <strong>Hora: </strong><span id="detalleHora"></span>
                                </p>
                                <p>
                                    <strong>Servicio: </strong><span id="detalleServicio"></span>
                                </p>
                                <p>
                                    <strong>Estado: </strong><span id="detalleEstado"
                                        class="badge text-bg-secondary"></span>
                                </p>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Cerrar
                                </button>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
