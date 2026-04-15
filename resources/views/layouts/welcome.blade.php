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
            --color-base: #F9FAFB;
            --color-base-alt: #FFFFFF;
            --color-section: #F3F4F6;
            --color-card: #FFFFFF;
            --color-sidebar: #FFF1F5;
            --color-hover: #FCE4EC;
            --color-divider: #F3F4F6;
            --color-border: #FBCFE8;
            --color-border-strong: #FB7185;
            --color-accent: #E11D48;
            --color-text-primary: #1F2937;
            --color-text-secondary: #6B7280;
            --color-text-muted: #9CA3AF;
            --color-modal-bg: #FFFFFF;
            --color-dropdown-bg: #FFFFFF;
        }

        /* ── DARK MODE ── */
        .dark {
            --color-base: #0F172A;
            --color-base-alt: #1E293B;
            --color-section: #1E293B;
            --color-card: #1E293B;
            --color-card-elevated: #273549;
            --color-sidebar: #1E293B;
            --color-hover: #273549;
            --color-hover-strong: #334155;
            --color-divider: #1E293B;
            --color-border: #334155;
            --color-border-strong: #475569;
            --color-accent: #F43F5E;
            --color-accent-soft: #FB7185;
            --color-accent-glow: rgba(244, 63, 94, 0.25);
            --color-text-primary: #F9FAFB;
            --color-text-secondary: #94A3B8;
            --color-text-muted: #64748B;
            --color-modal-bg: #1E293B;
            --color-dropdown-bg: #1E293B;
        }

        /* ── TRANSITIONS ── */
        [x-cloak] { display: none !important; }
        *,
        *::before,
        *::after {
            transition: background-color 0.3s ease, color 0.2s ease, border-color 0.3s ease, box-shadow 0.3s ease;
        }

        body {
            background-color: var(--color-base);
            color: var(--color-text-primary);
        }

        /* ── DARK MODE ── */
        /* Page & section backgrounds */
        .dark body { background-color: #0F172A !important; color: #F9FAFB !important; }
        .dark .sk-section-base { background-color: #0F172A !important; }
        .dark .sk-section-alt  { background-color: #1E293B !important; }

        /* Cards */
        .dark .sk-card-inner {
            background-color: #1E293B !important;
            color: #F9FAFB !important;
            border-color: #334155 !important;
        }
        .dark .sk-card-inner p { color: #94A3B8 !important; }

        /* Generic bg overrides */
        .dark .bg-white  { background-color: #1E293B !important; }
        .dark .bg-gray-50,
        .dark .bg-gray-100 { background-color: #0F172A !important; }

        /* Text overrides */
        .dark .text-gray-700,
        .dark .text-gray-600,
        .dark .text-gray-800,
        .dark .text-gray-900,
        .dark .text-black { color: #F9FAFB !important; }
        .dark .text-gray-500,
        .dark .text-gray-400 { color: #94A3B8 !important; }

        /* Borders */
        .dark .border-gray-100,
        .dark .border-gray-200,
        .dark .border-gray-300 { border-color: #334155 !important; }

        /* Shadows */
        .dark .shadow,
        .dark .shadow-md,
        .dark .shadow-lg,
        .dark .shadow-sm { box-shadow: 0 2px 12px rgba(0,0,0,0.6) !important; }

        /* Focus */
        .dark input:focus,
        .dark select:focus,
        .dark textarea:focus {
            box-shadow: 0 0 0 3px rgba(244,63,94,0.25) !important;
            border-color: #F43F5E !important;
        }

        /* ── LIGHT MODE: base styles ── */
        .sk-section-base { background-color: #F9FAFB; }
        .sk-section-alt  { background-color: #FFFFFF; }
        :root .bg-gray-100,
        :root .bg-gray-50 { background-color: #F3F4F6 !important; }
        :root .bg-white   { background-color: #FFFFFF !important; }
        :root .sk-card-inner { background-color: #FFFFFF; color: #1F2937; }

        /* Navbar */
        .sk-nav {
            background-color: #FFFFFF;
            border-bottom: 2px solid #FBCFE8;
        }

        .sk-nav a,
        .sk-nav button {
            color: #1F2937;
        }

        .sk-nav a:hover,
        .sk-nav button:hover {
            color: #E11D48;
        }

        /* Dark mode nav */
        .dark .sk-nav {
            background-color: #1E293B !important;
            border-bottom: 1px solid #334155 !important;
        }

        .dark .sk-nav a,
        .dark .sk-nav button {
            color: #94A3B8 !important;
        }

        .dark .sk-nav a:hover,
        .dark .sk-nav button:hover {
            color: #F43F5E !important;
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
        /* Light mode: Rose Red footer matching the design mockup */
        .sk-footer {
            background: #E11D48;
            color: #FFFFFF;
            border-top: none;
            transition: background 0.3s ease, border-color 0.3s ease;
        }

        .sk-footer h3,
        .sk-footer h4 {
            color: #FFFFFF !important;
        }

        .sk-footer p,
        .sk-footer ul,
        .sk-footer a {
            color: rgba(255,255,255,0.85) !important;
        }

        .sk-footer a:hover {
            color: #F59E0B !important;
            transition: color 0.2s ease;
        }

        .sk-footer-divider {
            border-color: rgba(255,255,255,0.2);
            color: rgba(255,255,255,0.7) !important;
        }

        /* Dark mode footer: stays Rose Red like light mode (per design reference) */
        .dark .sk-footer {
            background: #E11D48 !important;
            border-top: none !important;
            color: rgba(255,255,255,0.85) !important;
        }

        .dark .sk-footer h3,
        .dark .sk-footer h4 {
            color: #FFFFFF !important;
        }

        .dark .sk-footer p,
        .dark .sk-footer ul,
        .dark .sk-footer a {
            color: rgba(255,255,255,0.85) !important;
        }

        .dark .sk-footer a:hover {
            color: #F59E0B !important;
        }

        .dark .sk-footer-divider {
            border-color: rgba(255,255,255,0.2) !important;
            color: rgba(255,255,255,0.7) !important;
        }

        /* ── SEARCH BAR ── */
        .sk-search-wrap {
            display: flex;
            align-items: center;
            gap: 8px;
            width: 100%;
            margin-bottom: 1.5rem;
        }
        .sk-search-input {
            flex: 1;
            padding: 0.65rem 1.1rem;
            border-radius: 999px;
            border: 1.5px solid var(--color-border);
            background: var(--color-card);
            color: var(--color-text-primary);
            font-size: 0.95rem;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
            box-shadow: inset 0 1px 4px rgba(0,0,0,0.08);
        }
        .sk-search-input::placeholder { color: var(--color-text-muted); }
        .sk-search-input:focus {
            border-color: var(--color-accent);
            box-shadow: 0 0 0 3px rgba(233,30,99,0.15), inset 0 1px 4px rgba(0,0,0,0.08);
        }
        .sk-mic-btn {
            flex-shrink: 0;
            width: 40px; height: 40px;
            border-radius: 50%;
            border: 1.5px solid var(--color-border);
            background: var(--color-card);
            color: var(--color-accent);
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            transition: background 0.2s, box-shadow 0.2s;
            font-size: 0.95rem;
        }
        .sk-mic-btn:hover {
            background: var(--color-hover);
            box-shadow: 0 0 8px rgba(233,30,99,0.25);
        }
        .sk-mic-btn.listening {
            background: rgba(233,30,99,0.15);
            box-shadow: 0 0 0 3px rgba(233,30,99,0.3);
            animation: mic-pulse 1s infinite;
        }
        @keyframes mic-pulse {
            0%, 100% { box-shadow: 0 0 0 3px rgba(233,30,99,0.3); }
            50% { box-shadow: 0 0 0 6px rgba(233,30,99,0.1); }
        }

        /* DataTable search override */
        .dataTables_filter {
            display: flex;
            align-items: center;
            width: 100%;
        }
        .dataTables_filter label {
            display: flex;
            align-items: center;
            gap: 8px;
            width: 100%;
            font-size: 0;
        }
        .dataTables_filter label > span,
        .dataTables_filter label::before { display: none; }
        .dataTables_filter input {
            flex: 1 !important;
            width: 100% !important;
            padding: 0.65rem 1.1rem !important;
            border-radius: 999px !important;
            border: 1.5px solid var(--color-border) !important;
            background: var(--color-card) !important;
            color: var(--color-text-primary) !important;
            font-size: 0.95rem !important;
            outline: none !important;
            box-shadow: inset 0 1px 4px rgba(0,0,0,0.08) !important;
            transition: border-color 0.2s, box-shadow 0.2s !important;
            margin: 0 !important;
        }
        .dataTables_filter input::placeholder { color: var(--color-text-muted) !important; }
        .dataTables_filter input:focus {
            border-color: var(--color-accent) !important;
            box-shadow: 0 0 0 3px rgba(233,30,99,0.15) !important;
        }
        .dataTables_wrapper .flex.justify-between { flex-wrap: wrap; gap: 8px; }
        .dataTables_wrapper .dataTables_filter { flex: 1; min-width: 0; }
        .dt-mic-btn {
            flex-shrink: 0;
            width: 36px; height: 36px;
            border-radius: 50%;
            border: 1.5px solid var(--color-border);
            background: var(--color-card);
            color: var(--color-accent);
            cursor: pointer;
            display: inline-flex; align-items: center; justify-content: center;
            transition: background 0.2s, box-shadow 0.2s;
            font-size: 0.85rem;
            vertical-align: middle;
        }
        .dt-mic-btn:hover {
            background: var(--color-hover);
            box-shadow: 0 0 8px rgba(233,30,99,0.25);
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

        /* ── THEME PILL TOGGLE ── */
        .theme-pill-btn {
            position: relative;
            width: 44px; height: 24px;
            border-radius: 999px;
            border: none; cursor: pointer; padding: 0; outline: none;
            background: #1B2A41;
            box-shadow: 0 0 0 2px #E91E63;
            transition: background 0.3s ease, box-shadow 0.3s ease;
            flex-shrink: 0;
        }
        /* knob */
        .theme-pill-btn::before {
            content: '';
            position: absolute;
            top: 3px; right: 3px;
            width: 18px; height: 18px;
            border-radius: 50%;
            background: #E91E63;
            transition: right 0.3s ease, left 0.3s ease, background 0.3s ease;
        }
        /* icon on track */
        .theme-pill-btn::after {
            content: '🌙';
            position: absolute;
            top: 50%; left: 5px;
            transform: translateY(-50%);
            font-size: 11px; line-height: 1;
        }
        /* light mode state */
        .theme-pill-btn[data-dark="0"] {
            background: #F8BBD0;
            box-shadow: 0 0 0 2px #E91E63;
        }
        .theme-pill-btn[data-dark="0"]::before {
            right: auto; left: 3px;
            background: #E91E63;
        }
        .theme-pill-btn[data-dark="0"]::after {
            content: '☀️';
            left: auto; right: 5px;
        }
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
    <script>
        // Sync pill state after DOM ready
        document.addEventListener('DOMContentLoaded', function() {
            var isDark = document.documentElement.classList.contains('dark');
            document.querySelectorAll('.user-theme-pill').forEach(function(b) {
                b.setAttribute('data-dark', isDark ? '1' : '0');
            });
        });
    </script>
</head>

<body class="antialiased transition-colors duration-200">

    @php
        $currentRoute = Request::route()->getName();
        $contentOnlyRoutes = ['login', 'forgot-password', 'reset-password'];
        $sectionPages = [
            'contact' => 'Contact Us',
            'project' => 'Projects',
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
                        <button id="user-theme-toggle-mobile"
                            onclick="const html=document.getElementById('html-root');const isDark=html.classList.toggle('dark');localStorage.setItem('user-theme',isDark?'dark':'light');document.querySelectorAll('.user-theme-pill').forEach(function(b){b.setAttribute('data-dark',isDark?'1':'0')});"
                            class="theme-pill-btn user-theme-pill" data-dark="0" title="Toggle dark mode">
                        </button>
                        <button @click="open = !open" style="color:var(--color-text-primary);background:none;border:none;cursor:pointer;padding:4px;">
                            <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                            <svg x-show="open" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        </button>
                    </div>
                    <div class="hidden md:flex space-x-6 items-center">
                        <a href="{{ route('home') }}" class="nav-active transition hover:text-[#E91E63]">Home</a>
                        <a href="{{ route('contact') }}" class="transition hover:text-[#E91E63]">Contact</a>
                        @auth
                            @if (Auth::user()->email === 'Barangaytanyag@gmail.com')
                                <a href="{{ route('dashboard') }}" title="Go to Admin"
                                    class="flex items-center justify-center rounded-full transition-all duration-200 hover:scale-110 hover:shadow-[0_0_12px_rgba(233,30,99,0.5)]"
                                    style="width:30px;height:30px;background:#E91E63;flex-shrink:0;">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="#fff" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                                </a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" title="Login"
                                class="flex items-center gap-2 px-3 py-1.5 rounded-lg text-white bg-[#E91E63] hover:bg-[#F472B6] active:bg-[#BE185D] hover:shadow-[0_0_10px_rgba(233,30,99,0.4)] transition-all duration-200 text-sm font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                                <span class="font-bold">Login</span>
                            </a>
                        @endauth
                        <button
                            onclick="const html=document.getElementById('html-root');const isDark=html.classList.toggle('dark');localStorage.setItem('user-theme',isDark?'dark':'light');document.querySelectorAll('.user-theme-pill').forEach(function(b){b.setAttribute('data-dark',isDark?'1':'0')});"
                            class="theme-pill-btn user-theme-pill" data-dark="0" title="Toggle dark mode">
                        </button>
                    </div>
                </div>
                <div x-show="open" x-transition class="md:hidden mt-2 p-5 space-y-2">
                    <a href="{{ route('home') }}" class="block transition hover:text-[#E91E63]">Home</a>
                    <a href="{{ route('contact') }}" class="block transition hover:text-[#E91E63]">Contact</a>
                    @auth
                        @if (Auth::user()->email === 'Barangaytanyag@gmail.com')
                            <a href="{{ route('dashboard') }}" title="Go to Admin"
                                class="inline-flex items-center justify-center rounded-full transition-all duration-200 hover:scale-110 hover:shadow-[0_0_12px_rgba(233,30,99,0.5)]"
                                style="width:30px;height:30px;background:#E91E63;flex-shrink:0;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="#fff" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" title="Login"
                            class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-white bg-[#E91E63] hover:bg-[#F472B6] active:bg-[#BE185D] transition-all duration-200 text-sm font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                            <span class="font-bold">Login</span>
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
                            <h2 class="text-xl font-bold leading-tight" style="color:var(--color-accent)">SK Portal</h2>
                            <p class="text-sm" style="color:var(--color-text-muted)">Sangguniang Kabataan</p>
                        </div>
                    </a>
                    {{-- Mobile --}}
                    <div class="md:hidden flex items-center gap-3">
                        <button
                            onclick="const html=document.getElementById('html-root');const isDark=html.classList.toggle('dark');localStorage.setItem('user-theme',isDark?'dark':'light');document.querySelectorAll('.user-theme-pill').forEach(function(b){b.setAttribute('data-dark',isDark?'1':'0')});"
                            class="theme-pill-btn user-theme-pill" data-dark="0" title="Toggle dark mode">
                        </button>
                        <button @click="open = !open" style="color:var(--color-text-primary);background:none;border:none;cursor:pointer;padding:4px;">
                            <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                            <svg x-show="open" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        </button>
                    </div>
                    {{-- Desktop --}}
                    <div class="hidden md:flex items-center space-x-4">
                        <a href="{{ route('home') }}" class="font-semibold transition hover:text-[#E91E63]">Home</a>
                        <div class="relative">
                            <button @click="dropdownOpen = !dropdownOpen"
                                class="flex items-center gap-2 px-3 py-1.5 rounded-lg font-semibold text-sm transition-all duration-200"
                                style="background:var(--color-accent);color:#fff;">
                                {{ $sectionPages[$currentRoute] }}
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                                    :style="dropdownOpen ? 'transform:rotate(180deg);transition:transform 0.2s' : 'transition:transform 0.2s'">
                                    <polyline points="6 9 12 15 18 9"/>
                                </svg>
                            </button>
                            <div x-show="dropdownOpen" @click.away="dropdownOpen = false" x-transition
                                class="sk-dropdown absolute left-0 mt-2 w-52 rounded-lg shadow-lg z-50 py-2">
                                @foreach ($sectionPages as $route => $label)
                                    <a href="{{ route($route) }}"
                                        class="block px-4 py-2 text-sm transition hover:text-[#E91E63] {{ $route === $currentRoute ? 'font-bold' : '' }}"
                                        style="{{ $route === $currentRoute ? 'color:var(--color-accent)' : '' }}">
                                        {{ $label }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        @auth
                            @if (Auth::user()->email === 'Barangaytanyag@gmail.com')
                                <a href="{{ route('dashboard') }}" title="Go to Admin"
                                    class="flex items-center justify-center rounded-full transition-all duration-200 hover:scale-110 hover:shadow-[0_0_12px_rgba(233,30,99,0.5)]"
                                    style="width:30px;height:30px;background:#E91E63;flex-shrink:0;">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="#fff" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                                </a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" title="Login"
                                class="flex items-center gap-2 px-3 py-1.5 rounded-lg text-white bg-[#E91E63] hover:bg-[#F472B6] active:bg-[#BE185D] hover:shadow-[0_0_10px_rgba(233,30,99,0.4)] transition-all duration-200 text-sm font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                                <span class="font-bold">Login</span>
                            </a>
                        @endauth
                        <button
                            onclick="const html=document.getElementById('html-root');const isDark=html.classList.toggle('dark');localStorage.setItem('user-theme',isDark?'dark':'light');document.querySelectorAll('.user-theme-pill').forEach(function(b){b.setAttribute('data-dark',isDark?'1':'0')});"
                            class="theme-pill-btn user-theme-pill" data-dark="0" title="Toggle dark mode">
                        </button>
                    </div>
                </div>
                {{-- Mobile menu --}}
                <div x-show="open" x-transition class="md:hidden mt-2 p-5 space-y-2">
                    <a href="{{ route('home') }}" class="block transition hover:text-[#E91E63]">Home</a>
                    @foreach ($sectionPages as $route => $label)
                        <a href="{{ route($route) }}"
                            class="block transition hover:text-[#E91E63] {{ $route === $currentRoute ? 'font-bold' : '' }}"
                            style="{{ $route === $currentRoute ? 'color:var(--color-accent)' : '' }}">
                            {{ $label }}
                        </a>
                    @endforeach
                    @auth
                        @if (Auth::user()->email === 'Barangaytanyag@gmail.com')
                            <a href="{{ route('dashboard') }}" title="Go to Admin"
                                class="inline-flex items-center justify-center rounded-full transition-all duration-200 hover:scale-110"
                                style="width:30px;height:30px;background:#E91E63;flex-shrink:0;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="#fff" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-white bg-[#E91E63] transition-all duration-200 text-sm font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                            <span class="font-bold">Login</span>
                        </a>
                    @endauth
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
        (function() {
            function removeLoader() {
                var loader = document.getElementById('page-loader');
                if (!loader) return;
                loader.classList.add('fade-out');
                setTimeout(function() { if (loader.parentNode) loader.parentNode.removeChild(loader); }, 450);
            }
            document.addEventListener('DOMContentLoaded', removeLoader);
            setTimeout(removeLoader, 1500);
        })();
    </script>

</body>

</html>
