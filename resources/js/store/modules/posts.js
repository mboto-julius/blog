import axios from "axios";

export default {
    state: {
        posts: [],
    },

    getters: {
        posts(state) {
            return state.posts;
        },
    },

    mutations: {
        SET_POSTS(state, posts) {
            state.posts = posts;
        },
    },

    actions: {
        async getPosts({ commit }, page = 1) {
            try {
                const response = await axios.get(`/posts?page=${page}`);
                if (response.data.success) {
                    commit("SET_POSTS", response.data.posts);
                }
            } catch (error) {
                console.error("Error fetching posts:", error);
            }
        },
    },
};
