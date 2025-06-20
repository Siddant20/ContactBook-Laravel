<x-layouts.app>
    <h1 class="text-xl font-bold mb-4">Contact Details</h1>
    <form action="{{route( 'contacts.edit', $contact) }}"><button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded"> EDIT Contact </button>
    </form>
    </form>

    <div style="margin-top: 30px" class="bg-white p-4 rounded shadow">
        <p><strong>Name:</strong> {{ $contact->name }}</p>
        <p><strong>Email:</strong> {{ $contact->email }}</p>
        <p><strong>Phone:</strong> {{ $contact->phone_number }}</p>
        <p><strong>Address:</strong> {{ $contact->address }}</p>
        <p><strong>Belongs to: {{ $contact->user->name }}</strong></p>

        <p class="text-sm text-gray-500 mt-2">
            Created at: {{ $contact->created_at->format('M d, Y H:i') }} <br>
            Last updated: {{ $contact->updated_at->format('M d, Y H:i') }}
        </p>
    </div>
    <br />
    <div>
        <form method="POST" onsubmit="return confirm('Are you sure?');"
            action="{{ route('contacts.destroy', $contact) }}">
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition">Delete
                record</button>
            @csrf
            @method('DELETE')
        </form>
    </div>
    <a href="{{ route('contacts.index') }}" class="text-blue-600 mt-4 inline-block">← Back to Contacts</a>
</x-layouts.app>
