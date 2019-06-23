@extends('layouts.frontend')
@section('title')
Pay
@endsection
@section('header')
	<section class="content-header">
      <h1>
        Pay
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('invoice')}}"><i class="fa fa-paperclip"></i> Invoice</a></li>
        <li class="active"><i class="fa fa-paperclip"></i>Pay</li>
      </ol>
    </section>
@stop
@section('content')

<div class="box box-primary">
    <div class="box-body">
        <section class="content-header">
            <h1 class="text-center"><span style="color:#0066FF;">Pay Invoice</span></h1>
        </section>
        <hr>
        <div class="row">
            <div class="col-md-8">
                <h3>To,</h3>
                <h3>RECEIVER (BILL TO)</h3>
            </div>
            <div class="col-md-4">
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
            <div class="form-group">
                <input type="text" name='receiver_name' required class="form-control" readonly value="{{$invoice->receiver_name}}">
                <div id="address">
                    <textarea name="billing_address" required class="form-control" readonly placeholder="Enter Billing Adress">{{$invoice->billing_address}}"></textarea>
                </div>
            </div>
            </div>
            <div class="col-md-4">
            <div class="form-group">
                <input style="color:white;font-weight:500;background-color:#0066FF;" type="text" name='invoice_no' readonly class="form-control" value="{{$invoice->invoice_no}}">
                <input type="date" name='invoice_date' value="{{$invoice->invoice_date}}" readonly placeholder="Select Invoice date" required class="form-control">
            </div>
            </div>
        </div>
    </div>
</div>
<div class="box box-primary" >
    <div class="box-body">
        <table class="table table-bordered">
            <tr>
                <td class="col-md-8" align="right"><strong>SubTotal:</strong></td>
                <td class="col-md-4"><input name="total" value="{{$invoice->currency.' '.$invoice->total}}"  type="text" id="total" required class="form-control" readonly></td>
            </tr>
            <tr>
                <td class="col-md-8" align="right"><strong>Discount:</strong></td>
                <td class="col-md-4"><input name="discount" type="text" id="discount" value="{{$invoice->currency.' '.$invoice->discount}}" required class="form-control" readonly></td>
            </tr>
            <tr>
                <td class="col-md-8" align="right"><strong>Total:</strong></td>
                <td class="col-md-4"><input name="discounted_total" type="text" value="{{$invoice->currency.' '.$invoice->discounted_total}}" id="discounted_total" style="color:white;font-weight:500;background-color:#0066FF;" required class="form-control" readonly></td>
            </tr>
        </table>
    </div>
</div>
<form action="{{route('invoice.payy',['id'=>$invoice->id])}}" method="post">
@csrf
<div class="box box-primary">
    <div class="box-body">
        <table class="table table-bordered">

            <tr>
            <td class="col-md-8" align="right">
                <p class="lead"><strong>Payment Methods</strong></p>
            </td>
            <td class="col-md-4">
                <Strong>Paid: </Strong><span style="color:green;">{{$invoice->currency.' '.$invoice->paid}}</span> <br>
                <Strong>Pending Amount: </Strong><span style="color:red;">{{$invoice->currency.' '.$invoice->pending_amount}}</span>
            </td>
            </tr>
            <tr>
            <td class="col-md-8" align="right">
                <strong>Credit card:</strong>
            </td>
            <td class="col-md-4" id="creditInput"><input name="credit_amount" type="text"  class="form-control  mask-money" ></td>
            </tr>
            <tr>
            <td class="col-md-8" align="right">
                <strong>Debit card:</strong>
            </td>
            <td class="col-md-4" id="debitInput"><input name="debit_amount" type="text"  class="form-control mask-money" ></td>
            </tr>
            <tr>
            <td class="col-md-8" align="right">
                <strong>Cash:</strong>
            </td>
            <td class="col-md-4" id="cashInput"><input name="cash_amount" type="text"  class="form-control mask-money" ></td>
            </tr>
            <tr>
            <td class="col-md-8" align="right">
                <strong>Bank Transfer:</strong>
            </td>
            <td class="col-md-4" id="bankInput"><input name="bank_amount" type="text"  class="form-control mask-money" ></td>
            </tr>
        </table>

    </div>
</div>
<div class="text-center">
<button type="submit" class="btn btn-success">Pay</button>
</div>
</form>

@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
        <script>
window.setInterval(function(){
        $('.mask-money').maskMoney();
}, 1000);
</script>
@stop


