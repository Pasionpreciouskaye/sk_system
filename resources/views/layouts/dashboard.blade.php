<!DOCTYPE html>
<html lang="en" id="html-root">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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

        /* Elevated cards (hover) */
        .dark .hover\:-translate-y-1:hover,
        .dark [class*="hover:-translate"] {
            background-color: var(--color-hover) !important;
        }

        /* Grid dividers */
        .dark .border,
        .dark .border-t,
        .dark .border-b,
        .dark [class*="border-gray"] {
            border-color: var(--color-border) !important;
        }

        /* Pink accent glow on focus/active */
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

        .dark body {
            color: var(--color-text-primary);
        }

        /* ── DARK MODE: override hardcoded Tailwind bg/text classes ── */
        .dark .bg-white,
        .dark .bg-gray-50,
        .dark .bg-gray-100,
        .dark .bg-gray-200 {
            background-color: var(--color-card) !important;
        }

        .dark .bg-gray-800,
        .dark .bg-gray-900 {
            background-color: var(--color-sidebar) !important;
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

        /* DataTables dark */
        .dark .dataTables_wrapper,
        .dark .dataTables_wrapper input,
        .dark .dataTables_wrapper select {
            background-color: var(--color-card) !important;
            color: #F9FAFB !important;
            border-color: var(--color-border) !important;
        }

        .dark .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: #F9FAFB !important;
        }

        aside {
            background-color: var(--color-sidebar);
            border-right: 1px solid var(--color-border);
        }

        .sidebar-logo-area {
            border-bottom: 1px solid var(--color-border);
        }

        .sidebar-logo-area:hover {
            background-color: var(--color-hover);
        }

        .nav-link {
            color: var(--color-text-secondary);
        }

        .nav-link:hover {
            background-color: var(--color-hover);
            color: var(--color-accent);
        }

        .nav-footer {
            border-top: 1px solid var(--color-border);
            color: var(--color-text-muted);
        }

        /* Header */
        header {
            background-color: var(--color-sidebar);
            border-bottom: 1px solid var(--color-border);
        }

        /* Cards */
        .sk-card {
            background-color: var(--color-card);
            border: 1px solid var(--color-border);
        }

        /* Dropdowns / Modals */
        .sk-dropdown {
            background-color: var(--color-dropdown-bg);
            border: 1px solid var(--color-border);
        }

        .sk-modal {
            background-color: var(--color-modal-bg);
        }

        .sk-dropdown a:hover,
        .sk-dropdown button:hover {
            background-color: var(--color-hover);
            color: var(--color-accent);
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

        /* Tables */
        table {
            background-color: var(--color-card);
        }

        th {
            background-color: var(--color-sidebar);
            color: var(--color-text-secondary);
            border-bottom: 1px solid var(--color-border);
        }

        td {
            border-bottom: 1px solid var(--color-border);
            color: var(--color-text-primary);
        }

        tr:hover td {
            background-color: var(--color-hover);
        }

        /* Buttons */
        .btn-primary {
            background-color: var(--color-accent);
            color: #fff;
        }

        .btn-primary:hover {
            opacity: 0.9;
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
        /* hide the "Search:" text */
        .dataTables_filter label > span,
        .dataTables_filter label::before {
            display: none;
        }
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
        /* wrapper row that holds length + filter */
        .dataTables_wrapper .flex.justify-between {
            flex-wrap: wrap;
            gap: 8px;
        }
        /* make filter take remaining space */
        .dataTables_wrapper .dataTables_filter {
            flex: 1;
            min-width: 0;
        }
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

        /* ── DARK MODE ACTION BUTTONS (global) ── */
        .dark .btn-action-primary,
        .dark .cms-btn-primary {
            background-color: #E91E63 !important;
            color: #fff !important;
        }

        .dark .btn-action-primary:hover,
        .dark .cms-btn-primary:hover {
            background-color: #F472B6 !important;
            box-shadow: 0 0 12px rgba(233, 30, 99, 0.4) !important;
        }

        .dark .btn-action-primary:active,
        .dark .cms-btn-primary:active {
            background-color: #BE185D !important;
        }

        .dark .btn-action-primary:disabled,
        .dark .cms-btn-primary:disabled {
            background-color: #6B7280 !important;
        }

        .dark .btn-action-secondary,
        .dark .cms-btn-secondary {
            background-color: #1B2A41 !important;
            color: #D1D5DB !important;
            border-color: #2A3B55 !important;
        }

        .dark .btn-action-secondary:hover,
        .dark .cms-btn-secondary:hover {
            background-color: #24344D !important;
            color: #F9FAFB !important;
        }

        .dark .btn-action-secondary:active,
        .dark .cms-btn-secondary:active {
            background-color: #2E3F5B !important;
        }

        /* Text action links */
        .dark a.text-action,
        .dark .text-action {
            color: #F472B6 !important;
        }

        .dark a.text-action:hover,
        .dark .text-action:hover {
            color: #E91E63 !important;
        }

        /* Modal backgrounds */
        .dark .action-modal {
            background-color: #1B2A41 !important;
            border: 1px solid #2A3B55 !important;
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.7) !important;
        }

        .dark .action-modal .modal-border {
            border-color: #2A3B55 !important;
        }

        .dark .action-modal label {
            color: #D1D5DB !important;
        }

        .dark .action-modal input,
        .dark .action-modal select,
        .dark .action-modal textarea {
            background-color: #162338 !important;
            border-color: #2A3B55 !important;
            color: #F9FAFB !important;
        }

        .dark .action-modal input:focus,
        .dark .action-modal select:focus,
        .dark .action-modal textarea:focus {
            border-color: #E91E63 !important;
            box-shadow: 0 0 0 3px rgba(233, 30, 99, 0.25) !important;
        }

        /* ── SIDEBAR ACTIVE NAV LINK ── */
        .nav-link.active {
            background-color: var(--color-accent) !important;
            color: #FFFFFF !important;
            border-radius: 0.5rem;
            margin: 0 0.75rem;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .nav-link.active i {
            color: #FFFFFF !important;
        }

        .nav-link:not(.active):hover {
            background-color: var(--color-hover);
            color: var(--color-accent);
            border-radius: 0.5rem;
            margin: 0 0.75rem;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .nav-link:not(.active) {
            border-radius: 0.5rem;
            margin: 0 0.75rem;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        /* ── DARK MODE: CMS Modals (create/edit/delete) ── */
        .dark .cms-modal {
            background-color: #1B2A41 !important;
            border: 1px solid #2A3B55 !important;
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.7), 0 0 0 1px #2A3B55 !important;
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

        /* Card action icon buttons (event/project cards) */
        .dark .btn-edit {
            background-color: #162338 !important;
            color: #60A5FA !important;
            border: 1px solid #2A3B55 !important;
        }

        .dark .btn-edit:hover {
            background-color: #24344D !important;
            color: #93C5FD !important;
        }

        .btn-delete {
            background-color: #DC2626 !important;
            color: #ffffff !important;
            border: none !important;
        }

        .btn-delete:hover {
            background-color: #B91C1C !important;
            color: #ffffff !important;
        }

        .dark .btn-delete {
            background-color: #DC2626 !important;
            color: #ffffff !important;
            border: none !important;
        }

        .dark .btn-delete:hover {
            background-color: #B91C1C !important;
            color: #ffffff !important;
        }
    </style>
    <script src="https://kit.fontawesome.com/4f2d7302b1.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Admin defaults to dark mode on first visit
        var adminTheme = localStorage.getItem('admin-theme');
        if (adminTheme === null) {
            localStorage.setItem('admin-theme', 'dark');
            document.documentElement.classList.add('dark');
        } else if (adminTheme === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>

<body class="font-sans transition-colors duration-200">
    <div class="min-h-screen flex">
        <aside class="w-64 shadow-lg hidden md:flex flex-col justify-between transition-colors duration-200">
            <div>
                <div class="sidebar-logo-area p-6 transition duration-200 overflow-hidden">
                    <a href="{{ route('home') }}" class="flex items-center gap-3">
                        <img src="{{ asset('images/logo/sk-logo.png') }}" alt="SK Logo"
                            class="h-10 w-10 object-contain rounded-full">
                        <div>
                            <h2 class="text-xl font-bold leading-tight" style="color: var(--color-accent)">SK Admin</h2>
                            <p class="text-sm" style="color: var(--color-text-muted)">Sangguniang Kabataan</p>
                        </div>
                    </a>
                </div>
                <nav class="mt-6">
                    <ul class="space-y-1 text-sm">
                        <li><a href="{{ route('dashboard') }}"
                                class="nav-link flex items-center px-6 py-3 transition {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                <i class="fas fa-home w-5 mr-3" style="color:var(--color-accent)"></i> Dashboard
                            </a></li>
                        <li><a href="{{ route('user.index') }}"
                                class="nav-link flex items-center px-6 py-3 transition {{ request()->routeIs('user.*') ? 'active' : '' }}">
                                <i class="fas fa-user-friends w-5 mr-3" style="color:var(--color-accent)"></i> Members
                            </a></li>
                        <li><a href="{{ route('event.index') }}"
                                class="nav-link flex items-center px-6 py-3 transition {{ request()->routeIs('event.*') ? 'active' : '' }}">
                                <i class="fas fa-calendar-alt w-5 mr-3" style="color:var(--color-accent)"></i> Events
                            </a></li>
                        <li><a href="{{ route('project.index') }}"
                                class="nav-link flex items-center px-6 py-3 transition {{ request()->routeIs('project.*') ? 'active' : '' }}">
                                <i class="fas fa-project-diagram w-5 mr-3" style="color:var(--color-accent)"></i>
                                Projects
                            </a></li>
                        <li><a href="{{ route('budget.index') }}"
                                class="nav-link flex items-center px-6 py-3 transition {{ request()->routeIs('budget.*') ? 'active' : '' }}">
                                <i class="fas fa-hand-holding-usd w-5 mr-3" style="color:var(--color-accent)"></i>
                                Budget
                            </a></li>
                        <li><a href="{{ route('inventory.index') }}"
                                class="nav-link flex items-center px-6 py-3 transition {{ request()->routeIs('inventory.*') ? 'active' : '' }}">
                                <i class="fas fa-warehouse w-5 mr-3" style="color:var(--color-accent)"></i> Inventory
                            </a></li>
                        <li><a href="{{ route('feedback.index') }}"
                                class="nav-link flex items-center px-6 py-3 transition {{ request()->routeIs('feedback.*') ? 'active' : '' }}">
                                <i class="fas fa-message w-5 mr-3" style="color:var(--color-accent)"></i> Feedback
                            </a></li>
                        <li x-data="{ open: {{ request()->routeIs('budget_category.*') || request()->routeIs('inventory_category.*') ? 'true' : 'false' }} }" class="relative">
                            <button @click="open = !open"
                                class="nav-link flex items-center w-full px-6 py-3 transition text-left {{ request()->routeIs('budget_category.*') || request()->routeIs('inventory_category.*') ? 'active' : '' }}">
                                <i class="fas fa-layer-group w-5 mr-3" style="color:var(--color-accent)"></i>
                                <span class="flex-1">CMS</span>
                                <i class="fas fa-chevron-down text-xs ml-auto transition-transform duration-200"
                                    :class="open ? 'rotate-180' : ''"></i>
                            </button>
                            <div x-show="open" x-transition class="ml-10 mt-1 space-y-1">
                                <a href="{{ route('budget_category.index') }}"
                                    class="nav-link block px-4 py-2 text-sm transition {{ request()->routeIs('budget_category.*') ? 'active' : '' }}">Budget
                                    Category</a>
                                <a href="{{ route('inventory_category.index') }}"
                                    class="nav-link block px-4 py-2 text-sm transition {{ request()->routeIs('inventory_category.*') ? 'active' : '' }}">Inventory
                                    Category</a>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="nav-footer p-6 text-xs">&copy; {{ date('Y') }} City of taguig</div>
        </aside>

        <div class="flex-1 flex flex-col">
            <header
                class="shadow px-4 py-3 flex items-center justify-between md:justify-end transition-colors duration-200">
                <button class="md:hidden hover:text-pink-600 focus:outline-none"
                    style="color:var(--color-text-secondary)"
                    onclick="document.querySelector('aside').classList.toggle('hidden')">
                    <i class="fas fa-bars fa-lg"></i>
                </button>
                <div class="flex items-center gap-4">
                    <button id="theme-toggle"
                        onclick="const html=document.getElementById('html-root');const isDark=html.classList.toggle('dark');localStorage.setItem('admin-theme',isDark?'dark':'light');this.setAttribute('data-dark',isDark?'1':'0');"
                        data-dark="1"
                        title="Toggle dark mode"
                        class="adm-pill-toggle">
                    </button>
                    <style>
                        .adm-pill-toggle {
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
                        .adm-pill-toggle::before {
                            content: '';
                            position: absolute;
                            top: 3px; right: 3px;
                            width: 18px; height: 18px;
                            border-radius: 50%;
                            background: #E91E63;
                            transition: right 0.3s ease, left 0.3s ease, background 0.3s ease;
                        }
                        /* icon on track */
                        .adm-pill-toggle::after {
                            content: '🌙';
                            position: absolute;
                            top: 50%; left: 5px;
                            transform: translateY(-50%);
                            font-size: 11px; line-height: 1;
                            transition: opacity 0.2s ease;
                        }
                        /* light mode state */
                        .adm-pill-toggle[data-dark="0"] {
                            background: #F8BBD0;
                            box-shadow: 0 0 0 2px #E91E63;
                        }
                        .adm-pill-toggle[data-dark="0"]::before {
                            right: auto; left: 3px;
                            background: #E91E63;
                        }
                        .adm-pill-toggle[data-dark="0"]::after {
                            content: '☀️';
                            left: auto; right: 5px;
                        }
                    </style>
                    <script>
                        (function() {
                            var btn = document.getElementById('theme-toggle');
                            if (btn) btn.setAttribute('data-dark', document.documentElement.classList.contains('dark') ? '1' : '0');
                        })();
                    </script>
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open"
                            class="focus:outline-none flex items-center gap-2 px-3 py-1.5 rounded-lg transition-all duration-200 group"
                            style="background:none; border:none; cursor:pointer;">
                            <span class="text-sm font-bold transition-colors duration-200 group-hover:text-[#E91E63]"
                                style="color:var(--color-text-primary);">
                                {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                            </span>
                            <span class="flex items-center justify-center rounded-full transition-all duration-200 group-hover:bg-[#E91E63] group-hover:shadow-[0_0_8px_rgba(233,30,99,0.4)]"
                                style="width:22px;height:22px;background:var(--color-hover);flex-shrink:0;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="10" height="10" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                                    :style="open ? 'transform:rotate(180deg);transition:transform 0.2s' : 'transition:transform 0.2s'"
                                    style="color:var(--color-accent)">
                                    <polyline points="6 9 12 15 18 9"/>
                                </svg>
                            </span>
                        </button>
                        <div x-show="open" @click.away="open = false" x-transition
                            class="sk-dropdown absolute right-0 mt-2 w-44 rounded shadow-lg z-50 text-left">
                            <a href="{{ route('profile.index') }}" class="block px-4 py-2 text-sm transition"
                                style="color:var(--color-text-primary)">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm transition"
                                    style="color:var(--color-text-primary)">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 p-6" style="background-color: var(--color-base-alt)">
                @yield('content')
            </main>
        </div>
    </div>

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
