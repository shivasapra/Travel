@extends('layouts.frontend')
@section('title')
Employee Registration
@endsection
@section('header')
	<section class="content-header">
      <h1>
        Add Employee
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('employees')}}"><i class="fa fa-pencil-square-o"></i>Employess</a></li>
        <li class="active">Add Employee</li>
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



	<form action="{{route('store.employee')}}" method="post" enctype="multipart/form-data">
				@csrf
		
			<div class="box box-info">
				<div class="box-header with-border">
                  <h3 class="box-title"><strong>{{"Personal Inforamtion"}}</strong></h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
			<div class="box-body">
			{{-- <div class="text-center"><h4><strong>{{"Personal Inforamtion"}}</strong></h4></div><br> --}}
			<div class="row">
					<div class="col-md-4">
					<div class="form-group">
						<label for="first_name">First Name</label>
						<input type="text" name='first_name' required class="form-control">
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="middle_name">Middle Name</label>
						<input type="text" name='middle_name'  required class="form-control">
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="last_name">Last Name</label>
						<input type="text" name='last_name' required class="form-control">
					</div>
					</div>
					</div>
					<div class="row">
					<div class="col-md-6">
					<div class="form-group">
						<label for="father_name">Father's Name</label>
						<input type="text" name='father_name' class="form-control" required>
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						<label for="mother_name">Mother's Name</label>
						<input type="text" name='mother_name' class="form-control" required>
					</div>
					</div>
					</div>
					<div class="row">
					<div class="col-md-4">
					<div class="form-group">
						<label for="gender">Gender</label>
						<select name="gender" class="form-control"required>
							<option value="">{{"---Select Gender---"}}</option>
							<option value="Male" class="form-control">Male</option>
							<option value="Female" class="form-control">Female</option>
							<option value="Others" class="form-control">Others</option>
						</select>
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="DOB">Date of Birth</label>
						<input type="date" name='DOB' max="{{$date}}" class="form-control"required>
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="marital_status">Marital Status</label>
						<select name="marital_status" class="form-control"required>
							<option value="">{{"---Select status---"}}</option>
							<option value="Married" class="form-control">Married</option>
							<option value="Unmarried" class="form-control">Unmarried</option>
							<option value="Divorced" class="form-control">Divorced</option>
							<option value="Widowed" class="form-control">Widowed</option>
						</select>
					</div>
					</div>
					</div>
					<div class="row">
					<div class="col-md-3">
					<div class="form-group">
						<label for="disability">Disability</label>
						<input type="text" name='disability' class="form-control">
					</div>
					</div>
					<div class="col-md-3">
					<div class="form-group">
						<label for="blood_group">Blood Group</label>
						<select name="blood_group" class="form-control">
							<option value="">{{"---Select one---"}}</option>
							<option value="A+" class="form-control">A+</option>
							<option value="A-" class="form-control">A-</option>
							<option value="A Unknown" class="form-control">A Unknown</option>
							<option value="B+" class="form-control">B+</option>
							<option value="B-" class="form-control">B-</option>
							<option value="B Unknown" class="form-control">B Unknown</option>
							<option value="AB+" class="form-control">AB+</option>
							<option value="AB-" class="form-control">AB-</option>
							<option value="AB Unknown" class="form-control">AB Unknown</option>
							<option value="O+" class="form-control">O+</option>
							<option value="O-" class="form-control">O-</option>
							<option value="O Unknown" class="form-control">O Unknown</option>
							<option value="Unknown" class="form-control">Unknown</option>
						</select>
					</div>
					</div>
					<div class="col-md-3">
					<div class="form-group">
						<label for="country">Country</label>
						<input type="text" name='country' class="form-control"required>
					</div>
					</div>
					<div class="col-md-3">
					<div class="form-group">
						<label for="county">County</label>
						<input type="text" name='county' class="form-control"required>
					</div>
					</div>
					</div>
					<div class="row">
					{{-- <div class="col-md-4">
					<div class="form-group">
						<label for="passport">Passport</label>
						<input type="text" name='passport' class="form-control"required>
					</div>
					</div> --}}
					<div class="col-md-6">
					<div class="form-group">
						<label for="visa">Visa</label>
						<input type="text" name='visa' class="form-control"required>
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						<label for="visa_expired">Visa valid upto</label>
						<input type="date" name='visa_expired' class="form-control"required>
					</div>
					</div>
					</div>
			</div>
			</div>
		
			<div class="box box-success">
				<div class="box-header with-border">
                  <h3 class="box-title"><strong>{{"Contact Information"}}</strong></h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
			<div class="box-body">
			{{-- <div class="text-center"><h4><strong>{{"Contact Information"}}</strong></h4></div><br> --}}
				<div class="row">
					<div class="col-md-4">
					<div class="form-group">
						<label for="permanent_address">Permanent Home Address</label>
						<input type="text" name='permanent_address' class="form-control"required>
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="temporary_address">Temporary Home Address</label>
						<input type="text" name='temporary_address' class="form-control"required>
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="home_phone">Home Phone</label>
						<input type="text" name='home_phone' class="form-control"required>
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
					<div class="form-group">
						<label for="mobile_phone">Mobile Phone</label>
						<input type="text" name='mobile_phone' class="form-control"required>
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						<label for="email">Email</label>
						<input type="text" name='email' class="form-control"required>
					</div>
					</div>
				</div>
				</div>
				</div>
			<div class="box box-info">
				<div class="box-header with-border">
                  <h3 class="box-title"><strong>{{"Professional Information"}}</strong></h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
			<div class="box-body">
			{{-- <div class="text-center"><h4><strong>{{"Professional Information"}}</strong></h4></div><br> --}}
				<div class="row">
					<div class="col-md-4">
					<div class="form-group">
						<label for="qualification">Quaification</label>
						<input type="text" name='qualification' class="form-control"required>
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="experience">Experience</label>
						<input type="text" name='experience' class="form-control"required>
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="exp_in_dept">Experience In: Department</label>
						<input type="text" name='exp_in_dept' class="form-control"required>
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
					<div class="form-group">
						<label for="hired_for_dep">Hired For: Department</label>
						<input type="text" name='hired_for_dep' class="form-control"required>
					</div>
					</div>
					<div class="col-md-3">
					<div class="form-group">
						<label for="hiring_date">Hiring Date</label>
						<input type="date" name='hiring_date' class="form-control"required>
					</div>
					</div>
					<div class="col-md-2">
					<div class="form-group">
						<label for="currency">Currency</label>
						<select name="currency" class="form-control"required>
							<option value="" class="form-control"></option>
							<option value="$" class="form-control">$</option>
							<option value="&#163;">&#163;</option>
						</select>
					</div>
					</div>
					<div class="col-md-2">
					<div class="form-group">
						<label for="rate">Rate Contract</label>
						<input type="text" name='rate' class="form-control"required>
					</div>
					</div>
					<div class="col-md-2">
					<div class="form-group">
						<label for="per">Per</label>
						<select name="per" class="form-control"required>
							<option value="" class="form-control">--Select--</option>
							<option value="Hour" class="form-control">Hour</option>
							<option value="Month" class="form-control">Month</option>
						</select>
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="work_permit">Work Permit:</label>
							<input type="file" name="work_permit" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="utility_bill">Utility Bill:</label>
							<input type="file" name="utility_bill" class="form-control">
						</div>
					</div>
				</div>
				</div>
			</div>
			<div class="form-group">
						<label for="passport">Do you have passport</label>
						<input type="radio" name='passport' required id="yespassport" value=1>Yes
						<input type="radio" name='passport' required id="nopassport" checked value=0>No
					</div>
			
			<div id="passport">
				
			</div>
			<div class="box box-danger">
				<div class="box-header with-border">
                  <h3 class="box-title"><strong>{{"Emergency Contact Information"}}</strong></h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
			<div class="box-body">
			{{-- <div class="text-center"><h4><strong>{{"Emergency Contact Information"}}</strong></h4></div><br> --}}
				<div class="row">
					<div class="col-md-6">
					<div class="form-group">
						<label for="emer_contact_name">Contact Name</label>
						<input type="text" name='emer_contact_name' class="form-control"required>
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						<label for="emer_contact_address">Contact Address</label>
						<input type="text" name='emer_contact_address' class="form-control"required>
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
					<div class="form-group">
						<label for="emer_contact_phone">Contact Phone No.</label>
						<input type="text" name='emer_contact_phone' class="form-control"required>
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="emer_contact_email">Contact Email</label>
						<input type="text" name='emer_contact_email' class="form-control"required>
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="emer_contact_ralation">Relation</label>
						<input type="text" name='emer_contact_ralation' class="form-control"required>
					</div>
					</div>
				</div>
				</div>
			</div>
			<div class="box box-info">
				<div class="box-header with-border">
                  <h3 class="box-title"><strong>{{"Account Information"}}</strong></h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
				<div class="box-body">
				{{-- <div class="text-center"><h4><strong>{{"Account Information"}}</strong></h4></div><br> --}}
				<div class="row">
					<div class="col-md-6">
					<div class="form-group">
						<label for="sort_code">SORT Code</label>
						<input type="text" name='sort_code' class="form-control"required>
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						<label for="account_no">Account No</label>
						<input type="text" name='account_no' class="form-control"required>
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
					<div class="form-group">
						<label for="bank_name">Bank Name</label>
						<input type="text" name='bank_name' class="form-control"required>
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						<label for="bank_address">Bank Address</label>
						<input type="text" name='bank_address' class="form-control"required>
					</div>
					</div>
				</div>
				<div class="row">
					{{-- <div class="col-md-3">
					<div class="form-group">
						<label for="income_tax_no">Income Tax No.</label>
						<input type="text" name='income_tax_no' class="form-control"required>
					</div>
					</div> --}}
					<div class="col-md-6">
					<div class="form-group">
						<label for="tax_ref_no">Tax Ref No.</label>
						<input type="text" name='tax_ref_no' class="form-control"required>
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						<label for="national_insurance_no">National Insurance No.</label>
						<input type="text" name='national_insurance_no' class="form-control"required>
					</div>
					</div>
				</div>
				</div>
			</div>
			
			
			<div class="form-group">
				<div class="text-center">
					<button class="btn btn-success" type="submit">Add employee</button>
				</div>
			</div>
			</form>
			<button type="button" onclick="scan();">Scan</button> <!-- Triggers scan -->   
			<div id="images"/> <!-- Displays scanned images  -->
		
		


@stop
@section('js')
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="bower_components/scanner/dist/scanner.js"></script>
	<script type="text/javascript">
		
		$(document).ready(function(){
	    $("#yespassport").click(function(){
	    	var data = '<div class="box box-info"><div class="box-header with-border"><h3 class="box-title"><strong>{{"Passport Information"}}</strong></h3><div class="box-tools pull-right"><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button><button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button></div></div><div class="box-body"><div class="row"><div class="col-md-6"><div class="form-group"><label for="passport_no">Passport Number</label><input type="text" name="passport_no" required class="form-control"></div></div><div class="col-md-6"><div class="form-group"><label for="passport_expiry_date">Passport Expire date</label><input type="date" name="passport_expiry_date" required class="form-control"></div></div></div><div class="row"><div class="col-md-6"><div class="form-group"><label for="passport_place">Place of Issue</label><input type="text" name="passport_place" required class="form-control"></div></div><div class="col-md-6"><div class="form-group"><label for="passport_issue_date">Date Of Issue</label><input type="date" name="passport_issue_date" required class="form-control"></div></div></div><div class="row"><div class="col-md-6"><div class="form-group"><label for="passport_front">Passport Front:</label><input type="file" name="passport_front" class="form-control"></div></div><div class="col-md-6"><div class="form-group"><label for="passport_back">Passport Back:</label><input type="file" name="passport_back" class="form-control"></div></div></div></div></div>';
	        $("#passport").html(data);   
	        });
	    });
	    $(document).ready(function(){
	    $("#nopassport").click(function(){
	    	var data = '';
	        $("#passport").html(data);   
	        });
	    });


			    var scanRequest = {
		    "use_asprise_dialog": true, // Whether to use Asprise Scanning Dialog
		    "show_scanner_ui": false, // Whether scanner UI should be shown
		    "twain_cap_setting": { // Optional scanning settings
		        "ICAP_PIXELTYPE": "TWPT_RGB" // Color
		    },
		    "output_settings": [{
		        "type": "return-base64",
		        "format": "jpg"
		    }]
		};
		 
		/** Triggers the scan */
		function scan() {
		    scanner.scan(displayImagesOnPage, scanRequest);
		}
		 
		/** Processes the scan result */
		function displayImagesOnPage(successful, mesg, response) {
		    if (!successful) { // On error
		        console.error('Failed: ' + mesg);
		        return;
		    }
		    if (successful && mesg != null && mesg.toLowerCase().indexOf('user cancel') >= 0) { // User cancelled.
		        console.info('User cancelled');
		        return;
		    }
		    var scannedImages = scanner.getScannedImages(response, true, false); // returns an array of ScannedImage
		    for (var i = 0;
		        (scannedImages instanceof Array) && i < scannedImages.length; i++) {
		        var scannedImage = scannedImages[i];
		        var elementImg = scanner.createDomElementFromModel({
		            'name': 'img',
		            'attributes': {
		                'class': 'scanned',
		                'src': scannedImage.src
		            }
		        });
		        (document.getElementById('images') ? document.getElementById('images') : document.body).appendChild(elementImg);
		    }
		}
	</script>
@stop