<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()  {
        $contacts_count = Contact::get()->count();
        
        return view('admin.dashboard',compact('contacts_count'));
    }
}
