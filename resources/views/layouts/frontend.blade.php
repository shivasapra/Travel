<?php
  use Carbon\Carbon;
  $dt = Carbon::now();
  $date_today = $dt->timezone('Europe/London');
  $date = $date_today->toDateString();
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href= "{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{asset('bower_components/morris.js/morris.css')}}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{asset('bower_components/jvectormap/jquery-jvectormap.css')}}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
  <link href="{{ asset('/css/toastr.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/style.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  @yield('css')
  @yield('head')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="{{route('home')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      {{-- <img src="{{asset('/uploads/logo.jpg')}}" class="img-circle" alt="User Image"> --}}
      <span class="logo-mini"><b>C</b>T</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Cloud</b>Travel</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          {{-- <li class="dropdown dropdown-notifications">
                <a href="#notifications-panel" class="dropdown-toggle" data-toggle="dropdown">
                  <i data-count="0" class="glyphicon glyphicon-bell notification-icon"></i>
                </a>

                <div class="dropdown-container">
                  <div class="dropdown-toolbar">
                    <div class="dropdown-toolbar-actions">
                      <a href="#">Mark all as read</a>
                    </div>
                    <h3 class="dropdown-toolbar-title">Notifications (<span class="notif-count">0</span>)</h3>
                  </div>
                  <ul class="dropdown-menu">
                  </ul>
                  <div class="dropdown-footer text-center">
                    <a href="#">View All</a>
                  </div>
                </div>
              </li> --}}
          <!-- Notifications: style can be found in dropdown.less -->
          @if(App\Chat::where('to_id',Auth::user()->id)->where('status',0)->get()->count() > 0)
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              
              <span class="label label-success">{{App\Chat::where('to_id',Auth::user()->id)->where('status',0)->get()->pluck('user_id')->unique()->values()->count()}}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have {{App\Chat::where('to_id',Auth::user()->id)->where('status',0)->get()->pluck('user_id')->unique()->values()->count()}} Unread Messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <?php $notified = collect();?>
                  @foreach(App\Chat::where('to_id',Auth::user()->id)->where('status',0)->orderBy('id','desc')->get() as $m)
                  @if(!$notified->contains($m->user_id))
                    <li><!-- start message -->
                      <a href="{{route('index.message',['id'=>$m->user_id])}}">
                        <div class="pull-left">
                          <img 
                          @if(App\User::find($m->user_id)->avatar)
                            src="{{asset(App\User::find($m->user_id)->avatar)}}" 
                          @else
                            src="{{asset('images/user-placeholder.jpg')}}"
                          @endif
                          class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          {{App\User::find($m->user_id)->name}}
                          <small><i class="fa fa-clock-o"></i> {{$m->time}}</small>
                        </h4>
                        <p><i class="fa fa-circle text-info"></i> {{$m->message}}</p>
                      </a>
                    </li>
                    <?php
                      $notified->push($m->user_id);
                    ?>
                  @endif
                  @endforeach
                  <!-- end message -->
              <li class="footer"><a href="{{route('direct.chat')}}">See All Messages</a></li>
            </ul>
          </li>
            </ul>
          </li>
          @endif
          
          <!-- Tasks: style can be found in dropdown.less -->
          {{-- <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger"></span>
            </a>
            <ul class="dropdown-menu">
            </ul>
          </li> --}}
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img
                    @if(Auth::user()->avatar)
                      src="{{asset(Auth::user()->avatar)}}"
                    @else
                      src="{{asset('images/user-placeholder.jpg')}}"
                    @endif
               class="user-image" alt="User Image">
              <span class="hidden-xs">{{auth::user()->name}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img
                    @if(Auth::user()->avatar)
                      src="{{asset(Auth::user()->avatar)}}"
                    @else
                      src="{{asset('app/images/user-placeholder.jpg')}}"
                    @endif
                 class="img-circle" alt="User Image"><br>
                  <div class="text-center">
                    <strong>{{auth::user()->name}}</strong>
                  </div>
                  <div class="text-center">
                    {{auth::user()->email}}

                  <div class="text-center">
                    @if(!Auth::user()->admin and !Auth::user()->client)
                   {{Auth::user()->employee[0]->unique_id}}
                   @endif
                   </div>
              </li>
              <!-- Menu Body -->
              {{-- <li class="user-body">
                <div class="row">
                  <div class="text-center">
                    {{auth::user()->name}}
                  </div>
                </div>
                <div class="row">
                  <div class="text-center">
                    {{auth::user()->email}}
                  </div>
                </div>
              </li> --}}
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{route('edit.profile')}}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a class="btn btn-default btn-flat" href="{{ route('home') }}"
                     onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                      <i class="ft-power"> {{ __('Logout') }}</i>
                  </a>

                  <form id="logout-form" @if(request()->session()->get('backUrl')) action="{{ route('ImpersonateOut') }}" @else action="{{ route('logout') }}" @endif method="post" style="display: none;">
                      @csrf
                  </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->

        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img @if(Auth::user()->avatar)
                      src="{{asset(Auth::user()->avatar)}}"
                    @else
                      src="{{asset('app/images/user-placeholder.jpg')}}"
                    @endif class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      {{-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> --}}
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="{{route('home')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        @can('View Users')
          <li><a href="{{route('users')}}"><i class="fa fa-user"></i><span>Users</span></a></li>
        @endcan

        @can('Role Management')
          <li><a href="{{route('role.management')}}"><i class="fa fa-dot-circle-o"></i><span>Role Management</span></a></li>
        @endcan
        @can('View Departments')
          <li><a href="{{route('departments')}}"><i class="fa fa-briefcase"></i><span>Departments</span></a></li>
        @endcan
        @can('View Leads')
          <li><a href="{{route('leads')}}"><i class="fa fa-users"></i><span>Leads</span></a></li>
        @endcan
        @if(Auth::user()->can('View Clients') or Auth::user()->can('Client Visa Application Status') or Auth::user()->can('Client Documents Movement') or Auth::user()->can('Update Client Settings') or Auth::user()->can('Generate Request'))
        <li class="treeview">
            <a href="">
              <i class="fa fa-user-circle"></i><span>Client Management</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              @can('View Clients')
                <li><a href="{{route('clients')}}"><i class="fa fa-circle-o"></i><span>Clients</span></a></li>
              @endcan
              @can('Client Visa Application Status')
                <li><a href="{{route('clientStatus')}}"><i class="fa fa-circle-o"></i>Client Visa Application Status</a></li>
              @endcan
              @can('Client Documents Movement')
                <li><a href="{{route('clientDocIndex')}}"><i class="fa fa-circle-o"></i>Client Documents Movement</a></li>
              @endcan
              @can('Update Client Settings')
                <li><a href="{{route('client.settings')}}"><i class="fa fa-circle-o"></i>Client Settings</a></li>
              @endcan
              @can('Generate Request')
                <li><a href="{{route('requests')}}"><i class="fa fa-circle-o"></i>Client Requests</a></li>
              @endcan
            </ul>
          </li>
        @endif
        @if(Auth::user()->admin)
        <li class="treeview">
            <a href="">
              <i class="fa fa-pencil-square-o"></i><span>Employee Management</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              @can('View Employees')
              @if(Auth::user()->admin)
                <li><a href="{{route('employees')}}"><i class="fa fa-circle-o"></i><span>Employees</span></a></li>
              
              @endcan
              @can('Employee Attendance Status')
                <li><a href="{{route('status')}}"><i class="fa fa-circle-o"></i> <span>Employee Attendance Status</span></a></li>
              @endcan
              @can('Employee Salary Slip')
                <li><a href="{{route('slip.generate')}}"><i class="fa fa-circle-o"></i>Generate Employee Salary Slip</a></li>
              @endcan
              @can('Staff Wage management')
                <li><a href="{{route('wage')}}"><i class="fa fa-circle-o"></i><span>Staff Wage Management</span></a></li>
              @endcan
              @endif
            </ul>
          </li>
        @endif
        @if(Auth::user()->can('Expense Entry') or Auth::user()->can('Auto Deduction Expense Entry'))
        <li class="treeview">
            <a href="">
              <i class="fa fa-money"></i><span>Daily Expense Entry</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              @can('Expense Entry')
                <li><a href="{{route('expenses.get')}}"><i class="fa fa-circle-o"></i>Expenses</a></li>
              @endcan
              @can('Auto Deduction Expense Entry')
                <li><a href="{{route('auto.get')}}"><i class="fa fa-circle-o"></i>Auto Deduction</a></li>
              @endcan
            </ul>
          </li>
        @endif
        @if(Auth::user()->can('View Invoices') or Auth::user()->can('View Canceled Invoice') or Auth::user()->can('VAT Updation') or Auth::user()->can('View Refunded Invoices') or Auth::user()->can('View Invoice Issues'))
          <li class="treeview">
            <a href="">
              <i class="fa fa-wrench"></i><span>Invoices</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              @can('View Invoices')
                <li><a href="{{route('invoice')}}"><i class="fa fa-circle-o"></i>Invoices</a></li>
              @endcan
              @can('View Canceled Invoice')
                <li><a href="{{route('canceled.invoices')}}"><i class="fa fa-circle-o"></i>Canceled Invoices</a></li>
              @endif
              @can('View Refunded Invoice')
                <li><a href="{{route('refunded.invoices')}}"><i class="fa fa-circle-o"></i>Refunded Invoices</a></li>
              @endif
              @can('View Invoice Issues')
                <li><a href="{{route('invoice.issues')}}"><i class="fa fa-circle-o"></i>Issues</a></li>
              @endcan
              @can('VAT Updation')
                <li><a href="{{route('tax')}}"><i class="fa fa-circle-o"></i>VAT</a></li>
              @endcan
            </ul>
          </li>
        @endif
        @if(!Auth::user()->client)
          <li><a href="{{route('leaves')}}"><i class="fa fa-plus-square"></i>Leave Applications</a></li>
        @endif
          @can('View/Export Reports')
          <li class="treeview">
            <a href="">
              <i class="fa fa-bar-chart-o"></i><span>Reports</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            
            <ul class="treeview-menu">
                <li><a href="{{route('visa.report')}}"><i class="fa fa-circle-o"></i>Visa Report</a></li>
                <li><a href="{{route('paidInvoice.report')}}"><i class="fa fa-circle-o"></i>Paid Invoices Report</a></li>
                <li><a href="{{route('unpaidInvoice.report')}}"><i class="fa fa-circle-o"></i>UnPaid Invoices Report</a></li>
                <li><a href="javascript:{}" onclick="document.getElementById('my_form').submit();"><i class="fa fa-circle-o"></i>Invoices Report</a>
                </li>
                <li><a href="{{route('expenses.report')}}"><i class="fa fa-circle-o"></i>Expenses Report</a></li>
                <li><a href="{{route('docmov.report')}}"><i class="fa fa-circle-o"></i>Document Movement Report</a></li>
              </ul>
          </li><form action="{{route('service.report')}}" method="post" id="my_form">
              @csrf
              <input type="text" name="service_name" value="Flight" hidden>
            </form>
          <form action="{{route('service.report')}}" method="post" id="my_form">
              @csrf
              <input type="text" name="service_name" value="Flight" hidden>
            </form>
          @endcan

        @if(!Auth::user()->client)
            <li><a href="{{route('assign')}}"><i class="fa fa-clock-o"></i><span>Assignments</span></a></li>
        @endif
        @can('Generate Letter')
          <li><a href="{{route('letter')}}"><i class="fa fa-envelope-open-o"></i><span>Generate Letter</span></a></li>
        @endcan
        @can('Direct Chat')
          <li><a href="{{route('direct.chat')}}"><i class="fa fa-commenting-o"></i><span>Direct Chat</span></a></li>
        @endcan
        @can('Services Registration')
          <li><a href="{{route('products')}}"><i class="fa fa-plus-square"></i><span>Services Registration</span></a></li>
        @endcan
        @can('Airlines Name Registration')
          <li><a href="{{route('airlines')}}"><i class="fa fa-plane"></i><span>Airlines Name Registration</span></a></li>
        @endcan

      @if(!Auth::user()->admin and !Auth::user()->client)
      @can('Edit Employee')
        <li><a href="{{route('view.employee',['id'=>Auth::user()->employee[0]->id])}}"><i class="fa fa-user-plus" aria-hidden="true"></i><span>Edit Details</span></a></li>
      @endcan
        <li><a href="{{route('attendance',['id'=>Auth::user()->employee[0]->id])}}"><i class="fa fa-id-card-o" aria-hidden="true"></i><span>Attendance</span></a></li>
      
      <li><a href="{{route('wage.log',['id'=>Auth::user()->employee[0]->id])}}"><i class="fa fa-money" aria-hidden="true"></i><span>Wage Log</span></a></li>
        <li>
          <a href="{{route('session')}}">
            <i class="fa fa-clock-o"></i> <span>Mark Attendance
            @if(Auth::user()->employee[0]->wage->count()>0)
              @if(Auth::user()->employee[0]->wage->last()->date == $date)
                @if(Auth::user()->employee[0]->wage->last()->logout == null and Auth::user()->employee[0]->wage->last()->login != null)
                <span class="text-success"><strong>(Logged In)</strong></span>
                @elseif(Auth::user()->employee[0]->wage->last()->logout != null and Auth::user()->employee[0]->wage->last()->login != null)
                <span class="text-warning"><strong>(Logged Out)</strong></span>
                @endif
              @endif
            @endif
            </span>
          </a>
        </li>
      @endif
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @yield('header')
    {{-- <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section> --}}

    <!-- Main content -->
    <section class="content">
     @yield('content')
    </section>
        <!-- right col -->
  </div>
      <!-- /.row (main row) -->
  <!-- /.content-wrapper -->
  <footer class="main-footer noprint">
    Designed and Developed by <a href="https://www.himsoftsolution.com" class="noprint">Him Soft Solution Chandigarh
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset("bower_components/jquery/dist/jquery.min.js")}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset("bower_components/jquery-ui/jquery-ui.min.js")}}"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset("bower_components/bootstrap/dist/js/bootstrap.min.js")}}"></script>
<script src="//js.pusher.com/3.1/pusher.min.js"></script>
<!-- Morris.js charts -->
<script src="{{asset("bower_components/raphael/raphael.min.js")}}"></script>
<script src="{{asset("bower_components/morris.js/morris.min.js")}}"></script>
<!-- Sparkline -->
<script src="{{asset("bower_components/jquery-sparkline/dist/jquery.sparkline.min.js")}}"></script>
<!-- jvectormap -->
<script src="{{asset("plugins/jvectormap/jquery-jvectormap-1.2.2.min.js")}}"></script>
<script src="{{asset("plugins/jvectormap/jquery-jvectormap-world-mill-en.js")}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset("bower_components/jquery-knob/dist/jquery.knob.min.js")}}"></script>
<!-- daterangepicker -->
<script src="{{asset("bower_components/moment/min/moment.min.js")}}"></script>
<script src="{{asset("bower_components/bootstrap-daterangepicker/daterangepicker.js")}}"></script>
<!-- datepicker -->
<script src="{{asset("bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js")}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset("plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js")}}"></script>
<!-- Slimscroll -->
<script src="{{asset("bower_components/jquery-slimscroll/jquery.slimscroll.min.js")}}"></script>
<!-- FastClick -->
<script src="{{asset("bower_components/fastclick/lib/fastclick.js")}}"></script>
<!-- AdminLTE App -->
<script src="{{asset("dist/js/adminlte.min.js")}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset("dist/js/pages/dashboard.js")}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset("dist/js/demo.js")}}"></script>
    <script src="{{ asset('/js/toastr.min.js') }}"></script>
    <script>
        @if(Session::has('success'))
            toastr.success("{{Session::get('success')}}")
        @endif
        @if(Session::has('info'))
            toastr.info("{{Session::get('info')}}")
        @endif
        @if(Session::has('warning'))
            toastr.warning("{{Session::get('warning')}}")
        @endif
        @if(Session::has('danger'))
            toastr.danger("{{Session::get('danger')}}")
        @endif
    </script>
{{-- <script type="text/javascript">
    var notificationsWrapper   = $('.dropdown-notifications');
    var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
    var notificationsCountElem = notificationsToggle.find('i[data-count]');
    var notificationsCount     = parseInt(notificationsCountElem.data('count'));
    var notifications          = notificationsWrapper.find('ul.dropdown-menu');

    if (notificationsCount <= 0) {
      notificationsWrapper.hide();
    }

    // Enable pusher logging - don't include this in production
    // Pusher.logToConsole = true;

    var pusher = new Pusher('91308c30e1077b7ca988', {
      encrypted: true
    });

    // Subscribe to the channel we specified in our Laravel Event
    var channel = pusher.subscribe('new-client-request');

    // Bind a function to a Event (the full Laravel class)
    channel.bind('App\\Events\\StatusLiked', function(data) {
      var existingNotifications = notifications.html();
      var avatar = Math.floor(Math.random() * (71 - 20 + 1)) + 20;
      var newNotificationHtml = `
        <li class="notification active">
            <div class="media">
              <div class="media-left">
                <div class="media-object">
                  <img src="https://api.adorable.io/avatars/71/`+avatar+`.png" class="img-circle" alt="50x50" style="width: 50px; height: 50px;">
                </div>
              </div>
              <div class="media-body">
                <strong class="notification-title">`+data.message+`</strong>
                <!--p class="notification-desc">Extra description can go here</p-->
                <div class="notification-meta">
                  <small class="timestamp">about a minute ago</small>
                </div>
              </div>
            </div>
        </li>
      `;
      notifications.html(newNotificationHtml + existingNotifications);

      notificationsCount += 1;
      notificationsCountElem.attr('data-count', notificationsCount);
      notificationsWrapper.find('.notif-count').text(notificationsCount);
      notificationsWrapper.show();
    });
  </script> --}}
<script>
  setInterval(function(){
  $("#rel").load(" #rel > *");
},1000);
</script>
@yield('js')
</body>
</html>
