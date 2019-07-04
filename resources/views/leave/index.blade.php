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
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('assign.leave.index')}}">Assign Leave</a>
                    </li>
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
                            <th>View</th>
                            <th>Status</th>
                            <th>Action</th>
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
                                <td></td>
                                <td>
                                    @if($leave->status == 0)
                                        <label class="badge badge-danger">Rejected</label>
                                    @elseif($leave->status == 1)
                                        <label class="badge badge-success">Approved</label>
                                    @elseif($leave->status == 2)
                                        <label class="badge badge-warning">In progress</label>
                                    @endif
                                </td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#leave_status" class="btn btn-icons btn-rounded btn-success">
                                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
			</div>
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