@extends('layouts.frontend')
@section('title')
Assignments
@endsection
@section('header')
	<section class="content-header">
      <h1>
        Assignments
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-pencil-square-o"></i>Assignments</li>
      </ol>
    </section>
@stop
@section('content')
	<div class="box box-info">
		<div class="box-body">
			<table class="table table-hover mb-0">
                <thead>
                	<tr>
                		<th>Sno.</th>
                		<th>Task</th>
                		<th>Description</th>
                		<th>Status</th>
                        @if(!Auth::user()->admin)
                		<th>Action</th>
                        @endif
                	</tr>
                </thead>
                <tbody>
                	@if($assignments->count()>0)
                    	<?php $i = 1; ?>
                    	@foreach($assignments as $assignment)
                    	<tr>
                    		<td>{{$i++}}</td>
                    		<td>{{$assignment->task}}</td>
                    		<td>{{$assignment->task_description}}</td>
                    		<td>
                    			@if($assignment->status == 0)
                    				<span class="text-danger">{{'Pending'}}</span>
                    			@else
									<span class="text-success">{{'Done'}}</span>
								@endif
                    		</td>
                    		@if($assignment->status == 0 and !Auth::user()->admin)
                    			<td><a href="{{route('assignmentDone',['id'=>$assignment->id])}}" class="btn btn-xs btn-info"><i class="fa fa-check"></i></a></td>
                    		@endif
                    	</tr>
                    	@endforeach
                    @endif
                </tbody>
            </table>
		</div>
	</div>
@stop