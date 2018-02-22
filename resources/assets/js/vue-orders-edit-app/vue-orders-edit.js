import Vue from 'vue'
import Tooltip from 'vue-directive-tooltip';
import VueCookies from 'vue-cookies'
import VueNotifications from 'vue-notifications';
import store from '../vue-commons/store/store'
import { optionsIzi } from '../vue-commons/notifications/notifications'
import { DateArgFilter } from "../vue-commons/filters/DateGlobalFilter"
import OrdersEdit from './components/OrdersEdit.vue'
import 'vue-directive-tooltip/css/index.css'

Vue.use(VueNotifications, optionsIzi).use(VueCookies).use(Tooltip).filter('dateArg', DateArgFilter);

window.EventBus = new Vue();

const ordersEditApp = new Vue({
    el: '#vue-orders-edit-app',
    store,
    render: h => h(OrdersEdit)
});