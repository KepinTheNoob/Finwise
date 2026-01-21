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
                        sans: ['Inter', 'sans-serif']
                    },
                    colors: {
                        brand: {
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

        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px #212121 inset !important;
            -webkit-text-fill-color: white !important;
            transition: background-color 5000s ease-in-out 0s;
        }
    </style>
</head>

<body class="flex flex-col items-center justify-center min-h-screen px-4" x-data="{ isLogin: {{ session('auth_form') === 'register' ? 'false' : 'true' }} }"
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
            class="w-full bg-[#2F2F2F] rounded-xl shadow-2xl px-8 py-6 border border-[#3B3B3B] overflow-hidden transition-all duration-500 ease-in-out">
            <div class="mb-6">
                <h2 class="text-xl font-bold text-white" x-text="isLogin ? 'Login' : 'Create Account'"></h2>
                <p class="text-sm text-gray-400 mt-1"
                    x-text="isLogin ? 'Enter your credentials to access your account' : 'Create a new account to get started'">
                    Enter your credentials to access your account
                </p>
            </div>

            <form :action="isLogin ? '{{ route('login.post') }}' : '{{ route('register.post') }}'" method="POST">
                @csrf

                <div x-show="!isLogin" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 -translate-y-2 h-0 mb-4"
                    x-transition:enter-end="opacity-100 translate-y-0 h-[84px] mb-4"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 h-[84px]"
                    x-transition:leave-end="opacity-0 -translate-y-2 h-0 mb-0" class="overflow-hidden mb-5">

                    <label for="name" class="block text-sm font-medium text-gray-400 mb-2">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="w-full px-4 py-3 rounded-lg bg-[#212121] border border-[#3B3B3B] text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500 focus:ring-opacity-20 outline-none transition-all duration-200 text-sm placeholder-[#989898]"
                        placeholder="John Doe">
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="email" class="block text-sm font-medium text-gray-400 mb-2">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="w-full px-4 py-3 rounded-lg bg-[#212121] border border-[#3B3B3B] text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500 focus:ring-opacity-20 outline-none transition-all duration-200 text-sm placeholder-[#989898]"
                        placeholder="john@example.com" required>
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-5" x-data="{ show: false }">
                    <label for="password" class="block text-sm font-medium text-gray-400 mb-2">Password</label>
                    <div class="relative">
                        <input :type="show ? 'text' : 'password'" id="password" name="password"
                            class="w-full px-4 py-3 pr-12 rounded-lg bg-[#212121] border border-[#3B3B3B] text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500 focus:ring-opacity-20 outline-none transition-all duration-200 text-sm placeholder-[#989898]"
                            placeholder="••••••••" required>

                        <button type="button" @click="show = !show"
                            class="absolute top-[13px] right-4 flex items-center justify-center cursor-pointer focus:outline-none"
                            title="Toggle Password Visibility">
                            <img x-show="!show" src="/images/view.png" alt="Show"
                                class="w-5 h-5 opacity-60 hover:opacity-100 transition-opacity duration-200">
                            <img x-show="show" src="/images/hide.png" alt="Hide"
                                class="w-5 h-5 opacity-60 hover:opacity-100 transition-opacity duration-200"
                                style="display: none;">
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

                    <label for="password_confirmation" class="block text-sm font-medium text-gray-400 mb-2">Confirm
                        Password</label>
                    <div class="relative">
                        <input :type="showConfirm ? 'text' : 'password'" id="password_confirmation"
                            name="password_confirmation"
                            class="w-full px-4 py-3 pr-12 rounded-lg bg-[#212121] border border-[#3B3B3B] text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500 focus:ring-opacity-20 outline-none transition-all duration-200 text-sm placeholder-[#989898]"
                            placeholder="••••••••">

                        <button type="button" @click="showConfirm = !showConfirm"
                            class="absolute top-[13px] right-4 flex items-center justify-center cursor-pointer focus:outline-none"
                            title="Toggle Password Visibility">
                            <img x-show="!showConfirm" src="/images/view.png" alt="Show"
                                class="w-5 h-5 opacity-60 hover:opacity-100 transition-opacity duration-200">
                            <img x-show="showConfirm" src="/images/hide.png" alt="Hide"
                                class="w-5 h-5 opacity-60 hover:opacity-100 transition-opacity duration-200"
                                style="display: none;">
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
