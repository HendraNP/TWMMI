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
                        <p id="wordCount">0/50 kata</p>
                    </div>
                    <div class="text-right">
                        <button type="submit" id="submitBtn" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition" disabled>Kirim</button>
                    </div>
                    {{ session('success') }}
                </form>
            </div>

        </div>
    </div>
</section>
@endsection


@push('scripts')
    <!-- Load jQuery from CDN if not already loaded -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#message').on('keypress', function () {
                let words = $(this).val().trim().split(/\s+/);
                let filtered = words.filter(w => w.length > 0);
                let count = filtered.length;

                if (count > 50) {
                    $(this).val(filtered.slice(0, 50).join(" "));
                    count = 50;
                }

                $('#wordCount').text(count + "/50 kata");
                $('#submitBtn').prop('disabled', count <= 3 || count > 50);
            });
        });
    </script>
@endpush
