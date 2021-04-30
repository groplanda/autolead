const common = {
  state: () => ({
    popup: false,
    preloader: false
  }),
  mutations: {
    SET_POPUP(state, payload) {
      state.popup = payload;
    },
    SET_PRELOADER(state, payload) {
      state.preloader = payload;
    }
  },
  actions: {
    setPopup({commit}, data) {
      commit('SET_POPUP', data);
    },
    setPreloader({commit}, data) {
      commit('SET_PRELOADER', data);
    }
  },
  getters: {
    getPopup(state) {
      return state.popup;
    },
    getPreloader(state) {
      return state.preloader;
    }
  }
}
export default common;