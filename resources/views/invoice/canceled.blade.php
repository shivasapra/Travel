@extends('layouts.frontend')
@section('title')
Canceled Invoices
@endsection
@section('header')
	<section class="content-header">
      <h1>
       Canceled Invoice
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-paperclip"></i>Canceled Invoice</li>
      </ol>
    </section>
@stop
@section('content')
	
		<div class="box box-info">
			<div class="box-body">
				
			
			<table id="myTable" class="table table-striped">
                    <thead id="ignorePDF">
                      <tr>
                        <th>Invoice No.</th>
                        <th>Invoice Date</th>
                        <th>Receiver Name</th>
                        <th>Total</th>
                        <th>Status</th>
                        {{-- <th>PDF</th> --}}
                        <th>Action</th>
                        {{-- <th>Delete</th> --}}
                      </tr>
                    	</thead>
                    <tbody>
                    	@if($invoices->count()>0)
                    	
	                    	@foreach($invoices as $invoice)
	                    	<tr>
	                    		<td>{{$invoice->invoice_no}}</td>
	                    		<td>{{$invoice->invoice_date}}</td>
	                    		<td>{{$invoice->receiver_name}}</td>
								
					                <td>{{$invoice->currency}}{{number_format( (float) ($invoice->discounted_total + $invoice->VAT_amount), 2, '.', '')}}</td>

							<th><span class="text-danger">{{'Canceled'}}</span></th>
	                    		{{-- <td><button class="btn btn-xs btn-success" id="pdf">PDF</button></td> --}}
	                    		<td>
	                    			{{-- <a href="{{route('invoice.edit',['id'=>$invoice->id])}}" class="btn btn-info btn-xs"><span class="fa fa-edit"></span></a> --}}
                                    <a href="{{route('invoice.view',['id'=>$invoice->id])}}" class="btn btn-info btn-xs"><span class="fa fa-eye"></span></a>
                                    <a href="{{route('invoice.retrieve',['id'=>$invoice->id])}}" class="btn btn-success btn-xs">Retrieve</a>
                                    {{-- <a href="{{route('invoice.kill',['id'=>$invoice->id])}}" class="btn btn-danger btn-xs">Delete</a> --}}
	                    		</td>
	                    		{{-- <td><a href="{{route('invoice.delete',['id'=>$invoice->id])}}" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a></td> --}}
	                    	</tr>
	                    	@endforeach
                    	@endif
                    </tbody>
            </table>
        
		</div>
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

