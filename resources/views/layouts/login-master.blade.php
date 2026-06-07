<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title>CPN - Connexion</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

		<!-- App css -->
		<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
		<link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

		<link href="{{ asset('assets/css/bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" disabled />
		<link href="{{ asset('assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="app-dark-stylesheet"  disabled />

		<!-- icons -->
		<link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

        <style type="text/css">
            .auth-fluid {
                background: url({{ asset('assets/images/bg-auth.jpg') }}) center center no-repeat fixed;
                -webkit-background-size:cover;
                -moz-background-size:cover;
                -o-background-size:cover;
                background-size:cover;
                width:100%
            }

        </style>

    </head>

    <body class="auth-fluid-pages pb-0">
        <input type="hidden" name="login-page" value="disconnect-user">

        <div class="auth-fluid">
            <!--Auth fluid left content -->
            <div class="auth-fluid-form-box">
                <div class="align-items-center d-flex h-100">
                    <div class="card-body">

                        <!-- Logo -->
                        <div class="auth-brand text-center text-lg-left mb-0">
                            <div class="auth-logo">
                                <a href="/" class="logo logo-dark text-center">
                                    <span class="logo-lg">
                                        <img src="{{ asset('assets/images/apag.png') }}" alt="" height="100">
                                    </span>
                                </a>

                                <a href="index.html" class="logo logo-light text-center">
                                    <span class="logo-lg">
                                        <img src="{{ asset('assets/images/logo.png') }}" alt="" height="75">
                                    </span>
                                </a>
                            </div>
                        </div>

                        <!-- title-->
                        <h4 class="mt-0">{{ __('Connexion') }}</h4>
                        <p class="text-muted mb-2">
                            {{ __("Entrez votre adresse e-mail et votre mot de passe pour accéder au compte.") }}
                        </p>
                        @include('layouts.message')
                        <!-- form -->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="emailaddress">{{ __('Email') }}</label>
                                <input class="form-control" type="text" name="email" value="{{ old('email') }}">
                            </div>
                            <div class="form-group">
                                <label>{{ __('Mot de passe') }}</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" class="form-control" name="password" >
                                    <div class="input-group-append" data-password="false">
                                        <div class="input-group-text">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input name="remember" type="checkbox" class="custom-control-input" id="checkbox-signin">
                                    <label class="custom-control-label" for="checkbox-signin">{{ __('Se souvenir de moi') }}</label>
                                </div>
                            </div>
                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary btn-block" type="submit">{{ __("S'identifier") }} </button>
                            </div>
                            <!-- social-->
                            <div class="text-center mt-4">
                                <p class="text-muted font-16"></p>
                                <ul class="social-list list-inline mt-3">

                                </ul>
                            </div>
                        </form>
                        <!-- end form-->

                        <!-- Accès démo -->
                        <div class="mt-3 p-3 rounded" style="background:#f1f3fa;border:1px solid #dee2e6;">
                            <p class="mb-1 font-weight-bold text-dark" style="font-size:13px;">
                                <i class="mdi mdi-account-key mr-1"></i>Accès démo
                            </p>
                            <p class="mb-1 text-muted" style="font-size:12px;">
                                <strong>Email :</strong> admin@cpn.com<br>
                                <strong>Mot de passe :</strong> demo1234
                            </p>
                        </div>

                        <!-- Footer-->
                        <footer class="footer footer-alt">

                        </footer>

                    </div> <!-- end .card-body -->
                </div> <!-- end .align-items-center.d-flex.h-100-->
            </div>
            <!-- end auth-fluid-form-box-->

            <!-- Auth fluid right content -->
            <div class="auth-fluid-right text-center">
                <div class="auth-user-testimonial">
                    <h2 class="mb-3 text-white">{{ __("Application de gestion des consultations prénatales") }}</h2>
                    {{-- <p class="lead">
                        <i class="mdi mdi-format-quote-open"></i>{{ __('Bembeya Group') }}<i class="mdi mdi-format-quote-close"></i>
                    </p> --}}
                    <h5 class="text-white">
                        {{ __('Dévelopée par Fatoumata Thioro BAH et Hadja Sory Binta BAH') }}
                    </h5>
                </div> <!-- end auth-user-testimonial-->
            </div>
            <!-- end Auth fluid right content -->
        </div>
        <!-- end auth-fluid-->

        <!-- Vendor js -->
        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('assets/js/app.min.js') }}"></script>

    </body>
</html>
