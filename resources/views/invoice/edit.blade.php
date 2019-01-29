@extends('layouts.frontend')
@section('title')
Edit Invoice
@endsection
@section('header')
	<section class="content-header">
      <h1 >
        Invoice
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('invoice')}}"><i class="fa fa-paperclip"></i> Invoice</a></li>
        <li class="active">Edit Invoice</li>
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



	<form action="{{route('invoice.update',['id'=>$invoice->id])}}" method="post">
		@csrf
	<div id="tab">	
		<div class="box box-primary">
		<div class="box-body">
			<section class="content-header">
				<h1 class="text-center"><span style="color:#0066FF;">Invoice</span></h1>
			</section>
			<hr>
			<div class="row">
				<div class="col-md-8">
					<h3>To,</h3>
					<h3>RECEIVER (BILL TO)</h3>
				</div>
				<div class="col-md-4">
					<h3>Reverse Charge</h3>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8">
				<div class="form-group">
					<select required name='receiver_name' class="form-control" id="client">
						
						
							<option value="{{$invoice->receiver_name}}">{{$invoice->receiver_name}}</option>
						
					</select>
					{{-- <input type="text" name='receiver_name' value="{{$invoice->receiver_name}}" required class="form-control" placeholder="Enter Receiver Name"> --}}
					<textarea name="billing_address" required class="form-control" placeholder="Enter Billing Adress">{{$invoice->billing_address}}</textarea>
				</div>
				</div>
				<div class="col-md-4">
				<div class="form-group">
					<input type="text" style="color:white;font-weight:500;background-color:#0066FF;" name='invoice_no' integer placeholder="Enter Invoice No." required class="form-control" value="{{$invoice->invoice_no}}">
					<input type="date" name='invoice_date' placeholder="Select Invoice date" required class="form-control" value="{{$invoice->invoice_date}}">
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
                	@foreach($invoice->invoiceInfo as $info)
                	<tr id="row">
						<td>
							<select required name="item_name[]" class="form-control" id="">
								@if($products->count()>0)
								@foreach($products as $product)
									<option value="{{$product->service}}" {{($info->item_name ==$product->service )?"selected":" "}}>{{$product->service}}</option>
								@endforeach
								@endif
							</select>
						</td>
						<td>
							<select required name="item_subname[]" class="form-control" id="">
								@if($airlines->count()>0)
								@foreach($airlines as $airline)
									<option value="{{$airline->name}}" {{($info->item_subname ==$airline->name )?"selected":" "}}>{{$airline->name}}</option>
								@endforeach
								@endif
							</select>
						</td>
						<td><input type="text" id="quantity" name='quantity[]' required class="form-control" value="{{$info->quantity}}"></td>
						<td><select name="currency[]" class="form-control" id="currency">
							<option value="$" {{($info->currency == '$' )?"selected":" "}}>$</option>
							<option value="&#163;" {{($info->currency !="$" )?"selected":" "}}>&#163;</option></option>
							</select>
						</td>
						<td><input id="price" type="text" name='price[]' required class="form-control" value="{{$info->price}}"></td>
						<td><input id="amount" type="text" name='amount[]' required class="form-control" readonly value="{{$info->currency.$info->amount}}"></td>
						<td><select name="status[]" class="form-control" id="" required>
							<option value='1' {{($info->status == 1 )?"selected":" "}}>Paid</option>
							<option value='0' {{($info->status == 0 )?"selected":" "}}>UnPaid</option>
							</select>
						</td>
					</tr>
					@endforeach

                </tbody>
	        </table>
			{{-- <div class="text-center"  style="margin-top: 5px">
			<button class="btn btn-success btn-sm" type="button" id="add">+</button>
			</div> --}}
		</div>
		</div>
		<div class="box box-default">
		<div class="box-body">
			<table class="table table-bordered">
				<tr>
					<td class="col-md-8" align="right"><strong>Total:</strong></td>
						<?php $amount = 0;?>
            			@foreach($invoice->invoiceInfo as $info)
            			<?php 
            				$amount = $amount + $info->amount;	
            			?>
						@endforeach					<td class="col-md-4"><input type="text" required class="form-control" style="color:white;font-weight:500;background-color:#0066FF;" value="{{$invoice->invoiceInfo[0]->currency.$amount}}" readonly></td>
				</tr>
			</table>
		</div>
		</div>
	</div>
			
			<div class="form-group">
			<div class="text-center">
			<button class="btn btn-primary" type="submit">Update</button>
			</div>
			</div>
	</form>

	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script type="text/javascript">
	

    $(document).ready(function(){
    $("#target").hover(function(){
    	
    	var actual_amount =  document.getElementsByName("price[]")[0].value * document.getElementsByName("quantity[]")[0].value;
    	document.getElementsByName("amount[]")[0].value =document.getElementsByName("currency[]")[0].value+ " "+actual_amount;
    	
    });
    });
   	</script>
   

    


@stop