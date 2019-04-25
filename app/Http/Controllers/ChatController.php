<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chat;
use Auth;
use Carbon\Carbon;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $last = Chat::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->get()->first();
        if ($last != null) {
            $last->status = 1;
            $last->save();
        }
        $chat = new Chat;
        $chat->user_id = Auth::user()->id;
        $chat->admin = Auth::user()->admin;
        $chat->time = Carbon::now()->timezone('Europe/London')->toTimeString();
        $chat->date = Carbon::now()->timezone('Europe/London')->toDateString();
        $chat->to_id = 1;
        $chat->message = $request->message;
        $chat->save();
        return redirect()->back();
    }

    public function AdminMessageStore(Request $request)
    {   
        $last = Chat::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->get()->first();
        if ($last != null) {
            $last->status = 1;
            $last->save();
        }
        $chat = new Chat;
        $chat->user_id = Auth::user()->id;
        $chat->admin = Auth::user()->admin;
        $chat->time = Carbon::now()->timezone('Europe/London')->toTimeString();
        $chat->date = Carbon::now()->timezone('Europe/London')->toDateString();
        $chat->to_id = $request->user_id;
        $chat->message = $request->message;
        $chat->save();
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
