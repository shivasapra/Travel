<div class="col-md-3">
        <!-- DIRECT CHAT PRIMARY -->
  <div class="box box-danger direct-chat direct-chat-danger">
  <div class="box-header with-border">
    <h3 class="box-title">Direct Chat</h3>

    <div class="box-tools pull-right">

      <button type="button" class="btn btn-box-tool" data-toggle="tooltip"  data-widget="chat-pane-toggle">
          <span data-toggle="tooltip" title="{{$unread_messages->pluck('user_id')->unique()->count()}} " class="badge bg-red">{{$unread_messages->pluck('user_id')->unique()->count()}} New Messages</span></button>
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
    <div class="direct-chat-messages" style="height:350px;" id="testing">
      <!-- Message. Default to the left -->
      @if($messages != null)
      @foreach($messages as $message)
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
    <div class="direct-chat-contacts" style="height:350px;">
      <ul class="contacts-list">
        @if($unread_messages->count()>0)
        <?php $notified = collect();?>
        @foreach($unread_messages as $unread)
        @if(!$notified->contains($unread->user_id))
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
              <span class="contacts-list-msg"><i class="fa fa-circle text-info"></i> {{$unread->message}}</span>
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
  <div class="box-footer">
      @if($messages != null)
      <form action="{{route('chat.store')}}" method="post" id="form">
        @csrf
        <div class="input-group">
          <input name='to_id' value="{{$id}}" id="to_id" hidden>
          <input type="text" name="message" id="message" onkeyup="test(this)" placeholder="Type Message ..." class="form-control" required>
              <span class="input-group-btn">
                <button type="button" onclick="sendMessage(this);" id="button" class="btn btn-danger btn-flat" disabled>Send</button>
              </span>
        </div>
      </form>
      @else
      <strong><span class="text-info">{{$unread_messages->pluck('user_id')->unique()->count()}}{{' Unread Conversations'}}</span></strong>
      @endif
    </div>
    <!-- /.box-footer-->
  </div>
  <!--/.direct-chat -->
</div>