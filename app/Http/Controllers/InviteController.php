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
        $user->assignRole($employee[0]->hired_for_dep);
        $employee[0]->user_id = $user->id;
        $employee[0]->save();

        // delete the invite so it can't be used again
        $invite->delete();

        // here you would probably log the user in and show them the dashboard, but we'll just prove it worked

        return redirect()->route('home');
    }

    public function acceptClient($token)
    {
        // Look up the invite
        if (!$invite = Invite::where('token', $token)->first()) {
            //if the invite doesn't exist do something more graceful than this
            abort(404);
        }

        // create the user with the details from the invite
        $client = client::where('email',$invite->email)->take(1)->get();
        // dd($employee);
        $user = new User;
        $user->name = $client[0]->first_name ." ". $client[0]->last_name;
        $user->email = $client[0]->email;
        $user->password = bcrypt('pass@123');
        $user->save();
        $client[0]->user_id = $user->id;
        $client[0]->save();

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
        $client->token =  null;
        $client->save();

        // here you would probably log the user in and show them the dashboard, but we'll just prove it worked

        return redirect()->route('home');
    }

    public function deleteClientPassportData($token)
    {
        // Look up the invite
        if (!$client = client::where('token', $token)->first()) {
            //if the invite doesn't exist do something more graceful than this
            abort(404);
        }

        $client->passport = 0;
        $client->passport_no = null;
        $client->passport_expiry_date = null;
        $client->passport_issue_date = null;
        $client->passport_place = null;
        $client->passport_front = null;
        $client->passport_back = null;
        $client->letter = null;
        $client->token = null;
        $client->save();

        // here you would probably log the user in and show them the dashboard, but we'll just prove it worked

        return redirect()->route('home');
    }
}
