import MediaService from "../services/media.service";

const CREATING_MEDIA = "CREATING_MEDIA",
  CREATING_MEDIA_SUCCESS = "CREATING_MEDIA_SUCCESS",
  CREATING_MEDIA_ERROR = "CREATING_MEDIA_ERROR";

export const media = {
  namespaced: true,
  state: {
    isLoading: false,
    error: null,
    media: ""
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
  },
  mutations: {
    [CREATING_MEDIA](state) {
      state.isLoading = true;
      state.error = null;
    },
    [CREATING_MEDIA_SUCCESS](state, media) {
      state.isLoading = false;
      state.error = null;
      state.media = media
    },
    [CREATING_MEDIA_ERROR](state, error) {
      state.isLoading = false;
      state.error = error;
      state.media = "";
    }
  },
  actions: {
    async create({ commit }, data) {
      commit(CREATING_MEDIA)
      return new Promise((resolve, reject) => {
        MediaService.create(data).then(response => {
            commit(CREATING_MEDIA_SUCCESS, response.data)
            resolve(response);
        }, error => {
            commit(CREATING_MEDIA_ERROR, error)
            reject(error);
        })
      })
    },
  }
};
