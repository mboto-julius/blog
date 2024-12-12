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
                                <button class="btn btn-warning btn-sm mx-2">
                                    Edit
                                </button>
                                <button
                                    class="btn btn-danger btn-sm"
                                    @click="deleteCategory(category.id)"
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /Table -->

            <!-- Modal -->
            <medium-modal v-if="modal" @close="closeModal">
                <template #header>Add Category</template>
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
                    <button class="btn btn-primary" @click="store">Save</button>
                </template>
            </medium-modal>
            <!-- /Modal -->
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";

export default {
    data() {
        return {
            modal: false,
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
            this.category = {};
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
    },

    created() {
        this.getCategories();
    },
};
</script>
