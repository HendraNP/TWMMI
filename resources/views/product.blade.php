@extends('layouts.app')

@section('content')
<p class="text-xl text-center mt-4 text-gray-900">
    <a href="{{ url('/catalog/dinding') }}" class="text-indigo-800 underline hover:text-indigo-800 transition">
        Klik disini untuk melihat katalog warna →
    </a>
</p>
<section class="bg-white py-12 px-6">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">Cat Dinding</h2>
        {{-- Product Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach ($dinding as $item)
            <a href="{{ url('/product/'.$item['product_code']) }}" class="block">
                <div class="bg-white border rounded-lg shadow-md p-4 text-center">
                    <img src="{{ asset('images/'.$item['image'])}}" alt="{{ $item['product_name'] }}" class="h-40 mx-auto mb-4 object-contain" />
                    <p class="text-sm font-semibold text-gray-800 uppercase">{{ $item['product_name'] }}</p>
                </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<section class="bg-white py-16 px-6">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-3xl font-bold text-gray-800 text-center mb-10">Cat Epoxy</h2>

        {{-- Product Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach ($epoxy as $item)
            <a href="{{ url('/product/'.$item['product_code']) }}" class="block">
                <div class="bg-white border rounded-lg shadow-md p-4 text-center">
                    <img src="{{ asset('images/'.$item['image'])}}" alt="{{ $item['product_name'] }}" class="h-40 mx-auto mb-4 object-contain" />
                    <p class="text-sm font-semibold text-gray-800 uppercase">{{ $item['product_name'] }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<section class="bg-white py-16 px-6">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-3xl font-bold text-gray-800 text-center mb-10">Cat Anti Korosi</h2>

        {{-- Product Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach ($antikorosi as $item)
            <a href="{{ url('/product/'.$item['product_code']) }}" class="block">
                <div class="bg-white border rounded-lg shadow-md p-4 text-center">
                    <img src="{{ asset('images/'.$item['image'])}}" alt="{{ $item['product_name'] }}" class="h-40 mx-auto mb-4 object-contain" />
                    <p class="text-sm font-semibold text-gray-800 uppercase">{{ $item['product_name'] }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<section class="bg-white py-12 px-6">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">Other</h2>
        {{-- Product Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach ($other as $item)
            <a href="{{ url('/product/'.$item['product_code']) }}" class="block">
                <div class="bg-white border rounded-lg shadow-md p-4 text-center">
                    <img src="{{ asset('images/'.$item['image'])}}" alt="{{ $item['product_name'] }}" class="h-40 mx-auto mb-4 object-contain" />
                    <p class="text-sm font-semibold text-gray-800 uppercase">{{ $item['product_name'] }}</p>
                </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endsection
