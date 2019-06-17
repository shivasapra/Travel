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
                        <th>Country</th>
                        <th>Postal Code</th>
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
	                    	<tr>
	                    		<td>{{$i++}}</td>
	                    		<td>{{$client->first_name}}</td>
	                    		<td>{{$client->country}}</td>
	                    		<td>{{$client->postal_code}}</td>
	                    		<td>{{$client->phone}}</td>
	                    		<td>{{$client->DOB}}</td>
	                    		<td>{{$client->email}}</td>
	                    		<td>
	                    			<a href="{{route('view.client',['id'=>$client->id])}}" class="btn btn-success btn-xs"><span class="fa fa-eye"></span></a>
	                    			<a href="{{route('edit.client',['id'=>$client->id])}}" class="btn btn-info btn-xs"><span class="fa fa-edit"></span></a>
                                    {{-- <a href="{{route('delete.client',['id'=>$client->id])}}" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a> --}}
                                    @if($client->reminder == 1)
                                    <a href="{{ url('/stop/reminder', ['id'=>$client->id]) }}" class="btn btn-primary btn-xs">Stop Reminders</a>
                                    @else
                                    <a href="{{ url('/start/reminder', ['id'=>$client->id]) }}" class="btn btn-primary btn-xs">Resume Reminders</a>
                                    @endif
	                    		</td>
	                    		</tr>
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
