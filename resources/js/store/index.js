import { createStore } from "vuex";
import categories from "./modules/categories";
import tags from "./modules/tags";
import posts from "./modules/posts";

const store = createStore({
    modules: {
        categories,
        tags,
        posts,
    },
});

export default store;
