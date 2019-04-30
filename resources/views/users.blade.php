@extends('layouts.frontend')
@section('title')
Users
@endsection
@section('header')
	<section class="content-header">
      <h1>
        Users
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Users</li>
      </ol>
    </section>
@stop
@section('content')
	
	@if(count($errors)>0)
		<ul class="list-group">
			@foreach($errors->all() as $error)
				<li class="list_group-item text-danger">
					{{ $error }}
				</li>
			@endforeach
		</ul>
	@endif

<div class="box box-primary">
    <div class="box-body">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                <th>Sno.</th>
                <th>Avatar</th>
                <th>Name</th>
                <th>Email</th>
                <th>Identity</th>
                </tr>
                </thead>
            <tbody>
                @if($users->count()>0)
                <?php $i = 1; ?>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>
                            <img alt="" height="50px" class="img-circle "
                            @if($user->avatar)
                                src="{{asset(Auth::user()->avatar)}}"
                            @else
                                src="{{asset('app/images/user-placeholder.jpg')}}"
                            @endif 
                            class="img-circle" alt="User Image"><br>
                            <div class="text-center">
                        </td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if($user->admin)
                                <strong><span>{{'Admin'}}</span></strong>
                            @else
                                <strong><span>{{'Employee'}}</span></strong>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@stop