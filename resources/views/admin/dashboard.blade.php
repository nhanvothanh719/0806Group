@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<head>
    <title>Dashboard</title>
</head>    
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard Admin</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Home</a></li>
              <li class="breadcrumb-item active">Dashboard </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{$semester}}<sup style="font-size: 20px"></sup></h3>

                <p>Total Semester</p>
              </div>
              <div class="icon">
              <i class="fa fa-light fa-anchor"></i>
              </div>
              <a href="{{ route('admin.semester.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$department}}<sup style="font-size: 20px"></sup></h3>
                  
                <p>Total Department</p>
              </div>
              <div class="icon">
              <i class="fa fa-solid fa-building"></i>
              </div>
              <a href="{{ route('admin.department.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$account}}</h3>

                <p>Total User Account</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{route('admin.account.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$mission}}</h3>

                <p>Total Missions</p>
              </div>
              <div class="icon">
              <i class="fa fa-light fa-bars-progress"></i>              
            </div>
              <a href="{{route('admin.missions.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        </div>
       
      </section>
          
@endsection