<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InfoController extends Controller
{
    public function index(Request $request){

        $auth = Auth::user();
        $user = User::where('id',$auth->id)->first();
        $client = Client::where('user_id',$user->id)->first();
        if($request->getMethod()=="GET"){
            return view('client.profile.index',compact('client','user'));
        }else{
            $request->validate([
                'password' => 'required|min:6',
                'name' => 'required|string|max:255',
            ]);
            $user->password = bcrypt($request->password);
            $user->name = $request->name;
            $user->save();
            $client->name = $request->name;
            $client->country = $request->country;
            $client->affiliation = $request->affiliation;
            $client->save();
            return redirect()->back()->with('success','successfully updated');
        }
    }
}
