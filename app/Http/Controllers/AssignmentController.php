<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\assignment;
use Session;
use Auth;
class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employee.assignment')->with('assignments',assignment::all());
    }

    public function accept($id){
        $assignment = assignment::find($id);
        $assignment->employee_id = Auth::user()->employee[0]->id;
        $assignment->save();
        Session::flash('info','Accepted');
        return redirect()->back();
    }
    public function assignmentDone($id){
        $assignment = assignment::find($id);
        $assignment->status = 1;
        $assignment->save();
        Session::flash('success','Assignment Done');
        return redirect()->back();
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
        $assignment = new assignment;
        $assignment->date = $request->date;
        $assignment->task = $request->task;
        $assignment->task_description = $request->task_description;
        $assignment->save();
        Session::flash('success','Task Added');
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
        //
    }
}
