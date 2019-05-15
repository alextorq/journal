import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes';
import store from './store';
import ElementUI from 'element-ui';
import lang from 'element-ui/lib/locale/lang/ru-RU';
import locale from 'element-ui/lib/locale';
import 'element-ui/lib/theme-chalk/index.css';
import * as lodash from "lodash";

Vue.use(ElementUI);
Vue.use(VueRouter);

locale.use(lang);
window._ = lodash;

const app = new Vue({
    el: '#app',
    store,
    router: new VueRouter(routes)
});
