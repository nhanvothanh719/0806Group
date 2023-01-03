<?php

namespace App\Http\Controllers;
use App\Http\Requests\ContactRequest;
use App\Jobs\SendEmailContactUs;
use App\Models\Contact;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index() { 
        return view('contact');
    }

    public function contact(ContactRequest $request) {
        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'phone_number' => $request->phone_number,
            'user_message' => $request->user_message,
        ]);
        $admin_role_id = Role::where('name', 'admin')->first()->id;
        $receivers = User::where('role_id',$admin_role_id)->get();
        //dispatch --> push a new job onto the job queue (or dispatch the job)
        SendEmailContactUs::dispatch($contact, $receivers)->delay(now());
        return redirect()->back()->with(['class' => 'success', 'message' => 'Thank you for contact us!']);
    }
}
