<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\ColourCatalog;
use App\Models\FunctionType;
use App\Models\Product;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/view', function () {
    return Inertia::render('Index');
})->name('index');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/product', function () {
   $dinding = Product::where('product_usage','=','dinding')->get(); // Or use a filtered query
   $epoxy = Product::where('product_usage','=','epoxy')->get(); // Or use a filtered query
   $antikorosi = Product::where('product_usage','=','antikorosi')->get();
   $other = Product::where('product_usage','=','other')->get();
   $category = FunctionType::get(); // Or use a filtered query
    return view('product', compact('dinding', 'epoxy','antikorosi', 'category', 'other'));
})->name('product');

Route::get('/product/{slug}', function ($slug) {
    $product = Product::where('product_code','=', $slug)->first();

    return view('productdetail', compact('product'));
})->name('detail');

use App\Models\Color;

Route::get('/catalog/{tipe}', function ($tipe) {
    $colors = ColourCatalog::where('type','=',$tipe)->orderBy('id')->get();
    return view('catalog', compact('colors'));
});

Route::get('/contact', function () {
    return view('contact');
})->name('contact');
