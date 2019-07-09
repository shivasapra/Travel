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
        $unread_messages = Chat::where('to_id',Auth::user()->id)->where('status',0)->get();
        // dd($unread_messages);
        return view('chat.index')->with('unread_messages',$unread_messages)
                                ->with('messages',null)
                                ->with('users',User::all())
                                ->with('name',null);
    }

    public function IndexWithMessage($id)
    {   
        $messages = Chat::where('user_id',$id)->orWhere('to_id',$id)->orderBy('id','asc')->get();
        $last = Chat::where('user_id',$id)->orderBy('id','desc')->get()->first();
        if ($last != null) {
            $last->status = 1;
            $last->save();
        }
        $name = User::find($id)->name;
        $unread_messages = Chat::where('to_id',Auth::user()->id)->where('status',0)->get();
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
        $chatLog = ChatLog::where('user_id',Auth::user()->id)->where('to_id',$request->to_id)->get();
        if($chatLog->count() == 0){
            $chatLog = new ChatLog;
            $chatLog->user_id = Auth::user()->id;
            $chatLog->to_id = $request->to_id;
            $chatLog->save();
        }
        $last = Chat::where('user_id',Auth::user()->id)->where('to_id',$request->to_id)->orderBy('id','desc')->get()->first();
        if ($last != null) {
            $last->status = 1;
            $last->save();
        }
        $chat = new Chat;
        $chat->user_id = Auth::user()->id;
        $chat->to_id = $request->to_id;
        $chat->message = $request->message;
        $chat->time = Carbon::now()->timezone('Europe/London')->toTimeString();
        $chat->date = Carbon::now()->timezone('Europe/London')->toDateString();
        $chat->save();
        return redirect()->back();
    }

    // public function AdminMessageStore(Request $request)
    // {   
    //     $last = Chat::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->get()->first();
    //     if ($last != null) {
    //         $last->status = 1;
    //         $last->save();
    //     }
    //     $i = 0;
    //     foreach (ChatLog::all() as $ChatLog) {
    //         if($ChatLog->user_id == $request->user_id){
    //             $i++;
    //         }
    //     }
    //     if($i == 0){
    //         $newChatLog = new ChatLog;
    //         $newChatLog->user_id = $request->user_id;
    //         $newChatLog->save();
    //     }
    //     $chat = new Chat;
    //     $chat->user_id = Auth::user()->id;
    //     $chat->admin = Auth::user()->admin;
    //     $chat->time = Carbon::now()->timezone('Europe/London')->toTimeString();
    //     $chat->date = Carbon::now()->timezone('Europe/London')->toDateString();
    //     $chat->to_id = $request->user_id;
    //     $chat->message = $request->message;
    //     $chat->save();
    //     return redirect()->back();
    // }

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
