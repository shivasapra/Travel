@extends('layouts.frontend')
@section('title')
HRD Department
@endsection
@section('header')
	<section class="content-header">
      <h1>
        HRD Department
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('departments')}}"><i class="fa fa-cube"></i> Departments</a></li>
        <li class="active"><i class="fa fa-user-circle"></i> HRD Department</li>
      </ol>
    </section>
@stop

@section('content')

    <div class="row">
        <div class="col-md-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                <h3>{{App\User::role('HRD Manager')->count()}}</h3>

                <p>{{'HRD Manager'}}</p>
                </div>
                <div class="icon">
                <i class="fa fa-user-circle"></i>
                </div>
                <a href="{{route('display.specific',['slug'=>'HRD Manager'])}}" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-md-6">
            <!-- small box -->
            <div class="small-box bg-blue">
                <div class="inner">
                <h3>{{App\User::role('HRD Executive')->count()}}</h3>

                <p>{{'HRD Executive'}}</p>
                </div>
                <div class="icon">
                <i class="fa fa-user-circle"></i>
                </div>
                <a href="{{route('display.specific',['slug'=>'HRD Executive'])}}" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
@stop