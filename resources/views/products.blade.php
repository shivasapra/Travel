@extends('layouts.frontend')
@section('title')
Products and services
@stop
@section('content')
	<div class="box">
		<div class="box-body">
			<div class="container">
			<div class="row">
				<form action="{{route('product.add')}}" method="post">
					@csrf
				<div class="col-md-8">
				<div class="form-group">
					<input type="text" name="service" class="form-control" placeholder="service name">
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
							<a href="{{route('product.delete',['id'=>$product->id])}}">
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