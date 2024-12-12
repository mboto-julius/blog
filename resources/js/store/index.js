import { createStore } from "vuex";
import categories from "./modules/categories";
import tags from "./modules/tags";

const store = createStore({
    modules: {
        categories,
        tags,
    },
});

export default store;
