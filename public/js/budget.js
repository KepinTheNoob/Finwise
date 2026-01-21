function budgetManager() {
    return {
        currency: window.currencyData || "IDR",
        categoryCount: window.categoryCount || 0,

        isFormModalOpen: false,
        isDeleteModalOpen: false,
        isNoCategoryModalOpen: false,

        isEditing: false,
        deleteId: null,

        budgets: window.budgetsData || [],

        form: {
            id: null,
            category_id: "",
            amount: "",
            period: "Monthly",
        },

        currentPage: 1,
        perPage: 3,
        jumpOpen: false,
        jumpPage: null,

        get totalLimit() {
            return this.budgets.reduce(
                (sum, item) => sum + Number(item.limit),
                0,
            );
        },

        get totalSpent() {
            return this.budgets.reduce((sum, item) => {
                return (
                    sum +
                    Number(item.spent || item.transactions_sum_amount || 0)
                );
            }, 0);
        },

        get totalPages() {
            return Math.ceil(this.budgets.length / this.perPage);
        },

        get paginatedBudgets() {
            const start = (this.currentPage - 1) * this.perPage;
            return this.budgets.slice(start, start + this.perPage);
        },

        checkCategories() {
            if (this.categoryCount === 0) {
                this.isNoCategoryModalOpen = true;
            } else {
                this.openAddModal();
            }
        },

        openAddModal() {
            this.isEditing = false;
            this.form = {
                id: null,
                category_id: "",
                amount: "",
                period: "Monthly",
            };
            this.isFormModalOpen = true;
        },

        openEditModal(budget) {
            this.isEditing = true;
            this.form = {
                id: budget.id,
                category_id: budget.category_id,
                amount: budget.limit,
                period: budget.period,
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

        goToPage(page) {
            if (!page || page < 1 || page > this.totalPages) return;
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

        async saveBudget() {
            const csrfToken = document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content");

            const url = this.isEditing
                ? `/budgets/${this.form.id}`
                : `/budgets`;

            const method = this.isEditing ? "PUT" : "POST";

            try {
                const response = await fetch(url, {
                    method,
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                        Accept: "application/json",
                    },
                    body: JSON.stringify(this.form),
                });

                if (response.ok) {
                    window.location.reload();
                } else {
                    const data = await response.json();
                    alert(data.message || "Error saving budget");
                }
            } catch (error) {
                console.error(error);
                alert("Network error");
            }
        },

        async deleteBudget() {
            const csrfToken = document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content");

            try {
                await fetch(`/budgets/${this.deleteId}`, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                        Accept: "application/json",
                    },
                });

                this.budgets = this.budgets.filter(
                    (b) => b.id !== this.deleteId,
                );
                this.isDeleteModalOpen = false;
                this.deleteId = null;

                if (
                    this.paginatedBudgets.length === 0 &&
                    this.currentPage > 1
                ) {
                    this.currentPage--;
                }
            } catch (error) {
                console.error(error);
                alert("Error deleting budget");
            }
        },

        formatCurrency(value) {
            const localeMap = {
                IDR: "id-ID",
                USD: "en-US",
                EUR: "de-DE",
                JPY: "ja-JP",
            };

            return new Intl.NumberFormat(localeMap[this.currency] || "en-US", {
                style: "currency",
                currency: this.currency,
                minimumFractionDigits: this.currency === "JPY" ? 0 : 2,
            }).format(value);
        },

        calculatePercentage(spent, limit) {
            if (Number(limit) === 0) return 0;
            return Math.min((Number(spent) / Number(limit)) * 100, 100).toFixed(
                1,
            );
        },
    };
}
