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
<div class="box box-info">
    <div class="box-header">
        <div class="text-center">
            <h3>Personal Information</h3>
        </div>
        <div class="text-right">
            @can('Edit Client')
                <a href="{{route('edit.client',['id'=>$client->id])}}" class="btn btn-info btn-xs"><span class="fa fa-edit"></span> Edit</a>
            @endcan
        </div>
    </div>
		<div class="box-body">

			<table class="table table-hover mb-0">
				<tbody>
					<div class="row">
						<tr>
							<td><strong>Unique Id:</strong></td>
							<td>{{$client->unique_id}}</td>
						</tr>
					</div>
					<div class="row">
						<tr>
							<td><strong>First Name:</strong></td>
							<td>{{$client->first_name}}</td>
						</tr>
					</div>
					<div class="row">
						<tr>
							<td><strong>last Name:</strong></td>
							<td>{{$client->last_name}}</td>
						</tr>
                    </div>
                    <div class="row">
                        <tr>
                            <td><strong>Client Type:</strong></td>
                            <td>{{$client->client_type}}</td>
                        </tr>
                    </div>
					<div class="row">
						<tr>
							<td><strong>Street:</strong></td>
							<td>{{$client->address}}</td>
						</tr>
					</div>

					<div class="row">
						<tr>
							<td><strong>City:</strong></td>
							<td>{{$client->city}}</td>
						</tr>
					</div>

					<div class="row">
						<tr>
							<td><strong>County:</strong></td>
							<td>{{$client->county}}</td>
						</tr>
					</div>
					<div class="row">
						<tr>
							<td><strong>Postal Code:</strong></td>
							<td>{{$client->postal_code}}</td>
						</tr>
					</div>
					<div class="row">
						<tr>
							<td><strong>Country:</strong></td>
							<td>{{$client->country}}</td>
						</tr>
					</div>
					<div class="row">
						<tr>
							<td><strong>Phone:</strong></td>
							<td>{{$client->phone}}</td>
						</tr>
					</div>
					<div class="row">
						<tr>
							<td><strong>Email:</strong></td>
							<td>{{$client->email}}
								@if($client->user)
									<span class="text-success">&nbsp;&nbsp;(Verified)</span>
								@else
								<span class="text-danger">&nbsp;&nbsp;(Not Verified Yet)</span>
								@endif
							</td>
						</tr>
					</div>
					<div class="row">
						<tr>
							<td><strong>DOB:</strong></td>
							<td>{{$client->DOB}}</td>
						</tr>
					</div>
					@if($client->permanent == 1)
						<div class="row">
						<tr>
							<td><strong>Currency:</strong></td>
							<td>{{$client->currency}}</td>
						</tr>
						</div>
						<div class="row">
						<tr>
							<td><strong>Credit Limit:</strong></td>
							<td>{{$client->credit_limit}}</td>
						</tr>
						</div>
					@endif
					@if($client->passport == 1)
						<div class="row">
						<tr>
							<td><strong>Passport Number:</strong></td>
							<td>{{$client->passport_no}}
							@if($client->confirmation == 1)
								<span class="text-success">&nbsp;&nbsp;(Confirmed)</span>
							@else
							<span class="text-danger">&nbsp;&nbsp;(Not Confirmed Yet)</span>
							@endif</td>
						</tr>
						</div>
						<div class="row">
						<tr>
							<td><strong>Passport Expiry Date:</strong></td>
							<td>{{$client->passport_expiry_date}}</td>
						</tr>
						</div>
						<div class="row">
						<tr>
							<td><strong>Passport Date Of Issue:</strong></td>
							<td>{{$client->passport_issue_date}}</td>
						</tr>
						</div>
						<div class="row">
						<tr>
							<td><strong>Passport Place Of Issue:</strong></td>
							<td>{{$client->passport_place}}</td>
						</tr>
						</div>
						<div class="row">
						<tr>
							<td><strong>Passport Front:</strong></td>
							<td>
								<div class="image-div">
								<img @if(explode('.',$client->passport_front)[1] != 'pdf') src="{{asset($client->passport_front)}}" @else src="{{asset('/images/pdf.png')}}" @endif alt="passport front" height="200px" width="200px" style="border-radius:10px">
								<a href="{{asset($client->passport_front)}}" download class="download-image-icon"><i class="fa fa-download" aria-hidden="true"></i></a>
								</div>
								{{-- <img src="{{asset($client->passport_front)}}" alt="passport front" height="300px" width="300px" style="border-radius:20px"> --}}
							</td>
						</tr>
						</div>
						<div class="row">
						<tr>
							<td><strong>Passport Back:</strong></td>
							<td>
								<div class="image-div">
								<img @if(explode('.',$client->passport_back)[1] != 'pdf') src="{{asset($client->passport_back)}}" @else src="{{asset('/images/pdf.png')}}" @endif alt="passport back" height="200px" width="200px" style="border-radius:10px">
								<a href="{{asset($client->passport_back)}}" download class="download-image-icon"><i class="fa fa-download" aria-hidden="true"></i></a>
								</div>
								{{-- <img src="{{asset($client->passport_back)}}" alt="passport back" height="300px" width="300px" style="border-radius:20px"> --}}
							</td>
						</tr>
						</div>
						<div class="row">
						<tr>
							<td><strong>Letter:</strong></td>
							<td>
								<div class="image-div">
								<img @if(count(explode('.',$client->letter))>0)@if(explode('.',$client->letter)[1] != 'pdf') src="{{asset($client->letter)}}" @else src="{{asset('/images/pdf.png')}}" @endif @endif alt="letter" height="200px" width="200px" style="border-radius:10px">
								<a href="{{asset($client->letter)}}" download class="download-image-icon"><i class="fa fa-download" aria-hidden="true"></i></a>
								</div>
								{{-- <img src="{{asset($client->letter)}}" alt="letter" height="300px" width="300px" style="border-radius:20px"> --}}
							</td>
						</tr>
						</div>
					@endif
					@if($client->status != null)
						<div class="row">
						<tr>
							<td><strong>Status:</strong></td>
							<td>{{$client->status}}</td>
						</tr>
						</div>
					@endif
				</tbody>
			</table>
			@if($client->family->count()>0)
			<br><br><hr><div class="text-center"><strong>Family Members:</strong></div><hr>
			<table class="table table-hover mb-0">
				<tbody>
					<?php $i = 1?>
					@foreach($client->family as $family)
					<div class="row">
						<tr>
							<td><strong>{{$i++}}. Member Name:</strong></td>
							<td>{{$family->member_name}}</td>
						</tr>
					</div>
					<div class="row">
							<tr>
								<td><strong>&nbsp;&nbsp;&nbsp;&nbsp;Member DOB:</strong></td>
								<td>{{$family->member_DOB}}</td>
							</tr>
					</div>
					<div class="row">
							<tr>
								<td><strong>&nbsp;&nbsp;&nbsp;&nbsp;Member Passport No:</strong></td>
								<td>
									@if($family->member_passport_no != null)
										{{$family->member_passport_no}}
									@else
										<strong>{{'N/A'}}</strong>
									@endif
								</td>
							</tr>
					</div>
					<div class="row">
							<tr>
								<td><strong>&nbsp;&nbsp;&nbsp;&nbsp;Place Of Issue:</strong></td>
								<td>
									@if($family->member_passport_place != null)
										{{$family->member_passport_place}}
									@else
										<strong>{{'N/A'}}</strong>
									@endif
								</td>
							</tr>
					</div>
					<div class="row">
							<tr>
								<td><strong>&nbsp;&nbsp;&nbsp;&nbsp;Passport Front:</strong></td>
								<td>
									@if($family->member_passport_front != null)
									<div class="image-div">
									<img @if(explode('.',$family->member_passport_front)[1] != 'pdf') src="{{asset($family->member_passport_front)}}" @else src="{{asset('/images/pdf.png')}}" @endif alt="passport front" height="200px" width="200px" style="border-radius:10px">
									<a href="{{asset($family->member_passport_front)}}" download class="download-image-icon"><i class="fa fa-download" aria-hidden="true"></i></a>
									</div>
									@else
									<strong>{{'N/A'}}</strong>
									@endif
								</td>
							</tr>
						</div>
						<div class="row">
							<tr>
								<td><strong>&nbsp;&nbsp;&nbsp;&nbsp;Passport Back:</strong></td>
								<td>
									@if($family->member_passport_back != null)
									<div class="image-div">
									<img @if(explode('.',$family->member_passport_back)[1] != 'pdf') src="{{asset($family->member_passport_back)}}" @else src="{{asset('/images/pdf.png')}}" @endif src="{{asset($family->member_passport_back)}}" alt="passport front" height="200px" width="200px" style="border-radius:10px">
									<a href="{{asset($family->member_passport_back)}}" download class="download-image-icon"><i class="fa fa-download" aria-hidden="true"></i></a>
									</div>
									{{-- <img src="{{asset($family->member_passport_back)}}" alt="passport back" height="300px" width="300px" style="border-radius:20px"> --}}
									@else
									<strong>{{'N/A'}}</strong>
									@endif
									<div align='right'>
										@can('Edit Client')
										<a href="{{route('edit.family',['id'=>$family->id])}}" class="btn btn-xs btn-info">Edit</a>
										<a onClick="return confirm('Are You Sure You Want To Delete {{$family->member_name}}?')" href="{{route('delete.family',['id'=>$family->id])}}" class="btn btn-xs btn-danger">Delete</a>
										@endcan
										<br><hr>
									</div>
								</td>
							</tr>
						</div>
					@endforeach
				</tbody>
			</table>
			@endif
        </div>
    </div>
    {{-- <div class="text-center">
        @can('Edit Client')
        <a href="{{route('edit.client',['id'=>$client->id])}}" class="btn btn-info btn-xs"><span class="fa fa-edit"></span></a>
        @endcan
    </div> --}}
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
