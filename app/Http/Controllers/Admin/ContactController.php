<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $contacts = Contact::orderBy('id', 'desc')->where('delete_status', '0')->get();
        return view('admin.list.contact', compact('contacts'));
    }

    public function view($id)
    {
        $contact = Contact::where('id', $id)->first();
        $contact->view_status = '1';
        $contact->save();

        return view('admin.pages.contact', compact('contact'));
    }

    public function delete($id)
    {
        $contact = Contact::where('id', $id)->first();
        $contact->delete_status = '1';
        $contact->save();
        return redirect('/ns-admin/contacts')->with('success', 'Contact deleted successfully.');
    }
}
