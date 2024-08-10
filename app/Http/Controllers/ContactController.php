<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search','');

        $contacts = Contact::where('name','LIKE', "%$search%")
                            ->orWhere('email', 'LIKE', "%$search%")
                            ->get();

        return view('index', ['contacts'=> $contacts]);                    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
        'name' => 'required',
        'email'=> 'required| unique:Contacts'       
       ]);
       Contact::create($request->all());
       return redirect('/contacts');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $contact = Contact::findorFail($id);
        return view('show', ['contact'=>$contact]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $contact = Contact::findorFail($id);
        return view('edit', ['contact'=>$contact]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'email'=> 'required|unique:contacts,email,'.$id,       
           ]);

    $contact = Contact::findorFail($id);
    $contact->update($request->all());
    return redirect('/contacts');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $contact = Contact::findorFail($id);
        $contact->delete();

        return redirect('/contacts');
    }
}
