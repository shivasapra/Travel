@extends('layouts.frontend')
@section('title')
Letter
@endsection
@section('header')
	<section class="content-header">
      <h1>
        Letter
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-pencil-square-o"></i>letter</li>
      </ol>
    </section>
@stop
@section('content')
<form action="{{route('sendLetter')}}" method="post">
  @csrf
  <div class="box box-info" style="width: 900px;margin-left: 100px">
    <div class="box-body" style="margin-left: 20px">
      <div class="text-center">
        <img src="{{asset('/logo.jpg')}}" style="width: 250px; height: 70px" alt="User Image">
        <h5><strong>62 King Street,SOUTHALL</strong></h5>
        <h5><strong>Middlesex UB2 4DB, UNITED KINGDOM</strong></h5>
      </div>
      <div class="row">
        <div class="col-md-6">
          <h5><strong>E-mail: INFO@cloudtravels.co.uk</strong></h5>
          <h5><strong>IATA AGENT NO: </strong></h5> 
          <h5><strong>TEL: 02035000000</strong></h5>
        </div>
        <div class="pull-right">
        <div class="col-md-6">
          <h5><strong>WEB: WWW.CLOUDTRAVELS.CO.UK</strong></h5>
          <h5><strong>ICO: ZA277694</strong></h5>
          <h5><strong>MOB: 07944495552</strong></h5>
        </div>
        </div>
      </div><hr>
      
      <div class="row">
      <div class="col-md-4">
      <label for="email_to">Email To:</label>
      <input type="email" name="email_to" class="form-control"><br>
      </div>
      </div>
      <textarea name="content" id="summernote" cols="30" rows="10"></textarea>
    </div>
  </div>
  <div class="text-center">
    <button type="submit" class="btn btn-success btn-xs">Send</button>
  </div>
</form>      
@stop
@section('css')
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
@stop
@section('js')
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
<script>
  $(document).ready(function() {
  $('#summernote').summernote();
});
</script>
@stop