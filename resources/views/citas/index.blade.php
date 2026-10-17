<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panel de citas | Consultorio Dental</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-light">

    <div class="container py-5">

        {{--  Encabezado  --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div class="">

                <div class="fw-bold mb-1">
                    <img src="{{ asset('iconos/diente.png') }}" alt=""> Panel de citas
                </div>

                <p class="text-muted mb-0">
                    Administración de citas de pacientes
                </p>

            </div>

            <a href="{{ route('cita.crear') }}" class="btn btn-primary">
                + Nueva cita
            </a>

        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}

                <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

            <div class="">

                <h2 class="mb-1">
                    Panel del dentista
                </h2>
                <p class="text-secondary mb-0">
                    Bienvenido, Dr. {{ Auth::user()->name }}
                </p>

            </div>

            <a href="{{ route('admin.calendario') }}" class="btn btn-primary">
                <i class="bi bi-calendar-week me-1"></i>
                ver calendario
            </a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit" class="btn btn-outline-danger">
                    <i class="bi bi-box-arrow-right me-1"></i>
                    Cerrar sesión
                </button>

            </form>

        </div>

        {{--  Citas  --}}
        <div class="card border-0 shadow-sm rounded-4">

            <div class="card-body p-0">

                @if ($citas->count() > 0)
                    <div class="table-responsive">

                        <table class="table table-hover align-middle mb-0">

                            <thead class="table-light">

                                <tr>

                                    <td class="px-4">
                                        Pacientes
                                    </td>

                                    <td>
                                        Servicio
                                    </td>

                                    <td>
                                        Fecha
                                    </td>

                                    <td>
                                        Hora
                                    </td>

                                    <td>
                                        Estado
                                    </td>

                                    <td>
                                        Acciones
                                    </td>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach ($citas as $cita)
                                    <tr>

                                        <td class="px-4">

                                            <div class="fw-semibold">
                                                {{ $cita->nombre }}
                                            </div>

                                            <small class="text-muted">
                                                {{ $cita->telefono }}
                                            </small>

                                        </td>

                                        <td>
                                            {{ $cita->servicio }}
                                        </td>

                                        <td>
                                            {{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}
                                        </td>

                                        <td>
                                            {{ \Carbon\Carbon::parse($cita->hora)->format('h:i A') }}
                                        </td>

                                        <td>

                                            @if ($cita->estado === 'pendiente')
                                                <span class="badge text-bg-warning">
                                                    Pendiente
                                                </span>
                                            @elseif($cita->estado === 'confirmado')
                                                <span class="badge text-bg-success">
                                                    Confirmado
                                                </span>
                                            @elseif($cita->estado === 'cancelado')
                                                <span class="badge text-bg-danger">
                                                    Cancelado
                                                </span>
                                            @elseif($cita->estado === 'atendida')
                                                <span class="badge text-bg-primary">
                                                    Atendida
                                                </span>
                                            @endif

                                        </td>

                                        <td>
                                            @if ($cita->estado === 'pendiente')
                                                <div class="d-flex gap-2 flex-wrap">

                                                    <form action="{{ route('admin.citas.confirmar', $cita) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PATCH')

                                                        <button type="submit" class="btn btn-sm btn-outline-success">
                                                            <img src="{{ asset('iconos/verificacion.png') }}"
                                                                alt=""> Confirmar
                                                        </button>
                                                    </form>

                                                    <form action="{{ route('admin.citas.cancelar', $cita) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PATCH')

                                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                                            <img src="{{ asset('iconos/cerrar.png') }}" alt="">
                                                            Cancelar
                                                        </button>
                                                    </form>

                                                </div>
                                            @elseif($cita->estado === 'confirmado')
                                                <div class="d-flex gap-2 flex-wrap">

                                                    <span class="badge text-bg-success align-self-center">
                                                        <img src="{{ asset('iconos/verificacion.png') }}"
                                                            alt=""> Confirmado
                                                    </span>

                                                    <a href="{{ route('admin.citas.whatsapp', $cita) }}"
                                                        class="btn btn-sm btn-outline-success">
                                                        <img src="{{ asset('iconos/whatsapp.png') }}" alt="">
                                                        WhatsApp
                                                    </a>

                                                    <form action="{{ route('admin.citas.atender', $cita) }}"
                                                        class="d-line" method="POST">
                                                        @csrf
                                                        @method('PATCH')

                                                        <button type="submit" class="btn btn-sm btn-primary">
                                                            <img src="{{ asset('iconos/diente.png') }}" alt="">
                                                            Atendida
                                                        </button>

                                                    </form>

                                                    <form action="{{ route('admin.citas.cancelar', $cita) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PATCH')

                                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                                            <img src="{{ asset('iconos/cerrar.png') }}" alt="">
                                                            Cancelar
                                                        </button>
                                                    </form>

                                                </div>
                                            @elseif($cita->estado === 'cancelado')
                                                <span class="badge text-bg-danger">
                                                    <img src="{{ asset('iconos/cerrar.png') }}" alt="">
                                                    Cancelado
                                                </span>
                                            @elseif($cita->estado === 'atendida')
                                                <span class="badge text-bg-primary">
                                                    <img src="{{ asset('iconos/diente.png') }}" alt="">
                                                    Atendida
                                                </span>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>

                        </table>

                    </div>
                @else
                    <div class="text-center py-5">

                        <div class="fs-1 mb-3">
                            <img src="{{ asset('iconos/calendario.png') }}" alt="calendario">
                        </div>

                        <h4>
                            No hay citas
                        </h4>

                        <p class="text-muted">
                            Las citas solicitadas por los pacientes aparecerán aquí.
                        </p>

                    </div>

                @endif

            </div>

        </div>

    </div>

</body>

</html>
