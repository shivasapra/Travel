@extends('layouts.frontend')
@section('title')
Expenses
@endsection
@section('header')
    <section class="content-header">
      <h1>
        Expenses
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-money"></i> Expenses</li>
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



	<form action="{{route('expenses')}}" method="post">
		@csrf
		<div class="box box-primary">
		<div class="box-body">
				<div class="row">
					<div class="col-md-2">
					<div class="form-group">
						<label for="date">Date:</label>
						<input type="date" name='date' required class="form-control">
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="amount">Amount:</label>
						<input type="text" name='amount' required class="form-control">
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="description">Description:</label>
						<input type="text" name='description' required class="form-control">
					</div>
					</div>
					<div class="col-md-2">
					<div class="form-group">
						<br><br><button class="btn btn-success btn-xs" name="button" type="submit">Add Expense</button>
					</div>
					</div>
				</div>
		</div>
		</div>
	</form>

	<div class="box box-info">
		<div class="box-body">
			<table class="table table-hover mb-0">
                    <thead>
                      <tr>
                        <th>Sno.</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Description</th>
                        <th>Delete</th>
                      </tr>
                    	</thead>
                    <tbody>
                    	@if($expenses->count()>0)
                    	<?php $i = 1; ?>
	                    	@foreach($expenses as $expense)
	                    	<tr>
	                    		<td>{{$i++}}</td>
	                    		<td>{{$expense->date}}</td>
	                    		<td>{{$expense->amount}}</td>
	                    		<td>{{$expense->description}}</td>
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