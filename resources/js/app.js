import './bootstrap';
import 'bootstrap-icons/font/bootstrap-icons.css';

import Alpine from 'alpinejs';

import 'bootstrap/dist/css/bootstrap.min.css';
import * as bootstrap from 'bootstrap';

window.Alpine = Alpine;

Alpine.start();

import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';
import bootstrap5lugin from '@fullcalendar/bootstrap5';

import esLocate from '@fullcalendar/core/locales/es';

document.addEventListener('DOMContentLoaded', function () {

    const elementoCalendario = document.getElementById('calendario');

    if (!elementoCalendario) {
        return;
    }

    const calendario = new Calendar(elementoCalendario, {

        plugins: [
            dayGridPlugin,
            timeGridPlugin,
            interactionPlugin,
            bootstrap5lugin
        ],

        themeSystem: 'bootstrap5',
        locale: esLocate,

        initialView: 'dayGridMonth',



        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },

        buttonText: {
            today: 'Hoy',
            month: 'Mes',
            week: 'Semana',
            day: 'Día'
        },

        height: 'auto',
        nowIndicator: true,
        allDaySlot: false,

        slotMinTime: '08:00:00',
        slotMaxTime: '20:00:00',

        events: '/admin/calendario/eventos',

        eventClick: function (info) {
            const cita = info.event;

            document.getElementById('detallePaciente').textContent =
                cita.extendedProps.nombre || cita.title;

            document.getElementById('detalleFecha').textContent =
                cita.start
                    ? cita.start.toLocaleDateString('es-MX')
                    : 'No disponible';

            document.getElementById('detalleHora').textContent =
                cita.start
                    ? cita.start.toLocaleTimeString('es-MX', {
                        hour: '2-digit',
                        minute: '2-digit'
                    })
                    : 'No disponible';

            document.getElementById('detalleServicio').textContent =
                cita.extendedProps.servicio || 'No disponible';

            const estado = cita.extendedProps.estado || 'pendiente';

            const etiquetaEstado = document.getElementById('detalleEstado');

            etiquetaEstado.textContent =
                estado.charAt(0).toUpperCase() + estado.slice(1);

            const coloresEstado = {
                pendiente: 'text-bg-warning',
                confirmado: 'text-bg-primary',
                cancelado: 'text-bg-danger',
                atendida: 'text-bg-success',
            };

            etiquetaEstado.className = 'badge ' + (coloresEstado[estado] || 'text-bg-secondary');

            const botonConfirmar = document.getElementById('btnConfirmarCita');

            //Guardar el id de la cita seleccionada
            botonConfirmar.dataset.citaId = cita.id;

            //Mostrar el botón solo para citas pendientes
            botonConfirmar.style.display =
                cita.extendedProps.estado === 'pendiente'
                    ? 'inline-block'
                    : 'none';

            const modal = bootstrap.Modal.getOrCreateInstance(
                document.getElementById('modalDetallesCita')
            );

            modal.show();
        },


        eventDidMount: function (info) {
            const color = info.event.backgroundColor;

            console.log(
                'Cita:',
                info.event.title,
                '| Estado de color recibido:',
                info.event.backgroundColor
            );

            if (color) {
                info.el.style.setProperty(
                    'background-color',
                    color,
                    'important'
                );

                info.el.style.setProperty(
                    'border-color',
                    color,
                    'important'
                );
            }

            info.el.style.setProperty('color', '#ffffff', 'important');
        }
            });

    calendario.render();

    const botonConfirmar = document.getElementById('btnConfirmarCita');

    botonConfirmar.addEventListener('click', async function () {
        const citaId = this.dataset.citaId;

        if (!citaId) {
            return;
        }

        this.disabled = true;

        try {
            const respuesta = await fetch(
                `/admin/calendario/${citaId}/confirmar`,
                {
                    method: 'PATCH',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector(
                            'meta[name="csrf-token"]'
                        ).content
                    }
                }
            );

            const resultado = await respuesta.json();

            if (!respuesta.ok) {
                throw new Error(resultado.mensaje || 'No se pudo confirmar la cita.');
            }

            alert(resultado.mensaje);

            bootstrap.Modal.getInstance(
                document.getElementById('modalDetallesCita')
            ).hide();

            calendario.refetchEvents();

        } catch (error) {
            alert(error.message);
        } finally { 
            this.disabled = false;
        }
    });

})
