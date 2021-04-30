import axios from 'axios';

const faq = {
  state: () => ({
    faq: [],
  }),
  mutations: {
    SET_FAQ(state, payload) {
      state.faq = payload;
    },
  },
  actions: {
    fetchFaq({ commit }) {
      commit('SET_FAQ', []);
      axios.get('api/faq')
        .then(response => {
          const data = response.data;
          commit('SET_FAQ', data);
        })
        .catch(error => {
          console.log(error);
        })
    }
  },
  getters: {
    getFaq: state => {
      return state.faq;
    }
  }
}
export default faq;
