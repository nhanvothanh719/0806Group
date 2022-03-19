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
        </div>
        <!-- <div class="col-lg-12">
        @if(Session::has('success_msg'))
        <div class="alert alert-success">{{ Session::get('success_msg') }}</div>
        @endif -->

        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">List Mission By Department : {{ $department->name  }}</h6>
            </div>
            <div class="card-body">
                @include('admin.missions._list')
            </div>
        </div>
    </div>
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
                ajax: '{{ url('/admin/missions/department/'.$department->id.'/dt-row-data') }}',
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
                        data: 'category',
                        name: 'category'
                    },
                    {
                        data: 'department',
                        name: 'department'
                    },
                    {
                        data: 'semester',
                        name: 'semester'
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
@endsection
