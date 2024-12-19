<template>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="pt-5">
                        <h4>Dashboard</h4>
                    </div>
                </div>
            </div>
            <div class="row pt-5">
                <div class="col-md-4">
                    <div class="card">
                        <ul class="list-group list-group-flush text-center">
                            <li class="list-group-item"><h5>Posts</h5></li>
                            <li class="list-group-item">
                                <h5>{{ totalPosts }}</h5>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <ul class="list-group list-group-flush text-center">
                            <li class="list-group-item"><h5>Categories</h5></li>
                            <li class="list-group-item">
                                <h5>{{ totalCategories }}</h5>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <ul class="list-group list-group-flush text-center">
                            <li class="list-group-item"><h5>Tags</h5></li>
                            <li class="list-group-item">
                                <h5>{{ totalTags }}</h5>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
    computed: {
        ...mapGetters(["tags", "posts", "categories"]),

        totalPosts() {
            return this.posts?.total || 0;
        },

        totalCategories() {
            return this.categories?.length || 0;
        },

        totalTags() {
            return this.tags?.total || 0;
        },
    },

    methods: {
        ...mapActions(["getPosts", "getCategories", "getTags"]),
    },

    mounted() {
        this.getPosts();
        this.getCategories();
        this.getTags();
    },
};
</script>
