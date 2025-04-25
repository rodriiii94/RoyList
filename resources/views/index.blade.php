@extends('layouts.app')

@section('title', 'Inicio - RoyList')

@section('content')

    <section class="grid grid-cols-1 md:grid-cols-2 items-center px-10 py-20 gap-12 ml-90 mr-50">
        <div>
            <h1 class="text-5xl font-bold leading-snug">
                Create your <br> shopping lists <br>
                <span class="text-green-600">sustainably</span>
            </h1>
            <p class="mt-4 text-gray-600 max-w-md">
                Organize your shopping by supermarket, browse products, and create efficient shopping lists to reduce waste and save time.
            </p>
            <a href="#" class="inline-block mt-6 bg-green-600 text-white px-6 py-3 rounded hover:bg-green-700">
                Get Started →
            </a>
        </div>
        <div class="flex justify-center">
            <div class="bg-gray-200 w-80 h-64 rounded flex items-center justify-center">
                <span class="text-gray-500">[Image Placeholder]</span>
            </div>
        </div>
    </section>

    <section class="bg-green-50 py-16">
        <h2 class="text-center text-3xl font-bold text-gray-800 mb-12">How It Works</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 px-6 md:px-20 ml-35 mr-35">
            <div class="bg-white p-6 rounded-lg shadow text-center">
                <div class="text-green-600 text-3xl font-bold mb-4">1</div>
                <h3 class="font-semibold text-xl mb-2">Choose Supermarkets</h3>
                <p class="text-gray-600">Select from multiple supermarkets to organize your shopping efficiently.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow text-center">
                <div class="text-green-600 text-3xl font-bold mb-4">2</div>
                <h3 class="font-semibold text-xl mb-2">Browse Products</h3>
                <p class="text-gray-600">Find and add products from each supermarket’s catalog to your lists.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow text-center">
                <div class="text-green-600 text-3xl font-bold mb-4">3</div>
                <h3 class="font-semibold text-xl mb-2">Shop Efficiently</h3>
                <p class="text-gray-600">Use your organized lists to shop faster and reduce food waste.</p>
            </div>
        </div>
    </section>
@endsection

