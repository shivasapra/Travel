<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Leave;
use App\employee;
use Carbon\Carbon;
use Auth;

class LeaveController extends Controller
{
    public function index(){
        $leaves = Leave::all();
        return view('leave.index')->with('leaves',$leaves);
    }

    public function assignLeaveIndex(){
        return view('leave.assign')->with('employees',employee::all());
    }

    public function requestLeaveIndex(){
        return view('leave.request');
    }

    public function assignLeave(Request $request){
        $employee = employee::find($request->employee_name);
        $leave = new Leave;
        $leave->employee_id = $employee->id;
        $leave->leave_type = $request->leave_type;
        $leave->from = $request->from;
        $leave->to = $request->to;
        $leave->comment = $request->comment;
        $leave->no_of_days = Carbon::parse($request->from)->diffInDays(Carbon::parse($request->to))+1;
        $leave->status = 1;
        $leave->save();
        return redirect()->route('leaves');
    }

    public function requestLeave(Request $request){
        $leave = new Leave;
        $leave->employee_id = Auth::user()->employee[0]->id;
        $leave->leave_type = $request->leave_type;
        $leave->from = $request->from;
        $leave->to = $request->to;
        $leave->no_of_days = Carbon::parse($request->from)->diffInDays(Carbon::parse($request->to))+1;
        $pdf = \PDF::loadHTML($request->pdf);
        return $pdf->stream();
        // $leave->save();
        // return redirect()->route('leaves');
    }
}
