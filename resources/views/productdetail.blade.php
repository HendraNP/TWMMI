@extends('layouts.app')

@section('content')
<section class="bg-white py-16 px-6">
    <div class="max-w-4xl mx-auto">
        <a href="{{ url('/product') }}" class="inline-block mb-6 text-blue-600 hover:underline text-sm">&larr; Back to Product List</a>

        <div class="flex flex-col md:flex-row gap-8 items-start">
            <div class="w-full md:w-1/2">
                <img src="{{ asset('images/'.$product['image'])}}" alt="{{ $product['product_name'] }}" class="rounded shadow-md w-full object-contain">
            </div>

            <div class="w-full md:w-1/2">
                <h2 class="text-2xl font-bold text-gray-800 mb-2 uppercase">{{ $product['product_name'] }}</h2>
                <p class="text-sm text-gray-500 mb-4">{{ $product['function_name'] }}</p>

                <div class="mt-6">
                    <h3 class="font-semibold mb-2 text-gray-700">Product Description</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        {!! $product['description'] !!}   
                    </p>
                </div>
            </div>

        </div>
        <div class="mt-12">
            <p class="text-xl text-gray-800 italic mt-4">
                * Produk ini tersedia dalam 3 ukuran, yaitu 1kg, 5kg dan 25kg.
            </p>
    </div>
</section>
@endsection
