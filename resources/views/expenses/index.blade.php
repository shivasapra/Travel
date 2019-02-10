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
			<div class="box-header with-border">
                  <h3 class="box-title"><strong>{{"Daily Expense"}}</strong></h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
		<div class="box-body">
				<div class="row">
					
					<div class="col-md-3">
					<div class="form-group">
						<label for="description">Description:</label>
						<select name="description" id="" required  class="form-control">
							<option value="Rent Payable">Rent Payable</option>
							<option value="Insurance">Insurance</option>
							<option value="Light and Heat">Light and Heat</option>
							<option value="Repairs and Maintenance">Repairs and Maintenance</option>
							<option value="Printing Postage and Stationery">Printing Postage and Stationery</option>
							<option value="Advertising">Advertising</option>
							<option value="Telephone">Telephone</option>
							<option value="Travel Expenses">Travel Expenses</option>
							<option value="Legal and Professional fees">Legal and Professional fees</option>
							<option value="Accountancy">Accountancy</option>
							<option value="Bank Charges">Bank Charges</option>
							<option value="Credit and Charges">Credit and Charges</option>
							<option value="General Expenses">General Expenses</option>
							<option value="Bank Interest Paid">Bank Interest Paid</option>
							<option value="Interest on Overdue taxation">Interest on Overdue taxation</option>
						</select>
					</div>
					</div>
					<div class="col-md-2">
					<div class="form-group">
						<label for="date">Date:</label>
						<input type="date" name='date' max="{{$date}}" required  class="form-control">
					</div>
					</div>
					<div class="col-md-3">
					<div class="form-group">
						<label for="amount">Amount:</label>
						<input type="text" name='amount' required class="form-control">
					</div>
					</div>
					<div class="col-md-2">
					<div class="form-group">
						<label for="company_name">Company Name:</label>
						<input type="text" name='company_name' class="form-control">
					</div>
					</div>
					<div class="col-md-2">
					<div class="form-group">
						<label for="invoice_no">Invoice No.</label>
						<input type="text" name='invoice_no' class="form-control">
					</div>
					</div>
					<div class="text-center">
					<div class="form-group">
						<br><br><button class="btn btn-success btn-xs" name="button" type="submit">Add Expense</button>
					</div>
					</div>
				</div>
		</div>
		</div>
	</form>

	
	



	<div class="box box-info">
		<div class="box-header with-border">
                  <h3 class="box-title"><strong>{{"Expenses"}}</strong></h3>
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
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Description</th>
                        <th>Company Name</th>
                        <th>Invoice No</th>
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
	                    			@if($expense->company_name)
	                    				{{$expense->company_name}}
	                    			@else
	                    				<strong>{{"N/A"}}</strong>
	                    			@endif
	                    		</td>
	                    		<td>
	                    			@if($expense->invoice_no)
	                    				{{$expense->invoice_no}}
	                    			@else
	                    				<strong>{{"N/A"}}</strong>
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