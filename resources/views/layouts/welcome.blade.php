<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SK kagawad portal</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://kit.fontawesome.com/4f2d7302b1.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/css/splide.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>

<body class="antialiased">

@if (Request::is('login') || Request::is('forgot-password') || Request::is('reset-password*'))
    <main>
        @yield('content')
    </main>
    @else
    <nav class="sticky top-0 z-50 bg-white shadow-md" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ route('home') }}" class="flex items-center">
                    <img src="{{ asset('images/logo/sk-logo.png') }}" alt="SK Logo" class="h-10 w-auto">
                </a>
                <div class="md:hidden">
                    <button @click="open = !open" class="text-gray-700 focus:outline-none">
                        <i :class="open ? 'fa-solid fa-xmark' : 'fa-solid fa-bars'"></i>
                    </button>
                </div>

                <div class="hidden md:flex space-x-6">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-pink-500">Home</a>
                    <a href="{{ route('contact') }}" class="text-gray-700 hover:text-pink-500">Contact</a>
                    @if (Auth::user())
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-pink-500"><i
                            class="fa-solid fa-right-to-bracket"></i></a>
                    @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-pink-500"><i
                            class="fa-solid fa-right-to-bracket"></i></a>
                    @endif
                </div>
            </div>

            <div x-show="open" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95" class="md:hidden mt-2 p-5 space-y-2">
                <a href="{{ route('home') }}" class="block text-gray-700 hover:text-pink-500">Home</a>
                <a href="{{ route('contact') }}" class="block text-gray-700 hover:text-pink-500">Contact</a>
                <a href="{{ route('login') }}" class="block text-gray-700 hover:text-pink-500"><i
                        class="fa-solid fa-right-to-bracket"></i></a>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-gray-900 text-gray-200 pt-12 pb-8">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="flex justify-center mb-4">
                    <img src="{{ asset('images/logo/sk-logo.png') }}" alt="SK Logo" class="w-24">
                </div>
                <h3 class="text-xl font-bold text-white mb-3">Sangguniang Kabataan</h3>
                <p class="text-sm text-gray-400">
                    Empowering the youth to lead, serve, and build a more inclusive and progressive barangay.
                </p>
            </div>

            <div>
                <h4 class="text-lg font-semibold text-white mb-3">Quick Links</h4>
                <ul class="space-y-2 text-sm text-gray-300">
                    <li><a href="{{ route('home') }}" class="hover:text-pink-400 transition">Home</a></li>
                    <li><a href="{{ route('project') }}" class="hover:text-pink-400 transition">Projects</a></li>
                    <li><a href="{{ route('event') }}" class="hover:text-pink-400 transition">Events</a></li>
                    <li><a href="{{ route('budget') }}" class="hover:text-pink-400 transition">Budget</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-pink-400 transition">Contact</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-lg font-semibold text-white mb-3">Follow Us</h4>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-pink-400 transition">
                        <i class="fab fa-facebook fa-lg"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-pink-400 transition">
                        <i class="fab fa-twitter fa-lg"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-pink-400 transition">
                        <i class="fab fa-instagram fa-lg"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-pink-400 transition">
                        <i class="fab fa-youtube fa-lg"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-700 mt-10 pt-6 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} Sangguniang Kabataan. All rights reserved.
        </div>
    </footer>
    @endif
</body>

</html>