@extends('layouts.frontend')
@section('title')
Invoice Issues
@endsection
@section('header')
	<section class="content-header">
      <h1>
        Invoice Issues
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-paperclip"></i>Invoice Issues</li>
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
						<th class="text-center">Issue</th>
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
                                <th>{{$invoice->issues}}</th>
							</tr>
							@endif
	                    	@endforeach
                    	@endif
                    </tbody>
            </table>

		</div>
		</div>
		
			{{-- <button type="button" data-toggle="modal" data-target="#modal-info" class="btn btn-sm btn-info" id="refund" style="display:none;">Refund Invoice</button> --}}
		
		
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

@stop

