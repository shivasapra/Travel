<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\employee;
use App\User;
use App\Invite;
use App\client;
use App\invoice;
use Mail;
class InviteController extends Controller
{
    public function accept($token)
    {
        if (!$invite = Invite::where('token', $token)->first()) {
            abort(404);
        }

        $employee = employee::where('email',$invite->email)->take(1)->get();
        $user = new User;
        $user->name = $employee[0]->first_name ." ". $employee[0]->last_name;
        $user->email = $employee[0]->email;
        $user->password = bcrypt('pass@123');
        $user->save();
        $user->assignRole($employee[0]->hired_for_dep);
        $employee[0]->user_id = $user->id;
        $employee[0]->save();

        $invite->delete();
        $data =array('email'=>$user->email,'name'=>$user->name);
        $contactEmail = $user->email;
        Mail::send('emails.credentials', $data, function($message) use ($contactEmail)
        {
            $message->to($contactEmail)->subject('You Have Been Registered!!');
        });

        return view('ThankYou')->with('name',$employee[0]->first_name.' '.$employee[0]->last_name);
    }

    public function acceptClient($token)
    {
        if (!$invite = Invite::where('token', $token)->first()) {
            abort(404);
        }

        $client = client::where('email',$invite->email)->take(1)->get();
        $user = new User;
        $user->name = $client[0]->first_name ." ". $client[0]->last_name;
        $user->email = $client[0]->email;
        $user->password = bcrypt('pass@123');
        $user->assignRole('Client');
        $user->save();
        $client[0]->user_id = $user->id;
        $client[0]->save();
        $invite->delete();
        $data =array('email'=>$user->email,'name'=>$user->name);
        $contactEmail = $user->email;
        Mail::send('emails.credentials', $data, function($message) use ($contactEmail)
        {
            $message->to($contactEmail)->subject('You Have Been Registered!!');
        });

        return view('ThankYou')->with('name',$client[0]->first_name.' '.$client[0]->last_name);
    }

    public function confirm($token)
    {
        if (!$client = client::where('token', $token)->first()) {
            abort(404);
        }

        $client->confirmation = 1;
        $client->token =  null;
        $client->save();

        return view('ThankYou')->with('name',$client->first_name.' '.$client->last_name);
    }

    public function deleteClientPassportData($token)
    {
        if (!$client = client::where('token', $token)->first()) {
            abort(404);
        }
        foreach ($client->family as $family) {
            $family->member_passport_no = null;
            $family->member_passport_place = null;
            $family->member_passport_front = null;        
            $family->member_passport_back = null;
            $family->save();
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

        return view('ThankYou')->with('name',$client->first_name.' '.$client->last_name);
    }

    public function confirmInvoice($token)
    {
        if (!$invoice = invoice::where('token', $token)->first()) {
            abort(404);
        }

        $invoice->confirmation = 1;
        $invoice->confirmation_via = 'email';
        $invoice->issues = null;
        $invoice->token =  null;
        $invoice->save();

        return view('ThankYou')->with('name',$invoice->client->first_name.' '.$invoice->client->last_name);
    }

    public function refuseInvoice($token)
    {   
        
        if (!$invoice = invoice::where('token', $token)->first()) {
            abort(404);
        }
        return view('InvoiceIssue')->with('name',$invoice->client->first_name.' '.$invoice->client->last_name)
                                                ->with('invoice',$invoice);

    }
        
    public function InvoiceIssue(Request $request,$id){
        $invoice = invoice::find($id);
        $invoice->token = null;
        $invoice->issues = $request->issues;
        $invoice->save();
        return view('ThankYou')->with('name',$invoice->client->first_name.' '.$invoice->client->last_name);
    }
}
