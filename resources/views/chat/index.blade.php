@extends('layouts.frontend')
@section('title')
Direct Chat
@endsection
@section('header')
	<section class="content-header">
      <h1>
        Direct Chat
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-user-circle"></i> Direct Chat</li>
      </ol>
    </section>
@stop
@section('content')
<div class="row">
    <div class="col-md-6">
    <div class="box box-info direct-chat direct-chat-info">
        <div class="box-header with-border">
            <h3 class="box-title">Direct Chat</h3>

            <div class="box-tools pull-right">
            
            <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Unread Messages" data-widget="chat-pane-toggle">
                <span data-toggle="tooltip" title="{{$unread_messages->count()}} New Messages" class="badge bg-red">{{$unread_messages->count()}}</span></button>
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            {{-- <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle"> --}}
                {{-- <i class="fa fa-comments"></i></button> --}}
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <!-- Conversations are loaded here -->
            <div class="direct-chat-messages">
            <!-- Message. Default to the left -->
            @if($latest->count()>0)
            @foreach($latest as $message)
                @if($message->user_id == Auth::user()->id)
                <div class="direct-chat-msg ">
                    <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-left">{{'You'}}</span>
                    <span class="direct-chat-timestamp pull-right">{{$message->date}}{{' '}}{{$message->time}}</span>
                    </div>
                    <!-- /.direct-chat-info -->
                    <img class="direct-chat-img"
                    @if(Auth::user()->avatar)
                        src="{{asset(Auth::user()->avatar)}}"
                    @else
                        src="{{asset('app/images/user-placeholder.jpg')}}"
                    @endif 
                    alt="Message User Image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                    {{$message->message}}
                    </div>
                    <!-- /.direct-chat-text -->
                </div>
                <!-- /.direct-chat-msg -->
                @elseif($message->to_id == Auth::user()->id)
                <!-- Message to the right -->
                <div class="direct-chat-msg right">
                    <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-right">{{App\User::find($message->user_id)->name}}</span>
                    <span class="direct-chat-timestamp pull-left">{{$message->date}}{{' '}}{{$message->time}}</span>
                    </div>
                    <!-- /.direct-chat-info -->
                    <img class="direct-chat-img" 
                    @if(App\User::find($message->user_id)->avatar)
                        src="{{asset(App\User::find($message->user_id)->avatar)}}"
                    @else
                        src="{{asset('app/images/user-placeholder.jpg')}}"
                    @endif 
                    alt="Message User Image"><!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                        {{$message->message}}
                    </div>
                    <!-- /.direct-chat-text -->
                </div>
                @endif
            @endforeach
            @endif
            <!-- /.direct-chat-msg -->
            </div>
            <!--/.direct-chat-messages-->
            <!-- Contacts are loaded here -->
            <div class="direct-chat-contacts">
            <ul class="contacts-list">
                @if($unread_messages->count()>0)
                @foreach($unread_messages as $unread)
                <li>
                <a href="{{route('home.message',['id'=>$unread->user_id])}}">
                    <img class="contacts-list-img"
                    @if(App\User::find($unread->user_id)->avatar)
                        src="{{asset(App\User::find($unread->user_id)->avatar)}}"
                    @else
                        src="{{asset('app/images/user-placeholder.jpg')}}"
                    @endif 
                    alt="User Image">

                    <div class="contacts-list-info">
                        <span class="contacts-list-name">
                            {{App\User::find($unread->user_id)->name}}
                            <small class="contacts-list-date pull-right">{{$unread->date}}{{' '}}{{$unread->time}}</small>
                        </span>
                    <span class="contacts-list-msg">{{$unread->message}}</span>
                    </div>
                    <!-- /.contacts-list-info -->
                </a>
                </li>
                @endforeach
                @endif
                <!-- End Contact Item -->
            </ul>
            <!-- /.contatcts-list -->
            </div>
            <!-- /.direct-chat-pane -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <form action="" method="post">
                @csrf
                <div class="input-group">
                <input name='user_id' value="" hidden>
                <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-info btn-flat">Send</button>
                    </span>
                </div>
            </form>
        </div>
            <!-- /.box-footer-->
    </div>
        <!--/.direct-chat -->   
    </div>
</div>
@stop