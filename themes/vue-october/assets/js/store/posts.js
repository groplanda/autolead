import axios from 'axios';

const posts = {
  state: () => ({
    post: []
  }),
  mutations: {
    SET_POST(state, payload) {
      state.post = payload;
    }
  },
  actions: {
    fetchPost({ commit }, name) {
      commit('SET_POST', []);
      axios.get(`api/post/${name}`)
        .then(response => {
          commit('SET_POST', response.data)
        })
        .catch(error => {
          console.log(error);
        })
    }
  },
  getters: {
    getPost(state) {
      return state.post;
    }
  }
}
export default posts;