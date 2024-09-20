<?php

namespace App\Http\Controllers;

use App\Traits\HttpResponses;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(Request $request){
        return $this->response('Authorized', 200);
    }

    public function logout(){

    }
}
