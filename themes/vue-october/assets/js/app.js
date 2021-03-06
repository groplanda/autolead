import Vue from 'vue';
import App from './App.vue';
import router from './router/routes.js';
import store from './store/index.js';
import Icon from '@vue/components/app/icon/icon.vue';

import Vuelidate from 'vuelidate';
import VueMask from 'v-mask';

Vue.use(Vuelidate)
Vue.use(VueMask)

Vue.component('icon', Icon);

store.dispatch('autoLogin').then(() => {
  new Vue({
    el: '#app',
    router,
    store,
    components: { App }
  })
})
