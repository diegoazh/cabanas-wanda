import Vue from 'vue'
import VueCookies from 'vue-cookies'
import store from '../vue-commons/store/store'
import Liquidation from './components/Liquidation.vue'
import VueNotifications from 'vue-notifications';
import { optionsIzi } from '../vue-commons/notifications/notifications'

Vue.use(VueNotifications, optionsIzi).use(VueCookies);

window.EventBus = new Vue();

const liquidationApp = new Vue({
    el: '#vue-liquidation-app',
    store,
    render: h => h(Liquidation)
});