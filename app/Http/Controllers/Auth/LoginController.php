<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\DB\Admin;
use App\Model\DB\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  public function getLogin()
  {
    return view('auth.login');
  }

  public function postLogin(Request $request)
  {
      // Validate the form data
    $this->validate($request, [
      'email' => 'required|email',
      'password' => 'required'
    ]);
    $credentials = $request->only('email', 'password');
      // Attempt to log the user in
      // Passwordnya pake bcrypt
    if (auth()->guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
        // if successful, then redirect to their intended location
      return redirect()->intended('admin');
    } else if (auth()->guard('user')->attempt($credentials)) {
      return redirect()->intended('user');
    }
    return view('auth.login')->with([
      'error' => 'Username/Password is invalid'
    ]);
  }

  public function logout()
  {
    if (auth()->guard('admin')->check()) {
      auth()->guard('admin')->logout();
    } elseif (auth()->guard('user')->check()) {
      auth()->guard('user')->logout();
    }

    return redirect('/');

  }
}