import Vue from 'vue'
import VueCookies from 'vue-cookies'
import VueTooltip from 'vue-directive-tooltip'
import VueNotifications from 'vue-notifications'
import store from '../vue-commons/store/store'
import { optionsIzi } from '../vue-commons/notifications/notifications'
import ProfileRentals from './components/ProfileRentals'
import 'vue-directive-tooltip/css/index.css'

Vue.use(VueNotifications, optionsIzi).use(VueCookies).use(VueTooltip);

window.EventBus = new Vue();

const profileRentalsApp = new Vue({
    el: '#profile-rentals',
    store,
    render: h => h(ProfileRentals)
});