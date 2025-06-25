@extends('layouts.app')

@section('content')
    <!-- Visual Section / Banner -->
<section class="bg-white p-0">
    <div class="w-full h-180">
        <img src="{{ asset('images/pt spanduk.png') }}" class="w-full h-full object-cover" alt="MM Paint Banner">
    </div>
</section>

<!-- Brand Section -->
<section class="py-16">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold mb-10">Brand Kami</h2>
        <div class="grid md:grid-cols-2 gap-8">
            <div x-data="{ open: false }" class="justify-items-end">
                <img 
                    src="{{ asset('images/cmpaint.png') }}" 
                    alt="Product Image" 
                    class="cursor-pointer w-64 rounded shadow-md h-32"
                    @click="open = true">

                <!-- Modal Overlay -->
                <div 
                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
                    x-show="open"
                    x-transition
                    x-cloak>
                    <!-- Modal Content -->
                    <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6 relative" @click.away="open = false">
                        <img src="{{ asset('images/cmpaint.png') }}" alt="CM Paint" class="w-full rounded mb-4">
                        <p class="text-gray-700">
                            Cat Dinding Interior dan Eksterior Merah Matahari menggunakan formula ramah lingkungan terbaru, dengan kemampuan anti-bakteri dan anti-jamur yang tahan lama, mencegah pemudaran warna dan debu, memiliki ketahanan terhadap air yang baik untuk pembersihan, serta daya tahan yang luar biasa.
                            </p>
                        </br>
                        <p>Cat ini juga sangat efektif untuk menutupi cacat pada permukaan dinding. Dapat digunakan secara luas pada dinding dan plafon interior maupun eksterior, papan gipsum, dan sebagainya</p>
                    </div>
                </div>
            </div>
            <div x-data="{ open: false }">
                <img 
                    src="{{ asset('images/mmpaint.png') }}" 
                    alt="Product Image" 
                    class="cursor-pointer w-64 rounded shadow-md h-32"
                    @click="open = true">

                <div 
                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
                    x-show="open"
                    x-transition
                    x-cloak>
                    <!-- Modal Content -->
                    <div class="bg-white rounded-lg text-justify shadow-lg max-w-md w-full p-6 relative" @click.away="open = false">
                        <img src="{{ asset('images/mmpaint.png') }}" alt="MM Paint" class="w-full rounded mb-4">
                        <p class="text-gray-700">
                            Brand Cat Premium Kami, MM Paint, menawarkan kualitas terbaik untuk kebutuhan cat dinding dan industri. Dengan teknologi terbaru, MM Paint memberikan hasil akhir yang halus, tahan lama, dan mudah dibersihkan.
                        </p></br>
                        <p>Tidak seperti Brand CM Paint, Brand MM Paint terbagi menjadi 2 kategori, yaitu MM Paint Epoxy Lantai dan MM Paint Anti Korosi.</p></br>
                        <p>Cat Epoxy Lantai MM Paint dirancang khusus untuk memberikan daya tahan tinggi dan awet pada permukaan lantai dan terlihat mengkilap, sedangkan Cat Anti Korosi MM Paint menawarkan perlindungan maksimal terhadap logam dan struktur lainnya dari korosi.</p>
                    </div>
                </div>
                </div>
        </div>
    </div>
</section>

<!-- Custom Section Structure -->
<section class="bg-white py-16 px-6 md:px-20">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-3xl font-bold text-center mb-12 text-indigo-700">Keunggulan Produk Kami</h2>
        
        <div class="grid md:grid-cols-3 gap-10">
            <!-- Feature 1 -->
            <div class="bg-gray-50 p-6 rounded-xl shadow-sm hover:shadow-md transition">
                <img src="{{ asset('images/palette.png') }}" alt="Color Options" class="w-full h-64 mb-4">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Pilihan Warna yang Banyak</h3>
                <p class="text-gray-600 leading-relaxed">
                    Pilihan warna yang beragam untuk memenuhi kebutuhan estetika dan fungsional Anda. Dari cat dinding hingga cat industri, kami punya solusinya.
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="bg-gray-50 p-6 rounded-xl shadow-sm hover:shadow-md transition">
                <img src="{{ asset('images/durable.png') }}" alt="Durability" class="w-full h-64 mb-4">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Daya Tahan yang Kuat</h3>
                <p class="text-gray-600 leading-relaxed">
                    Formula cat yang dirancang untuk ketahanan tinggi terhadap cuaca, korosi, dan keausan — cocok untuk industri hingga rumah tinggal.
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="bg-gray-50 p-6 rounded-xl shadow-sm hover:shadow-md transition">
                <img src="{{ asset('images/voc.png') }}" alt="Eco Friendly" class="w-full h-64 mb-4">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Ramah Lingkungan</h3>
                <p class="text-gray-600 leading-relaxed">
                    Cat kami memenuhi standar lingkungan dengan bahan-bahan aman dan berkelanjutan. Komitmen kami: produk unggul dan bumi sehat.
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
</html>

<!-- Product Image Trigger -->

<!-- Add Alpine.js x-cloak CSS if not already present -->
<style>
    [x-cloak] { display: none !important; }
</style>

<!-- Product Image Trigger -->
