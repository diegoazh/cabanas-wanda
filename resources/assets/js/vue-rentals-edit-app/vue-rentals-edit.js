import Vue from 'vue'
import Tooltip from 'vue-directive-tooltip';
import VueCookies from 'vue-cookies'
import VueNotifications from 'vue-notifications'
import { optionsIzi } from "../vue-commons/notifications/notifications"
import { DateArgFilter } from '../vue-commons/filters/DateGlobalFilter';
import store from '../vue-commons/store/store'
import RentalsEdit from './components/RentalsEdit.vue'
import 'vue-directive-tooltip/css/index.css';

Vue.use(VueNotifications, optionsIzi).use(VueCookies).use(Tooltip);
Vue.filter('DateArg', DateArgFilter);

window.EventBus = new Vue();

const rentalsEditApp = new Vue({
    el: '#vue-rentals-edit-app',
    store,
    render: h => h(RentalsEdit),
    created() {},
    methods: {},
});