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
                    <li class="breadcrumb-item active">List Ideas</li>
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
            <h6 class="m-0 font-weight-bold text-primary">List Ideas</h6>
        </div>
    <div class="card-body">
            <table id="users-table" class="table table-responsive" style="width:100%">
                <thead class="thread-light">
                    <tr class="col">
                        <th class="col-1">Title</th>
                        <th class="col-1">Content</th>
                        <th class="col-1">User</th>
                        <th class="col-1">Like</th>
                        <th class="col-1">DisLike</th>
                        <th class="col-1">View</th>
                        <th class="col-1">Comments</th>
                        <th class="col-1">Mission</th>
                    </tr>
                </thead>
            </table>
        </div>

@endsection
@section('custom-js')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.colVis.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script>
    $(document).ready(function() {
       $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url('/admin/ideas/dt-row-data')}}',
            columns: [{
                    data: 'title',  
                },
                {
                    data: 'content',
                },
                {
                    data: 'user',
                },
                {
                    data: 'like',
                },
                {
                    data: 'dislike',
                },
                {
                    data: 'view_count',

                },
                {
                    data: 'comments',
                },
                {
                    data: 'mission',
                }
            ]
        });
        $('#users-table_wrapper').removeClass('form-inline');
    });
</script>

@endsection

