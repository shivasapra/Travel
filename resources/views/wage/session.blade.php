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
    <form class="lockscreen-credentials" method="post" action="{{route('testLogin')}}">
      @csrf
      <div class="input-group">
        <input type="text" hidden name="email" value="{{Auth::user()->email}}">
        <input type="password" name="password" class="form-control" placeholder="password">

        <div class="input-group-btn">
          <button type="submit" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
        </div>
      </div>
    </form>
    <!-- /.lockscreen credentials -->

  </div>
  <!-- /.lockscreen-item -->
  <div class="help-block text-center">
    Enter your password
  </div>
  <div class="text-center">
    
  </div>
  <div class="lockscreen-footer text-center">
    
  </div>
</div>
@stop