<template>
    <div class="container">
        <div class="row">
            <!-- Header -->
            <div class="col-md-12 pt-5">
                <div class="d-flex justify-content-between align-items-center">
                    <h4>Tags</h4>
                    <button class="btn btn-primary">
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
    },
    created() {
        this.fetchTags();
    },
};
</script>
