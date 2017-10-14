import Vue from 'vue'
import VueNotifications from 'vue-notifications';
import VTooltip from 'v-tooltip'
import store from '../vue-commons/store/store'
import { optionsIzi } from '../vue-commons/notifications/notifications'

Vue.use(VueNotifications, optionsIzi).use(VTooltip);

import AdminFood from './components/AdminFood.vue'

const adminFoodApp = new Vue({
    el: '.panel',
    store,
    render: h => h(AdminFood)
});