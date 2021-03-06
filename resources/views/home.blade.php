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

      @if(Auth::user()->admin)
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-android-person"></i></span>
            <a href="{{route('employees')}}">
            <div class="info-box-content" style="color: black">
              <span class="info-box-text"><strong>Employees</strong></span>
              <span class="info-box-number">{{$employees->count()}}</span>
            </div>
            </a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>
            <a href="{{route('clients')}}">
            <div class="info-box-content" style="color: black">
              <span class="info-box-text"><strong>Clients</strong></span>
              <span class="info-box-number">{{$clients->count()}}</span>
            </div>
          </a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-money"></i></span>
            <a href="{{route('expenses.get')}}">
            <div class="info-box-content" style="color: black">
              <span class="info-box-text"><strong>Expenses</strong></span>
              <span class="info-box-number">{{$expense}}</span>
            </div>
          </a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="small-box bg-blue">
              <div class="inner">
                <h3>{{$total_wage}}</h3>

                <p>Today's Total Wage</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{route('wage')}}" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
        </div>
    </div>

<div class="row">
      <div class="col-md-6">
        <div class="box box-primary" style="height:600px;">
            <div class="box-header with-border">
                <a href="{{route('expenses.get')}}"><h1 class="box-title" style="color:#0066FF;"><strong>Expenses</strong></h1></a>

              <div class="box-tools pull-right">
                <a href="{{route('expenses.report')}}" class="btn btn-xs bg-olive">Report</a>
                
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered" id="example">
                    <thead>
                      <tr>
                        <th>Sno.</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Company Name</th>
                        <th>Invoice No</th>
                        <th>Amount</th>
                      </tr>
                    	</thead>
                    <tbody>
                    	<?php $i = 1; ?>
	                    	@foreach(App\expenses::all()->reverse()->take(8) as $expense)
	                    	<tr>
	                    		<th>{{$i++}}</th>
	                    		<td>{{Carbon\Carbon::parse($expense->date)->format('d F Y')}}</td>
	                    		<td>{{$expense->description}}</td>
	                    		<td>
                            @if($expense->company_name)
                            {{$expense->company_name}}
	                    			@else
                            <strong>{{"N/A"}}</strong>
	                    			@endif
	                    		</td>
	                    		<td>
                            @if($expense->invoice_no)
                            {{$expense->invoice_no}}
	                    			@else
                            <strong>{{"N/A"}}</strong>
	                    			@endif
	                    		</td>
                          <td>{{$expense->amount}}</td>
                        </tr>
	                    	@endforeach
                    </tbody>
            </table>
            </div>
        </div>

      </div>
      <div class="col-md-6">
        <div class="box box-primary">
          <div class="box-body">



            <section class="content-header">
              {{-- <span class="pull-right"><a href="{{route('invoice.report')}}" class="btn btn-xs bg-maroon">Report</a></span> --}}
              <h1 class="text-center">
                <a href="{{route('invoice')}}"><span style="color:#0066FF;">Invoices</span>
                </a>
              </h1>

              <hr>

            </section>
              {{-- <h3>Total paid invoices {{$invoice->invoiceInfo()->where('status','1')->count()}}, unpaid {{$invoice->where('status','0')->count()}}.</h3> --}}
            <div class="table-responsive">
              <table id="recent-orders" class="table table-hover mb-0 ps-container ps-theme-default">
                <thead>
                  <tr>
                    <th>Invoice No.</th>
                    <th>Invoice Date</th>
                    <th>Receiver Name</th>
                    <th>Amount</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @if($invoices->count()>0)

                    @foreach(App\invoice::withTrashed()->orderBy('id','desc')->take(5)->get() as $invoice)
                      <tr>
                        <td><a href="{{route('invoice.view',['id'=>$invoice->id])}}">{{$invoice->invoice_no}}</a></td>
                        <td>{{$invoice->invoice_date}}</td>
                        <td>{{$invoice->receiver_name}}</td>

                        
                        <td>{{$invoice->currency}}{{number_format( (float) ($invoice->discounted_total + $invoice->VAT_amount), 2, '.', '')}}</td>

                        @if($invoice->status == 1 and $invoice->refund == 0 and $invoice->deleted_at == null)
                          <td><small class="label label-success">Paid</small></td>
                        @elseif($invoice->status == 0 and $invoice->refund == 0 and $invoice->deleted_at == null)
                          <td><small class="label label-danger">Unpaid</small></td>
                        @elseif($invoice->deleted_at != null)
                          <td><small class="label label-warning">Canceled</small></td>
                        @elseif($invoice->refund)
                          <td><small class="label label-info">Refunded</small></td>
                        @endif
                      </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>
            </div>
          </div>
          <div class="box-body">
            <div class="col-md-6">
                <a href="{{route('paidInvoice.report')}}">
                    <div class="info-box bg-green">
                    <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>
    
                    <div class="info-box-content">
                        <span class="info-box-text">Paid Invoices</span>
                        <span class="info-box-number">{{$paid_invoices->count()}}</span>
    
                        <div class="progress">
                        <div class="progress-bar" style="width: @if($invoices->count()>0)
                        {{number_format( (float) (($paid_invoices->count()/$invoices->count())*100), 2, '.', '')}}%
                        @else
                        0%
                        @endif"></div>
                        </div>
                            <span class="progress-description">
                            @if($invoices->count()>0)
                            {{number_format( (float) (($paid_invoices->count()/$invoices->count())*100), 2, '.', '')}}%
                            @else
                            0%
                            @endif
                            </span>
                    </div>
                    </div>
                </a>

                <a href="{{route('canceled.invoices')}}">
                    <div class="info-box bg-red">
                    <span class="info-box-icon"><i class="fa fa-ban"></i></span>
    
                    <div class="info-box-content">
                        <span class="info-box-text">Canceled Invoices</span>
                        <span class="info-box-number">{{$canceled_invoices->count()}}</span>
    
                        <div class="progress">
                        <div class="progress-bar" style="width: @if($invoices->count()>0)
                        {{number_format( (float) (($canceled_invoices->count()/$invoices->count())*100), 2, '.', '')}}%
                        @else
                        0%
                        @endif"></div>
                        </div>
                            <span class="progress-description">
                            @if($invoices->count()>0)
                            {{number_format( (float) (($canceled_invoices->count()/$invoices->count())*100), 2, '.', '')}}%
                            @else
                            0%
                            @endif
                            </span>
                    </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6">
           <a href="{{route('unpaidInvoice.report')}}">
                <div class="info-box bg-navy">
                <span class="info-box-icon"><i class="fa fa-thumbs-o-down"></i></span>
    
                <div class="info-box-content">
                    <span class="info-box-text">UnPaid Invoices</span>
                    <span class="info-box-number">{{$unpaid_invoices->count()}}</span>
    
                    <div class="progress">
                    <div class="progress-bar" style="width:
                    @if($invoices->count()>0)
                    {{number_format( (float) (($unpaid_invoices->count()/$invoices->count())*100), 2, '.', '')}}%
                    @else
                    0%
                    @endif"></div>
                    </div>
                        <span class="progress-description">
                        @if($invoices->count()>0)
                        {{number_format( (float) (($unpaid_invoices->count()/$invoices->count())*100), 2, '.', '')}}%
                        @else
                        0%
                        @endif
                        </span>
                </div>
                </div>
            </a>

            <a href="{{route('refunded.invoices')}}">
                <div class="info-box bg-blue">
                <span class="info-box-icon"><i class="fa fa-money" aria-hidden="true"></i></span>
    
                <div class="info-box-content">
                    <span class="info-box-text">Refunded Invoices</span>
                    <span class="info-box-number">{{$refunded_invoices->count()}}</span>
    
                    <div class="progress">
                    <div class="progress-bar" style="width:
                    @if($invoices->count()>0)
                    {{number_format( (float) (($refunded_invoices->count()/$invoices->count())*100), 2, '.', '')}}%
                    @else
                    0%
                    @endif"></div>
                    </div>
                        <span class="progress-description">
                        @if($invoices->count()>0)
                        {{number_format( (float) (($refunded_invoices->count()/$invoices->count())*100), 2, '.', '')}}%
                        @else
                        0%
                        @endif
                        </span>
                </div>
                </div>
            </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="box box-danger">
          <div class="box-body">



            <section class="content-header">
              <h1 class="text-center">
                <a href="{{route('visa.report')}}"><span style="color:#0066FF;">Visa Report</span>
                </a>
              </h1>

              <hr>

            </section>
            <div class="table-responsive">
              <table id="recent-orders" class="table table-hover mb-0 ps-container ps-theme-default">
                <thead>
                  <tr>
                    <th>Sno.</th>
                    <th>Client Name</th>
                    <th>Phone No.</th>
                    <th>Date</th>
                    <th>Visa Applicant Name</th>
                    <th>DOB</th>
                    <th>Passport Origin</th>
                    <th>Passport No.</th>
                    <th>Visa Country</th>
                    <th>Visa Type</th>
                  </tr>
                  </thead>
                <tbody>
                  @if($invoices->count()>0)
                  <?php $i = 1; ?>
                    @foreach($invoice_infos as $invoice)
                    <tr>
                      <td>{{$i++}}</td>
                      <td>{{$invoice->invoice->receiver_name}}</td>
                      <td>{{$invoice->invoice->client->phone}}</td>
                      <td>{{$invoice->created_at->toDateString()}}</td>
                      <td>{{$invoice->name_of_visa_applicant}}</td>
                      <td>{{$invoice->passport_member_DOB}}</td>
                      <td>{{$invoice->passport_origin}}</td>
                      <td>{{$invoice->passport_no}}</td>
                      <td>{{$invoice->visa_country}}</td>
                      <td>{{$invoice->visa_type}}</td>
                      </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      {{-- <div class="col-md-7">

          <div class="box box-solid bg-black-gradient">
            <div class="box-header">
              <i class="fa fa-calendar"></i>

              <h3 class="box-title">Calendar</h3>
              <div class="pull-right box-tools">
                <div class="btn-group">
                </div>
                <button type="button" class="btn btn-lg btn-default" data-toggle="modal" data-target="#modal-info" ><span style="color: white"><strong>Add New Event</strong></span></button>
                <button type="button" class="btn btn-default btn-sm" data-widget="collapse"><span style="color: white"><i class="fa fa-minus"></i></span>
                </button>
                
              </div>
            </div>
            <div class="box-body no-padding">
              <div id="calendar" style="width: 100%"></div>
            </div>
          </div>
      </div> --}}
        <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">Quick Email</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                
              </div>
              <!-- /. tools -->
            </div>
            <div class="box-body">
              <form action="{{route('send.email')}}" method="post">
              
                @csrf
                <div class="form-group">
                  <input type="email" class="form-control" name="emailto" placeholder="Email to:">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="subject" placeholder="Subject">
                </div>
                <div>
                    <textarea name="content" id="summernote" class="form-control"></textarea>
                </div>

                </div>
                <div class="box-footer clearfix">
                  <button type="submit" class="pull-right btn btn-default" id="sendEmail">Send
                    <i class="fa fa-arrow-circle-right"></i></button>
                </div>
                
              </form>
        </div>
        
        </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title"><strong>EMPLOYEES <span class="text-success">Present</span></strong></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <ul class="users-list clearfix">
                @foreach($wages as $wage)
                <li>
                  <img
                  @if($wage->employee->user and $wage->employee->user->avatar)
                    src="{{asset($wage->employee->user->avatar)}}"
                  @else
                    src="{{asset('app/images/user-placeholder.jpg')}}"
                  @endif
                  style="height: 50px" alt="User Image">
                  <a class="users-list-name" href="{{route('view.employee',['id'=>$wage->employee->id])}}">{{$wage->employee->first_name}}</a>
                  <span class="users-list-date">

                    {{$wage->login_time}}

                  </span>
                </li>
                @endforeach
              </ul>
           </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title"><strong>EMPLOYEES <span class="text-danger">Absent</span></strong></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <ul class="users-list clearfix">
                @foreach($employees as $emp)
                @if(!$emp->wage->count()>0 or $emp->wage->last()->date != Carbon\Carbon::now()->toDateString() )
                <li>
                  <img
                  @if($emp->user and $emp->user->avatar)
                    src="{{asset($emp->user->avatar)}}"
                  @else
                    src="{{asset('app/images/user-placeholder.jpg')}}"
                  @endif
                  style="height: 50px" alt="User Image">
                  <a class="users-list-name" href="{{route('view.employee',['id'=>$emp->id])}}">{{$emp->first_name}}</a>
                  <span class="users-list-date">

                    {{-- {{$logout->logout_time}} --}}

                  </span>
                </li>
                @endif
                @endforeach
              </ul>
           </div>
        </div>
      </div>
    </div>
      @endif





<div class="modal fade" id="modal-info">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="color:white;font-weight:500;background-color:#0066FF;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Create New Event</h4>
      </div>
      <form action="{{ route('tasks.store') }}" method="post">
        @csrf
      <div class="modal-body">
          <label for="name">Task Name</label>
          <input type="text" name="name" class="form-control" />
          <label for="description">Task Description</label>
          <textarea name="description" class="form-control"></textarea>
          <label for="task_date">Task Date:</label>
          <input type="date" name="task_date" class="date form-control" />
          {{-- <div class="text-center">
            <input type="submit" value="Save" class="btn btn-sm btn-info" />
          </div> --}}
        {{-- <p>One fine body&hellip;</p> --}}
      </div>
      <div class="modal-footer" style="color:white;font-weight:500;background-color:#0066FF;">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-outline">Save</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@endsection
@section('js')
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script>
    // $(document).ready(function(){
    //   $("#create").click(function(){

    //     var data = '<form action="{{ route('tasks.store') }}" method="post">{{ csrf_field() }}<label for="name">Task Name</label><input type="text" name="name" class="form-control" /><label for="description">Task Description</label><textarea name="description" class="form-control"></textarea><label for="task_date">Task Date:</label><input type="date" name="task_date" class="date form-control" /><div class="text-center"><input type="submit" value="Save" class="btn btn-sm btn-info" /></div></form>';
    //       $("#createEvent").html(data);
    //       });
    //   });

    // $(document).ready(function() {
      
    //   var messageBody = document.querySelector('#testing');
      
    //   messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
    
    //     // page is now ready, initialize the calendar...
    //     $('#calendar').fullCalendar({
    //         // put your options and callbacks here
    //         events : [
    //             @foreach($tasks as $task)
    //             {
    //                 title : '{{ $task->name }}',
    //                 start : '{{ $task->task_date }}',
    //                 url : '{{ route('tasks.show', $task->id) }}'
    //             },
    //             @endforeach
    //         ]
    //     })
    // });

    $(document).ready(function() {
      window.onload=function(){
      document.getElementById("clickme").click();
    };
    });
</script>
<script>
    function sendMessage(test){
      
        
        var to_id = $(test).parents("#form").find('#to_id').val();
        var message = $(test).parents("#form").find('#message').val();
        var params = 'to_id='+to_id+'&message='+message;
        var Url = "http://buildatwill.com/cloud/public/chat/store";
         var xhr = new XMLHttpRequest();
         xhr.open('GET', Url+"?"+params, true);
         xhr.send();
         xhr.onreadystatechange = processRequest;
           function processRequest(e) {
             var response1 = JSON.parse(xhr.responseText);
              if (response1){
                var data =
                '<div class="direct-chat-msg ">'+
                  '<div class="direct-chat-danger clearfix">'+
                    '<span class="direct-chat-name pull-left">{{"You"}}</span>'+
                  '<span class="direct-chat-timestamp pull-right">'+response1[2]+'{{' '}}'+response1[1]+'</span>'+
                  '</div>'+
                  '<img class="direct-chat-img"'+
                    '@if(Auth::user()->avatar)'+
                      'src="{{asset(Auth::user()->avatar)}}"'+
                    '@else'+
                      'src="{{asset("app/images/user-placeholder.jpg")}}"'+
                  '@endif '+
                  'alt="Message User Image"  >'+
                  '<div class="direct-chat-text">'+
                    response1[0]+
                  '</div>'+
                '</div>';
                if (test) {
                  $('#message').val('');
                  $('#button').attr('disabled','disabled');
                  $('#testing').append(data);
                  test = false;
                }
                var messageBody = document.querySelector('#testing');
                messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
                  }
              }
             
           }
        
    
        function test(temp){
          if (temp.value.trim() == '') {
          $('#button').attr('disabled','disabled');
          }
          else{
            $('#button').removeAttr('disabled');
          }
        }
    
        
    </script>
    
@stop
@section('css')
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
@stop
@section('js')
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
<script>
  $(document).ready(function() {
  $('#summernote').summernote();
});
</script>
@stop