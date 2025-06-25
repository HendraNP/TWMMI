<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Readable Landing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-white text-gray-800">

    <!-- Hero Section -->
    <section class="text-center py-20 px-6 bg-white">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">Readable: Clarity Meets Design</h1>
            <p class="text-lg md:text-xl text-gray-600 mb-6">
                A sleek, high-converting landing page template for content-driven apps and startups.
            </p>
            <a href="#features" class="inline-block bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700 transition">
                Explore Features
            </a>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-16 bg-gray-50">
        <div class="max-w-5xl mx-auto px-6 grid md:grid-cols-3 gap-10 text-center">
            <div>
                <div class="text-blue-600 text-4xl mb-4">📚</div>
                <h3 class="text-xl font-semibold mb-2">Content First</h3>
                <p class="text-gray-600">Designed to showcase your product’s value with clarity and confidence.</p>
            </div>
            <div>
                <div class="text-blue-600 text-4xl mb-4">⚡</div>
                <h3 class="text-xl font-semibold mb-2">Fast & Responsive</h3>
                <p class="text-gray-600">Optimized for speed and mobile-first experiences.</p>
            </div>
            <div>
                <div class="text-blue-600 text-4xl mb-4">🎯</div>
                <h3 class="text-xl font-semibold mb-2">Conversion Focused</h3>
                <p class="text-gray-600">Built to drive action with clear calls to action and layout.</p>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-10">What People Are Saying</h2>
            <div class="grid md:grid-cols-2 gap-8">
                <div class="bg-gray-100 p-6 rounded shadow">
                    <p class="italic mb-4">"Readable helped us launch faster and look more professional from day one."</p>
                    <div class="font-semibold">— Alex, Startup Founder</div>
                </div>
                <div class="bg-gray-100 p-6 rounded shadow">
                    <p class="italic mb-4">"The layout is clean, intuitive, and just works. Highly recommend!"</p>
                    <div class="font-semibold">— Jamie, Product Designer</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-20 bg-blue-600 text-white text-center">
        <h2 class="text-3xl font-bold mb-4">Ready to Launch?</h2>
        <p class="mb-6">Start building your content-driven app with Readable today.</p>
        <a href="#" class="bg-white text-blue-600 px-6 py-3 rounded font-semibold hover:bg-gray-100 transition">
            Get Started
        </a>
    </section>

    <!-- Footer -->
    <footer class="py-8 bg-gray-900 text-gray-400 text-center text-sm">
        <p>&copy; {{ date('Y') }} Readable. All rights reserved.</p>
    </footer>

</body>
</html>
