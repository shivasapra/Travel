<?php use App\wage;?>
@extends('layouts.frontend')
@section('title')
Employee wage log
@endsection
@section('header')
    <section class="content-header">
      <h1>
        <strong>{{$employee->first_name}}'s</strong> Wage log
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('wage')}}"><i class="fa fa-wrench"></i> Staff Wage Management</a></li>
        <li class="active">Employee Wage Log</li>
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
				
			<table id="example" class="table table-bordered mb-0">
                <thead>
                    <tr>
                    	<th><b> Sno.</b></th>
                    	<th><b> Unique Id</b></th>
                      <th><b> Date</b></th>
                      <th><b> No Of Logins</b></th>
                      <th><b> Total Hours</b></th>
                    	<th><b> Hourly Wage</b></th>
                    	<th><b> Total wage</b></th>
                    </tr>
                </thead>
                <tbody>
                    @if($employee->wage->count()>0)
            		<?php $i=1;?>
                    @foreach($employee->wage as $wage)
                		<tr>
                		<td><b> {{$i++}}</b></td>
                		<td>{{$employee->unique_id}}</td>
                        <td>{{$wage->date}}</td>
                        <td class="test">
                            <input type="text" hidden value="{{$wage->id}}" class="wage_id">
                            <button   type="button" onClick="Fun(this);" class="btn  btn-xs btn-info">{{$wage->no_of_logins}}</button>
                        </td>
                        <td>{{$wage->total_hours}}</td>
                        <td>{{$employee->currency.' '.$wage->hourly}}</td>
                        <td>{{$employee->currency.' '.$wage->today_wage}}</td>
                		</tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
    </div>
    <button type="button" class="btn btn-xs btn-info" id="target" style="display:none;" data-toggle="modal" data-target="#logins">{</button>
  <div id="login-modal"></div>
   
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

  function Fun(temp){
		var wage_id = $(temp).parents('.test').find('.wage_id').val();
		@foreach(App\wage::all() as $wage)
      var fetched_wage_id = {!! json_encode($wage->id) !!}
          if(fetched_wage_id == wage_id){
    var data =  
    '<div class="modal fade" id="logins">'+
        '<div class="modal-dialog modal-dialog-centered modal-lg">'+
            '<div class="modal-content">'+

                '<!-- Modal Header -->'+
                '<div class="modal-header">'+
                    '<h4 class="modal-title">Logins</h4>'+
                    '<button type="button" class="close" data-dismiss="modal">&times;</button>'+
                '</div>'+
                
                '<!-- Modal body -->'+
                '<div class="modal-body">'+
                    '<table class="table table-bordered">'+
                      '<thead>'+
                        '<tr>'+
                          '<th><b> Sno.</b></th>'+
                          '<th><b> Login Time</b></th>'+
                          '<th><b> Logout Time</b></th>'+
                          '<th><b> Hours</b></th>'+
                        '</tr>'+
                      '</thead>'+
                      '<tbody>'+
                        '<?php $j = 1;?>'+
                        
                                '@foreach($wage->wageLog as $log)'+
                                  '<tr>'+
                                    '<td><b>{{$j++}}</b></td>'+
                                    '<td>{{$log->login_time}}</td>'+
                                    '<td>{{$log->logout_time}}</td>'+
                                    '<td>{{$log->hours}}</td>'+
                                  '</tr>'+
                                '@endforeach'+
                              
                      '</tbody>'+
                    '</table>'+
                '</div>'+
            '</div>'+
        '</div>'+
    '</div>';
  }
  @endforeach
        
	  $('#login-modal').html(data);
      
	  $('#target').click();
	}
  </script>
@endsection