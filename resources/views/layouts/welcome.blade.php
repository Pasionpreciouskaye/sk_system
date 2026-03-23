<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" id="html-root">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SK kagawad portal</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        skin: {
                            base: 'var(--color-base)',
                            'base-alt': 'var(--color-base-alt)',
                            section: 'var(--color-section)',
                            card: 'var(--color-card)',
                            sidebar: 'var(--color-sidebar)',
                            hover: 'var(--color-hover)',
                            divider: 'var(--color-divider)',
                            border: 'var(--color-border)',
                            'border-strong': 'var(--color-border-strong)',
                            accent: 'var(--color-accent)',
                            'text-primary': 'var(--color-text-primary)',
                            'text-secondary': 'var(--color-text-secondary)',
                            'text-muted': 'var(--color-text-muted)',
                            'modal-bg': 'var(--color-modal-bg)',
                            'dropdown-bg': 'var(--color-dropdown-bg)',
                        }
                    }
                }
            }
        }
    </script>
    </script>
    <style>
        /* ── LIGHT MODE ── */
        :root {
            --color-base: #FFFFFF;
            --color-base-alt: #FFF7FA;
            --color-section: #FDF2F8;
            --color-card: #FFF1F5;
            --color-sidebar: #FCE4EC;
            --color-hover: #F8BBD0;
            --color-divider: #F3F4F6;
            --color-border: #FBCFE8;
            --color-border-strong: #F472B6;
            --color-accent: #E91E63;
            --color-text-primary: #1F2937;
            --color-text-secondary: #6B7280;
            --color-text-muted: #9CA3AF;
            --color-modal-bg: #FFFFFF;
            --color-dropdown-bg: #FFFFFF;
        }

        /* ── DARK MODE ── */
        .dark {
            --color-base: #0F1B2D;
            --color-base-alt: #162338;
            --color-section: #1B2A41;
            --color-card: #162338;
            --color-card-elevated: #1B2A41;
            --color-sidebar: #1B2A41;
            --color-hover: #24344D;
            --color-hover-strong: #2E3F5B;
            --color-divider: #1F2A44;
            --color-border: #2A3B55;
            --color-border-strong: #3B4D6B;
            --color-accent: #E91E63;
            --color-accent-soft: #F472B6;
            --color-accent-glow: rgba(233, 30, 99, 0.25);
            --color-text-primary: #F9FAFB;
            --color-text-secondary: #D1D5DB;
            --color-text-muted: #9CA3AF;
            --color-modal-bg: #1B2A41;
            --color-dropdown-bg: #162338;
        }

        /* ── TRANSITIONS ── */
        *,
        *::before,
        *::after {
            transition: background-color 0.3s ease, color 0.2s ease, border-color 0.3s ease, box-shadow 0.3s ease;
        }

        /* ── DARK: layered depth for cards/grids ── */
        .dark .bg-white,
        .dark .bg-gray-50,
        .dark .bg-gray-100,
        .dark .bg-gray-200 {
            background-color: var(--color-card) !important;
        }

        .dark .rounded-lg,
        .dark .rounded-xl,
        .dark .rounded-2xl {
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.4), 0 1px 4px rgba(0, 0, 0, 0.3) !important;
        }

        .dark [class*="hover:-translate"]:hover {
            background-color: var(--color-hover) !important;
        }

        .dark .border,
        .dark .border-t,
        .dark .border-b,
        .dark [class*="border-gray"] {
            border-color: var(--color-border) !important;
        }

        .dark input:focus,
        .dark select:focus,
        .dark textarea:focus {
            box-shadow: 0 0 0 3px var(--color-accent-glow) !important;
            border-color: var(--color-accent) !important;
        }

        body {
            background-color: var(--color-base);
            color: var(--color-text-primary);
        }

        .dark body,
        .dark * {
            color: var(--color-text-primary);
        }

        /* ── DARK MODE: override hardcoded Tailwind bg/text classes ── */
        .dark .bg-white,
        .dark .bg-gray-50,
        .dark .bg-gray-100,
        .dark .bg-gray-200 {
            background-color: var(--color-card) !important;
        }

        .dark .text-gray-800,
        .dark .text-gray-900,
        .dark .text-gray-700,
        .dark .text-gray-600,
        .dark .text-black {
            color: #F9FAFB !important;
        }

        .dark .text-gray-500,
        .dark .text-gray-400 {
            color: #D1D5DB !important;
        }

        .dark .border-gray-200,
        .dark .border-gray-300 {
            border-color: var(--color-border) !important;
        }

        .dark .shadow,
        .dark .shadow-lg,
        .dark .shadow-sm {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.5) !important;
        }

        /* Navbar */
        .sk-nav {
            background-color: var(--color-sidebar);
            border-bottom: 1px solid var(--color-border);
        }

        .sk-nav a,
        .sk-nav button {
            color: var(--color-text-secondary);
        }

        .sk-nav a:hover,
        .sk-nav button:hover {
            color: var(--color-accent);
        }

        /* Active nav link */
        .sk-nav a.nav-active {
            color: var(--color-accent) !important;
            font-weight: 700;
            border-bottom: 2px solid var(--color-accent);
            padding-bottom: 2px;
        }

        /* Dropdown */
        .sk-dropdown {
            background-color: var(--color-dropdown-bg);
            border: 1px solid var(--color-border);
        }

        .sk-dropdown a {
            color: var(--color-text-primary);
        }

        .sk-dropdown a:hover {
            background-color: var(--color-hover);
            color: var(--color-accent);
        }

        /* Cards */
        .sk-card {
            background-color: var(--color-card);
            border: 1px solid var(--color-border);
        }

        /* Inputs */
        input,
        select,
        textarea {
            background-color: var(--color-base);
            color: var(--color-text-primary);
            border-color: var(--color-border);
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: var(--color-accent);
            outline: none;
        }

        /* Buttons */
        .btn-primary {
            background-color: var(--color-accent);
            color: #fff;
        }

        .btn-primary:hover {
            opacity: 0.9;
        }

        /* ── FOOTER ── */
        .sk-footer {
            background: linear-gradient(180deg, #162338 0%, #1B2A41 20%, #2A1A2F 50%, #111827 75%, #0B1220 100%);
            color: #D1D5DB;
            border-top: 2px solid #2A3B55;
            transition: background 0.3s ease, border-color 0.3s ease;
        }

        /* Light mode footer stays dark (it's always a dark footer) */
        :root .sk-footer {
            background: linear-gradient(180deg, #1e293b 0%, #111827 60%, #0B1220 100%);
            border-top: 2px solid #2A3B55;
        }

        .sk-footer a:hover {
            color: #E91E63 !important;
            transition: color 0.2s ease;
        }

        .sk-footer-divider {
            border-color: #1F2A44;
        }

        /* ── PAGE TRANSITION LOADER ── */
        #page-loader {
            position: fixed;
            inset: 0;
            z-index: 9999;
            background: #0F1B2D;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.4s ease;
        }

        #page-loader.fade-out {
            opacity: 0;
            pointer-events: none;
        }

        .loader-ring {
            width: 48px;
            height: 48px;
            border: 4px solid #2A3B55;
            border-top-color: #E91E63;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Pagination */
        .pagination-active {
            background-color: var(--color-accent);
            color: #fff;
        }

        .pagination-link {
            color: var(--color-accent);
        }

        .pagination-disabled {
            color: var(--color-text-muted);
            background-color: var(--color-card);
        }

        /* ── DARK MODE: CMS Modals ── */
        .dark .cms-modal {
            background-color: #1B2A41 !important;
            border: 1px solid #2A3B55 !important;
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.7) !important;
            color: #F9FAFB !important;
        }

        .dark .cms-modal h2 {
            color: #E91E63 !important;
        }

        .dark .cms-modal label {
            color: #D1D5DB !important;
        }

        .dark .cms-modal input,
        .dark .cms-modal select,
        .dark .cms-modal textarea {
            background-color: #162338 !important;
            border-color: #2A3B55 !important;
            color: #F9FAFB !important;
        }

        .dark .cms-modal input:focus,
        .dark .cms-modal select:focus,
        .dark .cms-modal textarea:focus {
            border-color: #E91E63 !important;
            box-shadow: 0 0 0 3px rgba(233, 30, 99, 0.25) !important;
        }

        .dark .cms-modal .border-b,
        .dark .cms-modal .border-gray-200 {
            border-color: #2A3B55 !important;
        }

        .dark .cms-modal p,
        .dark .cms-modal span {
            color: #D1D5DB !important;
        }
    </style>
    <script src="https://kit.fontawesome.com/4f2d7302b1.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/css/splide.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        if (localStorage.getItem('user-theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>

<body class="antialiased transition-colors duration-200">

    @php
        $currentRoute = Request::route()->getName();
        $contentOnlyRoutes = ['login', 'forgot-password', 'reset-password'];
        $sectionPages = [
            'contact' => 'Contact Us',
            'project' => 'Projects',
            'event' => 'Events',
            'budget' => 'Budget Transparency',
            'inventory' => 'Inventory',
        ];
    @endphp

    @if (in_array($currentRoute, $contentOnlyRoutes))
        <main>@yield('content')</main>
    @elseif ($currentRoute === 'home')
        <nav class="sk-nav sticky top-0 z-50 shadow-md transition-colors duration-200" x-data="{ open: false }">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-3">
                        <img src="{{ asset('images/logo/sk-logo.png') }}" alt="SK Logo"
                            class="h-10 w-10 object-contain rounded-full">
                        <div>
                            <h2 class="text-xl font-bold leading-tight" style="color:var(--color-accent)">SK Portal</h2>
                            <p class="text-sm" style="color:var(--color-text-muted)">Sangguniang Kabataan</p>
                        </div>
                    </a>
                    <div class="md:hidden flex items-center gap-3">
                        <button
                            onclick="const html=document.getElementById('html-root');const isDark=html.classList.toggle('dark');localStorage.setItem('user-theme',isDark?'dark':'light');"
                            style="color:var(--color-text-muted)">
                            <i class="fas fa-moon dark:hidden"></i>
                            <i class="fas fa-sun hidden dark:inline" style="color:#FBBF24"></i>
                        </button>
                        <button @click="open = !open" style="color:var(--color-text-primary)">
                            <i :class="open ? 'fa-solid fa-xmark' : 'fa-solid fa-bars'"></i>
                        </button>
                    </div>
                    <div class="hidden md:flex space-x-6 items-center">
                        <a href="{{ route('home') }}" class="nav-active transition hover:text-[#E91E63]">Home</a>
                        <a href="{{ route('contact') }}" class="transition hover:text-[#E91E63]">Contact</a>
                        @auth
                            @if (Auth::user()->email === 'Barangaytanyag@gmail.com')
                                <a href="{{ route('dashboard') }}" title="Go to Admin"
                                    class="flex items-center px-3 py-1.5 rounded-lg text-white bg-[#E91E63] hover:bg-[#F472B6] active:bg-[#BE185D] hover:shadow-[0_0_10px_rgba(233,30,99,0.4)] transition-all duration-200 text-sm font-medium">
                                    <i class="fa-solid fa-right-to-bracket"></i>
                                </a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" title="Login"
                                class="flex items-center gap-2 px-3 py-1.5 rounded-lg text-white bg-[#E91E63] hover:bg-[#F472B6] active:bg-[#BE185D] hover:shadow-[0_0_10px_rgba(233,30,99,0.4)] transition-all duration-200 text-sm font-medium">
                                <i class="fa-solid fa-right-to-bracket"></i>
                                <span>Login</span>
                            </a>
                        @endauth
                        <button
                            onclick="const html=document.getElementById('html-root');const isDark=html.classList.toggle('dark');localStorage.setItem('user-theme',isDark?'dark':'light');"
                            style="color:var(--color-text-muted)" title="Toggle dark mode">
                            <i class="fas fa-moon dark:hidden"></i>
                            <i class="fas fa-sun hidden dark:inline" style="color:#FBBF24"></i>
                        </button>
                    </div>
                </div>
                <div x-show="open" x-transition class="md:hidden mt-2 p-5 space-y-2">
                    <a href="{{ route('home') }}" class="block transition hover:text-[#E91E63]">Home</a>
                    <a href="{{ route('contact') }}" class="block transition hover:text-[#E91E63]">Contact</a>
                    @auth
                        @if (Auth::user()->email === 'Barangaytanyag@gmail.com')
                            <a href="{{ route('dashboard') }}" title="Go to Admin"
                                class="inline-flex items-center px-3 py-1.5 rounded-lg text-white bg-[#E91E63] hover:bg-[#F472B6] active:bg-[#BE185D] hover:shadow-[0_0_10px_rgba(233,30,99,0.4)] transition-all duration-200 text-sm font-medium">
                                <i class="fa-solid fa-right-to-bracket"></i>
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" title="Login"
                            class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-white bg-[#E91E63] hover:bg-[#F472B6] active:bg-[#BE185D] transition-all duration-200 text-sm font-medium">
                            <i class="fa-solid fa-right-to-bracket"></i>
                            <span>Login</span>
                        </a>
                    @endauth
                </div>
            </div>
        </nav>

        <main>@yield('content')</main>

        @include('components.footer')
    @elseif (array_key_exists($currentRoute, $sectionPages))
        <nav class="sk-nav sticky top-0 z-50 shadow-md transition-colors duration-200" x-data="{ open: false, dropdownOpen: false }">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-3">
                        <img src="{{ asset('images/logo/sk-logo.png') }}" alt="SK Logo"
                            class="h-10 w-10 object-contain rounded-full">
                        <div>
                            <h2 class="text-xl font-bold leading-tight" style="color:var(--color-accent)">SK Portal
                            </h2>
                            <p class="text-sm" style="color:var(--color-text-muted)">Sangguniang Kabataan</p>
                        </div>
                    </a>
                    <div class="relative flex items-center space-x-4">
                        <a href="{{ route('home') }}" class="font-semibold transition hover:text-[#E91E63]">Home</a>
                        <div class="relative">
                            <button @click="dropdownOpen = !dropdownOpen"
                                class="font-semibold flex items-center gap-1 px-3 py-1.5 rounded-lg transition-all duration-200"
                                style="background-color:var(--color-accent);color:#fff;">
                                {{ $sectionPages[$currentRoute] }} <i
                                    class="fa-solid fa-chevron-down ml-1 text-xs"></i>
                            </button>
                            <div x-show="dropdownOpen" @click.away="dropdownOpen = false"
                                class="sk-dropdown absolute left-0 mt-2 w-56 shadow-lg rounded-lg z-50 py-2">
                                @foreach ($sectionPages as $route => $label)
                                    @if ($route !== $currentRoute)
                                        <a href="{{ route($route) }}"
                                            class="block px-4 py-2 transition hover:text-[#E91E63]">{{ $label }}</a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        @auth
                            @if (Auth::user()->email === 'Barangaytanyag@gmail.com')
                                <a href="{{ route('dashboard') }}" title="Go to Admin"
                                    class="flex items-center px-3 py-1.5 rounded-lg text-white bg-[#E91E63] hover:bg-[#F472B6] active:bg-[#BE185D] hover:shadow-[0_0_10px_rgba(233,30,99,0.4)] transition-all duration-200 text-sm font-medium">
                                    <i class="fa-solid fa-right-to-bracket"></i>
                                </a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" title="Login"
                                class="flex items-center gap-2 px-3 py-1.5 rounded-lg text-white bg-[#E91E63] hover:bg-[#F472B6] active:bg-[#BE185D] hover:shadow-[0_0_10px_rgba(233,30,99,0.4)] transition-all duration-200 text-sm font-medium">
                                <i class="fa-solid fa-right-to-bracket"></i>
                                <span>Login</span>
                            </a>
                        @endauth
                        <button
                            onclick="const html=document.getElementById('html-root');const isDark=html.classList.toggle('dark');localStorage.setItem('user-theme',isDark?'dark':'light');"
                            style="color:var(--color-text-muted)" title="Toggle dark mode">
                            <i class="fas fa-moon dark:hidden"></i>
                            <i class="fas fa-sun hidden dark:inline" style="color:#FBBF24"></i>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <main>@yield('content')</main>

        @include('components.footer')
    @else
        <main>@yield('content')</main>
    @endif

    {{-- Page transition loader --}}
    <div id="page-loader">
        <div class="loader-ring"></div>
    </div>
    <script>
        window.addEventListener('load', function() {
            const loader = document.getElementById('page-loader');
            loader.classList.add('fade-out');
            setTimeout(() => loader.remove(), 450);
        });
    </script>

</body>

</html>
