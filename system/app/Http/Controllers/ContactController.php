<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Redirect;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\UserEmails;
use DB;
 
class ContactController extends Controller
{
    function create_contact(Request $req){
        $type = "application/json";
        
            $contact = new Contact;
            $contact->name = $req->name;
            $contact->email = $req->email;
            $contact->message = $req->message;
            $contact->save();
            UserEmails::contact($req->name, $req->email,$req->message);
            return redirect('/contact-us');
        
      }
}