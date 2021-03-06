<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\employee;
use App\client;
use App\User;
use Carbon\Carbon;
use Session;
use App\Invite;
use Mail;
use App\wage;
use Validator;

class employeeController extends Controller
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
    
    public function index()
    {
        return view('employee.index')->with('employees',employee::orderBy('id','desc')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $dt = Carbon::now();
        $dt->timezone('Asia/Kolkata');
        $date_today = $dt->timezone('Europe/London');
        $date = $date_today->toDateString();
        return view('employee.create')->with('date',$date);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $v = Validator::make($request->all(), [
            'rate' => 'integer'
            ]);
        if(employee::where('email', $request->email)->first()){
            $v->errors()->add('Email', 'Email exists as an employee');
            return redirect()->back()->withErrors($v)->withInput();
        }
        elseif(client::where('email', $request->email)->first()){
            $v->errors()->add('Email', 'Email exists as a client');
            return redirect()->back()->withErrors($v)->withInput();
        }
        elseif(User::where('email', $request->email)->first()){
            $v->errors()->add('Email', 'Email exists as an admin');
            return redirect()->back()->withErrors($v)->withInput();
        }
        else{
            if ($v->fails()) {
                return redirect()->back()->withErrors($v)->withInput();
           }
        }

        $test_employee = employee::where('unique_id','CLDE0001')->get();
        if ($test_employee->count()>0) {
            $latest = employee::orderBy('id','desc')->take(1)->get();
            $employee_prev_no = $latest[0]->unique_id;
            $unique_id = 'CLDE000'.(substr($employee_prev_no,4,7)+1);
        }
        else{
            $unique_id = 'CLDE0001';
        }
        $employee = new employee;
        $employee->unique_id = $unique_id;
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->country = $request->country;
        $employee->email = $request->email;
        $employee->hired_for_dep = $request->hired_for_dep;
        $employee->hiring_date = $request->hiring_date;
        $employee->currency = $request->currency;
        $employee->rate = $request->rate;
        $employee->per = $request->per;
        $employee->save();
        do {
            $token = str_random();
        }
        while (Invite::where('token', $token)->first());
        $invite = new Invite;
        $invite->email = $employee->email;
        $invite->token = $token;
        $invite->save();
        $contactEmail = $employee->email;
        $data = array('token'=>$token, 'name' => $employee->first_name.' '.$employee->last_name);
        Mail::send('emails.invite', $data, function($message) use ($contactEmail)
        {  
            $message->to($contactEmail)->subject('Activate Your Account!!');
        });
        Session::flash('success','Employee created Successfully');
        return redirect()->route('employees');
    }

    public function sendLetterTOEmployee(Request $request,$id){
        $contactEmail = employee::find($id)->email;
        $data = array('content'=>$request->content);
        Mail::send('emails.letter', $data, function($message) use ($contactEmail)
        {  
            $message->to($contactEmail);
        });
        return redirect()->back();
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
        return view('employee.show')->with('employee',$employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = employee::find($id);
        return view('employee.edit')->with('employee',$employee);
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
        $employee = employee::find($id);
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->middle_name = $request->middle_name;
        $employee->father_name = $request->father_name;
        $employee->mother_name = $request->mother_name;
        $employee->gender = $request->gender;
        $employee->DOB = $request->DOB;
        $employee->marital_status = $request->marital_status;
        $employee->blood_group = $request->blood_group;
        $employee->disability = $request->disability;
        $employee->country = $request->country;
        $employee->county = $request->county;
        $employee->visa = $request->visa;
        $employee->visa_expired = $request->visa_expired;
        $employee->permanent_address = $request->permanent_address;
        $employee->temporary_address = $request->temporary_address;
        $employee->permanent_address = $request->permanent_address;
        $employee->home_phone = $request->home_phone;
        $employee->mobile_phone = $request->mobile_phone;
        $employee->email = $request->email;
        $user = User::find($employee->user_id);
        if($user != null){
        $user->email = $request->email;
        $user->save();
        }
        $employee->qualification = $request->qualification;
        $employee->experience = $request->experience;
        $employee->exp_in_dept = $request->exp_in_dept;
        $employee->hired_for_dep = $request->hired_for_dep;
        $employee->hiring_date = $request->hiring_date;
        $employee->currency = $request->currency;
        $employee->rate = $request->rate;
        $employee->per = $request->per;
        $employee->emer_contact_name = $request->emer_contact_name;
        $employee->emer_contact_address = $request->emer_contact_address;
        $employee->emer_contact_phone = $request->emer_contact_phone;
        $employee->emer_contact_email = $request->emer_contact_email;
        $employee->emer_contact_relation = $request->emer_contact_ralation;
        $employee->sort_code = $request->sort_code;
        $employee->account_no = $request->account_no;
        $employee->bank_name = $request->bank_name;
        $employee->bank_address = $request->bank_address;
        $employee->income_tax_no = $request->income_tax_no;
        $employee->tax_ref_no = $request->tax_ref_no;
        $employee->national_insurance_no = $request->national_insurance_no;
        if ($request->passport_no != null ) {
            $employee->passport = 1;
            $employee->passport_no = $request->passport_no;
            $employee->passport_expiry_date = $request->passport_expiry_date;
            $employee->passport_issue_date = $request->passport_issue_date;
            $employee->passport_place = $request->passport_place;
        }
        if($request->hasFile('passport_front')){
            $passport_front = $request->passport_front;
            $passport_front_new_name = time().$passport_front->getClientOriginalName();
            $passport_front->move('uploads/passport',$passport_front_new_name);
            $employee->passport_front = 'uploads/passport/'.$passport_front_new_name;
        }
        if($request->hasFile('passport_back')){
            $passport_back = $request->passport_back;
            $passport_back_new_name = time().$passport_back->getClientOriginalName();
            $passport_back->move('uploads/passport',$passport_back_new_name);
            $employee->passport_back = 'uploads/passport/'.$passport_back_new_name;
        }
        if($request->hasFile('utility_bill')) {
            $utility_bill = $request->utility_bill;
            $utility_bill_new_name = time().$utility_bill->getClientOriginalName();
            $utility_bill->move('uploads/passport',$utility_bill_new_name);
            $employee->utility_bill = 'uploads/passport/'.$utility_bill_new_name;
        }
        if($request->hasFile('work_permit')){
            $work_permit = $request->work_permit;
            $work_permit_new_name = time().$work_permit->getClientOriginalName();
            $work_permit->move('uploads/passport',$work_permit_new_name);
            $employee->work_permit = 'uploads/passport/'.$work_permit_new_name;
        }
        if($request->hasFile('avatar')){
            $avatar = $request->avatar;
            $avatar_new_name = time().$avatar->getClientOriginalName();
            $avatar->move('uploads/profile',$avatar_new_name);
            $employee->user->avatar = 'uploads/profile/'.$avatar_new_name;
            $employee->user->save();
        }
        $employee->save();
        Session::flash('success','Employee Updated Successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $employee = employee::find($id);
        $employee->delete();
        Session::flash('success','Employee Deleted Successfully');
        return redirect()->route('employees');
    }
    public function status(){
        $dt = Carbon::now();
        $date_today = $dt->timezone('Europe/London');
        $date = $date_today->toDateString();
        return view('employee.status')->with('date',$date)->with('employees',employee::all());
    }
    public function status2(Request $request){
        $date = $request->date;
        return view('employee.status2')->with('date',$date)->with('employees',employee::all());
    }

    public function letter($id){
        $employee = employee::find($id);
        $wages = wage::where('unique_id',$employee->unique_id)->get();
        $total_wage = 0;
        foreach($wages as $wage){
            $total_wage = $total_wage + $wage->today_wage;
        }
        return view('employee.letter')->with('employee',$employee)
                                      ->with('date',Carbon::now()->toDateString())
                                      ->with('wage',$total_wage);
    }

    public function search(Request $request){
        $employees = employee::where('first_name', 'like', '%'.request('employee_name').'%')->get();
        return view('employee.assignment')->with('employees',$employees);
    }

    public function activate($id){
        $user = employee::find($id)->user;
        $user->active = 1;
        $user->save();
        Session::flash('success','Employee Activated');
        return redirect()->back();
    }

    public function deactivate($id){
        $user = employee::find($id)->user;
        $user->active = 0;
        $user->save();
        Session::flash('success','Employee Deactivated');
        return redirect()->back();
    }

    public function searchEmployee(Request $request){
        $employees = employee::where('first_name', 'like', '%'.request('employee_name').'%')->get();
        return view('wage.slipGenerate')->with('employees',$employees);
    }

    public function searchEmployeeG(Request $request){
        $employees = employee::where('first_name', 'like', '%'.request('employee_name').'%')->get();
        return redirect()->back()->with('employees',$employees);
    }

    public function attendance($id){
        $employee = employee::find($id);
        return view('employee.attendance')->with('employee',$employee);
    }

    public function resendAccountConfirmation($id){
        $employee = employee::find($id);
        $old_invite = Invite::where('email',$employee->email);
        $old_invite->delete();
        do {
            $token = str_random();
        }while (Invite::where('token', $token)->first());

        $invite = new Invite;
        $invite->email = $employee->email;
        $invite->token = $token;
        $invite->save();

        $contactEmail = $employee->email;
        $data = array('token'=>$token, 'name' => $employee->first_name.' '.$employee->last_name);
        Mail::send('emails.invite', $data, function($message) use ($contactEmail)
        {  
            $message->to($contactEmail)->subject('Activate Your Account!!');
        });
        Session::flash('success','Confirmation Resent!!');
        return redirect()->back();
    }
}
