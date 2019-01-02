<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\employee;

class employeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employee.index')->with('employees',employee::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employee = new employee;
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->middle_name = $request->middle_name;
        $employee->father_name = $request->father_name;
        $employee->mother_name = $request->mother_name;
        $employee->gender = $request->gender;
        $employee->DOB = $request->DOB;
        $employee->marital_status = $request->marital_status;
        $employee->disability = $request->disability;
        $employee->blood_group = $request->blood_group;
        $employee->country = $request->country;
        $employee->passport = $request->passport;
        $employee->visa = $request->visa;
        $employee->visa_expired = $request->visa_expired;
        $employee->permanent_address = $request->permanent_address;
        $employee->temporary_address = $request->temporary_address;
        $employee->permanent_address = $request->permanent_address;
        $employee->home_phone = $request->home_phone;
        $employee->mobile_phone = $request->mobile_phone;
        $employee->email = $request->email;
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
        $employee->national_insurance_no = $request->national_insurance_no;
        $employee->save();
        return redirect()->route('employees');
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
        $employee->disability = $request->disability;
        $employee->blood_group = $request->blood_group;
        $employee->country = $request->country;
        $employee->passport = $request->passport;
        $employee->visa = $request->visa;
        $employee->visa_expired = $request->visa_expired;
        $employee->permanent_address = $request->permanent_address;
        $employee->temporary_address = $request->temporary_address;
        $employee->permanent_address = $request->permanent_address;
        $employee->home_phone = $request->home_phone;
        $employee->mobile_phone = $request->mobile_phone;
        $employee->email = $request->email;
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
        $employee->national_insurance_no = $request->national_insurance_no;
        $employee->save();
        return redirect()->route('employees');
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
}
