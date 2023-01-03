@extends('layouts.admin')
@section('content')

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Account</title>
    <link href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css')}}">
    <style>
        body {
            background-color: #dee9ff;
        }

        .registration-form {
            padding: 50px 0;
        }

        .registration-form form {
            background-color: #fff;
            max-width: 600px;
            margin: auto;
            padding: 50px 70px;
            border-top-left-radius: 30px;
            border-top-right-radius: 30px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075);
        }

        .registration-form .form-icon {
            text-align: center;
            background-color: #5891ff;
            border-radius: 50%;
            font-size: 40px;
            color: white;
            width: 100px;
            height: 100px;
            margin: auto;
            margin-bottom: 50px;
            line-height: 100px;
        }

        .registration-form .item {
            border-radius: 20px;
            margin-bottom: 25px;
            padding: 10px 20px;
        }

        .registration-form .create-account {
            border-radius: 30px;
            padding: 10px 20px;
            font-size: 18px;
            font-weight: bold;
            background-color: #5791ff;
            border: none;
            color: white;
            margin-top: 20px;
        }

        .registration-form .social-media {
            max-width: 600px;
            background-color: #fff;
            margin: auto;
            padding: 35px 0;
            text-align: center;
            border-bottom-left-radius: 30px;
            border-bottom-right-radius: 30px;
            color: #9fadca;
            border-top: 1px solid #dee9ff;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075);
        }

        .registration-form .social-icons {
            margin-top: 30px;
            margin-bottom: 16px;
        }

        .registration-form .social-icons a {
            font-size: 23px;
            margin: 0 3px;
            color: #5691ff;
            border: 1px solid;
            border-radius: 50%;
            width: 45px;
            display: inline-block;
            height: 45px;
            text-align: center;
            background-color: #fff;
            line-height: 45px;
        }

        .registration-form .social-icons a:hover {
            text-decoration: none;
            opacity: 0.6;
        }

        @media (max-width: 576px) {
            .registration-form form {
                padding: 50px 20px;
            }

            .registration-form .form-icon {
                width: 70px;
                height: 70px;
                font-size: 30px;
                line-height: 70px;
            }
        }
    </style>
</head>

<body>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Welcome to Admin!</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Edit Mission</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        @if (session('danger'))
        <div class="alert alert-danger">
            {{ session('danger') }}
        </div>
        @endif
    </div>

    <div class="container">
        <form action="/admin/mission/update/{{ $mission->id }}" method="post">
            @csrf
            <div class="registration-form">
                <div class="form-icon">
                    <span><i class="icon icon-user"></i></span>
                </div>
                <div class="col-lg-15">
                    <div class="form-group @error('name') is-invalid @enderror">
                        <label for="name">Mission Name:</label>
                        <input type="text" class="form-control item" name="name" id="name" placeholder="Full Name" value="{{$mission-> name}}">
                    </div>
                    @if ($errors->has('name'))
                    <span>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </span>
                    @endif
                </div>
                <div class="col-lg-15">
                    <div class="form-group @error('description') is-invalid @enderror">
                        <label for="description">Description:</label>
                        <input type="text" name="description" class="form-control" id="description" placeholder="" value="{{$mission->description}}">
                        @if ($errors->has('description'))
                        <span>
                            @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-15">
                    <div class="form-group">
                        <label for="end_at">End At:</label>
                        <input type="datetime-local" name="end_at" class="form-control" id="end_at" placeholder="" value="{{ date('Y-m-d\Th:m:s',strtotime($mission->end_at)) }}">
                    </div>
                    @if ($errors->has('end_at'))
                    <span>
                        @error('end_at')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </span>
                    @endif
                </div>
                {{-- <div class="col-lg-15">
                <div class="form-group">
                    <label for="department_id">Department:</label>
                    <select class="form-control" name="department_id" id="department_id">
                        @foreach ($department as $dpm)
                        <option value="{{ $dpm->id }}">{{ $dpm->name }}</option>
                        @endforeach
                    </select>
                </div>
                </div> --}}
                <div class="col-lg-15">
                <div class="form-group">
                    <label for="semester_id">Semester:</label>
                    <input type="text" value="{{$mission->semester->name}} (End at: {{$mission->semester->end_day}})" class="form-control" name="semester_id" id="semester_id" readonly>
                        {{-- @foreach ($semester as $smt)
                        <option value="{{ $smt->id }}">{{ $smt->name }} - Deadline: {{$smt->end_day}}</option>
                        @endforeach --}}
                </div>
            </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-block create-account">Edit Mission</button>
                </div>
            </div>
        </form>
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
</body>

@endsection