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
        <li><a href="{{route('invoice')}}"><i class="fa fa-paperclip"></i> Invoice</a></li>
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



	<form action="{{route('invoice.store')}}" method="post">
		@csrf
		<div class="box box-primary">
		<div class="box-body">
			<section class="content-header">
				<h1 class="text-center"><span style="color:#0066FF;">Create Invoice</span></h1>
			</section>
			<hr>
			<div class="row">
				<div class="col-md-8">
					<h3>To,</h3>
					<h3>RECEIVER (BILL TO)</h3>
				</div>
				<div class="col-md-4">
					{{-- <h3>Reverse Charge</h3> --}}
				</div>
			</div>
			<div class="row">
				<div class="col-md-8">
				<div class="form-group">
					<select required name='receiver_name' class="form-control" id="client">
						<option value="">--select--</option>
						@if($clients->count()>0)
						@foreach($clients as $client)
							<option value="{{$client->id}}">{{$client->first_name.' '.$client->last_name}}</option>
						@endforeach
						@endif
					</select>
					{{-- <input type="text" name='receiver_name' required class="form-control" placeholder="Enter Receiver Name"> --}}
					<div id="address">
						<textarea name="billing_address" required class="form-control" placeholder="Enter Billing Adress"></textarea>
					</div>
				</div>
				</div>
				<div class="col-md-4">
				<div class="form-group">
					<input style="color:white;font-weight:500;background-color:#0066FF;" type="text" name='invoice_no' readonly class="form-control" value="{{$invoice_no}}">
					<input type="date" name='invoice_date' value="{{$date}}" placeholder="Select Invoice date" required class="form-control">
				</div>
				</div>
			</div>
		</div>
		</div>


		<div class="invoice" style="margin:0 0 30px 0;">
			<div class="card">
				<div class="card-header text-danger font-weight-bold">General PNR Info</div>
				<div class="card-body p-0">
					<div class="table-responsive">
						<table class="table table-bordered m-0">
							<thead>
							<tr>
								<th>Creation Date <a href="#" class="text-dark"><i class="fa fa-angle-down"></i></a></th>
								<th>Universal PNR <a href="#" class="text-dark"><i class="fa fa-angle-down"></i></a></th>
								<th>PNR <a href="#" class="text-dark"><i class="fa fa-angle-down"></i></a></th>
								<th>Agency PCC <a href="#" class="text-dark"><i class="fa fa-angle-down"></i></a></th>
								<th>Airline Ref <a href="#" class="text-dark"><i class="fa fa-angle-down"></i></a></th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>Friday, 10 May 2019</td>
								<td>T4LQU5</td>
								<td>8H6GQE</td>
								<td>TVPORTDYNASKLTONWABAGENC</td>
								<td>KCZFHZ</td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="card mt-3">
				<div class="card-header text-danger font-weight-bold">
					<div class="row">
					<div class="col-sm-6">Passenger Details</div>
					<div class="col-sm-6 text-right"><button type="button" onclick="myCreateFunction()" class="btn btn-primary">Add Passenger</button></div>
					</div>
				</div>
				<div class="card-body p-0">
					<div class="table-responsive">
						<table id="myTable" class="table table-bordered m-0" style="margin-top:10px;">
							<thead>
							<tr>
								<th>Pax Id <a href="#" class="text-dark"><i class="fa fa-angle-down"></i></a></th>
								<th>Pax Type* <a href="#" class="text-dark"><i class="fa fa-angle-down"></i></a></th>
								<th>First Name <a href="#" class="text-dark"><i class="fa fa-angle-down"></i></a></th>
								<th>Last Name <a href="#" class="text-dark"><i class="fa fa-angle-down"></i></a></th>
								<th>Date of Birth* <a href="#" class="text-dark"><i class="fa fa-angle-down"></i></a></th>
								<th>&nbsp;</th>
								<th>Fare Cost <a href="#" class="text-dark"><i class="fa fa-angle-down"></i></a></th>
								<th>Fare Sell <a href="#" class="text-dark"><i class="fa fa-angle-down"></i></a></th>
								<th>Tax Cost <a href="#" class="text-dark"><i class="fa fa-angle-down"></i></a></th>
								<th>Tax Sell <a href="#" class="text-dark"><i class="fa fa-angle-down"></i></a></th>
								<th>Total Sell <a href="#" class="text-dark"><i class="fa fa-angle-down"></i></a></th>
								<th>&nbsp;</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>1</td>
								<td>
									<select class="form-control select-custom custom-select">
										<option value="Adult">Adult</option>
										<option value="Youth">Youth</option>
										<option value="Child">Child</option>
										<option value="Infant">Infant</option>
									</select>
								</td>
								<td><input type="text" value="Harnam" class="form-control"></td>
								<td><input type="text" value="Singh" class="form-control"></td>
								<td><input type="text" placeholder="dd/mm/yyyy" value="" class="form-control"></td>
								<td>Segment-1</td>
								<td><input type="text" value="0" class="form-control" style="width:60px;"></td>
								<td><input type="text" value="0" class="form-control" style="width:60px;"></td>
								<td><input type="text" value="0" class="form-control" style="width:60px;"></td>
								<td><input type="text" value="0" class="form-control" style="width:60px;"></td>
								<td><input type="text" value="0" class="form-control" style="width:60px;"></td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td colspan="5"></td>
								<td>Segment-2</td>
								<td><input type="text" value="0" class="form-control" style="width:60px;"></td>
								<td><input type="text" value="0" class="form-control" style="width:60px;"></td>
								<td><input type="text" value="0" class="form-control" style="width:60px;"></td>
								<td><input type="text" value="0" class="form-control" style="width:60px;"></td>
								<td><input type="text" value="0" class="form-control" style="width:60px;"></td>
								<td>&nbsp;</td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="text-right mt-2">
				<h6 class="text-danger font-weight-bold gbp-back"><span>Total GBP 806.05</span></h6>
			</div>

			<div class="card mt-3">
				<div class="card-header text-danger font-weight-bold">Itinerary Details</div>
				<div class="card-body p-0">
					<div class="table-responsive">
						<table class="table table-bordered m-0">
							<thead>
							<tr>
								<th>Seg Id <a href="#" class="text-dark"><i class="fa fa-angle-down"></i></a></th>
								<th>From <a href="#" class="text-dark"><i class="fa fa-angle-down"></i></a></th>
								<th>To <a href="#" class="text-dark"><i class="fa fa-angle-down"></i></a></th>
								<th>Carrier <a href="#" class="text-dark"><i class="fa fa-angle-down"></i></a></th>
								<th>Flight <a href="#" class="text-dark"><i class="fa fa-angle-down"></i></a></th>
								<th>Class <a href="#" class="text-dark"><i class="fa fa-angle-down"></i></a></th>
								<th>Departure <a href="#" class="text-dark"><i class="fa fa-angle-down"></i></a></th>
								<th>Time <a href="#" class="text-dark"><i class="fa fa-angle-down"></i></a></th>
								<th>Arrival <a href="#" class="text-dark"><i class="fa fa-angle-down"></i></a></th>
								<th>Time <a href="#" class="text-dark"><i class="fa fa-angle-down"></i></a></th>
								<th>Status <a href="#" class="text-dark"><i class="fa fa-angle-down"></i></a></th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>1</td>
								<td><input type="text" value="LHR" class="form-control" disabled></td>
								<td><input type="text" value="XYZ" class="form-control" disabled></td>
								<td><input type="text" value="AC" class="form-control" disabled></td>
								<td><input type="text" value="549" class="form-control" disabled></td>
								<td><input type="text" value="S" class="form-control" disabled></td>
								<td><input type="text" value="15052019" class="form-control" disabled></td>
								<td><input type="text" value="14:10" class="form-control" disabled></td>
								<td><input type="text" value="15052019" class="form-control" disabled></td>
								<td><input type="text" value="16:55" class="form-control" disabled></td>
								<td><input type="text" value="HK" class="form-control" disabled></td>
							</tr>
							<tr>
								<td>1</td>
								<td><input type="text" value="LHR" class="form-control" disabled></td>
								<td><input type="text" value="XYZ" class="form-control" disabled></td>
								<td><input type="text" value="AC" class="form-control" disabled></td>
								<td><input type="text" value="549" class="form-control" disabled></td>
								<td><input type="text" value="S" class="form-control" disabled></td>
								<td><input type="text" value="15052019" class="form-control" disabled></td>
								<td><input type="text" value="14:10" class="form-control" disabled></td>
								<td><input type="text" value="15052019" class="form-control" disabled></td>
								<td><input type="text" value="16:55" class="form-control" disabled></td>
								<td><input type="text" value="HK" class="form-control" disabled></td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="card mt-3">
				<div class="card-header text-danger font-weight-bold">Segment Related Cancellation/date Change Text</div>
				<div class="card-body">
					<h6 class="text-uppercase font-weight-bold">Note</h6>
					<ul class="pl-4">
						<li>Date changes before Departure (subject to original advance purchase conditions and same class of booking) :- not Permitted.</li>
						<li>Date changes before Inbound Departure (subject to same class of booking) :- not Permitted.</li>
						<li>Cancellation Fees (minimum 24 hours before departure) :- No Refunds.</li>
					</ul>
				</div>
				<div class="card-body p-0">
					<div class="table-responsive">
						<table class="table table-bordered m-0">
							<thead class="bg-light">
							<tr>
								<th>Seg Id <a href="#" class="text-dark"><i class="fa fa-angle-down"></i></a></th>
								<th>Cancellation/Date Change Remarks <a href="#" class="text-dark"><i class="fa fa-angle-down"></i></a></th>
								<th>&nbsp;</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>1</td>
								<td><input type="text" value="LHR" class="form-control"></td>
								<td>
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="customCheck" name="example1">
										<label class="custom-control-label" for="customCheck">Tick to hide from customer</label>
									</div>
								</td>
							</tr>
							<tr>
								<td>2</td>
								<td><input type="text" value="LHR" class="form-control"></td>
								<td>
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="customCheck" name="example1">
										<label class="custom-control-label" for="customCheck">Tick to hide from customer</label>
									</div>
								</td>
							</tr>
							<tr>
								<td>3</td>
								<td><input type="text" value="LHR" class="form-control"></td>
								<td>
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="customCheck" name="example1">
										<label class="custom-control-label" for="customCheck">Tick to hide from customer</label>
									</div>
								</td>
							</tr>
							<tr>
								<td>4</td>
								<td><input type="text" value="LHR" class="form-control"></td>
								<td>
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="customCheck" name="example1">
										<label class="custom-control-label" for="customCheck">Tick to hide from customer</label>
									</div>
								</td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="card mt-3">
				<div class="card-header text-danger font-weight-bold">Charge Details</div>
				<div class="card-body p-0">
					<div class="table-responsive">
						<table class="table table-bordered m-0">
							<thead>
							<tr>
								<th>Charge Type <a href="#" class="text-dark"><i class="fa fa-angle-down"></i></a></th>
								<th>Segment Id <a href="#" class="text-dark"><i class="fa fa-angle-down"></i></a></th>
								<th>Pax Id <a href="#" class="text-dark"><i class="fa fa-angle-down"></i></a></th>
								<th>Pax Type <a href="#" class="text-dark"><i class="fa fa-angle-down"></i></a></th>
								<th>Cost Amount <a href="#" class="text-dark"><i class="fa fa-angle-down"></i></a></th>
								<th>Sell Amount <a href="#" class="text-dark"><i class="fa fa-angle-down"></i></a></th>
								<th>Supplier <a href="#" class="text-dark"><i class="fa fa-angle-down"></i></a></th>
								<th>Remarks <a href="#" class="text-dark"><i class="fa fa-angle-down"></i></a></th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>ATOL</td>
								<td>1</td>
								<td>All</td>
								<td>All</td>
								<td>2.50</td>
								<td>2.50</td>
								<td>ATOL</td>
								<td>N/A</td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="text-right mt-2">
					<h6 class="text-danger font-weight-bold gbp-back"><span>Total GBP 2.05</span></h6>
					<h6 class="text-danger font-weight-bold gbp-back"><span>Grand Total GBP 808.52</span></h6>
				</div>
				<div class="row">
				<div class="col-sm-12">
					<h4 class="text-danger font-weight-bold">Agent Remarks</h4>
					<textarea class="form-control" name="" style="height:80px;"></textarea>
					<a href="#" class="btn btn-success" style="margin-top:10px;">Submit</a>
				</div>
				</div>
			</div>
		</div>


		<div class="box box-primary">
		<div class="box-body">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="service_name[]">Select Service</label>
							<select name="service_name[]" id="service" class="form-control"required>
									<option value="">--select--</option>
									@if($products->count()>0)
									@foreach($products as $product)
										<option value="{{$product->service}}">{{$product->service}}</option>
									@endforeach
									@endif
							</select>
						</div>
					</div>
				</div>
				<div id="Insert"></div>
			</div>
			</div>
			{{-- <div class="text-center"  style="margin-top: 5px">
			<button class="btn btn-success btn-sm"  type="button" id="add">Add Service</button><br><br>
			</div> --}}
		<div class="box box-primary" id="targetTotal">
		<div class="box-body">
			<table class="table table-bordered">
				<tr>
					<td class="col-md-8" align="right"><strong>SubTotal:</strong></td>
					<td class="col-md-4"><input name="total"  type="text" id="total" required class="form-control" readonly></td>
				</tr>
				<tr>
					<td class="col-md-8" align="right"><strong>Discount:</strong></td>
					<td class="col-md-4"><input name="discount" type="text" id="discount" required class="form-control" value="0"></td>
				</tr>
				<tr>
					<td class="col-md-8" align="right"><strong>Total:</strong></td>
					<td class="col-md-4"><input name="discounted_total" type="text" id="discounted_total" style="color:white;font-weight:500;background-color:#0066FF;" required class="form-control" readonly></td>
				</tr>
			</table>
		</div>
		</div>
		<div class="box box-primary">
			<div class="box-body">
				<table class="table table-bordered">

					<tr>
					<td class="col-md-8" align="right">
						<p class="lead">Payment Methods</p>
					</td>
					<td class="col-md-4"></td>
					</tr>
					<tr>
					<td class="col-md-8" align="right">
						<input type="checkbox" id="credit" name="credit"> <strong>Credit card:</strong>
					</td>
					<td class="col-md-4" id="creditInput"></td>
					</tr>
					<tr>
					<td class="col-md-8" align="right">
						<input type="checkbox" id="debit" name="debit"> <strong>Debit card:</strong>
					</td>
					<td class="col-md-4" id="debitInput"></td>
					</tr>
					<tr>
					<td class="col-md-8" align="right">
						<input type="checkbox" id="cash" name="cash"> <strong>Cash:</strong>
					</td>
					<td class="col-md-4" id="cashInput"></td>
					</tr>
					<tr>
					<td class="col-md-8" align="right">
						<input type="checkbox" id="bank" name="bank"> <strong>Bank Transfer:</strong>
					</td>
					<td class="col-md-4" id="bankInput"></td>
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
@stop
@section('js')
<script>

</script>
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
    $("#service").change(function(){
			var value = this.value;
			if (value == 'Flight') {
				var data = '<div class="row">		<div class="col-md-4">		<div class="form-group">			<label for="airline_name">Airline Name</label>			<input type="text" name="airline_name" required class="form-control">		</div>		</div>		<div class="col-md-4">		<div class="form-group">			<label for="source">Source</label>			<input type="text" name="source" class="form-control">		</div>		</div>		<div class="col-md-4">		<div class="form-group">			<label for="destination">Destination</label>			<input type="text" name="destination" required class="form-control">		</div>		</div>		</div><div class="row">		<div class="col-md-3">		<div class="form-group">			<label for="date">Date</label>			<input type="date" name="date" required class="form-control">		</div>		</div>		<div class="col-md-2">		<div class="form-group">			<label for="adult">Adult</label>			<input type="text" name="adult" class="form-control">		</div>		</div>		<div class="col-md-2">		<div class="form-group">			<label for="child">Child</label>			<input type="text" name="child" required class="form-control">		</div>		</div>		<div class="col-md-2">				<div class="form-group">					<label for="infant">Infant</label>					<input type="text" name="infant" required class="form-control">				</div>				</div>	<div class="col-md-3">		<div class="form-group">			<label for="infant_dob">Infant DOB</label>			<input type="date" name="infant_dob" required class="form-control">		</div>		</div>	</div><div class="row">		<div class="col-md-3">		<div class="form-group">	<label for="quantity">Quantity</label>		<input type="text" id="quantity" name="quantity[]" required class="form-control">		</div>		</div>		<div class="col-md-3">			<div class="form-group">	<label for="currency">Currency</label>		<select name="currency[]" class="form-control" id="currency">				<option value="$">$</option>				<option value="&#163;" selected>&#163;</option>			</select>			</div>		</div>		<div class="col-md-3">			<div class="form-group">	<label for="price">Price</label>		<input id="price" type="text" name="price[]" required class="form-control">			</div>		</div>		<div class="col-md-3">			<div class="form-group">	<label for="amount">Amount</label>		<input id="amount" type="text" name="amount[]" required class="form-control" readonly>			</div>		</div></div>';		
						$("#Insert").html(data);
			}
			if (value == 'Visa Services') {
				var data = '<div class="row">		<div class="col-md-6">		<div class="form-group">			<label for="name_of_visa_applicant">Name Of Visa Applicant</label>			<input type="text" name="name_of_visa_applicant" required class="form-control">		</div>		</div>		<div class="col-md-6">		<div class="form-group">			<label for="passport_origin">Passport Origin</label>			<input type="text" name="passport_origin" class="form-control">		</div>		</div>		</div>		<div class="row">				<div class="col-md-4">				<div class="form-group">					<label for="visa_country">Visa Country</label>					<input type="text" name="visa_country" required class="form-control">				</div>				</div>				<div class="col-md-4">				<div class="form-group">					<label for="visa_type">Visa Type</label>					<input type="text" name="visa_type" class="form-control">				</div>				</div>				<div class="col-md-4">						<div class="form-group">							<label for="visa_charges">Visa Charges</label>							<input charges="text" name="visa_type" class="form-control">						</div>						</div>				</div><div class="row">		<div class="col-md-3">		<div class="form-group">	<label for="quantity">Quantity</label>		<input type="text" id="quantity" name="quantity[]" required class="form-control">		</div>		</div>		<div class="col-md-3">			<div class="form-group">	<label for="currency">Currency</label>		<select name="currency[]" class="form-control" id="currency">				<option value="$">$</option>				<option value="&#163;" selected>&#163;</option>			</select>			</div>		</div>		<div class="col-md-3">			<div class="form-group">	<label for="price">Price</label>		<input id="price" type="text" name="price[]" required class="form-control">			</div>		</div>		<div class="col-md-3">			<div class="form-group">	<label for="amount">Amount</label>		<input id="amount" type="text" name="amount[]" required class="form-control" readonly>			</div>		</div></div>';
				$("#Insert").html(data);
			}
			})
		});
	$(document).ready(function(){
    $("#add").click(function(){
    	var options1 = "";
    		@if($products->count()>0)
				@foreach($products as $product)
				options1 = options1 + "<option value='{{$product->service}}'>{{$product->service}}</option>";
				@endforeach
			@endif
		var options2 = "";
		@if($airlines->count()>0)
			@foreach($airlines as $airline)
			options2 = options2 + "<option value='{{$airline->name}}'>{{$airline->name}}</option>";
			@endforeach
		@endif
		var currency = document.getElementById('currency').value;
    	var append = '<tr id="row"><td><select required name="item_name[]" class="form-control" id=""><option value="">--select--</option>'+options1+'</select></td><td><select required name="item_subname[]" class="form-control" id=""><option value="">--select--</option>'+options2+'</select></td><td><input type="text" name="quantity[]" id="quantity" required class="form-control"></td><td><select name="currency[]" class="form-control" id=""><option value='+currency+'>'+currency+'</option></select></td><td><input type="text" name="price[]" id="price" required class="form-control"></td><td><input id="amount" type="text" name="amount[]" required class="form-control" readonly></td></tr>';
        $("#target").append(append);   
        });
    });

    $(document).ready(function(){
    $("#targetTotal").hover(function(){
    	
    	for (var i = 0; i < document.getElementsByName("price[]").length; i++) {
    		var actual_amount = document.getElementsByName("price[]")[i].value * document.getElementsByName("quantity[]")[i].value;
    		document.getElementsByName("amount[]")[i].value =document.getElementsByName("currency[]")[i].value+actual_amount;
    		
    	}
    	
    });
    });

    $(document).ready(function(){
    $("#targetTotal").hover(function(){
    	var total_amount = 0;
    	for (var i = 0; i < document.getElementsByName("amount[]").length; i++) {
    		var total_amount = total_amount + (document.getElementsByName("price[]")[i].value * document.getElementsByName("quantity[]")[i].value);
    	}
		document.getElementsByName("total")[0].value =document.getElementsByName("currency[]")[0].value+total_amount;
		var discounted = total_amount - document.getElementsByName("discount")[0].value
		document.getElementsByName("discounted_total")[0].value =document.getElementsByName("currency[]")[0].value+ discounted;
    });
    });

    $(document).ready(function(){
    $("#credit").click(function(){
    	var input = '<input name="credit_amount" type="text" class="form-control">';
    	$("#creditInput").html(input);
    });
	});
	$(document).ready(function(){
    $("#debit").click(function(){
    	var input = '<input name="debit_amount" type="text" class="form-control">';
    	$("#debitInput").html(input);
    });
	});
	$(document).ready(function(){
    $("#cash").click(function(){
    	var input = '<input name="cash_amount" type="text" class="form-control">';
    	$("#cashInput").html(input);
    });
	});
	$(document).ready(function(){
    $("#bank").click(function(){
    	var input = '<input name="bank_amount" type="text" class="form-control">';
    	$("#bankInput").html(input);
    });
	});

    $(document).ready(function(){
    $("#client").change(function(){
    	var client_id = this.value;
    	@foreach($clients as $client)
    		var test = {{$client->id}};
	    	if (client_id == test) {
	    		var address = '{{$client->address}}';
	    		var city = '{{$client->city}}';
	    		var postal_code = '{{$client->postal_code}}';
	    		var county = '{{$client->county}}';
	    		var country = '{{$client->country}}';
	    	}
    	@endforeach
    	var append = '<textarea name="billing_address" required class="form-control" placeholder="Enter Billing Adress">'+address+'&#13;&#10;'+city+'&#13;&#10;'+postal_code+'&#13;&#10;'+county+'&#13;&#10;'+country+'</textarea>';
    	$("#address").html(append);   
    	});
    });
		
   	</script>


	<script>
        function myCreateFunction() {
            var table = document.getElementById("myTable");
            var row = table.insertRow(3);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);
            var cell6 = row.insertCell(5);
            var cell7 = row.insertCell(6);
            var cell8 = row.insertCell(7);
            var cell9 = row.insertCell(8);
            var cell10 = row.insertCell(9);
            var cell11 = row.insertCell(10);
            var cell12 = row.insertCell(11);

            var row_second = table.insertRow(4);
            var cell01 = row_second.insertCell(0);
            var cell02 = row_second.insertCell(1);
            var cell03 = row_second.insertCell(2);
            var cell04 = row_second.insertCell(3);
            var cell05 = row_second.insertCell(4);
            var cell06 = row_second.insertCell(5);
            var cell07 = row_second.insertCell(6);
            var cell08 = row_second.insertCell(7);
            var cell09 = row_second.insertCell(8);
            var cell010 = row_second.insertCell(9);
            var cell011 = row_second.insertCell(10);
            var cell012 = row_second.insertCell(11);

            cell1.innerHTML = '2';
            cell2.innerHTML = '<select class="form-control select-custom custom-select">\n' +
                '              <option value="Adult">Adult</option>\n' +
                '              <option value="Youth">Youth</option>\n' +
                '              <option value="Child">Child</option>\n' +
                '              <option value="Infant">Infant</option>\n' +
                '            </select>';
            cell3.innerHTML = '<input type="text" value="Harnam" class="form-control">';
            cell4.innerHTML = '<input type="text" value="Singh" class="form-control">';
            cell5.innerHTML = '<input type="text" placeholder="dd/mm/yyyy" value="" class="form-control">';
            cell6.innerHTML = 'Segment-1';
            cell7.innerHTML = '<input type="text" value="0" class="form-control" style="width:60px;">';
            cell8.innerHTML = '<input type="text" value="0" class="form-control" style="width:60px;">';
            cell9.innerHTML = '<input type="text" value="0" class="form-control" style="width:60px;">';
            cell10.innerHTML = '<input type="text" value="0" class="form-control" style="width:60px;">';
            cell11.innerHTML = '<input type="text" value="0" class="form-control" style="width:60px;">';
            cell12.innerHTML = '<a href="javascript:void(0)" class="fa fa-remove text-danger" onclick="myDeleteFunction()"></a>';

            cell01.innerHTML = '&nbsp';
            cell02.innerHTML = '&nbsp';
            cell03.innerHTML = '&nbsp';
            cell04.innerHTML = '&nbsp';
            cell05.innerHTML = '&nbsp';
            cell06.innerHTML = 'Segment-2';
            cell07.innerHTML = '<input type="text" value="0" class="form-control" style="width:60px;">';
            cell08.innerHTML = '<input type="text" value="0" class="form-control" style="width:60px;">';
            cell09.innerHTML = '<input type="text" value="0" class="form-control" style="width:60px;">';
            cell010.innerHTML = '<input type="text" value="0" class="form-control" style="width:60px;">';
            cell011.innerHTML = '<input type="text" value="0" class="form-control" style="width:60px;">';
            cell012.innerHTML = '&nbsp';
        }

        function myDeleteFunction() {
            document.getElementById("myTable").deleteRow(4);
            document.getElementById("myTable").deleteRow(3);
        }

	</script>
@stop

		

{{-- <div class="row">
		<div class="col-md-4">
		<div class="form-group">
			<label for="first_name">First Name</label>
			<input type="text" name='first_name' required class="form-control">
		</div>
		</div>
		<div class="col-md-4">
		<div class="form-group">
			<label for="middle_name">Middle Name</label>
			<input type="text" name='middle_name' class="form-control">
		</div>
		</div>
		<div class="col-md-4">
		<div class="form-group">
			<label for="last_name">Last Name</label>
			<input type="text" name='last_name' required class="form-control">
		</div>
		</div>
		</div>
		<div class="row">
		<div class="col-md-6">
		<div class="form-group">
			<label for="father_name">Father's Name</label>
			<input type="text" name='father_name' class="form-control" >
		</div>
		</div>
		<div class="col-md-6">
		<div class="form-group">
			<label for="mother_name">Mother's Name</label>
			<input type="text" name='mother_name' class="form-control">
		</div>
		</div>
		</div>
		
		
</div> --}}