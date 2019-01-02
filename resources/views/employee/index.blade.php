@extends('layouts.frontend')
@section('title')
Employees
@endsection
@section('content')
	<div class="container">
			<table class="table table-hover mb-0">
                    <thead>
                      <tr>
                        <th>Sno.</th>
                        <th>Name</th>
                        <th>Passport</th>
                        <th>country</th>
                        <th>Address</th>
                        <th>Department</th>
                        <th>Hiring Date</th>
                        <th>Rate Contract</th>
                        <th>Action</th>
                      </tr>
                    	</thead>
                    <tbody>
                    	@if($employees->count()>0)
                    	<?php $i = 1; ?>
	                    	@foreach($employees as $employee)
	                    		<td>{{$i++}}</td>
	                    		<td>{{$employee->first_name}}</td>
	                    		<td>{{$employee->passport}}</td>
	                    		<td>{{$employee->country}}</td>
	                    		<td>{{$employee->permanent_address}}</td>
	                    		<td>{{$employee->hired_for_dep}}</td>
	                    		<td>{{$employee->hiring_date}}</td>
	                    		<td>{{$employee->rate}}</td>
	                    		<td>
	                    			<a href="{{route('view.employee',['id'=>$employee->id])}}" class="btn btn-success btn-xs">view</a>
	                    			<a href="{{route('edit.employee',['id'=>$employee->id])}}" class="btn btn-info btn-xs">edit</a>
	                    			<a href="{{route('delete.employee',['id'=>$employee->id])}}" class="btn btn-danger btn-xs">Delete</a>
	                    		</td>
	                    	@endforeach
                    	@endif
                    </tbody>
                </table>
		<div class="text-center">
			<a href="{{route('create.employee')}}">
				<button class="btn btn-success">Add employee</button>
			</a>
		</div>
	</div>
@endsection