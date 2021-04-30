import axios from 'axios';

class Contact {
  constructor(address, email, open, phones, title, town, coords) {
    this.address = address;
    this.email = email;
    this.open = open;
    this.phone = phones;
    this.title = title;
    this.town = town;
    this.coords = coords;
  }
}

const contacts = {
  state: () => ({
    contacts: [],
  }),
  mutations: {
    SET_CONTACTS(state, payload) {
      state.contacts = payload;
    },
    SET_TOWN(state, payload) {
      state.contacts = state.contacts.map(contact => {
        contact.town.selected = false;
        if(contact.town.id === payload) {
          contact.town.selected = true
        }
        return contact;
      })
    },
  },
  actions: {
    getContacts({ commit, dispatch }) {
      commit('SET_RESULT', []);
      commit('SET_PRELOADER', true);

      return axios.get('api/contacts')
        .then(response => {
          const data = response.data;

          const contacts = [];

          data.forEach(elem => {
            const time = [];
            const phones = [];
            const town = {};
            if ('open' in elem)
              elem.open.forEach(open => time.push(open.time))
            if ('phone' in elem)
              elem.phone.forEach(phone => phones.push(phone.number))
            if ('town' in elem) {
              town.id = elem.town.id;
              town.name = elem.town.name;
              town.selected = false;
            }
            contacts.push(new Contact( elem.address, elem.email, time, phones, elem.title, town, elem.map_cord ));
          });
          commit('SET_CONTACTS', contacts);
        })
        .then(() => {
          if (localStorage.townId) {
            dispatch('selectTownById', +localStorage.townId);
          } else {
            dispatch('selectTownById', 2);
            dispatch('setPopup', true);
          }
        })
        .catch(error => {
          console.log(error);
        })
        .finally(() => {
          commit('SET_PRELOADER', false);
        })

    },
    selectTownById({commit}, data) {
      commit('SET_TOWN', data);
    },
    getContactsById({commit}, data) {
      commit('SET_PRELOADER', true);
      axios.get('api/contacts/' + data)
        .then(response => {
          const data = response.data;
          console.log(data);
        })
    }
  },
  getters: {
    getContacts: state => {
      return state.contacts;
    },
    getContactsByTown: state => {
      return state.contacts.find(contact => contact.town.selected);
    },
    getTowns: state =>  {
      return state.contacts.map(contact => contact.town);
    },
    getContactsById: state => id => {
      return state.contacts.find(contact => contact.town.id === id);
    }
  }
}
export default contacts;