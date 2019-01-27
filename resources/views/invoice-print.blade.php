@extends('layouts.frontend')
@section('title')
Invoice
@endsection
@section('content')
<body onload="window.print();">

  <!-- Main content -->
  <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> CloudTravel
            <small class="pull-right"></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        
        <!-- /.col -->
        <div class="col-sm-8 invoice-col">
          To,<br>
          RECEIVER (BILL TO)
          <address>
            <strong>{{$invoice->receiver_name}}</strong><br>
            {{$invoice->billing_address}}<br>
            {{-- San Francisco, CA 94107<br>
            Phone: (555) 539-1037<br>
            Email: john.doe@example.com --}}
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          Reverse Charge: <br><br>
          <b>Invoice: {{$invoice->invoice_no}}</b>
          <br>
          <b>Date: </b>{{$invoice->invoice_date}}<br>
          {{-- <b>Payment Due:</b> 2/22/2014<br>
          <b>Account:</b> 968-34567 --}}
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
                <th width="15%">Item Name</th>
                <th width="15%">Item Sub Name</th>
                <th width="7%">Quantity</th>
                {{-- <th width="8%">Currency</th> --}}
                <th width="13%">Price</th>
                <th width="12%">Actual Amt.</th>
                {{-- <th width="12%">Status</th> --}}
            </tr>
            </thead>
            <tbody>
            <tr id="row">
            <td>{{$invoice->item_name}}</td>
            <td>{{$invoice->item_subname}}</td>
            <td>{{$invoice->quantity}}</td>
            {{-- <td>{{$invoice->currency}}</td> --}}
            <td>{{$invoice->price}}</td>
            <td>{{$invoice->amount}}</td>
            {{-- <td>@if($invoice->status ==1)
                {{'Paid'}}
                @else
                {{"UnPaid"}}
                @endif
            </td> --}}
          </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div><br>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          {{-- <p class="lead">Payment Methods:</p>
          <img src="../../dist/img/credit/visa.png" alt="Visa">
          <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
          <img src="../../dist/img/credit/american-express.png" alt="American Express">
          <img src="../../dist/img/credit/paypal2.png" alt="Paypal"> --}}

          {{-- <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
            dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
          </p> --}}
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          {{-- <p class="lead">Amount Due Date: </p> --}}

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td>{{$invoice->currency}} {{$invoice->amount}}</td>
              </tr>
              <tr>
                <th>Tax (0.0%)</th>
                <td>{{$invoice->currency}} 0.00</td>
              </tr>
              <tr>
                <th>Shipping:</th>
                <td>{{$invoice->currency}} 0.00</td>
              </tr>
              <tr>
                <th>Total:</th>
                <td>{{$invoice->currency}} {{$invoice->amount}}</td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      {{-- <div class="row no-print">
        <div class="col-xs-12">
          <a href="{{route('invoice.print',['id'=>$invoice->id])}}" target="_blank" class="btn btn-primary pull-right"><i class="fa fa-print"></i> Print</a> --}}
          {{-- <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
          </button>
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button> --}}
        {{-- </div>
      </div> --}}
    </section>
  <!-- /.content -->

<!-- ./wrapper -->
</body>
@stop
