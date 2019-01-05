<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\employee;
use App\client;
use App\expenses;
use App\products;
use App\airlines;
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
        $expenses = expenses::where('auto',0)->get();
        $total_amount = 0;
        foreach ($expenses as $expense) {
            $total_amount = $total_amount + $expense->amount; 
        }
        return view('home')->with('employees',employee::all())
                            ->with('clients',client::all())
                            ->with('expense',$total_amount);
    }
    public function products(){
        return view('products')->with('products',products::all());
    }
    public function addProduct(Request $request){
        $product = new products;
        $product->service = $request->service;
        $product->save();
        return redirect()->route('products')->with('products',products::all());
    }
    public function destroyProduct($id){
        $product = products::find($id);
        $product->delete();
        return redirect()->route('products')->with('products',products::all());
    }

    public function airlines(){
        return view('airlines')->with('airlines',airlines::all());
    }
    public function addAirline(Request $request){
        $airline = new airlines;
        $airline->name = $request->name;
        $airline->save();
        return redirect()->route('airlines')->with('airlines',airlines::all());
    }
    public function destroyAirline($id){
        $airline = airlines::find($id);
        $airline->delete();
        return redirect()->route('airlines')->with('airlines',airlines::all());
    }
}
