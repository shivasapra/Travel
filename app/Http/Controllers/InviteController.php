<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\employee;
use App\User;
use App\Invite;
use App\client;
class InviteController extends Controller
{
    public function accept($token)
    {
        // Look up the invite
        if (!$invite = Invite::where('token', $token)->first()) {
            //if the invite doesn't exist do something more graceful than this
            abort(404);
        }

        // create the user with the details from the invite
        $employee = employee::where('email',$invite->email)->take(1)->get();
        // dd($employee);
        $user = new User;
        $user->name = $employee[0]->first_name ." ". $employee[0]->last_name;
        $user->email = $employee[0]->email;
        $user->password = bcrypt('pass@123');
        $user->save();
        $employee[0]->user_id = $user->id;
        $employee[0]->save();

        // delete the invite so it can't be used again
        $invite->delete();

        // here you would probably log the user in and show them the dashboard, but we'll just prove it worked

        return redirect()->route('home');
    }

    public function confirm($token)
    {
        // Look up the invite
        if (!$client = client::where('token', $token)->first()) {
            //if the invite doesn't exist do something more graceful than this
            abort(404);
        }

        $client->confirmation = 1;
        $client->save();

        // here you would probably log the user in and show them the dashboard, but we'll just prove it worked

        return redirect()->route('home');
    }
}
