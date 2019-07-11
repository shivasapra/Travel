<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\wage;
use App\wageLog;
use App\employee;
use Carbon\Carbon;
use Session;
class wageController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function session(){
        $employee = Auth::user()->employee[0];
        $today_wage = wage::where('employee_id',$employee->id)
                    ->where('date',Carbon::now()->toDateString())->get();
        if ($today_wage->count()>0) {
            $latest_wageLog = wageLog::where('wage_id',$today_wage[0]->id)
                                        ->orderBy('created_at','desc')
                                        ->first();
            if($latest_wageLog != null and $latest_wageLog->logout_time == null){ 
                $total_hours_this_session = (Carbon::now())->diffInMinutes($latest_wageLog->login_time);
            }
            else{
                $total_hours_this_session = null;
            }
         }
         else{
            $latest_wageLog = null;
            $total_hours_this_session = null;
         }
        return view('wage.session')->with('latest_wageLog',$latest_wageLog)->with('total_hours_this_session',$total_hours_this_session);
    }

    public function Logout(Request $request){
        if (Hash::check($request->password,Auth::user()->password)) {
            $wageLog = wageLog::find($request->wageLogId);
            $wageLog->logout_time = Carbon::now()->totimeString();
            $wageLog->save();
            $wageLog->hours = number_format( (float) ( ((Carbon::parse($wageLog->logout_time))->diffInMinutes(Carbon::parse($wageLog->login_time)))/60 ), 2, '.', '') ;
            $wageLog->save();
            $wage = $wageLog->wage;
            $wage->total_hours =  $wage->total_hours + $wageLog->hours;
            $wage->save();
            $wage->today_wage =  number_format( (float) ($wage->total_hours * $wage->hourly), 2, '.', '') ;
            $wage->save();
        }
        Session::flash('success','Session Ends');
        return redirect()->back();
    }

    public function Login(Request $request){
        if (Hash::check($request->password,Auth::user()->password)) {
             $employee = Auth::user()->employee[0];
             $today_wage = wage::where('employee_id',$employee->id)
                            ->where('date',Carbon::now()->toDateString())->get();
             if ($today_wage->count()>0) {
                $today_wageLogs = wageLog::where('wage_id',$today_wage[0]->id)->get();
                $latest_wageLog = wageLog::where('wage_id',$today_wage[0]->id)
                                            ->orderBy('created_at','desc')
                                            ->first();
                $wageLog = new wageLog;
                $wageLog->wage_id = $today_wage[0]->id;
                $wageLog->date = Carbon::now()->toDateString();
                $wageLog->login_time = Carbon::now()->totimeString();
                $wageLog->save();
                $today_wage[0]->no_of_logins = $today_wage[0]->no_of_logins + 1;
                $today_wage[0]->save();
             }
             else {
                $wage = new wage;
                $wage->employee_id = $employee->id;
                $wage->unique_id = $employee->unique_id;
                $wage->date = Carbon::now()->toDateString();
                $wage->no_of_logins = 1;
                $wage->hourly = $employee->rate;
                $wage->total_hours = 0;
                $wage->today_wage = 0;
                $wage->save();

                $wageLog = new wageLog;
                $wageLog->wage_id = $wage->id;
                $wageLog->date = Carbon::now()->toDateString();
                $wageLog->login_time = Carbon::now()->totimeString();
                $wageLog->save();
            }
        }
        else{
            Session::flash('warning','Wrong Password');
            return redirect()->back();
        }

        Session::flash('success','Session Started');
        return redirect()->back();
    }

    public function index()
    {   
        return view('wage.index')->with('employees',employee::all());                      
    }

    public function show($id)
    {
        $employee = employee::find($id);
        return view('wage.show')->with('employee',$employee);
    }

    public function generateSlip(){
        $employees = employee::where('id',0)->get();
        return view('wage.slipGenerate')->with('employees',$employees);
    }

    public function slip(Request $request){
        $employee = employee::where('unique_id',$request->unique)->take(1)->get();
        
        if ($employee->count()>0) {
            $emp = employee::find($employee[0]->id);
        }
        else{
            return redirect()->route('slip.generate');
        }
        $wages = wage::where('unique_id',$request->unique)->get();
        $total_wage = 0;
        $total_hours = 0;
        foreach($wages as $wage){
            if(substr($wage->date,5,-3) == $request->month){
                $total_wage = $total_wage + $wage->today_wage;
                $total_hours = $total_hours + $wage->total_hours;
            } 
        }
        $employees = employee::where('id',0)->get();
        return view('wage.slip')->with('employee',$emp)
                                ->with('total_wage',$total_wage)
                                ->with('total_hours',$total_hours)
                                ->with('employees',$employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
