@extends('layouts.frontend')
@section('title')
Slip
@endsection
@section('header')
    <section class="content-header">
      <h1>
        Salary Slip
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-paperclip"></i> Salary Slip</li>
      </ol>
    </section>
@stop
@section('content')
	
	@if(count($errors)>0)
		<ul class="list-group">
			@foreach($errors->all() as $error)
				<li class="list_group-item text-danger">
					{{ $error }}
				</li>
			@endforeach
		</ul>
	@endif


	<div class="row">
		<form action="{{route('slip')}}" method="post">
			@csrf
		<div class="col-md-6 ">
		<div class="box box-primary">
		<div class="box-body">
					<div class="form-group">
						<label for="unique">Employee Unique Id:</label>
						<input type="text" name='unique' required class="form-control">
					</div>
					<div class="form-group">
						<label for="from">From:</label>
						<input type="date" name='from' required class="form-control">
					</div>
					<div class="form-group">
						<label for="to">To:</label>
						<input type="date" name='to' required class="form-control">
					</div>

		</div>
		</div>
		<div class="form-group">
			<div class="text-center">
				<button class="btn btn-success" type="submit">Generate</button>
			</div>
		</div>
	</div>
		</form>
		
		<div class="col-md-6 ">
		<div id="tblCustomers">	
		<div class="box box-info">
		<div class="box-body" id="print">
			<table  class="table table-hover mb-0">
					
				<tbody>
					@if($employee)
					<tr><div class="text-center"><strong><h4>Salary Slip</h4></strong></div></tr>
					<div class="row">
						<tr>
							<td><strong>Employee Name:</strong></td>
							<td>{{$employee->first_name}}</td>
						</tr>
					</div>
					<div class="row">
						<tr>
							<td><strong>Total Hours:</strong></td>
							<td>{{$total_hours}}</td>
						</tr>
					</div>
					<div class="row">
						<tr>
							<td><strong>Total Wage:</strong></td>
							<td>{{$employee->currency.$total_wage}}</td>
						</tr>
					</div>
					<div class="row">
						<tr>
							<td><strong>House Rent Allowance:</strong></td>
							<td>{{$employee->currency.'0.0'}}</td>
						</tr>
					</div>
					<div class="row">
						<tr><td><strong>Medical Allowance:</strong></td>
							<td>{{$employee->currency.'0.0'}}</td>
						</tr>
					</div>
					<div class="row">
						<tr><td><strong>Other Expenses:</strong></td>
							<td>{{$employee->currency.'0.0'}}</td>
						</tr>
					</div>
					@endif
				</tbody>
				
			</table>
		</div>
		</div>
	</div>
		<div class="text-center">
		<button id="btnExport" class=" btn btn-success" onclick="Export()">PDF</button>
		</div>
		</div>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script type="text/javascript">
        function Export() {
            html2canvas(document.getElementById('tblCustomers'), {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 550
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("Table.pdf");
                }
            });
        }
    </script>

@stop