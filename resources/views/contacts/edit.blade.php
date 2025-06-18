<x-layouts.app>
    <h1 class="text-xl font-bold mb-4">EDIT Contact</h1>
    <form method="POST" action="{{ route('contacts.update', $contact) }}"
        class="max-w-md mx-auto p-6 bg-white rounded shadow-md">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-semibold mb-2">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $contact->name) }}" required
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
            @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $contact->email) }}" required
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
            @error('email')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="phone_number" class="block text-gray-700 font-semibold mb-2">Phone </label>
            <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $contact->phone_number) }}" required
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
            @error('phone_number')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="address" class="block text-gray-700 font-semibold mb-2">Address </label>
            <input type="text" name="address" id="address" value="{{ old('address', $contact->address) }}"
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
            @error('address')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">
            Submit
        </button>
    </form>
</x-layouts.app>
