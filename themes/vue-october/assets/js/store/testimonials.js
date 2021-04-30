import axios from "axios";

class Testimonials {
  constructor(name, description, avatar = '') {
    this.name = name;
    this.description = description;
    this.avatar = avatar;
  }
}
const testimonials = {
  state: () => ({
    testimonials: [],
    responseTestimonial: []
  }),
  mutations: {
    SET_TESTIMONIALS(state, payload) {
      state.testimonials = payload;
    },
    SET_TESTIMONIALS_RESPONSE(state, payload) {
      state.responseTestimonial = payload;
    }
  },
  actions: {
    fetchTestimonials({ commit }) {
      axios.get('api/testimonials')
      .then(response => {
        const data = response.data;
        const testimonials = [];

        data.forEach(item => {
          testimonials.push(new Testimonials(
            item.name,
            item.description,
            item.avatar[0].path
          ))
        });

        commit('SET_TESTIMONIALS', testimonials);

      })
      .catch(error => {
        console.log(error);
      })
    },
    AddTestimonial({commit}, payload) {

      let formData = new FormData();
      formData.append('name', payload.name);
      formData.append('description', payload.description);
      formData.append('avatar', payload.avatar[0]);

      axios.post('api/add-testimonial',
      formData,
      {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }
      )
      .then(response => {
        const data = response.data;
        commit('SET_TESTIMONIALS_RESPONSE', data);
      })
      .catch(error => {
        console.log(error);
      })
    }
  },
  getters: {
    getTestimonials(state) {
      return state.testimonials;
    },
    getTestimonialResponse(state) {
      return state.responseTestimonial;
    }
  }
}
export default testimonials;