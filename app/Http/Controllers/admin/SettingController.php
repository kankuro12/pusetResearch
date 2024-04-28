<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Policies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function index(){
        return view('admin.setting.index');
    }

    public function policy_index()
    {
        $policies = DB::table('policies')->get();
        return view('admin.setting.policy.index',compact('policies'));
    }

    public function policy_add(Request $request)
    {
        $policy = new Policies();
        $policy->title = $request->title;
        $policy->description = $request->description;
        $policy->save();
        // return redirect()->back()->with('success','successfully added');

    }
    public function policy_edit(Request $request, $policy_id)
    {
        $policy = Policies::where('id', $policy_id)->first();
        $policy->title = $request->title;
        $policy->description = $request->description;
        $policy->save();
        // return redirect()->back()->with('success','successfully update');
    }
    public function policy_del($policy_id){
        Policies::where('id',$policy_id)->delete();
        return redirect()->back()->with('success','successfully deleted');
    }


    public function about_index()
    {
        $abouts = DB::table('abouts')->get();
        return view('admin.setting.about.index',compact('abouts'));
    }

    public function about_add(Request $request)
    {
        $about = new About();
        $about->title = $request->title;
        $about->description = $request->description;
        $about->save();
    }
    public function about_edit(Request $request, $about_id)
    {
        $about = About::where('id', $about_id)->first();
        $about->title = $request->title;
        $about->description = $request->description;
        $about->save();
    }
    public function about_del($about_id){
        About::where('id',$about_id)->delete();
        return redirect()->back()->with('success','successfully deleted');
    }
}
