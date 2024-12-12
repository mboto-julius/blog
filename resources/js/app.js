import "./bootstrap";
import { createApp } from "vue";
import store from "./store";
import Dashboard from "./components/Dashboard.vue";
import ManageCategories from "./components/categories/ManageCategories.vue";

const app = createApp({});

app.component("dashboard", Dashboard);
app.component("manage-categories", ManageCategories);

app.use(store);
app.mount("#app");
