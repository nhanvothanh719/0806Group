@extends('layouts.main')

@section('title', 'Change password')

@section('content')
<div class="container-xl">
    <div class="row">
        <div class="col-xl-4">
            @include('user._avatar')
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Change password</div>
                <div class="card-body">
                    <form action="{{ route('user.password.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="small mb-1 fw-bold" for="old-password">Old password:</label>
                            <input class="form-control @error('old-password') is-invalid @enderror" id="old-password" name="old-password" type="password" placeholder="Enter old password">
                            @error('old-password')
                            <span class="invalid-feedback d-flex justify-content-left" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1 fw-bold" for="new-password">New password:</label>
                            <input class="form-control @error('new-password') is-invalid @enderror" id="new-password" name="new-password" type="password" placeholder="Enter new password">
                            @error('new-password')
                            <span class="invalid-feedback d-flex justify-content-left" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1 fw-bold" for="new-password_confirmation">Confirm new password:</label>
                            <input class="form-control @error('new-password_confirmation') is-invalid @enderror" id="new-password_confirmation" name="new-password_confirmation" type="password" placeholder="Enter new password again">
                            @error('new-password_confirmation')
                            <span class="invalid-feedback d-flex justify-content-left" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <!-- Save changes button-->
                        <center><button class="btn btn-success d-grid" type="submit">Save new password</button></center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('custom-js')
<!-- jQuery library -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>

<!-- Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>

<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
@endsection