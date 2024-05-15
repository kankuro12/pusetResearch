<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if($request->getMethod()=="GET"){
            return view('admin.login');
        }else{
            if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
                return redirect()->route('admin.index')->with('success','Login Success');

            }else{
                return redirect()->back()->with('error','Credential Mismatch');
            }
        }
    }
    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }


}
