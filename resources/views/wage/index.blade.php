@extends('layouts.frontend')
@section('title')
Staff wage management
@endsection
@section('header')
    <section class="content-header">
      <h1>
        Staff Wage Management
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-wrench"></i> Staff Wage Management</li>
      </ol>
    </section>
@stop
@section('content')
		<div class="box box-info">
			<div class="box-body">
				
			<table class="table table-hover mb-0">
                <thead>
                    <tr>
                    	<th>Sno.</th>
                    	<th>Employee</th>
                    	<th>Unique Id</th>
                    	<th>Date</th>
                        <th>Today's Hours</th>
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
                    @if($employee->wage->count()>0)
                    <td>{{$employee->wage->last()->date}}</td>
                    <td>{{$employee->wage->last()->total_hours}}</td>
                    <td>{{$employee->wage->last()->hourly}}</td>
                    <td>{{$employee->wage->last()->today_wage}}</td>
                    @else
                    <td>N/A</td><td>N/A</td><td>N/A</td><td>N/A</td><td>N/A</td>
                    @endif
                    <td><a href="{{route('wage.log',['id'=>$employee->id])}}"><button class="btn btn-info btn-xs">View</button></a></td>
            		</tr>
					@endforeach	
                	@endif
                </tbody>
            </table>
		</div>
@endsection