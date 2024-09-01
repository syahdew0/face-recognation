<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Face Absensi</title>
    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="/css/login.css">
</head>

<body>

    <section class="vh-100 gradient-custom">
        <div class="container-fluid h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-light text-dark" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <div class="mb-md-3 mt-md-4 pb-3">
                                <img class="img-fluid mb-5" src="{{ asset('storage/logo/logo.png') }}" alt="bulog"
                                    width="150">
                                @if (session()->has('Error'))
                                    <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                                        {{ session('Error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                <form action="/login" method="POST">
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="name@example.com" required>
                                        <label for="email">Email</label>
                                    </div>
                                    <div class="form-floating mb-4">
                                        <input type="password" class="form-control" name="password" id="password"
                                            placeholder="Password" required>
                                        <label for="password">Password</label>
                                    </div>

                                    <button type="submit" class="btn btn-outline-primary px-5">Login</button>
                                </form>
                            </div>
                            <p class="leads mt-4"><em>Lupa akun? hubungi pihak SDM.</em></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
