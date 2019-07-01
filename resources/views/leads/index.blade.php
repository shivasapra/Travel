@extends('layouts.frontend')
@section('title')
Leads
@endsection
@section('header')
	<section class="content-header">
      <h1>
        Leads
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Leads</li>
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
                    <th>Name</th>
                    <th>Country</th>
                    <th>Postal Code</th>
                    <th>Contact</th>
                    <th>DOB</th>
                    <th>Email</th>
                    <th>Action</th>
                    <th>##</th>
                </tr>
            </thead>
            <tbody>
                @if($leads->count()>0)
                    <?php $i = 1; ?>
                    @foreach($leads as $lead)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$lead->first_name}}</td>
                            <td>{{$lead->country}}</td>
                            <td>{{$lead->postal_code}}</td>
                            <td>{{$lead->phone}}</td>
                            <td>{{$lead->DOB}}</td>
                            <td>{{$lead->email}}</td>
                            <td>
                                @can('View Leads')
                                <a href="{{route('lead.show',['id'=>$lead->id])}}" class="btn btn-success btn-xs"><span class="fa fa-eye"></span></a>
                                @endcan
                                @if(!$lead->converted)
                                @can('Edit Lead')
                                    <a href="{{route('lead.edit',['id'=>$lead->id])}}" class="btn btn-info btn-xs"><span class="fa fa-edit"></span></a>
                                @endcan
                                @endif
                            </td>
                            <td>
                                @if($lead->converted)
                                    <span class="text-success"><strong>{{'Converted'}}</strong></span>
                                @else
                                @can('Convert Lead')
                                    <a href="{{route('lead.convert.form',['id'=>$lead->id])}}" class="btn btn-primary btn-xs">Convert To Client</a>
                                @endcan
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
    @can('Create Lead')
    <a href="{{route('lead.create')}}">
        <button class="btn btn-success">Add Lead</button>
    </a>
    @endcan
</div>
@stop
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