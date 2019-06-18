@extends('layouts.frontend')
@section('title')
Dashboard
@endsection
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
@stop
@section('header')
    <section class="content-header">
          <h1>
            Dashboard
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
    </section>
@stop
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Invoices </h3>
    </div>
    <div class="box-body">
    <table id="example" class="table table-striped">
        <thead >
            <tr>
            <th>Invoice No.</th>
            <th>Invoice Date</th>
            <th>Receiver Name</th>
            <th>Total</th>
            <th>Status</th>
            <th>Action</th>
            </tr>
            </thead>
        <tbody>
        @foreach(Auth::user()->client->invoices as $invoice)
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
            <td>
                <a href="{{route('invoice.view',['id'=>$invoice->id])}}" class="btn btn-info btn-xs"><span class="fa fa-eye"></span></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
    </div>
</div>
@stop
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
            
        ]
    } );
} );
</script>
@endsection
