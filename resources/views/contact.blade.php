@extends('layouts.main')

@section('content')
<div class="container d-flex justify-content-center text-center">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Contact Us</h5>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('contact') }}">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-12" style="padding: 10px;">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" name="name">
                        @error('name')
                        <span class="invalid-feedback d-flex justify-content-left" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-12" style="padding: 10px;">
                        <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email">
                        @error('email')
                        <span class="invalid-feedback d-flex justify-content-left" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-12" style="padding: 10px;">
                        <input type="text" class="form-control @error('phone_number') is-invalid @enderror" placeholder="Phone Number" name="phone_number">
                        @error('phone_number')
                        <span class="invalid-feedback d-flex justify-content-left" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-12" style="padding: 10px;">
                        <input type="text" class="form-control @error('subject') is-invalid @enderror" placeholder="Subject" name="subject">
                        @error('subject')
                        <span class="invalid-feedback d-flex justify-content-left" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-12" style="padding: 10px;">
                        <textarea rows="6" class="form-control @error('user_message') is-invalid @enderror" placeholder="Please send us a message..." name="user_message"></textarea>
                        @error('user_message')
                        <span class="invalid-feedback d-flex justify-content-left" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="update ml-auto mr-auto" style="padding: 10px;">
                        <button type="submit" class="btn btn-success btn-round">Submit</button>
                    </div>
                </div>
            </form>
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