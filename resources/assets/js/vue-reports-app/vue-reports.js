import Vue from 'vue'
import Tooltip from 'vue-directive-tooltip';
import VueCookies from 'vue-cookies'
import VueNotifications from 'vue-notifications'
import { optionsIzi } from "../vue-commons/notifications/notifications"
import store from '../vue-commons/store/store'
import Reports from './components/Reports.vue'
import 'vue-directive-tooltip/css/index.css';

Vue.use(VueNotifications, optionsIzi).use(VueCookies).use(Tooltip);

window.EventBus = new Vue();

const rentalsApp = new Vue({
    el: '#vue-reports-app',
    store,
    render: h => h(Reports),
    created() {},
    methods: {},
});