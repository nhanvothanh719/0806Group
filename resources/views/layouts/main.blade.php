<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>@yield('title')</title>
    <link rel="icon" href="https://cms.greenwich.edu.vn/pluginfile.php/1/theme_adaptable/favicon/1640228920/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CSS only -->
    <link href="{{ asset('/css/styles.css') }}" rel="stylesheet" />
    @yield('custom-css')
    @livewireStyles
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('images/login-logo.png') }}"
                    alt="..." /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                    <li class="nav-item my-3"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item my-3"><a class="nav-link" href="{{ route('about') }}">About</a></li>
                    @if(!auth()->user())
                    <li class="nav-item my-3"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                    @endif
                    @if (auth()->user())
                        <li class="nav-item my-3"><a class="nav-link"
                                href="{{ route('ideas.index') }}">Ideas</a></li>

                        @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager') || auth()->user()->hasRole('coordinator'))
                            <li class="nav-item my-3"><a class="nav-link"
                                    href="{{ route('admin.index') }}">Admin</a></li>
                        @endif
                        <li class="nav-item dropdown my-1">
                            <button class="btn" type="button" id="dropdownMenuButton2"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                                    id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown"
                                    aria-expanded="false">

                                    <img class="img-account-profile rounded-circle mb-2"
                                        src="{{ auth()->user()->avatar == null? asset('/images/avatar.png'): asset('/storage/images/' . Auth::user()->avatar) }}"
                                        alt="{{ asset('public/images/avatar.png') }}"
                                        style="width: 30px; height: 30px; object-fit: cover;" loading="lazy">

                                </a>
                            </button>
                            <ul class="dropdown-menu active" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="{{ route('user.profile') }}">My profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('user.password.change') }}">Change
                                        password</a></li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                            </ul>
                        </li>
                    @endif
                    @if (!auth()->user())
                        <li class="nav-item dropdown my-3"><a href="{{ route('login') }}" class="btn btn-success">Sign in</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        @if (session('class'))
            <div class="alert alert-{{ session('class') }}">
                <button type="button" class="btn close" data-dismiss="alert">&times;</button>
                {{ session('message') }}
            </div>
        @endif
    </div>
    @yield('content')

    <!-- Footer-->
    <footer class="footer py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 text-lg-start">Copyright &copy; TCD04RE 2022</div>
                <div class="col-lg-6 text-lg-end">
                    <a class="link-dark text-decoration-none me-3" href="privacy">Privacy Policy</a>
                    <a class="link-dark text-decoration-none" href="term">Terms of Use</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @yield('custom-js')
    @livewireScripts
</body>

</html>
