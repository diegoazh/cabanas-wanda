import Vue from 'vue';
import Tooltip from 'vue-directive-tooltip';
import VueCookies from 'vue-cookies';
import VueNotifications from 'vue-notifications';
import store from '../vue-commons/store/store';
import { optionsIzi } from '../vue-commons/notifications/notifications';
import { DateArgFilter } from '../vue-commons/filters/DateGlobalFilter';
import Dash from './components/Dash.vue';
import 'vue-directive-tooltip/css/index.css';

Vue.use(VueNotifications, optionsIzi).use(VueCookies).use(Tooltip);
Vue.filter('DateArg', DateArgFilter);

window.EventBus = new Vue();

const dashApp = new Vue({
    el: '.panel',
    store,
    render: h => h(Dash)
});