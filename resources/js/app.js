require("./bootstrap");

window.Vue = require("vue").default;
import VueAWN from "vue-awesome-notifications";
// import VueSweetalert2 from 'vue-sweetalert2';
import "vue-awesome-notifications/dist/styles/style.css";
import { store } from "./store/store";
import moment from "moment";
import numeral from "numeral";

import { BootstrapVue, IconsPlugin } from "bootstrap-vue";

import "bootstrap-vue/dist/bootstrap-vue.css";

// import 'sweetalert2/dist/sweetalert2.min.css';

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue);
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin);

// Vue.use(VueSweetalert2);

// Your custom options
let options = { position: "top-right", durations: 200 };

Vue.use(VueAWN, options);
import Fragment from "vue-fragment";
Vue.use(Fragment.Plugin);

const files = require.context("./", true, /\.vue$/i);
files
    .keys()
    .map((key) =>
        Vue.component(key.split("/").pop().split(".")[0], files(key).default)
    );

Vue.filter("capitalize", function (value) {
    if (!value) return "";
    // value = value.toString()
    return value[0].toUpperCase() + value.slice(1);
});

Vue.filter("formatDate", function (value, format) {
    if (value) {
        return moment(String(value)).format(format || "DD.MM.YYYY");
    }
});

Vue.filter("formatNumber", function (value) {
    if (value) {
        return numeral(value).format("0,00");
    }
});

Vue.filter("fromTime", function (value) {
    if (value) {
        return moment(String(value)).fromNow();
    }
});

const app = new Vue({
    el: "#app",
    store,
});
