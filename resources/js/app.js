require('./bootstrap');
window.Vue = require('vue');

import { createApp } from 'vue'
import  router  from './router'
import App from './pages/App.vue'

createApp(App).use(router).mount('#app')
