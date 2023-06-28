<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function __invoke(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->with('toastify', [
                'text' => 'Message has errors. Please check if all fields are not empty and correct.',
                'className' => 'error',
            ])->withInput();
        }

        // Create a new contact record
        Contact::create([
            'name' => $request->input('first_name') . ' ' . $request->input('last_name'),
            'email' => $request->input('email'),
            'message' => $request->input('message'),
        ]);

        // Redirect back with success message
        return redirect()->back()->with('toastify', [
            'text' => 'Message sent successfully.',
            'className' => 'success',
        ])->withInput();
    }

}
