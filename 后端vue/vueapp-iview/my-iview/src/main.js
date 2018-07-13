// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'


import iView from 'iview';
import 'iview/dist/styles/iview.css';

Vue.config.productionTip = false

import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(VueAxios, axios)


Vue.use(iView);

global.domain = 'http://127.0.0.1/phptest/travel1'

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
