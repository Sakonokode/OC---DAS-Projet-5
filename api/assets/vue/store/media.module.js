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
      commit(CREATING_MEDIA);
      try {
        let response = await MediaService.create(data);
        commit(CREATING_MEDIA_SUCCESS, response.data['hydra:member']);
        console.log('module : success', response.data['hydra:member'])
        return response.data['hydra:member'];
      } catch (error) {
        commit(CREATING_MEDIA_ERROR, error);
        console.log('error', error)
        return null;
      }
    },
  }
};
