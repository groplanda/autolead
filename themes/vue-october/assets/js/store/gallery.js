import axios from "axios";

class Gallery {
  constructor(title, description, images) {
    this.title = title;
    this.description = description;
    this.images = images;
  }
}

const gallery = {
  state: () => ({
    gallery: {},
  }),
  mutations: {
    SET_GALLERY(state, payload) {
      state.gallery = payload;
    },
  },
  actions: {
    fetchGallery({commit}, data) {
      axios.get(`api/gallery/${data}`)
      .then(response => {
        const data = response.data;
        const images = [];

        data.images.forEach(image => images.push(image.path));

        commit('SET_GALLERY', new Gallery(data.title, data.description, images));
      })
      .catch(error => {
        console.log(error);
      })

    },
  },
  getters: {
    getGallery(state) {
      return state.gallery;
    },
  }
}
export default gallery;