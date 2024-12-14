<template>
    <div class="container">
        <div class="row">
            <!-- Header -->
            <div class="col-md-12 pt-5">
                <div class="d-flex justify-content-between align-items-center">
                    <h4>Categories</h4>
                    <button class="btn btn-primary" @click.prevent="openModal">
                        <i class="bi bi-plus-lg"></i> Add Category
                    </button>
                </div>
            </div>
            <!-- /Header -->

            <!-- Table -->
            <div class="col-md-12 pt-4">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(category, index) in categories"
                            :key="category.id"
                        >
                            <th>{{ index + 1 }}</th>
                            <td>{{ category.name }}</td>
                            <td>
                                <button
                                    class="btn btn-primary btn-md mx-2"
                                    @click="editCategory(category)"
                                >
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button
                                    class="btn btn-danger btn-md"
                                    @click="deleteCategory(category)"
                                >
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /Table -->

            <!-- Modal -->
            <medium-modal v-if="modal" @close="closeModal">
                <template #header>
                    <span v-if="add">Add Category</span>
                    <span v-if="edit">Edit Category</span>
                </template>
                <template #body>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input
                            type="text"
                            v-model="category.name"
                            class="form-control my-3"
                            id="name"
                            placeholder="Enter category name"
                        />
                    </div>
                </template>
                <template #footer>
                    <button
                        v-if="add"
                        class="btn btn-primary"
                        @click.prevent="store"
                    >
                        Save
                    </button>
                    <button
                        v-if="edit"
                        class="btn btn-primary"
                        @click.prevent="update"
                    >
                        Save
                    </button>
                </template>
            </medium-modal>
            <!-- /Modal -->

            <!-- Confirmation dialog -->
            <confirm-dialog v-if="deleteModal" @close="closeDeleteModal">
                <template v-slot:header>
                    <span class="text-danger fw-bold"
                        >Delete Confirmation!</span
                    >
                </template>

                <template v-slot:body>
                    <div class="row">
                        <div class="col-md-12">
                            <p>Are you sure you want to delete this data?</p>
                        </div>
                    </div>
                </template>

                <template v-slot:footer>
                    <button @click.prevent="destroy" class="btn btn-danger">
                        Delete
                    </button>
                </template>
            </confirm-dialog>
            <!-- /Confirmation dialog -->
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";

export default {
    data() {
        return {
            modal: false,
            deleteModal: false,
            add: true,
            edit: false,
            category: {
                id: "",
                name: "",
            },
        };
    },

    computed: {
        ...mapGetters(["categories"]),
    },

    methods: {
        ...mapActions(["getCategories"]),

        openModal() {
            this.modal = true;
        },

        closeModal() {
            this.modal = false;
            this.add = true;
            this.edit = false;
            this.category = {};
        },

        closeDeleteModal() {
            this.deleteModal = false;
        },

        editCategory(s) {
            this.category = s;
            this.add = false;
            this.edit = true;
            this.modal = true;
        },

        deleteCategory(s) {
            this.category.id = s.id;
            this.deleteModal = true;
        },

        store() {
            let data = {
                name: this.category.name,
            };
            axios
                .post("/categories", data)
                .then((response) => {
                    if (response.data.success) {
                        this.closeModal();
                        this.$toast.success(response.data.message);
                        this.getCategories();
                    } else {
                        this.$toast.error(response.data.message);
                    }
                })
                .catch((error) => {
                    console.error(error);
                });
        },

        update() {
            let data = {
                name: this.category.name,
            };
            axios
                .put(`/categories/${this.category.id}`, data)
                .then((response) => {
                    if (response.data.success) {
                        this.closeModal();
                        this.$toast.success(response.data.message);
                        this.getCategories();
                    } else {
                        this.$toast.error(response.data.message);
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        destroy() {
            axios
                .delete("/categories/" + this.category.id)
                .then((response) => {
                    if (response.data.success) {
                        this.closeDeleteModal();
                        this.$toast.success(response.data.message);
                        this.getCategories();
                    } else {
                        this.$toast.error(response.data.message);
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },

    created() {
        this.getCategories();
    },
};
</script>
