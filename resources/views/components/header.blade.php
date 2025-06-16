<header class="bg-white/90 backdrop-blur-sm border-b border-gray-100 fixed w-full z-50">
    <div class="container mx-auto px-6">
        <div class="flex items-center justify-between py-4">
            {{-- Logo --}}
            <a href="{{ route('index') }}"
                class="text-3xl font-bold text-gray-900 flex items-center gap-2 hover:text-emerald-600 transition duration-300">
                <img src="{{ asset('images/LogoTrans.png') }}" alt="RoyList Logo" class="w-13 h-11">
                <span>Roy<span class="text-emerald-600">List</span></span>
            </a>

            {{-- Acciones --}}
            <div class="flex items-center space-x-4">
                @auth
                    {{-- Menú de usuario autenticado --}}
                    <div class="relative group">
                        <a href="{{ route('perfil') }}">
                        <button class="flex items-center space-x-2 focus:outline-none">
                            <span class="hidden md:inline text-emerald-700 font-medium">{{ Auth::user()->name }}</span>
                            <div class="w-8 h-8 rounded-full bg-emerald-200 flex items-center justify-center">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        </button>
                        </a>
                    </div>

                    {{-- Menú móvil --}}
                    <div class="relative">
                        <!-- Botón opciones -->
                        <button id="menuToggle"
                            class="text-gray-700 hover:text-gray-900 focus:outline-none p-2 rounded-md hover:bg-gray-100 transition">
                            <x-heroicon-m-ellipsis-vertical class="w-6 h-6" />
                        </button>

                        <!-- Menú desplegable -->
                        <div id="dropdownMenu"
                            class="absolute right-0 mt-2 w-44 bg-white border border-gray-200 rounded-xl shadow-xl hidden z-50">
                            <a href="{{ route('perfil') }}"
                                class="flex items-center gap-2 px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 transition rounded-t-xl">
                                <x-heroicon-m-user class="w-6 h-6 text-gray-600" />
                                Mi Perfil
                            </a>
                            <a href="{{ route('listas') }}"
                                class="flex items-center gap-2 px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 transition ">    
                                <x-heroicon-m-list-bullet class="w-6 h-6 text-gray-600" />
                                Mis Listas
                            </a>
                            <a href="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full flex items-center gap-2 px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 transition rounded-b-xl text-left">
                                    <x-heroicon-m-arrow-left-start-on-rectangle class="w-6 h-6 text-gray-600" />
                                    Cerrar sesión
                                </button>
                            </a>
                        </div>
                    </div>
                @else
                    {{-- Menú para invitados --}}
                    <a href="{{ route('login') }}"
                        class="hidden md:inline-block text-gray-600 hover:text-[#2563EB] font-medium px-3 py-2 transition duration-300">Iniciar
                        sesión</a>
                    <a href="{{ route('register') }}"
                        class="hidden md:inline-block bg-gradient-to-r from-[#2563EB] to-[#10B981] text-white px-5 py-2 rounded-full font-medium shadow-sm hover:shadow-md transition duration-300 transform hover:scale-105">
                        Regístrate
                    </a>

                    {{-- Menú móvil --}}
                    <div class="relative md:hidden">
                        <!-- Botón opciones -->
                        <button id="menuToggle"
                            class="text-gray-700 hover:text-gray-900 focus:outline-none p-2 rounded-md hover:bg-gray-100 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>

                        <!-- Menú desplegable -->
                        <div id="dropdownMenu"
                            class="absolute right-0 mt-2 w-44 bg-white border border-gray-200 rounded-xl shadow-xl hidden z-50">
                            <a href="{{ route('login') }}"
                                class="flex items-center gap-2 px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 transition rounded-t-xl">
                                <x-heroicon-m-arrow-right-end-on-rectangle class="w-6 h-6 text-gray-600" />
                                Iniciar sesión
                            </a>
                            <a href="{{ route('register') }}"
                                class="flex items-center gap-2 px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 transition rounded-b-xl">
                                <x-heroicon-m-pencil-square class="w-6 h-6 text-gray-600" />
                                Registrarse
                            </a>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</header>
