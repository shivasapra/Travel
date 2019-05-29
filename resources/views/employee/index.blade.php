@extends('layouts.frontend')
@section('title')
Employees
@endsection
@section('header')
	<section class="content-header">
      <h1>
        Employees
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-pencil-square-o"></i> employees</li>
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
                        <th>Name</th>
                        <th>Unique Id</th>
                        <th>country</th>
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
	                    	<tr>
	                    		<td>{{$i++}}</td>
	                    		<td>{{$employee->first_name}}</td>
	                    		<td>{{$employee->unique_id}}</td>
	                    		<td>{{$employee->country}}</td>
	                    		<td>{{$employee->hired_for_dep}}</td>
	                    		<td>{{$employee->hiring_date}}</td>
	                    		<td>{{$employee->currency.$employee->rate}}</td>
	                    		<td>
	                    			<a href="{{route('view.employee',['id'=>$employee->id])}}" class="btn btn-success btn-xs"><span class="fa fa-eye"></span></a>
	                    			<a href="{{route('edit.employee',['id'=>$employee->id])}}" class="btn btn-info btn-xs"><span class="fa fa-edit"></span></a>
	                    			{{-- <a href="{{route('delete.employee',['id'=>$employee->id])}}" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a> --}}
	                    			<a href="{{route('letter.employee',['id'=>$employee->id])}}" class="btn btn-primary btn-xs">Letter</a>
														<a href="{{route('assignments',['id'=>$employee->id])}}" class="btn btn-warning btn-xs">Tasks</a>
														@if($employee->user)
															@if($employee->user->active)
															<a href="{{route('deactivateEmployee',['id'=>$employee->id])}}" class="btn btn-danger btn-xs">Deactivate</a>
															@else
															<a href="{{route('activateEmployee',['id'=>$employee->id])}}" class="btn btn-success btn-xs">Activate</a>
															@endif
														@endif
	                    		</td>
	                    	</tr>
	                    	@endforeach
                    	@endif
                    </tbody>
                </table>
		
			</div>
		</div>
		<div class="text-center">
			<a href="{{route('create.employee')}}">
				<button class="btn btn-success">Add employee</button>
			</a>
		</div>
	
@endsection