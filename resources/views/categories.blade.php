<x-app title="Categories">

    <script>
        window.categoriesData = @json($categories ?? []);
    </script>
    <script src="{{ asset('js/categories.js') }}"></script>

    <div x-data="categoryManager()" class="relative min-h-screen flex flex-col">


        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8 shrink-0">
            <div>
                <h1 class="text-3xl font-bold text-white">Categories</h1>
                <p class="text-gray-400 mt-1">Organize your transactions with categories</p>
            </div>

            <button x-show="categories.length > 0" @click="openAddModal()"
                class="flex items-center gap-2 bg-brand-500 hover:bg-brand-600 text-white px-5 py-2.5 rounded-lg font-medium transition-all shadow-lg shadow-brand-500/20 active:scale-95">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Category
            </button>
        </div>

        <div x-show="categories.length > 0" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-5" x-transition:enter-end="opacity-100 translate-y-0"
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 pb-8">

            <template x-for="cat in paginatedCategories" :key="cat.id">
                <div
                    class="bg-dark-surface rounded-xl border border-dark-border overflow-hidden group hover:border-brand-500/30 transition-all duration-300">
                    <div class="p-6 flex items-center gap-4">
                        <div class="w-14 h-14 rounded-full flex items-center justify-center text-white shadow-lg shrink-0"
                            :style="`background-color: ${cat.color}20; color: ${cat.color}`">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-white font-bold text-lg" x-text="cat.name"></h3>
                            <p class="text-gray-500 text-sm" x-text="(cat.transactions_count || 0) + ' Transactions'">
                            </p>

                            {{-- <span
                                class="text-[10px] uppercase font-bold tracking-wider px-2 py-0.5 rounded mt-1 inline-block border border-opacity-20"
                                :class="cat.type === 'Income' ? 'bg-green-500/10 text-green-500 border-green-500' :
                                    'bg-red-500/10 text-red-500 border-red-500'"
                                x-text="cat.type">
                            </span> --}}
                        </div>
                    </div>

                    <div class="flex border-t border-dark-border divide-x divide-dark-border">
                        <button @click="openEditModal(cat)"
                            class="flex-1 py-3 text-sm font-medium text-gray-400 hover:text-white hover:bg-white/5 transition-colors flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            Edit
                        </button>
                        <button @click="confirmDelete(cat.id)"
                            class="flex-1 py-3 text-sm font-medium text-gray-400 hover:text-red-500 hover:bg-red-500/10 transition-colors flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Delete
                        </button>
                    </div>
                </div>
            </template>
        </div>

        <div x-show="categories.length === 0" x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0"
            class="flex-1 flex flex-col items-center justify-center pb-20 text-center -mt-10">

            <div class="relative mb-6 group cursor-pointer" @click="openAddModal()">
                <div
                    class="absolute inset-0 bg-brand-500/20 blur-xl rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                </div>

                <div
                    class="relative w-24 h-24 bg-[#18181b] border-2 border-dashed border-[#333] rounded-full flex items-center justify-center group-hover:border-brand-500/50 transition-colors duration-300">
                    <svg class="w-10 h-10 text-gray-600 group-hover:text-brand-500 transition-colors duration-300"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>

                    <div
                        class="absolute -bottom-1 -right-1 w-8 h-8 bg-brand-500 rounded-full flex items-center justify-center border-4 border-[#202022]">
                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                </div>
            </div>

            <h3 class="text-xl font-bold text-white mb-2">No Categories Yet</h3>
            <p class="text-gray-400 text-sm max-w-sm mb-8 leading-relaxed">
                Create categories to organize your income and expenses effectively.
            </p>


        </div>

        <div x-show="totalPages > 1"
            class="fixed bottom-6 right-6 z-40 bg-dark-surface border border-dark-border rounded-xl px-5 py-3 shadow-2xl flex items-center gap-4">

            <p class="text-sm text-gray-400 whitespace-nowrap">
                Page
                <span class="text-white font-semibold" x-text="currentPage"></span>
                of
                <span class="text-white font-semibold" x-text="totalPages"></span>
            </p>

            <div class="flex items-center gap-1">

                <button @click="prevPage()" :disabled="currentPage === 1"
                    class="px-2 py-1 rounded-md text-gray-400 hover:text-white disabled:opacity-30">
                    ‹
                </button>

                <template x-for="page in [1, 2]" :key="'start-' + page">
                    <button x-show="page <= totalPages" @click="goToPage(page)"
                        class="w-8 h-8 rounded-md text-sm font-medium"
                        :class="page === currentPage ?
                            'bg-brand-500 text-white' :
                            'text-gray-400 hover:text-white hover:bg-white/10'">
                        <span x-text="page"></span>
                    </button>
                </template>

                <button x-show="totalPages > 4" @click="jumpOpen = true" class="px-2 text-gray-400 hover:text-white">
                    ...
                </button>

                <template x-for="page in [totalPages - 1, totalPages]" :key="'end-' + page">
                    <button x-show="page > 2" @click="goToPage(page)" class="w-8 h-8 rounded-md text-sm font-medium"
                        :class="page === currentPage ?
                            'bg-brand-500 text-white' :
                            'text-gray-400 hover:text-white hover:bg-white/10'">
                        <span x-text="page"></span>
                    </button>
                </template>

                <button @click="nextPage()" :disabled="currentPage === totalPages"
                    class="px-2 py-1 rounded-md text-gray-400 hover:text-white disabled:opacity-30">
                    ›
                </button>
            </div>

            <div x-show="jumpOpen" @click.outside="jumpOpen = false"
                class="absolute bottom-14 right-0 bg-dark-bg border border-dark-border rounded-lg p-3 shadow-xl w-40">

                <p class="text-xs text-gray-400 mb-2">Jump to page</p>

                <input type="number" min="1" :max="totalPages" x-model.number="jumpPage"
                    @keydown.enter="goToPage(jumpPage); jumpOpen=false"
                    class="w-full bg-[#18181b] border border-[#333] text-white rounded-md px-3 py-2 text-sm">

                <button @click="goToPage(jumpPage); jumpOpen=false"
                    class="w-full mt-2 bg-brand-500 hover:bg-brand-600 text-white text-sm py-1.5 rounded-md">
                    Go
                </button>
            </div>
        </div>


        <div x-show="isModalOpen" style="display: none;"
            class="fixed inset-0 z-60 flex items-center justify-center px-4"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

            <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" @click="closeModal()"></div>

            <div class="bg-[#202022] w-full max-w-md rounded-2xl border border-[#333] shadow-2xl relative z-10 overflow-hidden transform transition-all"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95 translate-y-5"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 translate-y-5">

                <div class="p-6 border-b border-[#333]">
                    <h3 class="text-xl font-bold text-white" x-text="isEditing ? 'Edit Category' : 'Add Category'">
                    </h3>
                    <p class="text-sm text-gray-400 mt-1"
                        x-text="isEditing ? 'Update your category details' : 'Create a new category for your transactions'">
                    </p>
                </div>

                <div class="p-6 space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Category Name</label>
                        <input type="text" x-model="form.name" placeholder="e.g., Food, Transport"
                            class="w-full bg-[#18181b] border border-[#333] text-white rounded-lg px-4 py-3 focus:outline-none focus:border-brand-500 focus:ring-1 focus:ring-brand-500 transition-all placeholder-gray-600">
                    </div>

                    {{-- <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Type</label>
                        <select x-model="form.type"
                            class="w-full bg-[#18181b] border border-[#333] text-white rounded-lg px-4 py-3 focus:outline-none focus:border-brand-500 focus:ring-1 focus:ring-brand-500 transition-all cursor-pointer">
                            <option value="Expense">Expense</option>
                            <option value="Income">Income</option>
                        </select>
                    </div> --}}

                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Color</label>
                        <div class="flex gap-3">
                            <div
                                class="relative w-14 h-12 rounded-lg border border-[#333] overflow-hidden cursor-pointer">
                                <input type="color" x-model="form.color"
                                    class="absolute -top-2 -left-2 w-20 h-20 cursor-pointer p-0 border-0">
                            </div>
                            <input type="text" x-model="form.color" placeholder="#000000" maxlength="7"
                                class="flex-1 bg-[#18181b] border border-[#333] text-white rounded-lg px-4 py-3 focus:outline-none focus:border-brand-500 focus:ring-1 focus:ring-brand-500 transition-all uppercase placeholder-gray-600">
                        </div>
                    </div>
                </div>

                <div class="p-6 pt-0">
                    <button @click="saveCategory()"
                        class="w-full bg-brand-500 hover:bg-brand-600 text-white font-bold py-3 rounded-lg transition-all transform active:scale-[0.98] shadow-lg shadow-brand-500/25"
                        x-text="isEditing ? 'Update Category' : 'Add Category'">
                    </button>
                    <button @click="closeModal()"
                        class="w-full text-gray-500 hover:text-white mt-4 text-sm font-medium transition-colors">
                        Cancel
                    </button>
                </div>
            </div>
        </div>



        <div x-show="isDeleteModalOpen" style="display: none;"
            class="fixed inset-0 z-60 flex items-center justify-center px-4"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

            <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" @click="isDeleteModalOpen = false"></div>
            <div class="bg-[#202022] w-full max-w-sm rounded-2xl border border-[#333] shadow-2xl relative z-10 p-6 text-center transform transition-all"
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">

                <div
                    class="w-16 h-16 bg-red-500/10 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Delete Category?</h3>
                <p class="text-gray-400 text-sm mb-6">Are you sure you want to delete this category?</p>

                <div class="flex gap-3">
                    <button @click="isDeleteModalOpen = false"
                        class="flex-1 bg-[#333] hover:bg-[#444] text-white py-2.5 rounded-lg font-medium transition-colors">Cancel</button>
                    <button @click="deleteCategory()"
                        class="flex-1 bg-red-500 hover:bg-red-600 text-white py-2.5 rounded-lg font-medium transition-colors shadow-lg shadow-red-500/20">Delete</button>
                </div>
            </div>
        </div>

    </div>
</x-app>
