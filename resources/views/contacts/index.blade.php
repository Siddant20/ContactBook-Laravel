<x-layouts.app>

    @php
        if (request('direction') === 'asc') {
            $direction = 'desc';
        } else {
            $direction = 'asc';
        }
    @endphp


    <h1 class="text-4xl text-blue-600 font-bold text-center mt-10">All Contacts</h1>


    <form method="GET" action="{{ route('contacts.index') }}"><input type="text"  name="search"
            placeholder="Search Contacts "><button type="submit">🔍</button> <button onclick="location.reload()"
            style="font-size: 15px; padding: 12px 24px;">
            🔄 Refresh
        </button></form>
        
    


    <table style="margin-top: 30px" class="table-auto w-full border border-gray-300">
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
                <th></th>
                <th></th>
                 @role('admin')
                <th>Belongs To</th>
                @endrole




            </tr>
        </thead>



        @if (count($contacts) > 0)
            <tbody>
                @foreach ($contacts as $contact)
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
                         @role('admin')
                         <td>{{$contact->user->name ?? 'unknown'}}</td>
                         @endrole   

                    </tr>
                @endforeach
            </tbody>


        @endif



    </table>
    <form style="margin-top: 30px" action="{{ route('contacts.create') }}"><button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded"> Add New Contact </button>
    </form>

    <div class="mt-4">
    {{ $contacts->links() }}
</div>
</x-layouts.app>
