function transactionManager() {
    return {
        currency: window.userCurrency ?? "IDR",
        categoryCount: window.categoryCount ?? 0,

        currencyLocales: {
            IDR: "id-ID",
            USD: "en-US",
            EUR: "de-DE",
            GBP: "en-GB",
            JPY: "ja-JP",
        },

        isFormModalOpen: false,
        isDeleteModalOpen: false,
        isNoCategoryModalOpen: false,

        isEditing: false,
        search: "",
        filterType: "all",
        deleteId: null,

        transactions: window.transactionsData ?? [],

        form: {
            id: null,
            description: "",
            amount: "",
            type: "expense",
            category_id: "",
            transaction_date: "",
        },

        currentPage: 1,
        perPage: 7,
        jumpOpen: false,
        jumpPage: null,

        init() {
            this.$watch("search", () => this.resetPagination());
            this.$watch("filterType", () => this.resetPagination());
        },

        get filteredTransactions() {
            return this.transactions.filter((t) => {
                const matchesSearch = t.desc
                    .toLowerCase()
                    .includes(this.search.toLowerCase());
                const matchesType =
                    this.filterType === "all" || t.type === this.filterType;
                return matchesSearch && matchesType;
            });
        },

        get totalPages() {
            return Math.ceil(this.filteredTransactions.length / this.perPage);
        },

        get paginatedTransactions() {
            const start = (this.currentPage - 1) * this.perPage;
            return this.filteredTransactions.slice(start, start + this.perPage);
        },

        checkCategories() {
            if (this.categoryCount === 0) {
                this.isNoCategoryModalOpen = true;
            } else {
                this.openAddModal();
            }
        },

        resetPagination() {
            this.currentPage = 1;
        },

        goToPage(page) {
            if (page < 1 || page > this.totalPages) return;
            this.currentPage = page;
        },

        nextPage() {
            if (this.currentPage < this.totalPages) {
                this.currentPage++;
            }
        },

        prevPage() {
            if (this.currentPage > 1) {
                this.currentPage--;
            }
        },

        openAddModal() {
            this.isEditing = false;
            this.form = {
                id: null,
                description: "",
                amount: "",
                type: "expense",
                category_id: window.defaultCategoryId ?? "",
                transaction_date: new Date().toISOString().split("T")[0],
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
                transaction_date: trx.date,
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
                .getAttribute("content");

            try {
                const response = await fetch(`/transactions/${this.deleteId}`, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                        Accept: "application/json",
                    },
                });

                if (response.ok) {
                    this.transactions = this.transactions.filter(
                        (t) => t.id !== this.deleteId,
                    );
                    this.isDeleteModalOpen = false;
                    this.resetPagination();
                } else {
                    alert("Failed to delete transaction");
                }
            } catch (error) {
                console.error(error);
                alert("Error deleting transaction");
            }
        },

        formatCurrency(value) {
            const locale = this.currencyLocales[this.currency] || "en-US";
            return new Intl.NumberFormat(locale, {
                style: "currency",
                currency: this.currency,
                minimumFractionDigits: 0,
            }).format(value);
        },

        formatDate(dateString) {
            return new Date(dateString).toLocaleDateString("en-US", {
                year: "numeric",
                month: "short",
                day: "numeric",
            });
        },
    };
}

window.transactionManager = transactionManager;
