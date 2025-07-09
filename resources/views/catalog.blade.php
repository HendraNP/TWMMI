@extends('layouts.app')

@section('content')
@php
    $routeTipe = request()->route('tipe');

    $typeMap = [
        'dinding' => 'Cat Dinding',
        'epoxy' => 'Cat Epoxy',
        'antikorosi' => 'Cat Anti Korosi',
    ];

    $typeLabel = $typeMap[$routeTipe];
@endphp
<div class="max-w-screen-xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6 text-center">🎨 Katalog Warna {{ $typeLabel }} Merah Matahari 🎨 </h1>
        @php
            $file = ($colors[0]['type'] == 'dinding')
            ? 'Katalog Warna Cat Dinding Merah Matahari.pdf'
            : 'Katalog Warna Cat Epoxy Lantai - Merah Matahari.pdf';
        @endphp
        <a href="{{ asset('storage/files/' . $file) }}" download
        class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-base font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition">
        📥 Download Color Catalog
        </a>
        
        <div
            class="h-auto overflow-x-auto overflow-y-hidden px-4 py-6 custom-scroll relative whitespace-nowrap"
            x-data
            @wheel.prevent="$el.scrollLeft += $event.deltaY"
        >
            <div class="flex gap-x-1.5 w-max">
                @php
                    ($colors[0]['type'] == 'dinding') ? $totalRows = 10 : $totalRows = 4;
                    $totalCols = ceil($colors->count() / $totalRows);
                @endphp
                @for ($col = 0; $col < $totalCols; $col++)
                    <div class="flex flex-col gap-y-1.5 catalog-container" x-ref="catalog">
                        @for ($row = 0; $row < $totalRows; $row++)
                            @php
                                $index = $row < $totalRows ? $row * $totalCols + $col : null;
                                $color = $index !== null ? $colors[$index] ?? null : null;
                            @endphp
                            @if ($color)
                                <div
                                    class="relative group w-32 flex-shrink-0"
                                    x-data="{ flipUp: false, flipLeft: false, flipRight : false }"
                                    x-intersect:once="$nextTick(() => {
                                        const container = $el.closest('.catalog-container')?.getBoundingClientRect();
                                        const rect = $el.getBoundingClientRect();
                                        if (container) {
                                            flipUp = rect.bottom + 200 > container.bottom;
                                            flipLeft = rect.right + 400 > container.right;
                                            flipRight = rect.left - 240 < container.left;
                                        }
                                    })"
                                    @mouseenter="$nextTick(() => {
                                        const container = $el.closest('.catalog-container')?.getBoundingClientRect();
                                        const rect = $el.getBoundingClientRect();
                                        if (container) {
                                            flipUp = rect.bottom + 200 > container.bottom;
                                            flipLeft = rect.right + 240 > container.right;
                                            flipRight = rect.left - 240 < container.left;
                                        }
                                    })"
                                    >
                                    <div class="h-20 w-full rounded-md {{ $color->hex_code == '#ffffff' || $color->hex_code == '#clear' ? 'border' : '' }}"
                                        style="background-color: {{ $color->hex_code }}"></div>

                                    <!-- Hover Popup -->
                                    <div
                                        :class="flipUp
                                            ? 'bottom-full mb-2'
                                            : 'top-full mt-2' 
                                            flipLeft ? 'right-full mr-2 origin-right'
                 : (flipRight ? 'left-full ml-2 origin-left'
                              : 'left-1/2 -translate-x-1/2 origin-center')"
                                        class="absolute left-1/2 -translate-x-1/2 w-56 bg-white rounded-lg shadow-lg p-4 text-sm text-gray-800 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none z-50"
                                    >
                                        <div class="h-14 w-full rounded mb-2" style="background-color: {{ $color->hex_code }}"></div>
                                        <p><span class="font-semibold">Name:</span> {{ $color->colour_name }}</p>
                                        <p><span class="font-semibold">Code:</span> {{ $color->colour_code }}</p>
                                    </div>
                                </div>
                            @endif
                        @endfor
                    </div>
                @endfor
            </div>
        </div>
        <p class="text-xs text-gray-500 italic mt-4">
        * Tidak menemukan warna yang Anda cari? mohon hubungi kami di 021 – 5030 0308
        </p>
</div>
@endsection

@push('styles')
    <style>
        .custom-scroll::-webkit-scrollbar {
            height: 10px;
        }
        .custom-scroll::-webkit-scrollbar-track {
            background: #d3d3d3;
        }
        .custom-scroll::-webkit-scrollbar-thumb {
            background-color: #000;
            border-radius: 5px;
        }
    </style>
@endpush