<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function admin_login(Request $request) {
        $remember_me = false;
        if ($request->remember_me) {
            $remember_me = $request->remember_me;
        }
        $credential = ['email'=> $request->email, 'password' => $request->password];
        $auth = Auth::attempt($credential, $remember_me);
        if ($auth) {
            $request->session()->regenerate();
            return response()->json([
                'success' => true,
                'message' => 'Success login'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Wrong credentials'
            ], 200);
        }
    }
    public function admin_logout() {
        Auth::logout();
        return redirect('/login');
    }
}
