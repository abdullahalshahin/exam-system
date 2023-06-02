<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Registration | {{ config('app.name', 'Laravel') }}</title>

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/logo_sm.png') }}">

        <!-- Styles -->
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
        <link href="{{ asset('assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" />
    </head>
    <body  class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-8 col-lg-5">
                        <div class="card">
                            <div class="card-header pt-4 pb-4 text-center bg-primary">
                                <a href="index.html">
                                    <span><img src="{{ asset('assets/images/logo.png')}}" alt="" height="18"></span>
                                </a>
                            </div>

                            <div class="card-body p-4">
                                <div class="text-center w-75 m-auto">
                                    <h4 class="text-dark-50 text-center pb-0 fw-bold">Sign Up</h4>
                                    <p class="text-muted mb-1">Don't have an account? Create your account, it takes less than a minute.</p>
                                </div>

                                <!-- Validation Errors -->
                                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        
                                <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row g-2">
                                        <div class="mb-2 col-md-12">
                                            <label for="name">Full Name</label>
                                            <input class="form-control" type="text" id="name" placeholder="Enter your name" name="name" value="{{ old('name') }}" required autofocus>
                                        </div>
                                    </div>

                                    <div class="row g-2">
                                        <div class="mb-2 col-md-6">
                                            <label for="mobile_number">Contact Number</label>
                                            <input class="form-control" type="text" id="mobile_number" placeholder="Enter your contact number" name="mobile_number" value="{{ old('mobile_number') }}" required autofocus>
                                        </div>

                                        <div class="mb-2 col-md-6">
                                            <label for="email">Email address</label>
                                            <input class="form-control" type="email" id="email" placeholder="Enter your email" name="email" value="{{ old('email') }}" required>
                                        </div>
                                    </div>

                                    <div class="row g-2">
                                        <div class="mb-2 col-md-6">
                                            <label for="password">Password</label>
                                            <div class="input-group input-group-merge">
                                                <input type="password" id="password" class="form-control" placeholder="Enter your password" type="password" name="password" required autocomplete="new-password" >

                                                <div class="input-group-text" data-password="false">
                                                    <span class="password-eye"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-2 col-md-6">
                                            <label for="password_confirmation">Confirm Password</label>
                                            <div class="input-group input-group-merge">
                                                <input type="password" id="password_confirmation" class="form-control" placeholder="Enter your password" type="password" name="password_confirmation" required >
                                                <div class="input-group-text" data-password="false">
                                                    <span class="password-eye"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-2">
                                        <div class="mb-2 col-md-6">
                                            <label for="gender">Gender</label>
                                            <select id="gender" name="gender" class="form-select" required>
                                                <option value="" selected disabled>Choose</option>
                                                <option value="Male" {{ old('gender') == 'Male' ? "selected" : "" }}>Male</option>
                                                <option value="Female" {{ old('gender') == 'Female' ? "selected" : "" }}>Female</option>
                                                <option value="Others" {{ old('gender') == 'Others' ? "selected" : "" }}>Others</option>
                                            </select>
                                        </div>

                                        <div class="mb-2 col-md-6">
                                            <label for="profile_image">Profile Image</label>
                                            <input type="file" name="profile_image" id="profile_image" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row g-2">
                                        <div class="mb-2 col-md-12">
                                            <label for="address">Address</label>
                                            <input type="text" name="address" value="{{ old('address') }}" class="form-control" id="address" placeholder="Village, Upazila, Thana, Division" required>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="accept" id="checkbox-signup" required>
                                            <label class="form-check-label" for="checkbox-signup">I accept <a href="#" class="text-muted">Terms and Conditions</a></label>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button class="btn btn-primary" type="submit"> Sign Up </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-muted">Already have account? <a href="{{ route('login') }}" class="text-muted ms-1"><b>Log In</b></a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer footer-alt">
            <script>document.write(new Date().getFullYear())</script> © EUB - eub.bd.com
        </footer>

        <script src="{{ asset('assets/js/vendor.min.js')}}"></script>
        <script src="{{ asset('assets/js/app.min.js')}}"></script>
    </body>
</html>
