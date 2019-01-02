@extends('layouts.frontend')
@section('title')
Airlines
@stop
@section('content')
	<div class="box">
		<div class="box-body">
			<div class="container">
			<div class="row">
				<form action="{{route('airline.add')}}" method="post">
				@csrf
				<div class="col-md-8">
				<div class="form-group">
					<input type="text" name="name" class="form-control" placeholder="service name">
				</div>
				</div>
				<div class="col-md-2">
					
						<button class="btn btn-xs btn-success" type="submit">Add</button>
					
				</div>
			</form>
			</div>
			<table class="table table-hover">
				<thead>
					<th>Sno.</th>
					<th>Name</th>
					<th>Action</th>
				</thead>
				<tbody>
					@if($airlines->count()>0)
					<?php $i = 1; ?>
					@foreach($airlines as $airline)
					<tr>
						<td>{{$i++}}</td>
						<td>{{$airline->name}}</td>
						<td>
							<a href="{{route('airline.delete',['id'=>$airline->id])}}">
								<button class="btn btn-xs btn-danger">Delete</button>
							</a>
						</td>
					</tr>
					@endforeach
					@endif
				</tbody>
			</table>
			</div>
		</div>
	</div>
@stop