<?php

namespace App\Http\Controllers;

use App\Models\Contact;

class ContactController extends Controller
{

    public function index()
    {
        $contacts = Contact::paginate(6);

        return view('dashboard.contacts.index', ['contacts' => $contacts]);
    }

}
