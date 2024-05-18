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
        $individualcontacts = IndividualContact::get();

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
            }

            $individualContactData = $request->input('individualContactsDatas', []);

            foreach ($individualContactData as $data) {
                $individualcontact = IndividualContact::updateOrCreate(
                    ['id' => $data['id'] ?? null],
                    [
                        'name' => $data['name'],
                        'title' => $data['title'],
                        'post' => $data['post']
                    ]
                );
            }
            file_put_contents(resource_path('views/front/cache/contact.blade.php'), view('admin.templete.contact', compact('contact'))->render());
            file_put_contents(resource_path('views/front/cache/individualcontact.blade.php'), view('admin.templete.individualcontact', compact('individualcontacts'))->render());

            return redirect()->route('admin.setting.contact.index')->with('success', 'Contact settings updated successfully.');
        }
    }

    public function del($contact_id)
    {
        IndividualContact::where('id', $contact_id)->delete();
        $contact = Contact::first();
        $individualcontacts = IndividualContact::get();
        file_put_contents(resource_path('views/front/cache/individualcontact.blade.php'), view('admin.templete.individualcontact', compact('contact', 'individualcontacts'))->render());
    }
}
