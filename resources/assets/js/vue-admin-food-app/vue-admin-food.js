import Vue from 'vue'
import Tooltip from 'vue-directive-tooltip';
import VueCookies from 'vue-cookies'
import VueNotifications from 'vue-notifications';
import store from '../vue-commons/store/store'
import { optionsIzi } from '../vue-commons/notifications/notifications'
import AdminFood from './components/AdminFood.vue'
import 'vue-directive-tooltip/css/index.css'

Vue.use(VueNotifications, optionsIzi).use(VueCookies).use(Tooltip);

window.EventBus = new Vue();

const adminFoodApp = new Vue({
    el: '.card',
    store,
    render: h => h(AdminFood)
});