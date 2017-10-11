import Vue from 'vue'
import VueNotification from 'vue-notifications';
import VTooltip from 'v-tooltip'

import store from './store/store'
import options from '../vue-commons/notifications/notifications'

Vue.use(VueNotification, options).use(VTooltip);

import AdminFood from './components/AdminFood.vue'

const adminFoodApp = new Vue({
    el: '.panel',
    store,
    render: h => h(AdminFood)
});