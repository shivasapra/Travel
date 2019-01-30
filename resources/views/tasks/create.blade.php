@extends('layouts.frontend')
@section('title')
Task Create
@endsection
@section('header')
    <section class="content-header">
          <h1>
            Task Create
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Task Create</li>
          </ol>
    </section>
@stop
@section('content')
<form action="{{ route('tasks.store') }}" method="post">
  {{ csrf_field() }}
  Task name:
  <br />
  <input type="text" name="name" />
  <br /><br />
  Task description:
  <br />
  <textarea name="description"></textarea>
  <br /><br />
  Task date:
  <br />
  <input type="text" name="task_date" class="date" />
  <br /><br />
  <input type="submit" value="Save" />
</form>
@stop
@section('js')
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
<script>
    $('.date').datepicker({
        autoclose: true,
        dateFormat: "yy-mm-dd"
    });
</script>
@stop