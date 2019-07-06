@extends('layouts.frontend')
@section('title')
Attendance
@endsection
@section('header')
	<section class="content-header">
      <h1>
        Attendance
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-pencil-square-o"></i> Attendance</li>
      </ol>
    </section>
@stop
@section('content')
    <div class="box box-info">
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                    <th><strong>Date</strong></th>
                    <th><strong>Status</strong></th>
                    <th><strong>Wage</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $array_two = array();
                    $period = Carbon\CarbonPeriod::since(Auth::user()->created_at->toDateString())->days(1)->until(Carbon\Carbon::now()->toDateString())->toArray();
                    
                    foreach(App\wage::where('employee_id',Auth::user()->employee[0]->id)->get() as $wage){
                        array_push($array_two,Carbon\Carbon::parse($wage->date)->toDateString());
                    }
                    ?>
                    @foreach(collect($period)->reverse() as $d)
                    <tr>
                        <td style="font-weight:10px;">{{$d->format('d-m-Y')}}</td>
                        <td>
                        @if(collect($array_two)->contains($d->toDateString()))
                            <span class="text-success"><strong>{{'PRESENT'}}</strong></span>
                        @else
                            <span class="text-danger"><strong>{{'ABSENT'}}</strong></span>
                        @endif
                        </td>
                        <td>
                        @if(App\wage::where('employee_id',Auth::user()->employee[0]->id)->where('date',$d->toDateString())->get()->count()>0)
                            {{$employee->currency.' '.App\wage::where('employee_id',Auth::user()->employee[0]->id)->where('date',$d->toDateString())->get()[0]->today_wage}}
                        @else
                            --
                        @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection