@extends('layouts.frontend')
@section('title')
Products and services
@stop
@section('header')
	<section class="content-header">
      <h1>
        Products
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-plus-square"></i> Products</li>
      </ol>
    </section>
@stop
@section('content')
<div class="row">
	<div class="col-md-8">
	<div class="box box-info">
		<div class="box-body">
			<table class="table table-hover">
				<thead>
					<th>Sno.</th>
					<th>Service</th>
					<th>Action</th>
				</thead>
				<tbody>
					@if($products->count()>0)
					<?php $i = 1; ?>
					@foreach($products as $product)
					<tr>
						<td>{{$i++}}</td>
						<td>{{$product->service}}</td>
						<td>
							@can('Services Registration')
							<a href="{{route('product.delete',['id'=>$product->id])}}">
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
	</div>
	<div class="col-md-4">
	<div class="box box-success">
		<div class="box-body">
			
			<div class="row">
				<form action="{{route('product.add')}}" method="post">
					@csrf
				<div class="col-md-8">
				<div class="form-group">
					<input type="text" name="service" class="form-control" placeholder="service name">
				</div>
				</div>
				<div class="col-md-2">
					@can('Services Registration')
						<button class="btn btn-xs btn-success" type="submit">Add</button>
					@endcan
				</div>
			</form>
			</div>
		</div>
	</div>
	</div>
	
</div>
	
@stop