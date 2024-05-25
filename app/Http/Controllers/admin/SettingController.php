<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\ArticalType;
use App\Models\Associate;
use App\Models\Associatetitle;
use App\Models\Generallayout;
use App\Models\Policies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.setting.index');
    }

    public function general_index(Request $request)
    {
        $generalLayout = Generallayout::first();
        if ($request->getMethod() == "GET") {
            return view('admin.setting.general.index', compact('generalLayout'));
        } else {
            if ($generalLayout == null) {
                $generalLayout = new Generallayout();
                $generalLayout->logo = "";
            }
                $generalLayout->copy_right_name = $request->copy_right_name;
                $generalLayout->content =$request->content;
                $generalLayout->long_desc = $request->long_desc;
                $generalLayout->short_desc = $request->short_desc;
                if ($request->hasFile('logo')) {
                    $generalLayout->logo = $request->file('logo')->store('uploads/setting');
                }
                if ($request->hasFile('fav')) {
                    $generalLayout->fav = $request->file('fav')->store('uploads/setting');
                }
                $generalLayout->save();

                Cache::forget('generallayouts');
        }
        return redirect()->back()->with('success', 'successfully added');
    }

    public function policy_index()
    {
        $policies = DB::table('policies')->get();
        return view('admin.setting.policy.index', compact('policies'));
    }

    public function policy_add(Request $request)
    {
        if($request->getMethod()=="GET"){
            return view('admin.setting.policy.add');
        }else{
            $policy = new Policies();
            $policy->title = $request->title;
            $policy->description = $request->description;
            $policy->save();
        }
        $policies = Policies::get();
        file_put_contents(resource_path('views/front/cache/policy.blade.php'),view('admin.templete.poilcy',compact('policies'))->render());
        return redirect()->back()->with('success','Successfully Added');
    }
    public function policy_edit(Request $request, $policy_id)
    {
        $policy = Policies::where('id', $policy_id)->first();
        if($request->getMethod()=="GET"){
            return view('admin.setting.policy.edit',compact('policy'));
        }else{
            $policy->title = $request->title;
            $policy->description = $request->description;
            $policy->save();
        }
        $policies = Policies::get();
        file_put_contents(resource_path('views/front/cache/policy.blade.php'),view('admin.templete.poilcy',compact('policies'))->render());

    }
    public function policy_del($policy_id)
    {
        Policies::where('id', $policy_id)->delete();
        return redirect()->back()->with('success', 'successfully deleted');
        $policies = Policies::get();
        file_put_contents(resource_path('views/front/cache/policy.blade.php'),view('admin.templete.poilcy',compact('policies'))->render());
    }


    //about start

    public function about_index()
    {
        $abouts = DB::table('abouts')->get();
        return view('admin.setting.about.index', compact('abouts'));
    }

    public function about_add(Request $request)
    {
        $about = new About();
        $about->title = $request->title;
        $about->sub_title = $request->sub_title??"";
        $about->description = $request->description;
        $about->save();
        self::aboutRender();

    }
    public function about_edit(Request $request, $about_id)
    {
        $about = About::where('id', $about_id)->first();
        if ($request->getMethod() == "POST") {
            $about->title = $request->title;
            $about->sub_title = $request->sub_title??"";
            $about->description = $request->description;
            $about->save();
            self::aboutRender();
            return redirect()->back()->with('success','successfully updated');

        } else {
            return view('admin.setting.about.edit', compact('about'));
        }
    }
    public function about_del($about_id)
    {
        About::where('id', $about_id)->delete();
        self::aboutRender();
        return redirect()->back()->with('success', 'successfully deleted');
    }

    public static function aboutRender(){
        $abouts = DB::table('abouts')->get();
        file_put_contents(resource_path('views/front/cache/about.blade.php'), view('admin.templete.about', compact('abouts'))->render());
    }

    // end about

    public function indexArtical()
    {
        $articals = DB::table('artical_types')->get();
        return view('admin.setting.articalType.index', compact('articals'));
    }
    public function addArtical(Request $request)
    {
        $artical = new ArticalType();
        $artical->name = $request->name;
        $artical->save();
    }
    public function editArtical(Request $request, $artical_id)
    {
        $artical = ArticalType::where('id', $artical_id)->first();
        $artical->name = $request->name;
        $artical->save();
    }
    public function del($artical_id)
    {
        ArticalType::where('id', $artical_id)->delete();
        return redirect()->back()->with('success', 'Successfully Deleted');
    }


    //association

    public function indexAsso(Request $request)
    {
        $title = Associatetitle::first();
        $associates = Associate::get();
        if ($request->getMethod() == "GET") {
            return view('admin.setting.associate.index', compact('title', 'associates'));
        } else {
            $associatetitle = new Associatetitle();
            $associatetitle->title = $request->title;
            $associatetitle->save();
            if ($request->filled('ids')) {
                foreach ($request->ids as $key => $id) {
                    $associate = new Associate();
                    $associate->link = $request->input('link_' . $id);
                    if ($request->hasFile('image_' . $id)) {
                        $associate->image = $request->file('image_' . $id)->store('uploads/associate/image');
                    }
                    $associate->save();
                }
            };
            file_put_contents(resource_path('views/front/cache/sidebar.blade.php'), view('admin.templete.sidebar', compact('title', 'associates')));
        };
        return redirect()->back()->with('success','successfully Added');
    }
    public function delAsso($id)
    {
        Associate::where('id', $id)->delete();
    }
}
