<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Your Site')</title>
    @vite(['resources/css/app.css', 'resources/js/app.tsx', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-white text-gray-900">
    {{-- Optional navbar --}}
    @include('partials.nav')

    <main>
        @yield('content')
    </main>

    {{-- Optional footer --}}
    @include('partials.footer')
</body>
</html>
