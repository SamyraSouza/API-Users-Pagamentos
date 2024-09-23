<?php

namespace App\Http\Controllers;

use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


// 3|hUo4j3vZZVqdsX6WLXOA4R3FZ0MwtxglRc6ovwZY48757ff6 ->invoice
// 4|npIwkB2lmMxncmuC1WcKZuuf0yqaSdJKgsNsmb77782a2891 -> user

class AuthController extends Controller
{
    use HttpResponses;

    public function login(Request $request){
        if(Auth::attempt($request->only('email', 'password'))){
        return $this->response('Authorized', 200, [
            'token' => $request->user()->createToken('invoice')->plainTextToken
        ]);
        }
        return $this->response('No Authorized', 403);
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return $this->response('Token Revoked', 200);
    }
}
