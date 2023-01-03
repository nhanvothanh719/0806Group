@extends('layouts.admin')

@section('custom-css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" /><!-- CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<!-- Default theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
@endsection

@section('content')

<div class="container">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">List Mission</li>
                </ol>
            </div>
        </div>
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
    </div>

    <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">List Mission</h6>
            @if(!auth()->user()->hasRole('manager'))
            <a class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Create Mission
            </a>
            @endif
        </div>
        <div class="card-body">
            @include('admin.missions._list')
        </div>
    </div>
</div>
@if(!auth()->user()->hasRole('manager'))
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create new mission</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.mission.create') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group @error('name') is-invalid @enderror">
                        <label for="name">Mission Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="">
                    </div>
                    @if ($errors->has('name'))
                    <span>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </span>
                    @endif
                </div>
                <div class="modal-body @error('description') is-invalid @enderror">
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <input type="text" name="description" class="form-control" id="description" placeholder="">
                    </div>
                    @if ($errors->has('description'))
                    <span>
                        @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </span>
                    @endif
                </div>
                <div class="modal-body @error('end_at') is-invalid @enderror">    
                    <div class="form-group">
                        <label for="end_at">End At:</label>
                        <input type="datetime-local" name="end_at" class="form-control" id="end_at" placeholder="">
                    </div>
                    @if ($errors->has('end_at'))
                    <span>
                        @error('end_at')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </span>
                    @endif
                </div>
                <div class="modal-body @error('semester') is-invalid @enderror">     
                    <div class="form-group">
                        <label for="semester">Semester:</label>
                        <select class="form-control" name="semester" id="semester">
                            @foreach ($semester as $smt)
                            @if($smt->end_day > now())
                            <option value="{{ $smt->id }}">{{ $smt->name }} - Deadline: {{$smt->end_day}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    @if ($errors->has('semester'))
                    <span>
                        @error('semester')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </span>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">Add Mission</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection

@section('custom-js')
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script>
    $(document).ready(function() {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url('/admin/missions/dt-row-data')}}',
            columns: [{
                    data: 'name',
                    name: 'name',
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'end_at',
                    name: 'end_at'
                },
                {
                    data: 'semester',
                    name: 'semester'
                },
                {
                    data: 'ideas',
                    name: 'ideas'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        });
        $('#users-table_wrapper').removeClass('form-inline');
    });
</script>
<script>
    @if ($errors->has('name')||$errors->has('description')||$errors->has('end_at')
    )
        var delayInMilliseconds = 1000;
        setTimeout(function() {
        $("#exampleModal").modal('show');
        }, delayInMilliseconds);
    @endif
</script>
@endsection