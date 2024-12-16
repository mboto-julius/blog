<template>
    <div class="container">
        <div class="row">
            <!-- Header -->
            <div class="col-md-12 pt-5">
                <div class="d-flex justify-content-between align-items-center">
                    <h4>Posts</h4>
                    <button class="btn btn-primary" @click.prevent="openModal">
                        <i class="bi bi-plus-lg"></i> Add Post
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
                            <th>Title</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(post, index) in postList" :key="post.id">
                            <th>{{ index + 1 }}</th>
                            <td>{{ post.title }}</td>
                            <td>{{ post.category.name }}</td>
                            <td>
                                <button class="btn btn-primary btn-md mx-2">
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

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                <pagination
                    :data="posts"
                    :limit="limit"
                    @pagination-change-page="fetchPosts"
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
            modal: false,
            deleteModal: false,
            add: true,
            edit: false,
            post: {
                id: "",
                name: "",
            },
        };
    },

    computed: {
        ...mapGetters(["posts"]),

        postList() {
            return this.posts.data;
        },
    },

    methods: {
        ...mapActions(["getPosts"]),

        fetchPosts(page = 1) {
            this.getPosts(page);
        },

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
    },

    created() {
        this.fetchPosts();
    },
};
</script>
