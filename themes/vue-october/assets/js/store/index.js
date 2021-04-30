import Vue from 'vue'
import Vuex from 'vuex'
import common from './common';
import messages from './message';
import services from './services';
import posts from './posts';
import contacts from './contacts';
import gallery from './gallery';
import testimonials from './testimonials';
import faq from './faq';

Vue.use(Vuex)

export default new Vuex.Store({
  state: {},
  mutations: {},
  actions: {},
  getters: {},
  modules: {
    posts,
    messages,
    services,
    contacts,
    common,
    gallery,
    testimonials,
    faq
  }
})
