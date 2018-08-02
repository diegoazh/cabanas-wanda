import Vue from 'vue';
import Tooltip from 'vue-directive-tooltip';
import VueCookies from 'vue-cookies';
import VueNotifications from 'vue-notifications';
import BootstrapVue from 'bootstrap-vue'
import store from '../vue-commons/store/store';
import { optionsIzi } from '../vue-commons/notifications/notifications';
import { DateArgFilter } from '../vue-commons/filters/DateGlobalFilter';
import Dash from './components/Dash.vue';
import 'vue-directive-tooltip/css/index.css';

Vue.use(VueNotifications, optionsIzi).use(VueCookies).use(Tooltip).use(BootstrapVue);
Vue.filter('DateArg', DateArgFilter);

window.EventBus = new Vue();

const dashApp = new Vue({
    el: '#content_backend',
    store,
    render: h => h(Dash)
});