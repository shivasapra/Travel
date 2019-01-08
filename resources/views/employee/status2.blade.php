@extends('layouts.frontend')
@section('title')
Employees Status
@endsection
@section('header')
	<section class="content-header">
      <h1>
        Employees Status
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-pencil-square-o"></i> employees status</li>
      </ol>
    </section>
@stop
@section('content')
	<div class="row">
	<div class="col-md-9">
		<div class="box box-info">
			<div class="box-body">
				
			<table class="table table-hover mb-0">
                    <thead>
                      <tr>
                        <th>Sno.</th>
                        <th>Name</th>
                        <th>Unique Id</th>
                        <th>Date</th>
                        <th>Status</th>
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
	                    		<td>{{$date}}</td>
	                    		<?php $j=0;?>
	                    		@if($employee->wage->count()>0)
		                    		@foreach($employee->wage as $wage)
		                    		@if($wage->date == $date)
		                    			<td><span class="text-success"><strong>Present</strong></span></td>
		                    			@break
		                    		@endif
		                    		<?php $j++; ?>
		                    		@endforeach
		                    		@if($j == $employee->wage->count())
		                    			<td><span class="text-danger"><strong>Absent</strong></span></td>
		                    		@endif
		                    	@else
		                    		<td><span class="text-danger"><strong>Absent</strong></span></td>
		                    	@endif
	                    	</tr>
	                    	@endforeach
                    	@endif
                    </tbody>
                </table>
		
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<form action="{{route('status2')}}" method="post">
			@csrf
			<div class="box box-warning">
			<div class="box-body">
			<div class="form-group">
			<input type="date" name="date" required max="{{$date}}" class="form-control">
			</div>
			<div class=" text-center">
			<input type="submit" class="btn btn-info btn-xs" value="submit" class="form-control"></div>
			</div>
			</div>
		</form>
	</div>
	</div>
		{{-- <div class="text-center">
			<a href="{{route('create.employee')}}">
				<button class="btn btn-success">Add employee</button>
			</a>
		</div> --}}
	
@endsection