@extends('layouts.frontend')
@section('title')
Departments
@endsection
@section('header')
	<section class="content-header">
      <h1>
        Departments
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-user-circle"></i> Departments</li>
      </ol>
    </section>
@stop
@section('content')
    <div class="row">
        <div class="col-md-3">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                <h3>{{App\User::role('Account Manager')->count() + App\User::role('Account Executive')->count()}}</h3>

                <p>{{'Accounts'}}</p>
                </div>
                <div class="icon">
                <i class="fa fa-male"></i>
                </div>
                <a href="{{route('accounts')}}" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-md-3">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                <h3>{{App\User::role('Marketing/Sales Manager')->count() + App\User::role('Marketing/Sales Executive')->count()}}</h3>

                <p>{{'Marketing/Sales'}}</p>
                </div>
                <div class="icon">
                <i class="fa fa-user-circle"></i>
                </div>
                <a href="{{route('marketing')}}" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-md-3">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                <h3>{{App\User::role('HRD Manager')->count() + App\User::role('HRD Executive')->count()}}</h3>

                <p>{{'HRD'}}</p>
                </div>
                <div class="icon">
                <i class="fa fa-user-o"></i>
                </div>
                <a href="{{route('hrd')}}" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-md-3">
            <!-- small box -->
            <div class="small-box bg-blue">
                <div class="inner">
                <h3>{{App\User::role('Operations Manager')->count() + App\User::role('Operations Executive')->count()}}</h3>

                <p>{{'Operations'}}</p>
                </div>
                <div class="icon">
                <i class="fa fa-users"></i>
                </div>
                <a href="{{route('operations')}}" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
@stop