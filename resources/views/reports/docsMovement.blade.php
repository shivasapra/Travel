@extends('layouts.frontend')
@section('title')
Client Document Movement Report
@endsection
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
@stop
@section('header')
	<section class="content-header">
      <h1>
        Client Document Movement Report
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-paperclip"></i>Client Document Movement Report</li>
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
                        <th>Client Name</th>
                        <th>Phone No.</th>
                        <th>Visa Applicant Name</th>
                        <th>DOB</th>
                        <th>Passport Origin</th>
                        <th>Passport No.</th>
                        <th>Visa Country</th>
                        <th>Visa Type</th>
                      </tr>
                    	</thead>
                    <tbody>
                    	@if($docs->count()>0)
                      <?php $i = 1; ?>
                        @foreach($docs as $doc)
                        <tr>
                          <td>{{$i++}}</td>
                          <td>{{$doc->date}}</td>
                          <td>{{$doc->client_name}}</td>
                          <td>{{$doc->mobile}}</td>
                          <td>{{$doc->visa_applicant_name}}</td>
                          <td>{{$doc->DOB}}</td>
                          <td>{{$doc->passport_origin}}</td>
                          <td>{{$doc->passport_no}}</td>
                          <td>{{$doc->visa_country}}</td>
                          <td>{{$doc->visa_type}}</td>
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
