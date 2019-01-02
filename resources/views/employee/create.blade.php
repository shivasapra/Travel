@extends('layouts.frontend')
@section('title')
Employee Registration
@endsection
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



		<div class="box">
		<div class="boxbody">
	<div class="container">
		<div class="container">
			<form action="{{route('store.employee')}}" method="post">
				@csrf
				<div class="text-center"><h4><strong>{{"Personal Inforamtion"}}</strong></h4></div>
				<div class="row">
					<div class="col-md-4">
					<div class="form-group">
						<label for="first_name">First Name</label>
						<input type="text" name='first_name' class="form-control">
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="middle_name">Middle Name</label>
						<input type="text" name='middle_name' class="form-control">
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="last_name">Last Name</label>
						<input type="text" name='last_name' class="form-control">
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
					<div class="form-group">
						<label for="father_name">Father's Name</label>
						<input type="text" name='father_name' class="form-control">
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						<label for="mother_name">Mother's Name</label>
						<input type="text" name='mother_name' class="form-control">
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
					<div class="form-group">
						<label for="gender">Gender</label>
						<select name="gender" class="form-control">
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
						<input type="date" name='DOB' class="form-control">
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="marital_status">Marital Status</label>
						<select name="marital_status" class="form-control">
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
					<div class="col-md-4">
					<div class="form-group">
						<label for="disability">Disability</label>
						<input type="text" name='disability' class="form-control">
					</div>
					</div>
					<div class="col-md-4">
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
					<div class="col-md-4">
					<div class="form-group">
						<label for="country">Country</label>
						<input type="text" name='country' class="form-control">
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
					<div class="form-group">
						<label for="passport">Passport</label>
						<input type="text" name='passport' class="form-control">
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="visa">Visa</label>
						<input type="text" name='visa' class="form-control">
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="visa_expired">Visa valid upto</label>
						<input type="date" name='visa_expired' class="form-control">
					</div>
					</div>
				</div>
				<div class="text-center"><h4><strong>{{"Contact Information"}}</strong></h4></div>
				<div class="row">
					<div class="col-md-4">
					<div class="form-group">
						<label for="permanent_address">Permanent Home Address</label>
						<input type="text" name='permanent_address' class="form-control">
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="temporary_address">Temporary Home Address</label>
						<input type="text" name='temporary_address' class="form-control">
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="home_phone">Home Phone</label>
						<input type="text" name='home_phone' class="form-control">
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
					<div class="form-group">
						<label for="mobile_phone">Mobile Phone</label>
						<input type="text" name='mobile_phone' class="form-control">
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						<label for="email">Email</label>
						<input type="text" name='email' class="form-control">
					</div>
					</div>
				</div>
				<div class="text-center"><h4><strong>{{"Professional Information"}}</strong></h4></div>
				<div class="row">
					<div class="col-md-4">
					<div class="form-group">
						<label for="qualification">Quaification</label>
						<input type="text" name='qualification' class="form-control">
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="experience">Experience</label>
						<input type="text" name='experience' class="form-control">
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="exp_in_dept">Experience In: Department</label>
						<input type="text" name='exp_in_dept' class="form-control">
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
					<div class="form-group">
						<label for="hired_for_dep">Hired For: Department</label>
						<input type="text" name='hired_for_dep' class="form-control">
					</div>
					</div>
					<div class="col-md-3">
					<div class="form-group">
						<label for="hiring_date">Hiring Date</label>
						<input type="date" name='hiring_date' class="form-control">
					</div>
					</div>
					<div class="col-md-2">
					<div class="form-group">
						<label for="currency">Currency</label>
						<select name="currency" class="form-control">
							<option value="" class="form-control"></option>
							<option value="$" class="form-control">$</option>
						</select>
					</div>
					</div>
					<div class="col-md-2">
					<div class="form-group">
						<label for="rate">Rate Contract</label>
						<input type="text" name='rate' class="form-control">
					</div>
					</div>
					<div class="col-md-2">
					<div class="form-group">
						<label for="per">Per</label>
						<select name="per" class="form-control">
							<option value="" class="form-control">--Select--</option>
							<option value="Hour" class="form-control">Hour</option>
							<option value="Month" class="form-control">Month</option>
						</select>
					</div>
					</div>
				</div>
				<div class="text-center"><h4><strong>{{"Emergency Contact Information"}}</strong></h4></div>
				<div class="row">
					<div class="col-md-6">
					<div class="form-group">
						<label for="emer_contact_name">Contact Name</label>
						<input type="text" name='emer_contact_name' class="form-control">
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						<label for="emer_contact_address">Contact Address</label>
						<input type="text" name='emer_contact_address' class="form-control">
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
					<div class="form-group">
						<label for="emer_contact_phone">Contact Phone No.</label>
						<input type="text" name='emer_contact_phone' class="form-control">
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="emer_contact_email">Contact Email</label>
						<input type="text" name='emer_contact_email' class="form-control">
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="emer_contact_ralation">Relation</label>
						<input type="text" name='emer_contact_ralation' class="form-control">
					</div>
					</div>
				</div>
				<div class="text-center"><h4><strong>{{"Account Information"}}</strong></h4></div>
				<div class="row">
					<div class="col-md-6">
					<div class="form-group">
						<label for="sort_code">SORT Code</label>
						<input type="text" name='sort_code' class="form-control">
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						<label for="account_no">Account No</label>
						<input type="text" name='account_no' class="form-control">
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
					<div class="form-group">
						<label for="bank_name">Bank Name</label>
						<input type="text" name='bank_name' class="form-control">
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						<label for="bank_address">Bank Address</label>
						<input type="text" name='bank_address' class="form-control">
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
					<div class="form-group">
						<label for="income_tax_no">Income Tax No.</label>
						<input type="text" name='income_tax_no' class="form-control">
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						<label for="national_insurance_no">National Insurance No.</label>
						<input type="text" name='national_insurance_no' class="form-control">
					</div>
					</div>
				</div>
				<div class="form-group">
					<div class="text-center">
						<button class="btn btn-success" type="submit">Add employee</button>
					</div>
				</div>
				
			</form>
		</div>
		</div>
		</div>
	</div>


@stop