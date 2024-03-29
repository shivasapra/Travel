@extends('layouts.frontend')
@section('title')
Clients
@endsection
@section('header')
	<section class="content-header">
      <h1>
        Clients
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-user-circle"></i> clients</li>
      </ol>
    </section>
@stop
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
@stop
@section('content')

		<div class="box box-info">
			<div class="box-body">


			<table class="table table-hover mb-0" id="example" >
                    <thead>
                      <tr>
                        <th>Sno.</th>
                        <th>Unique Id.</th>
                        <th>Name</th>
                        <th>Country</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Action</th>
                        <th>Account Activation</th>
                        <th>Passport Verification</th>
                      </tr>
                    	</thead>
                    <tbody>
                    	@if($clients->count()>0)
                    	<?php $i = 1; ?>
	                    	@foreach($clients as $client)
	                    	<tr>
                          <td>{{$i++}}</td>
                          <td>{{$client->unique_id}}</td>
	                    		<td>{{$client->first_name}}</td>
	                    		<td>{{$client->country}}</td>
	                    		<td>{{$client->phone}}</td>
                          <td>{{$client->email}}</td>
                          <td class="text-center">
                              <div class="btn-group">
                                <button type="button" class="btn bg-teal">Action</button>
                                <button type="button" class="btn bg-teal dropdown-toggle" data-toggle="dropdown">
                                  <span class="caret"></span>
                                  <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                  @can('View Clients')
                                  <li><a href="{{route('view.client',['id'=>$client->id])}}" style="color:white" class="btn bg-aqua btn-xs"> View</a></li>
                                  @endcan
                                  @can('Edit Client')
                                  <li><a href="{{route('edit.client',['id'=>$client->id])}}" style="color:white;margin-top:2px;" class="btn bg-purple btn-xs"> Edit</a></li>
                                  @endcan
                                  @can('Client Notification Reminder Toggle')
                                  <li>
                                    @if($client->reminder == 1)
                                      <a href="{{ url('/stop/reminder', ['id'=>$client->id]) }}" style="color:white;margin-top:2px;" class="btn bg-orange btn-xs"> Stop Payment Reminders</a>
                                    @else
                                      <a href="{{ url('/start/reminder', ['id'=>$client->id]) }}" style="color:white;margin-top:2px;" class="btn bg-success btn-xs"> Resume Payment Reminders</a>
                                    @endif
                                  </li>
                                  @endcan
                                </ul>
                              </div>
                            </td>
	                    		
                          
                          <td>
                            @if($client->user)
                            @can('Activate/Deactivate Client')
															@if($client->user->active)
															  <a onClick="return confirm('Are You Sure You Want To Deactivate This Client')" href="{{route('deactivateClient',['id'=>$client->id])}}" class="btn btn-danger btn-xs">Deactivate</a>
															@else
															  <a onClick="return confirm('Are You Sure You Want To Activate This Client')" href="{{route('activateClient',['id'=>$client->id])}}" class="btn btn-success btn-xs">Activate</a>
                              @endif
                              <br><a href="{{route('resend.credentials',['id'=>$client->id])}}" class="btn btn-info btn-xs">Resend Credentials</a>
                            @endcan
                            @else
                              <span class="text-warning"><strong>Not Yet Verified</strong></span><br>
                              <a href="{{route('resend.client.account.confirmation',['id'=>$client->id])}}" class="btn btn-info btn-xs">Resend Verification</a>
														@endif
                          </td>
                          <td>
                            @if($client->confirmation)
                              <span class="text-success"><strong>{{'Verified'}}</strong></span>
                            @else
                              <span class="text-danger"><strong>{{'Not Verified'}}</strong></span><br>
                              <a href="{{route('resend.client.passport.confirmation',['id'=>$client->id])}}" class="btn btn-info btn-xs">Resend Verification</a>
                            @endif
                          </td>
	                    		</tr>
	                    	@endforeach
                    	@endif
                    </tbody>
            </table>
		</div>
		</div>
		<div class="text-center">
      <a href="{{route('create.client')}}">
        @can('Create Client')
        <button class="btn btn-success">Add Client</button>
        @endcan
			</a>
		</div>

@endsection
@section('js')
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
@stop
