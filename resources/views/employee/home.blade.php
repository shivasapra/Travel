@extends('layouts.frontend')
@section('title')
Dashboard
@endsection
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
<div class="row">
    <div class="col-md-3">
      <form action="{{route('update.employee',['id'=>$employee->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="image-div">
            <img  id="blah"
            @if($employee->user->avatar)
              src="{{asset($employee->user->avatar)}}"
            @else
              src="{{asset('app/images/user-placeholder.jpg')}}"
            @endif 
            alt="avatar" height="200px" width="200px" style="border-radius:20px">
            <a href="{{asset($employee->user->avatar)}}" download class="download-image-icon"><i class="fa fa-download" aria-hidden="true"></i></a>
            {{-- <label for="avatar" class="upload-icon">
                <i class="fa fa-camera" aria-hidden="true"></i>
            </label>
            <input type="file" id="avatar" name='avatar' onchange="readURL(this);"  class="form-control" style="display:none;"> --}}
          </div>
      </form>
      <br>
      <ul class="list-group add-employee-list">
        <li class="active list-group-item"><a data-toggle="tab" href="#personal-information">Personal Information</a></li>
        <li class="list-group-item"><a data-toggle="tab" href="#contact-information">Contact Information</a></li>
        <li class="list-group-item"><a data-toggle="tab" href="#professional-information">Professional Information</a></li>
        <li class="list-group-item"><a data-toggle="tab" href="#emergency-contact-information">Emergency Contact Information</a></li>
        <li class="list-group-item"><a data-toggle="tab" href="#account-information">Account Information</a></li>
        <li class="list-group-item"><a data-toggle="tab" href="#passport-information">Passport Information</a></li>																
      </ul>
    
    </div>
    <div class="col-md-9">
        <div class="tab-content">
          <div id="personal-information" class="tab-pane fade in active">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"><strong>{{"Personal Information"}}</strong></h3>
              </div>
              <div class="box-body details">
                <br>
                  <h4><span>Employee ID</span> : {{$employee->unique_id}}</h4> 
                  <h4><span>First Name</span> : {{$employee->first_name}}</h4>
                  <h4><span>Last Name</span> : {{$employee->last_name}}</h4>
                  <h4><span>Father's Name</span> : {{$employee->father_name}}</h4>
                  <h4><span>Mother's Name</span> : {{$employee->mother_name}}</h4>
                  <h4><span>Gender</span> : {{$employee->gender}}</h4>
                  <h4><span>Date Of Birth</span> : {{$employee->DOB}}</h4>
                  <h4><span>Marital Status</span> : {{$employee->marital_status}}</h4>
                  <h4><span>Disability</span> : {{$employee->disability}}</h4>
                  <h4><span>Blood Group</span> : {{$employee->blood_group}}</h4>
                  <h4><span>Country</span> : {{$employee->country}}</h4>
                  <h4><span>County</span> : {{$employee->county}}</h4>
                <div class="row">
                  <div class="col-md-4">
                  <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" name='first_name' value="{{$employee->first_name}}" class="form-control readonly_attribute" readonly>
                  </div>
                  </div>
                  <div class="col-md-4">
                  <div class="form-group">
                    <label for="middle_name">Middle Name</label>
                    <input type="text" name='middle_name' value="{{$employee->middle_name}}" class="form-control readonly_attribute" readonly>
                  </div>
                  </div>
                  <div class="col-md-4">
                  <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" value="{{$employee->last_name}}" name='last_name' class="form-control readonly_attribute" readonly>
                  </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="father_name">Father's Name</label>
                    <input type="text" value="{{$employee->father_name}}" name='father_name' class="form-control readonly_attribute" readonly>
                  </div>
                  </div>
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="mother_name">Mother's Name</label>
                    <input type="text" value="{{$employee->mother_name}}" name='mother_name' class="form-control readonly_attribute" readonly>
                  </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                  <div class="form-group">
                    <label for="gender">Gender</label>
                    <select name="gender" class="form-control disabled_attribute" disabled>
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
                    <input type="date" value="{{$employee->DOB}}" name='DOB' class="form-control readonly_attribute"  readonly>
                  </div>
                  </div>
                  <div class="col-md-4">
                  <div class="form-group">
                    <label for="marital_status">Marital Status</label>
                    <select name="marital_status" class="form-control disabled_attribute" disabled>
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
                    <input type="text" name='disability' value="{{$employee->disability}}" class="form-control readonly_attribute" readonly>
                  </div>
                  </div>
                  <div class="col-md-3">
                  <div class="form-group">
                    <label for="blood_group">Blood Group</label>
                    <select name="blood_group" class="form-control disabled_attribute" disabled>
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
                    <input type="text" name='country' value="{{$employee->country}}" class="form-control readonly_attribute" readonly>
                  </div>
                  </div>
                  <div class="col-md-3">
                  <div class="form-group">
                    <label for="county">County</label>
                    <input type="text" name='county' value="{{$employee->county}}" class="form-control readonly_attribute" readonly>
                  </div>
                  </div>
                </div>
                <div class="row">
                  {{-- <div class="col-md-4">
                  <div class="form-group">
                    <label for="passport">Passport</label>
                    <input type="text" name='passport' value="{{$employee->passport}}" class="form-control" readonly>
                  </div>
                  </div> --}}
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="visa">Visa</label>
                    <input type="text" value="{{$employee->visa}}" name='visa' class="form-control readonly_attribute" readonly>
                  </div>
                  </div>
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="visa_expired">Visa valid upto</label>
                    <input type="date" value="{{$employee->visa_expired}}" name='visa_expired' class="form-control readonly_attribute" readonly>
                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="contact-information" class="tab-pane fade">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"><strong>{{"Contact Information"}}</strong></h3>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-4">
                  <div class="form-group">
                    <label for="permanent_address">Permanent Home Address</label>
                    <input type="text" value="{{$employee->permanent_address}}" name='permanent_address' class="form-control readonly_attribute" readonly>
                  </div>
                  </div>
                  <div class="col-md-4">
                  <div class="form-group">
                    <label for="temporary_address">Temporary Home Address</label>
                    <input type="text" value="{{$employee->temporary_address}}" name='temporary_address' class="form-control readonly_attribute" readonly>
                  </div>
                  </div>
                  <div class="col-md-4">
                  <div class="form-group">
                    <label for="home_phone">Home Phone</label>
                    <input type="text" value="{{$employee->home_phone}}" name='home_phone' class="form-control readonly_attribute" readonly>
                  </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="mobile_phone">Mobile Phone</label>
                    <input type="text" value="{{$employee->mobile_phone}}" name='mobile_phone' class="form-control readonly_attribute" readonly>
                  </div>
                  </div>
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" value="{{$employee->email}}" name='email' class="form-control readonly_attribute" readonly>
                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="professional-information" class="tab-pane fade">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"><strong>{{"Professional Information"}}</strong></h3>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-4">
                  <div class="form-group">
                    <label for="qualification">Quaification</label>
                    <input type="text" value="{{$employee->qualification}}" name='qualification' class="form-control readonly_attribute" readonly>
                  </div>
                  </div>
                  <div class="col-md-4">
                  <div class="form-group">
                    <label for="experience">Experience</label>
                    <input type="text" name='experience' value="{{$employee->experience}}" class="form-control readonly_attribute" readonly>
                  </div>
                  </div>
                  <div class="col-md-4">
                  <div class="form-group">
                    <label for="exp_in_dept">Experience In: Department</label>
                    <input type="text" value="{{$employee->exp_in_dept}}" name='exp_in_dept' class="form-control readonly_attribute" readonly>
                  </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                  <div class="form-group">
                    <label for="hired_for_dep">Hired For: Department</label>
                    <input type="text" name='hired_for_dep' value="{{$employee->hired_for_dep}}" class="form-control readonly_attribute" readonly>
                  </div>
                  </div>
                  <div class="col-md-3">
                  <div class="form-group">
                    <label for="hiring_date">Hiring Date</label>
                    <input type="date" value="{{$employee->hiring_date}}"name='hiring_date' class="form-control readonly_attribute" readonly>
                  </div>
                  </div>
                  <div class="col-md-2">
                  <div class="form-group">
                    <label for="currency">Currency</label>
                    <select name="currency" class="form-control disabled_attribute" disabled>
                      <option value="" class="form-control" ></option>
                      <option value="$" class="form-control" {{($employee->currency == '$')?"selected":" "}}>$</option>
                      <option value="&#163;" class="form-control" {{($employee->currency != '$')?"selected":" "}}>&#163;</option>
                    </select>
                  </div>
                  </div>
                  <div class="col-md-2">
                  <div class="form-group">
                    <label for="rate">Rate Contract</label>
                    <input type="text" value="{{$employee->rate}}" name='rate' class="form-control readonly_attribute" readonly>
                  </div>
                  </div>
                  <div class="col-md-2">
                  <div class="form-group">
                    <label for="per">Per</label>
                    <select name="per" class="form-control disabled_attribute" disabled>
                      <option value="" class="form-control">--Select--</option>
                      <option value="Hour" {{($employee->per == 'Hour')?"selected":" "}} class="form-control">Hour</option>
                      <option value="Month" class="form-control" {{($employee->per == 'Month')?"selected":" "}}>Month</option>
                    </select>
                  </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="work_permit">Work Permit:</label>
                      <div class="image-div">
                        <img id="work_permit" @if($employee->work_permit) src="{{asset($employee->work_permit)}}" @else src="{{asset('/images/placeholder.png')}}" @endif alt="work permit"  height="200px" width="200px" style="border-radius:10px">
                        <a href="{{asset($employee->work_permit)}}" download class="download-image-icon"><i class="fa fa-download" aria-hidden="true"></i></a>
                        <label for="work" class="upload-icon">
                            <i class="fa fa-camera" aria-hidden="true"></i>
                        </label>
                        <input type="file" id="work" name='work_permit' onchange="readURLWork(this);"  class="form-control disabled_attribute" disabled style="display:none;">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="utility_bill">Utility Bill:</label>
                      <div class="image-div">
                        <img id="utility_bill" @if($employee->utility_bill) src="{{asset($employee->utility_bill)}}" @else src="{{asset('/images/placeholder.png')}}" @endif alt="utility bill"  height="200px" width="200px" style="border-radius:10px">
                        <a href="{{asset($employee->utility_bill)}}" download class="download-image-icon"><i class="fa fa-download" aria-hidden="true"></i></a>
                        <label for="utility" class="upload-icon">
                            <i class="fa fa-camera" aria-hidden="true"></i>
                        </label>
                        <input type="file" id="utility" name='utility_bill' onchange="readURLUtility(this);"  class="form-control disabled_attribute" disabled style="display:none;">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="emergency-contact-information" class="tab-pane fade">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"><strong>{{"Emergency Contact Information"}}</strong></h3>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="emer_contact_name">Contact Name</label>
                    <input type="text" value="{{$employee->emer_contact_name}}" name='emer_contact_name' class="form-control readonly_attribute" readonly>
                  </div>
                  </div>
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="emer_contact_address">Contact Address</label>
                    <input type="text" value="{{$employee->emer_contact_address}}" name='emer_contact_address' class="form-control readonly_attribute" readonly>
                  </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                  <div class="form-group">
                    <label for="emer_contact_phone">Contact Phone No.</label>
                    <input type="text" value="{{$employee->emer_contact_phone}}" name='emer_contact_phone' class="form-control readonly_attribute" readonly>
                  </div>
                  </div>
                  <div class="col-md-4">
                  <div class="form-group">
                    <label for="emer_contact_email">Contact Email</label>
                    <input type="text" value="{{$employee->emer_contact_email}}" name='emer_contact_email' class="form-control readonly_attribute" readonly>
                  </div>
                  </div>
                  <div class="col-md-4">
                  <div class="form-group">
                    <label for="emer_contact_ralation">Relation</label>
                    <input type="text" value="{{$employee->emer_contact_relation}}" name='emer_contact_ralation' class="form-control readonly_attribute" readonly>
                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="account-information" class="tab-pane fade">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"><strong>{{"Account Information"}}</strong></h3>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="sort_code">SORT Code</label>
                    <input type="text" value="{{$employee->sort_code}}" name='sort_code' class="form-control readonly_attribute" readonly>
                  </div>
                  </div>
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="account_no">Account No</label>
                    <input type="text" value="{{$employee->account_no}}" name='account_no' class="form-control readonly_attribute" readonly>
                  </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="bank_name">Bank Name</label>
                    <input type="text" value="{{$employee->bank_name}}" name='bank_name' class="form-control readonly_attribute" readonly>
                  </div>
                  </div>
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="bank_address">Bank Address</label>
                    <input type="text" value="{{$employee->bank_address}}" name='bank_address' class="form-control readonly_attribute" readonly>
                  </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                  <div class="form-group">
                    <label for="income_tax_no">Income Tax No.</label>
                    <input type="text" value="{{$employee->income_tax_no}}" name='income_tax_no' class="form-control readonly_attribute" readonly>
                  </div>
                  </div>
                  <div class="col-md-3">
                  <div class="form-group">
                    <label for="tax_ref_no">Tax Ref No.</label>
                    <input type="text" value="{{$employee->tax_ref_no}}" name='tax_ref_no' class="form-control readonly_attribute" readonly>
                  </div>
                  </div>
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="national_insurance_no">National Insurance No.</label>
                    <input type="text" value="{{$employee->national_insurance_no}}" name='national_insurance_no' class="form-control readonly_attribute" readonly>
                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="passport-information" class="tab-pane fade">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"><strong>{{"Passport Information"}}</strong></h3>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="passport_no">Passport Number</label>
                      <input type="text" name="passport_no"  class="form-control readonly_attribute" value="{{$employee->passport_no}}" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="passport_expiry_date">Passport Expire date</label>
                      <input type="date" name="passport_expiry_date"  class="form-control readonly_attribute" value="{{$employee->passport_expiry_date}}" readonly>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="passport_place">Place of Issue</label>
                      <input type="text" name="passport_place"  class="form-control readonly_attribute" value="{{$employee->passport_place}}" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="passport_issue_date">Date Of Issue</label>
                      <input type="date" name="passport_issue_date"  class="form-control readonly_attribute" value="{{$employee->passport_issue_date}}" readonly>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="passport_front">Passport Front:</label>
                      <div class="image-div">
                        <img id="passport_front" @if($employee->passport_front) src="{{asset($employee->passport_front)}}" @else src="{{asset('/images/placeholder.png')}}" @endif alt="passport_front"  height="200px" width="200px" style="border-radius:10px">
                        <a href="{{asset($employee->passport_front)}}" download class="download-image-icon"><i class="fa fa-download" aria-hidden="true"></i></a>
                        <label for="front" class="upload-icon">
                            <i class="fa fa-camera" aria-hidden="true"></i>
                        </label>
                        <input type="file" id="front" name='passport_front' onchange="readURLFront(this);"  class="form-control disabled_attribute" disabled style="display:none;">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="passport_back">Passport Back:</label>
                      <div class="image-div">
                        <img id="passport_back" @if($employee->passport_back) src="{{asset($employee->passport_back)}}" @else src="{{asset('/images/placeholder.png')}}" @endif alt="passport back"  height="200px" width="200px" style="border-radius:10px">
                        <a href="{{asset($employee->passport_back)}}" download class="download-image-icon"><i class="fa fa-download" aria-hidden="true"></i></a>
                        <label for="back" class="upload-icon">
                            <i class="fa fa-camera" aria-hidden="true"></i>
                        </label>
                        <input type="file" id="back" name='passport_back' onchange="readURLBack(this);"  class="form-control disabled_attribute" disabled style="display:none;">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    
  </div>	
  <div class="row">
    {{-- <div class="col-md-4">
      <div class="box box-primary direct-chat direct-chat-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Direct Chat </h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="direct-chat-messages">
            @foreach($messages as $message)
              @if($message->user_id == Auth::user()->id)
                <div class="direct-chat-msg">
                  <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-left">{{'You'}}</span>
                  <span class="direct-chat-timestamp pull-right">{{$message->date}}{{' '}}{{$message->time}}</span>
                  </div>
                  <img class="direct-chat-img"
                    @if(Auth::user()->avatar)
                      src="{{asset(Auth::user()->avatar)}}"
                    @else
                      src="{{asset('app/images/user-placeholder.jpg')}}"
                  @endif 
                  alt="Message User Image">
                  <div class="direct-chat-text">
                    {{$message->message}}
                  </div>
                </div>
              @elseif($message->to_id == Auth::user()->id)
                <div class="direct-chat-msg right">
                  <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-right">{{App\User::find($message->user_id)->name}}</span>
                    <span class="direct-chat-timestamp pull-left">{{$message->date}}{{' '}}{{$message->time}}</span>
                  </div>
                  <img class="direct-chat-img" 
                  @if(App\User::find($message->user_id)->avatar)
                      src="{{asset(App\User::find($message->user_id)->avatar)}}"
                    @else
                      src="{{asset('app/images/user-placeholder.jpg')}}"
                  @endif 
                  alt="Message User Image">
                  <div class="direct-chat-text">
                      {{$message->message}}
                  </div>
                </div>
              @endif
            @endforeach
          </div>
        </div>
        <div class="box-footer">
          <form action="{{route('chat.store')}}" method="post">
            @csrf
            <div class="input-group">
              <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                  <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary btn-flat">Send</button>
                  </span>
            </div>
          </form>
        </div>
      </div>
    </div> --}}
  </div>





  @if($assignments->count()>0)
      <button type="button" data-toggle="modal" id="clickme" style="display:none;" data-target="#autoload" class="btn btn-sm btn-info"></button>
      <div class="modal fade" id="autoload">
          <div class="modal-dialog">
            <div class="modal-content">
          <div class="modal-header" style="color:white;font-weight:500;background-color:#0066FF;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Assignments</h4>
          </div>
          
          <div class="modal-body">
              <table class="table table-hover mb-0">
                  <thead>
                    <tr>
                      <th>Sno.</th>
                      <th>Date</th>
                      <th>Task</th>
                      <th>Task Description</th>
                      <th>Action:</th>
                    </tr>
                    </thead>
                  <tbody>
                    @if($assignments->count()>0)
                    <?php $i = 1; ?>
                      @foreach($assignments as $assignment)
                      <tr>
                        <td>{{$i++}}</td>
                        <td>{{$assignment->date}}</td>
                        <td>{{$assignment->task}}</td>
                        <td>{{$assignment->task_description}}</td>
                        <td>
                          @if($assignment->employee_id == null)
                        <a href="{{route('task.accept',['id'=>$assignment->id])}}" class="btn btn-xs btn-info">Accept</a>
                          @else
                          {{'Accepted'}}
                          @endif
                      </td>
                      </tr>
                      @endforeach
                    @endif
                  </tbody>
                </table>
          </div>
          <div class="modal-footer" style="color:white;font-weight:500;background-color:#0066FF;">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
          </div>
            </div>
        </div>
      </div>
  @endif

@stop
@section('js')
  <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
  <script>
      $(document).ready(function() {
        window.onload=function(){
        document.getElementById("clickme").click();
      };
      });
  </script>
@stop