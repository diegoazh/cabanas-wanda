import Vue from 'vue'
import VTooltip from 'v-tooltip'
import VueCookies from 'vue-cookies'
import VueNotifications from 'vue-notifications'
import { optionsIzi } from "../vue-commons/notifications/notifications"
import store from '../vue-commons/store/store'
import Reports from './components/Reports.vue'

Vue.use(VueNotifications, optionsIzi).use(VueCookies).use(VTooltip);

window.EventBus = new Vue();

const rentalsApp = new Vue({
    el: '#vue-reports-app',
    store,
    render: h => h(Reports),
    created() {},
    methods: {},
});