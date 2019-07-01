@extends('layouts.frontend')
@section('title')
Client Document Movement
@endsection
@section('header')
	<section class="content-header">
      <h1>
        Client Document Movement
      <button type="button" data-toggle="modal" data-target="#modal-info" class="btn btn-sm btn-info" id="searchClient">Search Client&nbsp;&nbsp;&nbsp;<i class="fa fa-search"></i></button>
      </h1>
      <div class="modal fade" id="modal-info">
  		<div class="modal-dialog">
   			<div class="modal-content">
      <div class="modal-header" style="color:white;font-weight:500;background-color:#0066FF;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Search client</h4>
      </div>
      <form action="{{route('searchClientForDoc')}}" method="post">
        @csrf
      <div class="modal-body">
          <label for="client_name">Client Name</label>
          <input type="text" name="client_name" class="form-control" />
      </div>
      <div class="modal-footer" style="color:white;font-weight:500;background-color:#0066FF;">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-outline">Search</button>
      </div>
      </form>
    		</div>
  		</div>
	</div>

      
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-pencil-square-o"></i>Client Document Movement</li>
      </ol>
    </section>
@stop
@section('content')
	@if($invoices->count()>0)
  	<div class="box box-info">
    	<div class="box-body">
    		<table class="table table-hover mb-0">
                    <thead>
                      <tr>
                        <th>Sno.</th>
                        <th>Client Name</th>
                        <th>Phone No.</th>
                        <th>Date</th>
                        <th>Visa Applicant Name</th>
                        <th>DOB</th>
                        <th>Passport Origin</th>
                        <th>Passport No.</th>
                        <th>Visa Country</th>
                        <th>Visa Type</th>
                        <th>Action</th>
                      </tr>
                    	</thead>
                    <tbody>
                    	@if($invoices->count()>0)
                      <?php $i = 1; ?>
                        @foreach($invoices as $invoice)
                        @if(App\ClientDoc::where('visa_applicant_name',$invoice->name_of_visa_applicant)->count() == 0)
                        <tr>
                          <td>{{$i++}}</td>
                          <td>{{$invoice->invoice->receiver_name}}</td>
                          <td>{{$invoice->invoice->client->phone}}</td>
                          <td>{{$invoice->created_at->toDateString()}}</td>
                          <td>{{$invoice->name_of_visa_applicant}}</td>
                          <td>{{$invoice->passport_member_DOB}}</td>
                          <td>{{$invoice->passport_origin}}</td>
                          <td>{{$invoice->passport_no}}</td>
                          <td>{{$invoice->visa_country}}</td>
                          <td>{{$invoice->visa_type}}</td>
                          <td>
                            @can('Client Documents Movement')
                            <a href="{{route('clientDoc.store',['id'=>$invoice->id])}}" class="btn btn-xs btn-success">Add</a>
                            @endcan
                            {{-- <input type="text" value="{{$invoice->id}}" hidden id="invoiceId"> --}}
                            {{-- <button type="button" id="add" class="btn btn-xs btn-success">Add</button> --}}
                          </td>
                          </tr>
                          @endif
                        @endforeach
                      @endif
                    </tbody>
            </table>
    	</div>
	</div>
    @endif	
	<div class="box box-info">
    	<div class="box-body">
    		<table class="table table-hover mb-0">
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
                        <th>Action</th>
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
                          <td>
                            @can('Client Documents Movement')
                              <a href="{{route('clientDoc.destroy',['id'=>$doc->id])}}" class="btn btn-xs btn-danger">Remove</a>
                            @endcan
                          </td>
                          </tr>
                        @endforeach
                      @endif
                    </tbody>
            </table>
    		
    	</div>
    </div>
    
    <div class="box box-danger">
        <div class="box-body">
            <div class="text-center">
                <h2>
                    Emergency Message <br><hr>
                </h2>
            </div>
            <form action="{{route('emergency')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-7">
                      <?php $i =1;?>
                        @foreach($clients as $client)
                        <strong>{{$i++}}{{'.  '}}{{'Client Name:'}}{{' '}}{{$client->first_name}}{{' '}}{{$client->last_name}}<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{'Visa Applicants:'}}</strong>
                        @foreach($client->docs as $doc)
                        @if($doc->date == Carbon\Carbon::now()->timezone('Europe/London')->toDateString())
                        &nbsp;&nbsp;<label for="email[]">{{$doc->visa_applicant_name}}</label>
                        <input type="checkbox" name="email[]" value="{{$client->email}}">,
                        @endif
                        @endforeach <br><hr>
                        @endforeach
                    </div>
                    <div class="col-md-3">
                        <textarea type="text" name="message" class="form-control" placeholder="Enter Message"></textarea>
                    </div>
                    <div class="col-md-1">
                      @can('Client Documents Movement')
                        <button type="submit" class="btn btn-sm btn-danger">Send</button>
                      @endcan
                    </div>
                </div>
            </form>
        </div>
    </div>

	
@stop
@section('js')
<script type="text/javascript">
	$(document).ready(function(){
	$('#add').on('click', function(){
		console.log('hello');
		var id = document.getElementById('invoiceId').value;
		var params = 'id='+id;
		var Url = "http://127.0.0.1:8000/client/documents/movement/store/";
		 var xhr = new XMLHttpRequest();
		 xhr.open('GET', Url+"?"+params, true);
		 xhr.send();
		 xhr.onreadystatechange = processRequest;
			 function processRequest(e) {
			 	var response1 = JSON.parse(xhr.responseText);
			 }
		});
	});
</script>
@stop