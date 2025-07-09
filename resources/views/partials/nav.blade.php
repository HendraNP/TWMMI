<nav class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="block w-32">
            <img src="{{ asset('images/logo.png') }}" alt="Company Logo" class="h-12 w-auto">
        </a>

        <!-- Centered Menu -->
        <ul class="hidden md:flex justify-center flex-1 space-x-16 text-gray-700 font-medium">
            <li><a href="{{ url('/') }}" class="hover:text-blue-600 transition">Home</a></li>
            <li class="relative group">
                <a href="#" class="inline-flex items-center hover:text-blue-600 transition">
                    Warna
                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </a>

                <!-- Dropdown Menu -->
                <ul class="absolute left-0 top-full mt-2 w-44 bg-white border border-gray-200 shadow-lg rounded-md opacity-0 invisible group-hover:visible group-hover:opacity-100 transition-opacity duration-200 z-50">
                    <li>
                        <a href="{{ url('/catalog/dinding') }}" class="block px-4 py-2 hover:bg-gray-100 transition">Cat Dinding</a>
                    </li>
                    <li>
                        <a href="{{ url('/catalog/epoxy') }}" class="block px-4 py-2 hover:bg-gray-100 transition">Cat Epoxy</a>
                    </li>
                    <li>
                        <a href="{{ url('/catalog/antikorosi') }}" class="block px-4 py-2 hover:bg-gray-100 transition">Cat Anti Korosi</a>
                    </li>
                </ul>
            </li>


            <li><a href="{{ url('/product') }}" class="hover:text-blue-600 transition">Product</a></li>
            <li><a href="{{ url('/about') }}" class="hover:text-blue-600 transition">About Us</a></li>
            <li><a href="{{ url('/contact') }}" class="hover:text-blue-600 transition">Contact Us</a></li>
        </ul>
        
        <!-- Right spacer to balance flexbox layout -->
        <div class="w-32 hidden md:block"></div>
    </div>
</nav>
