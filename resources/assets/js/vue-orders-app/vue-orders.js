import Vue from 'vue'
import VueNotifications from 'vue-notifications';
import VTooltip from 'v-tooltip'
import store from '../vue-commons/store/store'
import { optionsIzi } from '../vue-commons/notifications/notifications'
import Orders from './components/Orders.vue'

Vue.use(VueNotifications, optionsIzi).use(VTooltip);

const ordersApp = new Vue({
    el: '#vue-order-app',
    store,
    render: h => h(Orders)
});