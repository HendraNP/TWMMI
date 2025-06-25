@extends('layouts.app')

@section('content')
<section class="bg-white py-20 px-6 md:px-20">
    <div class="max-w-5xl mx-auto space-y-16">

        <!-- Header -->
        <div class="text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-indigo-800">Hubungi Kami</h1>
            <p class="mt-4 text-gray-600 text-lg">Kami siap membantu Anda — kirim pesan atau hubungi langsung melalui kontak di bawah ini.</p>
        </div>

        <!-- Contact Info + Form -->
        <div class="grid md:grid-cols-2 gap-10 items-start">

            <!-- Contact Information -->
            <div class="space-y-6 text-gray-700 text-base leading-relaxed">
                <div>
                    <h2 class="text-xl font-semibold text-indigo-700">Alamat Kantor</h2>
                    <p>PT. Teknologi Warna Matahari Merah Indonesia</p>
                    <p>Kawasan Industri Jababeka 1</p>
                    <p>Jl. Jababeka XV 11B, Blok VI No. U19 J</p>
                    <p>Cikarang Utara, Bekasi – Jawa Barat, Indonesia</p>
                </div>

                <div>
                    <h2 class="text-xl font-semibold text-indigo-700">Kontak</h2>
                    <p>Email: <a href="mailto:marketing001.twmmi@gmail.com" class="text-indigo-600 hover:underline">marketing001.twmmi@gmail.com</a></p>
                    <p>Telepon: <a href="https://wa.me/6281220252547" target="_blank" class="text-indigo-600 hover:underline">+62 812 - 2025 - 2547 (WhatsApp)</a></p>
                    <p>Telepon: 021 – 5030 0308 (Office)</a></p>
                </div>
            </div>

            <!-- Optional Contact Form -->
            <div class="bg-gray-50 rounded-lg shadow-sm p-6 space-y-4">
                <form action="" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="name" class="block font-medium text-sm text-gray-700">Nama</label>
                        <input type="text" name="name" id="name" class="w-full mt-1 p-2 border rounded" required>
                    </div>
                    <div>
                        <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                        <input type="email" name="email" id="email" class="w-full mt-1 p-2 border rounded" required>
                    </div>
                    <div>
                        <label for="message" class="block font-medium text-sm text-gray-700">Pesan</label>
                        <textarea name="message" id="message" rows="4" class="w-full mt-1 p-2 border rounded" required></textarea>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">Kirim</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>
@endsection
