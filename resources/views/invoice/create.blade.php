@extends('layouts.frontend')
@section('title')
Create Invoice
@endsection
@section('header')
	<section class="content-header">
      <h1>
        Invoice
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href=""><i class="fa fa-paperclip"></i> Invoice</a></li>
        <li class="active">Create Invoice</li>
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



			<form action="" method="post">
				@csrf
		<div class="box box-primary">
		<div class="box-body">
			<section class="content-header">
				<h1 class="text-center">Create Invoice</h1>
			</section>
			<hr>
			<div class="row">
				<div class="col-md-8">
					<h4>To,</h4>
					<h4>RECEIVER (BILL TO)</h4>
				</div>
				<div class="col-md-4">
					<h4>Reverse Charge</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8">
				<div class="form-group">
					<input type="text" name='receiver_name' required class="form-control" placeholder="Enter Receiver Name">
					<textarea name="billing_address" required class="form-control" placeholder="Enter Billing Adress"></textarea>
				</div>
				</div>
				<div class="col-md-4">
				<div class="form-group">
					<input type="text" name='invoice_no' integer placeholder="Enter Invoice No." required class="form-control">
					<input type="date" name='invoice_date' placeholder="Select Invoice date" required class="form-control">
				</div>
				</div>
			</div>
		</div>
		</div>
		<div class="box box-success">
		<div class="box-body">
			<table class="table table-bordered">
                <thead>
                  <tr>
                    <th width="7%">Sno.</th>
                    <th width="15%">Item Name</th>
                    <th width="15%">Item Sub Name</th>
                    <th width="7%">Quantity</th>
                    <th width="8%">Currency</th>
                    <th width="13%">Price</th>
                    <th width="12%">Actual Amt.</th>
                    <th width="12%">Status</th>
                  </tr>
                	</thead>
                <tbody id="target">
                	<?php $i=1;?>
                	<tr>
						<th>1.</th>
						<td>
							<select name="item_name[]" class="form-control" id="">
								<option value="">--select--</option>
								@if($products->count()>0)
								@foreach($products as $product)
									<option value="{{$product->service}}">{{$product->service}}</option>
								@endforeach
								@endif
							</select>
						</td>
						<td>
							<select name="item_subname[]" class="form-control" id="">
								<option value="">--select--</option>
								@if($airlines->count()>0)
								@foreach($airlines as $airline)
									<option value="{{$airline->name}}">{{$airline->name}}</option>
								@endforeach
								@endif
							
							</select>
						</td>
						<td><input type="text" name='quantity[]' required class="form-control"></td>
						<td><select name="item_name[]" class="form-control" id="">
							<option value="$">$</option>
							</select>
						</td>
						<td><input type="text" name='price[]' required class="form-control"></td>
						<td><input type="text" name='amount[]' required class="form-control" readonly></td>
						<td><select name="status[]" class="form-control" id="">
							<option value="">--select--</option>
							<option value='1'>Paid</option>
							<option value='0'>UnPaid</option>
							</select>
						</td>
					</tr>

                </tbody>
	        </table>
			<div class="text-center"  style="margin-top: 5px">
			<button class="btn btn-success btn-sm" type="button" id="add">+</button>
			</div>
		</div>
		</div>
		<div class="box box-default">
		<div class="box-body">
			<table class="table table-bordered">
				<tr>
					<td class="col-md-8" align="right"><strong>Total:</strong></td>
					<td class="col-md-4"><input type="text" required class="form-control" readonly></td>
				</tr>
			</table>
		</div>
		</div>
			
			<div class="form-group">
			<div class="text-center">
				<button class="btn btn-primary" type="submit">Create</button>
			</div>
			</div>
		</form>

	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
    $("#add").click(function(){
    	var append = '<tr><th>1.</th><td><select name="item_name[]" class="form-control" id=""><option value="">--select--</option><option value=""></option></select></td><td><select name="item_subname[]" class="form-control" id=""><option value="">--select--</option><option value=""></option></select></td><td><input type="text" name="quantity[]" required class="form-control"></td><td><select name="item_name[]" class="form-control" id=""><option value="$">$</option></select></td><td><input type="text" name="price[]" required class="form-control"></td><td><input type="text" name="amount[]" required class="form-control" readonly></td><td><select name="status[]" class="form-control" id=""><option value="">--select--</option><option value="1">Paid</option><option value="0">UnPaid</option></select></td></tr>';
        $("#target").append(append);   
        });
    });
   	</script>

@stop