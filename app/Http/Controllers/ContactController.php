<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)

    {
        $sort = $request->get('sort','name');
        $direction = $request->get('direction','asc');
        $contacts= Contact::where('user_id',auth()->id())->orderBy($sort,$direction)->paginate(10);
        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         if (! Gate::allows('create-contact')){
                abort(403);
            }
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactRequest $request)
      
    {

            // dd($request);
            if (! Gate::allows('create-contact')){
                abort(403);
            }
            Contact::create(array_merge($request->validated(),['user_id'=>$request->user()->id]));
            
            return redirect()->route('contacts.index')->with('success','Contact created successfully');
    }   

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        if (! Gate::allows('view-contact', $contact)){
            abort(403);
            
        }
        return view('contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        if (!Gate::allows('update-contact', $contact)){
            abort(403);
        }
        return view('contacts.edit', compact('contact'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    { 

        if (! Gate::allows('update-contact', $contact)) {
            abort(403);
            
        }
        
        $contact->update($request->validated());

        return redirect()->route('contacts.index')->with('success','updated successfully');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        if (!Gate::allows('delete-contact', $contact)){
            abort(403);
        }
        $contact->delete();
        return redirect()->route('contacts.index')->with('success','deleted');
    }
}
