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
      <div class="col-md-8">
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
      <div class="col-md-4">
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

