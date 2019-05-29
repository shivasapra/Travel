@extends('layouts.frontend')
@section('title')
Session
@endsection
@section('content')
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <a href="../../index2.html"><b>Cloud</b>Travel</a>
  </div>
  <!-- User name -->
  <div class="text-center">
  <div class="lockscreen-name"><h4><strong>{{Auth::user()->name}}</strong></h4><h5><strong>{{Auth::user()->email}}</strong></h5>{{Auth::user()->employee[0]->unique_id}}</div>
  </div>
  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img @if(Auth::user()->avatar)
              src="{{asset(Auth::user()->avatar)}}"
            @else
              src="{{asset('app/images/user-placeholder.jpg')}}"
            @endif 
           alt="User Image">
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <form class="lockscreen-credentials" method="post" 
      @if($latest_wageLog != null and $latest_wageLog->logout_time == null)
        action="{{route('Logout')}}"
      @else
        action="{{route('Login')}}"
      @endif
    > 
      @csrf
      <div class="input-group">
      @if($latest_wageLog != null and $latest_wageLog->logout_time == null)
        <input type="text" hidden name="wageLogId" value="{{$latest_wageLog->id}}">
      @endif
        <input type="text" hidden name="email" value="{{Auth::user()->email}}">
        <input type="password" name="password" class="form-control" placeholder="password">

        <div class="input-group-btn">
          <button type="submit" class="btn">@if($latest_wageLog != null and $latest_wageLog->logout_time == null)End @else Start @endif<i class="fa fa-arrow-right text-muted"></i></button>
        </div>
      </div>
    </form>
    <!-- /.lockscreen credentials -->

  </div>
  <!-- /.lockscreen-item -->
  <div class="help-block text-center">
    Enter your password
    @if($latest_wageLog != null and $latest_wageLog->logout_time == null) 
    to <strong>End</strong> your Session.
    @else 
    to <strong>Start</strong> your Session.
    @endif
  </div>
  <div class="text-center">
      @if($latest_wageLog != null and $latest_wageLog->logout_time == null) 
      <div class="lockscreen-name"><h4><strong>Total Hours This Session:</strong></h4><h3><span class="text-red"><strong>{{$total_hours_this_session}}</strong></span></h3></div>
      @endif
  </div>
  <div class="lockscreen-footer text-center">
    
  </div>
</div>
@stop