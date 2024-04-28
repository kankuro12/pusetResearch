<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
  public function index(){
    $faqs = Faq::get();
    return view('admin.faq.index',compact('faqs'));
  }

  public function add(Request $request){
    $faq = new Faq();
    $faq->title = $request->input('title');
    $faq->answer = $request->input('answer');
    $faq->save();
  }
  public function edit(Request $request, $faq_id ){
    $faq = Faq::where('id',$faq_id)->first();
    $faq->title = $request->input('title');
    $faq->answer = $request->input('answer');
    $faq->save();
    // return redirect()->back()->with('success','successfully updated');

  }
public function del($faq_id){
    Faq::where('id',$faq_id)->delete();
    return redirect()->back()->with('success','successfully deleted');
}

}
