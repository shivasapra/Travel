@extends('layouts.frontend')
@section('title')
Leave Applications
@endsection
@section('header')
	<section class="content-header">
      <h1>
        Leave Applications
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-pencil-square-o"></i> Leave Applications</li>
      </ol>
    </section>
@stop
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
@stop
@section('content')
		<div class="box box-info">
            <div class="box-header ">
                <ul class="nav nav-tabs tabs-design bt-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('leaves')}}">Leave List</a>
                    </li>
                    {{-- @if(Auth::user()->admin)
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('assign.leave.index')}}">Assign Leave</a>
                        </li>
                    @endif --}}
                    @if(Auth::user()->employee->count() > 0)
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('request.leave.index')}}">Add Leave Application</a>
                        </li>
                    @endif
                </ul>
            </div>
			<div class="box-body">
                <table class="table table-bordered mb-0" id="example" >
                    <thead>
                        <tr>
                            <th>Sno.</th>
                            <th>Date Applied</th>
                            <th>Employee Name</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Leave Type</th>
                            <th>No. Of Days</th>
                            <th>Application</th>
                            <th>Status</th>
                            @if(Auth::user()->admin)
                                <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @if($leaves->count()>0)
                        <?php $i = 1; ?>
                        @foreach($leaves as $leave)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$leave->created_at->toDateString()}}</td>
                                <td>{{$leave->employee->first_name.' '.$leave->employee->last_name}}</td>
                                <td>{{$leave->from}}</td>
                                <td>{{$leave->to}}</td>
                                <td>{{$leave->leave_type}}</td>
                                <td>{{$leave->no_of_days}}</td>
                                <td><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#leave_view">View</a></td>
                                <td>
                                    @if($leave->status == 0)
                                        <label class="badge bg-danger">Rejected</label>
                                    @elseif($leave->status == 1)
                                        <label class="badge bg-success">Approved</label>
                                    @elseif($leave->status == 2)
                                        <label class="badge bg-warning">In progress</label>
                                    @endif
                                    @if($leave->status != 2)
                                        {{$leave->comment}}
                                    @endif
                                </td>
                                @if(Auth::user()->admin)
                                    <td class="test">
                                            <input type="text" hidden value="{{$leave->id}}" class="leave_id">
                                            <button   type="button" onClick="Fun(this);" class="btn btn-icons btn-rounded btn-success">
                                            <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                        </button>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
			</div>
        </div>
        
        
        
        <div class="modal fade" id="leave_view">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
    
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Leave Application</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                        <embed src="{{$leave->pdf}}" width="100%" height="500px" />
                        </div>
                    </div>
                </div>
            </div>
            
            <a href="#" id="target" data-toggle="modal" data-target="#leave_status" class="btn btn-icons btn-rounded btn-success" style="display:none;"></a>
        
        <div id="status-modal"></div>
        
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
		var leave_id = $(temp).parents('.test').find('.leave_id').val();
		
		var data = '<div class="modal fade" id="modal-info">'+
			'<div class="modal-dialog">'+
				 '<div class="modal-content">'+
		'<div class="modal-header" style="color:white;font-weight:500;background-color:#0066FF;">'+
		  '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
			'<span aria-hidden="true">&times;</span></button>'+
		  '<h4 class="modal-title">Leave Application Status</h4>'+
		'</div>'+
		'<form action="{{route("leave.application.status")}}" method="post">'+
		  '@csrf'+
          '<input type="text" value="'+leave_id+'" hidden>'+
		'<div class="modal-body">'+
            '<label for="status">Status</label>'
            '<select name="status" id="" class="form-control">'+
            '<option value="">--SELECT--</option>'+
            '<option value="1">Approved</option>'+
            '<option value="0">Rejected</option>'+
            '</select>'+
            '<textarea name="comment" id="" class="form-control"></textarea>'+
		'</div>'+
		'<div class="modal-footer" style="color:white;font-weight:500;background-color:#0066FF;">'+
		  '<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>'+
		  '<button type="submit" class="btn btn-outline">Refund</button>'+
		'</div>'+
		'</form>'+
			  '</div>'+
			'</div>'+
	  '</div>';
	  $('#status-modal').html(data);
	  $('#target').click();
	}
</script>
@stop