<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chat;
use Auth;
use Carbon\Carbon;
use App\ChatLog;
use App\User;

class ChatController extends Controller
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
        $unread_messages = Chat::where('to_id',Auth::user()->id)->where('status',0)->orderBy('id','desc')->get();
        return view('chat.index')->with('unread_messages',$unread_messages)
                                 ->with('messages',null)
                                 ->with('users',User::all())
                                 ->with('name',null);
    }

    public function IndexWithMessage($id)
    {   
        $messages = Chat::whereIn('user_id',[$id,Auth::user()->id])->WhereIn('to_id',[$id,Auth::user()->id])->orderBy('id','asc')->get();
        $last = Chat::where('user_id',$id)->where('to_id',Auth::user()->id)->orderBy('id','desc')->get();
        if ($last->count()>0) {
            foreach($last as $l){
                $l->status = 1;
                $l->save();
            }    
        }
        $name = User::find($id)->name;
        $unread_messages = Chat::where('to_id',Auth::user()->id)->where('status',0)->orderBy('id','desc')->get();
        return view('chat.index')->with('unread_messages',$unread_messages)
                                 ->with('messages',$messages)
                                 ->with('id',$id)
                                 ->with('users',User::all())
                                 ->with('name',$name);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function clear($id)
    {
        ChatLog::where('user_id',Auth::user()->id)->where('to_id',$id)->delete();
        ChatLog::where('to_id',Auth::user()->id)->where('user_id',$id)->delete();

        $chat = Chat::whereIn('user_id',[$id,Auth::user()->id])->WhereIn('to_id',[$id,Auth::user()->id])->get();
        if($chat->count() > 0){
            foreach($chat as $c){
               $c->delete();
            }
        }
        return true;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $chatLog = ChatLog::where('user_id',Auth::user()->id)->where('to_id',$request->to_id)->get();
        $chatLogTwo = ChatLog::where('to_id',Auth::user()->id)->where('user_id',$request->to_id)->get();
        if($chatLog->count() == 0 and $chatLogTwo->count() == 0){
            $chatLogg = new ChatLog;
            $chatLogg->user_id = Auth::user()->id;
            $chatLogg->to_id = $request->to_id;
            $chatLogg->save();
        }
        $chat = new Chat;
        $chat->user_id = Auth::user()->id;
        $chat->to_id = $request->to_id;
        $chat->message = $request->message;
        $chat->time = Carbon::now()->timezone('Europe/London')->toTimeString();
        $chat->date = Carbon::now()->timezone('Europe/London')->toDateString();
        $chat->save();
        return [$chat->message,$chat->time,$chat->date];
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
