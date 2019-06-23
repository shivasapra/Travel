@extends('layouts.frontend')
@section('title')
Invoices Report
@endsection
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
@stop
@section('header')
	<section class="content-header">
      <h1>
        Invoices Report
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Invoices Report</li>
      </ol>
    </section>
@stop
@section('content')

		<div class="box box-info">
      <div class="box-header">
        <div class="row">
          <div class="col-md-8"></div>
          <div class="col-md-4">
          <form action="{{route('service')}}" method="post">
            @csrf
              <label for="service_name">Select Service</label>
              <select name="service_name" class="form-control service" required onChange="SelectService();">
                  <option value="">--select--</option>
                  @if($products->count()>0)
                  @foreach($products as $product)
                    <option value="{{$product->service}}" {{($service_name == $product->service)?"selected":" "}}>{{$product->service}}</option>
                  @endforeach
                  @endif
              </select>
              <button type="submit" hidden id="button"></button>
            </form>
          </div>
        </div>
      </div>
			<div class="box-body">


			<table id="example" class="table table-striped display" style="width:100%">
                    <thead id="ignorePDF">
                      <tr>
                        <th>Invoice No.</th>
                        <th>Invoice Date</th>
                        <th>Receiver Name</th>
                        <th>Amount</th>
                        <th>Status</th>
                      </tr>
                    	</thead>
                    <tbody id="invoices">
                    	@if($invoices->count()>0)

	                    	@foreach($invoices as $invoice)
	                    	<tr>
	                    		<td>{{$invoice->invoice->invoice_no}}</td>
	                    		<td>{{$invoice->invoice->invoice_date}}</td>
	                    		<td>{{$invoice->invoice->receiver_name}}</td>
													<?php $total = $invoice->invoice->discounted_total + $invoice->invoice->VAT_amount ?>
					                <td>{{$invoice->invoice->currency}}{{$total}}</td>


	                    		@if($invoice->invoice->status == 1)
	                    		<td><div class="text-success">{{'Paid'}}</div></td>
	                    		@else
	                    		<td><div class="text-danger">{{'Unpaid'}}</div></td>
	                    		@endif

	                    	</tr>
	                    	@endforeach
                    	@endif
                    </tbody>
            </table>

		</div>
		</div>

@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>


  <script>
  	$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
} );

function SelectService(){
  $('#button').click();
}

</script>
@endsection
