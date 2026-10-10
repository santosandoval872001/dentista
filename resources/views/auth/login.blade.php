<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iniciar sesión | Consultorio Dental</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="bg-light">

    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-md-5 col-lg-4">

                <div class="card shadow-sm border-0">

                    <div class="card-body p-4">

                        <div class="text-center mb-4">

                            <h1 class="fw-bold">
                                <img src="{{ asset('iconos/diente.png') }}" alt=""> Consultorio Dental
                            </h1>

                            <p class="text-muted">
                                Acesso para el dentista
                            </p>

                        </div>

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('login') }}" method="POST">
                            @csrf

                            <div class="mb-3">

                                <label for="email" class="form-label">
                                    Correo electrónico:
                                </label>

                                <input type="email" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" required autofocus autocomplete="username">

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
                                    autocomplete="current-password">

                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="form-check mb-3">

                                <input type="checkbox" name="remember_me" id="remember" class="form-check-input">

                                <label for="remember_me" class="form-check-label">
                                    Recordarme
                                </label>

                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                Iniciar sesión
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
