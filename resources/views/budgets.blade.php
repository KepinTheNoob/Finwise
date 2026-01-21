<x-app title="Budgets">
    <script>
        window.budgetsData = @json($budgets ?? []);
        window.currencyData = @json(auth()->user()->currency ?? 'IDR');
        window.categoryCount = {{ $categories->count() }};
    </script>

    <script src="{{ asset('js/budget.js') }}"></script>

    <div x-data="budgetManager()" class="relative h-full flex flex-col" x-cloak>

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8 shrink-0">
            <div>
                <h1 class="text-3xl font-bold text-white">Budgets</h1>
                <p class="text-gray-400 mt-1">Set spending limits and track your progress</p>
            </div>

            <button @click="checkCategories()" x-show="budgets.length > 0"
                class="flex items-center gap-2 bg-brand-500 hover:bg-brand-600 text-white px-5 py-2.5 rounded-lg font-medium transition-all shadow-lg shadow-brand-500/20 active:scale-95">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Budget
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 shrink-0">
            <div
                class="bg-dark-surface p-6 rounded-xl border border-dark-border shadow-lg flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm font-medium">Total Budgets</p>
                    <h3 class="text-2xl font-bold text-white mt-1" x-text="budgets.length"></h3>
                </div>
                <div class="w-10 h-10 rounded-full bg-brand-500/20 text-brand-500 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                    </svg>
                </div>
            </div>
            <div
                class="bg-dark-surface p-6 rounded-xl border border-dark-border shadow-lg flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm font-medium">Total Limit</p>
                    <h3 class="text-2xl font-bold text-white mt-1" x-text="formatCurrency(totalLimit)"></h3>
                </div>
                <div class="w-10 h-10 rounded-full bg-blue-500/20 text-blue-500 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                </div>
            </div>
            <div
                class="bg-dark-surface p-6 rounded-xl border border-dark-border shadow-lg flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm font-medium">Total Spent</p>
                    <h3 class="text-2xl font-bold text-white mt-1" x-text="formatCurrency(totalSpent)"></h3>
                </div>
                <div class="w-10 h-10 rounded-full bg-orange-500/20 text-orange-500 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
                    </svg>
                </div>
            </div>
        </div>

        <div x-show="budgets.length > 0" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-5" x-transition:enter-end="opacity-100 translate-y-0"
            class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-6 pb-8">

            <template x-for="budget in paginatedBudgets" :key="budget.id">
                <div
                    class="bg-dark-surface p-6 rounded-xl border border-dark-border shadow-lg hover:border-brand-500/30 transition-all duration-300">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <div class="flex items-center gap-3">
                                <h3 class="text-xl font-bold text-white" x-text="budget.category"></h3>
                                <span x-show="Number(budget.spent) > Number(budget.limit)"
                                    class="flex items-center gap-1 text-xs text-red-500 bg-red-500/10 px-2 py-0.5 rounded border border-red-500/20">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Over Budget!
                                </span>
                            </div>
                            <p class="text-sm text-gray-400 mt-1" x-text="budget.period + ' Budget'"></p>
                        </div>
                        <div class="flex gap-2">
                            <button @click="openEditModal(budget)"
                                class="p-2 bg-[#18181b] border border-dark-border rounded-lg text-gray-400 hover:text-white hover:border-brand-500 transition-all">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </button>
                            <button @click="confirmDelete(budget.id)"
                                class="p-2 bg-[#18181b] border border-dark-border rounded-lg text-gray-400 hover:text-red-500 hover:border-red-500 transition-all">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="flex justify-between items-end mb-2 text-sm">
                        <div><span class="text-gray-400">Spent:</span> <span class="text-white font-semibold ml-1"
                                x-text="formatCurrency(budget.spent)"></span></div>
                        <div class="text-right"><span class="text-gray-400">Limit:</span> <span
                                class="text-white font-semibold ml-1" x-text="formatCurrency(budget.limit)"></span>
                        </div>
                    </div>
                    <div class="w-full bg-[#18181b] rounded-full h-3 overflow-hidden relative">
                        <div class="h-3 rounded-full transition-all duration-1000 ease-out relative"
                            :class="Number(budget.spent) > Number(budget.limit) ? 'bg-red-500' : 'bg-brand-500'"
                            :style="`width: ${calculatePercentage(budget.spent, budget.limit)}%`"></div>
                    </div>
                    <div class="flex justify-between items-center mt-2 text-xs">
                        <span class="font-bold"
                            :class="Number(budget.spent) > Number(budget.limit) ? 'text-red-500' : 'text-brand-500'"
                            x-text="calculatePercentage(budget.spent, budget.limit) + '%'"></span>
                        <span class="text-gray-500">
                            <template x-if="Number(budget.spent) <= Number(budget.limit)"><span><span
                                        x-text="formatCurrency(budget.limit - budget.spent)"></span>
                                    remaining</span></template>
                            <template x-if="Number(budget.spent) > Number(budget.limit)"><span
                                    class="text-red-400"><span
                                        x-text="formatCurrency(budget.spent - budget.limit)"></span>
                                    excess</span></template>
                        </span>
                    </div>
                </div>
            </template>
        </div>

        <div x-show="budgets.length === 0" x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0"
            class="flex-1 flex flex-col items-center justify-center text-center -mt-10">

            <div class="relative mb-6 group cursor-pointer" @click="checkCategories()">
                <div
                    class="absolute inset-0 bg-brand-500/20 blur-xl rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                </div>
                <div
                    class="relative w-24 h-24 bg-[#18181b] border-2 border-dashed border-[#333] rounded-full flex items-center justify-center group-hover:border-brand-500/50 transition-colors duration-300">
                    <svg class="w-10 h-10 text-gray-600 group-hover:text-brand-500 transition-colors duration-300"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <div
                        class="absolute -bottom-1 -right-1 w-8 h-8 bg-brand-500 rounded-full flex items-center justify-center border-4 border-[#202022]">
                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                </div>
            </div>

            <h3 class="text-xl font-bold text-white mb-2">No Budgets Set</h3>
            <p class="text-gray-400 text-sm max-w-sm mb-8 leading-relaxed">
                Take control of your finances by setting spending limits for different categories.
            </p>

        </div>

        <div x-show="totalPages > 1"
            class="fixed bottom-6 right-6 z-40 bg-dark-surface border border-dark-border rounded-xl px-5 py-3 shadow-2xl flex items-center gap-4">
            <p class="text-sm text-gray-400 whitespace-nowrap">Page <span class="text-white font-semibold"
                    x-text="currentPage"></span> of <span class="text-white font-semibold"
                    x-text="totalPages"></span></p>
            <div class="flex items-center gap-1">
                <button @click="prevPage()" :disabled="currentPage === 1"
                    class="px-2 py-1 rounded-md text-gray-400 hover:text-white disabled:opacity-30">‹</button>
                <template x-for="page in [1, 2]" :key="'start-' + page"><button x-show="page <= totalPages"
                        @click="goToPage(page)" class="w-8 h-8 rounded-md text-sm font-medium"
                        :class="page === currentPage ? 'bg-brand-500 text-white' :
                            'text-gray-400 hover:text-white hover:bg-white/10'"><span
                            x-text="page"></span></button></template>
                <button x-show="totalPages > 4" @click="jumpOpen = true"
                    class="px-2 text-gray-400 hover:text-white">...</button>
                <template x-for="page in [totalPages - 1, totalPages]" :key="'end-' + page"><button
                        x-show="page > 2" @click="goToPage(page)" class="w-8 h-8 rounded-md text-sm font-medium"
                        :class="page === currentPage ? 'bg-brand-500 text-white' :
                            'text-gray-400 hover:text-white hover:bg-white/10'"><span
                            x-text="page"></span></button></template>
                <button @click="nextPage()" :disabled="currentPage === totalPages"
                    class="px-2 py-1 rounded-md text-gray-400 hover:text-white disabled:opacity-30">›</button>
            </div>
            <div x-show="jumpOpen" @click.outside="jumpOpen = false"
                class="absolute bottom-14 right-0 bg-dark-bg border border-dark-border rounded-lg p-3 shadow-xl w-40">
                <p class="text-xs text-gray-400 mb-2">Jump to page</p>
                <input type="number" min="1" :max="totalPages" x-model.number="jumpPage"
                    @keydown.enter="goToPage(jumpPage); jumpOpen=false"
                    class="w-full bg-[#18181b] border border-[#333] text-white rounded-md px-3 py-2 text-sm">
                <button @click="goToPage(jumpPage); jumpOpen=false"
                    class="w-full mt-2 bg-brand-500 hover:bg-brand-600 text-white text-sm py-1.5 rounded-md">Go</button>
            </div>
        </div>

        <div x-show="isFormModalOpen" style="display: none;"
            class="fixed inset-0 z-60 flex items-center justify-center px-4"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" @click="closeFormModal()"></div>
            <div class="bg-[#202022] w-full max-w-md rounded-2xl border border-[#333] shadow-2xl relative z-10 overflow-hidden transform transition-all"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95 translate-y-5"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 translate-y-5">
                <div class="p-6 border-b border-[#333]">
                    <h3 class="text-xl font-bold text-white" x-text="isEditing ? 'Edit Budget' : 'Add New Budget'">
                    </h3>
                    <p class="text-sm text-gray-400 mt-1">Set a spending limit for a category</p>
                </div>
                <div class="p-6 space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Category</label>
                        <select x-model="form.category_id"
                            class="w-full bg-[#18181b] border border-[#333] text-white rounded-lg px-4 py-2.5 focus:outline-none focus:border-brand-500 transition-all cursor-pointer">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Budget Limit (IDR)</label>
                        <input type="number" x-model="form.amount" placeholder="0"
                            class="w-full bg-[#18181b] border border-[#333] text-white rounded-lg px-4 py-2.5 focus:outline-none focus:border-brand-500 transition-all placeholder-gray-600">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Period</label>
                        <select x-model="form.period"
                            class="w-full bg-[#18181b] border border-[#333] text-white rounded-lg px-4 py-2.5 focus:outline-none focus:border-brand-500 transition-all cursor-pointer">
                            <option value="Monthly">Monthly</option>
                            <option value="Weekly">Weekly</option>
                            <option value="Yearly">Yearly</option>
                        </select>
                    </div>
                </div>
                <div class="p-6 pt-0">
                    <button @click="saveBudget()"
                        class="w-full bg-brand-500 hover:bg-brand-600 text-white font-bold py-3 rounded-lg transition-all shadow-lg shadow-brand-500/25"
                        x-text="isEditing ? 'Update Budget' : 'Save Budget'"></button>
                    <button @click="closeFormModal()"
                        class="w-full text-gray-500 hover:text-white mt-4 text-sm font-medium transition-colors">Cancel</button>
                </div>
            </div>
        </div>

        <div x-show="isDeleteModalOpen" style="display: none;"
            class="fixed inset-0 z-60 flex items-center justify-center px-4"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" @click="isDeleteModalOpen = false"></div>
            <div
                class="bg-[#202022] w-full max-w-sm rounded-2xl border border-[#333] shadow-2xl relative z-10 p-6 text-center transform transition-all">
                <div
                    class="w-16 h-16 bg-red-500/10 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Delete Budget?</h3>
                <p class="text-gray-400 text-sm mb-6">Are you sure you want to delete this budget plan?</p>
                <div class="flex gap-3">
                    <button @click="isDeleteModalOpen = false"
                        class="flex-1 bg-[#333] hover:bg-[#444] text-white py-2.5 rounded-lg font-medium transition-colors">Cancel</button>
                    <button @click="deleteBudget()"
                        class="flex-1 bg-red-500 hover:bg-red-600 text-white py-2.5 rounded-lg font-medium transition-colors shadow-lg">Delete</button>
                </div>
            </div>
        </div>

        <div x-show="isNoCategoryModalOpen" style="display: none;"
            class="fixed inset-0 z-70 flex items-center justify-center px-4"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="absolute inset-0 bg-black/80 backdrop-blur-sm" @click="isNoCategoryModalOpen = false"></div>
            <div class="bg-[#202022] w-full max-w-sm rounded-2xl border border-[#333] shadow-2xl relative z-10 p-8 pb-6 text-center transform transition-all"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90 translate-y-4"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-90 translate-y-4">
                <div class="relative w-20 h-20 mx-auto mb-6">
                    <div class="absolute inset-0 bg-orange-500/20 rounded-full animate-ping opacity-75"></div>
                    <div
                        class="relative w-20 h-20 bg-[#2A2A2E] rounded-full flex items-center justify-center border-2 border-orange-500/30">
                        <svg class="w-10 h-10 text-orange-500" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Categories Required</h3>
                <p class="text-gray-400 text-sm mb-8 leading-relaxed">You need to create at least one category before
                    you can add a budget.</p>
                <div class="flex flex-col gap-3">
                    <a href="{{ route('categories.index') }}"
                        class="group w-full bg-brand-500 hover:bg-brand-600 text-white font-bold py-3.5 rounded-xl transition-all shadow-lg shadow-brand-500/20 flex items-center justify-center gap-2 active:scale-[0.98]">
                        <span>Create Category</span>
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                    <button @click="isNoCategoryModalOpen = false"
                        class="w-full text-gray-500 hover:text-white py-2 text-md font-medium transition-colors mt-4">Cancel</button>
                </div>
            </div>
        </div>

    </div>
</x-app>
