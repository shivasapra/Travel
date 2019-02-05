<?php
use Illuminate\Http\Request;
?>
@extends('layouts.frontend')
@section('title')
Client Registration
@endsection
@section('header')
	<section class="content-header">
      <h1>
        Add Client
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('clients')}}"><i class="fa fa-user-circle"></i> clients</a></li>
        <li class="active">Add Client</li>
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



			<form action="{{route('store.client')}}" method="post" enctype="multipart/form-data">
				@csrf
		<div class="box box-primary" id="action">
		<div class="box-body">
				<div class="row">
					<div class="col-md-6">
					<div class="form-group">
						<label for="first_name">First Name</label>
						<input type="text" name='first_name' required class="form-control">
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						<label for="last_name">Last Name</label>
						<input type="text" name='last_name' required class="form-control">
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
					<div class="form-group">
						<label for="address">Street</label>
						<input type="text" name='address' required class="form-control">
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						<label for="city">City</label>
						<input id="city" type="text" name='city' required class="form-control">
					</div>
					</div>
					
					
					
				</div>
				<div class="row">
					<div class="col-md-4">
					<div class="form-group">
						<label for="county">County</label>
						<input id="county" type="text" name='county' required class="form-control">
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						<label for="postal_code">Postal Code</label>
						<input id="postal_code" type="text" name='postal_code' required class="form-control">
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
					<div class="form-group">
						<label for="country">Country</label>
						<input id="country" type="text" name='country' required class="form-control">
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						<label for="phone">Phone</label>
						<input type="text" name='phone' required class="form-control">
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" name='email' required class="form-control">
					</div>
					<div class="form-group">
						<label for="passport">Do you have passport</label>
						<input type="radio" name='passport' required id="yespassport" value=1>Yes
						<input type="radio" name='passport' required id="nopassport" checked value=0>No
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						<label for="DOB">DOB</label>
						<input type="date" name='DOB' required class="form-control">
					</div>
					</div>
				</div>
				<hr>
				<div id="passport">
				</div>
				
				
		</div>
		</div>
				<div class="form-group">
					<div class="text-center">
						<button class="btn btn-success" type="submit">Add client</button>
					</div>
				</div>
			</form>

@stop
@section('js')
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script type="text/javascript">
		
		$(document).ready(function(){
	    $("#yespassport").click(function(){
	    	var data = '<div class="text-center"><h3>Passport Details</h3></div><hr><div class="row"><div class="col-md-6"><div class="form-group"><label for="passport_no">Passport Number</label><input type="text" name="passport_no" required class="form-control"></div></div><div class="col-md-6"><div class="form-group"><label for="passport_expiry_date">Passport Expire date</label><input type="date" name="passport_expiry_date" required class="form-control"></div></div></div><div class="row"><div class="col-md-6"><div class="form-group"><label for="passport_place">Place of Issue</label><input type="text" name="passport_place" required class="form-control"></div></div><div class="col-md-6"><div class="form-group"><label for="passport_issue_date">Date Of Issue</label><input type="date" name="passport_issue_date" required class="form-control"></div></div></div><div class="row"><div class="col-md-4"><div class="form-group"><label for="passport_front">Passport Front:</label><input type="file" name="passport_front" class="form-control"></div></div><div class="col-md-4"><div class="form-group"><label for="passport_back">Passport Back:</label><input type="file" name="passport_back" class="form-control"></div></div><div class="col-md-4"><div class="form-group"><label for="passport_front">Letter:</label><input type="file" name="letter" class="form-control"></div></div></div>';
	        $("#passport").html(data);   
	        });
	    });
	    $(document).ready(function(){
	    $("#nopassport").click(function(){
	    	var data = '';
	        $("#passport").html(data);   
	        });
	    });
	</script>
	{{-- <script>
		$(document).ready(function(){
    $("#country").click(function(){
    	 var postal_code = document.getElementById('postal_code').value;

    	document.getElementById('country').value = '{{json_decode(file_get_contents('https://api.postcodes.io/postcodes?q='.postal_code), true)['result'][0]['admin_ward']}}';
    	 
    	});
	});
	</script> --}}
@stop