<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Finwise Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif']
                    },
                    colors: {
                        brand: {
                            50: '#ecfdf5',
                            500: '#10B981',
                            600: '#059669'
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
    </style>
</head>

<body class="bg-gray-50 text-gray-900 font-sans" x-data="{ sidebarOpen: true }">

    <div class="flex h-screen overflow-hidden">

        <aside
            class="bg-white border-r border-gray-200 flex flex-col transition-all duration-300 ease-in-out relative z-20"
            :class="sidebarOpen ? 'w-64' : 'w-20'">

            <div class="h-20 flex items-center px-6 border-b border-gray-50">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-brand-500 rounded-lg flex items-center justify-center flex-shrink-0">
                        <img src="/images/logo.png" alt="" class="w-6 h-6">
                    </div>
                    <span
                        class="text-xl font-bold tracking-tight text-gray-900 overflow-hidden whitespace-nowrap transition-all duration-300"
                        :class="sidebarOpen ? 'w-auto opacity-100' : 'w-0 opacity-0 hidden'">
                        Finwise
                    </span>
                </div>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2">
                @if (isset($sidebar))
                    {{ $sidebar }}
                @endif
            </nav>

            <button @click="sidebarOpen = !sidebarOpen"
                class="absolute -right-3 top-24 bg-white border border-gray-200 rounded-full p-1 shadow-sm hover:bg-gray-50 focus:outline-none z-50">
                <svg class="w-4 h-4 text-gray-500 transition-transform duration-300"
                    :class="sidebarOpen ? 'rotate-0' : 'rotate-180'" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <div class="p-4 border-t border-gray-100">
                <div class="flex items-center gap-3">
                    <img src="https://ui-avatars.com/api/?name=User&background=10B981&color=fff"
                        class="w-9 h-9 rounded-full flex-shrink-0">
                    <div class="overflow-hidden whitespace-nowrap transition-all duration-300"
                        :class="sidebarOpen ? 'block' : 'hidden'">
                        <p class="text-sm font-semibold text-gray-700">Username</p>
                        <p class="text-xs text-gray-500">user@finwise.com</p>
                    </div>
                </div>
            </div>
        </aside>

        <div class="flex-1 flex flex-col h-screen overflow-hidden relative">

            <header class="bg-white border-b border-gray-200 h-20 flex items-center justify-between px-8">
                <div>
                    <p class="text-sm text-gray-500">Welcome back!</p>
                    <h2 class="text-xl font-bold text-gray-800">Username</h2>
                </div>
                <div class="flex items-center gap-4">
                    <button class="p-2 text-gray-400 hover:text-gray-600 rounded-full hover:bg-gray-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto bg-gray-50/50 p-8">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
