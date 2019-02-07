<?php

namespace App\Http\Controllers\Auth;

use App\Authorize;
use App\Http\Controllers\Controller;
use App\Mail\AuthorizeDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class AuthorizationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function verify($token = null)
    {
        if (Authorize::validateToken($token)) {
            return Redirect::route('home')->with([
                'status' => 'Awesome ! you are now authorized !',
            ]);
        }

        return Redirect::route('login')->with([
            'error' => "Oh snap ! the authorization token is either expired or invalid. Click on Email didn't arraive ? again",
        ]);
    }

    public function resend(Request $request)
    {
        if (Authorize::inactive() && auth()->check()) {
            $authorize = Authorize::make()
                ->resetAttempt();

            Mail::to($request->user())
                ->send(new AuthorizeDevice($authorize));

            $authorize->increment('attempt');

            return view('auth.authorize');
        }
    }
}
