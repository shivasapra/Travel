<?php use App\User; use App\Chat; use App\ChatLog;?>
@extends('layouts.frontend')
@section('title')
Direct Chat
@endsection
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
@stop
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
<div class="col-md-6" >
    <!-- DIRECT CHAT PRIMARY --> 
  <div class="box box-danger direct-chat direct-chat-danger " >
    <div class="box-header with-border">
      <h3 class="box-title">
          @if($name != null)
          {{$name}}
          @else
          Direct Chat
          @endif
      </h3>

      <div class="box-tools pull-right " id="count">
        
        <button type="button" class="btn btn-box-tool" data-toggle="tooltip"  data-widget="chat-pane-toggle" >
            <span data-toggle="tooltip" title="{{$unread_messages->pluck('user_id')->unique()->count()}} " class="badge bg-red">{{$unread_messages->pluck('user_id')->unique()->count()}} New Messages </span></button>
        </button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body" >
      <!-- Conversations are loaded here -->
      <div class="direct-chat-messages" style="height:450px;" id="testing" >
        <!-- Message. Default to the left -->
        @if($messages)
        <?php $messages = Chat::whereIn('user_id',[$id,Auth::user()->id])->WhereIn('to_id',[$id,Auth::user()->id])->orderBy('id','asc')->get(); ?>
        @endif
        @if($messages != null)
        @foreach($messages as $message)
          @if($message->user_id == Auth::user()->id)
            <div class="direct-chat-msg ">
              <div class="direct-chat-danger clearfix">
                <span class="direct-chat-name pull-left">{{'You'}}</span>
              <span class="direct-chat-timestamp " style="margin-left:390px">{{$message->date}}{{' '}}{{$message->time}}</span>
              </div>
              <!-- /.direct-chat-info -->
              <img class="direct-chat-img"
                @if(Auth::user()->avatar)
                  src="{{asset(Auth::user()->avatar)}}"
                @else
                  src="{{asset('app/images/user-placeholder.jpg')}}"
              @endif 
              alt="Message User Image"  >
              <!-- /.direct-chat-img -->
              <div class="direct-chat-text" style="width:500px;">
                {{$message->message}}
              </div>
              <!-- /.direct-chat-text -->
            </div>
            <!-- /.direct-chat-msg -->
          @elseif($message->to_id == Auth::user()->id)
            <!-- Message to the right -->
            <div class="direct-chat-msg right">
              <div class="direct-chat-danger clearfix">
                <span class="direct-chat-name pull-right">{{App\User::find($message->user_id)->name}}</span>
                <span class="direct-chat-timestamp pull-left" style="margin-left:60px">{{$message->date}}{{' '}}{{$message->time}}</span>
              </div>
              <!-- /.direct-chat-info -->
              <img class="direct-chat-img" 
              @if(App\User::find($message->user_id)->avatar)
                  src="{{asset(App\User::find($message->user_id)->avatar)}}"
                @else
                  src="{{asset('app/images/user-placeholder.jpg')}}"
              @endif 
              alt="Message User Image"><!-- /.direct-chat-img -->
              <div class="direct-chat-text" style="margin-left:60px">
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
      <div class="direct-chat-contacts" style="height:450px;" id="unread">
        <ul class="contacts-list">
            <?php $unread_messages = Chat::where('to_id',Auth::user()->id)->where('status',0)->orderBy('id','desc')->get(); ?>
          @if($unread_messages->count()>0)
          <?php $notified = collect();?>
          @foreach($unread_messages as $unread)
          @if(!$notified->contains($unread->user_id))
          <li>
            <a href="{{route('index.message',['id'=>$unread->user_id])}}">
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
                      <small class="contacts-list-date pull-right" >{{$unread->date}}{{' '}}{{$unread->time}}</small>
                    </span>
                <span class="contacts-list-msg">
                  @if($unread->status == 0 )
                  <i class="fa fa-circle text-info" "></i>
                  @endif
                   {{$unread->message}}
                </span>
              </div>
              <!-- /.contacts-list-info -->
            </a>
          </li>
            <?php
              $notified->push($unread->user_id);
            ?>
          @endif
          @endforeach
          @endif
          <!-- End Contact Item -->
        </ul>
        <!-- /.contatcts-list -->
      </div>
      <!-- /.direct-chat-pane -->
    </div>
    <!-- /.box-body -->
    <div class="box-footer" @if($messages == null) id="ct" @endif>
        @if($messages != null)
        <form onsubmit="sendMessage(this);" action="javascript:void(0)" method="post" id="form">
          @csrf
          <div class="input-group">
            <input name='to_id' value="{{$id}}" id="to_id" hidden>
            <input type="text" name="message" id="message" onkeyup="test(this)" placeholder="Type Message ..." class="form-control" required>
                <span class="input-group-btn">
                  <button type="submit"  id="button" class="btn btn-danger btn-flat" disabled>Send</button>
                </span>
          </div>
        </form>
        @else
          <strong><span class="text-danger" >{{$unread_messages->pluck('user_id')->unique()->count()}}{{' Unread Conversations'}}</span></strong>
        @endif
    </div>
      <!-- /.box-footer-->
  </div>
    <!--/.direct-chat -->
        <!--/.direct-chat -->   
</div>


<div class="col-md-6">
    <!-- DIRECT CHAT PRIMARY -->
  <div class="box box-info direct-chat direct-chat-info" id="previous">
    <div class="box-header with-border">
      <h3 class="box-title">Previous Conversations!!</h3>
    </div>
    <div class="box-body" >
      <div class="direct-chat-messages">
        <!-- Message. Default to the left -->
        <ul class="contacts-list">
            <?php 
              $messages = collect();
            ?>
            @foreach(App\ChatLog::all() as $ChatLog)
            <?php
              $user_id = (Auth::user()->id == $ChatLog->user_id)? $ChatLog->user_id : $ChatLog->to_id;
              $to_id = (Auth::user()->id == $ChatLog->user_id)? $ChatLog->to_id : $ChatLog->user_id;
              if($user_id == Auth::user()->id or $to_id == Auth::user()->id){
                $messages->push(App\Chat::whereIn('user_id',[$user_id,$to_id])->whereIn('to_id',[$user_id,$to_id])->orderBy('id','desc')->get()->first());
              }
            ?>
            @endforeach
            @if($messages->count()>0)
            @foreach($messages->sortBy('created_at')->reverse() as $m)
            <li>
              <a href="{{route('index.message',['id'=>(Auth::user()->id == $m->user_id)? $m->to_id : $m->user_id])}}">
                <img class="contacts-list-img"
                @if(App\User::find((Auth::user()->id == $m->user_id)? $m->to_id : $m->user_id)->avatar)
                    src="{{asset(App\User::find((Auth::user()->id == $m->user_id)? $m->to_id : $m->user_id)->avatar)}}"
                  @else
                    src="{{asset('app/images/user-placeholder.jpg')}}"
                @endif 
                alt="User Image">
  
                <div class="contacts-list-info">
                      <span class="contacts-list-name">
                        <strong><span style="color:black;">{{App\User::find((Auth::user()->id == $m->user_id)? $m->to_id : $m->user_id)->name}}</span></strong>
                        <small class="contacts-list-date pull-right" style="color:black;">{{$m->date}}{{' '}}{{$m->time}}</small>
                      </span>
                  <span class="contacts-list-msg" >
                    @if($m->user_id == ((Auth::user()->id == $m->user_id)? $m->to_id : $m->user_id) and $m->status == 0 )
                      <i class="fa fa-circle text-info"></i>
                    @elseif($m->user_id == Auth::user()->id and $m->status == 1)
                      <i class="fa fa-check text-info"></i>
                    @elseif($m->user_id == Auth::user()->id)
                      <i class="fa fa-reply" aria-hidden="true"></i>
                    @endif
                    &nbsp;{{$m->message}}
                  </span>
                </div>
                <!-- /.contacts-list-info -->
              </a>
            </li>
            @endforeach
            @endif
            <!-- End Contact Item -->
          </ul>
        <!-- /.direct-chat-msg -->
      </div>
    </div>
    <div class="box-footer">
      <strong><span class="text-info">{{$messages->count()}} Previous Conversations!!</span></strong>
    </div>
  </div>
  
  
  <br>
        <div class="box box-default">
          <div class="box-body">
              <table id="example" class="table table-striped display" style="width:100%">
                <thead>
                  <tr>
                    <th>Sno.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @if($users->count()>0)
                  <?php $i = 1; ?>
                    @foreach($users as $user)
                      @if($user->id != Auth::user()->id)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                              @can('Direct Chat')
                                <a href="{{route('index.message',['id'=>$user->id])}}" class="btn btn-primary btn-xs">Start Conversation</a>
                              @endcan
                            </td>
                        </tr>
                      @endif
                    @endforeach
                  @endif
                </tbody>
              </table>
          </div>
        </div>
</div>

<div class="col-md-5">
    
</div>
</div>

<br><br>

@stop
@section('js')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>


  <script>
  	$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
        ]
    } );
} );
</script>
<script>

window.onload=function(){
  var messageBody = document.querySelector('#testing');
  messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
}
// function updateScroll(){
//     }
</script>

<script>
function sendMessage(test){
  
    $('#button').attr('disabled','disabled');
    var to_id = $(test).find('#to_id').val();
		var message = $(test).find('#message').val();
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
              $("#previous").load(" #previous > *");
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


setInterval(function(){
  $("#previous").load(" #previous > *");
  $("#testing").load(" #testing > *");
  $("#unread").load(" #unread > *");
  $("#count").load(" #count > *");
  $("#ct").load(" #ct > *");
},1000);


    
</script>


@endsection