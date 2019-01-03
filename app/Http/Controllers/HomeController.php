<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\employee;
use App\client;
use App\expenses;
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
        $expenses = expenses::all();
        $total_amount = 0;
        foreach ($expenses as $expense) {
            $total_amount = $total_amount + $expense->amount; 
        }
        return view('home')->with('employees',employee::all())
                            ->with('clients',client::all())
                            ->with('expense',$total_amount);
    }
}
