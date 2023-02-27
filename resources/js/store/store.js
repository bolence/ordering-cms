import Vue from 'vue';
import Vuex from 'vuex';
import order from './modules/order'
import notification from './modules/notification';

Vue.use(Vuex);

export const store = new Vuex.Store({
    modules: {
       order,
       notification,
    }
})