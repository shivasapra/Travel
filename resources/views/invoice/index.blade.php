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
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
@stop
@section('content')

		<div class="box box-info">
			<div class="box-body">


			<table id="myTable" class="table table-striped table-bordered"  >
                    <thead id="ignorePDF">
                      <tr>
                        <th>Invoice No.</th>
                        <th>Invoice Date</th>
                        <th>Receiver Name</th>
                        <th>Total</th>
                        <th>Status</th>
						<th class="text-center">Action</th>
						<th class="text-center">Cancel/Refund Invoice</th>
						<th class="text-center">Pay</th>
						<th class="text-center">Reminder</th>
						<th>##</th>
                      </tr>
                    	</thead>
                    <tbody>
                    	@if($invoices->count()>0)

							@foreach($invoices as $invoice)
							@if($invoice->refund == 0)
	                    	<tr>
	                    		<td>{{$invoice->invoice_no}}</td>
	                    		<td>{{$invoice->invoice_date}}</td>
	                    		<td>{{$invoice->receiver_name}}</td>
					                <td>{{$invoice->currency}}{{number_format( (float) ($invoice->discounted_total + $invoice->VAT_amount), 2, '.', '')}}</td>
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
								<td class="text-center test">
									@if($invoice->status == 0)
									<a onClick="return confirm('Are You Sure You Want To Cancel This Invoice')" href="{{route('invoice.delete',['id'=>$invoice->id])}}" {{($invoice->status == 1)?"disabled":" "}} class="btn btn-danger btn-xs">Cancel</a>
									@else
									{{-- <a href="{{route('invoice.refund',['id'=>$invoice->id])}}" {{($invoice->status == 0)?"disabled":" "}} class="btn btn-success btn-xs">Refund</a> --}}
									<input type="text" value="{{$invoice->id}}" class="inv_id" hidden>
									<input type="text" value="{{$invoice->invoice_no}}" class="inv_no" hidden>
											<button   type="button" onClick="Fun(this);" class="btn btn-success btn-xs">Refund</button>
										@endif
									</td>
									<td class="text-center"><a href="{{route('invoice.pay',['id'=>$invoice->id])}}" {{($invoice->status == 1)?"disabled":" "}} class="btn btn-primary btn-xs">Pay</a></td>
									<td class="text-center"><a href="{{route('invoice.reminder',['id'=>$invoice->id])}}" {{($invoice->status == 1)?"disabled":" "}} class="btn btn-warning btn-xs">Send Reminder</a></td>
									<td>
									@if($invoice->confirmation)
									<span class="text-success"><b>{{'Confirmed By Client'}}</b><br>Through: <br>{{$invoice->confirmation_via}}</span>
									@else
										<span class="text-danger"><b>{{'Not Yet Confirmed By Client'}}</b></span>
										<br><a href="{{route('confirm.via.paperprint',['id'=>$invoice->id])}}" class="btn btn-xs btn-success">Confirm Via Paper-Print</a>
									@endif
									</td>
							</tr>
							@endif
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
			<button type="button" data-toggle="modal" data-target="#modal-info" class="btn btn-sm btn-info" id="refund" style="display:none;">Refund Invoice</button>
		</div>
		<div id="append"></div>
		
@endsection
@section('js')
<script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>


  <script>
  	$(document).ready(function() {
    $('#myTable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
        ]
    } );
} );
</script>
<script>
	$(document).ready(function(){
    $("#pdf").click(function(){
	var doc = new jsPDF()
	var source = document.getElementById('myTable');
	doc.fromHTML(source);
	doc.output("dataurlnewwindow");
	});
	});

	function Fun(temp){
		var foo = confirm('Are You Sure You Want To Refund This Invoice');
		if(foo){
		var inv_id = $(temp).parents('.test').find('.inv_id').val();
		// alert(inv_id);
		var inv_no = $(temp).parents('.test').find('.inv_no').val();
		// $(temp).parents('.fare-parent').find('.fare').val(fare_sell.toFixed(2));
		// console.log(inv_id);
		
		var data = '<div class="modal fade" id="modal-info">'+
			'<div class="modal-dialog">'+
				 '<div class="modal-content">'+
		'<div class="modal-header" style="color:white;font-weight:500;background-color:#0066FF;">'+
		  '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
			'<span aria-hidden="true">&times;</span></button>'+
		  '<h4 class="modal-title">Refund Invoice</h4>'+
		'</div>'+
		'<form action="/cloud/public/refund/invoice/'+inv_id+'" method="post">'+
		  '@csrf'+
		'<div class="modal-body">'+
			'<label for="invoice_no">Invoice No:</label>'+
			'<input type="text" name="invoice_no" class="form-control" value="'+inv_no+'" readonly />'+
			'<label for="refund_remarks">Remarks:</label>'+
			
			'<textarea name="refund_remarks" id="" class="form-control" cols="30" rows="10"></textarea>'+
			'<label for="refunded_amount">Enter Amount To Refund::</label>'+
			'<input type="text" name="refunded_amount" class="form-control" mask-money />'+
		'</div>'+
		'<div class="modal-footer" style="color:white;font-weight:500;background-color:#0066FF;">'+
		  '<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>'+
		  '<button type="submit" class="btn btn-outline">Refund</button>'+
		'</div>'+
		'</form>'+
			  '</div>'+
			'</div>'+
	  '</div>';
	  $('#append').html(data);
	  $('#refund').click();}
	}
	window.setInterval(function(){
        $('.mask-money').maskMoney();
}, 500);
</script>
@stop

