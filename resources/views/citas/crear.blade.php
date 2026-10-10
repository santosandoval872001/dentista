<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar cita | Consultorio Dental</title>
    

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-light">

    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-12 col-md-10 col-lg-8">

                <div class="card border-0 shadow-sm rounded-4">

                    <div class="card-body p-4 p-md-5">

                        <div class="text-center mb-4">

                            <div class="fs-1">
                                <img src="{{ asset('iconos/diente.png') }}" alt="diente">
                            </div>

                            <h1 class="fw-bold">
                                Agenda tu cita
                            </h1>

                            <p class="text-muted">
                                Completa el siguiente formulario
                            </p>

                        </div>

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('cita.guardar') }}" method="POST">
                            @csrf

                            {{--  Nombre  --}}
                            <div class="mb-3">

                                <label for="" class="form-label fw-semibold">
                                    Nombre completo:
                                </label>

                                <input type="text" name="nombre" value="{{ old('nombre') }}"
                                    class="form-control form-control-lg" placeholder="Ej. Juan Perez" required>

                                @error('nombre')
                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{--  Telefono   --}}
                            <div class="mb-3">

                                <label for="" class="form-label fw-semibold">
                                    Télefono / WhatsApp
                                </label>

                                <input type="tel" name="telefono" value="{{ old('telefono') }}"
                                    class="form-control form-control-lg" placeholder="Ej. 3751234567" required>

                                @error('telefono')
                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{--  Correo   --}}
                            <div class="mb-3">

                                <label for="" class="form-label fw-semibold">
                                    Correo electrónico
                                </label>

                                <input type="email" name="email" value="{{ old('email') }}"
                                    class="form-control form-control-lg" placeholder="correo@ejemplo.com">

                            </div>

                            <div class="row">

                                {{--  Fecha   --}}
                                <div class="col-md-6 mb-3">

                                    <label for="" class="form-label fw-semibold">
                                        Fecha
                                    </label>

                                    <input type="date" name="fecha" value="{{ old('fecha') }}"
                                        class="form-control form-control-lg" required>

                                </div>

                                {{--  Hora  --}}

                                <div class="col-md-6 mb-3">

                                    <label for="" class="form-label fw-semibold">
                                        Hora
                                    </label>

                                    <input type="time" name="hora" value="{{ old('hora') }}"
                                        class="form-control form-control-lg" required>

                                </div>

                                @error('fecha')
                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{--  Servicio   --}}

                            <div class="mb-3">

                                <label for="" class="form-label fw-semibold">
                                    Servicio
                                </label>

                                <select name="servicio" id="" class="form-select form-select-lg">

                                    <option value="">
                                        Selecciona un servicio
                                    </option>

                                    <option value="Limpieza dental">
                                        Limpieza dental
                                    </option>

                                    <option value="Blanqueamiento">
                                        Blanqueamiento
                                    </option>

                                    <option value="Resinas">
                                        Resinas
                                    </option>

                                </select>

                            </div>

                            {{--  Comentarios  --}}
                            <div class="mb-4">

                                <label for="" class="form-label fw semibold">
                                    Comentarios
                                </label>

                                <textarea name="comentarios" rows="3" class="form-control"
                                    placeholder="¿Hay algo que quieras comentarle al dentista?">{{ old('comentarios') }}</textarea>

                            </div>

                            <div class="d-grid">

                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-calendar-event-fill"></i>   Solicitar cita
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
