@extends('layouts.frontend')
@section('title')
Expenses
@endsection
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
@stop
@section('header')
	<section class="content-header">
      <h1>
        Expenses
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-paperclip"></i>Expenses</li>
      </ol>
    </section>
@stop
@section('content')
	
		<div class="box box-info">
			<div class="box-body">
				
			
			<table id="example" class="table table-striped display" style="width:100%">
                    <thead>
                      <tr>
                        <th>Sno.</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Description</th>
                        <th>Company Name</th>
                        <th>Invoice No</th>
                      </tr>
                      </thead>
                    <tbody>
                      @if($expenses->count()>0)
                      <?php $i = 1; ?>
                        @foreach($expenses as $expense)
                        <tr>
                          <td>{{$i++}}</td>
                          <td>{{$expense->date}}</td>
                          <td>{{$expense->amount}}</td>
                          <td>{{$expense->description}}</td>
                          <td>
                            @if($expense->company_name)
                              {{$expense->company_name}}
                            @else
                              <strong>{{"N/A"}}</strong>
                            @endif
                          </td>
                          <td>
                            @if($expense->invoice_no)
                              {{$expense->invoice_no}}
                            @else
                              <strong>{{"N/A"}}</strong>
                            @endif
                          </td>
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
</script>
@endsection
