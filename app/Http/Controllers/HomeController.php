<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\employee;
use App\client;
use App\expenses;
use App\products;
use App\airlines;
use App\wage;
use App\wageLog;
use Carbon\Carbon;
use Session;
use App\invoice;
use App\invoiceInfo;
use App\settings;
use App\Task;
use Mail;
use App\Chat;
use Auth;
use App\User;
use App\assignment;
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
        if (Auth::user()->admin) {
        $dt = Carbon::now();
        $date_today = $dt->timezone('Europe/London');
        $date = $date_today->toDateString();

        $assignments = assignment::where('date',Carbon::now()->timezone('Europe/London')->addDays(-1)->toDateString())
                                    ->where('status',0)->get();
        foreach ($assignments as $assignment) {
            $new_assignment = new assignment;
            $new_assignment->date = $date_today;
            $new_assignment->task = $assignment->task;
            $new_assignment->task_description = $assignment->task_description;
            $new_assignment->save();
            $assignment->status = 2;
            $assignment->save();
        }
        $expenses = expenses::where('auto',0)->get();
        $total_amount = 0;
        foreach ($expenses as $expense) {
            $total_amount = $total_amount + $expense->amount; 
        }

        $wages = wage::where('date',$date)->get();
        $total_wage = 0;
        foreach ($wages as $wage) {
            $total_wage = $total_wage + $wage->today_wage;
        }

            $yesterday_date = Carbon::now()->addDays(-1)->toDateString();
        
        $tasks = Task::all();

        $client_passport_emails = array();
        $mail_clients = client::where('mail_sent',0)->where('passport_expiry_date',Carbon::now()->addMonths(6)->toDateString())->get();
        foreach ($mail_clients as $client) {
           array_push($client_passport_emails,$client->email);
           $client->mail_sent = 1;
           $client->save();
           }
        if ($client_passport_emails != null) {
            Mail::to($client_passport_emails)->send(new \App\Mail\passportMail);
        }

        $employee_passport_emails = array();
        $mail_employees = employee::where('mail_sent',0)->where('passport_expiry_date',Carbon::now()->addMonths(6)->toDateString())->get();
        foreach ($mail_employees as $employee) {
           array_push($employee_passport_emails,$employee->email);
           $employee->mail_sent = 1;
           $employee->save();
           }
           if ($employee_passport_emails != null) {
            Mail::to($employee_passport_emails)->send(new \App\Mail\passportMail);
        }


        $invoice_emails = array();
        $mail_invoices = invoice::where('status',0)->where('mail_sent',Carbon::now()->addDays(-7)->toDateString())
                                                    ->orwhere('mail_sent',Carbon::now()->addDays(-15)->toDateString())->get();
        foreach ($mail_invoices as $invoice) {
           array_push($invoice_emails,$invoice->client->email);
           if ($invoice->mail_sent == Carbon::now()->addDays(-15)->toDateString()) {
               $invoice->mail_sent = $date;
               $invoice->save();
           }
           }
           if ($invoice_emails != null) {
            Mail::to($invoice_emails)->send(new \App\Mail\invoiceMail);
        }

        $client_inactive_emails = array();
        $clients = client::all();
        foreach ($clients as $client) {
            if ($client->invoice == null and $client->created_at->toDateString() == Carbon::now()->addDays(-1)->toDateString()) {
                array_push($client_inactive_emails,$client->user->email);
            }
        }
        if ($client_inactive_emails != null) {
            Mail::to($client_inactive_emails)->send(new \App\Mail\clientInactiveMail);
        }

        $paid_invoices = invoice::where('status',1)->get();
        $unpaid_invoices = invoice::where('status',0)->get();

        
        $unread_messages = Chat::where('to_id',Auth::user()->id)->where('status',0)->get();
        return view('home')->with('employees',employee::all())
                           
                            ->with('clients',client::all())
                            ->with('expense',$total_amount)
                            ->with('date',$date)
                            ->with('invoices',invoice::orderBy('created_at','desc')->take(7)->get())
                            ->with('invoice_infos',invoiceInfo::where('service_name','Visa Services')->orderBy('created_at','desc')->take(7)->get())
                            ->with('total_wage',$total_wage)
                            ->with('expenses',expenses::all())
                            ->with('recent_expenses',expenses::where('auto',0)->orderBy('created_at','desc')->take(4)->get())
                            ->with('tasks',$tasks)
                            ->with('tax',settings::all())
                            ->with('paid_invoices',$paid_invoices)
                            ->with('unpaid_invoices',$unpaid_invoices)
                            ->with('wages',$wages)
                            ->with('unread_messages',$unread_messages)
                            ->with('messages',null);
        }
        else{
            $last = Chat::where('to_id',Auth::user()->id)->orderBy('created_at','desc')->get()->first();
            if($last != null){
                $last->status = 1;
                $last->save();
            }
            $messages = Chat::where('to_id',Auth::user()->id)->orWhere('user_id',Auth::user()->id)->orderBy('created_at','asc')->get();
            return view('employee.home')->with('assignments',assignment::where('date',Carbon::now()->timezone('Europe/London')->toDateString())
                                        ->where('employee_id',null)->get())
                                        ->with('messages',$messages);
        }
    }

    public function HomeWithMessage($id){
            $dt = Carbon::now();
            $date_today = $dt->timezone('Europe/London');
            $date = $date_today->toDateString();
    
            $assignments = assignment::where('date',Carbon::now()->timezone('Europe/London')->addDays(-1)->toDateString())
                                        ->where('status',0)->get();
            foreach ($assignments as $assignment) {
                $new_assignment = new assignment;
                $new_assignment->date = $date_today;
                $new_assignment->task = $assignment->task;
                $new_assignment->task_description = $assignment->task_description;
                $new_assignment->save();
                $assignment->status = 2;
                $assignment->save();
            }
            $expenses = expenses::where('auto',0)->get();
            $total_amount = 0;
            foreach ($expenses as $expense) {
                $total_amount = $total_amount + $expense->amount; 
            }
    
            $wages = wage::where('date',$date)->get();
            $total_wage = 0;
            foreach ($wages as $wage) {
                $total_wage = $total_wage + $wage->today_wage;
            }
    
                $yesterday_date = Carbon::now()->addDays(-1)->toDateString();
            
            $tasks = Task::all();
    
            $client_passport_emails = array();
            $mail_clients = client::where('mail_sent',0)->where('passport_expiry_date',Carbon::now()->addMonths(6)->toDateString())->get();
            foreach ($mail_clients as $client) {
               array_push($client_passport_emails,$client->email);
               $client->mail_sent = 1;
               $client->save();
               }
    
            $employee_passport_emails = array();
            $mail_employees = employee::where('mail_sent',0)->where('passport_expiry_date',Carbon::now()->addMonths(6)->toDateString())->get();
            foreach ($mail_employees as $employee) {
               array_push($employee_passport_emails,$employee->email);
               $employee->mail_sent = 1;
               $employee->save();
               }
    
    
            $invoice_emails = array();
            $mail_invoices = invoice::where('status',0)->where('mail_sent',Carbon::now()->addDays(-7)->toDateString())->get();
            foreach ($mail_invoices as $invoice) {
               array_push($invoice_emails,$invoice->client->email);
               $invoice->mail_sent = $date;
               $invoice->save();
               }
    
            $client_inactive_emails = array();
            $clients = client::all();
            foreach ($clients as $client) {
                if ($client->invoice == null and $client->created_at->toDateString() == Carbon::now()->addDays(-1)->toDateString()) {
                    array_push($client_inactive_emails,$client->user->email);
                }
            }
            $paid_invoices = invoice::where('status',1)->get();
            $unpaid_invoices = invoice::where('status',0)->get();
            
            $messages = Chat::where('user_id',$id)->orWhere('to_id',$id)->orderBy('created_at','asc')->get();
            $last = Chat::where('user_id',$id)->orderBy('created_at','desc')->get()->first();
            $last->status = 1;
            $last->save();
            $unread_messages = Chat::where('to_id',Auth::user()->id)->where('status',0)->get();
            return view('home')->with('employees',employee::all())
                               
                                ->with('clients',client::all())
                                ->with('expense',$total_amount)
                                ->with('date',$date)
                                ->with('invoices',invoice::orderBy('created_at','desc')->take(7)->get())
                                ->with('invoice_infos',invoiceInfo::where('service_name','Visa Services')->orderBy('created_at','desc')->take(7)->get())
                                ->with('total_wage',$total_wage)
                                ->with('expenses',expenses::all())
                                ->with('recent_expenses',expenses::where('auto',0)->orderBy('created_at','desc')->take(4)->get())
                                ->with('tasks',$tasks)
                                ->with('tax',settings::all())
                                ->with('paid_invoices',$paid_invoices)
                                ->with('unpaid_invoices',$unpaid_invoices)
                                ->with('wages',$wages)
                                ->with('unread_messages',$unread_messages)
                                ->with('messages',$messages)
                                ->with('id',$id);
            
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
        $tax = settings::all()->last();
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
    public function letter(){
        return view('letter')->with('date',Carbon::now()->toDateString());
    }

    public function sendLetter(Request $request){
        
        $contactEmail = $request->email_to;
        $data = array('content'=>$request->content);
        Mail::send('emails.letter', $data, function($message) use ($contactEmail)
        {  
            $message->to($contactEmail);
        });
        return redirect()->back();
    }

    public function sendEmail(Request $request){
        $contactEmail = $request->emailto;
        $subject = $request->subject;
        $data = array('content'=>$request->message);
        Mail::send('emails.send', $data, function($message) use ($contactEmail,$subject)
        { 
            $message->to($contactEmail)->subject($subject);
        });
        Session::flash('success','Mail Sent!');
        return redirect()->back();
    }

    public function users(){
        return view('users')->with('users',User::all());
    }
}
