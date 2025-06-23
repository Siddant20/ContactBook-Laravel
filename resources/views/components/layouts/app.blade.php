<x-layouts.app.sidebar :title="$title ?? null">
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
        
    @endif

    @if (session('error'))
     <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif
  {{-- <x-layouts.app.Navbar> --}}
    <flux:main>

        {{ $slot }}
    </flux:main>

</x-layouts.app.sidebar>
