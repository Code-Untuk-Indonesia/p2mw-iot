<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('template-admin/assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('template-admin/assets/img/favicon.png') }}">
    <title>P2MW Login</title>
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('template-admin/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('template-admin/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('template-admin/assets/css/soft-ui-dashboard.css?v=1.0.7') }}"
        rel="stylesheet" />
    <style>
        .page-header {
            padding-top: 2rem;
            padding-bottom: 2rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .form-control {
            margin-bottom: 1rem;
        }

        .btn {
            margin-top: 1rem;
            margin-bottom: 1rem;
        }
    </style>

</head>

<body class="">
    <main class="main-content">
        <section class="min-vh-100">
            <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
                style="background-image: url('{{ asset('template-admin/assets/img/curved-images/curved14.jpg') }}');">
                <span class="mask bg-gradient-dark opacity-6"></span>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 text-center mx-auto">
                            <h1 class="text-white mb-2 mt-5">Welcome!</h1>
                            <p class="text-lead text-white">Use these awesome forms to login or create new account in
                                your project for free.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row mt-lg-n10 mt-md-n11 mt-n10">
                    <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                        <div class="card z-index-0">
                            <div class="card-body">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <label>Email</label>
                                    <div class="mb-3">
                                        <input type="email" name="email" class="form-control" placeholder="Email"
                                            aria-label="Email" aria-describedby="email-addon">
                                    </div>
                                    <label>Password</label>
                                    <div class="mb-3">
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Password" aria-label="Password"
                                            aria-describedby="password-addon">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign
                                            in</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Core JS Files -->
    <script src="{{ asset('template-admin/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('template-admin/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('template-admin/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('template-admin/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('template-admin/assets/js/soft-ui-dashboard.min.js?v=1.0.7') }}"></script>
</body>

</html>
