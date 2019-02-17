<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\wage;
use App\wagelog;
use App\employee;
use Carbon\Carbon;
use Session;
class wageController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    


    public function session(){
        $employee = Auth::user()->employee[0];
        $today_wage = wage::where('employee_id',$employee->id)
                    ->where('date',Carbon::now()->toDateString())->get();
        if ($today_wage->count()>0) {
            $today_wageLogs = wageLog::where('wage_id',$today_wage[0]->id)->get();
            $latest_wageLog = wageLog::where('wage_id',$today_wage[0]->id)
                                        ->orderBy('created_at','desc')
                                        ->first();
         }
         else{
            $latest_wageLog = null;
         }
        return view('wage.session')->with('latest_wageLog',$latest_wageLog);
    }
    public function Logout(Request $request){
        if (Hash::check($request->password,Auth::user()->password)) {
            $wageLog = wageLog::find($request->wageLogId);
            $wageLog->logout_time = Carbon::now()->totimeString();
            $wageLog->save();
            $time1 = substr($wageLog->logout_time,0,2);
            $time2 = substr($wageLog->login_time,0,2);
            $wageLog->hours = $time1-$time2;
            $wageLog->save();
            $wage = $wageLog->wage;
            $wage->total_hours =  $wage->total_hours + $wageLog->hours;
            $wage->save();
            $wage->today_wage =  $wage->total_hours * $wage->hourly;
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
        // $wage = wage::orderBy('created_at','desc')->first();
        // $employee = employee::find(1);
        // $wages = $employee->wage;
        // dd($wages->orderBy('created_at','desc')->first());
        return view('wage.index')->with('employees',employee::all());
                                // ->with('wage',$wage);
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = employee::find($id);
        return view('wage.show')->with('employee',$employee);
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
    public function generateSlip(){
        return view('wage.slipGenerate');
    }

    public function slip(Request $request){
        $employee = employee::where('unique_id',$request->unique)->take(1)->get();
        // dd($employee);
        if ($employee->count()>0) {
            $emp = employee::find($employee[0]->id);
        }
        else{
            return redirect()->route('slip.generate');
        }
        // dd($request->to);
        $wages = wage::where('unique_id',$request->unique)->whereDate('date','>=',$request->from)->whereDate('date','<=',$request->to)->get();
        // dd($wages);
        $total_wage = 0;
        $total_hours = 0;
        foreach($wages as $wage){
            $total_wage = $total_wage + $wage->wage;
            $total_hours = $total_hours + $wage->hours;
        }
        return view('wage.slip')->with('employee',$emp)
                                ->with('total_wage',$total_wage)
                                ->with('total_hours',$total_hours);
    }
}
