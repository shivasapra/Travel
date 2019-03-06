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
@if(Auth::user->admin)
<form action="{{route('assignTask')}}" method="post">
  @csrf
	<div class="box box-info">
    	<div class="box-body">
    		<div class="row">
    			<div class="col-md-4">
    				<label for="employee_id">Employee Id:</label>
					<input type="date" name="date" required value="{{Carbon\Carbon::now()->toDateString()}}" readonly class="form-control">
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
		<button type="submit" class="btn btn-xs btn-warning">Assign Task</button><br><br><hr>
	</div>
</form>
@endif
<div class="box box-info">
	<div class="box-body">
		
	<table class="table table-hover mb-0">
		<thead>
			<tr>
				<th>Sno.</th>
				<th>Date</th>
				<th>Task</th>
				<th>Task Description</th>
				<th>Accepted By:</th>
			</tr>
			</thead>
		<tbody>
			@if($assignments->count()>0)
			<?php $i = 1; ?>
				@foreach($assignments as $assignment)
				<tr>
					<td>{{$i++}}</td>
					<td>{{$assignment->date}}</td>
					<td>{{$assignment->task}}</td>
					<td>{{$assignment->task_description}}</td>
					<td>
						@if($assignment->employee_id != null)
							{{$assignment->employee->first_name}}
						@else
							{{'None'}}
						@endif
					</td>
				</tr>
				@endforeach
			@endif
		</tbody>
	</table>
	</div>
</div>
@stop
