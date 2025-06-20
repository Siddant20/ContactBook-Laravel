<x-layouts.app>

    @php
        if (request('direction') === 'asc') {
            $direction = 'desc';
        } else {
            $direction = 'asc';
        }
    @endphp

    <h1 class="text-4xl text-blue-600 font-bold text-center mt-10">All Contacts</h1>
    <form action="{{route('contacts.create')}}"><button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded"> Add New Contact </button></form>

    <table style="margin-top: 30px" class="table-auto w-full border border-gray-300" >
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



        @if (count($contacts) > 0)
            <tbody>
                @foreach ($contacts as $contact)
                    <tr onclick="window.location='{{ route('contacts.show', $contact) }}'"
                        class="cursor-pointer hover:bg-gray-100 transition">
                        <td class="border px-4 py-2">{{ $contact->name }}</td>
                        <td class="border px-4 py-2"> {{ $contact->email }}</td>
                        <td class="border px-4 py-2"> {{ $contact->created_at }}</td>
                        <td class="border px-4 py-2"> {{ $contact->updated_at }}</td>

                    </tr>
                @endforeach
            </tbody>
        

        @endif


    </table>
</x-layouts.app>
