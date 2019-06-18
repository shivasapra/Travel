@extends('layouts.frontend')
@section('title')
Requests
@endsection
@section('header')
	<section class="content-header">
      <h1>
        Requests
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Requests</li>
      </ol>
    </section>
@stop
@section('content')
<div class="box box-info">
    <div class="box-body">
        <table id="example" class="table table-striped">
                <thead >
                    <tr>
                    <th>SNo.</th>
                    <th>Request Type</th>
                    <th>Description</th>
                    <th>Status</th>
                    @if(Auth::user()->admin)
                    <th>Action</th>
                    @endif
                    </tr>
                    </thead>
                <tbody>
                    <?php $i =1;?>
                    @if(Auth::user()->client)
                        <?php $requests = Auth::user()->client->requests ?>
                    @elseif(Auth::user()->admin)
                        <?php $requests = App\ClientRequests::all() ?>
                    @endif
                @foreach($requests as $request)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $request->request_type }}</td>
                    <td>{{ $request->description }}</td>
                    @if(Auth::user()->client)
                        <td>
                            @if($request->status == 0)
                                <span class="text-danger">{{ 'Pending' }}</span>
                            @elseif($request->status == 1)
                                <span class="text-warning">{{ 'Processing' }}</span>
                            @elseif($request->status == 2)
                                <span class="text-success">{{ 'Done' }}</span>
                            @endif
                        </td>
                    @else
                    <form action="{{ route('request.status.save',['id'=>$request->id]) }}" method="post">
                        @csrf
                        <td>
                            <select name="status" class="form-control">
                                <option value="">--SELECT--</option>
                                <option value="0" {{($request->status == 0)?"selected":" "}}>Pending</option>
                                <option value="1" {{($request->status == 1)?"selected":" "}}>Processing</option>
                                <option value="2" {{($request->status == 2)?"selected":" "}}>Done</option>
                            </select>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-xs btn-success">Save</button>
                        </td>
                    </form>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@if(Auth::user()->client)
    <form action="{{ route('requests.generate') }}" method="post">
        @csrf
        <div class="box box-success">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <label for="request_type">Request Type:</label>
                        <select name="request_type" class="form-control">
                            <option value="">--SELECT--</option>
                            @foreach($products as $product)
                                <option value="{{$product->service}}">{{$product->service}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <button class="btn btn-small btn-info" type="submit">Generate Request</button>
        </div>
    </form>
@endif
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
@endsection
