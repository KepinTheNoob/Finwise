<!DOCTYPE html>
<html lang="id" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Finwise' }} - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif']
                    },
                    colors: {
                        brand: {
                            500: '#10B981',
                            600: '#059669'
                        },
                        dark: {
                            bg: '#18181b',
                            surface: '#202022',
                            border: '#333333',
                            text: '#A1A1AA'
                        }
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] {
            display: none !important;
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #18181b;
        }

        ::-webkit-scrollbar-thumb {
            background: #333;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #444;
        }
    </style>
</head>

<body class="bg-dark-bg text-white font-sans antialiased" x-data="{ sidebarOpen: true, isLogoutModalOpen: false }">

    <div class="flex h-screen">

        <aside
            class="bg-dark-surface border-r border-dark-border flex flex-col transition-all duration-300 ease-[cubic-bezier(0.4,0,0.2,1)] relative z-50 overflow-visible"
            :class="sidebarOpen ? 'w-64' : 'w-20'">

            <div class="h-20 flex items-center px-6 border-b border-dark-border shrink-0 relative">
                <div class="flex items-center gap-3 overflow-hidden whitespace-nowrap">
                    <div
                        class="w-8 h-8 bg-brand-500 rounded-lg flex items-center justify-center shrink-0 text-white shadow-lg shadow-brand-500/20">
                        <img src="/images/logo.png" alt="" class="w-5 h-5">
                    </div>
                    <span
                        class="text-xl font-bold tracking-tight text-white transition-opacity duration-300 overflow-hidden"
                        :class="sidebarOpen ? 'opacity-100 delay-100' : 'opacity-0 w-0'">
                        Finwise
                    </span>
                </div>
                <button @click="sidebarOpen = !sidebarOpen"
                    class="absolute -right-3 top-1/2 -translate-y-1/2 bg-dark-surface border border-dark-border text-gray-400 hover:text-white hover:border-brand-500 hover:bg-brand-500/10 rounded-lg p-1 shadow-md z-50 transition-all duration-200"
                    :class="sidebarOpen ? 'rotate-0' : 'rotate-180'">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto overflow-x-hidden">
                <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" label="Dashboard">
                    <x-slot name="icon"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg></x-slot>
                </x-sidebar-link>
                <x-sidebar-link :href="route('transactions.index')" :active="request()->routeIs('transactions.index')" label="Transactions">
                    <x-slot name="icon"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg></x-slot>
                </x-sidebar-link>
                <x-sidebar-link :href="route('categories.index')" :active="request()->routeIs('categories.index')" label="Categories">
                    <x-slot name="icon"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg></x-slot>
                </x-sidebar-link>
                <x-sidebar-link :href="route('budgets')" :active="request()->routeIs('budgets')" label="Budgets">
                    <x-slot name="icon"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                        </svg></x-slot>
                </x-sidebar-link>
                <x-sidebar-link :href="route('profile')" :active="request()->routeIs('profile')" label="Profile">
                    <x-slot name="icon"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg></x-slot>
                </x-sidebar-link>
            </nav>

            <div class="p-4 border-t border-dark-border mt-auto shrink-0">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" @click="isLogoutModalOpen = true"
                        class="w-full flex items-center gap-3 px-3 py-3 rounded-xl transition-all duration-200 group relative hover:bg-red-500/10 text-gray-400 hover:text-red-500">
                        <div class="shrink-0 w-6 h-6 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </div>
                        <span class="font-medium whitespace-nowrap transition-all duration-300 origin-left overflow-hidden"
                            x-show="sidebarOpen" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-x-2"
                            x-transition:enter-end="opacity-100 translate-x-0">Logout Account</span>
                        <div x-show="!sidebarOpen"
                            class="absolute left-14 bg-red-900/90 text-white text-xs px-3 py-1.5 rounded-md shadow-xl opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300 z-50 pointer-events-none whitespace-nowrap border border-red-500/20">
                            Logout</div>
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col h-screen overflow-hidden relative bg-dark-bg">
            <header
                class="bg-dark-bg/80 backdrop-blur-md border-b border-dark-border h-20 flex items-center justify-between px-8 sticky top-0 z-30">
                <div class="flex items-center gap-4">
                    <img src="https://ui-avatars.com/api/?name=User&background=10B981&color=fff"
                        class="w-10 h-10 rounded-full border border-dark-border">
                    <div class="flex flex-col">
                        <p class="text-xs text-dark-text font-medium uppercase tracking-wider">Welcome back!</p>
                        <h2 class="text-lg font-bold text-white leading-tight">John Doe</h2>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div
                        class="hidden md:flex items-center bg-dark-surface border border-dark-border rounded-full px-4 py-1.5">
                        <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" placeholder="Search..."
                            class="bg-transparent border-none focus:ring-0 text-sm text-white placeholder-gray-500 w-32 focus:w-48 transition-all">
                    </div>
                    <div class="h-6 w-px bg-dark-border mx-2"></div>
                    <button
                        class="p-2 text-gray-400 hover:text-white hover:bg-white/5 rounded-full transition-colors relative">
                        <span
                            class="absolute top-2.5 right-2.5 w-2 h-2 bg-red-500 rounded-full border border-dark-bg animate-pulse"></span>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-8 relative scroll-smooth">
                @if (!request()->routeIs('transactions.index') && !request()->routeIs('categories.index') && !request()->routeIs('budgets'))
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h1 class="text-3xl font-bold text-white capitalize tracking-tight">{{ $title ?? 'Page' }}
                            </h1>
                            <p class="text-dark-text text-sm mt-1">Manage and track your activities</p>
                        </div>
                        <div
                            class="hidden md:block text-sm text-dark-text bg-dark-surface px-4 py-2 rounded-lg border border-dark-border">
                            <span class="text-brand-500 font-medium">Today:</span> {{ date('d M Y') }}
                        </div>
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>

    <div x-show="isLogoutModalOpen" style="display: none;"
        class="fixed inset-0 z-[100] flex items-center justify-center px-4"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

        <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" @click="isLogoutModalOpen = false"></div>

        <div class="bg-[#202022] w-full max-w-sm rounded-2xl border border-[#333] shadow-2xl relative z-10 p-6 text-center transform transition-all"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">

            <div
                class="w-16 h-16 bg-red-500/10 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
            </div>

            <h3 class="text-xl font-bold text-white mb-2">Sign Out?</h3>
            <p class="text-gray-400 text-sm mb-6">Are you sure you want to log out of your account?</p>

            <div class="flex gap-3">
                <button @click="isLogoutModalOpen = false"
                    class="flex-1 bg-[#333] hover:bg-[#444] text-white py-2.5 rounded-lg font-medium transition-colors">
                    Cancel
                </button>

                <a href="{{ route('login') }}"
                    class="flex-1 bg-red-500 hover:bg-red-600 text-white py-2.5 rounded-lg font-medium transition-colors shadow-lg shadow-red-500/20 flex items-center justify-center">
                    Logout
                </a>
            </div>
        </div>
    </div>

</body>

</html>
