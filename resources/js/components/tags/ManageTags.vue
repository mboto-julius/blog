<template>
    <div class="container">
        <div class="row">
            <!-- Header -->
            <div class="col-md-12 pt-5">
                <div class="d-flex justify-content-between align-items-center">
                    <h4>Tags</h4>
                    <button class="btn btn-primary" @click.prevent="openModal">
                        <i class="bi bi-plus-lg"></i> Add Tag
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
                        <tr v-for="(tag, index) in tagList" :key="tag.id">
                            <td>{{ index + 1 }}</td>
                            <td>{{ tag.name }}</td>
                            <td>
                                <button
                                    class="btn btn-primary btn-md mx-2"
                                    @click="editTag(tag)"
                                >
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="btn btn-danger btn-md">
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
                    <span v-if="add">Add Tag</span>
                    <span v-if="edit">Edit Tag</span>
                </template>
                <template #body>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input
                            type="text"
                            v-model="tag.name"
                            class="form-control my-3"
                            id="name"
                            placeholder="Enter tag name"
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

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                <pagination
                    :data="tags"
                    :limit="limit"
                    @pagination-change-page="fetchTags"
                />
            </div>
            <!-- /Pagination -->
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";

export default {
    data() {
        return {
            limit: 2,
            modal: false,
            deleteModal: false,
            add: true,
            edit: false,
            tag: {
                id: "",
                name: "",
            },
        };
    },

    computed: {
        ...mapGetters(["tags"]),

        tagList() {
            return this.tags.data;
        },
    },

    methods: {
        ...mapActions(["getTags"]),

        fetchTags(page = 1) {
            this.getTags(page);
        },

        openModal() {
            this.modal = true;
        },

        closeModal() {
            this.modal = false;
            this.add = true;
            this.edit = false;
            this.tag = {};
        },

        editTag(s) {
            this.tag = s;
            this.add = false;
            this.edit = true;
            this.modal = true;
        },

        store() {
            let data = {
                name: this.tag.name,
            };
            axios
                .post("/tags", data)
                .then((response) => {
                    if (response.data.success) {
                        this.closeModal();
                        this.$toast.success(response.data.message);
                        this.getTags();
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
                name: this.tag.name,
            };
            axios
                .put(`/tags/${this.tag.id}`, data)
                .then((response) => {
                    if (response.data.success) {
                        this.closeModal();
                        this.$toast.success(response.data.message);
                        this.getTags();
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
        this.fetchTags();
    },
};
</script>
