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
                <h3>{{'44'}}</h3>

                <p>{{'Accounts'}}</p>
                </div>
                <div class="icon">
                <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
@stop