<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/4f2d7302b1.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>

<body class="bg-gray-100 font-sans">
    <div class="min-h-screen flex">
        <aside class="w-64 bg-white shadow-lg hidden md:flex flex-col justify-between">
            <div>
                <div class="p-6 border-b border-gray-200 hover:bg-pink-50 transition duration-200">
                    <a href="{{ route('home') }}" class="flex items-center gap-3">
                        <img src="{{ asset('images/logo/sk-logo.png') }}" alt="SK Logo" class="h-10 w-auto">
                        <div>
                            <h2 class="text-xl font-bold text-pink-600 leading-tight">SK Admin</h2>
                            <p class="text-sm text-gray-500">Sangguniang Kabataan</p>
                        </div>
                    </a>
                </div>
                <nav class="mt-6">
                    <ul class="space-y-1 text-gray-700 text-sm">
                        <li>
                            <a href="{{ route('dashboard') }}"
                                class="flex items-center px-6 py-3 hover:bg-pink-50 hover:text-pink-600 transition">
                                <i class="fas fa-home w-5 mr-3 text-pink-500"></i> Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.index') }}"
                                class="flex items-center px-6 py-3 hover:bg-pink-50 hover:text-pink-600 transition">
                                <i class="fas fa-user-friends w-5 mr-3 text-pink-500"></i> Members
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('event.index') }}"
                                class="flex items-center px-6 py-3 hover:bg-pink-50 hover:text-pink-600 transition">
                                <i class="fas fa-calendar-alt w-5 mr-3 text-pink-500"></i> Events
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('project.index') }}"
                                class="flex items-center px-6 py-3 hover:bg-pink-50 hover:text-pink-600 transition">
                                <i class="fas fa-project-diagram w-5 mr-3 text-pink-500"></i> Projects
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('budget.index') }}"
                                class="flex items-center px-6 py-3 hover:bg-pink-50 hover:text-pink-600 transition">
                                <i class="fas fa-hand-holding-usd w-5 mr-3 text-pink-500"></i> Budget
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('inventory.index') }}"
                                class="flex items-center px-6 py-3 hover:bg-pink-50 hover:text-pink-600 transition">
                                <i class="fas fa-warehouse w-5 mr-3 text-pink-500"></i> Inventory
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('feedback.index') }}"
                                class="flex items-center px-6 py-3 hover:bg-pink-50 hover:text-pink-600 transition">
                                <i class="fas fa-message w-5 mr-3 text-pink-500"></i> Feedback
                            </a>
                        </li>
                        <li x-data="{ open: false }" class="relative">
                            <button @click="open = !open"
                                class="flex items-center w-full px-6 py-3 hover:bg-pink-50 hover:text-pink-600 transition text-left">
                                <i class="fas fa-layer-group w-5 mr-3 text-pink-500"></i>
                                <span class="flex-1">CMS</span>
                                <i class="fas fa-chevron-down text-xs ml-auto"></i>
                            </button>

                            <div x-show="open" x-transition class="ml-10 mt-1 space-y-1">
                                <a href="{{ route('budget_category.index') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-pink-50 hover:text-pink-600 transition text-left">
                                    Budget Category
                                </a>
                                <a href="{{ route('inventory_category.index') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-pink-50 hover:text-pink-600 transition text-left">
                                    Inventory Category
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="p-6 border-t border-gray-200 text-xs text-gray-500">
                &copy; {{ date('Y') }} City of taguig
            </div>
        </aside>

        <div class="flex-1 flex flex-col">
            <header class="bg-white shadow px-4 py-3 flex items-center justify-between md:justify-end">
                <button class="md:hidden text-gray-600 hover:text-pink-600 focus:outline-none"
                    onclick="document.querySelector('aside').classList.toggle('hidden')">
                    <i class="fas fa-bars fa-lg"></i>
                </button>
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open"
                        class="flex items-center gap-2 text-sm text-gray-700 font-medium hover:text-pink-600 focus:outline-none">
                        Welcome, {{ Auth::user()->first_name }} {{ Auth::user()->middle_name }}
                        {{ Auth::user()->last_name }}
                        <i class="fas fa-chevron-down text-xs"></i>
                    </button>
                    <div x-show="open" @click.away="open = false" x-transition
                        class="absolute right-0 mt-2 w-44 bg-white border border-gray-200 rounded shadow-lg z-50 text-left">
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-pink-50 hover:text-pink-600 transition">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-pink-50 hover:text-pink-600 transition">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <main class="flex-1 p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>