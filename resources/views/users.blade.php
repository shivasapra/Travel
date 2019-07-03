@extends('layouts.frontend')
@section('title')
Users
@endsection
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
@stop
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
        <table class="table table-bordered" id="example">
            <thead>
                <tr>
                <th>Sno.</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Unique Id </th>
                <th>Email</th>
                <th>Department</th>
                <th>Role</th>
                <th>Action</th>
                <th>
                    @if(Auth::user()->admin and request()->session()->get('impersonated') == null)
                    Login
                    @endif
                </th>
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
                                src="{{asset($user->avatar)}}"
                            @else
                                src="{{asset('app/images/user-placeholder.jpg')}}"
                            @endif 
                            class="img-circle" alt="User Image">
                        </td>
                        <td>{{$user->name}}</td>
                        <td>
                            @if(!$user->admin)
                                @if($user->client)
                                    <a href="{{route('view.client',['id'=>$user->client->id])}}">{{$user->client->unique_id}}</a>
                                @else
                                    <a href="{{route('view.employee',['id'=>$user->employee[0]->id])}}">{{$user->employee[0]->unique_id}}</a>
                                @endif
                            @else
                                <span class="text-success"><h4>ADMINISTRATOR</h4></span>
                            @endif
                        </td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if($user->roles->pluck('name')[0] == 'Admin')
                                <span class="text-success"><h4>ADMINISTRATOR</h4></span>
                            @else
                                {{explode(' ',$user->roles->pluck('name')[0])[0]}}
                            @endif
                        </td>
                        <form action="{{route('assignuser.roles',['id'=>$user->id])}}" method="post">
                        @csrf
                            <td>
                                <select name="roles" id="" class="form-control">
                                    <option value="">{{'--Select Role--'}}</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->name}}" @if($user->hasRole($role->name)) selected @endif>{{$role->name}}</option>
                                    @endforeach
                                </select>
                                
                            </td>
                            <td>
                                @can('Role Management')
                                    <button type="submit" class="btn btn-xs btn-success">Save</button>
                                @endcan
                            </td>
                        </form>
                        <td>
                            @if(Auth::user()->admin and Auth::user()->id != $user->id and request()->session()->get('impersonated') == null)
                                    <a href="{{route('ImpersonateIn',['id'=>$user->id])}}" class="btn btn-xs btn-info">Login</a>
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

@stop
