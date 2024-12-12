import axios from "axios";

export default {
    state: {
        categories: [],
    },

    getters: {
        categories(state) {
            return state.categories;
        },
    },

    mutations: {
        SET_CATEGORIES(state, categories) {
            state.categories = categories;
        },
    },

    actions: {
        async getCategories({ commit }) {
            try {
                const response = await axios.get("/categories");
                if (response.data.success) {
                    commit("SET_CATEGORIES", response.data.categories);
                }
            } catch (error) {
                console.error("Error fetching categories:", error);
            }
        },
    },
};
