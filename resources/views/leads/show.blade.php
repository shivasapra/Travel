@extends('layouts.frontend')
@section('title')
Lead 
@endsection
@section('header')
	<section class="content-header">
      <h1>
        Lead
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('leads')}}"><i class="fa fa-user-circle"></i> Leads</a></li>
        <li class="active">Lead</li>
      </ol>
    </section>
@stop
@section('content')
<div class="box box-info">
	<div class="box-body">
        <table class="table table-hover mb-0">
            <tbody>
                <div class="row">
                    <tr>
                        <td><strong>First Name:</strong></td>
                        <td>{{$lead->first_name}}</td>
                    </tr>
                </div>
                <div class="row">
                    <tr>
                        <td><strong>last Name:</strong></td>
                        <td>{{$lead->last_name}}</td>
                    </tr>
                </div>
                <div class="row">
                    <tr>
                        <td><strong>Street:</strong></td>
                        <td>{{$lead->address}}</td>
                    </tr>
                </div>
                <div class="row">
                    <tr>
                        <td><strong>City:</strong></td>
                        <td>{{$lead->city}}</td>
                    </tr>
                </div>
                <div class="row">
                    <tr>
                        <td><strong>County:</strong></td>
                        <td>{{$lead->county}}</td>
                    </tr>
                </div>
                <div class="row">
                    <tr>
                        <td><strong>Postal Code:</strong></td>
                        <td>{{$lead->postal_code}}</td>
                    </tr>
                </div>
                <div class="row">
                    <tr>
                        <td><strong>Country:</strong></td>
                        <td>{{$lead->country}}</td>
                    </tr>
                </div>
                <div class="row">
                    <tr>
                        <td><strong>Phone:</strong></td>
                        <td>{{$lead->phone}}</td>
                    </tr>
                </div>
                <div class="row">
                    <tr>
                        <td><strong>Email:</strong></td>
                        <td>{{$lead->email}}</td>
                    </tr>
                </div>
                <div class="row">
                    <tr>
                        <td><strong>DOB:</strong></td>
                        <td>{{$lead->DOB}}</td>
                    </tr>
                </div>
            </tbody>
        </table>	
    </div>
</div>
@stop
@section('js')
@stop