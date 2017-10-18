import Vue from 'vue'
import VTooltip from 'v-tooltip'
import VueCookies from 'vue-cookies'
import VueNotifications from 'vue-notifications';
import store from '../vue-commons/store/store'
import { optionsIzi } from '../vue-commons/notifications/notifications'
import Orders from './components/Orders.vue'

Vue.use(VueNotifications, optionsIzi).use(VueCookies).use(VTooltip);

const ordersApp = new Vue({
    el: '#vue-order-app',
    store,
    render: h => h(Orders)
});