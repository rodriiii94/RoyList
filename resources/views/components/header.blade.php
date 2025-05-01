<header class="bg-white/90 backdrop-blur-sm border-b border-gray-100 fixed w-full z-50">
    <div class="container mx-auto px-6">
        <div class="flex items-center justify-between py-4">
            {{-- Logo --}}
            <a href="/" class="text-2xl font-bold text-gray-900 flex items-center gap-2 hover:text-[#2563EB] transition duration-300">
                <svg class="w-8 h-8 text-[#10B981]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <span>Roy<span class="text-[#10B981]">List</span></span>
            </a>

            

            {{-- Acciones --}}
            <div class="flex items-center space-x-4">
                <a href="{{ route('login') }}" class="hidden md:inline-block text-gray-600 hover:text-[#2563EB] font-medium px-3 py-2 transition duration-300">Iniciar sesión</a>
                <a href="{{ route('register') }}" class="bg-gradient-to-r from-[#2563EB] to-[#10B981] text-white px-5 py-2 rounded-full font-medium shadow-sm hover:shadow-md transition duration-300 transform hover:scale-105">
                    Regístrate gratis
                </a>
                
                {{-- Menú móvil --}}
                <button class="md:hidden text-gray-600 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</header>
