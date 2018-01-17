import Vue from 'vue'
import Tooltip from 'vue-directive-tooltip';
import VueCookies from 'vue-cookies'
import VueNotifications from 'vue-notifications';
import store from '../vue-commons/store/store'
import { optionsIzi } from '../vue-commons/notifications/notifications'
import Orders from './components/Orders.vue'
import 'vue-directive-tooltip/css/index.css'

Vue.use(VueNotifications, optionsIzi).use(VueCookies).use(Tooltip);

window.EventBus = new Vue();

const ordersApp = new Vue({
    el: '#vue-order-app',
    store,
    render: h => h(Orders)
});