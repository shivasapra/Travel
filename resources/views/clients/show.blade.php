@extends('layouts.frontend')
@section('title')
client
@endsection
@section('header')
	<section class="content-header">
      <h1>
        Client
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('clients')}}"><i class="fa fa-user-circle"></i> clients</a></li>
        <li class="active">Client</li>
      </ol>
    </section>
@stop
@section('content')

	<div class="box box-info">
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
							<td>{{$client->email}}</td>
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
								<span class="text-success">&nbsp;&nbsp;(Confirmed by client)</span>
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
								<img src="{{asset($client->passport_front)}}" alt="passport front" height="300px" width="300px" style="border-radius:20px">
							</td>
						</tr>
						</div>
						<div class="row">
						<tr>
							<td><strong>Passport Back:</strong></td>
							<td>
								<img src="{{asset($client->passport_back)}}" alt="passport back" height="300px" width="300px" style="border-radius:20px">
							</td>
						</tr>
						</div>
						<div class="row">
						<tr>
							<td><strong>Letter:</strong></td>
							<td>
								<img src="{{asset($client->letter)}}" alt="letter" height="300px" width="300px" style="border-radius:20px">
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
								<td>{{$family->member_passport_no}}</td>
							</tr>
					</div>
					<div class="row">
							<tr>
								<td><strong>&nbsp;&nbsp;&nbsp;&nbsp;Place Of Issue:</strong></td>
								<td>{{$family->member_passport_place}}</td>
							</tr>
					</div>
					<div class="row">
							<tr>
								<td><strong>&nbsp;&nbsp;&nbsp;&nbsp;Passport Front:</strong></td>
								<td>
									@if($family->member_passport_front != null)
									<img src="{{asset($family->member_passport_front)}}" alt="passport front" height="300px" width="300px" style="border-radius:20px">
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
									<img src="{{asset($family->member_passport_back)}}" alt="passport back" height="300px" width="300px" style="border-radius:20px">
									@else
									<strong>{{'N/A'}}</strong>
									@endif
									<div align='right'>
										<a href="{{route('edit.family',['id'=>$family->id])}}" class="btn btn-xs btn-danger">Edit</a><br><hr>
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

@endsection