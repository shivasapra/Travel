@extends('layouts.frontend')
@section('title')
Employee's Letter
@endsection
@section('header')
	<section class="content-header">
      <h1>
        Employee's Letter
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('employees')}}"><i class="fa fa-pencil-square-o"></i>Employess</a></li>
        <li class="active"><i class="fa fa-pencil-square-o"></i> employee's letter</li>
      </ol>
    </section>
@stop
@section('content')

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
			</div>
			<hr>
			<div class="row">
				<div class="col-md-6">
					<strong>DATE: {{$date}}</strong>
				</div>
				<div class="col-md-6">
					<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Unique Id: {{$employee->unique_id}}</strong>
				</div>
			</div><br><br><br>
			<textarea name="content" id="summernote" cols="30" rows="10">
			<strong>To.</strong><br><br><br><br>
			<strong>Dear Sir,</strong><br><br>
			<strong>Re: &nbsp;{{$employee->first_name. ' '. $employee->last_name}}</strong><br>
			<strong>Date Of Birth:&nbsp;&nbsp;{{$employee->DOB}}</strong><br><br><br>
			<p style="text-align: justify;font-size: 15px">
				We confirm that the above named employee work since {{$employee->created_at->toDateString()}} and 
				@if($employee->gender == 'Male')
				his
				@else 
				her
				@endif 
				 gross annual income {{$employee->currency. ' ' .$wage}} of Full time work.
			</p>
			<p style="text-align: justify;font-size: 15px">
				@if($employee->gender == 'Male')
				He
				@else 
				She
				@endif  
				is duty promoted as a Sales Assistant since {{$employee->created_at->toDateString()}}.
			</p>
			<p style="text-align: justify;font-size: 15px">
				We further confirm that 
				@if($employee->gender == 'Male')
				Mr.
				@else 
				Mrs. 
				@endif 
				{{$employee->first_name."'s"}} employment is of a permanent nature as 
				@if($employee->gender == 'Male')
				He
				@else 
				She
				@endif 
				is required to continue 
				@if($employee->gender == 'Male')
				his
				@else 
				her
				@endif 
				duties as the Company’s Sales Assistant.
			</p>
			<p style="text-align: justify;font-size: 15px">
				Should you require any further information, please do not hesitate to contact the writer.
			</p>
			<br><br><br>
			<strong>Thank You</strong><br><br><br>
			<strong>Your's Faithfully</strong><br><br><br>
			</textarea>
		</div>
	</div>

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