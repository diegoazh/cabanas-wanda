import Vue from 'vue'
import VTooltip from 'v-tooltip'
import VueCookies from 'vue-cookies'
import VueNotifications from 'vue-notifications';
import store from '../vue-commons/store/store'
import { optionsIzi } from '../vue-commons/notifications/notifications'
import Dash from './components/Dash.vue'

Vue.use(VueNotifications, optionsIzi).use(VueCookies).use(VTooltip);

window.EventBus = new Vue();

const dashApp = new Vue({
    el: '.panel',
    store,
    render: h => h(Dash)
});