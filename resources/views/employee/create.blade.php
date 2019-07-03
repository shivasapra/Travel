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
	
@if ($errors->any())
<div class="alert alert-danger">
		<ul>
				@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
				@endforeach
		</ul>
</div>
@endif
<div class="box box-primary">
	<form action="{{route('store.employee')}}" method="post" enctype="multipart/form-data" class="bg-white" style="padding-top:3rem;padding-bottom:3rem; ">
		@csrf
		<div class="box-body">
			<div class="row">
				<div class="col-md-4">
					<label for="first_name">First Name</label>
					<input type="text" name='first_name' value="{{old('first_name')}}" required class="form-control">
				</div>
				<div class="col-md-4">
					<label for="last_name">Last Name</label>
					<input type="text" name='last_name' value="{{old('last_name')}}" required class="form-control">
				</div>
				<div class="col-md-4">
					<label for="email">Email</label>
					<input type="text" name='email' value="{{old('email')}}" required class="form-control">
				</div>
			</div>
			<div class="row" style="margin-top:20px;">
				<div class="col-md-4">
					<label for="country">Formal Nationality</label>
					<input type="text" name='country' value="{{old('country')}}" required class="form-control">
				</div>
				<div class="col-md-4">
					<label for="hired_for_dep">Hired For: Department</label>
					<select name='hired_for_dep' required class="form-control">
						<option value="" class="form-control">---Select---</option>
							@foreach(Spatie\Permission\Models\Role::all() as $role)
									<option value="{{$role->name}}" class="form-control">{{$role->name}}</option>	
							@endforeach
					</select>
				</div>
				<div class="col-md-4">
					<label for="hiring_date">Hiring Date</label>
					<input type="date" name='hiring_date' value="{{$date}}" required class="form-control">
				</div>
			</div>
			<div class="row" style="margin-top:20px;">
				<div class="col-md-4">
					<label for="currency">Currency</label>
					<select name="currency" required class="form-control">
						<option value="" class="form-control"></option>
						<option value="$" class="form-control">$</option>
						<option value="&#163;" selected>&#163;</option>
					</select>
				</div>
				<div class="col-md-4">
					<label for="rate">Rate Contract</label>
					<input type="text" name='rate' value="{{old('rate')}}" required class="form-control">
				</div>
				<div class="col-md-4">
					<label for="per">Per</label>
					<select name="per" required class="form-control">
						<option value="" class="form-control">--Select--</option>
						<option value="Hour" class="form-control" Selected>Hour</option>
						<option value="Month" class="form-control">Month</option>
						<option value="weekly" class="form-control">Weekly</option>
					</select>
				</div>
			</div>
		</div>
		<div class="text-center" style="margin-top:30px;">
			@can('Create Employee')
			<button class="btn btn-success" type="submit">Add employee</button>
			@endcan
		</div>
	</form>
</div>


	
				{{-- <div class="row">
		<div class="col-md-3">
				<ul class="list-group add-employee-list">
						<li class="active list-group-item"><a data-toggle="tab" href="#personal-information">Personal Information</a></li>
						<li class="list-group-item"><a data-toggle="tab" href="#contact-information">Contact Information</a></li>
						<li class="list-group-item"><a data-toggle="tab" href="#professional-information">Professional Information</a></li>
						<li class="list-group-item"><a data-toggle="tab" href="#emergency-contact-information">Emergency Contact Information</a></li>
						<li class="list-group-item"><a data-toggle="tab" href="#account-information">Account Information</a></li>																
					  </ul>
		</div>
		<div class="col-md-9">
		<div class="tab-content">
				<div id="personal-information" class="tab-pane fade in active">
				<div class="box">
					<form action="{{route('store.employee')}}" method="post" enctype="multipart/form-data" class="bg-white" style="padding-top:3rem;padding-bottom:3rem; ">
						@csrf
						<div class="box-header with-border">
						  <h3 class="box-title"><strong>{{"Personal Information"}}</strong></h3>
						  <div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
							</button>
						  </div>
						</div>
					<div class="box-body"> --}}
					{{-- <div class="text-center"><h4><strong>{{"Personal Inforamtion"}}</strong></h4></div><br> --}}
					{{-- <div class="row">
							<div class="col-md-4">
							<div class="form-group">
								<label for="first_name">First Name</label>
								<input type="text" name='first_name' value="{{old('first_name')}}" required class="form-control">
							</div>
							</div>
							<div class="col-md-4">
							<div class="form-group">
								<label for="middle_name">Middle Name</label>
								<input type="text" name='middle_name' value="{{old('middle_name')}}" class="form-control">
							</div>
							</div>
							<div class="col-md-4">
							<div class="form-group">
								<label for="last_name">Last Name</label>
								<input type="text" name='last_name' value="{{old('last_name')}}" required class="form-control">
							</div>
							</div>
							</div>
							<div class="row">
							<div class="col-md-6">
							<div class="form-group">
								<label for="father_name">Father's Name</label>
								<input type="text" name='father_name' value="{{old('father_name')}}" class="form-control" >
							</div>
							</div>
							<div class="col-md-6">
							<div class="form-group">
								<label for="mother_name">Mother's Name</label>
								<input type="text" name='mother_name' value="{{old('mother_name')}}" class="form-control">
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
								<input type="date" name='DOB' max="{{$date}}" value="{{$date}}" class="form-control">
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
							<div class="col-md-3">
							<div class="form-group">
								<label for="disability">Disability</label>
								<input type="text" name='disability' value="{{old('disability')}}" class="form-control">
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
								<label for="county">Nationality</label>
								<input type="text" id="nationality" name='county' value="{{old('nationality')}}" class="form-control">
							</div>
							</div>
							<div class="col-md-3">
							<div class="form-group">
								<label for="country">Formal Nationality</label>
								<input type="text" name='country' value="{{old('country')}}" class="form-control" required>
							</div>
							</div>
							
							</div>
							<div class="row"> --}}
							{{-- <div class="col-md-4">
							<div class="form-group">
								<label for="passport">Passport</label>
								<input type="text" name='passport' class="form-control"required>
							</div>
							</div> --}}
							{{-- <div id="optional">
								<div class="col-md-4">
								<div class="form-group">
									<label for="visa">Work Visa</label>
									<input type="text" name='visa' value="{{old('visa')}}" class="form-control">
								</div>
								</div>
								<div class="col-md-4">
								<div class="form-group">
									<label for="visa_expired">Visa Expiry Date</label>
									<input type="date" name='visa_expired' value="{{$date}}" class="form-control">
								</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="work_permit">Work Permit:</label>
										<input type="file" name="work_permit" value="{{old('work_permit')}}" class="form-control">
									</div>
								</div>
							</div>
					</div>
					</div>
					</div>
					<div class="col-md-12">
							<div class="form-group">
								<div class="text-center">
									@can('Create Employee')
									<button class="btn btn-success" type="submit">Add employee</button>
									@endcan
								</div>
							</div>
						</div>
					</form>
				</div>


				<div id="contact-information" class="tab-pane fade">
						<div class="box">
								<form action="{{route('store.employee')}}" method="post" enctype="multipart/form-data" class="bg-white" style="padding-top:3rem;padding-bottom:3rem; ">
									@csrf
								<div class="box-header with-border">
								  <h3 class="box-title"><strong>{{"Contact Information"}}</strong></h3>
								  <div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
									</button>
									<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
									</button>
								  </div>
								</div>
							<div class="box-body"> --}}
							{{-- <div class="text-center"><h4><strong>{{"Contact Information"}}</strong></h4></div><br> --}}
								{{-- <div class="row">
									<div class="col-md-4">
									<div class="form-group">
										<label for="permanent_address">Permanent Home Address</label>
										<span id="permanent_target"><input type="text" id="permanent" name='permanent_address' value="{{old('permanent_address')}}" class="form-control"></span>
									</div>
									</div>
									<div class="col-md-4">
									<div class="form-group">
										<label for="temporary_address">Temporary Home Address</label>
										<span id="temporary_target"><input type="text" id="temporary" name='temporary_address' value="{{old('temporary_address')}}" class="form-control"></span>
									</div>
									</div>
									<div class="col-md-4">
									<div class="form-group">
										<label for="home_phone">Home Phone</label>
										<input type="text" name='home_phone' value="{{old('home_phone')}}" class="form-control">
									</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
									<div class="form-group">
										<label for="mobile_phone">Mobile Phone</label>
										<input type="text" name='mobile_phone' value="{{old('mobile_phone')}}" class="form-control">
									</div>
									</div>
									<div class="col-md-6">
									<div class="form-group">
										<label for="email">Email</label>
										<input type="text" name='email' value="{{old('email')}}" class="form-control"required>
									</div>
									</div>
								</div>
								</div>
								</div>
								<div class="col-md-12">
										<div class="form-group">
											<div class="text-center">
												@can('Create Employee')
												<button class="btn btn-success" type="submit">Add employee</button>
												@endcan
											</div>
										</div>
									</div>
								</form>
				</div>


				<div id="professional-information" class="tab-pane fade">
						<div class="box">
							<form action="{{route('store.employee')}}" method="post" enctype="multipart/form-data" class="bg-white" style="padding-top:3rem;padding-bottom:3rem; ">
								@csrf
								<div class="box-header with-border">
								  <h3 class="box-title"><strong>{{"Professional Information"}}</strong></h3>
								  <div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
									</button>
									<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
									</button>
								  </div>
								</div>
							<div class="box-body"> --}}
							{{-- <div class="text-center"><h4><strong>{{"Professional Information"}}</strong></h4></div><br> --}}
								{{-- <div class="row">
									<div class="col-md-4">
									<div class="form-group">
										<label for="qualification">Quaification</label>
										<input type="text" name='qualification' value="{{old('qualification')}}" class="form-control">
									</div>
									</div>
									<div class="col-md-4">
									<div class="form-group">
										<label for="experience">Experience</label>
										<input type="text" name='experience' value="{{old('experience')}}" class="form-control">
									</div>
									</div>
									<div class="col-md-4">
									<div class="form-group">
										<label for="exp_in_dept">Experience In: Department</label>
										<input type="text" name='exp_in_dept' value="{{old('exp_in_dept')}}" class="form-control">
									</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
									<div class="form-group">
										<label for="hired_for_dep">Hired For: Department</label>
										<select name='hired_for_dep' class="form-control"required>
											<option value="" class="form-control">---Select---</option>
												@foreach(Spatie\Permission\Models\Role::all() as $role)
														<option value="{{$role->name}}" class="form-control">{{$role->name}}</option>	
												@endforeach
										</select> --}}
										{{-- <input type="text" name='hired_for_dep' value="{{old('hired_for_dep')}}" class="form-control"> --}}
									{{-- </div>
									</div>
									<div class="col-md-4">
									<div class="form-group">
										<label for="hiring_date">Hiring Date</label>
										<input type="date" name='hiring_date' value="{{$date}}" class="form-control">
									</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="utility_bill">Utility Bill:</label>
											<input type="file" name="utility_bill" value="{{old('utility_bill')}}" class="form-control">
										</div>
									</div>
									
								</div>
								<div class="row">
									<div class="col-md-4">
									<div class="form-group">
										<label for="currency">Currency</label>
										<select name="currency" class="form-control"required>
											<option value="" class="form-control"></option>
											<option value="$" class="form-control">$</option>
											<option value="&#163;" selected>&#163;</option>
										</select>
									</div>
									</div>
									<div class="col-md-4">
									<div class="form-group">
										<label for="rate">Rate Contract</label>
										<input type="text" name='rate' value="{{old('rate')}}" class="form-control"required>
									</div>
									</div>
									<div class="col-md-4">
									<div class="form-group">
										<label for="per">Per</label>
										<select name="per" class="form-control"required>
											<option value="" class="form-control">--Select--</option>
											<option value="Hour" class="form-control">Hour</option>
											<option value="Month" class="form-control">Month</option>
											<option value="weekly" class="form-control">Weekly</option>
										</select>
									</div>
									</div>
								</div>
								</div>
							</div>
							<div class="form-group">
										<label for="passport">Do you have passport</label>
										<input type="radio" name='passport'  id="yespassport" value=1>Yes
										<input type="radio" name='passport'  id="nopassport" checked value=0>No
									</div>
							
							<div id="passport">
								
							</div>
							<div class="col-md-12">
									<div class="form-group">
										<div class="text-center">
											@can('Create Employee')
											<button class="btn btn-success" type="submit">Add employee</button>
											@endcan
										</div>
									</div>
								</div>	
							</form>
				</div>


				<div id="emergency-contact-information" class="tab-pane fade">
						<div class="box">
							<form action="{{route('store.employee')}}" method="post" enctype="multipart/form-data" class="bg-white" style="padding-top:3rem;padding-bottom:3rem; ">
								@csrf
								<div class="box-header with-border">
								  <h3 class="box-title"><strong>{{"Emergency Contact Information"}}</strong></h3>
								  <div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
									</button>
									<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
									</button>
								  </div>
								</div>
							<div class="box-body"> --}}
							{{-- <div class="text-center"><h4><strong>{{"Emergency Contact Information"}}</strong></h4></div><br> --}}
								{{-- <div class="row">
									<div class="col-md-6">
									<div class="form-group">
										<label for="emer_contact_name">Contact Name</label>
										<input type="text" name='emer_contact_name' value="{{old('emer_contact_name')}}" class="form-control">
									</div>
									</div>
									<div class="col-md-6">
									<div class="form-group">
										<label for="emer_contact_address">Contact Address</label>
										<input type="text" name='emer_contact_address' value="{{old('emer_contact_address')}}" class="form-control">
									</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
									<div class="form-group">
										<label for="emer_contact_phone">Contact Phone No.</label>
										<input type="text" name='emer_contact_phone' value="{{old('emer_contact_phone')}}" class="form-control">
									</div>
									</div>
									<div class="col-md-4">
									<div class="form-group">
										<label for="emer_contact_email">Contact Email</label>
										<input type="text" name='emer_contact_email' value="{{old('emer_contact_email')}}" class="form-control">
									</div>
									</div>
									<div class="col-md-4">
									<div class="form-group">
										<label for="emer_contact_ralation">Relation</label>
										<input type="text" name='emer_contact_ralation' value="{{old('emer_contact_ralation')}}" class="form-control">
									</div>
									</div>
								</div>
								</div>
							</div>	
							<div class="col-md-12">
									<div class="form-group">
										<div class="text-center">
											@can('Create Employee')
											<button class="btn btn-success" type="submit">Add employee</button>
											@endcan
										</div>
									</div>
								</div>
							</form>
				</div>


				<div id="account-information" class="tab-pane fade">
						<div class="box">
								<form action="{{route('store.employee')}}" method="post" enctype="multipart/form-data" class="bg-white" style="padding-top:3rem;padding-bottom:3rem; ">
									@csrf
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
								{{-- <div class="row">
									<div class="col-md-6">
									<div class="form-group">
										<label for="sort_code">SORT Code</label>
										<input type="text" name='sort_code' value="{{old('sort_code')}}" class="form-control">
									</div>
									</div>
									<div class="col-md-6">
									<div class="form-group">
										<label for="account_no">Account No</label>
										<input type="text" name='account_no' value="{{old('account_no')}}" class="form-control">
									</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
									<div class="form-group">
										<label for="bank_name">Bank Name</label>
										<input type="text" name='bank_name' value="{{old('bank_name')}}" class="form-control">
									</div>
									</div>
									<div class="col-md-6">
									<div class="form-group">
										<label for="bank_address">Bank Address</label>
										<input type="text" name='bank_address' value="{{old('bank_address')}}" class="form-control">
									</div>
									</div>
								</div>
								<div class="row"> --}}
									{{-- <div class="col-md-3">
									<div class="form-group">
										<label for="income_tax_no">Income Tax No.</label>
										<input type="text" name='income_tax_no' class="form-control"required>
									</div>
									</div> --}}
									{{-- <div class="col-md-6">
									<div class="form-group">
										<label for="tax_ref_no">Tax Ref No.</label>
										<input type="text" name='tax_ref_no' value="{{old('tax_ref_no')}}" class="form-control">
									</div>
									</div>
									<div class="col-md-6">
									<div class="form-group">
										<label for="national_insurance_no">National Insurance No.</label>
										<input type="text" name='national_insurance_no' value="{{old('national_insurance_no')}}" class="form-control">
									</div>
									</div>
								</div>
							</div>
						</div>
												<div class="col-md-12">
													<div class="form-group">
														<div class="text-center">
															@can('Create Employee')
															<button class="btn btn-success" type="submit">Add employee</button>
															@endcan
														</div>
													</div>
												</div>
											</form>
				</div>
				</div>
		</div>
				</div> --}}
			
			{{-- <button type="button" onclick="scan();">Scan</button> <!-- Triggers scan -->   
			<div id="images"/> <!-- Displays scanned images  --> --}}
		
		


@stop
{{-- @section('js')
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="bower_components/scanner/dist/scanner.js"></script>
	<script type="text/javascript">
		
		$(document).ready(function(){
	    $("#yespassport").click(function(){
	    	var data = '<div class="box box-info"><div class="box-header with-border"><h3 class="box-title"><strong>{{"Passport Information"}}</strong></h3><div class="box-tools pull-right"><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button><button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button></div></div><div class="box-body"><div class="row"><div class="col-md-6"><div class="form-group"><label for="passport_no">Passport Number</label><input type="text" name="passport_no" value="{{old("passport_no")}}"  class="form-control"></div></div><div class="col-md-6"><div class="form-group"><label for="passport_expiry_date">Passport Expire date</label><input type="date" name="passport_expiry_date" value="{{$date}}"  class="form-control"></div></div></div><div class="row"><div class="col-md-6"><div class="form-group"><label for="passport_place">Place of Issue</label><input type="text" name="passport_place" value="{{old("passport_place")}}"  class="form-control"></div></div><div class="col-md-6"><div class="form-group"><label for="passport_issue_date">Date Of Issue</label><input type="date" name="passport_issue_date" value="{{$date}}"  class="form-control"></div></div></div><div class="row"><div class="col-md-6"><div class="form-group"><label for="passport_front">Passport Front:</label><input type="file" name="passport_front" value="{{old("passport_front")}}" class="form-control"></div></div><div class="col-md-6"><div class="form-group"><label for="passport_back">Passport Back:</label><input type="file" name="passport_back" value="{{old("passport_back")}}" class="form-control"></div></div></div></div></div>';
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
	    $("#nationality").on('keyup',function(){
	    	var nationality = this.value;
	    	if (nationality == 'british' || nationality == 'British' || nationality == 'England' ||  nationality == 'england' || nationality == 'UK' || nationality == 'uk' || nationality == 'U K' || nationality == 'u k' || nationality == 'U.K' || nationality == 'u.k') {
	    		var data = '';
	        	$("#optional").html(data);   
	    	}
	        });
	    });
	    $(document).ready(function(){
	    $("#permanent").on('keyup',function(){
	    	var temp = this.value;
	    	if (temp != '') {
	    		var data = '<input type="text" id="temporary" value="{{old("temporary_address")}}" name="temporary_address" class="form-control" >';
	        	$("#temporary_target").html(data);   
	    	}
	        });
	    });
	    $(document).ready(function(){
	    $("#temporary").on('keyup',function(){
	    	var temp = this.value;
	    	if (temp != '') {
	    		var data = '<input type="text" id="permanent" name="permanent_address" value="{{old("permanent_address")}}" class="form-control" >';
	        	$("#permanent_target").html(data);   
	    	}
	        });
	    }); --}}


	{{-- </script> --}}
{{-- @stop --}}