@extends('layouts.frontend')
@section('title')
Employee wage log
@endsection
@section('content')
		<div class="box box-info">
			<div class="box-body">
				
			<table class="table table-hover mb-0">
                <thead>
                    <tr>
                    	<th>Sno.</th>
                    	<th>Unique Id</th>
                    	<th>Login Time</th>
                    	<th>Logout Time</th>
                    	<th>Date</th>
                    	<th>Hourly Wage</th>
                    	<th>Today's wage</th>
                    </tr>
                </thead>
                <tbody>
            		<?php $i=1;?>
            		@foreach($employee->wage as $wage)
            		<tr>
            		<td>{{$i++}}</td>
            		<td>{{$employee->unique_id}}</td>
            		<td>{{$wage->login}}</td>
                    <td>{{$wage->logout}}</td>
                    <td>{{$wage->date}}</td>
                    <td>{{$wage->hourly}}</td>
                    <td>{{$wage->wage}}</td>
            		</tr>
					@endforeach
                </tbody>
            </table>
		</div>
@endsection