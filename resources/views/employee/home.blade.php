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