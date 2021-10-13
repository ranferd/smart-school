import 'core-js/stable';
import Vue from 'vue';
import App from './App';
import router from './router';
import CoreuiVue from '@coreui/vue';
import VueSimpleAlert from "vue-simple-alert";
import { iconsSet as icons } from './assets/icons/icons.js';
import store from './store';

Vue.prototype.$apiAdress = 'http://127.0.0.1:8001/api/v1';
Vue.config.performance = true;
Vue.use(CoreuiVue);
Vue.use(VueSimpleAlert);

new Vue({
  el: '#app',
  router,
  store,
  icons,
  template: '<App/>',
  components: {
    App
  },
});
