@extends('layouts.frontend')
@section('title')
Create Invoice
@endsection
@section('css')
<style>

    /* The search field when it gets focus/clicked on */
    #myInput:focus {outline: 3px solid #ddd;}


    /* Dropdown Content (Hidden by Default) */
    .dropdown-content {
    display: block;
    position:absolute;
    background-color: #f6f6f6;
    min-width: 220px;
    border: 1px solid #ddd;
    z-index: 1;
    }

    /* Links inside the dropdown */
    .dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    }

    /* Change color of dropdown links on hover */
    .dropdown-content a:hover {background-color: #f1f1f1}

</style>

<style>

    /* The search field when it gets focus/clicked on */
    #myInputTwo:focus {outline: 3px solid #ddd;}


    /* Dropdown Content (Hidden by Default) */
    .dropdown-content-two {
    display: block;
    position:absolute;
    background-color: #f6f6f6;
    min-width: 220px;
    border: 1px solid #ddd;
    z-index: 1;
    }

    /* Links inside the dropdown */
    .dropdown-content-two a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    }

    /* Change color of dropdown links on hover */
    .dropdown-content-two a:hover {background-color: #f1f1f1}

</style>

	<style>

		/* The search field when it gets focus/clicked on */
		#AirportmyInput:focus {outline: 3px solid #ddd;}


		/* Dropdown Content (Hidden by Default) */
		.Airportdropdown-content {
		display: block;
		position:absolute;
		background-color: #f6f6f6;
		min-width: 220px;
		border: 1px solid #ddd;
		z-index: 1;
		}

		/* Links inside the dropdown */
		.Airportdropdown-content a {
		color: black;
		padding: 12px 16px;
		text-decoration: none;
		display: block;
		}

		/* Change color of dropdown links on hover */
		.Airportdropdown-content a:hover {background-color: #f1f1f1}

    </style>

<style>

    /* The search field when it gets focus/clicked on */
    #AirportmyInputTwo:focus {outline: 3px solid #ddd;}


    /* Dropdown Content (Hidden by Default) */
    .Airportdropdown-content-two {
    display: block;
    position:absolute;
    background-color: #f6f6f6;
    min-width: 220px;
    border: 1px solid #ddd;
    z-index: 1;
    }

    /* Links inside the dropdown */
    .Airportdropdown-content-two a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    }

    /* Change color of dropdown links on hover */
    .Airportdropdown-content-two a:hover {background-color: #f1f1f1}

</style>

	<style>

		/* The search field when it gets focus/clicked on */
		#AirportArrivalmyInput:focus {outline: 3px solid #ddd;}


		/* Dropdown Content (Hidden by Default) */
		.AirportArrivaldropdown-content {
		display: block;
		position:absolute;
		background-color: #f6f6f6;
		min-width: 220px;
		border: 1px solid #ddd;
		z-index: 1;
		}

		/* Links inside the dropdown */
		.AirportArrivaldropdown-content a {
		color: black;
		padding: 12px 16px;
		text-decoration: none;
		display: block;
		}

		/* Change color of dropdown links on hover */
		.AirportArrivaldropdown-content a:hover {background-color: #f1f1f1}

    </style>
    <style>

		/* The search field when it gets focus/clicked on */
		#AirportArrivalmyInputTwo:focus {outline: 3px solid #ddd;}


		/* Dropdown Content (Hidden by Default) */
		.AirportArrivaldropdown-content-two {
		display: block;
		position:absolute;
		background-color: #f6f6f6;
		min-width: 220px;
		border: 1px solid #ddd;
		z-index: 1;
		}

		/* Links inside the dropdown */
		.AirportArrivaldropdown-content-two a {
		color: black;
		padding: 12px 16px;
		text-decoration: none;
		display: block;
		}

		/* Change color of dropdown links on hover */
		.AirportArrivaldropdown-content-two a:hover {background-color: #f1f1f1}

	</style>
@stop
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
							{{-- <div class="AirportArrivaldropdown">
							<div id="AirportArrivalmyDropdown" class="AirportArrivaldropdown-content">
								<input type="text" placeholder="Search.." name="destination" id="AirportArrivalmyInput" onkeyup="AirportArrivalDataExtract(this)"  required class="form-control">
								<div id="airportArrival_html"></div>
							</div>
							</div> --}}


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
						<textarea name="billing_address"  required class="form-control" placeholder="Enter Billing Adress"></textarea>
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
					<td class="col-md-8" align="right"><strong>Currency:</strong></td>
					<td class="col-md-4">
					<select name="currency" class="form-control" id="currency">
						<option value="$">$</option>
						<option value="&#163;" selected>&#163;</option>
					</select>
					</td>
				</tr>
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
						<strong>Credit card:</strong>
					</td>
					<td class="col-md-4" id="creditInput"><input name="credit_amount" type="text" value="0" class="form-control"></td>
					</tr>
					<tr>
					<td class="col-md-8" align="right">
						<strong>Debit card:</strong>
					</td>
					<td class="col-md-4" id="debitInput"><input name="debit_amount" type="text" value="0" class="form-control"></td>
					</tr>
					<tr>
					<td class="col-md-8" align="right">
						<strong>Cash:</strong>
					</td>
					<td class="col-md-4" id="cashInput"><input name="cash_amount" type="text" value="0" class="form-control"></td>
					</tr>
					<tr>
					<td class="col-md-8" align="right">
						<strong>Bank Transfer:</strong>
					</td>
					<td class="col-md-4" id="bankInput"><input name="bank_amount" type="text" value="0" class="form-control"></td>
					</tr>
				</table>
			</div>
		</div>

			<div class="form-group">
			<div class="text-center">
				<button class="btn btn-primary" type="submit">Create</button>
				<div id="daalo"></div>
			</div>
			</div>
	</form>

@stop
@section('js')
<script>

</script>
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script type="text/javascript">
		$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
		</script>
	<script type="text/javascript">
		function ChildAppend(test){
			// console.log(test.value);
			// if($(test).prop("checked") == true){
			// 	var data='';
			// $(test).closest(".box-body").append(data);
			// }
			// else{
			// 	$(test).closest(".box-body").append(data);
			// }
			var box = $(test).closest(".box-body");
			box.find('#child-nikaalo').toggle();

		}

		function InfantAppend(test){
			var box = $(test).closest(".box-body");
			box.find('#infant-nikaalo').toggle();
		}



	  function filterFunction() {
		var input, filter, ul, li, a, i;
		input = document.getElementById("myInput");
		filter = input.value.toUpperCase();
		div = document.getElementById("myDropdown");
		a = div.getElementsByTagName("a");
		for (i = 0; i < a.length; i++) {
		  txtValue = a[i].textContent || a[i].innerText;
		  if (txtValue.toUpperCase().indexOf(filter) > -1) {
			a[i].style.display = "";
		  } else {
			a[i].style.display = "none";
		  }
		}
	  }

	function AirlineAssign(temp){
		var div = $(temp).closest(".dropdown-content");
		div.find('.airline-name').val(temp.value);
		$(temp).closest(".airline_html").html('');
	  }
	function AirportAssign(temp){
		var div = $(temp).closest(".Airportdropdown-content");
		div.find('.airport-name').val(temp.value);
		$(temp).closest(".airport_html").html('');
	}
	function AirportArrivalAssign(temp){
		var div = $(temp).closest(".AirportArrivaldropdown-content");
		div.find('.airport-arrival-name').val(temp.value);
		$(temp).closest(".airportArrival_html").html('');
	}


    function AirlineDataExtract(test){
        $value=test.value;
        $.ajax({
            type : 'get',
            url : '{{URL::to('searchAirline')}}',
            data:{'search':$value},
            success:function(data){
                $(test).next(".airline_html").html(data);
            }
        });
    }

    function AirportDataExtract(test){
        $value=test.value;
        $.ajax({
            type : 'get',
            url : '{{URL::to('searchAirport')}}',
            data:{'search':$value},
            success:function(data){
                $(test).next(".airport_html").html(data);
            }
        });
    }

    function AirportArrivalDataExtract(test){
        $value=test.value;
        $.ajax({
            type : 'get',
            url : '{{URL::to('searchAirportArrival')}}',
            data:{'search':$value},
            success:function(data){
                $(test).next(".airportArrival_html").html(data);
            }
        });
    }

	function findFamily(test){
		if (test.value != 'SELF') {
			var familyId = test.value;
			var Url = "http://buildatwill.com/cloud/public/find/family/"+ familyId;
			var xhr = new XMLHttpRequest();
			xhr.open('GET', Url, true);
			xhr.send();
			xhr.onreadystatechange = processRequest;
			function processRequest(e) {
					var response1 = JSON.parse(xhr.responseText);
					var div = $(test).closest(".box-body");
					div.find('.member_dob').val(response1['member_DOB']);
					div.find('.member_name').val(response1['member_name']);
					div.find('.passport_no').val(response1['member_passport_no']);
					div.find('.passport_origin').val(response1['member_passport_place']);
			}
		}
		else{
			var client_id = document.getElementById('client').value;
				@foreach($clients as $client)
				var fetched_client_id = {!! json_encode($client->id) !!}
			    	if(fetched_client_id == client_id){
							var div = $(test).closest(".box-body");
							div.find('.member_dob').val({!! json_encode($client->DOB) !!});
							var first_name = {!! json_encode($client->first_name)!!};
							var last_name = {!! json_encode($client->last_name)!!}
							div.find('.member_name').val(first_name+" "+last_name);
							div.find('.passport_no').val({!! json_encode($client->passport_no) !!});
							div.find('.passport_origin').val({!! json_encode($client->passport_place) !!});
						}
			  @endforeach
		}
	}




	$(document).ready(function(){
    $("#add").click(function(){
    	var append = '<div class="box box-primary">			<div class="box-body">					<div class="row">						<div class="col-md-4">							<div class="form-group">								<label for="service_name[]">Select Service</label>								<select name="service_name[]" class="form-control service" onChange="SelectService(this);" required>										<option value="">--select--</option>										@if($products->count()>0)										@foreach($products as $product)											<option value="{{$product->service}}">{{$product->service}}</option>										@endforeach										@endif								</select>							</div>						</div>					</div>	<div class="Insert"></div>		<div align="right">						<input type="button" class="btn btn-danger btn-xs" value="Remove" onclick="SomeDeleteRowFunction(this);">					</div>	</div>				</div>';
        $("#target").append(append);
        });
    });
    // $(document).ready(function(){
    // $("#add").click(function(){

    //     $("#target").append(append);
    //     });
    // });
	function SomeDeleteRowFunction(btndel) {
    if (typeof(btndel) == "object") {
        $(btndel).closest('.box').remove();
    } else {
        return false;
    }}
    function flight(){
        var data = '<div class="box-body"><div class="row">'+
				 			'<div class="col-md-4">				<div class="form-group">'+
				 			'<label for="service_name[]">Select Service</label>'+
				 			'<select name="service_name[]" class="form-control service" required onChange="SelectService(this);">'+
				 			'<option value="">--select--</option>							@if($products->count()>0)'+
				 			'@foreach($products as $product)	'+
				 			'<option value="{{$product->service}}" {{($product->service == "Flight")?"selected":''}}>{{$product->service}}</option>'+
				 			'@endforeach							@endif					</select>				</div>'+
				 			'</div>		</div>'+

    '<div class="table-responsive">'+
      '<table class="table table-bordered">'+
        '<thead>'+
'          <tr>'+
            '<th>Universal PNR </th>'+
            '<th>PNR </th>'+
            '<th>Agency PCC </th>'+
            '<th>Airline Ref </th>'+
          '</tr>'+
        '</thead>'+
        '<tbody>'+
          '<tr>'+
            '<td><input type="text" name="universal_pnr[]" class="form-control"></td>'+
            '<td><input type="text" name="pnr[]" class="form-control pnr" onKeyUp="pnr(this);"></td>'+
            '<td><input type="text" name="agency_pcc[]" class="form-control"></td>'+
            '<td><input type="text" name="airline_ref[]" class="form-control"></td>'+
          '</tr>'+
        '</tbody>'+
      '</table>'+
    '</div>'+

    '<div class="table-responsive">'+
      '<table class="table table-bordered">'+
        '<thead>'+
          '<tr>'+
            '<th>#</th>'+
            '<th width="250px">Flight</th>'+
            '<th width="250px">From</th>'+
            '<th width="250px">To</th>'+
            '<th>Carrier</th>'+
            '<th>Travel Class</th>'+
            // '<th>Departure</th>'+
            // '<th>Arrival</th>'+
          '</tr>'+
        '</thead>'+
        '<tbody>'+
          '<tr>'+
            '<th>Segment-1</th>'+
            '<td>'+
            '<div class="dropdown">	<div id="myDropdown" class="dropdown-content">'+
            '<input type="text" name="segment_one_flight[]" class="form-control airline-name" placeholder="Search..." id="myInput" onkeyup="AirlineDataExtract(this)">'+
            '<div class="airline_html"></div></div></div>'+
            '</td>'+
            '<td>'+
            '<div class="Airportdropdown">	<div id="AirportmyDropdown" class="Airportdropdown-content">'+
            '<input type="text" name="segment_one_from[]" class="form-control airport-name" placeholder="Search..." id="AirportmyInput" onkeyup="AirportDataExtract(this)">'+
            '<div class="airport_html"></div></div></div>'+
            '</td>'+
            '<td>'+
            '<div class="AirportArrivaldropdown">	<div id="AirportArrivalmyDropdown" class="AirportArrivaldropdown-content">'+
            '<input type="text" name="segment_one_to[]" class="form-control airport-arrival-name" placeholder="Search..." id="AirportArrivalmyInput" onkeyup="AirportArrivalDataExtract(this)">'+
            '<div class="airportArrival_html"></div></div></div>'+
            '</td>'+
            '<td><input type="text" name="segment_one_carrier[]" class="form-control" ></td>'+
            // '<td><input type="text" name="segment_one_class[]" class="form-control" ></td>'+
            // '<td><input type="text" name="segment_one_class[]" class="form-control" ></td>'+
            '<td><select name="segment_one_class[]" class="form-control service"required >'+
										'<option value="">--select--</option>'+
											'<option value="Economy class">Economy class</option>'+
											'<option value="Premium Economy class">Premium Economy class</option>'+
											'<option value="Business Class">Business Class</option>'+
											'<option value="First Class">First Class</option>'+

			'</select></td>'+
            // '<td><input type="datetime-local" name="segment_one_departure[]" class="form-control" ></td>'+
            // '<td><input type="datetime-local" name="segment_one_arrival[]" class="form-control" ></td>'+
          '</tr>'+
          '<tr>'+
            '<th>Departure:</th>'+
            '<td><input type="datetime-local" name="segment_one_departure[]" class="form-control" ></td>'+
            '<th align="right">Arrival:</th>'+
            '<td><input type="datetime-local" name="segment_one_arrival[]" class="form-control" ></td>'+
          '</tr>'+
          '<tr>'+
          '<td class="colspan-6"></td>'+
          '</tr>'+
          '<tr>'+
            '<th>Segment-2</th>'+
            '<td>'+
                '<div class="dropdownTwo">			<div id="myDropdownTwo" class="dropdown-content-two">'+
                '<input type="text" name="segment_two_flight[]" class="form-control airline-name-two" placeholder="Search.."  id="myInputTwo" onkeyup="AirlineDataExtractTwo(this)"  required >'+
                '<div class="airline_html_two"></div></div>	</div>'+
            '</td>'+
            '<td>'+
            '<div class="AirportdropdownTwo">	<div id="AirportmyDropdownTwo" class="Airportdropdown-content-two">'+
            '<input type="text" name="segment_two_from[]" class="form-control airport-name-two" placeholder="Search..." id="AirportmyInputTwo" onkeyup="AirportDataExtractTwo(this)">'+
            '<div class="airport_html_two"></div></div></div>'+
            '</td>'+
            '<td>'+
            '<div class="AirportArrivaldropdownTwo">	<div id="AirportArrivalmyDropdownTwo" class="AirportArrivaldropdown-content-two">'+
            '<input type="text" name="segment_two_to[]" class="form-control airport-arrival-name-two" placeholder="Search..." id="AirportArrivalmyInputTwo" onkeyup="AirportArrivalDataExtractTwo(this)">'+
            '<div class="airportArrival_html_two"></div></div></div>'+
            '</td>'+
            '<td><input type="text" name="segment_two_carrier[]" class="form-control" ></td>'+
            // '<td><input type="text" name="segment_two_class[]" class="form-control" ></td>'+
            '<td><select name="segment_two_class[]" class="form-control service"required >'+
										'<option value="">--select--</option>'+
											'<option value="Economy class">Economy class</option>'+
											'<option value="Premium Economy class">Premium Economy class</option>'+
											'<option value="Business Class">Business Class</option>'+
											'<option value="First Class">First Class</option>'+

			'</select></td>'+
            // '<td><input type="datetime-local" name="segment_two_departure[]" class="form-control" ></td>'+
            // '<td><input type="datetime-local" name="segment_two_arrival[]" class="form-control" ></td>'+
          '</tr>'+
          '<tr>'+
            '<th>Departure:</th>'+
            '<td><input type="datetime-local" name="segment_two_departure[]" class="form-control" ></td>'+
            '<th align="right">Arrival:</th>'+
            '<td><input type="datetime-local" name="segment_two_arrival[]" class="form-control" ></td>'+
          '</tr>'+
        '</tbody>'+
      '</table>'+
    '</div>'+


'<div class="table-responsive" id="passengers">'+
    '<div class="col-md-12 text-right" style="margin-bottom:20px;"><button type="button" class="btn btn-sm btn-info" onClick="addPassenger(this);">Add Passenger </button></div>'+
    '<table class="add_row_invoice table table-bordered" id="passenger">'+
        '<thead>'+
          '<tr>'+
            '<th>Pax Type*</th>'+
            '<th>First Name</th>'+
            '<th>Last Name</th>'+
            '<th>Date of Birth*</th>'+
            '<th>&nbsp;</th>'+
            '<th>Fare Cost</th>'+
            '<th>Fare Sell</th>'+
          '</tr>'+
        '</thead>'+
        '<tbody>'+
          '<tr>'+
            '<td>'+
              '<input type="text" name="verify[]" hidden class="verify"><select name="pax_type[]" class="form-control select-custom custom-select">'+
                '<option value="">--Select--</option>'+
              '<option value="Adult">Adult</option>'+
              '<option value="Youth">Youth</option>'+
              '<option value="Child">Child</option>'+
              '<option value="Infant">Infant</option>'+
            '</select>'+
          '</td>'+
            '<td><input type="text" name="first_name[]" class="form-control"></td>'+
            '<td><input type="text" name="last_name[]" class="form-control"></td>'+
            '<td><input type="date" name="DOB[]" placeholder="dd/mm/yyyy"  class="form-control"></td>'+
            '<td>Segment-1</td>'+
            '<td><input type="text" name="segment_one_fare_cost[]" value="0" class="form-control" style="width:60px;" onKeyUp="FlightAmount()" ></td>'+
            '<td><input type="text" name="segment_one_fare_sell[]" value="0" class="form-control" style="width:60px;"onKeyUp="FlightAmount()" ></td>'+
          '</tr>'+
          '<tr>'+
            '<td colspan="4">&nbsp;</td>'+
            '<td>Segment-2</td>'+
            '<td><input type="text" name="segment_two_fare_cost[]" value="0" class="form-control" style="width:60px;" onKeyUp="FlightAmount()"></td>'+
            '<td><input type="text" name="segment_two_fare_sell[]" value="0" class="form-control" style="width:60px;" onKeyUp="FlightAmount()"></td>'+
          '</tr>'+
          '<div ></div>'+
        '</tbody>'+
      '</table>'+
      '</div>'+
    //   '<div align="left">'+

      '<div align="right">'+
      '<div class="row">'+
      '<div class="col-md-10">'+
        '<h3><strong>Total Amount:</strong></h3>'+
        '</div>'+
        '<div class="col-md-2">'+
        '<br><input type="text" name="flight_amount[]" value="0" class="form-control" >'+
       '</div>'+
       '</div>'+
      '</div>'+
      '<div align="right">'+
      '<br><input type="button" class="btn btn-danger btn-xs" value="Remove" onclick="SomeDeleteRowFunction(this);">'+
	'</div>'+
    '</div>';
        return data;
    }
    function pnr(test){
        var value = test.value;
        $(test).parents('.box').find('.verify').val(value);
    }
    function addPassenger(test){
        var value =  $(test).parents('.box').find('.pnr').val();
        var data = '<tr>'+
            '<td>'+
            '<input type="text" name="verify[]" hidden value="'+value+'">'+
              '<select name="pax_type[]" class="form-control select-custom custom-select">'+
                '<option value="">--Select--</option>'+
              '<option value="Adult">Adult</option>'+
              '<option value="Youth">Youth</option>'+
              '<option value="Child">Child</option>'+
              '<option value="Infant">Infant</option>'+
            '</select>'+
          '</td>'+
            '<td><input type="text" name="first_name[]" class="form-control"></td>'+
            '<td><input type="text" name="last_name[]" class="form-control"></td>'+
            '<td><input type="date" name="DOB[]" placeholder="dd/mm/yyyy"  class="form-control"></td>'+
            '<td>Segment-1</td>'+
            '<td><input type="text" name="segment_one_fare_cost[]" value="0" class="form-control" style="width:60px;" onKeyUp="FlightAmount()"></td>'+
            '<td><input type="text" name="segment_one_fare_sell[]" value="0" class="form-control" style="width:60px;" onKeyUp="FlightAmount()"></td>'+
          '</tr>'+
          '<tr>'+
            '<td colspan="4">&nbsp;</td>'+
            '<td>Segment-2</td>'+
            '<td><input type="text" name="segment_two_fare_cost[]" value="0" class="form-control" style="width:60px;" onKeyUp="FlightAmount()"></td>'+
            '<td><input type="text" name="segment_two_fare_sell[]" value="0" class="form-control" style="width:60px;" onKeyUp="FlightAmount()"></td>'+
          '</tr>';
          $(test).parents('.box').find('.add_row_invoice').append(data);
        //   $(".add_row_invoice").append(data);
    }
    function SelectService(test){
			var value = test.value;
			if (value == 'Flight') {
            var temp = flight();
				// var data = '<div class="box-body"> <div class="row">'+
				// 			'<div class="col-md-4">				<div class="form-group">'+
				// 			'<label for="service_name[]">Select Service</label>'+
				// 			'<select name="service_name[]" class="form-control service" required onChange="SelectService(this);">'+
				// 			'<option value="">--select--</option>							@if($products->count()>0)'+
				// 			'@foreach($products as $product)	'+
				// 			'<option value="{{$product->service}}" {{($product->service == "Flight")?"selected":''}}>{{$product->service}}</option>'+
				// 			'@endforeach							@endif					</select>				</div>'+
				// 			'</div>		</div><div class="row">		<div class="col-md-3">		<div class="form-group">'+
				// 			'<label for="airline_name">Airline Name</label>'+
				// 			'<div class="dropdown">			<div id="myDropdown" class="dropdown-content">'+
				// 			'<input type="text" class="form-control airline-name" placeholder="Search.." name="airline_name[]" id="myInput" onkeyup="AirlineDataExtract(this)"  required >'+
				// 			'<div class="airline_html"></div>'+
				// 			'</div>	</div>		</div>		</div>'+
				// 			'<div class="col-md-3">	<div class="form-group">	<label for="source">Departure</label>'+
				// 			'<div class="Airportdropdown">	<div id="AirportmyDropdown" class="Airportdropdown-content">'+
				// 			'<input type="text" class="form-control airport-name" placeholder="Search.." name="source[]" id="AirportmyInput" onkeyup="AirportDataExtract(this)"  required >'+
				// 			'<div class="airport_html"></div>	</div>		</div>		</div>		</div>'+
				// 			'<div class="col-md-3">		<div class="form-group">			<label for="destination">Arrival</label>'+
				// 			'<div class="AirportArrivaldropdown">	<div id="AirportArrivalmyDropdown" class="AirportArrivaldropdown-content">'+
				// 			'<input type="text" class="form-control airport-arrival-name" placeholder="Search.." name="destination[]" id="AirportArrivalmyInput" onkeyup="AirportArrivalDataExtract(this)"  required >'+
				// 			'<div class="airportArrival_html"></div>	</div>	</div>		</div>		</div><div class="col-md-3">		<div class="form-group">	<label for="date_of_travel">Date</label>'+
				// 			'<input type="date" name="date_of_travel[]" required class="form-control">	</div>	</div>		</div><hr>'+
				// 			'<div class="row">	'+
				// 			'<div class="col-md-4">		<div class="form-group">	<label for="adult[]">Adult</label>'+
				// 			'<input type="text" name="adult[]" class="form-control" onKeyUp="FlightAmount()">	</div>	</div><div class="col-md-4">		<div class="form-group">	<label for="adult_price[]">Adult Price</label>'+
				// 			'<input type="text" name="adult_price[]" class="form-control" onKeyUp="FlightAmount()">	</div>	</div><div class="col-md-1"><div class="form-group">'+
				// 			'<label for="child_check[]">Child</label><br><input type="checkbox" name="child_check[]" checked onClick="ChildAppend(this)" ></div></div><div class="col-md-1"><div class="form-group">'+
				// 			'<label for="infant_check[]">Infant</label><br><input type="checkbox" name="infant_check[]" onClick="InfantAppend(this)" checked >'+
				// 			'</div></div></div><div class="row"><div id="child-nikaalo"><div class="col-md-3">'+
				// 			'<div class="form-group">	<label for="child[]">Child</label>'+
				// 			'<input type="text" name="child[]"  class="form-control" onKeyUp="FlightAmount()">	</div>	</div> <div class="col-md-3">		<div class="form-group">	<label for="child_price[]">Child Price</label>'+
				// 			'<input type="text" name="child_price[]" class="form-control" onKeyUp="FlightAmount()">	</div>	</div></div><div id="infant-nikaalo">'+
				// 			'<div class="col-md-3">	<div class="form-group">	<label for="infant[]">Infant</label>'+
				// 			'<input type="text" name="infant[]"  class="form-control" onKeyUp="FlightAmount()">	</div>	</div> <div class="col-md-3">	<div class="form-group">	<label for="infant_price[]">Infant Price</label>'+
				// 			'<input type="text" name="infant_price[]"  class="form-control" onKeyUp="FlightAmount()">	</div>	</div></div></div><div class="row">'+
				// 			'<div class="col-md-4">	<div class="form-group">	<label for="flight_remarks[]">Remarks</label>'+
				// 			'<input type="text" name="flight_remarks[]" required class="form-control">	</div>	</div>		<div class="col-md-4">	<div class="form-group">	<label for="flight_amount[]">Amount</label>'+
				// 			'<input id="amount" type="number" name="flight_amount[]" required class="form-control" readonly>	'+
				// 			'</div>		</div></div><div align="right">'+
				// 			'<input type="button" class="btn btn-danger btn-xs" value="Remove" onclick="SomeDeleteRowFunction(this);">'+
				// 			'</div>	</div>	</div></div>';
				$(test).closest(".box").html(temp);
			}
			if (value == 'Visa Services') {
				var options = "<option value=''>---SELECT---</option><option value='SELF'>SELF</option>";
				var client_id = document.getElementById('client').value;
				@foreach($clients as $client)
				var fetched_client_id = {!! json_encode($client->id) !!}
			    	if(fetched_client_id == client_id){
							@foreach($client->family as $family)
							var temp = {!! json_encode($family->member_name) !!}
							options = options + "<option value='{{$family->id}}'>{{$family->member_name}}</option>";
							@endforeach
						}
			  @endforeach
				var data = '<div class="box-body"> <div class="row">			<div class="col-md-4">				<div class="form-group">					<label for="service_name[]">Select Service</label>					<select name="service_name[]" class="form-control service" required onChange="SelectService(this);">							<option value="">--select--</option>							@if($products->count()>0)							@foreach($products as $product)								<option value="{{$product->service}}" {{($product->service == "Visa Services")?"selected":''}}>{{$product->service}}</option>							@endforeach							@endif					</select>				</div>			</div><div class="col-md-4"><div class="form-group"><label for="visa_applicant">Visa Applicant</label><select name="visa_applicant" id="visa-applicant" class="form-control" onChange="findFamily(this);">'+options+'</select></div></div>		</div><div class="row">	<div class="col-md-3">		<div class="form-group">			<label for="name_of_visa_applicant">Name Of Visa Applicant</label>			<input type="text" name="name_of_visa_applicant[]"  required class="form-control member_name">		</div>		</div>		<div class="col-md-3">		<div class="form-group">			<label for="passport_origin">Passport Origin</label>			<input type="text" name="passport_origin[]" class="form-control passport_origin" required>		</div>		</div>	<div class="col-md-3">		<div class="form-group">			<label for="passport_no">Passport No.</label>			<input type="text" name="passport_no[]" class="form-control passport_no">		</div>		</div> <div class="col-md-3">		<div class="form-group">			<label for="passport_member_dob">Passport Member DOB</label>			<input type="text" name="passport_member_dob[]" class="form-control member_dob">		</div>		</div>	</div>		<div class="row">				<div class="col-md-4">				<div class="form-group">					<label for="visa_country">Visa Country</label>					<input type="text" name="visa_country[]" required class="form-control">				</div>				</div>				<div class="col-md-4">				<div class="form-group">					<label for="visa_type">Visa Type</label>					<input type="text" name="visa_type[]" class="form-control">				</div>				</div>				<div class="col-md-4">						<div class="form-group">							<label for="visa_charges[]">Visa Fee</label>							<input type="text" name="visa_charges[]" class="form-control" onKeyUp="VisaAmount()">						</div>						</div>				</div><div class="row">						<div class="col-md-4">			<div class="form-group">	<label for="service_charge[]">Service Charge</label>		<input id="service_charge" type="text" name="service_charge[]" required class="form-control" onKeyUp="VisaAmount()">			</div>		</div>		<div class="col-md-4">			<div class="form-group">	<label for="visa_amount">Amount</label>		<input id="amount" type="number" name="visa_amount[]" required class="form-control" readonly>			</div>		</div></div><div align="right">						<input type="button" class="btn btn-danger btn-xs" value="Remove" onclick="SomeDeleteRowFunction(this);">					</div>	</div>				</div></div>';

				$(test).closest(".box").html(data);

			}
			if (value == 'Hotel') {
				var data = '<div class="box-body"> <div class="row">			<div class="col-md-4">				<div class="form-group">					<label for="service_name[]">Select Service</label>					<select name="service_name[]" class="form-control service" required onChange="SelectService(this);">							<option value="">--select--</option>							@if($products->count()>0)							@foreach($products as $product)								<option value="{{$product->service}}" {{($product->service == "Hotel")?"selected":''}}>{{$product->service}}</option>							@endforeach							@endif					</select>				</div>			</div>		</div> <div class="row">		<div class="col-md-6">		<div class="form-group">			<label for="hotel_city">City</label>			<input type="text" name="hotel_city[]" required class="form-control">		</div>		</div>		<div class="col-md-6">		<div class="form-group">			<label for="hotel_country">Country</label>			<input type="text" name="hotel_country[]" class="form-control">		</div>		</div>		</div>		<div class="row">		<div class="col-md-4">		<div class="form-group">			<label for="hotel_name">Name</label>			<input type="text" name="hotel_name[]" required class="form-control">		</div>		</div>		<div class="col-md-4">		<div class="form-group">			<label for="check_in_date">Check In Date</label>			<input type="date" name="check_in_date[]" required class="form-control">		</div>		</div>		<div class="col-md-4">		<div class="form-group">			<label for="check_out_date">Check Out Date</label>			<input type="date" name="check_out_date[]" required class="form-control">		</div>		</div>		</div>		<div class="row">		<div class="col-md-3">		<div class="form-group">			<label for="no_of_children[]">No. Of Children</label>			<input type="text" name="no_of_children[]" class="form-control" >		</div>		</div>		<div class="col-md-3">		<div class="form-group">			<label for="no_of_rooms">No. Of Rooms</label>			<input type="text" name="no_of_rooms[]" class="form-control">		</div>		</div>		<div class="col-md-3">		<div class="form-group">			<label for="hotel_amount[]">Amount</label>			<input type="text" name="hotel_amount[]" class="form-control">		</div>		</div>		</div>			</div>		</div></div><div align="right">						<input type="button" class="btn btn-danger btn-xs" value="Remove" onclick="SomeDeleteRowFunction(this);">					</div>	</div>				</div></div>';
				$(test).closest(".box").html(data);
			}
			if (value == 'Insurance') {
				var data = '<div class="box-body"> <div class="row">			<div class="col-md-4">				<div class="form-group">					<label for="service_name[]">Select Service</label>					<select name="service_name[]" class="form-control service" required onChange="SelectService(this);">							<option value="">--select--</option>							@if($products->count()>0)							@foreach($products as $product)								<option value="{{$product->service}}" {{($product->service == "Insurance")?"selected":''}}>{{$product->service}}</option>							@endforeach							@endif					</select>				</div>			</div>		</div><div class="row">	<div class="col-md-4">		<div class="form-group">			<label for="name_of_insurance_applicant">Name Of Insurance Applicant</label>			<input type="text" name="name_of_insurance_applicant[]" required class="form-control">		</div>		</div>		<div class="col-md-4">		<div class="form-group">			<label for="insurance_remarks">Insurance Remarks</label>			<input type="text" name="insurance_remarks[]" class="form-control">		</div>		</div>						<div class="col-md-4">				<div class="form-group">					<label for="insurance_amount[]">Insurance Amount</label>					<input type="text" name="insurance_amount[]" required class="form-control">				</div>				</div>				</div><div align="right">						<input type="button" class="btn btn-danger btn-xs" value="Remove" onclick="SomeDeleteRowFunction(this);">					</div>	</div>				</div></div>';
				$(test).closest(".box").html(data);
			}
			if (value == 'Local Sight Sceen') {
				var data = '<div class="box-body"> <div class="row">			<div class="col-md-4">				<div class="form-group">					<label for="service_name[]">Select Service</label>					<select name="service_name[]" class="form-control service" required onChange="SelectService(this);">							<option value="">--select--</option>							@if($products->count()>0)							@foreach($products as $product)								<option value="{{$product->service}}" {{($product->service == "Local Sight Sceen")?"selected":''}}>{{$product->service}}</option>							@endforeach							@endif					</select>				</div>			</div>		</div><div class="row">	<div class="col-md-6">		<div class="form-group">			<label for="local_sight_sceen_remarks">Local Sight Sceen Remarks</label>			<input type="text" name="local_sight_sceen_remarks[]" required class="form-control">		</div>		</div>		<div class="col-md-6">				<div class="form-group">					<label for="local_sight_sceen_amount[]">Sight Sceen Charges</label>					<input type="text" name="local_sight_sceen_amount[]" required class="form-control">				</div>				</div>				</div><div align="right">						<input type="button" class="btn btn-danger btn-xs" value="Remove" onclick="SomeDeleteRowFunction(this);">					</div>	</div>				</div></div>';
				$(test).closest(".box").html(data);
			}
			if (value == 'Local Transport') {
				var data = '<div class="box-body"> <div class="row">			<div class="col-md-4">				<div class="form-group">					<label for="service_name[]">Select Service</label>					<select name="service_name[]" class="form-control service" required onChange="SelectService(this);">							<option value="">--select--</option>							@if($products->count()>0)							@foreach($products as $product)								<option value="{{$product->service}}" {{($product->service == "Local Transport")?"selected":''}}>{{$product->service}}</option>							@endforeach							@endif					</select>				</div>			</div>		</div><div class="row">	<div class="col-md-6">		<div class="form-group">			<label for="local_transport_remarks">Local Transport Remarks</label>			<input type="text" name="local_transport_remarks[]" required class="form-control">		</div>		</div>		<div class="col-md-6">				<div class="form-group">					<label for="local_transport_amount[]">Transport Charges</label>					<input type="text" name="local_transport_amount[]" required class="form-control">				</div>				</div>				</div><div align="right">						<input type="button" class="btn btn-danger btn-xs" value="Remove" onclick="SomeDeleteRowFunction(this);">					</div>	</div>				</div></div>';
				$(test).closest(".box").html(data);
			}
			if (value == 'Car Rental') {
				var data = '<div class="box-body"> <div class="row">			<div class="col-md-4">				<div class="form-group">					<label for="service_name[]">Select Service</label>					<select name="service_name[]" class="form-control service" required onChange="SelectService(this);">							<option value="">--select--</option>							@if($products->count()>0)							@foreach($products as $product)								<option value="{{$product->service}}" {{($product->service == "Car Rental")?"selected":''}}>{{$product->service}}</option>							@endforeach							@endif					</select>				</div>			</div>		</div><div class="row">	<div class="col-md-6">		<div class="form-group">			<label for="car_rental_remarks">Car Rental Remarks</label>			<input type="text" name="car_rental_remarks[]" required class="form-control">		</div>		</div>		<div class="col-md-6">				<div class="form-group">					<label for="car_rental_amount[]">Car Rental Charges</label>					<input type="text" name="car_rental_amount[]" required class="form-control">				</div>				</div>				</div><div align="right">						<input type="button" class="btn btn-danger btn-xs" value="Remove" onclick="SomeDeleteRowFunction(this);">					</div>	</div>				</div></div>';
				$(test).closest(".box").html(data);
			}
			if (value == 'Other Facilities') {
				var data = '<div class="box-body"> <div class="row">			<div class="col-md-4">				<div class="form-group">					<label for="service_name[]">Select Service</label>					<select name="service_name[]" class="form-control service" required onChange="SelectService(this);">							<option value="">--select--</option>							@if($products->count()>0)							@foreach($products as $product)								<option value="{{$product->service}}" {{($product->service == "Other Facilities")?"selected":''}}>{{$product->service}}</option>							@endforeach							@endif					</select>				</div>			</div>		</div><div class="row">	<div class="col-md-6">		<div class="form-group">			<label for="other_facilities_remarks">Other Facilities Remarks</label>			<input type="text" name="other_facilities_remarks[]" required class="form-control">		</div>		</div>		<div class="col-md-6">				<div class="form-group">					<label for="other_facilities_amount[]">Other Facilities Charges</label>					<input type="text" name="other_facilities_amount[]" required class="form-control">				</div>				</div>				</div><div align="right">						<input type="button" class="btn btn-danger btn-xs" value="Remove" onclick="SomeDeleteRowFunction(this);">					</div>	</div>				</div></div>';
				$(test).closest(".box").html(data);
			}
			if (value == '') {
				var data = '';
				$(test).closest(".box").html(data);
			}
		}

	function FlightAmount(){
		for (var i = 0; i < document.getElementsByName("flight_amount[]").length; i++) {
			// var adult_price = document.getElementsByName("adult_price[]")[i].value * document.getElementsByName("adult[]")[i].value;
			// var child_price = document.getElementsByName("child_price[]")[i].value * document.getElementsByName("child[]")[i].value;
			// var infant_price = document.getElementsByName("infant_price[]")[i].value * document.getElementsByName("infant[]")[i].value;
			// var actual_amount = document.getElementsByName("flight_price[]")[i].value * document.getElementsByName("flight_quantity[]")[i].value;
			document.getElementsByName("flight_amount[]")[i].value = Number(document.getElementsByName("segment_one_fare_sell[]")[i].value) + Number(document.getElementsByName("segment_two_fare_sell[]")[i].value);

    	}
	}

	function VisaAmount(){
		for (var i = 0; i < document.getElementsByName("service_charge[]").length; i++) {
    		var actual_amount = document.getElementsByName("service_charge[]")[i].value - (-document.getElementsByName("visa_charges[]")[i].value);
     		document.getElementsByName("visa_amount[]")[i].value =actual_amount;

    	}
	}



    $(document).ready(function(){
    $("#targetTotal").hover(function(){
		var total_amount = 0;
    	var total_flight_amount = 0;
		var total_visa_amount = 0;
		var total_hotel_amount = 0;
		var total_insurance_amount = 0;
		var total_local_sight_sceen_amount = 0;
		var total_other_facilities_amount = 0;
		var total_car_rental_amount = 0;
		var total_local_transport_amount = 0;
    	for (var i = 0; i < document.getElementsByName("flight_amount[]").length; i++) {
    		var total_flight_amount = total_flight_amount - (-document.getElementsByName("flight_amount[]")[i].value);
    	}
		for (var i = 0; i < document.getElementsByName("visa_amount[]").length; i++) {
    		var total_visa_amount = total_visa_amount - (-document.getElementsByName("visa_amount[]")[i].value);
    	}
		for (var i = 0; i < document.getElementsByName("hotel_amount[]").length; i++) {
    		var total_hotel_amount = total_hotel_amount - (-document.getElementsByName("hotel_amount[]")[i].value);
    	}
		for (var i = 0; i < document.getElementsByName("insurance_amount[]").length; i++) {
    		var total_insurance_amount = total_insurance_amount - (-document.getElementsByName("insurance_amount[]")[i].value);
    	}
		for (var i = 0; i < document.getElementsByName("local_sight_sceen_amount[]").length; i++) {
    		var total_local_sight_sceen_amount = total_local_sight_sceen_amount - (-document.getElementsByName("local_sight_sceen_amount[]")[i].value);
    	}
		for (var i = 0; i < document.getElementsByName("other_facilities_amount[]").length; i++) {
    		var total_other_facilities_amount = total_other_facilities_amount - (-document.getElementsByName("other_facilities_amount[]")[i].value);
    	}
		for (var i = 0; i < document.getElementsByName("car_rental_amount[]").length; i++) {
    		var total_car_rental_amount = total_car_rental_amount - (-document.getElementsByName("car_rental_amount[]")[i].value);
    	}
		for (var i = 0; i < document.getElementsByName("local_transport_amount[]").length; i++) {
    		var total_local_transport_amount = total_local_transport_amount - (-document.getElementsByName("local_transport_amount[]")[i].value);
    	}
		total_amount = Number(total_flight_amount) + Number(total_visa_amount) + Number(total_hotel_amount) + Number(total_insurance_amount) + Number(total_local_sight_sceen_amount) + Number(total_other_facilities_amount) + Number(total_car_rental_amount) + Number(total_local_transport_amount) ;
		document.getElementsByName("total")[0].value = total_amount;
		var discounted = Number(total_amount) - document.getElementsByName("discount")[0].value;
		document.getElementsByName("discounted_total")[0].value = document.getElementById('currency').value + discounted;
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

    function AirlineAssignTwo(temp){
		var div = $(temp).closest(".dropdown-content-two");
		div.find('.airline-name-two').val(temp.value);
		$(temp).closest(".airline_html_two").html('');
	  }
	function AirportAssignTwo(temp){
		var div = $(temp).closest(".Airportdropdown-content-two");
		div.find('.airport-name-two').val(temp.value);
		$(temp).closest(".airport_html_two").html('');
	}
	function AirportArrivalAssignTwo(temp){
		var div = $(temp).closest(".AirportArrivaldropdown-content-two");
		div.find('.airport-arrival-name-two').val(temp.value);
		$(temp).closest(".airportArrival_html_two").html('');
	}


    function AirlineDataExtractTwo(test){
        $value=test.value;
        $.ajax({
            type : 'get',
            url : '{{URL::to('searchAirlineTwo')}}',
            data:{'search':$value},
            success:function(data){
                $(test).next(".airline_html_two").html(data);
            }
        });
    }

    function AirportDataExtractTwo(test){
        $value=test.value;
        $.ajax({
            type : 'get',
            url : '{{URL::to('searchAirportTwo')}}',
            data:{'search':$value},
            success:function(data){
                $(test).next(".airport_html_two").html(data);
            }
        });
    }

    function AirportArrivalDataExtractTwo(test){
        $value=test.value;
        $.ajax({
            type : 'get',
            url : '{{URL::to('searchAirportArrivalTwo')}}',
            data:{'search':$value},
            success:function(data){
                $(test).next(".airportArrival_html_two").html(data);
            }
        });
    }
   	</script>



@stop

