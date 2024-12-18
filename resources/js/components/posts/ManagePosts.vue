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
                                <button
                                    class="btn btn-success btn-md"
                                    @click.prevent="showPost(post)"
                                >
                                    <i class="bi bi-eye"></i>
                                </button>
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

            <!-- Modal -->
            <large-modal v-if="modal" @close="closeModal">
                <template #header>
                    <span v-if="add">Add Post</span>
                    <span v-if="edit">Edit Post</span>
                </template>
                <template #body>
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input
                            type="text"
                            v-model="post.name"
                            class="form-control mt-2"
                            id="name"
                            placeholder="Enter post name"
                        />
                    </div>
                    <div class="form-group mb-3">
                        <label for="category mb-2">Category</label>
                        <select
                            name="category"
                            id="category"
                            v-model="post.category_id"
                            class="form-control mt-2"
                        >
                            <option value="" disabled>Select Category</option>
                            <option
                                v-for="category in categories"
                                :value="category.id"
                                :key="category"
                            >
                                {{ category.name }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="tags">Tags</label>
                        <select
                            name="tags[]"
                            id="tags"
                            v-model="post.tag_ids"
                            class="form-control mt-2 select2"
                            multiple
                        >
                            <option value="" disabled>Select tags</option>
                            <option
                                v-for="tag in tagList"
                                :value="tag.id"
                                :key="tag.id"
                            >
                                {{ tag.name }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="content">Content</label>
                        <textarea
                            id="content"
                            v-model="post.content"
                            class="form-control mt-2"
                            rows="5"
                            placeholder="Enter post content"
                        ></textarea>
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
            </large-modal>
            <!-- /Modal -->

            <!-- Show Modal -->
            <large-modal v-if="showModal" @close="closeModal">
                <template #header>
                    {{ post.title }}
                </template>
                <template #body>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Category</th>
                                        <td>{{ post.category.name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tags</th>
                                        <td>
                                            <span
                                                v-for="(
                                                    tag, index
                                                ) in post.tags"
                                                :key="index"
                                            >
                                                {{ tag.name
                                                }}<span
                                                    v-if="
                                                        index <
                                                        post.tags.length - 1
                                                    "
                                                    >,
                                                </span>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Content</th>
                                        <td>
                                            <div v-html="post.content"></div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </template>
            </large-modal>
            <!-- /Show Modal -->

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
            limit: 2,
            modal: false,
            deleteModal: false,
            showModal: false,
            add: true,
            edit: false,
            post: {
                id: "",
                title: "",
                category_id: "",
                content: "",
                tag_ids: [],
            },
        };
    },

    computed: {
        ...mapGetters(["posts", "categories", "tags"]),

        postList() {
            return this.posts.data;
        },

        tagList() {
            return this.tags;
        },
    },

    methods: {
        ...mapActions(["getPosts", "getCategories", "getTagList"]),

        fetchPosts(page = 1) {
            this.getPosts(page);
        },

        openModal() {
            this.modal = true;
            this.$nextTick(() => {
                this.initializeSelect2();
            });
        },

        closeModal() {
            this.modal = false;
            this.showModal = false;
            this.add = true;
            this.edit = false;
            this.post = {};
            $("#tags").select2("destroy");
        },

        closeDeleteModal() {
            this.deleteModal = false;
        },

        initializeSelect2() {
            const self = this;
            $("#tags")
                .select2({
                    placeholder: "Select tags",
                    allowClear: true,
                })
                .on("change", function () {
                    self.post.tag_ids = $(this).val();
                });
        },

        showPost(post) {
            this.post = post;
            this.showModal = true;
        },

        store() {
            let data = {
                title: this.post.name,
                category_id: this.post.category_id,
                content: this.post.content,
                tag_ids: this.post.tag_ids,
            };
            axios
                .post("/posts", data)
                .then((response) => {
                    if (response.data.success) {
                        this.closeModal();
                        this.$toast.success(response.data.message);
                        this.fetchPosts();
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
        this.fetchPosts();
        this.getCategories();
        this.getTagList();
    },

    mounted() {
        this.$nextTick(() => {
            this.initializeSelect2();
        });
    },
};
</script>
