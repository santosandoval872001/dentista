<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Registrar usuario | Consultorio Dental</title>
    @vite(['resources/js/app.js', 'resources/css/app.csss'])
</head>

<body class="bg-lights">

    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-md-6 col-lg-5">

                <div class="card shadow-sm border-0">

                    <div class="card-body p-4">

                        <div class="text-center mb-4">

                            <h1 class="h3 fw-bold">
                                <img src="{{ asset('iconos/diente.png') }}" alt=""> Consultorio dental
                            </h1>

                            <p class="text-muted">
                                Crear cuenta del dentista
                            </p>

                        </div>

                        <form action="{{ route('register') }}" method="POST">
                            @csrf

                            <div class="mb-3">

                                <label for="name" class="form-label">
                                    Nombre
                                </label>

                                <input id="name" type="text" name="name" value="{{ old('name') }}"
                                    class="form-control @error('name') is-invalid @enderror" required autofocus
                                    autocomplete="name">

                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="mb-3">

                                <label for="email" class="form-label">
                                    Correo electronico
                                </label>

                                <input type="email" name="email" id="email" value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror" required
                                    autocomplete="username">

                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="mb-3">

                                <label for="password" class="form-label">
                                    Contraseña
                                </label>

                                <input type="password" name="password" id="password"
                                    class="form-control @error('password') is-invalid @enderror" required
                                    autocomplete="new-password">

                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="mb-3">

                                <label for="password_confirmation" class="form-label">
                                    Confirmar contraseña
                                </label>

                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control" required autocomplete="new-password">

                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                Crear cuenta
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
