<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\employee;
use App\client;
use App\Countries;
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
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Dompdf\Dompdf;
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
        // $data = array();
        // $contactEmail = "786mohammadaslamkhan@gmail.com";
        // Mail::send('emails.invoice',$data, function($message) use ($contactEmail)
        // {
        //     $message->to($contactEmail)->subject('Performa Invoice!!');
        // });
        // dd('gya');
        if (Auth::user()->admin) {

            // return \PDF::loadHtml("<h1>testing</h1>")->stream();
            
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

        // $client_inactive_emails = array();
        // $clients = client::all();
        // foreach ($clients as $client) {
        //     if ($client->invoice == null and $client->created_at->toDateString() == Carbon::now()->addDays(-1)->toDateString()) {
        //         $email = User::find($client->creator_id)->email;
        //         array_push($client_inactive_emails,$email);
        //     }
        // }
        // if ($client_inactive_emails != null) {
        //     Mail::to($client_inactive_emails)->send(new \App\Mail\clientInactiveMail);
        // }

        $paid_invoices = invoice::where('status',1)->where('refund',0)->get();
        $unpaid_invoices = invoice::where('status',0)->where('refund',0)->get();
        $canceled_invoices = invoice::onlyTrashed()->get();
        $refunded_invoices = invoice::where('refund',1)->get();


        $unread_messages = Chat::where('to_id',Auth::user()->id)->where('status',0)->get();
        return view('home')->with('employees',employee::all())

                            ->with('clients',client::all())
                            ->with('expense',$total_amount)
                            ->with('date',$date)
                            ->with('invoices',invoice::withTrashed()->get())
                            ->with('invoice_infos',invoiceInfo::where('service_name','Visa Services')->orderBy('id','desc')->take(7)->get())
                            ->with('total_wage',$total_wage)
                            ->with('expenses',expenses::all())
                            ->with('recent_expenses',expenses::where('auto',0)->orderBy('id','desc')->take(4)->get())
                            ->with('tasks',$tasks)
                            ->with('tax',settings::all())
                            ->with('paid_invoices',$paid_invoices)
                            ->with('unpaid_invoices',$unpaid_invoices)
                            ->with('canceled_invoices',$canceled_invoices)
                            ->with('refunded_invoices',$refunded_invoices)
                            ->with('wages',$wages)
                            ->with('unread_messages',$unread_messages)
                            ->with('messages',null);
        }
        elseif(Auth::user()->employee->count()>0){
            // dd();
            $today_wage = wage::where('employee_id',Auth::user()->employee[0]->id)
                    ->where('date',Carbon::now()->toDateString())->get();
        if ($today_wage->count()>0) {
            $today_wageLogs = wageLog::where('wage_id',$today_wage[0]->id)->get();
            $latest_wageLog = wageLog::where('wage_id',$today_wage[0]->id)
                                        ->orderBy('created_at','desc')
                                        ->first();
            if($latest_wageLog != null and $latest_wageLog->logout_time == null){ 
                $total_hours_this_session = (Carbon::now())->diffInMinutes($latest_wageLog->login_time);
            // $total_hours_this_session =  substr(Carbon::now()->totimeString(),0,2) - substr($latest_wageLog->login_time,0,2);
            }
            else{
                $total_hours_this_session = null;
            }
         }
         else{
            $latest_wageLog = null;
            $total_hours_this_session = null;
         }
// dd($total_hours_this_session);
            $last = Chat::where('to_id',Auth::user()->id)->orderBy('id','desc')->get()->first();
            if($last != null){
                $last->status = 1;
                $last->save();
            }
            $wages = wage::where('employee_id',Auth::user()->employee[0]->id)->get();
            $total_wage = 0;
            foreach ($wages as $wage) {
                $total_wage = $total_wage + $wage->today_wage;
            }
            $messages = Chat::where('to_id',Auth::user()->id)->orWhere('user_id',Auth::user()->id)->orderBy('id','asc')->get();
            return view('employee.home')->with('assignments',assignment::where('date',Carbon::now()->timezone('Europe/London')->toDateString())
                                        ->where('employee_id',null)->get())
                                        ->with('messages',$messages)
                                        ->with('employee',Auth::user()->employee[0])
                                        ->with('total_wage',$total_wage)
                                        ->with('total_hours_this_session',$total_hours_this_session)
                                        ->with('latest_wageLog',$latest_wageLog);
        }
        else{
            $client = Auth::user()->client;
            return view('clients.home')->with('assignments',assignment::where('date',Carbon::now()->timezone('Europe/London')->toDateString()))
                                    ->with('client',$client);
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

            // $client_inactive_emails = array();
            // $clients = client::all();
            // foreach ($clients as $client) {
            //     if ($client->invoice == null and $client->created_at->toDateString() == Carbon::now()->addDays(-1)->toDateString()) {
            //         $email = User::find($client->creator_id)->email;
            //         array_push($client_inactive_emails,$email);
            //     }
            // }
            $paid_invoices = invoice::where('status',1)->get();
            $unpaid_invoices = invoice::where('status',0)->get();

            $messages = Chat::where('user_id',$id)->orWhere('to_id',$id)->orderBy('id','asc')->get();
            $last = Chat::where('user_id',$id)->orderBy('id','desc')->get()->first();
            $last->status = 1;
            $last->save();
            $unread_messages = Chat::where('to_id',Auth::user()->id)->where('status',0)->get();
            return view('home')->with('employees',employee::all())

                                ->with('clients',client::all())
                                ->with('expense',$total_amount)
                                ->with('date',$date)
                                ->with('invoices',invoice::orderBy('id','desc')->take(7)->get())
                                ->with('invoice_infos',invoiceInfo::where('service_name','Visa Services')->orderBy('id','desc')->take(7)->get())
                                ->with('total_wage',$total_wage)
                                ->with('expenses',expenses::all())
                                ->with('recent_expenses',expenses::where('auto',0)->orderBy('id','desc')->take(4)->get())
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
        return view('products')->with('products',products::orderBy('id','desc')->get());
    }
    public function addProduct(Request $request){
        $product = new products;
        $product->service = $request->service;
        $product->save();
        Session::flash('success','Producr Added Successfully');
        return redirect()->route('products')->with('products',products::orderBy('id','desc')-get());
    }
    public function destroyProduct($id){
        $product = products::find($id);
        $product->delete();
        Session::flash('success','Product Deleted Successfully');
        return redirect()->route('products')->with('products',products::orderBy('id','desc')->get());
    }

    public function airlines(){
        return view('airlines')->with('airlines',airlines::orderBy('id','desc')->get());
    }
    public function addAirline(Request $request){
        $airline = new airlines;
        $airline->name = $request->name;
        $airline->save();
        Session::flash('success','Airline Added Successfully');
        return redirect()->route('airlines')->with('airlines',airlines::orderBy('id','desc')->get());
    }
    public function destroyAirline($id){
        $airline = airlines::find($id);
        $airline->delete();
        Session::flash('success','Airline Deleted Successfully');
        return redirect()->route('airlines')->with('airlines',airlines::orderBy('id','desc')->get());
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
        return view('users')->with('users',User::all())
                            ->with('roles',Role::all());
    }

    public function CountrySearch(Request $request){
        if($request->ajax()){
            $output="";
            $country = Countries::where('name','LIKE','%'.$request->search."%")->get();
            // dd($country);

            if($country){
                    foreach ($country as $key => $product) {
                        $output.='<a><option onClick="CountryAssign(this)" value="'.$product->name.'">'.$product->name.'</option></a>';
                    }
                return Response($output);
            }
        }
    }

    public function CountryVisaSearch(Request $request){
        if($request->ajax()){
            $output="";
            $country = Countries::where('name','LIKE','%'.$request->search."%")->get();
            // dd($country);

            if($country){
                    foreach ($country as $key => $product) {
                        $output.='<a><option onClick="CountryVisaAssign(this)" value="'.$product->name.'">'.$product->name.'</option></a>';
                    }
                return Response($output);
            }
        }
    }


}
