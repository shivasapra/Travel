@extends('layouts.frontend')
@section('title')
Employee
@endsection
@section('header')
	<section class="content-header">
      <h1>
        View Employee
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('employees')}}"><i class="fa fa-pencil-square-o"></i>Employess</a></li>
        <li class="active">View Employee</li>
      </ol>
    </section>
@stop
@section('content')
	<div class="box box-info">
			<div class="box-body">
				<div class="text-center"><h4><strong>{{"Personal Inforamtion"}}</strong></h4></div>
				<div class="row">
					<div class="col-md-4">
					<div class="form-group">
						<label for="first_name">First Name</label>
						<input type="text" name='first_name' value="{{$employee->first_name}}" class="form-control"required readonly>
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="middle_name">Middle Name</label>
						<input type="text" name='middle_name' value="{{$employee->middle_name}}" class="form-control"required readonly>
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="last_name">Last Name</label>
						<input type="text" value="{{$employee->last_name}}" name='last_name' class="form-control"required readonly>
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
					<div class="form-group">
						<label for="father_name">Father's Name</label>
						<input type="text" value="{{$employee->father_name}}" name='father_name' class="form-control"required readonly>
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						<label for="mother_name">Mother's Name</label>
						<input type="text" value="{{$employee->mother_name}}" name='mother_name' class="form-control"required readonly>
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
					<div class="form-group">
						<label for="gender">Gender</label>
						<select name="gender" class="form-control"required readonly>
							<option value="">{{"---Select Gender---"}}</option>
							<option value="Male" class="form-control" {{($employee->gender == 'Male')?"selected":" "}}>Male</option>
							<option value="Female" class="form-control" {{($employee->gender == 'Female')?"selected":" "}}>Female</option>
							<option value="Others" class="form-control" {{($employee->gender == 'Others')?"selected":" "}}>Others</option>
						</select>
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="DOB">Date of Birth</label>
						<input type="date" value="{{$employee->DOB}}" name='DOB' class="form-control" required readonly>
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="marital_status">Marital Status</label>
						<select name="marital_status" class="form-control"required readonly>
							<option value="">{{"---Select status---"}}</option>
							<option value="Married" class="form-control" {{($employee->marital_status == 'Married')?"selected":" "}}>Married</option>
							<option value="Unmarried" class="form-control" {{($employee->marital_status == 'Unmarried')?"selected":" "}}>Unmarried</option>
							<option value="Divorced" class="form-control" {{($employee->marital_status == 'Divorced')?"selected":" "}}>Divorced</option>
							<option value="Widowed" class="form-control" {{($employee->marital_status == 'Widowed')?"selected":" "}}>Widowed</option>
						</select>
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
					<div class="form-group">
						<label for="disability">Disability</label>
						<input type="text" name='disability' value="{{$employee->disability}}" class="form-control"required readonly>
					</div>
					</div>
					<div class="col-md-3">
					<div class="form-group">
						<label for="blood_group">Blood Group</label>
						<select name="blood_group" class="form-control"required readonly>
							<option value="">{{"---Select one---"}}</option>
							<option value="A+" class="form-control" {{($employee->blood_group == 'A+')?"selected":" "}}>A+</option>
							<option value="A-" class="form-control" {{($employee->blood_group == 'A-')?"selected":" "}}>A-</option>
							<option value="A Unknown" class="form-control" {{($employee->blood_group == 'A Unknown')?"selected":" "}}>A Unknown</option>
							<option value="B+" class="form-control" {{($employee->blood_group == 'B+')?"selected":" "}}>B+</option>
							<option value="B-" class="form-control" {{($employee->blood_group == 'B-')?"selected":" "}}>B-</option>
							<option value="B Unknown" class="form-control" {{($employee->blood_group == 'B Unknown')?"selected":" "}}>B Unknown</option>
							<option value="AB+" class="form-control"  {{($employee->blood_group == 'AB+')?"selected":" "}}>AB+</option>
							<option value="AB-" class="form-control" {{($employee->blood_group == 'AB-')?"selected":" "}}>AB-</option>
							<option value="AB Unknown" class="form-control" {{($employee->blood_group == 'AB Unknown')?"selected":" "}}>AB Unknown</option>
							<option value="O+" class="form-control" {{($employee->blood_group == 'O+')?"selected":" "}}>O+</option>
							<option value="O-" class="form-control" {{($employee->blood_group == 'O-')?"selected":" "}}>O-</option>
							<option value="O Unknown" class="form-control"{{($employee->blood_group == 'O Unkonown')?"selected":" "}}>O Unknown</option>
							<option value="Unknown" class="form-control" {{($employee->blood_group == 'Unknown')?"selected":" "}}>Unknown</option>
						</select>
					</div>
					</div>
					<div class="col-md-3">
					<div class="form-group">
						<label for="country">Country</label>
						<input type="text" name='country' value="{{$employee->country}}" class="form-control"required readonly>
					</div>
					</div>
					<div class="col-md-3">
					<div class="form-group">
						<label for="county">County</label>
						<input type="text" name='county' value="{{$employee->county}}" class="form-control"required readonly>
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
					<div class="form-group">
						<label for="passport">Passport</label>
						<input type="text" name='passport' value="{{$employee->passport}}" class="form-control"required readonly>
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="visa">Visa</label>
						<input type="text" value="{{$employee->visa}}" name='visa' class="form-control"required readonly>
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="visa_expired">Visa valid upto</label>
						<input type="date" value="{{$employee->visa_expired}}" name='visa_expired' class="form-control"required readonly>
					</div>
					</div>
				</div>
			</div>
		</div>
		<div class="box box-success">
			<div class="box-body">
				<div class="text-center"><h4><strong>{{"Contact Information"}}</strong></h4></div>
				<div class="row">
					<div class="col-md-4">
					<div class="form-group">
						<label for="permanent_address">Permanent Home Address</label>
						<input type="text" value="{{$employee->permanent_address}}" name='permanent_address' class="form-control"required readonly>
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="temporary_address">Temporary Home Address</label>
						<input type="text" value="{{$employee->temporary_address}}" name='temporary_address' class="form-control"required readonly>
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="home_phone">Home Phone</label>
						<input type="text" value="{{$employee->home_phone}}" name='home_phone' class="form-control"required readonly>
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
					<div class="form-group">
						<label for="mobile_phone">Mobile Phone</label>
						<input type="text" value="{{$employee->mobile_phone}}" name='mobile_phone' class="form-control"required readonly>
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" value="{{$employee->email}}" name='email' class="form-control"required readonly>
					</div>
					</div>
				</div>
			</div>
		</div>
		<div class="box box-info">
			<div class="box-body">
				<div class="text-center"><h4><strong>{{"Professional Information"}}</strong></h4></div>
				<div class="row">
					<div class="col-md-4">
					<div class="form-group">
						<label for="qualification">Quaification</label>
						<input type="text" value="{{$employee->qualification}}" name='qualification' class="form-control"required readonly>
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="experience">Experience</label>
						<input type="text" name='experience' value="{{$employee->experience}}" class="form-control"required readonly>
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="exp_in_dept">Experience In: Department</label>
						<input type="text" value="{{$employee->exp_in_dept}}" name='exp_in_dept' class="form-control"required readonly>
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
					<div class="form-group">
						<label for="hired_for_dep">Hired For: Department</label>
						<input type="text" name='hired_for_dep' value="{{$employee->hired_for_dep}}" class="form-control"required readonly>
					</div>
					</div>
					<div class="col-md-3">
					<div class="form-group">
						<label for="hiring_date">Hiring Date</label>
						<input type="date" value="{{$employee->hiring_date}}"name='hiring_date' class="form-control"required readonly>
					</div>
					</div>
					<div class="col-md-2">
					<div class="form-group">
						<label for="currency">Currency</label>
						<select name="currency" class="form-control"required readonly>
							<option value="" class="form-control" ></option>
							<option value="$" class="form-control" {{($employee->currency == '$')?"selected":" "}}>$</option>
							<option value="&#163;" class="form-control" {{($employee->currency != '$')?"selected":" "}}>&#163;</option>
						</select>
					</div>
					</div>
					<div class="col-md-2">
					<div class="form-group">
						<label for="rate">Rate Contract</label>
						<input type="text" value="{{$employee->rate}}" name='rate' class="form-control"required readonly>
					</div>
					</div>
					<div class="col-md-2">
					<div class="form-group">
						<label for="per">Per</label>
						<select name="per" class="form-control"required readonly>
							<option value="" class="form-control">--Select--</option>
							<option value="Hour" {{($employee->per == 'Hour')?"selected":" "}} class="form-control">Hour</option>
							<option value="Month" class="form-control" {{($employee->per == 'Month')?"selected":" "}}>Month</option>
						</select>
					</div>
					</div>
				</div>
			</div>
		</div>
		<div class="box box-danger">
			<div class="box-body">
				<div class="text-center"><h4><strong>{{"Emergency Contact Information"}}</strong></h4></div>
				<div class="row">
					<div class="col-md-6">
					<div class="form-group">
						<label for="emer_contact_name">Contact Name</label>
						<input type="text" value="{{$employee->emer_contact_name}}" name='emer_contact_name' class="form-control"required readonly>
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						<label for="emer_contact_address">Contact Address</label>
						<input type="text" value="{{$employee->emer_contact_address}}" name='emer_contact_address' class="form-control"required readonly>
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
					<div class="form-group">
						<label for="emer_contact_phone">Contact Phone No.</label>
						<input type="text" value="{{$employee->emer_contact_phone}}" name='emer_contact_phone' class="form-control"required readonly>
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="emer_contact_email">Contact Email</label>
						<input type="text" value="{{$employee->emer_contact_email}}" name='emer_contact_email' class="form-control"required readonly>
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="emer_contact_ralation">Relation</label>
						<input type="text" value="{{$employee->emer_contact_relation}}" name='emer_contact_ralation' class="form-control"required readonly>
					</div>
					</div>
				</div>
			</div>
		</div>
		<div class="box box-info">
			<div class="box-body">
				<div class="text-center"><h4><strong>{{"Account Information"}}</strong></h4></div>
				<div class="row">
					<div class="col-md-6">
					<div class="form-group">
						<label for="sort_code">SORT Code</label>
						<input type="text" value="{{$employee->sort_code}}" name='sort_code' class="form-control"required readonly>
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						<label for="account_no">Account No</label>
						<input type="text" value="{{$employee->account_no}}" name='account_no' class="form-control"required readonly>
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
					<div class="form-group">
						<label for="bank_name">Bank Name</label>
						<input type="text" value="{{$employee->bank_name}}" name='bank_name' class="form-control"required readonly>
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						<label for="bank_address">Bank Address</label>
						<input type="text" value="{{$employee->bank_address}}" name='bank_address' class="form-control"required readonly>
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
					<div class="form-group">
						<label for="income_tax_no">Income Tax No.</label>
						<input type="text" value="{{$employee->income_tax_no}}" name='income_tax_no' class="form-control"required readonly>
					</div>
					</div>
					<div class="col-md-3">
					<div class="form-group">
						<label for="tax_ref_no">Tax Ref No.</label>
						<input type="text" value="{{$employee->tax_ref_no}}" name='tax_ref_no' class="form-control"required readonly>
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						<label for="national_insurance_no">National Insurance No.</label>
						<input type="text" value="{{$employee->national_insurance_no}}" name='national_insurance_no' class="form-control"required readonly>
					</div>
					</div>
				</div>
			</div>
		</div>

@endsection