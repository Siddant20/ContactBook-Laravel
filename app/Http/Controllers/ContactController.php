<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    use AuthorizesRequests;
    public function index(Request $request)
    {
        $this->authorize('viewAny', Contact::class);

        $sort = $request->get('sort', 'name');
        $direction = $request->get('direction', 'asc');
        $search = $request->get('search');

        $user= auth()->user();

        $contacts = Contact::query()->when(! $user->hasRole('admin'), function ($query) use ($user) {
        $query->where('user_id', $user->id);
    })
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone_number', 'like', "%{$search}%");
                });
            })
            ->orderBy($sort, $direction)
            ->paginate(10);

        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Contact::class);

        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactRequest $request)
    {
        $this->authorize('create', Contact::class);

        $request->user()->contacts()->create($request->validated());

        return redirect()->route('contacts.index')->with('success', 'Contact created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        $this->authorize('view', $contact);

        return view('contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        $this->authorize('update', $contact);

        return view('contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        $this->authorize('update', $contact);

        $contact->update($request->validated());

        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $this->authorize('delete', $contact);

        $contact->delete();

        return redirect()->route('contacts.index')->with('success', 'Contact deleted');
    }
   
}
