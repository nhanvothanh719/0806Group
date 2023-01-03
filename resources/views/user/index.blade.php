@extends('layouts.main')

@section('title', 'Profile User')

@section('content')
    <div class="container-xl">
        <div class="row">
            <div class="col-xl-4">
                @include('user._avatar')
            </div>
            <div class="col-xl-8">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">Account Details</div>
                    <div class="card-body">
                        <form action="{{ route('user.phone.update') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="small mb-1 fw-bold" for="name">Username:</label>
                                <input class="form-control" id="name" type="text" value="{{ $user->name }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1 fw-bold" for="email">Email address:</label>
                                <input class="form-control" id="email" type="email" value="{{ $user->email }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="small mb-1 fw-bold" for="role">Role:</label>
                                <input class="form-control" id="role" type="text" value="{{ $user->role->name }}"
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1 fw-bold" for="new-phone-number">Phone number:</label>
                                <input class="form-control"
                                    class="form-control @error('new-phone-number') is-invalid @enderror"
                                    id="new-phone-number" name="new-phone-number" value="{{ $user->phone_number }}">
                                @if ($errors->has('new-phone-number'))
                                    <span class="text-danger" style="display: block">
                                        @error('new-phone-number')
                                            <p><strong>{{ $message }}</strong></p>
                                        @enderror
                                    </span>
                                @endif
                            </div>
                            <center><button type="submit" class="btn btn-success">Edit my profile</button></center>
                        </form>
                    </div>
                    <!-- @include('user.changeinfo') -->
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>

    <!-- Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>

    <!-- Latest compiled and minified Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
@endsection
