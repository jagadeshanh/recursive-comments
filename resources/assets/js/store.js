import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({

    state: {
        posts: [],
    },

    mutations: {
        pushPost(state, payLoad) {
            state.posts.unshift(payLoad);
        },
        updateComments(state, payLoad) {
            let post = state.posts.find((post) => {
                return payLoad.post_id === post.id;
            });
            post.comments = payLoad['comments'];
        }
    }
});
