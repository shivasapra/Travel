@extends('layouts.frontend')
@section('title')
{{$slug}}s
@endsection
@section('header')
	<section class="content-header">
      <h1>
        {{$slug}}s
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('departments')}}"><i class="fa fa-cube"></i> Departments</a></li>
        <li class="active"><i class="fa fa-pencil-square-o"></i> {{$slug}}s</li>
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
                    <th>Name</th>
                    <th>Unique Id</th>
                    <th>country</th>
                    <th>Department</th>
                    <th>Hiring Date</th>
                    <th>Rate Contract</th>
                    <th>Action</th>
                    </tr>
                    </thead>
                <tbody>
                    @if($users->count()>0)
                    <?php $i = 1; ?>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$user->employee[0]->first_name}}</td>
                            <td>{{$user->employee[0]->unique_id}}</td>
                            <td>{{$user->employee[0]->country}}</td>
                            <td>{{$user->employee[0]->hired_for_dep}}</td>
                            <td>{{$user->employee[0]->hiring_date}}</td>
                            <td>{{$user->employee[0]->currency.$user->employee[0]->rate}}</td>
                            <td>
                                <a href="{{route('view.employee',['id'=>$user->employee[0]->id])}}" class="btn btn-success btn-xs"><span class="fa fa-eye"></span></a>
                                <a href="{{route('edit.employee',['id'=>$user->employee[0]->id])}}" class="btn btn-info btn-xs"><span class="fa fa-edit"></span></a>
                                {{-- <a href="{{route('delete.employee',['id'=>$user->employee[0]->id])}}" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a> --}}
                                <a href="{{route('letter.employee',['id'=>$user->employee[0]->id])}}" class="btn btn-primary btn-xs">Letter</a>
                                <a href="{{route('assignments',['id'=>$user->employee[0]->id])}}" class="btn btn-warning btn-xs">Tasks</a>
                                @if($user->employee[0]->user)
                                    @if($user->employee[0]->user->active)
                                    <a href="{{route('deactivateEmployee',['id'=>$user->employee[0]->id])}}" class="btn btn-danger btn-xs">Deactivate</a>
                                    @else
                                    <a href="{{route('activateEmployee',['id'=>$user->employee[0]->id])}}" class="btn btn-success btn-xs">Activate</a>
                                    @endif
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
    
        </div>
    </div>
    {{-- <div class="text-center">
        <a href="{{route('create.employee')}}">
            <button class="btn btn-success">Add employee</button>
        </a>
    </div> --}}
	
@endsection