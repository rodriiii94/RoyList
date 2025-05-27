@extends('layouts.app')

@section('title', 'Inicio - RoyList')

@section('content')

{{-- HERO REDISEÑADO --}}
<section class="bg-white pt-32 pb-20"> <!-- Añadido pt-32 para espacio del header -->
    <div class="container mx-auto px-6">
        <div class="flex flex-col lg:flex-row items-center gap-12">
            {{-- Contenido de texto --}}
            <div class="flex-1 text-center lg:text-left">
                <h1 class="text-4xl sm:text-5xl font-bold text-gray-800 leading-tight mb-6">
                    Organiza tus compras
                    <span class="text-emerald-600">sin complicaciones</span>
                </h1>
                <p class="text-lg text-gray-600 mb-8 max-w-lg mx-auto lg:mx-0">
                    RoyList simplifica tu experiencia de compra con listas inteligentes que te ayudan a ahorrar tiempo, reducir el desperdicio y mantener el control de tu presupuesto.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="{{ route('listas') }}" class="{{-- bg-emerald-600 --}} hover:bg-emerald-700 bg-gradient-to-r from-[#2563EB] to-[#10B981] text-white px-8 py-3 rounded-lg font-semibold shadow-sm transition duration-300">
                        Comenzar ahora
                    </a>
                </div>
            </div>

            {{-- Imagen --}}
            <div class="flex-1 max-w-2xl">
                <div class="relative rounded-xl overflow-hidden shadow-lg border border-gray-100">
                    <img src="{{ asset('images/supermarket.jpg') }}" alt="Lista de compra organizada" class="w-full h-auto object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent"></div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CÓMO FUNCIONA --}}
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <span class="inline-block bg-emerald-100 text-emerald-800 px-4 py-2 rounded-full text-sm font-semibold mb-4">Cómo funciona</span>
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Simplifica tus compras en 3 pasos</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Una solución intuitiva para comprar de forma más inteligente y sostenible.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            {{-- Paso 1 --}}
            <div class="bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition border border-gray-100">
                <div class="w-14 h-14 bg-emerald-50 rounded-lg flex items-center justify-center mb-4 mx-auto">
                    <span class="text-emerald-600 font-bold text-xl">1</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2 text-center">Configura tus tiendas</h3>
                <p class="text-gray-600 text-center">Selecciona tus supermercados favoritos para organizar tus compras eficientemente.</p>
            </div>

            {{-- Paso 2 --}}
            <div class="bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition border border-gray-100">
                <div class="w-14 h-14 bg-emerald-50 rounded-lg flex items-center justify-center mb-4 mx-auto">
                    <span class="text-emerald-600 font-bold text-xl">2</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2 text-center">Crea tus listas</h3>
                <p class="text-gray-600 text-center">Añade productos fácilmente desde catálogos actualizados o crea tus propios items.</p>
            </div>

            {{-- Paso 3 --}}
            <div class="bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition border border-gray-100">
                <div class="w-14 h-14 bg-emerald-50 rounded-lg flex items-center justify-center mb-4 mx-auto">
                    <span class="text-emerald-600 font-bold text-xl">3</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2 text-center">Compra inteligente</h3>
                <p class="text-gray-600 text-center">Accede a tus listas organizadas desde cualquier dispositivo cuando vayas a comprar.</p>
            </div>
        </div>
    </div>
</section>

{{-- BENEFICIOS DESTACADOS --}}
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="flex flex-col lg:flex-row items-center gap-12 lg:ml-40">
            {{-- Imagen --}}
            <div class="flex-1 max-w-lg">
            <div class="relative rounded-xl overflow-hidden">
                <img src="{{ asset('images/RoyListLogoTrans.png') }}" alt="Beneficios de RoyList" class="w-full h-auto object-cover">
            </div>
            </div>
            
            {{-- Contenido --}}
            <div class="flex-1">
            <span class="inline-block bg-emerald-100 text-emerald-800 px-4 py-2 rounded-full text-sm font-semibold mb-4">Beneficios</span>
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Por qué elegir RoyList</h2>
            
            <div class="space-y-6">
                <div class="flex items-start gap-4">
                <div class="flex-shrink-0 mt-1">
                    <div class="w-10 h-10 bg-emerald-50 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    </div>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800">Ahorro de tiempo</h3>
                    <p class="text-gray-600">Organiza tus compras por pasillos y supermercados para optimizar tu tiempo.</p>
                </div>
                </div>
                
                <div class="flex items-start gap-4">
                <div class="flex-shrink-0 mt-1">
                    <div class="w-10 h-10 bg-emerald-50 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                    </svg>
                    </div>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800">Reducción de desperdicio</h3>
                    <p class="text-gray-600">Sugerencias inteligentes basadas en tus hábitos de consumo.</p>
                </div>
                </div>
                
                <div class="flex items-start gap-4">
                <div class="flex-shrink-0 mt-1">
                    <div class="w-10 h-10 bg-emerald-50 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                    </svg>
                    </div>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800">Control de gastos</h3>
                    <p class="text-gray-600">Seguimiento de presupuesto y alertas para compras conscientes.</p>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>

@endsection
