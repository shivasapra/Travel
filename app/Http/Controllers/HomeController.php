<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\employee;
use App\client;
use App\expenses;
use App\products;
use App\airlines;
use App\wage;
use Carbon\Carbon;
use Session;
use App\invoice;
use App\settings;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $dt = Carbon::now();
        $date_today = $dt->timezone('Europe/London');
        $date = $date_today->toDateString();
        $expenses = expenses::where('auto',0)->get();
        $total_amount = 0;
        foreach ($expenses as $expense) {
            $total_amount = $total_amount + $expense->amount; 
        }
        $logged_in = wage::where('date',$date)->where('login', '!=', null)->where('logout',null)->get();
        $logged_out = wage::where('date',$date)->where('login', '!=', null)->where('logout', '!=',null)->get();
        $today_wage = wage::where('date',$date)->get();
        $total_wage = 0;
        foreach ($today_wage as $wage) {
            $total_wage = $total_wage + $wage->wage;
        }

        $invoices = invoice::orderBy('created_at','desc')->take(7)->get();
        return view('home')->with('employees',employee::all())
                            ->with('clients',client::all())
                            ->with('expense',$total_amount)
                            ->with('logged_in',$logged_in)
                            ->with('logged_out',$logged_out)
                            ->with('date',$date)
                            ->with('invoices',$invoices)
                            ->with('total_wage',$total_wage)
                            ->with('expenses',expenses::where('auto',0)->orderBy('created_at','desc')->take(7)->get());
    }
    public function products(){
        return view('products')->with('products',products::all());
    }
    public function addProduct(Request $request){
        $product = new products;
        $product->service = $request->service;
        $product->save();
        Session::flash('success','Producr Added Successfully');
        return redirect()->route('products')->with('products',products::all());
    }
    public function destroyProduct($id){
        $product = products::find($id);
        $product->delete();
        Session::flash('success','Product Deleted Successfully');
        return redirect()->route('products')->with('products',products::all());
    }

    public function airlines(){
        return view('airlines')->with('airlines',airlines::all());
    }
    public function addAirline(Request $request){
        $airline = new airlines;
        $airline->name = $request->name;
        $airline->save();
        Session::flash('success','Airline Added Successfully');
        return redirect()->route('airlines')->with('airlines',airlines::all());
    }
    public function destroyAirline($id){
        $airline = airlines::find($id);
        $airline->delete();
        Session::flash('success','Airline Deleted Successfully');
        return redirect()->route('airlines')->with('airlines',airlines::all());
    }

    public function tax()
    {
        return view('tax')->with('tax',settings::all());
    }
    public function taxUpdate(Request $request){
        $tax = settings::find(1);
        $tax->tax = $request->tax;
        $tax->enable = $request->enable;
        $tax->save();
        return view('tax')->with('tax',settings::all());
    }
}
