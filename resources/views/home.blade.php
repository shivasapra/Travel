@extends('layouts.frontend')
@section('title')
Dashboard
@endsection
@section('header')
    <section class="content-header">
          <h1>
            Dashboard
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
    </section>
@stop
@section('content')

    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-android-person"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><strong>Employees</strong></span>
              <span class="info-box-number">{{$employees->count()}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><strong>Clients</strong></span>
              <span class="info-box-number">{{$clients->count()}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-money"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><strong>Expenses</strong></span>
              <span class="info-box-number">{{$expense}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
  @if(Auth::user()->admin)
      <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title"><strong>EMPLOYEES</strong></h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <ul class="users-list clearfix">
                    @foreach($employees as $employee)
                    <li>
                      <img src="{{asset("dist/img/avatar5.png")}}" style="height: 100px" alt="User Image">
                      <a class="users-list-name" href="{{route('view.employee',['id'=>$employee->id])}}">{{$employee->first_name}}</a>
                      <span class="users-list-date">
                        @if($employee->wage->count()>0)
                        {{$employee->wage->last()->date}}
                        @else
                        {{"N/A"}}
                        @endif
                      </span>
                    </li>
                    @endforeach
                  </ul>
                  <!-- /.users-list -->
                </div>
  @endif
      <!-- /.row -->
{{-- <div class="container">
    <div class="row justify-content-center">
        

    <div class="col-lg-6">
        <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
            <div class="card-header text-center">Total Employees</div>
            <div class="card-body bg-light text-dark">
                <h3 class="card-title text-center">{{$employees->count()}}</h3>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
            <div class="card-header text-center">Total Clients</div>
            <div class="card-body bg-light text-dark">
                <h3 class="card-title text-center">{{$clients->count()}}</h3>
            </div>
        </div>
    </div>
    </div>
</div> --}}
@endsection
