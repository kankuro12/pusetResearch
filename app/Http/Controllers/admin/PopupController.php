<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Popup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PopupController extends Controller
{
    public function index()
    {
        $popups = DB::table('popups')->get();
        return view('admin.popup.index', compact('popups'));
    }

    public function list()
    {

        return response()->json($popups);
    }

    public function add(Request $request)
    {
        if ($request->getMethod() == 'GET') {
            return view('admin.popup.add');
        }

        $popup = new Popup();
        if ($request->hasFile('desktop_image')) {
            $popup->desktop_image = $request->file('desktop_image')->store('uploads/popup');
        }
        if ($request->hasFile('mobile_image')) {
            $popup->mobile_image = $request->file('mobile_image')->store('uploads/popup');
        }
        $popup->link = $request->input('link');
        $popup->active = $request->has('active') ? 1 : 0;
        $popup->save();

        self::cache();

        return redirect()->back()->with('success', 'successfully added');
    }

    public function edit(Request $request, $popup_id)
    {
        $popup = Popup::where('id', $popup_id)->first();
        if ($request->getMethod() == 'GET') {
            return view('admin.popup.edit', compact('popup'));
        }

        if ($request->hasFile('desktop_image')) {
            $popup->desktop_image = $request->file('desktop_image')->store('uploads/popup');
        }
        if ($request->hasFile('mobile_image')) {
            $popup->mobile_image = $request->file('mobile_image')->store('uploads/popup');
        }
        $popup->link = $request->input('link');
        $popup->active = $request->has('active') ? 1 : 0;
        $popup->save();

        self::cache();

        return redirect()->back()->with('success', 'successfully updated');
    }

    public function del($popup_id)
    {
        Popup::where('id', $popup_id)->delete();
        self::cache();
        return redirect()->back()->with('success', 'successfully deleted');
    }

    public static function cache()
    {
        $popups = Popup::where('active', 1)->get();
        file_put_contents(resource_path('views/front/cache/popups.blade.php'), view('admin.templete.popups', compact('popups'))->render());
    }
}
