@extends('layouts.frontend')
@section('title')
Edit Lead
@endsection
@section('header')
	<section class="content-header">
      <h1>
        Edit Lead
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('leads')}}"><i class="fa fa-user-circle"></i> Leads</a></li>
        <li class="active">Edit Lead</li>
      </ol>
    </section>
@stop
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{route('lead.update',['id'=>$lead->id])}}" method="post">
    @csrf
    <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" name='first_name' value="{{$lead->first_name}}" required class="form-control">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" name='last_name' value="{{$lead->last_name}}" required class="form-control">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                    <label for="address">Street</label>
                    <input type="text" name='address' value="{{$lead->address}}" required class="form-control">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="city">City</label>
                    <input id="city" type="text" name='city' value="{{$lead->city}}" required class="form-control">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                <div class="form-group">
                    <label for="county">County</label>
                    <input id="county" type="text" name='county' value="{{$lead->county}}" required class="form-control">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="postal_code">Postal Code</label>
                    <input id="postal_code" type="text" name='postal_code' value="{{$lead->postal_code}}" required class="form-control" onkeyup="fun()">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                    <label for="country">Country</label>
                    <input id="country" type="text" name='country' value="{{$lead->country}}" required class="form-control">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name='phone' value="{{$lead->phone}}" required class="form-control" maxlength="10">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name='email' value="{{$lead->email}}" required class="form-control">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="DOB">DOB</label>
                    <input type="date" name='DOB' value="{{Carbon\Carbon::parse($lead->DOB)->toDateString()}}"  required class="form-control">
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="text-center">
            @can('Edit Lead')
            <button class="btn btn-success" type="submit">Update Lead</button>
            @endcan
        </div>
    </div>
</form>
@stop
@section('js')
@stop