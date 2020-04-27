import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router';
import {routes} from './routes/routes';
import axios from 'axios';
import VueAxios from 'vue-axios';
import VueToast from 'vue-toast-notification';
import {store} from './store/store';


axios.defaults.baseURL = 'http://127.0.0.1:8000/api';
axios.interceptors.request.use(
  (config) => {
    let token = localStorage.getItem('token');
    if (token) {
      config.headers['Authorization'] = `Bearer ${ token }`;
    }
  return config;
  }, (error) => {
    return Promise.reject(error);
  }
);



// axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';

Vue.use(VueAxios, axios);
Vue.use(VueRouter);
Vue.use(VueToast);
window.axios = axios;
const router = new VueRouter({
  routes,
  mode:'history'
});

Vue.config.productionTip = false

new Vue({
  store,
  router,
  render: h => h(App),
}).$mount('#app')
