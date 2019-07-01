@extends('layouts.frontend')
@section('title')
Generate Salary Slip
@endsection
@section('header')
    <section class="content-header">
      <h1>
				Salary Slip
				@can('Employee Salary Slip')
				<button type="button" data-toggle="modal" data-target="#modal-info" class="btn btn-sm btn-info" id="searchEmployee">Search Employee&nbsp;&nbsp;&nbsp;<i class="fa fa-search"></i></button>
				@endcan
			</h1>
			<div class="modal fade" id="modal-info">
					<div class="modal-dialog">
						 <div class="modal-content">
				<div class="modal-header" style="color:white;font-weight:500;background-color:#0066FF;">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Search Employee</h4>
				</div>
				<form action="{{route('searchEmployees')}}" method="post">
					@csrf
				<div class="modal-body">
					<label for="employee_name">Employee Name</label>
					<input type="text" name="employee_name" class="form-control" />
				</div>
				<div class="modal-footer" style="color:white;font-weight:500;background-color:#0066FF;">
					<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-outline">Search</button>
				</div>
				</form>
						</div>
					</div>
				</div>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-paperclip"></i> Salary Slip</li>
      </ol>
    </section>
@stop
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
	@if($employees->count()>0)
	<div class="box box-info">
	  <div class="box-body">
		  @foreach($employees as $employee)
		  <table class="table table-hover mb-0">
				  <thead>
					<tr>
					  <th>Sno.</th>
					  <th>Name</th>
					  <th>Employee Id</th>
					  <th>Contact</th>
					  <th>Email</th>
					</tr>
					  </thead>
				  <tbody>
					  @if($employees->count()>0)
					  <?php $i = 1; ?>
						  @foreach($employees as $employee)
						  <tr>
							  <td>{{$i++}}</td>
							  <td>{{$employee->first_name.' '.$employee->last_name}}</td>
							  <td><input id="unique" type="text" value="{{$employee->unique_id}}" readonly></td>
							  <td>{{$employee->mobile_phone}}</td>
							  <td>{{$employee->email}}</td>
							  </tr>
						  @endforeach
					  @endif
				  </tbody>
		  </table>
		  @endforeach
			  
	  </div>
  </div>
  @endif



			<form action="{{route('slip')}}" method="post">
				@csrf
		<div class="box box-primary">
		<div class="box-body">
				<div class="row">
					<div class="col-md-4">
					<div class="form-group">
						<label for="unique">Employee Unique Id:</label>
						<input type="text" id="EmployeeId" name='unique' required class="form-control" readonly>
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="month">Month:</label>
						<select name="month" class="form-control">
							<option value="01">January</option>
							<option value="02">February</option>
							<option value="03">March</option>
							<option value="04">April</option>
							<option value="05">May</option>
							<option value="06">June</option>
							<option value="07">July</option>
							<option value="08">August</option>
							<option value="09">September</option>
							<option value="10">October</option>
							<option value="11">November</option>
							<option value="12">December</option>

						</select>
					</div>
					</div>
				</div>
		</div>
		</div>
				<div class="form-group">
					<div class="text-center">
						@can('Employee Salary Slip')
						<button class="btn btn-success" type="submit">Generate</button>
						@endcan
					</div>
				</div>
			</form>


@stop
@section('js')
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
	$("#unique").on('click',function(){
		console.log(this.value);
		
		document.getElementById('EmployeeId').value = this.value;
	});
});
	</script>
@stop