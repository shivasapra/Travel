<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImpersonateController extends Controller
{
    public function impersonateIn($id)
{
    session(['impersonated' => $id, 'backUrl' => \URL::previous()]);

    return redirect()->to('dashboard');
}

public function impersonateOut()
{

    $back_url = Request::session()->get('backUrl');

    Request::session()->forget('impersonated', 'secretUrl');


    return $back_url ? 
        redirect()->to($back_url) : 
        redirect()->to('dashboard');
}
}
