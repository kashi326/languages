require("./bootstrap");

import vuetify from "./plugins/vuetify";
import common from "./common";

window.Vue = require("vue");

Vue.mixin(common);

// import 'babel-polyfill';
require("es6-object-assign").polyfill();
require("es6-promise").polyfill();

Vue.component("example", require("./components/ExampleComponent.vue").default);

const app = new Vue({
    el: "#app",
    vuetify
});
