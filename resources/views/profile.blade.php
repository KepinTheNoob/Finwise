<x-app title="Profile">

    <div x-data="profileManager()">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

            <div class="bg-dark-surface rounded-xl border border-dark-border p-6 shadow-lg h-full flex flex-col">

                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <svg class="w-5 h-5 text-brand-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <h3 class="text-lg font-bold text-white">Profile Information</h3>
                    </div>
                    <p class="text-gray-400 text-sm mb-6">Update your personal details</p>
                </div>

                <form @submit.prevent="updateProfile" class="flex-1 flex flex-col justify-between">

                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Name</label>
                            <input type="text" x-model="user.name"
                                class="w-full bg-[#18181b] border border-dark-border text-white rounded-lg px-4 py-2.5 focus:outline-none focus:border-brand-500 focus:ring-1 focus:ring-brand-500 transition-all placeholder-gray-600">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Email</label>
                            <input type="email" x-model="user.email"
                                class="w-full bg-[#18181b] border border-dark-border text-white rounded-lg px-4 py-2.5 focus:outline-none focus:border-brand-500 focus:ring-1 focus:ring-brand-500 transition-all placeholder-gray-600">
                        </div>
                    </div>

                    <div class="pt-5"> <button type="submit"
                            class="w-full bg-brand-500 hover:bg-brand-600 text-white font-bold py-2.5 rounded-lg transition-all shadow-lg shadow-brand-500/20 active:scale-[0.98]">
                            <span x-show="!isLoadingProfile">Update Profile</span>
                            <span x-show="isLoadingProfile" class="flex items-center justify-center gap-2">
                                <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Saving...
                            </span>
                        </button>
                    </div>

                </form>
            </div>

            <div class="bg-dark-surface rounded-xl border border-dark-border p-6 shadow-lg">
                <div class="flex items-center gap-3 mb-2">
                    <svg class="w-5 h-5 text-brand-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <h3 class="text-lg font-bold text-white">Change Password</h3>
                </div>
                <p class="text-gray-400 text-sm mb-6">Update your account password</p>

                <form @submit.prevent="updatePassword" class="space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Current Password</label>
                        <input type="password" placeholder="••••••••"
                            class="w-full bg-[#18181b] border border-dark-border text-white rounded-lg px-4 py-2.5 focus:outline-none focus:border-brand-500 focus:ring-1 focus:ring-brand-500 transition-all placeholder-gray-600">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">New Password</label>
                        <input type="password" placeholder="••••••••"
                            class="w-full bg-[#18181b] border border-dark-border text-white rounded-lg px-4 py-2.5 focus:outline-none focus:border-brand-500 focus:ring-1 focus:ring-brand-500 transition-all placeholder-gray-600">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Confirm New Password</label>
                        <input type="password" placeholder="••••••••"
                            class="w-full bg-[#18181b] border border-dark-border text-white rounded-lg px-4 py-2.5 focus:outline-none focus:border-brand-500 focus:ring-1 focus:ring-brand-500 transition-all placeholder-gray-600">
                    </div>

                    <button type="submit"
                        class="w-full bg-brand-500 hover:bg-brand-600 text-white font-bold py-2.5 rounded-lg transition-all shadow-lg shadow-brand-500/20 active:scale-[0.98]">
                        <span x-show="!isLoadingPassword">Change Password</span>
                        <span x-show="isLoadingPassword" class="flex items-center justify-center gap-2">
                            <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            Updating...
                        </span>
                    </button>
                </form>
            </div>
        </div>

        <div class="bg-dark-surface rounded-xl border border-dark-border p-6 shadow-lg mb-8">
            <div class="flex items-center gap-3 mb-2">
                <svg class="w-5 h-5 text-brand-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="text-lg font-bold text-white">Currency Settings</h3>
            </div>
            <p class="text-gray-400 text-sm mb-6">Select your preferred currency</p>

            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Default Currency</label>
                    <select x-model="currency"
                        class="w-full bg-[#18181b] border border-dark-border text-white rounded-lg px-4 py-2.5 focus:outline-none focus:border-brand-500 transition-all appearance-none cursor-pointer">
                        <option value="IDR">IDR - Indonesian Rupiah</option>
                        <option value="USD">USD - United States Dollar</option>
                        <option value="EUR">EUR - Euro</option>
                        <option value="JPY">JPY - Japanese Yen</option>
                    </select>
                    <p class="text-xs text-gray-500 mt-2">This currency will be used throughout the app</p>
                </div>

                <div class="bg-brand-500/10 border border-brand-500/20 rounded-lg p-4 transition-all"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0">
                    <h4 class="text-brand-500 font-bold text-sm">Current Settings</h4>
                    <div class="mt-1 text-sm text-brand-500/80">
                        <p>Currency: <span x-text="currency"></span></p>
                        <p>Format: <span
                                x-text="currency === 'IDR' ? 'Rp 1.000.000' : (currency === 'USD' ? '$1,000.00' : '€1.000,00')"></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div x-show="showToast" style="display: none;" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-10"
            class="fixed bottom-6 right-6 bg-brand-500 text-white px-6 py-3 rounded-lg shadow-xl flex items-center gap-3 z-50">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span class="font-medium">Changes saved successfully!</span>
        </div>

    </div>

    <script>
        function profileManager() {
            return {
                user: {
                    name: 'Kevin Setiawan',
                    email: 'kevin@wawan.com'
                },
                currency: 'IDR',
                isLoadingProfile: false,
                isLoadingPassword: false,
                showToast: false,

                updateProfile() {
                    this.isLoadingProfile = true;
                    // Simulate API call
                    setTimeout(() => {
                        this.isLoadingProfile = false;
                        this.triggerToast();
                    }, 1000);
                },

                updatePassword() {
                    this.isLoadingPassword = true;
                    setTimeout(() => {
                        this.isLoadingPassword = false;
                        this.triggerToast();
                    }, 1500);
                },

                triggerToast() {
                    this.showToast = true;
                    setTimeout(() => this.showToast = false, 3000);
                }
            }
        }
    </script>

</x-app>
