<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 pt-5">
                <div class="d-flex justify-content-between align-items-center">
                    <h4>Categories</h4>
                    <a href="" class="btn btn-primary"
                        ><span><i class="bi bi-plus-lg"></i></span>Category<span
                        ></span
                    ></a>
                </div>
            </div>
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
                                <button class="btn btn-danger btn-sm">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
export default {
    data() {
        return {
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
    },

    created() {
        this.getCategories();
    },
};
</script>
