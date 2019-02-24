@extends('layouts.frontend')
@section('title')
Employee wage log
@endsection
@section('header')
    <section class="content-header">
      <h1>
        <strong>{{$employee->first_name}}'s</strong> Wage log
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('wage')}}"><i class="fa fa-wrench"></i> Staff Wage Management</a></li>
        <li class="active">Employee Wage Log</li>
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
                    	<th>Unique Id</th>
                    	<th>Date</th>
                        <th>Total Hours</th>
                    	<th>Hourly Wage</th>
                    	<th>Total wage</th>
                    </tr>
                </thead>
                <tbody>
                    @if($employee->wage->count()>0)
            		<?php $i=1;?>
                    @foreach($employee->wage as $wage)
                		<tr>
                		<td>{{$i++}}</td>
                		<td>{{$employee->unique_id}}</td>
                        <td>{{$wage->date}}</td>
                        <td>{{$wage->total_hours}}</td>
                        <td>{{$wage->hourly}}</td>
                        <td>{{$wage->today_wage}}</td>
                		</tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
		</div>
@endsection