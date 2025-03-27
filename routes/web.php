<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

Route::get('/', function () {
    //return view('primera');
    $response = Http::get('http://localhost:3000/api/data');
    $data = $response->json();
    $cont = 1;
    foreach ($data as $product) {
        echo $cont . " - " . $product['name'] . " - " . $product['id'] . '<br>';
        $cont++;
    }
    //dd($data);
});
