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
		<div id="target">
			<div class="box box-primary">
			<div class="box-body">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="service_name[]">Select Service</label>
								<select name="service_name[]" class="form-control service"required onChange="SelectService(this);">
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
					<div class="Insert"></div>
				</div>
				</div>
			</div>
			<div class="text-center"  style="margin-top: 5px">
				<button class="btn btn-success btn-sm"  type="button" id="add">Add Service</button><br><br>
			</div>
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
    $("#add").click(function(){
    	var append = '<div class="box box-primary">			<div class="box-body">					<div class="row">						<div class="col-md-4">							<div class="form-group">								<label for="service_name[]">Select Service</label>								<select name="service_name[]" class="form-control service" onChange="SelectService(this);" required>										<option value="">--select--</option>										@if($products->count()>0)										@foreach($products as $product)											<option value="{{$product->service}}">{{$product->service}}</option>										@endforeach										@endif								</select>							</div>						</div>					</div>	<div class="Insert"></div>		<div align="right">						<input type="button" class="btn btn-danger btn-xs" value="Remove" onclick="SomeDeleteRowFunction(this);">					</div>	</div>				</div>';
        $("#target").append(append);   
        });
    });
	function SomeDeleteRowFunction(btndel) {
    if (typeof(btndel) == "object") {
        $(btndel).closest('.box').remove();
    } else {
        return false;
    }}
    function SelectService(test){
			var value = test.value;
			if (value == 'Flight') {
				var data = '<div class="box-body"> <div class="row">			<div class="col-md-4">				<div class="form-group">					<label for="service_name[]">Select Service</label>					<select name="service_name[]" class="form-control service" required onChange="SelectService(this);">							<option value="">--select--</option>							@if($products->count()>0)							@foreach($products as $product)								<option value="{{$product->service}}" {{($product->service == "Flight")?"selected":''}}>{{$product->service}}</option>							@endforeach							@endif					</select>				</div>			</div>		</div><div class="row">		<div class="col-md-4">		<div class="form-group">			<label for="airline_name">Airline Name</label>			<input type="text" name="airline_name" required class="form-control">		</div>		</div>		<div class="col-md-4">		<div class="form-group">			<label for="source">Source</label>			<input type="text" name="source" class="form-control">		</div>		</div>		<div class="col-md-4">		<div class="form-group">			<label for="destination">Destination</label>			<input type="text" name="destination" required class="form-control">		</div>		</div>		</div><div class="row">		<div class="col-md-3">		<div class="form-group">			<label for="date">Date</label>			<input type="date" name="date" required class="form-control">		</div>		</div>		<div class="col-md-2">		<div class="form-group">			<label for="adult">Adult</label>			<input type="text" name="adult" class="form-control">		</div>		</div>		<div class="col-md-2">		<div class="form-group">			<label for="child">Child</label>			<input type="text" name="child" required class="form-control">		</div>		</div>		<div class="col-md-2">				<div class="form-group">					<label for="infant">Infant</label>					<input type="text" name="infant" required class="form-control">				</div>				</div>	<div class="col-md-3">		<div class="form-group">			<label for="infant_dob">Infant DOB</label>			<input type="date" name="infant_dob" required class="form-control">		</div>		</div>	</div><div class="row">		<div class="col-md-3">		<div class="form-group">	<label for="quantity">Quantity</label>		<input type="text" id="quantity" name="quantity[]" required class="form-control" onKeyUp="FlightAmount()">		</div>		</div>		<div class="col-md-3">			<div class="form-group">	<label for="currency">Currency</label>		<select name="currency[]" class="form-control" id="currency">				<option value="$">$</option>				<option value="&#163;" selected>&#163;</option>			</select>			</div>		</div>		<div class="col-md-3">			<div class="form-group">	<label for="price">Price</label>		<input id="price" type="text" name="price[]" required class="form-control" onKeyUp="FlightAmount()">			</div>		</div>		<div class="col-md-3">			<div class="form-group">	<label for="amount">Amount</label>		<input id="amount" type="text" name="amount[]" required class="form-control" readonly>			</div>		</div></div><div align="right">						<input type="button" class="btn btn-danger btn-xs" value="Remove" onclick="SomeDeleteRowFunction(this);">					</div>	</div>				</div></div>';		
				$(test).closest(".box").html(data);
			}
			if (value == 'Visa Services') {
				var data = '<div class="box-body"> <div class="row">			<div class="col-md-4">				<div class="form-group">					<label for="service_name[]">Select Service</label>					<select name="service_name[]" class="form-control service" required onChange="SelectService(this);">							<option value="">--select--</option>							@if($products->count()>0)							@foreach($products as $product)								<option value="{{$product->service}}" {{($product->service == "Visa Services")?"selected":''}}>{{$product->service}}</option>							@endforeach							@endif					</select>				</div>			</div>		</div><div class="row">	<div class="col-md-6">		<div class="form-group">			<label for="name_of_visa_applicant">Name Of Visa Applicant</label>			<input type="text" name="name_of_visa_applicant" required class="form-control">		</div>		</div>		<div class="col-md-6">		<div class="form-group">			<label for="passport_origin">Passport Origin</label>			<input type="text" name="passport_origin" class="form-control">		</div>		</div>		</div>		<div class="row">				<div class="col-md-4">				<div class="form-group">					<label for="visa_country">Visa Country</label>					<input type="text" name="visa_country" required class="form-control">				</div>				</div>				<div class="col-md-4">				<div class="form-group">					<label for="visa_type">Visa Type</label>					<input type="text" name="visa_type" class="form-control">				</div>				</div>				<div class="col-md-4">						<div class="form-group">							<label for="visa_charges[]">Visa Fee</label>							<input type="text" name="visa_charges[]" class="form-control" onKeyUp="VisaAmount()">						</div>						</div>				</div><div class="row">				<div class="col-md-4">			<div class="form-group">	<label for="currency">Currency</label>		<select name="currency[]" class="form-control" id="currency">				<option value="$">$</option>				<option value="&#163;" selected>&#163;</option>			</select>			</div>		</div>		<div class="col-md-4">			<div class="form-group">	<label for="service_charge[]">Service Charge</label>		<input id="service_charge" type="text" name="service_charge[]" required class="form-control" onKeyUp="VisaAmount()">			</div>		</div>		<div class="col-md-4">			<div class="form-group">	<label for="amount">Amount</label>		<input id="amount" type="text" name="amount[]" required class="form-control" readonly>			</div>		</div></div><div align="right">						<input type="button" class="btn btn-danger btn-xs" value="Remove" onclick="SomeDeleteRowFunction(this);">					</div>	</div>				</div></div>';
				$(test).closest(".box").html(data);
			}
			if (value == 'Hotel') {
				var data = '<div class="box-body"> <div class="row">			<div class="col-md-4">				<div class="form-group">					<label for="service_name[]">Select Service</label>					<select name="service_name[]" class="form-control service" required onChange="SelectService(this);">							<option value="">--select--</option>							@if($products->count()>0)							@foreach($products as $product)								<option value="{{$product->service}}" {{($product->service == "Hotel")?"selected":''}}>{{$product->service}}</option>							@endforeach							@endif					</select>				</div>			</div>		</div> <div class="row">		<div class="col-md-6">		<div class="form-group">			<label for="hotel_city">City</label>			<input type="text" name="hotel_city" required class="form-control">		</div>		</div>		<div class="col-md-6">		<div class="form-group">			<label for="hotel_country">Country</label>			<input type="text" name="hotel_country" class="form-control">		</div>		</div>		</div>		<div class="row">		<div class="col-md-4">		<div class="form-group">			<label for="hotel_name">Name</label>			<input type="text" name="hotel_name" required class="form-control">		</div>		</div>		<div class="col-md-4">		<div class="form-group">			<label for="check_in_date">Check In Date</label>			<input type="date" name="check_in_date" required class="form-control">		</div>		</div>		<div class="col-md-4">		<div class="form-group">			<label for="check_out_date">Check Out Date</label>			<input type="date" name="check_out_date" required class="form-control">		</div>		</div>		</div>		<div class="row">		<div class="col-md-3">		<div class="form-group">			<label for="no_of_children">No. Of Children</label>			<input type="text" name="no_of_children" class="form-control" >		</div>		</div>		<div class="col-md-3">		<div class="form-group">			<label for="no_of_rooms">No. Of Rooms</label>			<input type="text" name="no_of_rooms" class="form-control">		</div>		</div>	<div class="col-md-3">			<div class="form-group">	<label for="currency">Currency</label>		<select name="currency[]" class="form-control" id="currency">				<option value="$">$</option>				<option value="&#163;" selected>&#163;</option>			</select>			</div>		</div>	<div class="col-md-3">		<div class="form-group">			<label for="amount[]">Amount</label>			<input type="text" name="amount[]" class="form-control">		</div>		</div>		</div>			</div>		</div></div><div align="right">						<input type="button" class="btn btn-danger btn-xs" value="Remove" onclick="SomeDeleteRowFunction(this);">					</div>	</div>				</div></div>';		
				$(test).closest(".box").html(data);
			}
			if (value == 'Insurance') {
				var data = '<div class="box-body"> <div class="row">			<div class="col-md-4">				<div class="form-group">					<label for="service_name[]">Select Service</label>					<select name="service_name[]" class="form-control service" required onChange="SelectService(this);">							<option value="">--select--</option>							@if($products->count()>0)							@foreach($products as $product)								<option value="{{$product->service}}" {{($product->service == "Insurance")?"selected":''}}>{{$product->service}}</option>							@endforeach							@endif					</select>				</div>			</div>		</div><div class="row">	<div class="col-md-4">		<div class="form-group">			<label for="name_of_insurance_applicant">Name Of Insurance Applicant</label>			<input type="text" name="name_of_insurance_applicant" required class="form-control">		</div>		</div>		<div class="col-md-4">		<div class="form-group">			<label for="insurance_remarks">Passport Origin</label>			<input type="text" name="insurance_remarks" class="form-control">		</div>		</div>						<div class="col-md-4">				<div class="form-group">					<label for="amount[]">Insurance Amount</label>					<input type="text" name="amount[]" required class="form-control">				</div>				</div>				</div><div align="right">						<input type="button" class="btn btn-danger btn-xs" value="Remove" onclick="SomeDeleteRowFunction(this);">					</div>	</div>				</div></div>';
				$(test).closest(".box").html(data);
			}
			if (value == 'Local Sight Sceen') {
				var data = '<div class="box-body"> <div class="row">			<div class="col-md-4">				<div class="form-group">					<label for="service_name[]">Select Service</label>					<select name="service_name[]" class="form-control service" required onChange="SelectService(this);">							<option value="">--select--</option>							@if($products->count()>0)							@foreach($products as $product)								<option value="{{$product->service}}" {{($product->service == "Local Sight Sceen")?"selected":''}}>{{$product->service}}</option>							@endforeach							@endif					</select>				</div>			</div>		</div><div class="row">	<div class="col-md-6">		<div class="form-group">			<label for="local_sight_sceen_remarks">Local Sight Sceen Remarks</label>			<input type="text" name="local_sight_sceen_remarks" required class="form-control">		</div>		</div>		<div class="col-md-6">				<div class="form-group">					<label for="amount[]">Sight Sceen Charges</label>					<input type="text" name="amount[]" required class="form-control">				</div>				</div>				</div><div align="right">						<input type="button" class="btn btn-danger btn-xs" value="Remove" onclick="SomeDeleteRowFunction(this);">					</div>	</div>				</div></div>';
				$(test).closest(".box").html(data);
			}
			if (value == 'Local Transport') {
				var data = '<div class="box-body"> <div class="row">			<div class="col-md-4">				<div class="form-group">					<label for="service_name[]">Select Service</label>					<select name="service_name[]" class="form-control service" required onChange="SelectService(this);">							<option value="">--select--</option>							@if($products->count()>0)							@foreach($products as $product)								<option value="{{$product->service}}" {{($product->service == "Local Transport")?"selected":''}}>{{$product->service}}</option>							@endforeach							@endif					</select>				</div>			</div>		</div><div class="row">	<div class="col-md-6">		<div class="form-group">			<label for="local_transport_remarks">Local Transport Remarks</label>			<input type="text" name="local_transport_remarks" required class="form-control">		</div>		</div>		<div class="col-md-6">				<div class="form-group">					<label for="amount[]">Transport Charges</label>					<input type="text" name="amount[]" required class="form-control">				</div>				</div>				</div><div align="right">						<input type="button" class="btn btn-danger btn-xs" value="Remove" onclick="SomeDeleteRowFunction(this);">					</div>	</div>				</div></div>';
				$(test).closest(".box").html(data);
			}
			if (value == 'Car Rental') {
				var data = '<div class="box-body"> <div class="row">			<div class="col-md-4">				<div class="form-group">					<label for="service_name[]">Select Service</label>					<select name="service_name[]" class="form-control service" required onChange="SelectService(this);">							<option value="">--select--</option>							@if($products->count()>0)							@foreach($products as $product)								<option value="{{$product->service}}" {{($product->service == "Car Rental")?"selected":''}}>{{$product->service}}</option>							@endforeach							@endif					</select>				</div>			</div>		</div><div class="row">	<div class="col-md-6">		<div class="form-group">			<label for="car_rental_remarks">Car Rental Remarks</label>			<input type="text" name="car_rental_remarks" required class="form-control">		</div>		</div>		<div class="col-md-6">				<div class="form-group">					<label for="amount[]">Car Rental Charges</label>					<input type="text" name="amount[]" required class="form-control">				</div>				</div>				</div><div align="right">						<input type="button" class="btn btn-danger btn-xs" value="Remove" onclick="SomeDeleteRowFunction(this);">					</div>	</div>				</div></div>';
				$(test).closest(".box").html(data);
			}
			if (value == 'Other Facilities') {
				var data = '<div class="box-body"> <div class="row">			<div class="col-md-4">				<div class="form-group">					<label for="service_name[]">Select Service</label>					<select name="service_name[]" class="form-control service" required onChange="SelectService(this);">							<option value="">--select--</option>							@if($products->count()>0)							@foreach($products as $product)								<option value="{{$product->service}}" {{($product->service == "Other Facilities")?"selected":''}}>{{$product->service}}</option>							@endforeach							@endif					</select>				</div>			</div>		</div><div class="row">	<div class="col-md-6">		<div class="form-group">			<label for="other_facilities_remarks">Other Facilities Remarks</label>			<input type="text" name="other_facilities_remarks" required class="form-control">		</div>		</div>		<div class="col-md-6">				<div class="form-group">					<label for="amount[]">Other Facilities Charges</label>					<input type="text" name="amount[]" required class="form-control">				</div>				</div>				</div><div align="right">						<input type="button" class="btn btn-danger btn-xs" value="Remove" onclick="SomeDeleteRowFunction(this);">					</div>	</div>				</div></div>';
				$(test).closest(".box").html(data);
			}
			if (value == '') {
				var data = '';
				$(test).closest(".box").html(data);
			}
		}

	function FlightAmount(){
		for (var i = 0; i < document.getElementsByName("price[]").length; i++) {
    		var actual_amount = document.getElementsByName("price[]")[i].value * document.getElementsByName("quantity[]")[i].value;
     		document.getElementsByName("amount[]")[i].value =document.getElementsByName("currency[]")[i].value+actual_amount;
    		
    	}
	}

	function VisaAmount(){
		for (var i = 0; i < document.getElementsByName("service_charge[]").length; i++) {
    		var actual_amount = document.getElementsByName("service_charge[]")[i].value - (-document.getElementsByName("visa_charges[]")[i].value);
     		document.getElementsByName("amount[]")[i].value =document.getElementsByName("currency[]")[i].value+actual_amount;
    		
    	}
	}

    // $(document).ready(function(){
    // $("#targetTotal").hover(function(){
    	
    // 	for (var i = 0; i < document.getElementsByName("price[]").length; i++) {
    // 		var actual_amount = document.getElementsByName("price[]")[i].value * document.getElementsByName("quantity[]")[i].value;
    // 		document.getElementsByName("amount[]")[i].value =document.getElementsByName("currency[]")[i].value+actual_amount;
    		
    // 	}
    	
    // });
    // });

    // $(document).ready(function(){
    // $("#targetTotal").hover(function(){
    // 	var total_amount = 0;
    // 	for (var i = 0; i < document.getElementsByName("amount[]").length; i++) {
    // 		var total_amount = total_amount + (document.getElementsByName("price[]")[i].value * document.getElementsByName("quantity[]")[i].value);
    // 	}
	// 	document.getElementsByName("total")[0].value =document.getElementsByName("currency[]")[0].value+total_amount;
	// 	var discounted = total_amount - document.getElementsByName("discount")[0].value
	// 	document.getElementsByName("discounted_total")[0].value =document.getElementsByName("currency[]")[0].value+ discounted;
    // });
    // });

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
@stop

		

{{-- <div class="row">
		<div class="col-md-6">
		<div class="form-group">
			<label for="hotel_city">City</label>
			<input type="text" name='hotel_city' required class="form-control">
		</div>
		</div>
		<div class="col-md-6">
		<div class="form-group">
			<label for="hotel_country">Country</label>
			<input type="text" name='hotel_country' class="form-control">
		</div>
		</div>
		</div>
		<div class="row">
		<div class="col-md-4">
		<div class="form-group">
			<label for="hotel_name">Name</label>
			<input type="text" name='hotel_name' required class="form-control">
		</div>
		</div>
		<div class="col-md-4">
		<div class="form-group">
			<label for="check_in_date">Check In Date</label>
			<input type="date" name='check_in_date' required class="form-control">
		</div>
		</div>
		<div class="col-md-4">
		<div class="form-group">
			<label for="check_out_date">Check Out Date</label>
			<input type="date" name='check_out_date' required class="form-control">
		</div>
		</div>
		</div>
		<div class="row">
		<div class="col-md-4">
		<div class="form-group">
			<label for="no_of_children">No. Of Children</label>
			<input type="text" name='no_of_children' class="form-control" >
		</div>
		</div>
		<div class="col-md-4">
		<div class="form-group">
			<label for="no_of_rooms">No. Of Rooms</label>
			<input type="text" name='no_of_rooms' class="form-control">
		</div>
		</div>
		<div class="col-md-4">
		<div class="form-group">
			<label for="amount[]">Amount</label>
			<input type="text" name='amount[]' class="form-control">
		</div>
		</div>
		</div>
 --}}