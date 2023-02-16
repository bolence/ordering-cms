
require('./bootstrap');

window.Vue = require('vue').default;
import VueAWN from "vue-awesome-notifications"
import 'vue-awesome-notifications/dist/styles/style.css';
import { store } from './store/store'


// Your custom options
let options = {position: 'top-right', durations: 200}

Vue.use(VueAWN, options)

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

const app = new Vue({
    el: '#app',
    store,
});
