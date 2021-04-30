import axios from 'axios';
const messages = {
  state: () => ({
    result: [],
  }),
  mutations: {
    SET_RESULT(state, payload) {
      state.result = payload;
    }
  },
  actions: {
    sendMessage({ dispatch, commit }, payload) {
      commit('SET_RESULT', []);
      axios.post('api/send-message', payload)
        .then(response => {
          const data = response.data;
          commit('SET_RESULT', data);
          dispatch('clearResult');
        })
        .catch(error => {
          console.log(error);
        })
    },
    clearResult({commit}) {
      setTimeout(() => commit('SET_RESULT', []), 30000);
    }
  },
  getters: {
    getResult(state) {
      return state.result;
    }
  }
}
export default messages;