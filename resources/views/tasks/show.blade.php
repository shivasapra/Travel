@extends('layouts.frontend')
@section('title')
Task Show
@endsection
@section('header')
    <section class="content-header">
          <h1>
            Task Show
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Tasks Show</li>
          </ol>
    </section>
@stop
@section('content')
  <div class="box box-info">
    <div class="box-body">
      <div class="text-center">
        @foreach($tasks as $task)
        <h3><strong>{{$task->task_date}}</strong></h3>
        @break
        @endforeach
      </div><hr>
      <table id="example" class="table table-striped display" style="width:100%">
        <thead>
          <tr>
            <th>Sno.</th>
            <th>Name</th>
            <th>Description</th>
            <th>Task Date</th>
            <th>Action</th>
          </tr>
          </thead>
        <tbody>
          @if($tasks->count()>0)
          <?php $i = 1; ?>
            @foreach($tasks as $task)
            <tr>
              <td>{{$i++}}</td>
              <td>{{$task->name}}</td>
              <td>{{$task->description}}</td>
              <td>{{$task->task_date}}</td>
              <td>
                <a href="{{ route('task.destroy',['id'=>$task->id])}}" class="btn btn-danger btn-xs">Delete</a>
              </td>
              </tr>
            @endforeach
          @endif
        </tbody>
      </table>
    </div>
  </div>
@stop
@section('js')
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
@stop