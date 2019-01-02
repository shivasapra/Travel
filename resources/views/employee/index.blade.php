@extends('layouts.frontend')
@section('title')
Employees
@endsection
@section('content')
	<div class="container">
			<table class="table table-hover mb-0">
                    <thead>
                      <tr>
                        
                      </tr>
                    	</thead>
                    <tbody>
                    	@foreach($employees as $employee)
                    		<td><a href="{{route('edit.employee',['id'=>$employee->id])}}">{{$employee->first_name}}</a></td>
                    	@endforeach
                    </tbody>
                </table>
		<div class="text-center">
			<a href="{{route('create.employee')}}">
				<button class="btn btn-success">Add employee</button>
			</a>
		</div>
	</div>
@endsection