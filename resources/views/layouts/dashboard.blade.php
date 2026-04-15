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
            background-color: var(--color-card) !important;
            border-color: var(--color-border) !important;
            box-shadow: 0 4px 24px rgba(0,0,0,0.5), 0 1px 4px rgba(0,0,0,0.4) !important;
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
            background-color: var(--color-base) !important;
            color: var(--color-text-primary) !important;
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
            color: var(--color-text-primary) !important;
        }

        .dark .text-gray-500,
        .dark .text-gray-400 {
            color: var(--color-text-secondary) !important;
        }

        .dark .border-gray-100,
        .dark .border-gray-200,
        .dark .border-gray-300 {
            border-color: var(--color-border) !important;
        }

        .dark .shadow,
        .dark .shadow-md,
        .dark .shadow-lg,
        .dark .shadow-sm {
            box-shadow: 0 2px 12px rgba(0,0,0,0.6) !important;
        }

        /* ── LIGHT MODE: enforce palette on hardcoded Tailwind classes ── */
        :root .text-pink-600,
        :root .text-pink-500 {
            color: #E11D48 !important;
        }

        :root .bg-pink-600 {
            background-color: #E11D48 !important;
        }

        :root .hover\:bg-pink-700:hover {
            background-color: #BE123C !important;
        }

        :root .text-gray-800,
        :root .text-gray-700,
        :root .text-gray-600 {
            color: #1F2937 !important;
        }

        :root .text-gray-500,
        :root .text-gray-400 {
            color: #6B7280 !important;
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

        /* Dark mode: header and sidebar use deep navy */
        .dark header {
            background-color: #1E293B !important;
            border-bottom: 1px solid #334155 !important;
        }

        .dark aside {
            background-color: #1E293B !important;
            border-right: 1px solid #334155 !important;
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
    <div class="min-h-screen flex" x-data="{ sidebarOpen: localStorage.getItem('sidebar') !== 'closed' }"
        x-init="$watch('sidebarOpen', v => localStorage.setItem('sidebar', v ? 'open' : 'closed'))">

        {{-- ── SIDEBAR ── --}}
        <aside :class="sidebarOpen ? 'w-64' : 'w-16'"
            class="shadow-lg hidden md:flex flex-col justify-between transition-all duration-300 overflow-hidden"
            style="background-color:var(--color-sidebar);border-right:1px solid var(--color-border);">
            <div>
                {{-- Logo above nav --}}
                <div class="px-3 py-4" style="border-bottom:1px solid var(--color-border);">
                    <a href="{{ route('home') }}" title="Go to Youth Page">
                        <img src="{{ asset('images/logo/sk-logo.png') }}" alt="SK Logo"
                            class="h-12 w-12 object-contain rounded-full border-2 border-pink-400 hover:opacity-80 transition-opacity">
                    </a>
                </div>

                {{-- Nav links --}}
                <nav class="mt-4">
                    <ul class="space-y-1 text-sm">

                        @php
                        $navItems = [
                            ['route' => 'dashboard',            'label' => 'Dashboard',   'access' => 'dashboard', 'svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>'],
                            ['route' => 'user.index',           'label' => 'Members',     'access' => 'user',      'svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="4"/><circle cx="12" cy="10" r="3"/><path d="M6.5 20c0-3 2.5-5 5.5-5s5.5 2 5.5 5"/></svg>'],
                            ['route' => 'project.index',        'label' => 'Projects',    'access' => 'project',   'svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>'],
                            ['route' => 'budget.index',         'label' => 'Budget',      'access' => 'budget',    'svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/><line x1="12" y1="12" x2="12" y2="16"/><line x1="10" y1="14" x2="14" y2="14"/></svg>'],
                            ['route' => 'inventory.index',      'label' => 'Inventory',   'access' => 'inventory', 'svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>'],
                            ['route' => 'feedback.index',       'label' => 'Feedback',    'access' => 'feedback',  'svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/><line x1="9" y1="10" x2="9" y2="10"/><line x1="12" y1="10" x2="12" y2="10"/><line x1="15" y1="10" x2="15" y2="10"/></svg>'],
                            ['route' => 'audit.index',          'label' => 'Audit Trail', 'access' => 'dashboard', 'svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>'],
                        ];
                        @endphp

                        @foreach($navItems as $item)
                            @if(Auth::user()->canAccess($item['access']))
                            <li>
                                <a href="{{ route($item['route']) }}"
                                    class="nav-link flex items-center py-3 transition {{ request()->routeIs(str_replace('.index','',$item['route']).'*') ? 'active' : '' }}"
                                    :class="sidebarOpen ? 'px-6' : 'px-0 justify-center'"
                                    title="{{ $item['label'] }}">
                                    <span class="flex-shrink-0" :class="sidebarOpen ? 'mr-3' : ''">{!! $item['svg'] !!}</span>
                                    <span x-show="sidebarOpen" x-transition.opacity class="whitespace-nowrap">{{ $item['label'] }}</span>
                                </a>
                            </li>
                            @endif
                        @endforeach

                        {{-- CMS dropdown --}}
                        @if(Auth::user()->canAccess('budget_category') || Auth::user()->canAccess('inventory_category'))
                        <li x-data="{ open: {{ request()->routeIs('budget_category.*') || request()->routeIs('inventory_category.*') ? 'true' : 'false' }} }">
                            <button @click="if(sidebarOpen) open = !open; else { sidebarOpen = true; open = true; }"
                                class="nav-link flex items-center w-full py-3 transition text-left {{ request()->routeIs('budget_category.*') || request()->routeIs('inventory_category.*') ? 'active' : '' }}"
                                :class="sidebarOpen ? 'px-6' : 'px-0 justify-center'"
                                title="CMS">
                                <span class="flex-shrink-0" :class="sidebarOpen ? 'mr-3' : ''">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="3" y1="15" x2="21" y2="15"/><line x1="9" y1="9" x2="9" y2="21"/></svg>
                                </span>
                                <span x-show="sidebarOpen" x-transition.opacity class="flex-1 whitespace-nowrap">CMS</span>
                                <svg x-show="sidebarOpen" xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" class="ml-auto transition-transform duration-200" :class="open ? 'rotate-180' : ''"><polyline points="6 9 12 15 18 9"/></svg>
                            </button>
                            <div x-show="open && sidebarOpen" x-transition class="ml-10 mt-1 space-y-1">
                                @if(Auth::user()->canAccess('budget_category'))
                                <a href="{{ route('budget_category.index') }}"
                                    class="nav-link block px-4 py-2 text-sm transition {{ request()->routeIs('budget_category.*') ? 'active' : '' }}">Budget Category</a>
                                @endif
                                @if(Auth::user()->canAccess('inventory_category'))
                                <a href="{{ route('inventory_category.index') }}"
                                    class="nav-link block px-4 py-2 text-sm transition {{ request()->routeIs('inventory_category.*') ? 'active' : '' }}">Inventory Category</a>
                                @endif
                            </div>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>

            {{-- Footer --}}
            <div class="nav-footer px-3 py-4 text-xs overflow-hidden">
                {{-- Logged-in user info --}}
                <div x-show="sidebarOpen" x-transition.opacity class="flex items-center gap-2 mb-2 px-1">
                    <img src="{{ Auth::user()->profile_picture ? asset(Auth::user()->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->first_name . ' ' . Auth::user()->last_name) . '&background=E91E63&color=fff&size=64' }}"
                        alt="Profile"
                        class="w-8 h-8 rounded-full object-cover border-2 border-pink-400 flex-shrink-0">
                    <div class="overflow-hidden">
                        <p class="text-xs font-semibold truncate" style="color:var(--color-text-primary)">
                            {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                        </p>
                        <p class="text-xs truncate" style="color:var(--color-text-muted)">
                            {{ str_replace('_', ' ', Auth::user()->role) }}
                        </p>
                    </div>
                </div>
                <span x-show="sidebarOpen" x-transition.opacity class="block text-center">&copy; {{ date('Y') }} City of Taguig</span>
                <span x-show="!sidebarOpen" class="block text-center" title="{{ date('Y') }}">©</span>
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-w-0">
            <header class="shadow px-4 py-3 flex items-center justify-between transition-colors duration-200">
                {{-- Sidebar toggle + Hello greeting --}}
                <div class="flex items-center gap-3">
                    <button @click="sidebarOpen = !sidebarOpen"
                        class="hidden md:flex items-center justify-center w-8 h-8 rounded-lg transition hover:opacity-80"
                        style="color:var(--color-text-secondary);background:var(--color-hover);"
                        title="Toggle sidebar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>
                        </svg>
                    </button>
                    <button class="md:hidden hover:text-pink-600 focus:outline-none"
                        style="color:var(--color-text-secondary)"
                        onclick="document.querySelector('aside').classList.toggle('hidden')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>
                        </svg>
                    </button>
                    <span class="text-lg font-bold hidden sm:inline" style="color:var(--color-text-primary)">
                        Hello {{ Auth::user()->first_name }} 👋,
                    </span>
                </div>
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
                            class="focus:outline-none flex items-center gap-2 px-2 py-1 rounded-lg transition-all duration-200 group"
                            style="background:none; border:none; cursor:pointer;">
                            {{-- Profile avatar --}}
                            <img src="{{ Auth::user()->profile_picture ? asset(Auth::user()->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->first_name . ' ' . Auth::user()->last_name) . '&background=E91E63&color=fff&size=64' }}"
                                alt="Profile"
                                class="w-9 h-9 rounded-full object-cover border-2 border-pink-400 flex-shrink-0 group-hover:border-pink-600 transition-all duration-200">
                            <span class="text-sm font-semibold hidden md:inline transition-colors duration-200 group-hover:text-[#E91E63]"
                                style="color:var(--color-text-primary);">
                                {{ Auth::user()->first_name }}
                            </span>
                            <span class="flex items-center justify-center rounded-full transition-all duration-200 group-hover:bg-[#E91E63] group-hover:shadow-[0_0_8px_rgba(233,30,99,0.4)]"
                                style="width:20px;height:20px;background:var(--color-hover);flex-shrink:0;">
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
