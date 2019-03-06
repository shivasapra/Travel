@extends('layouts.frontend')
@section('title')
Assign Task 
@endsection
@section('header')
	<section class="content-header">
      <h1>
        Assign Task
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-pencil-square-o"></i>Assign Task</li>
      </ol>
    </section>
@stop
@section('content')
<form action="{{route('assignTask')}}" method="post">
  @csrf
	<div class="box box-info">
    	<div class="box-body">
    		<div class="row">
    			<div class="col-md-4">
    				<label for="employee_id">Employee Id:</label>
    				<input type="text" id="employeeId" name="employee_id" required class="form-control">
    			</div>
    			<div class="col-md-4">
    				<label for="employee_id">Task Name:</label>
    				<input type="text" name="task" required class="form-control">
    			</div>
    			<div class="col-md-4">
    				<label for="employee_id">Task Description:</label>
    				<textarea name="task_description" required class="form-control"></textarea>
    			</div>
    		</div>
    	</div>
	</div>
	<div class="text-center">
		<button type="submit" class="btn btn-xs btn-warning">Assign Task</button>
	</div>
</form>
@stop
