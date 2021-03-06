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
						@if(!Auth::user()->client)
							<th>Confirmation</th>
						@endif
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
								<td class="text-center">
									<div class="btn-group">
										<button type="button" class="btn bg-teal">Action</button>
										<button type="button" class="btn bg-teal dropdown-toggle" data-toggle="dropdown">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<ul class="dropdown-menu" role="menu">
											@can('View Invoices')
											<li><a href="{{route('invoice.view',['id'=>$invoice->id])}}" style="color:white" class="btn bg-aqua btn-xs"> View</a></li>
											@endcan
											@can('Edit Invoice')
											<li><a href="{{route('invoice.edit',['id'=>$invoice->id])}}" style="color:white;margin-top:2px;" class="btn bg-purple btn-xs"> Edit</a></li>
											@endcan
											@if(!Auth::user()->client)
												@if($invoice->status == 0)
													@can('Cancel Invoice')
														<li class="test"><a onClick="return confirm('Are You Sure You Want To Cancel This Invoice')" href="{{route('invoice.delete',['id'=>$invoice->id])}}" {{($invoice->status == 1)?"disabled":" "}} style="color:white;margin-top:2px;" class="btn bg-red btn-xs">Cancel</a></li>
													@endcan
													@else
													@can('Refund Invoice')
														<li class="test">
															<input type="text" value="{{$invoice->id}}" class="inv_id" hidden>
															<input type="text" value="{{$invoice->invoice_no}}" class="inv_no" hidden>
															<input type="text" value="{{number_format( (float) ($invoice->discounted_total + $invoice->VAT_amount), 2, '.', '')}}" class="inv_total" hidden>
															<a type="button" onClick="Fun(this);" class="btn bg-success btn-xs" style="color:white;margin-top:2px;">Refund</a>
														</li>
													@endcan
												@endif
												@if($invoice->status == 0)
													@can('Pay Invoice')
														<li><a href="{{route('invoice.pay',['id'=>$invoice->id])}}" style="color:white;margin-top:2px;" class="btn bg-success btn-xs">Pay</a></li>
													@endcan
												
													@can('Send Reminder For Unpaid Invoice')
														<li><a href="{{route('invoice.reminder',['id'=>$invoice->id])}}" style="color:white;margin-top:2px;" class="btn bg-maroon btn-xs">Send Reminder</a></li>
													@endcan
												@endif
											@endif
										</ul>
									</div>
								</td>

							@if(!Auth::user()->client)
									<td>
									@if($invoice->confirmation)
									<span class="text-success"><b>{{'Confirmed By Client'}}</b><br>Through: <br>{{$invoice->confirmation_via}}</span><br>
									<a onClick="return confirm('Are You Sure You Want To Send Commercial Invoice')" href="{{route('send.commercial.invoice',['id'=>$invoice->id])}}" class="btn btn-xs btn-success">Send Commercial Invoice</a>
									@else
										<span class="text-danger"><b>{{'Not Yet Confirmed By Client'}}</b></span>
										<br>
										@can('Confirm Invoice')
										<a onClick="return confirm('Are You Sure You Want To Confirm Invoice')" href="{{route('confirm.via.paperprint',['id'=>$invoice->id])}}" class="btn btn-xs btn-success">Confirm Via Paper-Print</a>
										@endcan
										<br>
										@if($invoice->issues != null)
											<a href="{{route('invoice.issue',['id'=>$invoice->id])}}" class="btn btn-primary btn-xs">Issue Raised By Client</a>
										@endif
									@endif
									</td>
								@endif
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
				@can('Generate Invoice')
					<button class="btn btn-success">Create</button>
				@endcan
			</a>
			@can('Refund Invoice')
				<button type="button" data-toggle="modal" data-target="#modal-info" class="btn btn-sm btn-info" id="refund" style="display:none;">Refund Invoice</button>
			@endcan
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>


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
		var inv_no = $(temp).parents('.test').find('.inv_no').val();
		var inv_total = $(temp).parents('.test').find('.inv_total').val();
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

			'<label for="total">Total:</label>'+
			'<input type="text" name="total" class="form-control" value="'+inv_total+'" readonly/>'+

			'<label for="refunded_amount">Enter Amount To Refund:</label>'+
			'<input type="text" name="refunded_amount" class="form-control mask-money" max="'+inv_total+'" required/>'+
			'<label for="refund_remarks">Remarks:</label>'+
			'<textarea name="refund_remarks" id="" class="form-control" cols="30" rows="10"></textarea>'+
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
	  $('.mask-money').maskMoney();
	  $('#refund').click();}
	}
</script>
@stop

