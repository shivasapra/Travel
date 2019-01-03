@extends('layouts.frontend')
@section('title')
Slip
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


	<div class="row">
		<form action="{{route('slip')}}" method="post">
			@csrf
		<div class="col-md-6 ">
		<div class="box box-primary">
		<div class="box-body">
					<div class="form-group">
						<label for="unique">Employee Unique Id:</label>
						<input type="text" name='unique' required class="form-control">
					</div>
					<div class="form-group">
						<label for="from">From:</label>
						<input type="date" name='from' required class="form-control">
					</div>
					<div class="form-group">
						<label for="address">To:</label>
						<input type="date" name='address' required class="form-control">
					</div>

		</div>
		</div>
		<div class="form-group">
			<div class="text-center">
				<button class="btn btn-success" type="submit">Generate</button>
			</div>
		</div>
	</div>
		</form>
		
		<div class="col-md-6 ">
		<div class="box box-info">
		<div class="box-body">
			<table class="table table-hover mb-0">
				<tbody>
					<div class="text-center"><strong><h4>Salary Slip</h4></strong></div>
					<div class="row">
						<tr>
							<td><strong>Employee Name:</strong></td>
							<td>{{$employee->first_name}}</td>
						</tr>
					</div>
					<div class="row">
						<tr>
							<td><strong>Total Hours:</strong></td>
							<td>{{$total_hours}}</td>
						</tr>
					</div>
					<div class="row">
						<tr>
							<td><strong>Total Wage:</strong></td>
							<td>{{'$'.$total_wage}}</td>
						</tr>
					</div>
				</tbody>
			</table>
		</div>
		</div>
		<div class="text-center">
		<button onclick='myFunction()' class="btn btn-success btn-sm">Print</button></div>
		</div>
		</div>
		<script>
			function myFunction(){
				window.print();
			}
		</script>

@stop