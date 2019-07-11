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
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
@stop
@section('content')
		<div class="box box-info">
			<div class="box-body">
				
			<table class="table table-hover mb-0" id="example" >
                    <thead>
                      <tr>
                        <th>Sno.</th>
                        <th>Unique Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>country</th>
						<th>Hired For Department</th>
						<th>Hiring Date</th>
                        <th>Rate Contract</th>
						<th>Action</th>
						<th>Letter</th>
						<th>Tasks</th>	
						<th>Account Activation</th>	
                      </tr>
                    	</thead>
                    <tbody>
                    	@if($employees->count()>0)
                    	<?php $i = 1; ?>
	                    	@foreach($employees as $employee)
	                    	<tr>
	                    		<td>{{$i++}}</td>
	                    		<td>{{$employee->unique_id}}</td>
	                    		<td>{{$employee->first_name . ' '. $employee->last_name}}</td>
	                    		<td>{{$employee->email}}</td>
	                    		<td>{{$employee->country}}</td>
								<td>{{$employee->hired_for_dep}}</td>
								<td>{{$employee->hiring_date}}</td>
	                    		<td>{{$employee->currency.$employee->rate}}</td>
	                    		<td>
									@can('View Employees')
										<a href="{{route('view.employee',['id'=>$employee->id])}}" class="btn btn-success btn-xs"><span class="fa fa-eye"></span></a>
									@endcan
								</td>
								<td>
									@can('Letter To Employee')
										<a href="{{route('letter.employee',['id'=>$employee->id])}}" class="btn btn-primary btn-xs">Letter</a>
									@endcan
								</td>
								<td>
										<a href="{{route('assignments',['id'=>$employee->id])}}" class="btn btn-warning btn-xs">Tasks</a>
								</td>
									{{-- @can('Edit Employee')
									<a href="{{route('edit.employee',['id'=>$employee->id])}}" class="btn btn-info btn-xs"><span class="fa fa-edit"></span></a>
									@endcan --}}
									{{-- <a href="{{route('delete.employee',['id'=>$employee->id])}}" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a> --}}
								<td>
									@if($employee->user)
										@can('Activate/Deactivate Employee')
											@if($employee->user->active)
											<a onClick="return confirm('Are You Sure You Want To Deactivate Account?')" href="{{route('deactivateEmployee',['id'=>$employee->id])}}" class="btn btn-danger btn-xs">Deactivate</a>
											@else
											<a onClick="return confirm('Are You Sure You Want To Activate Account?')" href="{{route('activateEmployee',['id'=>$employee->id])}}" class="btn btn-success btn-xs">Activate</a>
											@endif
										@endcan
									@else
									<a href="{{route('resend.employee.account.confirmation',['id'=>$employee->id])}}" class="btn btn-info btn-xs">Resend</a>
									<span class="text-warning">{{'Not Yet Verified'}}</span>
									@endif
								</td>
									
									
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
				@can('Create Employee')
				<button class="btn btn-success">Add employee</button>
				@endcan
			</a>
		</div>
	
@endsection
@section('js')
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>


  <script>
  	$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
        ]
    } );
} );
</script>
@stop