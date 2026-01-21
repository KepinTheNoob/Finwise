<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finwise - Access</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            500: '#10B981', // Emerald green cerah
                            600: '#059669', // Emerald green agak gelap
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

<body class="flex flex-col items-center justify-center min-h-screen px-4" x-data="{
    isLogin: {{ session('auth_form') === 'register' ? 'false' : 'true' }}
}"
    style="background: linear-gradient(to bottom right, #232D26 0%, #243028 50%, #2D4133 100%);">

    <div class="w-full max-w-md flex flex-col items-center">

        <div class="flex flex-col items-center mb-5">
            <div
                class="w-[87px] h-[87px] bg-brand-500 rounded-full flex items-center justify-center shadow-lg shadow-emerald-900/20">
                <img src="/images/logo.png" alt="" class="opacity-90">
            </div>

            <h1 class="text-[40px] font-bold text-white mt-4">Finwise</h1>
            <p class="text-gray-400 text-sm">Manage your finances with ease</p>
        </div>

        <div class="w-full bg-[#2A2A2A] p-1 rounded-lg flex relative mb-6 border border-white/5">
            <div class="absolute top-1 bottom-1 w-[calc(50%-4px)] bg-[#181818] rounded shadow-sm transition-all duration-300 ease-in-out z-0"
                :class="isLogin ? 'left-1' : 'left-[calc(50%)]'">
            </div>

            <button @click="isLogin = true"
                class="w-1/2 relative z-10 font-medium py-2 rounded text-sm transition-colors duration-300"
                :class="isLogin ? 'text-white font-bold' : 'text-gray-500 hover:text-gray-300'">
                Login
            </button>

            <button @click="isLogin = false"
                class="w-1/2 relative z-10 font-medium py-2 rounded text-sm transition-colors duration-300"
                :class="!isLogin ? 'text-white font-bold' : 'text-gray-500 hover:text-gray-300'">
                Register
            </button>
        </div>

        <div
            class="w-full bg-[#242424] rounded-xl shadow-2xl px-8 py-6 border border-white/5 overflow-hidden transition-all duration-500 ease-in-out">
            <div class="mb-6">
                <h2 class="text-xl font-bold text-white" x-text="isLogin ? 'Login' : 'Create Account'"></h2>
                <p class="text-sm text-gray-400 mt-1"
                    x-text="isLogin ? 'Enter your credentials to access your account' : 'Create a new account to get started'">
                    Enter your credentials to access your account</p>
            </div>

            <form
                :action="isLogin
                    ?
                    '{{ route('login.post') }}' :
                    '{{ route('register.post') }}'"
                method="POST">
                @csrf

                <div x-show="!isLogin" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 -translate-y-2 h-0 mb-4"
                    x-transition:enter-end="opacity-100 translate-y-0 h-[84px] mb-4"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 h-[84px]"
                    x-transition:leave-end="opacity-0 -translate-y-2 h-0 mb-0" class="overflow-hidden mb-5">
                    <label for="name" class="block text-sm font-medium text-gray-400 mb-2">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="w-full px-4 py-3 rounded-lg bg-[#181818] border border-[#333333] text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500 focus:ring-opacity-20 outline-none transition-all duration-200 text-sm placeholder-gray-600"
                        placeholder="John Doe">
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="email" class="block text-sm font-medium text-gray-400 mb-2">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="w-full px-4 py-3 rounded-lg bg-[#181818] border border-[#333333] text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500 focus:ring-opacity-20 outline-none transition-all duration-200 text-sm placeholder-gray-600"
                        placeholder="john@example.com" required>
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-5" x-data="{ show: false }">
                    <label for="password" class="block text-sm font-medium text-gray-400 mb-2">
                        Password
                    </label>

                    <div class="relative">
                        <input :type="show ? 'text' : 'password'" id="password" name="password"
                            class="w-full px-4 py-3 pr-12 rounded-lg bg-[#181818] border border-[#333333] text-white
                   focus:border-brand-500 focus:ring-2 focus:ring-brand-500 focus:ring-opacity-20
                   outline-none transition-all duration-200 text-sm placeholder-gray-600"
                            placeholder="••••••••" required>

                        <button type="button" @click="show = !show"
                            class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-white">
                            <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7
                                    -1.274 4.057-5.064 7-9.542 7
                                    -4.477 0-8.268-2.943-9.542-7z" />
                            </svg>

                            <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19
                                    c-4.478 0-8.268-2.943-9.543-7
                                    a9.97 9.97 0 012.642-4.362M9.88 9.88
                                    a3 3 0 104.243 4.243M6.1 6.1
                                    L3 3m18 18l-3-3" />
                            </svg>
                        </button>
                    </div>

                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>


                <div x-show="!isLogin" x-data="{ showConfirm: false }" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 -translate-y-2 h-0 mb-4"
                    x-transition:enter-end="opacity-100 translate-y-0 h-[84px] mb-4"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 h-[84px]"
                    x-transition:leave-end="opacity-0 -translate-y-2 h-0 mb-0" class="overflow-hidden mb-5">

                    <label for="password_confirmation" class="block text-sm font-medium text-gray-400 mb-2">
                        Confirm Password
                    </label>

                    <div class="relative">
                        <input :type="showConfirm ? 'text' : 'password'" id="password_confirmation"
                            name="password_confirmation"
                            class="w-full px-4 py-3 pr-12 rounded-lg bg-[#181818] border border-[#333333]
                                text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500
                                focus:ring-opacity-20 outline-none transition-all duration-200
                                text-sm placeholder-gray-600"
                            placeholder="••••••••">

                        <!-- eye icon -->
                        <button type="button" @click="showConfirm = !showConfirm"
                            class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-white">

                            <svg x-show="!showConfirm" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7
                                    -1.274 4.057-5.064 7-9.542 7
                                    -4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="showConfirm" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19
                                    c-4.478 0-8.268-2.943-9.543-7
                                    a9.97 9.97 0 012.642-4.362M9.88 9.88
                                    a3 3 0 104.243 4.243M6.1 6.1
                                    L3 3m18 18l-3-3" />
                            </svg>
                        </button>
                    </div>

                    @error('password_confirmation')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full bg-brand-500 hover:bg-brand-600 text-white font-bold py-3 rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 transform active:scale-[0.98]"
                    x-text="isLogin ? 'Login' : 'Create Account'">
                    Login
                </button>

            </form>
        </div>

    </div>

</body>

</html>
