<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;

class ImpersonateController extends Controller
{
    public function impersonateIn($id)
{
    session(['impersonated' => $id, 'backUrl' => \URL::previous()]);
    return redirect()->to('/');
}

public function impersonateOut()
{

    $back_url = request()->session()->get('backUrl');

    
    request()->session()->forget('impersonated', 'secretUrl');
    request()->session()->forget('backUrl', 'secretUrl');
    
    return  redirect()->to($back_url);
}
}
