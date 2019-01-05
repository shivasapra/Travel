<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\wage;
use App\employee;
use Carbon\Carbon;
class wageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function log(){
        return view('wage.log');
    }

    public function logs(Request $request){
        $dt = Carbon::now();
        $dt->timezone('Europe/London');
        $date = $dt->toDateString();
        $emp = employee::where('unique_id',$request->unique)->get();
        if ($emp->count() == 0){
            return view('wage.notFound');
        }
        $wages = wage::where('unique_id',$request->unique)->where('date',$date)->take(1)->get();
        if($wages->count()>0){
            $wage = wage::find($wages[0]->id);
            if($wage->login and !$wage->logout){
                return view('wage.logs')->with('wage',$wage);
            }
            elseif($wage->login and $wage->logout)
            {   
                return view('wage.logged');
            }
        }
        $wage = 'No';
        return view('wage.logs')->with('id',$request->unique)
                                ->with('wage',$wage);
    }

    public function login(Request $request,$id){
        $wage = new wage;
        $employee = employee::where('unique_id',$id)->take(1)->get();
        // dd($employee[0]->id);
        $dt = Carbon::now();
        $dt->timezone('Europe/London');
        $date = $dt->toDateString();
        $time = $dt->toTimeString();
        $wage->employee_id = $employee[0]->id;
        $wage->unique_id = $employee[0]->unique_id;
        $wage->login = $time;
        $wage->date = $date;
        $wage->hourly = $employee[0]->currency.$employee[0]->rate;
        $wage->save();
        return redirect()->route('log');
    }

    public function logout(Request $request,$id){
        $dt = Carbon::now();
        $dt->timezone('Europe/London');
        $date = $dt->toDateString();
        $logout = $dt->toTimeString();
        $wage = wage::find($id);
        $hourly = $wage->rate;
        $wage->logout = $logout;
        $time1 = substr($logout,0,2);
        $time2 = substr($wage->login,0,2);
        $diff = $time1-$time2;
        $total = $diff * $hourly;
        $wage->hours = $diff;
        $wage->wage = $total;
        $wage->save();
        return redirect()->route('log');
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
