import axios from "axios";

class Service {
  constructor(title, description, ico = '') {
    this.title = title;
    this.description = description;
    this.ico = ico;
  }
}
const services = {
  state: () => ({
    services: []
  }),
  mutations: {
    SET_SERVICES(state, payload) {
      state.services = payload;
    }
  },
  actions: {
    fetchServices({ commit }) {
      axios.get('api/services')
      .then(response => {
        const data = response.data;
        const services = [];

        data.forEach(item => {
          services.push(new Service(
            item.name,
            item.description,
            item.file.path
          ))
        });

        commit('SET_SERVICES', services);

      })
      .catch(error => {
        console.log(error);
      })
    }
  },
  getters: {
    getServices(state) {
      return state.services;
    }
  }
}
export default services;