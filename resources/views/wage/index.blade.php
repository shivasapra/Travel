@extends('layouts.frontend')
@section('title')
Employees
@endsection
@section('content')
		<div class="box box-info">
			<div class="box-body">
				
			<table class="table table-hover mb-0">
                <thead>
                    <tr>
                    	<th>Sno.</th>
                    	<th>Employee</th>
                    	<th>Unique Id</th>
                    	<th>Login Time</th>
                    	<th>Logout Time</th>
                    	<th>Date</th>
                    	<th>Hourly Wage</th>
                    	<th>Today's wage</th>
                    	<th>Action</th>
                    </tr>
                </thead>
                <tbody>
                	@if($employees->count()>0)
            		<?php $i=1;?>
            		@foreach($employees as $employee)
            		<tr>
            		<td>{{$i++}}</td>
            		<td>{{$employee->first_name}}</td>
            		<td>{{$employee->unique_id}}</td>
            		<td>{{$employee->wage[0]->login}}</td>
                    <td>{{$employee->wage[0]->logout}}</td>
                    <td>{{$employee->wage[0]->date}}</td>
                    <td>{{$employee->wage[0]->hourly}}</td>
                    <td>{{$employee->wage[0]->wage}}</td>
                    <td><a href=""><button class="btn btn-info btn-xs">View</button></a></td>
            		</tr>
					@endforeach	
                	@endif
                </tbody>
            </table>
		</div>
@endsection