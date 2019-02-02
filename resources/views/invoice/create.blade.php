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
					<input type="date" name='invoice_date' placeholder="Select Invoice date" required class="form-control">
				</div>
				</div>
			</div>
		</div>
		</div>
		<div class="box box-primary">
		<div class="box-body">
			<table class="table table-bordered">
                <thead>
                  <tr>
                    {{-- <th width="7%">Sno.</th> --}}
                    <th width="15%" style="color:white;font-weight:500;background-color:#0066FF;">Item Name</th>
                    <th width="15%" style="color:white;font-weight:500;background-color:#0066FF;">Item Sub Name</th>
                    <th width="7%" style="color:white;font-weight:500;background-color:#0066FF;">Quantity</th>
                    <th width="8%" style="color:white;font-weight:500;background-color:#0066FF;">Currency</th>
                    <th width="13%" style="color:white;font-weight:500;background-color:#0066FF;">Price</th>
                    <th width="12%" style="color:white;font-weight:500;background-color:#0066FF;">Actual Amt.</th>
                    <th width="12%" style="color:white;font-weight:500;background-color:#0066FF;">Status</th>
                  </tr>
                	</thead>
                <tbody id="target">
                	<tr id="row">
						{{-- <th>1.</th> --}}
						<td>
							<select required name="item_name[]" class="form-control" id="">
								<option value="">--select--</option>
								@if($products->count()>0)
								@foreach($products as $product)
									<option value="{{$product->service}}">{{$product->service}}</option>
								@endforeach
								@endif
							</select>
						</td>
						<td>
							<select required name="item_subname[]" class="form-control" id="">
								<option value="">--select--</option>
								@if($airlines->count()>0)
								@foreach($airlines as $airline)
									<option value="{{$airline->name}}">{{$airline->name}}</option>
								@endforeach
								@endif
							
							</select>
						</td>
						<td><input type="text" id="quantity" name='quantity[]' required class="form-control"></td>
						<td><select name="currency[]" class="form-control" id="currency">
							<option value="$">$</option>
							<option value="&#163;">&#163;</option>
							</select>
						</td>
						<td><input id="price" type="text" name='price[]' required class="form-control"></td>
						<td><input id="amount" type="text" name='amount[]' required class="form-control" readonly></td>
						<td><select name="status[]" class="form-control" id="" required>
							<option value="">--select--</option>
							<option value='paid'>Paid</option>
							<option value='unpaid'>UnPaid</option>
							</select>
						</td>
					</tr>

                </tbody>
	        </table>
			<div class="text-center"  style="margin-top: 5px">
			<button class="btn btn-success btn-sm"  type="button" id="add">+</button>
			</div>
		</div>
		</div>
		<div class="box box-default" id="targetTotal">
		<div class="box-body">
			<table class="table table-bordered">
				<tr>
					<td class="col-md-8" align="right"><strong>Total:</strong></td>
					<td class="col-md-4"><input name="total"  type="text" id="total" required class="form-control" readonly></td>
				</tr>
				<tr>
					<td class="col-md-8" align="right"><strong>Discount:</strong></td>
					<td class="col-md-4"><input name="discount" type="text" id="discount" required class="form-control" value="0"></td>
				</tr>
				<tr>
					<td class="col-md-8" align="right"><strong>Discounted Total:</strong></td>
					<td class="col-md-4"><input name="discounted_total" type="text" id="discounted_total" style="color:white;font-weight:500;background-color:#0066FF;" required class="form-control" readonly></td>
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
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script type="text/javascript">
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
    	var append = '<tr id="row"><td><select required name="item_name[]" class="form-control" id=""><option value="">--select--</option>'+options1+'</select></td><td><select required name="item_subname[]" class="form-control" id=""><option value="">--select--</option>'+options2+'</select></td><td><input type="text" name="quantity[]" id="quantity" required class="form-control"></td><td><select name="currency[]" class="form-control" id=""><option value='+currency+'>'+currency+'</option></select></td><td><input type="text" name="price[]" id="price" required class="form-control"></td><td><input id="amount" type="text" name="amount[]" required class="form-control" readonly></td><td><select name="status[]" required class="form-control" id=""><option value="">--select--</option><option value="paid">Paid</option><option value="unpaid">UnPaid</option></select></td></tr>';
        $("#target").append(append);   
        });
    });

    $(document).ready(function(){
    $("#target").hover(function(){
    	
    	for (var i = 0; i < document.getElementsByName("price[]").length; i++) {
    		var actual_amount = document.getElementsByName("price[]")[i].value * document.getElementsByName("quantity[]")[i].value;
    		document.getElementsByName("amount[]")[i].value =document.getElementsByName("currency[]")[i].value+actual_amount;
    		
    	}
    	
    });
    });

    $(document).ready(function(){
    $("#target").hover(function(){
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