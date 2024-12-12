import axios from "axios";

export default {
    state: {
        tags: [],
    },

    getters: {
        tags(state) {
            return state.tags;
        },
    },

    mutations: {
        SET_TAGS(state, tags) {
            state.tags = tags;
        },
    },

    actions: {
        async getTags({ commit }) {
            try {
                const response = await axios.get("/tags");
                if (response.data.success) {
                    commit("SET_TAGS", response.data.tags);
                }
            } catch (error) {
                console.error("Error fetching tags:", error);
            }
        },
    },
};
