<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{


  public function login(Request $request)
  {
        $this->validateLogin($request);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect()->route('home');
        }
        return back()->withErrors(['email' => trans('auth.failed')]);
   
  }

  public function validateLogin(Request $request)
  {
        $this->validate($request,[
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
  }

  public function logout(Request $request)
  {

      Auth::logout();
      $request->session()->invalidate();
      return redirect('/');

  }
}
