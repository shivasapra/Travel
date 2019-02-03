<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\employee;
use App\client;
use App\expenses;
use App\products;
use App\airlines;
use App\wage;
use App\todo;
use Carbon\Carbon;
use Session;
use App\invoice;
use App\settings;
use App\Task;
use Mail;
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
        // dd($date_today->addMonths(6));
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

        $all_todos = todo::all();
            foreach ($all_todos as $todo) {
                if ($todo->status != 1) {
                
                    if ($todo->date < $date_today) {
                        $todo->status = 3;  //misssed
                    }
                    if ($todo->date == $date_today and $todo->time < $time_now) {
                        $todo->status = 2;  //delayed
                    }
                }
                $todo->save();
            }
            $yesterday_date = Carbon::now()->addDays(-1)->toDateString();
        $todos = todo::where('date',$date_today)->orderBy('created_at','desc')->take(6)->get();
        $missed_todos = todo::where('date',$yesterday_date)->where('status',3)->get();
        $missed_todos_five = todo::where('date',$yesterday_date)->where('status',3)->take(5)->get();
        $invoices = invoice::orderBy('created_at','desc')->take(7)->get();
        $tasks = Task::all();
        $emails = array();
        $clients = client::where('mail_sent',0)->where('passport_expiry_date',$date_today->addMonths(6)->toDateString())->get();
        foreach ($clients as $client) {
           array_push($emails,$client->email);
           $client->mail_sent = 1;
           $client->save();
           }
         Mail::to($emails)->send(new \App\Mail\passportMail);
        
        return view('home')->with('employees',employee::all())
                           
                            ->with('clients',client::all())
                            ->with('expense',$total_amount)
                            ->with('logged_in',$logged_in)
                            ->with('logged_out',$logged_out)
                            ->with('date',$date)
                            ->with('invoices',$invoices)
                            ->with('total_wage',$total_wage)
                            ->with('expenses',expenses::where('auto',0)->orderBy('created_at','desc')->take(7)->get())
                            ->with('todos',$todos)
                            ->with('missed_todos',$missed_todos)
                            ->with('missed_todos_five',$missed_todos_five)
                            ->with('tasks',$tasks);
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

    public function addTodo(Request $request){
        $todo = new todo;
        // dd();
        $todo->date = $request->date;
        $todo->time = $request->time;
        $todo->activity = $request->activity;
        $todo->save();
        Session::flash('success','You successfully created a Todo!!');
        return redirect()->route('home');
    }

    public function updateTodo(Request $request,$id){
        $todo = todo::find($id);
            $todo->status = 1;
            $todo->save();
            Session::flash('info','You successfully completed a Task!!');
        return redirect()->route('home');
    }


    public function todos($target_date){
        $dt = Carbon::now();
        $dt->timezone('Asia/Kolkata');
        $date_today = $dt->toDateString();
        $time_now =Carbon::now()->timezone('Asia/Kolkata')->format('h:i');
        $todos = todo::where('date',$target_date)->orderBy('created_at','desc')->get();
        return view('todo')->with('todos',$todos)
                            ->with('date_today',$date_today)
                            ->with('time',$time_now)
                            ->with('date',$target_date);
    }

    public function todosCustom(Request $request){
        $dt = Carbon::now();
        $dt->timezone('Asia/Kolkata');
        $date_today = $dt->toDateString();
        $time_now =Carbon::now()->timezone('Asia/Kolkata')->format('h:i');
        $todos = todo::where('date',$request->date)->orderBy('created_at','desc')->get();
        return view('todo')->with('todos',$todos)
                            ->with('date_today',$date_today)
                            ->with('time',$time_now)
                            ->with('date',$request->date);
    }

    public function pastWeekTodos(){
        $dt = Carbon::now();
        $dt->timezone('Asia/Kolkata');
        $time_now =Carbon::now()->timezone('Asia/Kolkata')->format('h:i');
        $week_start_date = $dt->addDays(-7)->toDateString();
        // dd($week_start_date);
        $date_today = Carbon::now()->toDateString();
        $todos = todo::whereBetween('date',[$week_start_date,$date_today])->orderBy('date','desc')->paginate(10);
        $date = null;
        // dd($todos);
        return view('todo')->with('todos',$todos)
                            ->with('time',$time_now)
                            ->with('date_today',$date_today)
                            ->with('week_start_date',$week_start_date)
                            ->with('date',$date);
    }

    public function pastMonthTodos(){
        $dt = Carbon::now();
        $dt->timezone('Asia/Kolkata');
        $time_now =Carbon::now()->timezone('Asia/Kolkata')->format('h:i');
        $month_start_date = $dt->addDays(-30)->toDateString();
        // dd($week_start_date);
        $date_today = Carbon::now()->toDateString();
        $todos = todo::whereBetween('date',[$month_start_date,$date_today])->orderBy('date','desc')->paginate(10);
        $date = null;
        // dd($todos);
        return view('todo')->with('todos',$todos)
                            ->with('time',$time_now)
                            ->with('date_today',$date_today)
                            ->with('month_start_date',$month_start_date)
                            ->with('date',$date);
    }
}
