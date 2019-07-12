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
    <div class="small-box bg-blue">
        <div class="inner">
          <h3>{{$employee->currency.' '.$total_wage}}</h3>

          <p>Total Wage</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="{{route('wage.log',['id'=>Auth::user()->employee[0]->id])}}" class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </a>
    </div>
  </div>

  <div class="col-md-3">

    <div class="small-box bg-orange">
      <div class="inner">
        
        <h3>
            @if(App\wage::where('employee_id',Auth::user()->employee[0]->id)->where('date',Carbon\Carbon::now()->toDateString())->get()->count()>0)
              {{App\wage::where('employee_id',Auth::user()->employee[0]->id)->where('date',Carbon\Carbon::now()->toDateString())->get()[0]->total_hours}}
            @else
              0.00
            @endif
        </h3>
        <p>Total Hours Today</p>
      </div>
      <div class="icon">
        <i class="ion ion-clock"></i>
      </div>
      <a href="{{route('wage.log',['id'=>Auth::user()->employee[0]->id])}}" class="small-box-footer">
        More info <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>

  <div class="col-md-3">

    <div class="small-box bg-purple">
      <div class="inner">
        <h3>
            {{number_format( (float) ($total_hours_this_session/60), 2, '.', '')}}
          
        </h3>

        <p>Total Hours This Session</p>
      </div>
      <div class="icon">
          <i class="fa fa-clock-o" aria-hidden="true"></i>
      </div>
      <a href="{{route('session')}}" class="small-box-footer">
          @if($latest_wageLog != null and $latest_wageLog->logout_time == null) 
          End Your Session.
          @else 
          Start Your Session.
          @endif <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>

  <div class="col-md-3">

      <div class="small-box bg-teal">
        <div class="inner">
          <h3>
            {{App\assignment::where('employee_id',Auth::user()->employee[0]->id)->get()->count()}}
          </h3>
  
          <p>Assignments Accepted</p>
        </div>
        <div class="icon">
            <i class="fa fa-paperclip" aria-hidden="true"></i>
        </div>
        <a href="{{route('assign')}}" class="small-box-footer">
            More info <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-md-3">
      <div class="image-div">
          <img  id="blah"
          @if($employee->user->avatar)
            src="{{asset($employee->user->avatar)}}"
          @else
            src="{{asset('app/images/user-placeholder.jpg')}}"
          @endif 
          alt="avatar" class="img-responsive">
      </div>
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
  <div class="col-md-6">
        <div class="tab-content">
          <div id="personal-information" class="tab-pane fade in active">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"><strong>{{"Personal Information"}}</strong></h3>
              </div>
              <div class="box-body details">
                  <h4><span>Employee ID</span> : &nbsp;&nbsp;@if($employee->unique_id){{$employee->unique_id}}@else -- @endif</h4> 
                  <h4><span>First Name</span> :&nbsp;&nbsp; @if($employee->first_name){{$employee->first_name}}@else -- @endif</h4>
                  <h4><span>Last Name</span> :&nbsp;&nbsp;  @if($employee->last_name){{$employee->last_name}}@else -- @endif</h4>
                  <h4><span>Father's Name</span> : &nbsp;&nbsp; @if($employee->father_name){{$employee->father_name}}@else -- @endif</h4>
                  <h4><span>Mother's Name</span> : &nbsp;&nbsp; @if($employee->mother_name){{$employee->mother_name}}@else -- @endif</h4>
                  <h4><span>Gender</span> : &nbsp;&nbsp; @if($employee->gender){{$employee->gender}}@else -- @endif</h4>
                  <h4><span>Date Of Birth</span> : &nbsp;&nbsp; @if($employee->DOB){{$employee->DOB}}@else -- @endif</h4>
                  <h4><span>Marital Status</span> :  &nbsp;&nbsp;@if($employee->marital_status){{$employee->marital_status}}@else -- @endif</h4>
                  <h4><span>Disability</span> : &nbsp;&nbsp; @if($employee->disability){{$employee->disability}}@else -- @endif</h4>
                  <h4><span>Blood Group</span> : &nbsp;&nbsp; @if($employee->blood_group){{$employee->blood_group}}@else -- @endif</h4>
                  <h4><span>Country</span> :  &nbsp;&nbsp;@if($employee->country){{$employee->country}}@else -- @endif</h4>
                  <h4><span>County</span> :  &nbsp;&nbsp;@if($employee->county){{$employee->county}}@else -- @endif</h4>
                  <h4><span>Visa</span> :  &nbsp;&nbsp;@if($employee->visa){{$employee->visa}}@else -- @endif</h4>
                  <h4><span>Visa Valid Upto</span> :  &nbsp;&nbsp;@if($employee->visa_expired){{$employee->visa_expired}}@else -- @endif</h4>
              </div>
            </div>
          </div>
          <div id="contact-information" class="tab-pane fade">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"><strong>{{"Contact Information"}}</strong></h3>
              </div>
              <div class="box-body details">
                  <h4><span>Permanent Home Address</span> : &nbsp;&nbsp;@if($employee->permanent_address){{$employee->permanent_address}}@else -- @endif</h4> 
                  <h4><span>Temporary Home Address</span> : &nbsp;&nbsp;@if($employee->temporary_address){{$employee->temporary_address}}@else -- @endif</h4> 
                  <h4><span>Home Phone</span> : &nbsp;&nbsp;@if($employee->home_phone){{$employee->home_phone}}@else -- @endif</h4> 
                  <h4><span>Mobile Phone</span> : &nbsp;&nbsp;@if($employee->mobile_phone){{$employee->mobile_phone}}@else -- @endif</h4> 
                  <h4><span>Email</span> : &nbsp;&nbsp;@if($employee->email){{$employee->email}}@else -- @endif</h4> 
              </div>
            </div>
          </div>
          <div id="professional-information" class="tab-pane fade">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"><strong>{{"Professional Information"}}</strong></h3>
              </div>
              <div class="box-body details">
                  <h4><span>Qualification</span> : &nbsp;&nbsp;@if($employee->qualification){{$employee->qualification}}@else -- @endif</h4> 
                  <h4><span>Experience</span> : &nbsp;&nbsp;@if($employee->experience){{$employee->experience}}@else -- @endif</h4> 
                  <h4><span>Experience In Department</span> : &nbsp;&nbsp;@if($employee->exp_in_dept){{$employee->exp_in_dept}}@else -- @endif</h4> 
                  <h4><span>Hired For Department</span> : &nbsp;&nbsp;@if($employee->hired_for_dep){{$employee->hired_for_dep}}@else -- @endif</h4> 
                  <h4><span>Hiring Date</span> : &nbsp;&nbsp;@if($employee->hiring_date){{$employee->hiring_date}}@else -- @endif</h4>
                  <h4><span>Currency</span> : &nbsp;&nbsp;@if($employee->currency){{$employee->currency}}@else -- @endif</h4> 
                  <h4><span>Hiring Date</span> : &nbsp;&nbsp;@if($employee->hiring_date){{$employee->hiring_date}}@else -- @endif</h4>
                  <h4><span>Rate Contract</span> : &nbsp;&nbsp;@if($employee->rate){{$employee->rate}}@else -- @endif</h4>
                  <h4><span>Per</span> : &nbsp;&nbsp;@if($employee->per){{$employee->per}}@else -- @endif</h4>
                  <h4><span>Work Permit</span> : &nbsp;&nbsp;
                    <div class="image-div">
                        <img id="work_permit" @if($employee->work_permit) src="{{asset($employee->work_permit)}}" @else src="{{asset('/images/placeholder.png')}}" @endif alt="work permit" style="width:120px;height:100px;" class="img-responsive">
                        <a href="{{asset($employee->work_permit)}}" download class="download-image-icon"><i class="fa fa-download" aria-hidden="true"></i></a>
                    </div>
                  </h4>
                  <h4><span>Utility Bill</span> : &nbsp;&nbsp;
                    <div class="image-div">
                        <img id="utility_bill" @if($employee->utility_bill) src="{{asset($employee->utility_bill)}}" @else src="{{asset('/images/placeholder.png')}}" @endif alt="utility bill" style="width:120px;height:100px;" class="img-responsive">
                        <a href="{{asset($employee->utility_bill)}}" download class="download-image-icon"><i class="fa fa-download" aria-hidden="true"></i></a>
                    </div>
                  </h4>
              </div>
            </div>
          </div>
          <div id="emergency-contact-information" class="tab-pane fade">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"><strong>{{"Emergency Contact Information"}}</strong></h3>
              </div>
              <div class="box-body details">
                  <h4><span>Contact Name</span> : &nbsp;&nbsp;@if($employee->emer_contact_name){{$employee->emer_contact_name}}@else -- @endif</h4>
                  <h4><span>Contact Address</span> : &nbsp;&nbsp;@if($employee->emer_contact_address){{$employee->emer_contact_address}}@else -- @endif</h4>
                  <h4><span>Contact Phone No.</span> : &nbsp;&nbsp;@if($employee->emer_contact_phone){{$employee->emer_contact_phone}}@else -- @endif</h4>
                  <h4><span>Contact Email</span> : &nbsp;&nbsp;@if($employee->emer_contact_email){{$employee->emer_contact_email}}@else -- @endif</h4>
                  <h4><span>Relation</span> : &nbsp;&nbsp;@if($employee->emer_contact_relation){{$employee->emer_contact_relation}}@else -- @endif</h4>
              </div>
            </div>
          </div>
          <div id="account-information" class="tab-pane fade">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"><strong>{{"Account Information"}}</strong></h3>
              </div>
              <div class="box-body details">
                  <h4><span>SORT Code</span> : &nbsp;&nbsp;@if($employee->sort_code){{$employee->sort_code}}@else -- @endif</h4>
                  <h4><span>Account No</span> : &nbsp;&nbsp;@if($employee->account_no){{$employee->account_no}}@else -- @endif</h4>
                  <h4><span>Bank Name</span> : &nbsp;&nbsp;@if($employee->bank_name){{$employee->bank_name}}@else -- @endif</h4>
                  <h4><span>Bank Address</span> : &nbsp;&nbsp;@if($employee->bank_address){{$employee->bank_address}}@else -- @endif</h4>
                  <h4><span>Income Tax No</span> : &nbsp;&nbsp;@if($employee->income_tax_no){{$employee->income_tax_no}}@else -- @endif</h4>
                  <h4><span>Tax Ref No</span> : &nbsp;&nbsp;@if($employee->tax_ref_no){{$employee->tax_ref_no}}@else -- @endif</h4>
                  <h4><span>National Insurance No</span> : &nbsp;&nbsp;@if($employee->national_insurance_no){{$employee->national_insurance_no}}@else -- @endif</h4>
              </div>
            </div>
          </div>
          <div id="passport-information" class="tab-pane fade">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"><strong>{{"Passport Information"}}</strong></h3>
              </div>
              <div class="box-body details">
                <h4><span>Passport No</span> : &nbsp;&nbsp;@if($employee->passport_no){{$employee->passport_no}}@else -- @endif</h4>
                <h4><span>Passport Expiry Date</span> : &nbsp;&nbsp;@if($employee->passport_expiry_date){{$employee->passport_expiry_date}}@else -- @endif</h4>
                <h4><span>Place Of Issue</span> : &nbsp;&nbsp;@if($employee->passport_place){{$employee->passport_place}}@else -- @endif</h4>
                <h4><span>Date Of Issue</span> : &nbsp;&nbsp;@if($employee->passport_issue_date){{$employee->passport_issue_date}}@else -- @endif</h4>
                <h4><span>Passport Front</span> : &nbsp;&nbsp;
                  <div class="image-div">
                      <img id="passport_front" @if($employee->passport_front) src="{{asset($employee->passport_front)}}" @else src="{{asset('/images/placeholder.png')}}" @endif alt="work permit" style="width:120px;height:100px;" class="img-responsive">
                      <a href="{{asset($employee->passport_front)}}" download class="download-image-icon"><i class="fa fa-download" aria-hidden="true"></i></a>
                  </div>
                </h4>
                <h4><span>Passport Back </span> : &nbsp;&nbsp;
                  <div class="image-div">
                      <img id="passport_back" @if($employee->passport_back) src="{{asset($employee->passport_back)}}" @else src="{{asset('/images/placeholder.png')}}" @endif alt="work permit" style="width:120px;height:100px;" class="img-responsive">
                      <a href="{{asset($employee->passport_back)}}" download class="download-image-icon"><i class="fa fa-download" aria-hidden="true"></i></a>
                  </div>
                </h4>
              </div>
            </div>
          </div>
        </div>
  </div>
  <div class="col-md-3">
    <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title"><strong>{{"This Week"}}</strong></h3>
            <span class="float-right">
            <a href="{{route('attendance',['id'=>Auth::user()->employee[0]->id])}}" class="btn btn-xs btn-success">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </span>
          </div>
      <div class="box-body">
        <table class="table table-bordered mb-0" style="margin-top:0px;">
          <thead class="bg-light-gray">
            <tr>
              <th><strong>Date</strong></th>
              <th><strong>Status</strong></th>
              <th><strong>Wage</strong></th>
            </tr>
          </thead>
          <tbody>
            <?php
              $array_two = array();
              if(Auth::user()->created_at->toDateString() < Carbon\Carbon::now()->startOfWeek()->toDateString() ){
              $period = Carbon\CarbonPeriod::since(Carbon\Carbon::now()->startOfWeek()->toDateString())->days(1)->until(Carbon\Carbon::now()->toDateString())->toArray();
            }
            else{
              $period = Carbon\CarbonPeriod::since(Auth::user()->created_at->toDateString())->days(1)->until(Carbon\Carbon::now()->toDateString())->toArray();
            }
              foreach(App\wage::where('employee_id',Auth::user()->employee[0]->id)->get() as $wage){
                array_push($array_two,Carbon\Carbon::parse($wage->date)->toDateString());
              }
            ?>
            @foreach(collect($period)->reverse() as $d)
              <tr>
                <td style="font-weight:10px;">{{$d->format('d-m-Y')}}</td>
                <td>
                  @if(collect($array_two)->contains($d->toDateString()))
                    <span class="text-success"><strong>{{'PRESENT'}}</strong></span>
                  @else
                    <span class="text-danger"><strong>{{'ABSENT'}}</strong></span>
                  @endif
                </td>
                <td>
                  @if(App\wage::where('employee_id',Auth::user()->employee[0]->id)->where('date',$d->toDateString())->get()->count()>0)

                    {{$employee->currency.' '.App\Wage::where('employee_id',Auth::user()->employee[0]->id)->where('date',$d->toDateString())->get()[0]->today_wage}}

                  @else
                    --
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
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