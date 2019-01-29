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
        <div class="col-md-4 col-sm-6 col-xs-12">
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
        <div class="col-md-4 col-sm-6 col-xs-12">
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
        <div class="col-md-4 col-sm-6 col-xs-12">
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
                @if($login->employee->user->avatar)
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
                @if($logout->employee->user->avatar)
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
                  @if($employee->user->avatar)
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
                  @if($employee->user->avatar)
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
              <h3 class="box-title">Recently Added Expenses</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
                @if($expenses->count()>0)
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
              <h1 class="text-center"><span style="color:#0066FF;">Invoices</span></h1><hr>
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
                      <td>
                        <?php $amount = 0;?>
                        @foreach($invoice->invoiceInfo as $info)
                        <?php 
                          $amount = $amount + $info->amount;  
                        ?>
              @endforeach
                        {{$info->currency.$amount}}
                      </td>
                      @if($info->status == 1)
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
          </div>
      </div>
    </div>
    


    <div class="row">
        <div class="col-md-7">
        <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">To Do List</h3>

              <div class="box-tools pull-right">
                <ul class="pagination pagination-sm inline">
                  <li><a href="#">&laquo;</a></li>
                  <li><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">&raquo;</a></li>
                </ul>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
              <ul class="todo-list">
                <li>
                  <!-- drag handle -->
                  <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <!-- checkbox -->
                  <input type="checkbox" value="">
                  <!-- todo text -->
                  <span class="text">Design a nice theme</span>
                  <!-- Emphasis label -->
                  <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
                  <!-- General tools such as edit or delete-->
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
                <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="">
                  <span class="text">Make the theme responsive</span>
                  <small class="label label-info"><i class="fa fa-clock-o"></i> 4 hours</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
                <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="">
                  <span class="text">Let theme shine like a star</span>
                  <small class="label label-warning"><i class="fa fa-clock-o"></i> 1 day</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
                <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="">
                  <span class="text">Let theme shine like a star</span>
                  <small class="label label-success"><i class="fa fa-clock-o"></i> 3 days</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
                <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="">
                  <span class="text">Check your messages and notifications</span>
                  <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 week</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
                <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="">
                  <span class="text">Let theme shine like a star</span>
                  <small class="label label-default"><i class="fa fa-clock-o"></i> 1 month</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix no-border">
              <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button>
            </div>
        </div> 
        
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
        </div>

        <div class="col-md-5">
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
          <div class="box box-solid bg-green-gradient">
            <div class="box-header">
              <i class="fa fa-calendar"></i>

              <h3 class="box-title">Calendar</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <!-- button with a dropdown -->
                <div class="btn-group">
                  <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bars"></i></button>
                  <ul class="dropdown-menu pull-right" role="menu">
                    <li><a href="#">Add new event</a></li>
                    <li><a href="#">Clear events</a></li>
                    <li class="divider"></li>
                    <li><a href="#">View calendar</a></li>
                  </ul>
                </div>
                <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
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
            <div class="box-footer text-black">
              <div class="row">
                <div class="col-sm-6">
                  <!-- Progress bars -->
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
                <!-- /.col -->
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
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
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
@endsection

