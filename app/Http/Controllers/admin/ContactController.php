<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\IndividualContact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $contact = Contact::first();
        $individualcontacts = IndividualContact::all();

        if ($request->isMethod('get')) {
            return view('admin.setting.contact.index', compact('contact', 'individualcontacts'));
        } else {
            if ($contact) {
                $contact->name = $request->input('cname');
                $contact->address = $request->input('address');
                $contact->phone = $request->input('phone');
                $contact->po_box = $request->input('po_box');
                $contact->email = $request->input('email');
                $contact->save();
            } else {
                $contact = new Contact();
                $contact->name = $request->input('cname');
                $contact->address = $request->input('address');
                $contact->phone = $request->input('phone');
                $contact->po_box = $request->input('po_box');
                $contact->email = $request->input('email');
                $contact->save();
                $this->render();
            }
        }
    }

    public function render(){
        $contact=Contact::First();
        $individualcontacts = IndividualContact::all();
        file_put_contents(resource_path('views/front/cache/contact.blade.php'), view('admin.templete.contact', compact('contact','individualcontacts'))->render());
    }

    public function add(Request $request){
        $contact=New IndividualContact();
        $contact->name=$request->name??"";
        $contact->post=$request->post??"";
        $contact->email=$request->email??"";
        $contact->phone=$request->phone??"";
        $contact->save();
        $this->render();

        return redirect()->back()->with('message','Contact added successfully');
    }

    public function update(Request $request){
        $contact=IndividualContact::where('id',$request->id)->first();
        $contact->name=$request->name??"";
        $contact->post=$request->post??"";
        $contact->email=$request->email??"";
        $contact->phone=$request->phone??"";
        $contact->save();
        $this->render();

        return redirect()->back()->with('message','Contact added successfully');
    }


    public function del($contact_id)
    {
        IndividualContact::where('id', $contact_id)->delete();
        $this->render();
    }
}
