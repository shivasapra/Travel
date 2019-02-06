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

            <div class="info-box-content">
              <span class="info-box-text"><strong>Employees</strong></span>
              <span class="info-box-number">{{$employees->count()}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><strong>Clients</strong></span>
              <span class="info-box-number">{{$clients->count()}}</span>
            </div>
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

            <div class="info-box-content">
              <span class="info-box-text"><strong>Expenses</strong></span>
              <span class="info-box-number">{{$expense}}</span>
            </div>
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
     <div class="col-md-4">
      <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title"><strong>EMPLOYEES <span class="text-success">Logged In</span></strong></h3>

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
              @foreach($logged_in as $login)
              <li>
                <img 
                @if($login->employee->user and $login->employee->user->avatar)
                  src="{{asset($login->employee->user->avatar)}}"
                @else
                  src="{{asset('app/images/user-placeholder.jpg')}}"
                @endif 
                style="height: 50px" alt="User Image">
                <a class="users-list-name" href="{{route('view.employee',['id'=>$login->employee->id])}}">{{$login->employee->first_name}}</a>
                <span class="users-list-date">
                  
                  {{$login->login}}
                  
                </span>
              </li>
              @endforeach
            </ul>
         </div>
      </div>
     </div>
     <div class="col-md-4">
      <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title"><strong>EMPLOYEES <span class="text-warning">Logged Out</span></strong></h3>

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
              @foreach($logged_out as $logout)
              <li>
                <img 
                @if($logout->employee->user and $logout->employee->user->avatar)
                  src="{{asset($logout->employee->user->avatar)}}"
                @else
                  src="{{asset('app/images/user-placeholder.jpg')}}"
                @endif 
                style="height: 50px" alt="User Image">
                <a class="users-list-name" href="{{route('view.employee',['id'=>$logout->employee->id])}}">{{$logout->employee->first_name}}</a>
                <span class="users-list-date">
                  
                  {{$logout->logout}}
                  
                </span>
              </li>
              @endforeach
            </ul>
         </div>
      </div>
     </div>
     <div class="col-md-4">
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
              @foreach($employees as $employee)
              @if($employee->wage->count()>0)
                @if($employee->wage->last()->date != $date)
                <li>
                  <img 
                  @if($employee->user and $employee->user->avatar)
                    src="{{asset($employee->user->avatar)}}"
                  @else
                    src="{{asset('app/images/user-placeholder.jpg')}}"
                  @endif 
                  style="height: 50px" alt="User Image">
                  <a class="users-list-name" href="{{route('view.employee',['id'=>$employee->id])}}">{{$employee->first_name}}</a>
                  {{-- <span class="users-list-date">
                    
                    {{$logout->logout}}
                    
                  </span> --}}
                </li>
                @endif
                @else
                <li>
                  <img 
                  @if($employee->user and $employee->user->avatar)
                    src="{{asset($employee->user->avatar)}}"
                  @else
                    src="{{asset('app/images/user-placeholder.jpg')}}"
                  @endif 
                  style="height: 50px" alt="User Image">
                  <a class="users-list-name" href="{{route('view.employee',['id'=>$employee->id])}}">{{$employee->first_name}}</a>
                  {{-- <span class="users-list-date">
                    
                    {{$logout->logout}}
                    
                  </span> --}}
                </li>
              @endif
              @endforeach
            </ul>
         </div>
      </div>
     </div>
    </div>
    
    <div class="row">
      <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><strong>Expenses({{$expenses->count()}})</strong></h3>

              <div class="box-tools pull-right">
                <a href="{{route('expenses.report')}}" class="btn btn-xs bg-olive">Report</a>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
                @if($recent_expenses->count()>0)
                @foreach($expenses as $expense)
                <li class="item">
                  {{-- <div class="product-img">
                    <img src="dist/img/default-50x50.gif" alt="Product Image">
                  </div> --}}
                  <div class="product-info">
                    {{$expense->description}}
                      <span class="label label-success pull-right">{{'$'.$expense->amount}}</span>
                    <span class="product-description">
                          {{$expense->date}}
                        </span>
                  </div>
                </li>
                @endforeach
                @endif
              </ul>
            </div>
        </div>
        
      </div>
      <div class="col-md-6">
        <div class="box box-primary">
          <div class="box-body">
            
              
            
            <section class="content-header">
              {{-- <span class="pull-right"><a href="{{route('invoice.report')}}" class="btn btn-xs bg-maroon">Report</a></span> --}}
              <h1 class="text-center">
                <a href="{{route('invoice')}}"><span style="color:#0066FF;">Invoices({{$invoices->count()}})</span>
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
                  
                    @foreach($invoices as $invoice)
                    <tr>
                      <td><a href="{{route('invoice.view',['id'=>$invoice->id])}}">{{$invoice->invoice_no}}</a></td>
                      <td>{{$invoice->invoice_date}}</td>
                      <td>{{$invoice->receiver_name}}</td>
                      
                        @if($tax[0]->enable == 'yes')
                          <?php $taxed = ($tax[0]->tax/100*$invoice->discounted_total) ?>
                       @endif
                      @if($tax[0]->enable == 'yes')
                          <?php $total = $invoice->discounted_total + $taxed ?>
                          <td>{{$invoice->invoiceInfo[0]->currency}} {{$total}}</td>
                        @else
                            <td>{{$invoice->invoiceInfo[0]->currency}} {{$invoice->discounted_total}}</td>
                        @endif
                      
                      @if($invoice->status == 1)
                      <td><small class="label label-success">Paid</small></td>
                      @else
                      <td><small class="label label-danger">Unpaid</small></td>
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
                  {{(($paid_invoices->count()/$invoices->count())*100)}}%
                  @else
                  0%
                  @endif"></div>
                </div>
                    <span class="progress-description">
                      @if($invoices->count()>0)
                      {{(($paid_invoices->count()/$invoices->count())*100)}}%
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
                  {{(($unpaid_invoices->count()/$invoices->count())*100)}}%
                  @else
                  0%
                  @endif"></div>
                </div>
                    <span class="progress-description">
                      @if($invoices->count()>0)
                      {{(($unpaid_invoices->count()/$invoices->count())*100)}}%
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
       <div class="col-md-7">
          
          <div class="box box-solid bg-black-gradient">
            <div class="box-header">
              <i class="fa fa-calendar"></i>

              <h3 class="box-title">Calendar</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <!-- button with a dropdown -->
                <div class="btn-group">
                  {{-- <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown"> --}}
                    {{-- <i class="fa fa-bars"></i></button> --}}
                  {{-- <ul class="dropdown-menu pull-right" role="menu"> --}}
                    {{-- <li></li> --}}
                    {{-- <li><a href="#">Clear events</a></li> --}}
                    {{-- <li class="divider"></li>
                    <li><a href="#">View calendar</a></li>--}}                  
                  {{-- </ul> --}}
                </div>
                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal-info"><span style="color: white">Add new event</span></button>
                {{-- <button class="btn btn-sm btn-default" id="create"><span style="color: white">Add new event</span></button> --}}
                <button type="button" class="btn btn-default btn-sm" data-widget="collapse"><span style="color: white"><i class="fa fa-minus"></i></span>
                </button>
                {{-- <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i> --}}
                </button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <!--The calendar -->
              <div id="calendar" style="width: 100%"></div>
            </div>
            <!-- /.box-body -->
            {{-- <div class="box-footer text-black">
              <div class="row">
                <div class="col-sm-6">
                  <div class="clearfix">
                    <span class="pull-left">Task #1</span>
                    <small class="pull-right">90%</small>
                  </div>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 90%;"></div>
                  </div>

                  <div class="clearfix">
                    <span class="pull-left">Task #2</span>
                    <small class="pull-right">70%</small>
                  </div>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 70%;"></div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="clearfix">
                    <span class="pull-left">Task #3</span>
                    <small class="pull-right">60%</small>
                  </div>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 60%;"></div>
                  </div>

                  <div class="clearfix">
                    <span class="pull-left">Task #4</span>
                    <small class="pull-right">40%</small>
                  </div>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 40%;"></div>
                  </div>
                </div>
              </div>
            </div> --}}
          </div>
        </div>
        <div class="col-md-5">
        {{-- <div class="box box-info">
          <div class="box-header">
            <h4 class="card-title"><strong>Todo</strong><span id="addtodo"><button class="btn btn-sm btn-primary">Add</button></span></h4>
            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
              <ul class="list-inline mb-0">
                <li><strong>{{$date}}</strong></li>
              </ul>
            </div>
          </div>
          <div class="box-body">
            <div id="todo"></div>
            <div id="daily-activity" class="table-responsive height-350">
              <table class="table table-hover mb-0">
                <thead>
                  <tr>
                    <th>
                    </th>
                    <th>Time</th>
                    <th>Activity</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @if($todos->count()>0)
                  @foreach($todos as $todo)
                    <tr>
                      <td class="text-truncate">
                        <form action="{{route('update.todo',['id'=>$todo->id])}}" method="post">
                          @csrf
                          @if($todo->status==1)
                          <button id="updateTodo" type="submit" class="btn btn-primary btn-sm" disabled><span class="fa fa-check"></span>
                          @else
                          <button id="updateTodo" type="submit" class="btn btn-danger btn-sm"><span class="fa fa-eye"></span>
                          @endif
                          </button>
                          
                        </form>
                      </td>
                      <td class="text-truncate">{{$todo->time}}</td>
                      <td class="text-truncate">{{$todo->activity}}</td>
                      <td class="text-truncate">
                        @if($todo->status == 0)
                        <span class="badge badge-default badge-info">Pending</span>
                        @elseif($todo->status == 1)
                        <span class="badge badge-default badge-success">Done</span>
                        @elseif($todo->status == 2)
                        <span class="badge badge-default badge-warning">Delayed</span>
                        @elseif($todo->status == 3)
                        <span class="badge badge-default badge-delete">Missed</span>
                        @endif
                      </td>
                    </tr>
                  @endforeach
                  @endif
                </tbody>
              </table>
            
              <div class="text-center">
                <a class="btn btn-sm btn-warning" href="{{route('todos',['target_date'=>$date])}}"  style="margin-top: 7px">All Todos</a>
              </div>
            
            </div>
          </div>
        </div> --}}
        <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">Quick Email</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <div class="box-body">
              <form action="#" method="post">
                <div class="form-group">
                  <input type="email" class="form-control" name="emailto" placeholder="Email to:">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="subject" placeholder="Subject">
                </div>
                <div>
                  <textarea class="textarea" placeholder="Message"
                            style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
              </form>
            </div>
            <div class="box-footer clearfix">
              <button type="button" class="pull-right btn btn-default" id="sendEmail">Send
                <i class="fa fa-arrow-circle-right"></i></button>
            </div>
        </div>
        {{-- <div class="box box-success">
        <div id="createEvent"></div>
        </div> --}}
        </div>
    </div>
    
      @else

    <div class="box box-success">
    <div class="box-body">
        
      <table class="table table-hover mb-0">
                <thead>
                    <tr>
                      <th>Sno.</th>
                      <th>Unique Id</th>
                      <th>Date</th>
                      <th>Login Time</th>
                      <th>Logout Time</th>
                      <th>Hourly Wage</th>
                      <th>Total wage</th>
                    </tr>
                </thead>
                <tbody>
                @if(auth::user()->employee[0]->wage->count()>0)
                <?php $i=1;?>
                @foreach(auth::user()->employee[0]->wage as $wage)
                <tr>
                <td>{{$i++}}</td>
                <td>{{auth::user()->employee[0]->unique_id}}</td>
                    <td>{{$wage->date}}</td>
                <td>{{$wage->login}}</td>
                    <td>{{$wage->logout}}</td>
                    <td>{{$wage->hourly}}</td>
                    <td>{{$wage->wage}}</td>
                </tr>
                 @endforeach
                @endif
          </tbody>
      </table>
    </div>
  </div>
      @endif
  

 
      <!-- /.row -->
{{-- <div class="container">
    <div class="row justify-content-center">
        

    <div class="col-lg-6">
        <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
            <div class="card-header text-center">Total Employees</div>
            <div class="card-body bg-light text-dark">
                <h3 class="card-title text-center">{{$employees->count()}}</h3>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
            <div class="card-header text-center">Total Clients</div>
            <div class="card-body bg-light text-dark">
                <h3 class="card-title text-center">{{$clients->count()}}</h3>
            </div>
        </div>
    </div>
    </div>
</div> --}}

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
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
<script>
    // $(document).ready(function(){
    //   $("#create").click(function(){

    //     var data = '<form action="{{ route('tasks.store') }}" method="post">{{ csrf_field() }}<label for="name">Task Name</label><input type="text" name="name" class="form-control" /><label for="description">Task Description</label><textarea name="description" class="form-control"></textarea><label for="task_date">Task Date:</label><input type="date" name="task_date" class="date form-control" /><div class="text-center"><input type="submit" value="Save" class="btn btn-sm btn-info" /></div></form>';
    //       $("#createEvent").html(data);   
    //       });
    //   });

    $(document).ready(function() {
        // page is now ready, initialize the calendar...
        $('#calendar').fullCalendar({
            // put your options and callbacks here
            events : [
                @foreach($tasks as $task)
                {
                    title : '{{ $task->name }}',
                    start : '{{ $task->task_date }}',
                    url : '{{ route('tasks.edit', $task->id) }}'
                },
                @endforeach
            ]
        })
    });
</script>
@stop
