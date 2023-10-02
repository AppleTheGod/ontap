<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('Auth.login');
    }
    public function loginProcess(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials))
        {
            return redirect('/');
        }
        else
        {
            return redirect()->route('login')->with('fail', 'Invalid login credentials');
        }
    }
    public function registerPage()
    {
        return view('Auth.register');
    }
    public function registerProcess(RegisterRequest $request)
    {
        if($request->isMethod('POST'))
        {
            // dd($request);
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            if($user->save())
            {
                return redirect('/login')->with('success', 'Register Successfully');
            }
        }
    }
    public function logOut()
    {
        Auth::logout();
        return redirect('/');
    }
}
