@extends('layouts.frontend')
@section('title')
Clients
@endsection
@section('content')
	<div class="container">
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
		<div class="text-center">
			<a href="{{route('create.client')}}">
				<button class="btn btn-success">Add Client</button>
			</a>
		</div>
	</div>
@endsection