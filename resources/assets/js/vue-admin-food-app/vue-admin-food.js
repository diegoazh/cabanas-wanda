import Vue from 'vue'
import VTooltip from 'v-tooltip'
import VueCookies from 'vue-cookies'
import VueNotifications from 'vue-notifications';
import store from '../vue-commons/store/store'
import { optionsIzi } from '../vue-commons/notifications/notifications'
import AdminFood from './components/AdminFood.vue'

Vue.use(VueNotifications, optionsIzi).use(VueCookies).use(VTooltip);

const adminFoodApp = new Vue({
    el: '.panel',
    store,
    render: h => h(AdminFood)
});