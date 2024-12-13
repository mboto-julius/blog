import "./bootstrap";
import { createApp } from "vue";
import store from "./store";
import Toaster from "@meforma/vue-toaster";
import { Bootstrap5Pagination } from "laravel-vue-pagination";

import Dashboard from "./components/Dashboard.vue";
import ManageCategories from "./components/categories/ManageCategories.vue";
import MediumModal from "./components/partials/MediumModal.vue";
import ConfirmDialog from "./components/partials/ConfirmDialog.vue";
import ManageTags from "./components/tags/ManageTags.vue";

const app = createApp({});

app.component("dashboard", Dashboard);
app.component("manage-categories", ManageCategories);
app.component("manage-tags", ManageTags);

app.component("medium-modal", MediumModal);
app.component("confirm-dialog", ConfirmDialog);
app.component("pagination", Bootstrap5Pagination);

app.use(store);
app.use(Toaster, {
    position: "top-right",
});
app.mount("#app");
