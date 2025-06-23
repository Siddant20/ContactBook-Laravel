<x-layouts.app>

    @php
        if (request('direction') === 'asc') {
            $direction = 'desc';
        } else {
            $direction = 'asc';
        }
    @endphp

    <h1 class="text-2xl text-blue-600 font-bold text-left mt-10">All Admin Users</h1>



    <form method="GET" action="{{ route('admin.index') }}"><input type="text" value="{{ request('searchAdmin') }}"
            name="searchAdmin" placeholder="Search Contacts "><button type="submit">🔍</button> <button
            onclick="location.reload()" style="font-size: 15px; padding: 12px 24px;">
            🔄 Refresh
        </button></form>





    <table style="margin-top: 30px" class="table-auto w-full border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2"> <a
                        href="{{ route('admin.index', ['sort' => 'name', 'direction' => request('sort') === 'name' ? $direction : 'asc']) }}"
                        class="hover:underline">Name</a></th>
                <th class="border px-4 py-2"><a
                        href="{{ route('admin.index', ['sort' => 'email', 'direction' => request('sort') === 'email' ? $direction : 'asc']) }}"
                        class="hover:underline">Email</a></th>






            </tr>
        </thead>



        <tbody>

            @if ($admins->isNotEmpty())
                @foreach ($admins as $admin)
                    <tr onclick="window.location='{{ route('admin.users.show', $admin) }}'"
                        class="cursor-pointer hover:bg-gray-100 transition">
                        <td class="border px-4 py-2">{{ $admin->name }}</td>
                        <td class="border px-4 py-2"> {{ $admin->email }}</td>
                        <td>
                            <form action="{{ route('admin.users.removeAdmin', $admin) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                <button class="bg-red-800 hover:bg-red-700 text-white font-bold py-2 px-3 rounded"
                                    onclick="return confirm('Remove {{ $admin->name }} from admin panel?')"type="submit">Remove
                                    Admin</button>
                            </form>
                        </td>




                    </tr>
                @endforeach
            @else
                <td class= "text-center text-red-800">No Users Found ! </td>

            @endif
        </tbody>
    </table>

    <h1 class="text-2xl text-blue-600 font-bold text-left mt-10">All Users</h1>
    <form method="GET" action="{{ route('admin.index') }}"><input type="text" value="{{ request('searchUser') }}"
            name="searchUser" placeholder="Search Contacts "><button type="submit">🔍</button> <button
            onclick="location.reload()" style="font-size: 15px; padding: 12px 24px;">
            🔄 Refresh
        </button>
    </form>

    <table style="margin-top: 30px" class="table-auto w-full border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2"> <a
                        href="{{ route('admin.index', ['sort' => 'name', 'direction' => request('sort') === 'name' ? $direction : 'asc']) }}"
                        class="hover:underline">Name</a></th>
                <th class="border px-4 py-2"><a
                        href="{{ route('admin.index', ['sort' => 'email', 'direction' => request('sort') === 'email' ? $direction : 'asc']) }}"
                        class="hover:underline">Email</a></th>
                <th></th>



            </tr>
        </thead>




        <tbody>
            @if ($nonAdmins->isNotEmpty())
                @foreach ($nonAdmins as $user)
                    <tr onclick="window.location='{{ route('admin.users.show', $user) }}'"
                        class="cursor-pointer hover:bg-gray-100 transition">
                        <td class="border px-4 py-2">{{ $user->name }}</td>
                        <td class="border px-4 py-2"> {{ $user->email }}</td>
                        <td>
                            <form action="{{ route('admin.users.makeAdmin', $user) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-3 rounded"
                                    onclick="return confirm('make {{ $user->name }} an admin?')"type="submit">Make
                                    Admin</button>
                            </form>
                        </td>



                    </tr>
                @endforeach
            @else
                <tr>
                    <td class= "text-center text-red-800">No Users Found ! </td>
                </tr>
            @endif
        </tbody>
        <div></div>





</x-layouts.app>
