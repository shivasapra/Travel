@extends('layouts.frontend')
@section('title')
Generate Salary Slip
@endsection
@section('content')
	
	@if(count($errors)>0)
		<ul class="list-group">
			@foreach($errors->all() as $error)
				<li class="list_group-item text-danger">
					{{ $error }}
				</li>
			@endforeach
		</ul>
	@endif



			<form action="{{route('slip')}}" method="post">
				@csrf
		<div class="box box-primary">
		<div class="box-body">
				<div class="row">
					<div class="col-md-4">
					<div class="form-group">
						<label for="unique">Employee Unique Id:</label>
						<input type="text" name='unique' required class="form-control">
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="from">From:</label>
						<input type="date" name='from' required class="form-control">
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="address">To:</label>
						<input type="date" name='address' required class="form-control">
					</div>
					</div>
				</div>
		</div>
		</div>
				<div class="form-group">
					<div class="text-center">
						<button class="btn btn-success" type="submit">Generate</button>
					</div>
				</div>
			</form>


@stop