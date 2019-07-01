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

	@if ($errors->any())
	<div class="alert alert-danger">
			<ul>
					@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
					@endforeach
			</ul>
	</div>
	@endif


			<form action="{{route('store.client')}}" method="post" enctype="multipart/form-data" name="myForm">
				@csrf
		<div class="box box-primary" id="action">
		<div class="box-body">
				<div class="row">
					<div class="col-md-6">
					<div class="form-group">
						<label for="first_name">First Name</label>
						<input type="text" name='first_name' value="{{old('first_name')}}" required class="form-control">
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						<label for="last_name">Last Name</label>
						<input type="text" name='last_name' value="{{old('last_name')}}" required class="form-control">
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
					<div class="form-group">
						<label for="address">Street</label>
						<input type="text" name='address' value="{{old('address')}}" required class="form-control">
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						<label for="city">City</label>
						<input id="city" type="text" name='city' value="{{old('city')}}" required class="form-control">
					</div>
					</div>



				</div>
				<div class="row">
					<div class="col-md-4">
					<div class="form-group">
						<label for="county">County</label>
						<input id="county" type="text" name='county' value="{{old('county')}}" required class="form-control">
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						<label for="postal_code">Postal Code</label>
						<input id="postal_code" type="text" name='postal_code' value="{{old('postal_code')}}" required class="form-control" onkeyup="fun()">
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
					<div class="form-group">
						<label for="country">Country</label>
						<input id="country" type="text" name='country' value="{{old('country')}}" required class="form-control">
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						<label for="phone">Phone</label>
						<input type="text" name='phone' value="{{old('phone')}}" required class="form-control" maxlength="10">
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" name='email' value="{{old('email')}}" required class="form-control">
					</div>
					</div>
					<div class="col-md-3">
					<div class="form-group">
						<label for="DOB">DOB</label>
						<input type="date" name='DOB' required class="form-control">
					</div>
                    </div>
                    <div class="col-md-3">
                    <div class="form-group">
                        <label for="client_type">Client Type:</label>
                        <select name="client_type" class="form-control">
                            <option value="">--Select--</option>
                            <option value="Corporate">Corporate</option>
                            <option value="Individual">Individual</option>
                        </select>
                    </div>
                    </div>
				</div>
				<div id="family-member"></div>
					<div class="text-center" style="margin-top: 5px">
						<button class="btn btn-sm btn-primary" type="button" id="add">Add Family Member</button>
					</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="passport">Do you have passport</label>
							<input type="radio" name='passport' required id="yespassport" value=1>Yes
							<input type="radio" name='passport' required id="nopassport" checked value=0>No
						</div>
					</div>
				</div>
				<div id="passport"></div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="passport">Do you want to make this client permanent</label>
							<input type="radio" name='permanent' required id="yespermanent" value=1>Yes
							<input type="radio" name='permanent' required id="nopermanent" checked value=0>No
						</div>
					</div>
					<div class="col-md-6">
						<div id="permanent"></div>
					</div>
				</div>



		</div>
		</div>
				<div class="form-group">
					<div class="text-center">
						@can('Create Client')
							<button class="btn btn-success" type="submit">Add client</button>
						@endcan
					</div>
				</div>
			</form>


@stop
@section('js')
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
    $("#add").click(function(){
    		var append = '<div class="hatao"><div class="row">	<div class="col-md-4">		<div class="form-group">			<label for="member_name[]">Member Name</label>			<input type="text" name="member_name[]" required class="form-control">		</div>	</div>	<div class="col-md-4">		<div class="form-group">			<label for="member_DOB[]">Member DOB</label>			<input type="date" name="member_DOB[]" value="{{$date}}" required class="form-control">		</div>	</div>	<div class="col-md-4">		<div class="form-group">			<label for="member_passport_no[]">Member Passport NO.</label>			<input type="text" name="member_passport_no[]" required class="form-control" maxlength="10">		</div>	</div></div><div class="row"><div class="col-md-4"><div class="form-group"><label for="member_passport_place">Place of Issue</label><input type="text" name="member_passport_place[]" required class="form-control"></div></div><div class="col-md-4"><div class="form-group"><label for="member_passport_front">Passport Front:</label><input type="file" name="member_passport_front[]" class="form-control"></div></div><div class="col-md-4"><div class="form-group"><label for="member_passport_back">Passport Back:</label><input type="file" name="member_passport_back[]" class="form-control"></div></div></div><div align="right">						<input type="button" class="btn btn-danger btn-xs" value="Remove" onclick="SomeDeleteRowFunction(this);">	</div></div>';
        $("#family-member").append(append);
        });
    });
	function SomeDeleteRowFunction(btndel) {
    if (typeof(btndel) == "object") {
        $(btndel).closest('.hatao').remove();
    } else {
        return false;
    }}


		$(document).ready(function(){
	    $("#yespassport").click(function(){
	    	var data = '<hr><div class="text-center"><h3>Passport Details</h3></div><hr><div class="row"><div class="col-md-6"><div class="form-group"><label for="passport_no">Passport Number</label><input type="text" name="passport_no" required class="form-control" maxlength="10"></div></div><div class="col-md-6"><div class="form-group"><label for="passport_expiry_date">Passport Expire date</label><input type="date" name="passport_expiry_date" required class="form-control"></div></div></div><div class="row"><div class="col-md-6"><div class="form-group"><label for="passport_place">Place of Issue</label><input type="text" name="passport_place" required class="form-control"></div></div><div class="col-md-6"><div class="form-group"><label for="passport_issue_date">Date Of Issue</label><input type="date" name="passport_issue_date" required class="form-control"></div></div></div><div class="row"><div class="col-md-4"><div class="form-group"><label for="passport_front">Passport Front:</label><input type="file" name="passport_front" class="form-control"></div></div><div class="col-md-4"><div class="form-group"><label for="passport_back">Passport Back:</label><input type="file" name="passport_back" class="form-control"></div></div><div class="col-md-4"><div class="form-group"><label for="passport_front">Letter:</label><input type="file" name="letter" class="form-control"></div></div></div><hr>';
	        $("#passport").html(data);
	        });
	    });
	    $(document).ready(function(){
	    $("#nopassport").click(function(){
	    	var data = '';
	        $("#passport").html(data);
	        });
	    });

	    $(document).ready(function(){
	    $("#yespermanent").click(function(){
	    	var data = '<div class="row"><div class="col-md-6"><div class="form-group"><label for="currency">Currency</label><select name="currency" class="form-control" id="currency"><option value="$">$</option><option value="&#163;" selected>&#163;</option></select></div></div><div class="col-md-6"><div class="form-group"><label for="credit_limit">Credit Limit</label><input type="text" name="credit_limit" required class="form-control"></div></div></div>';
	        $("#permanent").html(data);
	        });
	    });
	    $(document).ready(function(){
	    $("#nopermanent").click(function(){
	    	var data = '';
	        $("#permanent").html(data);
	        });
	    });
	    function fun() {
			 var x = document.forms["myForm"]["postal_code"].value;

			 var Url = "https://api.postcodes.io/postcodes?q=" + x;
			 var xhr = new XMLHttpRequest();
			 xhr.open('GET', Url, true);
			 xhr.send();
			 xhr.onreadystatechange = processRequest;
			 function processRequest(e) {
			 if (xhr.readyState == 4 && xhr.status == 200) {
			 // alert(xhr.responseText);
			 var response1 = JSON.parse(xhr.responseText);
			 console.log(response1);

			 document.getElementById("city").value = response1.result[0].admin_ward;
			 document.getElementById("country").value = response1.result[0].country;
			 document.getElementById("county").value = response1.result[0].admin_county;
			 }
			 }
			 }
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
