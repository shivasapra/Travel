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
<div class="col-md-6">
    <!-- DIRECT CHAT PRIMARY --> 
  <div class="box box-danger direct-chat direct-chat-danger ">
    <div class="box-header with-border">
      <h3 class="box-title">
          @if($name != null)
          {{$name}}
          @else
          Direct Chat
          @endif
      </h3>

      <div class="box-tools pull-right">
        
        <button type="button" class="btn btn-box-tool" data-toggle="tooltip"  data-widget="chat-pane-toggle">
            <span data-toggle="tooltip" title="{{$unread_messages->count()}} " class="badge bg-red">{{$unread_messages->count()}} New Messages </span></button>
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        {{-- <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle"> --}}
          {{-- <i class="fa fa-comments"></i></button> --}}
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body" >
      <!-- Conversations are loaded here -->
      <div class="direct-chat-messages" style="height:450px;" id="testing">
        <!-- Message. Default to the left -->
        @if($messages != null)
        @foreach($messages as $message)
          @if($message->user_id == Auth::user()->id)
            <div class="direct-chat-msg ">
              <div class="direct-chat-danger clearfix">
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
              alt="Message User Image"  >
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
              <div class="direct-chat-danger clearfix">
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
      <div class="direct-chat-contacts" style="height:450px;">
        <ul class="contacts-list">
          @if($unread_messages->count()>0)
          @foreach($unread_messages as $unread)
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
                      <small class="contacts-list-date pull-right">{{$unread->date}}{{' '}}{{$unread->time}}</small>
                    </span>
                <span class="contacts-list-msg">
                  @if($unread->status == 0 )
                  <i class="fa fa-circle text-info"></i>
                  @endif
                   {{$unread->message}}
                </span>
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
        @if($messages != null)
        <form action="{{route('chat.store')}}" method="post">
          @csrf
          <div class="input-group">
            <input name='to_id' value="{{$id}}" hidden>
            <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-danger btn-flat">Send</button>
                </span>
          </div>
        </form>
        @else
        <strong><span class="text-danger">{{$unread_messages->count()}}{{' Unread Conversations'}}</span></strong>
        @endif
      </div>
      <!-- /.box-footer-->
    </div>
    <!--/.direct-chat -->
        <!--/.direct-chat -->   
</div>


<div class="col-md-6">
    <!-- DIRECT CHAT PRIMARY -->
  <div class="box box-info direct-chat direct-chat-info">
    <div class="box-header with-border">
      <h3 class="box-title">{{App\ChatLog::all()->count()}} Previous Conversations!!</h3>

      <div class="box-tools pull-right">
        
        {{-- <button type="button" class="btn btn-box-tool" data-toggle="tooltip"  data-widget="chat-pane-toggle">
            <span data-toggle="tooltip" title="{{$unread_messages->count()}} New Messages" class="badge bg-red">{{$unread_messages->count()}}</span></button> --}}
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
        <ul class="contacts-list">
            @foreach(App\ChatLog::all() as $ChatLog)
            <?php
              $user_id = (Auth::user()->id == $ChatLog->user_id)? $ChatLog->user_id : $ChatLog->to_id;
              $to_id = (Auth::user()->id == $ChatLog->user_id)? $ChatLog->to_id : $ChatLog->user_id;
              $message = App\Chat::whereIn('user_id',[$user_id,$to_id])->whereIn('to_id',[$user_id,$to_id])->orderBy('id','desc')->get()->first();
            ?>
            <li>
              <a href="{{route('index.message',['id'=>$to_id])}}">
                <img class="contacts-list-img"
                @if(App\User::find($to_id)->avatar)
                    src="{{asset(App\User::find($to_id)->avatar)}}"
                  @else
                    src="{{asset('app/images/user-placeholder.jpg')}}"
                @endif 
                alt="User Image">
  
                <div class="contacts-list-info">
                      <span class="contacts-list-name">
                        <strong><span style="color:black;">{{App\User::find($to_id)->name}}</span></strong>
                        <small class="contacts-list-date pull-right" style="color:black;">{{$message->date}}{{' '}}{{$message->time}}</small>
                      </span>
                  <span class="contacts-list-msg" >
                    @if($message->user_id == $to_id and $message->status == 0 )
                      <i class="fa fa-circle text-info"></i>
                    @endif
                    &nbsp;{{$message->message}}
                  </span>
                </div>
                <!-- /.contacts-list-info -->
              </a>
            </li>
            @endforeach
            <!-- End Contact Item -->
          </ul>
        <!-- /.direct-chat-msg -->
      </div>
      <!--/.direct-chat-messages-->
      
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        
        <strong><span class="text-info">{{App\ChatLog::all()->count()}} Previous Conversations!!</span></strong>
      </div>
      <!-- /.box-footer-->
    </div>
    <!--/.direct-chat -->
        <!--/.direct-chat -->   
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
@endsection