<x-layouts.app>
    

    <h1>All contacts for {{$user->name}} : </h1>

 
    <table class="table-auto w-full border border-gray-300">
         <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2"> <a
                        href="{{ route('contacts.index', ['sort' => 'name', 'direction' => request('sort') === 'name' ? $direction : 'asc']) }}"
                        class="hover:underline">Name</a></th>
                <th class="border px-4 py-2"><a
                        href="{{ route('contacts.index', ['sort' => 'email', 'direction' => request('sort') === 'email' ? $direction : 'asc']) }}"
                        class="hover:underline">Email</a></th>
                <th class="border px-4 py-2"><a
                        href="{{ route('contacts.index', ['sort' => 'created_at', 'direction' => request('sort') === 'created_at' ? $direction : 'asc']) }}"
                        class="hover:underline">Date
                        Created</a></th>
                <th class="border px-4 py-2"><a
                        href="{{ route('contacts.index', ['sort' => 'updated_at', 'direction' => request('sort') === 'updated_at' ? $direction : 'asc']) }}"
                        class="hover:underline">Date
                        Updated</a></th>


            </tr>
        </thead>
    
    @forelse ($contacts as $contact)  
    <tr onclick="window.location='{{ route('contacts.show', $contact) }}'"
                        class="cursor-pointer hover:bg-gray-100 transition">
                        <td class="border px-4 py-2">{{ $contact->name }}</td>
                        <td class="border px-4 py-2"> {{ $contact->email }}</td>
                        <td class="border px-4 py-2"> {{ $contact->created_at }}</td>
                        <td class="border px-4 py-2"> {{ $contact->updated_at }}</td>
                        <td class="border px-4 py-2"><a class="text-blue-600 hover:underline" href="{{route('contacts.edit', $contact->id)}}">Edit</a></td>
                        <td class="border px-4 py-2"> <form action="{{route('contacts.destroy', $contact->id)}}" method="POST" onsubmit="return confirm('are you sure u want to delete?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline bg-transparent border-0 p-0 cursor-pointer">Delete</button></form></td>

                    </tr>

    @empty
        <p class="text-red-600">No contacts found.</p>
    @endforelse

    </table>

</x-layouts.app>