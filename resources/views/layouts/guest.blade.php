<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $page_title ?? '' }} | {{ config('app.name', 'Laravel') }}</title>

        <!-- app favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/logo_sm.png') }}">

        <!-- styles -->
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
        <link href="{{ asset('assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" />

        {{ $style ?? '' }}
    </head>
    <body class="loading" data-layout-config='{"darkMode":false}'>
        <nav class="navbar navbar-expand-lg py-lg-2 navbar-dark bg-dark sticky-top">
            <div class="container">

                <a href="{{ url('/') }}" class="navbar-brand me-lg-5">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="" class="logo-dark" height="18" />
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="mdi mdi-menu"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav me-auto align-items-center">
                        <li class="nav-item mx-lg-1">
                            <a class="nav-link active" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item mx-lg-1">
                            <a class="nav-link" href="{{ url('/faqs') }}">FAQs</a>
                        </li>
                        <li class="nav-item mx-lg-1">
                            <a class="nav-link" href="{{ url('/about-us') }}">About Us</a>
                        </li>
                        <li class="nav-item mx-lg-1">
                            <a class="nav-link" href="{{ url('/contact-us') }}">Contact</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item me-0">
                            @if (Route::has('login'))
                                @auth
                                    @if(Auth::user()->user_type == "ADMIN")
                                        <a href="{{ url('/admin-panel/dashboard') }}" target="_blank" class="nav-link d-lg-none">Dashboard</a>
                                    @elseif(Auth::user()->user_type == "CLIENT")
                                        <a href="{{ url('/client-panel/dashboard') }}" target="_blank" class="nav-link d-lg-none">Dashboard</a>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="nav-link d-lg-none">Log in Or Registration</a>
                                @endauth
                            @endif
                            
                            @if (Route::has('login'))
                                @auth
                                    @if(Auth::user()->user_type == "ADMIN")
                                        <a href="{{ url('/admin-panel/dashboard') }}" target="_blank" class="btn btn-sm btn-light rounded-pill d-none d-lg-inline-flex">
                                            <i class="mdi mdi-login me-2"></i> Dashboard 
                                        </a>
                                    @elseif(Auth::user()->user_type == "CLIENT")
                                        <a href="{{ url('/client-panel/dashboard') }}" target="_blank" class="btn btn-sm btn-light rounded-pill d-none d-lg-inline-flex">
                                            <i class="mdi mdi-login me-2"></i> Dashboard 
                                        </a>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" target="_blank" class="btn btn-sm btn-light rounded-pill d-none d-lg-inline-flex">
                                        <i class="mdi mdi-login me-2"></i> Log in Or Registration
                                    </a>
                                @endauth
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- ------------------------------------------------------- -->
        {{ $slot }}
        <!-- ------------------------------------------------------- -->

        <footer class="bg-dark pt-3 pb-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <img src="assets/images/logo.png" alt="" class="logo-dark" height="18" />
                        <p class="text-muted mt-4">Hyper makes it easier to build better websites with
                            <br> great speed. Save hundreds of hours of design
                            <br> and development by using it.</p>

                        <ul class="social-list list-inline mt-3">
                            <li class="list-inline-item text-center">
                                <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                            </li>
                            <li class="list-inline-item text-center">
                                <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                            </li>
                            <li class="list-inline-item text-center">
                                <a href="javascript: void(0);" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                            </li>
                            <li class="list-inline-item text-center">
                                <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github"></i></a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-2 mt-3 mt-lg-0">
                        <h5 class="text-light">Company</h5>

                        <ul class="list-unstyled ps-0 mb-0 mt-3">
                            <li class="mt-2"><a href="javascript: void(0);" class="text-muted">About Us</a></li>
                            <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Documentation</a></li>
                            <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Blog</a></li>
                            <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Affiliate Program</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-2 mt-3 mt-lg-0">
                        <h5 class="text-light">Apps</h5>

                        <ul class="list-unstyled ps-0 mb-0 mt-3">
                            <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Ecommerce Pages</a></li>
                            <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Email</a></li>
                            <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Social Feed</a></li>
                            <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Projects</a></li>
                            <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Tasks Management</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-2 mt-3 mt-lg-0">
                        <h5 class="text-light">Discover</h5>

                        <ul class="list-unstyled ps-0 mb-0 mt-3">
                            <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Help Center</a></li>
                            <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Our Products</a></li>
                            <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Privacy</a></li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="mt-5">
                            <p class="text-muted mt-2 text-center mb-0"><script>document.write(new Date().getFullYear())</script> © EUB - eub.bd.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- scripts -->
        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
        <script src="{{ asset('assets/js/app.min.js') }}"></script>

        {{ $script ?? '' }}
    </body>
</html>
