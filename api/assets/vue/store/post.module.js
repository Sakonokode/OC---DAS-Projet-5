import PostService from "../services/post.service";
import AuthService from "../services/auth.service";

const CREATING_POST = "CREATING_POST",
  CREATING_POST_SUCCESS = "CREATING_POST_SUCCESS",
  CREATING_POST_ERROR = "CREATING_POST_ERROR",
  FETCHING_POSTS = "FETCHING_POSTS",
  FETCHING_POSTS_SUCCESS = "FETCHING_POSTS_SUCCESS",
  FETCHING_POSTS_ERROR = "FETCHING_POSTS_ERROR";

export const post = {
  namespaced: true,
  state: {
    isLoading: false,
    error: null,
    posts: []
  },
  getters: {
    isLoading(state) {
      return state.isLoading;
    },
    hasError(state) {
      return state.error !== null;
    },
    error(state) {
      return state.error;
    },
    hasPosts(state) {
      return state.posts.length > 0;
    },
    posts(state) {
      return state.posts;
    }
  },
  mutations: {
    [CREATING_POST](state) {
      state.isLoading = true;
      state.error = null;
    },
    [CREATING_POST_SUCCESS](state, post) {
      state.isLoading = false;
      state.error = null;
      state.posts.unshift(post);
    },
    [CREATING_POST_ERROR](state, error) {
      state.isLoading = false;
      state.error = error;
      state.posts = [];
    },
    [FETCHING_POSTS](state) {
      state.isLoading = true;
      state.error = null;
      state.posts = [];
    },
    [FETCHING_POSTS_SUCCESS](state, posts) {
      state.isLoading = false;
      state.error = null;
      state.posts = posts;
    },
    [FETCHING_POSTS_ERROR](state, error) {
      state.isLoading = false;
      state.error = error;
      state.posts = [];
    }
  },
  actions: {
    async create({ commit }, data) {
      commit(CREATING_POST);
      console.log('data = ', data);
      try {
        let response = await PostService.create(data);
        commit(CREATING_POST_SUCCESS, response.data);
        console.log('module : success', response.data)
        return response.data;
      } catch (error) {
        console.log('post module error', error, response)
        commit(CREATING_POST_ERROR, error);
        return null;
      }
    },
    async findAll({ commit }) {
      commit(FETCHING_POSTS);
      try {
        let response = await PostService.findAll();
        commit(FETCHING_POSTS_SUCCESS, response.data['hydra:member']);
        console.log('post module : success', response)
        return response.data['hydra:member'];
      } catch (error) {
        commit(FETCHING_POSTS_ERROR, error);
        //AuthService.logout();
        // redirect here
        return null;
      }
    },
  }
};
