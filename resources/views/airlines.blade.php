@extends('layouts.frontend')
@section('title')
Airlines
@stop
@section('header')
	<section class="content-header">
      <h1>
        Airlines
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-plane"></i> Airlines</li>
      </ol>
    </section>
@stop
@section('content')
	<div class="row">
	<div class="col-md-6">
	<div class="box box-success">
		<div class="box-body">
			<div class="row">
				<form action="{{route('airline.add')}}" method="post">
				@csrf
				<div class="col-md-8">
				<div class="form-group">
					<input type="text" name="name" class="form-control" placeholder="airline name">
				</div>
				</div>
				<div class="col-md-4">
					@can('Airlines Name Registration')
						<button class="btn  btn-success" type="submit">Add</button>
					@endcan
				</div>
			</form>
		</div>
	</div>
	</div>
	</div>
	</div>
	
	
	<div class="box box-info">
	<div class="box-body">
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
						@can('Airlines Name Registration')
						<a href="{{route('airline.delete',['id'=>$airline->id])}}">
							<button class="btn btn-xs btn-danger">Delete</button>
						</a>
						@endcan
					</td>
				</tr>
				@endforeach
				@endif
			</tbody>
		</table>
		</div>
	</div>
	

@stop