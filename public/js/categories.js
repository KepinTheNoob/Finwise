function categoryManager() {
    return {
        isModalOpen: false,
        isDeleteModalOpen: false,
        isEditing: false,
        deleteId: null,

        currentPage: 1,
        perPage: 12,
        jumpOpen: false,
        jumpPage: null,

        categories: window.categoriesData || [],

        form: {
            id: null,
            name: "",
            type: "Expense",
            color: "#10B981",
        },

        openAddModal() {
            this.isEditing = false;
            this.form = {
                id: null,
                name: "",
                type: "Expense",
                color: "#10B981",
            };
            this.isModalOpen = true;
        },

        openEditModal(cat) {
            this.isEditing = true;
            this.form = { ...cat };
            this.isModalOpen = true;
        },

        closeModal() {
            this.isModalOpen = false;
        },

        confirmDelete(id) {
            this.deleteId = id;
            this.isDeleteModalOpen = true;
        },

        get totalPages() {
            return Math.ceil(this.categories.length / this.perPage);
        },

        get paginatedCategories() {
            const start = (this.currentPage - 1) * this.perPage;
            return this.categories.slice(start, start + this.perPage);
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

        resetPagination() {
            this.currentPage = 1;
        },

        async saveCategory() {
            const url = this.isEditing
                ? `/categories/${this.form.id}`
                : `/categories`;

            const method = this.isEditing ? "PUT" : "POST";

            const csrfToken = document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content");

            const response = await fetch(url, {
                method,
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                    Accept: "application/json",
                },
                body: JSON.stringify(this.form),
            });

            const saved = await response.json();

            if (this.isEditing) {
                const i = this.categories.findIndex((c) => c.id === saved.id);
                this.categories[i] = saved;
            } else {
                this.categories.push(saved);
            }

            this.closeModal();
            this.resetPagination();
        },

        async deleteCategory() {
            const csrfToken = document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content");

            await fetch(`/categories/${this.deleteId}`, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
            });

            this.categories = this.categories.filter(
                (c) => c.id !== this.deleteId,
            );

            this.isDeleteModalOpen = false;
            this.deleteId = null;
            this.resetPagination();
        },
    };
}
