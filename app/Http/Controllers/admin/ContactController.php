<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\IndividualContact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request){
        $contact = Contact::first();
        $individualcontacts = IndividualContact::get();
        if($request->getMethod()=="GET"){
            return view('admin.setting.contact.index',compact('contact','individualcontacts'));
        }else{
            if($contact == null){
                $contact = new Contact();
            }{
                $contact->name = $request->input('cname');
                $contact->address = $request->input('address');
                $contact->phone = $request->input('phone');
                $contact->po_box = $request->input('po_box');
                $contact->email = $request->input('email');
                $contact->save();
            }
            $individualContact = $request->input('individualContactsDatas');
            foreach ($individualContact as $key => $contact) {
                if(isset($contact['id'])){
                   $individualcontact = IndividualContact::where('id',$contact['id'])->first();
                }else{
                    $individualcontact = new IndividualContact();
                }
                $individualcontact->name = $contact['name'];
                $individualcontact->title = $contact['title'];
                $individualcontact->post = $contact['post'];
                $individualcontact->save();
            }
        }
        file_put_contents(resource_path('views/front/cache/contact.blade.php'),view('admin.templete.contact',compact('contact'))->render());
    }

    public function del($contact_id){
        IndividualContact::where('id',$contact_id)->delete();
    }
}
