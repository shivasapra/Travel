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
                        <th>Reminders</th>
                        <th>Account Activation</th>
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
	                    		<td>
	                    			<a href="{{route('view.client',['id'=>$client->id])}}" class="btn btn-success btn-xs"><span class="fa fa-eye"></span></a>
	                    			<a href="{{route('edit.client',['id'=>$client->id])}}" class="btn btn-info btn-xs"><span class="fa fa-edit"></span></a>
                                    {{-- <a href="{{route('delete.client',['id'=>$client->id])}}" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a> --}}
                          </td>
                          <td>
                            @if($client->reminder == 1)
                            <a href="{{ url('/stop/reminder', ['id'=>$client->id]) }}" class="btn btn-primary btn-xs">Stop Reminders</a>
                            @else
                            <a href="{{ url('/start/reminder', ['id'=>$client->id]) }}" class="btn btn-primary btn-xs">Resume Reminders</a>
                            @endif
                          </td>
                          <td>
                            @if($client->user)
															@if($client->user->active)
															  <a onClick="return confirm('Are You Sure You Want To Deactivate This Client')" href="{{route('deactivateClient',['id'=>$client->id])}}" class="btn btn-danger btn-xs">Deactivate</a>
															@else
															  <a onClick="return confirm('Are You Sure You Want To Activate This Client')" href="{{route('activateClient',['id'=>$client->id])}}" class="btn btn-success btn-xs">Activate</a>
															@endif
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
				<button class="btn btn-success">Add Client</button>
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
