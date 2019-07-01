@extends('layouts.frontend')
@section('title')
Client Settings
@endsection
@section('header')
	<section class="content-header">
      <h1>
        Client Settings
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-user-circle"></i>Client Settings</li>
      </ol>
    </section>
@stop
@section('content')
<form action="{{ route('client.settings.update') }}" method="post">
    @csrf
<div class="box box-info">
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <label for="corporate_percentage">Corporate Percentage:</label>
                <input type="text" class="form-control" value="{{ $settings->corporate_percentage }}" name="corporate_percentage">
            </div>
            <div class="col-md-6">
                <label for="individual_percentage">Individual Percentage:</label>
                <input type="text" class="form-control" value="{{ $settings->individual_percentage }}"" name="individual_percentage">
            </div>
        </div>
    </div>
</div>
    <div class="text-center">
        @can('Update Client Settings')
            <button type="submit" class="btn btn-sm btn-success">Update</button>
        @endcan
    </div>
</form>
@stop
