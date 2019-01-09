<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\expenses;
use Carbon\Carbon;
class expensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $dt = Carbon::now();
        $dt->timezone('Asia/Kolkata');
        $date_today = $dt->timezone('Europe/London');
        $date = $date_today->toDateString();
        $day = $dt->day;
        $all_auto_active = expenses::where('auto',1)->where('status',1)->get();
        foreach($all_auto_active as $active){
            if($active->deduction_date == $day and $active->latest != $date){
                $new_expense = new expenses;
                $new_expense->amount = $active->amount;
                $new_expense->date = $date;
                $new_expense->description = $active->description;
                $new_expense->save();
                $active->latest = $date;
                $active->save();
            }
        }
        
        




        if ($request->date) {
            $expense = new expenses;
            $expense->date = $request->date;
            $expense->amount = $request->amount;
            $expense->description = $request->description;
            if ($request->company_name != null) {
                $expense->company_name = $request->company_name;
            }
            if ($request->invoice_no != null) {
                $expense->invoice_no = $request->invoice_no;
            }
            $expense->save();
        }
        // dd($date);
        $expenses = expenses::where('auto',0)->get();
        return view('expenses.index')->with('expenses',$expenses)
                                        ->with('date',$date);
    }

    public function auto(Request $request){

        $dt = Carbon::now();
        $dt->timezone('Asia/Kolkata');
        $date_today = $dt->timezone('Europe/London');
        $date = $date_today->toDateString();
        $all_auto_active = expenses::where('auto',1)->where('status',1)->get();
        foreach ($all_auto_active as $active) {
            if ($active->end_date < $date) {
                $active->status = 0;
                $active->save();
            }
        }

        if ($request->deduction_date) {
            $expense = new expenses;
            $expense->deduction_date = $request->deduction_date;
            $expense->start_date = $request->start_date;
            $expense->end_date = $request->end_date;
            $expense->amount = $request->amount;
            $expense->description = $request->description;
            $expense->auto = 1;
            $expense->status = 1; 
            $expense->save();
        }
        $dt = Carbon::now();
        $dt->timezone('Asia/Kolkata');
        $date_today = $dt->timezone('Europe/London');
        $date = $date_today->toDateString();
        $expenses = expenses::where('auto',1)->get();
        return view('expenses.auto')->with('expenses',$expenses)
                                        ->with('date',$date);
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
        $expense = expenses::find($id);
        $expense->delete();
        return redirect()->route('expenses.get')->with('expenses',expenses::all());
    }
}
