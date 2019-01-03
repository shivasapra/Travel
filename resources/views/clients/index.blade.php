@extends('layouts.frontend')
@section('title')
Clients
@endsection
@section('header')
	<section class="content-header">
      <h1>
        Clients
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-user-circle"></i> clients</li>
      </ol>
    </section>
@stop
@section('content')
	
		<div class="box box-info">
			<div class="box-body">
				
			
			<table class="table table-hover mb-0">
                    <thead>
                      <tr>
                        <th>Sno.</th>
                        <th>Name</th>
                        <th>Postal Code</th>
                        <th>Country</th>
                        <th>Contact</th>
                        <th>DOB</th>
                        <th>Email</th>
                        <th>Action</th>
                      </tr>
                    	</thead>
                    <tbody>
                    	@if($clients->count()>0)
                    	<?php $i = 1; ?>
	                    	@foreach($clients as $client)
	                    		<td>{{$i++}}</td>
	                    		<td>{{$client->first_name}}</td>
	                    		<td>{{$client->postal_code}}</td>
	                    		<td>{{$client->country}}</td>
	                    		<td>{{$client->phone}}</td>
	                    		<td>{{$client->DOB}}</td>
	                    		<td>{{$client->email}}</td>
	                    		<td>
	                    			<a href="{{route('view.client',['id'=>$client->id])}}" class="btn btn-success btn-xs">view</a>
	                    			<a href="{{route('edit.client',['id'=>$client->id])}}" class="btn btn-info btn-xs">edit</a>
	                    			<a href="{{route('delete.client',['id'=>$client->id])}}" class="btn btn-danger btn-xs">Delete</a>
	                    		</td>
	                    	@endforeach
                    	@endif
                    </tbody>
            </table>
		</div>
		</div>
		<div class="text-center">
			<a href="{{route('create.client')}}">
				<button class="btn btn-success">Add Client</button>
			</a>
		</div>
	
@endsection