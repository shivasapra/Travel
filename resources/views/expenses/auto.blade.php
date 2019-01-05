@extends('layouts.frontend')
@section('title')
Auto Deduction
@endsection
@section('header')
    <section class="content-header">
      <h1>
        Auto Deduction
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-money"></i> Auto Deduction</li>
      </ol>
    </section>
@stop
@section('content')
	
	@if(count($errors)>0)
		<ul class="list-group">
			@foreach($errors->all() as $error)
				<li class="list_group-item text-danger">
					{{ $error }}
				</li>
			@endforeach
		</ul>
	@endif

	<form action="{{route('auto')}}" method="post">
		@csrf
		<div class="box box-danger">
			<div class="box-header with-border">
                  <h3 class="box-title"><strong>{{"Auto Deduction"}}</strong></h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
		<div class="box-body">
				<div class="row">
					<div class="col-md-2">
					<div class="form-group">
						<label for="start_date">Start Date:</label>
						<input type="date" name='start_date' min="{{$date}}" required  class="form-control">
					</div>
					</div>
					<div class="col-md-2">
					<div class="form-group">
						<label for="end_date">End Date:</label>
						<input type="date" name='end_date' required min="{{$date}}" class="form-control">
					</div>
					</div>
					<div class="col-md-2">
					<div class="form-group">
						<label for="deduction_date">Deduction Date:</label>
						<input type="text" name='deduction_date' required  class="form-control">
					</div>
					</div>
					<div class="col-md-3">
					<div class="form-group">
						<label for="amount">Amount:</label>
						<input type="text" name='amount' required class="form-control">
					</div>
					</div>
					<div class="col-md-3">
					<div class="form-group">
						<label for="description">Description:</label>
						<input type="text" name='description' required class="form-control">
					</div>
					</div>
					<div class="text-center">
					<div class="form-group">
						<br><br><button class="btn btn-info btn-xs" name="button" type="submit">Save</button>
					</div>
					</div>
				</div>
		</div>
		</div>
	</form>
	<div class="box box-info">
		<div class="box-header with-border">
                  <h3 class="box-title"><strong>{{"Entries"}}</strong></h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
		<div class="box-body">
			<table class="table table-hover mb-0">
                    <thead>
                      <tr>
                        <th>Sno.</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Deduction Date</th>
                        <th>Amount</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Delete</th>
                      </tr>
                    	</thead>
                    <tbody>
                    	@if($expenses->count()>0)
                    	<?php $i = 1; ?>
	                    	@foreach($expenses as $expense)
	                    	<tr>
	                    		<td>{{$i++}}</td>
	                    		<td>{{$expense->start_date}}</td>
	                    		<td>{{$expense->end_date}}</td>
	                    		<td>{{$expense->deduction_date}}</td>
	                    		<td>{{$expense->amount}}</td>
	                    		<td>{{$expense->description}}</td>
	                    		<td>
	                    			@if($expense->status == 0)
	                    			<div class="text-danger"><strong>Expired</strong></div>
	                    			@elseif($expense->status==1)
	                    			<div class="text-info"><strong>Active</strong></div>
	                    			@endif
	                    		</td>
	                    		<td>
	                    			<a href="{{route('expense.delete',['id'=>$expense->id])}}" class="btn btn-danger btn-xs">Delete</a>
	                    		</td>
	                    		</tr>
	                    	@endforeach
                    	@endif
                    </tbody>
            </table>
		</div>
	</div>


@stop