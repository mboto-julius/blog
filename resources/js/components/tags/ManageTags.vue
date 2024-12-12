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
                        <tr v-for="(tag, index) in tags" :key="tag.id">
                            <th>{{ index + 1 }}</th>
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
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";

export default {
    data() {
        return {
            tag: {
                id: "",
                name: "",
            },
        };
    },

    computed: {
        ...mapGetters(["tags"]),
    },

    methods: {
        ...mapActions(["getTags"]),
    },

    created() {
        this.getTags();
    },
};
</script>
