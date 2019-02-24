@extends('layouts.frontend')
@section('title')
Assign Task 
@endsection
@section('header')
	<section class="content-header">
      <h1>
        Assign Task
      <button type="button" data-toggle="modal" data-target="#modal-info" class="btn btn-sm btn-info">Search employee&nbsp;&nbsp;&nbsp;<i class="fa fa-search"></i></button>
      </h1>
      <div class="modal fade" id="modal-info">
  		<div class="modal-dialog">
   			<div class="modal-content">
      <div class="modal-header" style="color:white;font-weight:500;background-color:#0066FF;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Search employee</h4>
      </div>
      <form action="{{route('searchEmployee')}}" method="post">
        @csrf
      <div class="modal-body">
          <label for="client_name">Employee Name</label>
          <input type="text" name="employee_name" class="form-control" />
      </div>
      <div class="modal-footer" style="color:white;font-weight:500;background-color:#0066FF;">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-outline">Search</button>
      </div>
      </form>
    		</div>
  		</div>
	</div>

      
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-pencil-square-o"></i>Assign Task</li>
      </ol>
    </section>
@stop
@section('content')
<form action="{{route('statusSave')}}" method="post">
  @csrf
	@if($cemployees->count()>0)
  	<div class="box box-info">
    	<div class="box-body">
    		@foreach($employees as $employee)
    		<table class="table table-hover mb-0">
                    <thead>
                      <tr>
                        <th>Sno.</th>
                        <th>Name</th>
                        <th>Employee Id</th>
                        <th>Email</th>
                        <th>Rate Contract</th>
                        <th>DOB</th>
                      </tr>
                    	</thead>
                    <tbody>
                    	@if($employees->count()>0)
                    	<?php $i = 1; ?>
	                    	@foreach($employees as $employee)
	                    	<tr>
	                    		<td>{{$i++}}</td>
	                    		<td>{{$employee->first_name.' '.$employee->last_name}}</td>
	                    		<td><input id="unique" type="text" value="{{$employee->unique_id}}" readonly></td>
	                    		<td>{{$employee->email}}</td>
	                    		<td>{{$employee->country}}</td>
	                    		<td>{{$employee->rate}}</td>
	                    		<td>{{$employee->DOB}}</td>
	                    		</tr>
	                    	@endforeach
                    	@endif
                    </tbody>
            </table>
    		@endforeach
    			
    	</div>
	</div>
    @endif	
	<div class="box box-info">
    	<div class="box-body">
    		
    		<div class="row">
    			<div class="col-md-4">
    				<label for="employee_id">Employee Id:</label>
    				<input type="text" id="employeeId" name="employee_id" required class="form-control">
    			</div>
    		</div>
    	</div>
	</div>
	<div class="text-center">
		<button type="submit" class="btn btn-xs btn-success">Send</button>
	</div>
	
</form>
@stop
@section('js')
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
	$("#unique").on('click',function(){
		document.getElementById('employeeId').value = this.value;
	});
});
	</script>
@stop