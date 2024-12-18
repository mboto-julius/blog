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
        async getTags({ commit }, page = 1) {
            try {
                const response = await axios.get(`/tags?page=${page}`);
                if (response.data.success) {
                    commit("SET_TAGS", response.data.tags);
                }
            } catch (error) {
                console.error("Error fetching tags:", error);
            }
        },

        async getTagList({ commit }) {
            try {
                const response = await axios.get("tag-list");
                if (response.data.success) {
                    commit("SET_TAGS", response.data.tags);
                }
            } catch (error) {
                console.error("Error fetching all tags:", error);
            }
        },
    },
};
