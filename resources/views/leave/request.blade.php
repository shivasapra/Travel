@extends('layouts.frontend')
@section('title')
Add Leave Application
@endsection
@section('header')
	<section class="content-header">
      <h1>
        Add Leave Application
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-pencil-square-o"></i> Add Leave Application</li>
      </ol>
    </section>
@stop
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
@stop
@section('content')
		<div class="box box-info">
            <div class="box-header ">
                <ul class="nav nav-tabs tabs-design bt-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('leaves')}}">Leave List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('request.leave.index')}}">Add Leave Application</a>
                    </li>
                </ul>
            </div>
			<div class="box-body">
                <div class="row">
                <form action="{{route('assign.leave')}}" method="post">
                    @csrf
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="leave_type"><b> Leave Type: </b></label>
                                <input type="text" class="form-control" required name="leave_type">
                            </div>
                        </div>
                        <div class="row">
                            <br>
                            <div class="col-md-6">
                                <label for="from"><b> From: </b></label>
                                <input type="date" class="form-control" required name="from">
                            </div>
                            <div class="col-md-6">
                                <label for="to"><b> To: </b></label>
                                <input type="date" class="form-control" required name="to">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <br>
                                <label for="pdf"><b>Message:</b></label>
                                <textarea name="pdf" id="summernote" class="form-control" style="height:120px;"></textarea>
                            </div>
                        </div><br>
                        <button type="submit" class="btn btn-success btn-md">Save</button>
                    </div>
                </form>
                </div>
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
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
<script>
  $(document).ready(function() {
  $('#summernote').summernote();
});
</script>

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
