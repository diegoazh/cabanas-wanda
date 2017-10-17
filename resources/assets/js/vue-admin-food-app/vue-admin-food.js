import Vue from 'vue'
import VueNotifications from 'vue-notifications';
import VTooltip from 'v-tooltip'
import store from '../vue-commons/store/store'
import { optionsIzi } from '../vue-commons/notifications/notifications'
import AdminFood from './components/AdminFood.vue'

Vue.use(VueNotifications, optionsIzi).use(VTooltip);

const adminFoodApp = new Vue({
    el: '.panel',
    store,
    render: h => h(AdminFood)
});