<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function clientLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'g-recaptcha-response' => 'required|captcha',
        ], [
            'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
            'g-recaptcha-response.captcha' => 'Captcha error! Please try again later or contact site admin.',
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 1], $remember)) {
            $user = User::where('email', $request->email)->first();

            // Check if email is verified
            if (!$user->hasVerifiedEmail()) {
                Auth::logout();
                return redirect()->back()->with('error', 'Please verify your email address before logging in. Check your inbox for the verification link.');
            }

            return redirect()->route('client.index')->with('success', 'Login Success');
        } else {
            return redirect()->back()->with('error', 'Credential Mismatch');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('front.login');
    }

    public function adminLogout() {
        Auth::logout();
        return redirect()->route('admin.login');
    }
    public function clientLogout(){
        Auth::logout();
        return redirect()->route('front.login');
    }

    public function AdminLogin(Request $request)
    {
        $loginInfo = session('logininfo');

        $lockOutTime = config('app.lockout');
        $tries = config('app.tries');

        if ($request->getMethod() == "GET") {
            $loginInfo = ['p' => mt_rand('111111', '999999'), 'u' => mt_rand('111111', '999999')];
            Session::put('logininfo', $loginInfo);
            Session::save();
            return view('admin.login', compact('loginInfo'));
        } else {

            $data = [
                "email" => $request->input($loginInfo['u']),
                "password" => $request->input($loginInfo['p']),
                "g-recaptcha-response" => $request->input('g-recaptcha-response'),
            ];

            $rules = [
                'email' => ['required', 'email'],
                'password' => ['required'],
                'g-recaptcha-response' => ['required', 'captcha'],
            ];


            // Custom validation error messages
            $messages = [
                'email.required' => 'The email field is required.',
                'email.email' => 'Please enter a valid email address.',
                'password.required' => 'The password field is required.',
                'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
                'g-recaptcha-response.captcha' => 'Captcha error! Please try again later or contact site admin.',
            ];


            $validator = Validator::make($data, $rules, $messages);
            try {
                $validator->validate();
            } catch (\Throwable $th) {
                dd($validator->errors());
            }



            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'role' => 0])) {
                return redirect()->route('admin.index')->with('success', 'Login Success');
            } else {
                return redirect()->back()->withErrors(['Credential Mismatch']);
            }
        }
    }
}
