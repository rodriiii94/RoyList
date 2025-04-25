<header class="flex items-center justify-between px-10 py-8 ml-35 mr-35">
    <div class="text-2xl font-bold text-green-700 flex items-center gap-2">
        <x-heroicon-s-building-storefront class="w-8 h-8" />
        RoyList
    </div>
    <div class="space-x-4">
        <a {{-- href="{{ route('login') }}" --}} class="text-gray-700 hover:underline">Login</a>
        <a {{-- href="{{ route('register') }}" --}} class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Register</a>
    </div>
</header>
