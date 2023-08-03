<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Customer;
use App\Traits\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Symfony\Component\Intl\Countries;

class ContactController extends Controller
{
    use Image;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::latest()->paginate(8);
        
        return view('admin.contacts.index', compact('contacts'));
    }
    public function search(Request $request)
    {
        $searchQuery = $request->input('search');

        $contacts = Contact::where(function ($query) use ($searchQuery) {
            $query->where('first_name', 'like', '%' . $searchQuery . '%')
                  ->orWhere('last_name', 'like', '%' . $searchQuery . '%')
                  ->orWhere('email', 'like', '%' . $searchQuery . '%');
        })->latest()->paginate(10);

        return view('admin.contacts.index', ['contacts' => $contacts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Countries::getNames();
        $gender = Contact::gender_types();
        $countries = array_slice($countries, 0,10);
        return view('admin.contacts.create', [
            'contact' => new Contact(),
            'countries'=> $countries,
            'gender' => $gender,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except(['avatar','phone_no']);
    
        $data['phone_no'] = implode(',', $request->phone_no);
    
        if ($request->hasFile('avatar')) {
            $data['avatar'] = $this->storeImage($request, 'avatar', '/uploads/contacts');
        }
    
        Contact::create($data);
        return redirect()->route('contacts.index')->with('success', 'Contact Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        $countries = Countries::getNames();
        $gender = Contact::gender_types();
        $countries = array_slice($countries, 0,10);
        $contact->phone_no = explode(',', $contact->phone_no);
        return view("admin.contacts.edit", compact('contact', 'countries','gender'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContactRequest $request, Contact $contact)
    {
        $data = $request->except(['avatar', 'phone_no']);
        $data['avatar'] = $this->updateImage($request, $contact, 'avatar', '/uploads/contacts');
        $data['phone_no'] =  $contact->filterAndFormatPhoneNumbers($request->phone_no);
    
      
      
    
        $contact->update($data);
        return redirect()->route('contacts.index')->with('success', 'Contact Updated Successfully!');
    }

  


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $status =  $contact->delete();
        if ($status) {
            
        
            $this->deleteImage($contact->avatar);
            return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully.');
        }
        return redirect()->route('contacts.index')->with('error', 'Failed to delete the classroom.');

    }
}
