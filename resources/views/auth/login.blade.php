@extends('layouts.app')

@section('title', 'Login')

@section('custom-css')
    <style>
        .bg-image-vertical {
            position: relative;
            overflow: hidden;
            background-repeat: no-repeat;
            background-position: right center;
            background-size: auto 100%;
        }

        @media (min-width: 1025px) {
            .h-custom-2 {
                height: 100%;
            }
        }

    </style>
@endsection

@section('content')
    <section class="vh-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 d-md-none d-lg-block">
                    <a href="{{ route('home') }}"><img src="{{ asset('/images/login-background.png') }}"
                            alt="Login background" class="w-100 vh-100"
                            style="object-fit: cover; object-position: left;"></a>
                </div>
                <div class="col-sm-12 col-lg-4 text-black">
                    <div class="container">
                        <div class="text-center">
                            <i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4" style="color: #709085;"></i>
                            <img class="logo" src="{{ asset('/images/login-logo.png') }}" alt="login logo"
                                style="margin: auto; height: 100px;margin-top: 150px">
                        </div>

                        <div class="align-items-center">

                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <h3 class="fw-normal mb-3 pb-3 text-center" style="letter-spacing: 1px;">LOGIN</h3>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form2Example18">Email address</label>
                                    <input type="email" id="form2Example18" name="email"
                                        class="form-control form-control-lg" value="{{ old('email') }}" />
                                    @error('email')
                                        <span class="invalid-feedback" role="alert" style="display: block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form2Example28">Password</label>
                                    <input type="password" id="form2Example28" name="password"
                                        class="form-control form-control-lg" value="{{ old('password') }}" />
                                    @error('password')
                                        <span class="invalid-feedback" role="alert" style="display: block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <div class="pt-1 mb-4">
                                    <button class="btn btn-primary btn-lg btn-block" style="width: 100%"
                                        type="submit">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
