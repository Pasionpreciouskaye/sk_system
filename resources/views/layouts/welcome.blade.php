<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SK kagawad portal</title>

    <!-- External resources -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://kit.fontawesome.com/4f2d7302b1.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/css/splide.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>

<body class="antialiased">

@php
    $currentRoute = Request::route()->getName();

    // Pages that only show content (no header/footer)
    $contentOnlyRoutes = ['login', 'forgot-password', 'reset-password'];

    // Pages that show alternate section header + main footer
    $sectionPages = [
        'contact' => 'Contact Us',
        'project' => 'Projects',
        'event' => 'Events',
        'budget' => 'Budget Transparency',
        'inventory' => 'Inventory'
    ];
@endphp

@if (in_array($currentRoute, $contentOnlyRoutes))
    {{-- Pages with no header/footer --}}
    <main>
        @yield('content')
    </main>

@elseif ($currentRoute === 'home')
    {{-- Homepage: Main header/footer --}}
    <nav class="sticky top-0 z-80 bg-white shadow-md" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ route('home') }}" class="flex items-center">
                    <img src="{{ asset('images/logo/sk-logo.png') }}" alt="SK Logo" class="h-15 w-auto" />
                </a>
                <div class="md:hidden">
                    <button @click="open = !open" class="text-gray-700 focus:outline-none">
                        <i :class="open ? 'fa-solid fa-xmark' : 'fa-solid fa-bars'"></i>
                    </button>
                </div>

                <div class="hidden md:flex space-x-6 items-center">
                    {{-- Home link added before menubar links --}}
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-pink-500">Home</a>
                    <a href="{{ route('contact') }}" class="text-gray-700 hover:text-pink-500">Contact</a>
                    @if (Auth::user())
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-pink-500"><i class="fa-solid fa-right-to-bracket"></i></a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-pink-500"><i class="fa-solid fa-right-to-bracket"></i></a>
                    @endif
                </div>
            </div>

            <div x-show="open" x-transition class="md:hidden mt-2 p-5 space-y-2">
                <a href="{{ route('home') }}" class="block text-gray-700 hover:text-pink-500">Home</a>
                <a href="{{ route('contact') }}" class="block text-gray-700 hover:text-pink-500">Contact</a>
                <a href="{{ route('login') }}" class="block text-gray-700 hover:text-pink-500"><i class="fa-solid fa-right-to-bracket"></i></a>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    {{-- Main footer --}}
    <footer class="bg-gray-900 text-gray-200 pt-12 pb-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="flex justify-center mb-4">
                    <img src="{{ asset('images/logo/sk-logo.png') }}" alt="SK Logo" class="w-24" />
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
                    <li><a href="{{ route('inventory') }}" class="hover:text-pink-400 transition">Inventory</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-pink-400 transition">Contact</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-lg font-semibold text-white mb-3">Follow Us</h4>
                <div class="flex space-x-4">
                    <a href="https://www.facebook.com/share/1CCZCxp7Mu/?mibextid=wwXIfr" class="text-gray-400 hover:text-pink-400 transition" target="_blank" rel="noopener noreferrer">
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

@elseif (array_key_exists($currentRoute, $sectionPages))
    {{-- Section pages: alternate header + main footer --}}
    <nav class="sticky top-0 z-80 bg-white shadow-md" x-data="{ open: false, dropdownOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ route('home') }}" class="flex items-center">
                    <img src="{{ asset('images/logo/sk-logo.png') }}" alt="SK Logo" class="h-15 w-auto" />
                </a>
                <div class="relative flex items-center space-x-4">
                    {{-- Home link added before dropdown --}}
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-pink-500 font-semibold">Home</a>

                    <div>
                        <button @click="dropdownOpen = !dropdownOpen" class="text-gray-700 hover:text-pink-500 font-semibold">
                            {{ $sectionPages[$currentRoute] }} <i class="fa-solid fa-chevron-down ml-1"></i>
                        </button>
                        <div x-show="dropdownOpen" @click.away="dropdownOpen = false"
                            class="absolute left-0 mt-2 w-56 bg-white shadow-lg rounded-lg z-50 py-2">
                            @foreach ($sectionPages as $route => $label)
                                @if ($route !== $currentRoute)
                                    <a href="{{ route($route) }}" class="block px-4 py-2 text-gray-700 hover:bg-pink-100 hover:text-pink-500 transition">{{ $label }}</a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    {{-- Main footer --}}
    <footer class="bg-gray-900 text-gray-200 pt-12 pb-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="flex justify-center mb-4">
                    <img src="{{ asset('images/logo/sk-logo.png') }}" alt="SK Logo" class="w-24" />
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
                    <li><a href="{{ route('inventory') }}" class="hover:text-pink-400 transition">Inventory</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-pink-400 transition">Contact</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-lg font-semibold text-white mb-3">Follow Us</h4>
                <div class="flex space-x-4">
                    <a href="https://www.facebook.com/share/1CCZCxp7Mu/?mibextid=wwXIfr" class="text-gray-400 hover:text-pink-400 transition" target="_blank" rel="noopener noreferrer">
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

@else
    {{-- Fallback default (in case of undefined route) --}}
    <main>
        @yield('content')
    </main>
@endif

</body>

</html>
