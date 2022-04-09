<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthRequest;
use App\Traits\ApiResponser;

class AuthController extends Controller
{
    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function login(AuthRequest $request)
    {

        $credentials = $request->validated();
        
        $remember = $request->remember;

        if (Auth::attempt($credentials,$remember)) {
            $session = $request->session()->regenerate();
            
            $token = $request->session()->get('_token');
            $data = ['user' => Auth::user(), 'token' => $request->session()->get('_token')];
            return $this->dataResponse("Sucessfully logged in.", $data);
        }
 
        return $this->errorResponse("Invalid username or password");

    }
}
