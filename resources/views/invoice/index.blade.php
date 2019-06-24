@extends('layouts.frontend')
@section('title')
Invoices
@endsection
@section('header')
	<section class="content-header">
      <h1>
        Invoice
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-paperclip"></i>Invoice</li>
      </ol>
    </section>
@stop
@section('content')

		<div class="box box-info">
			<div class="box-body">


			<table id="myTable" class="table table-striped table-bordered">
                    <thead id="ignorePDF">
                      <tr>
                        <th>Invoice No.</th>
                        <th>Invoice Date</th>
                        <th>Receiver Name</th>
                        <th>Total</th>
                        <th>Status</th>
						<th class="text-center">Action</th>
						<th class="text-center">Cancel Invoice</th>
						<th class="text-center">Pay</th>
						<th class="text-center">Reminder</th>
                      </tr>
                    	</thead>
                    <tbody>
                    	@if($invoices->count()>0)

	                    	@foreach($invoices as $invoice)
	                    	<tr>
	                    		<td>{{$invoice->invoice_no}}</td>
	                    		<td>{{$invoice->invoice_date}}</td>
	                    		<td>{{$invoice->receiver_name}}</td>
					                <?php $total = $invoice->discounted_total + $invoice->VAT_amount ?>
					                <td>{{$invoice->currency}}{{$total}}</td>
	                    		@if($invoice->status == 1)
	                    		<td><div class="text-success">{{'Paid'}}</div></td>
	                    		@else
	                    		<td><div class="text-danger">{{'Unpaid'}}</div></td>
	                    		@endif
	                    		{{-- <td><button class="btn btn-xs btn-success" id="pdf">PDF</button></td> --}}
	                    		<td class="text-center">
								<a href="{{route('invoice.view',['id'=>$invoice->id])}}" class="btn btn-info btn-xs"><span class="fa fa-eye"></span></a>
								<a href="{{route('invoice.edit',['id'=>$invoice->id])}}" class="btn btn-info btn-xs"><span class="fa fa-edit"></span></a>
								</td>
								{{-- @if($invoice->status == 0) --}}
									<td class="text-center"><a href="{{route('invoice.delete',['id'=>$invoice->id])}}" {{($invoice->status == 1)?"disabled":" "}} class="btn btn-danger btn-xs">Cancel</a></td>
									<td class="text-center"><a href="{{route('invoice.pay',['id'=>$invoice->id])}}" {{($invoice->status == 1)?"disabled":" "}} class="btn btn-primary btn-xs">Pay</a></td>
									<td class="text-center"><a href="{{route('invoice.reminder',['id'=>$invoice->id])}}" {{($invoice->status == 1)?"disabled":" "}} class="btn btn-warning btn-xs">Send Reminder</a></td>
								{{-- @else --}}
								{{-- <td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td> --}}
								{{-- @endif --}}
	                    	</tr>
	                    	@endforeach
                    	@endif
                    </tbody>
            </table>

		</div>
		</div>
		<div class="text-center">
			<a href="{{route('invoice.create')}}">
				<button class="btn btn-success">Create</button>
			</a>
		</div>
@endsection
@section('js')
<script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>
<script>
	$(document).ready(function(){
    $("#pdf").click(function(){
	var doc = new jsPDF()
	var source = document.getElementById('myTable');
	doc.fromHTML(source);
	doc.output("dataurlnewwindow");
	});
	});
</script>
@stop

