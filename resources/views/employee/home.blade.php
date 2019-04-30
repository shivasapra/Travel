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
  <div class="row">
    <div class="col-md-4">
      <!-- DIRECT CHAT PRIMARY -->
      <div class="box box-primary direct-chat direct-chat-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Direct Chat </h3>

          <div class="box-tools pull-right">
            {{-- <span data-toggle="tooltip" title="3 New Messages" class="badge bg-light-blue">{{$unread}}</span> --}}
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            {{-- <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">
              <i class="fa fa-comments"></i></button> --}}
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <!-- Conversations are loaded here -->
          <div class="direct-chat-messages">
            <!-- Message. Default to the left -->
            @foreach($messages as $message)
              @if($message->user_id == Auth::user()->id)
                <div class="direct-chat-msg">
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
            <!-- /.direct-chat-msg -->
          </div>
          <!--/.direct-chat-messages-->
          <!-- Contacts are loaded here -->
          {{-- <div class="direct-chat-contacts">
            <ul class="contacts-list">
              <li>
                <a href="#">
                  <img class="contacts-list-img" src="../dist/img/user1-128x128.jpg" alt="User Image">

                  <div class="contacts-list-info">
                        <span class="contacts-list-name">
                          Count Dracula
                          <small class="contacts-list-date pull-right">2/28/2015</small>
                        </span>
                    <span class="contacts-list-msg">How have you been? I was...</span>
                  </div>
                  <!-- /.contacts-list-info -->
                </a>
              </li>
              <!-- End Contact Item -->
            </ul>
            <!-- /.contatcts-list -->
          </div> --}}
          <!-- /.direct-chat-pane -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <form action="{{route('chat.store')}}" method="post">
            @csrf
            <div class="input-group">
              <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                  <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary btn-flat">Send</button>
                  </span>
            </div>
          </form>
        </div>
        <!-- /.box-footer-->
      </div>
      <!--/.direct-chat -->
    </div>
  </div>





    <button type="button" data-toggle="modal" id="clickme" data-target="#autoload" hidden class="btn btn-sm btn-info"></button>
    <div class="modal fade" id="autoload">
        <div class="modal-dialog">
           <div class="modal-content">
        <div class="modal-header" style="color:white;font-weight:500;background-color:#0066FF;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Assignments</h4>
        </div>
        
        <div class="modal-body">
            <table class="table table-hover mb-0">
                <thead>
                  <tr>
                    <th>Sno.</th>
                    <th>Date</th>
                    <th>Task</th>
                    <th>Task Description</th>
                    <th>Action:</th>
                  </tr>
                  </thead>
                <tbody>
                  @if($assignments->count()>0)
                  <?php $i = 1; ?>
                    @foreach($assignments as $assignment)
                    <tr>
                      <td>{{$i++}}</td>
                      <td>{{$assignment->date}}</td>
                      <td>{{$assignment->task}}</td>
                      <td>{{$assignment->task_description}}</td>
                      <td>
                        @if($assignment->employee_id == null)
                      <a href="{{route('task.accept',['id'=>$assignment->id])}}" class="btn btn-xs btn-info">Accept</a>
                        @else
                        {{'Accepted'}}
                        @endif
                    </td>
                    </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>
        </div>
      
        <!-- /.col -->

        <div class="modal-footer" style="color:white;font-weight:500;background-color:#0066FF;">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
        </div>
          </div>
      </div>
    </div>
    @stop
    @section('js')
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
<script>
    $(document).ready(function() {
      window.onload=function(){
      document.getElementById("clickme").click();
    };
    });
</script>
@stop