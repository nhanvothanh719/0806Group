@extends('layouts.admin')
@section('content')
<html lang="en">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<head>
    <style>
        body {
            background: #f4f6f9;
        }

        .contact-form {
            background: #fff;
            margin-top: 10%;
            margin-bottom: 5%;
            width: 70%;
        }

        .contact-form .form-control {
            border-radius: 1rem;
        }

        .contact-image {
            text-align: center;
        }

        .contact-image img {
            border-radius: 6rem;
            width: 11%;
            margin-top: -3%;
            transform: rotate(29deg);
        }

        .contact-form form {
            padding: 14%;
        }

        .contact-form form .row {
            margin-bottom: -7%;
        }

        .contact-form h3 {
            margin-bottom: 8%;
            margin-top: -10%;
            text-align: center;
            color: #0062cc;
        }

        .contact-form .btnContact {
            width: 50%;
            border: none;
            border-radius: 1rem;
            padding: 1.5%;
            background: green;
            font-weight: 600;
            color: #fff;
            cursor: pointer;
        }

        .btnContactSubmit {
            width: 50%;
            border-radius: 1rem;
            padding: 1.5%;
            color: #fff;
            background-color: #0062cc;
            border: none;
            cursor: pointer;
        }

        .form-control {
            width: 130%
        }
    </style>
</head>

<body>
    <!-- content header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Welcome to Admin!</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.semester.index') }}">Semester</a></li>
                        <li class="breadcrumb-item active">Update Semester</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="container contact-form">
        <div class="contact-image">
            <img src="https://image.ibb.co/kUagtU/rocket_contact.png" alt="space" />
        </div>
        <form action="/admin/semester/update/{{ $itemSemester->id }}" method="post">
            @csrf
            <h3>Edit Semester</h3>
            <div class="row">
                <div class="col-lg-10">
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Name Category" class="form-control" value="{{ $itemSemester->name }}">
                    </div>
                    <div class="form-group">
                        <input type="datetime-local" name="end_day" placeholder="Day End" class="form-control" value="{{ $itemSemester->end_day }}">
                    </div>
                    <div class="center">
                        <button type="submit" name="btnSubmit" class="btn btn-outline-primary rounded-pill" data-mdb-ripple-color="dark">Update Semester</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
@endsection