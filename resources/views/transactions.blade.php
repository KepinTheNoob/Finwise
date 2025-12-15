<x-app>
    <div x-data="transactionManager()" class="relative">

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-white">Transactions</h1>
                <p class="text-gray-400 mt-1">Manage your income and expenses</p>
            </div>
            <button @click="openAddModal()"
                class="flex items-center gap-2 bg-brand-500 hover:bg-brand-600 text-white px-5 py-2.5 rounded-lg font-medium transition-all shadow-lg shadow-brand-500/20 active:scale-95">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Transaction
            </button>
        </div>

        <div class="bg-dark-surface p-4 rounded-xl border border-dark-border mb-6 flex flex-col md:flex-row gap-4">
            <div class="relative flex-1">
                <svg class="w-5 h-5 text-gray-500 absolute left-3 top-1/2 -translate-y-1/2" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" x-model="search" placeholder="Search transactions..."
                    class="w-full bg-dark-bg border border-dark-border text-white text-sm rounded-lg pl-10 pr-4 py-2.5 focus:outline-none focus:border-brand-500 transition-colors">
            </div>
            <div x-data="{ open: false, selected: 'all' }" class="relative">
                <button @click="open = !open" @click.outside="open = false"
                    class="w-full flex items-center gap-2 bg-dark-bg border border-dark-border text-white text-sm rounded-lg pl-4 pr-3 py-2.5 focus:outline-none focus:border-brand-500 transition-colors cursor-pointer text-left">
                    <span x-text="selected === 'all' ? 'All Types' : selected"></span>

                    <svg class="w-4 h-4 text-gray-400 transition-transform duration-200 ease-in-out"
                        :class="open ? 'rotate-180' : 'rotate-0'" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="open" x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                    x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                    class="absolute left-0 z-50 mt-1 w-full bg-dark-bg border border-dark-border rounded-lg shadow-xl overflow-hidden"
                    style="display: none;">

                    <div class="py-1">
                        <button @click="selected = 'all'; filterType = 'all'; open = false"
                            class="w-full text-left px-4 py-2 text-sm text-white hover:bg-white/10 transition-colors"
                            :class="selected === 'all' ? 'bg-brand-500/10 text-brand-500' : ''">
                            All Types
                        </button>
                        <button @click="selected = 'Income'; filterType = 'Income'; open = false"
                            class="w-full text-left px-4 py-2 text-sm text-white hover:bg-white/10 transition-colors"
                            :class="selected === 'Income' ? 'bg-brand-500/10 text-brand-500' : ''">
                            Income
                        </button>
                        <button @click="selected = 'Expense'; filterType = 'Expense'; open = false"
                            class="w-full text-left px-4 py-2 text-sm text-white hover:bg-white/10 transition-colors"
                            :class="selected === 'Expense' ? 'bg-brand-500/10 text-brand-500' : ''">
                            Expense
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-dark-surface rounded-xl border border-dark-border overflow-hidden min-h-[400px]">
            <div class="p-6 border-b border-dark-border">
                <h3 class="text-white font-semibold" x-text="`All Transactions (${filteredTransactions.length})`"></h3>
            </div>

            <div class="divide-y divide-dark-border">
                <template x-for="trx in filteredTransactions" :key="trx.id">
                    <div class="p-5 flex items-center justify-between hover:bg-white/5 transition-colors group">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center transition-transform group-hover:scale-110"
                                :class="trx.type === 'Income' ? 'bg-brand-500/20 text-brand-500' :
                                    'bg-red-500/20 text-red-500'">
                                <svg x-show="trx.type === 'Income'" class="w-6 h-6 transform -rotate-45" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                                <svg x-show="trx.type === 'Expense'" class="w-6 h-6 transform rotate-45" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </div>

                            <div>
                                <p class="text-white font-semibold text-lg" x-text="trx.desc"></p>
                                <p class="text-sm text-gray-500 flex items-center gap-2">
                                    <span x-text="trx.category"></span>
                                    <span class="w-1 h-1 rounded-full bg-gray-600"></span>
                                    <span x-text="formatDate(trx.date)"></span>
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-6">
                            <span class="font-bold text-lg hidden md:block"
                                :class="trx.type === 'Income' ? 'text-brand-500' : 'text-red-500'"
                                x-text="(trx.type === 'Income' ? '+' : '-') + formatCurrency(trx.amount)">
                            </span>

                            <div class="flex items-center gap-2">
                                <button @click="openEditModal(trx)"
                                    class="p-2 text-gray-400 hover:text-white hover:bg-white/10 rounded-lg transition-all"
                                    title="Edit">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </button>
                                <button @click="confirmDelete(trx.id)"
                                    class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-500/10 rounded-lg transition-all"
                                    title="Delete">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </template>

                <div x-show="filteredTransactions.length === 0" class="p-10 text-center text-gray-500">
                    <p>No transactions found.</p>
                </div>
            </div>
        </div>

        <div x-show="isFormModalOpen" style="display: none;"
            class="fixed inset-0 z-60 flex items-center justify-center px-4"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

            <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" @click="closeFormModal()"></div>

            <div class="absolute inset-0 bg-black/70" @click="closeFormModal()"></div>

            <div class="bg-[#202022] w-full max-w-lg rounded-2xl p-6 z-10" @click.outside="closeFormModal()">

                <h3 class="text-xl font-bold text-white mb-4"
                    x-text="isEditing ? 'Edit Transaction' : 'Add Transaction'"></h3>

                <form method="POST" :action="isEditing ? '/transactions/' + form.id : '/transactions'">
                    @csrf

                    <input type="hidden" name="_method" value="PUT" :disabled="!isEditing">

                    <div class="mb-4">
                        <label class="text-gray-400 text-sm">Description</label>
                        <input name="description" x-model="form.description" required
                            class="w-full bg-[#18181b] border border-[#333] text-white rounded-lg px-4 py-2.5">
                    </div>

                    <div class="mb-4">
                        <label class="text-gray-400 text-sm">Amount</label>
                        <input name="amount" type="number" x-model="form.amount" required
                            class="w-full bg-[#18181b] border border-[#333] text-white rounded-lg px-4 py-2.5">
                    </div>

                    <div class="mb-4">
                        <label class="text-gray-400 text-sm">Type</label>
                        <select name="type" x-model="form.type"
                            class="w-full bg-[#18181b] border border-[#333] text-white rounded-lg px-4 py-2.5">
                            <option value="income">Income</option>
                            <option value="expense">Expense</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="text-gray-400 text-sm">Category</label>
                        <select name="category_id" x-model="form.category_id"
                            class="w-full bg-[#18181b] border border-[#333] text-white rounded-lg px-4 py-2.5">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="text-gray-400 text-sm">Date</label>
                        <input name="transaction_date" type="date" x-model="form.transaction_date" required
                            class="w-full bg-[#18181b] border border-[#333] text-white rounded-lg px-4 py-2.5">
                    </div>

                    <div class="flex gap-3">
                        <button type="button" @click="closeFormModal()"
                            class="flex-1 bg-gray-700 text-white py-2 rounded-lg hover:bg-gray-600 transition-colors">
                            Cancel
                        </button>
                        <button type="submit"
                            class="flex-1 bg-brand-500 text-white py-2 rounded-lg font-bold hover:bg-brand-600 transition-colors"
                            x-text="isEditing ? 'Update' : 'Save'">
                        </button>
                    </div>
                </form>
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

                <h3 class="text-xl font-bold text-white mb-2">Delete Transaction?</h3>
                <p class="text-gray-400 text-sm mb-6">Are you sure you want to delete this transaction? This action
                    cannot be undone.</p>

                <div class="flex gap-3">
                    <button @click="isDeleteModalOpen = false"
                        class="flex-1 bg-[#333] hover:bg-[#444] text-white py-2.5 rounded-lg font-medium transition-colors">
                        Cancel
                    </button>
                    <button @click="deleteTransaction()"
                        class="flex-1 bg-red-500 hover:bg-red-600 text-white py-2.5 rounded-lg font-medium transition-colors shadow-lg shadow-red-500/20">
                        Delete
                    </button>
                </div>
            </div>
        </div>

    </div>

    <script>
        function transactionManager() {
            return {
                currency: @js(auth()->user()->currency ?? 'IDR'),

                currencyLocales: {
                    IDR: 'id-ID',
                    USD: 'en-US',
                    EUR: 'de-DE',
                    GBP: 'en-GB',
                    JPY: 'ja-JP'
                },

                isFormModalOpen: false,
                search: '',
                filterType: 'all',
                isDeleteModalOpen: false,
                isEditing: false,
                deleteId: null,

                transactions: @js(
    $transactions->map(
        fn($t) => [
            'id' => $t->id,
            'desc' => $t->description,
            'amount' => $t->amount,
            'type' => ucfirst($t->type),
            'category' => $t->category->name ?? 'Uncategorized',
            'category_id' => $t->category_id,
            'date' => $t->transaction_date?->format('Y-m-d'),
        ],
    ),
),

                form: {
                    id: null,
                    description: '',
                    amount: '',
                    type: 'expense',
                    category_id: '',
                    transaction_date: ''
                },

                get filteredTransactions() {
                    return this.transactions.filter(t => {
                        const matchesSearch = t.desc.toLowerCase().includes(this.search.toLowerCase());
                        const matchesType = this.filterType === 'all' || t.type === this.filterType;
                        return matchesSearch && matchesType;
                    });
                },

                openAddModal() {
                    this.isEditing = false;
                    this.form = {
                        id: null,
                        description: '',
                        amount: '',
                        type: 'expense',
                        category_id: '{{ $categories->first()->id ?? '' }}',
                        transaction_date: new Date().toISOString().split('T')[0]
                    };
                    this.isFormModalOpen = true;
                },

                openEditModal(trx) {
                    this.isEditing = true;
                    this.form = {
                        id: trx.id,
                        description: trx.desc,
                        amount: trx.amount,
                        type: trx.type.toLowerCase(),
                        category_id: trx.category_id,
                        transaction_date: trx.date
                    };
                    this.isFormModalOpen = true;
                },

                closeFormModal() {
                    this.isFormModalOpen = false;
                },

                confirmDelete(id) {
                    this.deleteId = id;
                    this.isDeleteModalOpen = true;
                },

                async deleteTransaction() {
                    const csrfToken = document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute('content');

                    const response = await fetch(`/transactions/${this.deleteId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        }
                    });

                    if (response.ok) {
                        this.transactions = this.transactions.filter(t => t.id !== this.deleteId);
                        this.isDeleteModalOpen = false;
                    } else {
                        alert('Failed to delete transaction');
                    }
                },

                formatCurrency(value) {
                    const locale = this.currencyLocales[this.currency] || 'en-US';

                    return new Intl.NumberFormat(locale, {
                        style: 'currency',
                        currency: this.currency,
                        minimumFractionDigits: 0
                    }).format(value);
                },

                formatDate(dateString) {
                    return new Date(dateString).toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: 'short',
                        day: 'numeric'
                    });
                }
            }
        }
    </script>
</x-app>
