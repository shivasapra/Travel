@extends('layouts.frontend')
@section('title')
Employee
@endsection
@section('header')
	<section class="content-header">
      <h1>
        View Employee
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('employees')}}"><i class="fa fa-pencil-square-o"></i>Employess</a></li>
        <li class="active">View Employee</li>
      </ol>
    </section>
@stop
@section('content')
	<div class="box box-info">
	<div class="box-body">
	<table class="table table-hover mb-0">
					<tbody>
						<div class="row">
							<tr>
								<td><strong>First Name:</strong></td>
								<td>{{$employee->first_name}}</td>
							</tr>
						</div>
						<div class="row">
							<tr>
								<td><strong>Middle Name:</strong></td>
								<td>{{$employee->middle_name}}</td>
							</tr>
						</div>
						<div class="row">
							<tr>
								<td><strong>last Name:</strong></td>
								<td>{{$employee->last_name}}</td>
							</tr>
						</div>
						<div class="row">
							<tr>
								<td><strong>Father's Name:</strong></td>
								<td>{{$employee->father_name}}</td>
							</tr>
						</div>
						<div class="row">
							<tr>
								<td><strong>Mother's Name:</strong></td>
								<td>{{$employee->mother_name}}</td>
							</tr>
						</div>
						<div class="row">
							<tr>
								<td><strong>Gender:</strong></td>
								<td>{{$employee->gender}}</td>
							</tr>
						</div>
						<div class="row">
							<tr>
								<td><strong>DOB:</strong></td>
								<td>{{$employee->DOB}}</td>
							</tr>
						</div>
						<div class="row">
							<tr>
								<td><strong>Marital Status:</strong></td>
								<td>{{$employee->marital_status}}</td>
							</tr>
						</div>
						<div class="row">
							<tr>
								<td><strong>Disability:</strong></td>
								<td>{{$employee->disability}}</td>
							</tr>
						</div>
						<div class="row">
							<tr>
								<td><strong>Blood Group:</strong></td>
								<td>{{$employee->blood_group}}</td>
							</tr>
						</div>
						<div class="row">
							<tr>
								<td><strong>Country:</strong></td>
								<td>{{$employee->country}}</td>
							</tr>
						</div>
						<div class="row">
							<tr>
								<td><strong>Passport:</strong></td>
								<td>{{$employee->passport}}</td>
							</tr>
						</div>
						<div class="row">
							<tr>
								<td><strong>visa:</strong></td>
								<td>{{$employee->visa}}</td>
							</tr>
						</div>
						<div class="row">
							<tr>
								<td><strong>Visa Valid Upto:</strong></td>
								<td>{{$employee->visa_expired}}</td>
							</tr>
						</div>
					</tbody>
				</table>
			</div>
				
			
		</div>
	

@endsection