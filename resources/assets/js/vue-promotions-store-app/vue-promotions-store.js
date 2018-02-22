import Vue from 'vue'
import Tooltip from 'vue-directive-tooltip';
import VueCookies from 'vue-cookies'
import VueNotifications from 'vue-notifications'
import VueSimplemde  from 'vue-simplemde';
import store from '../vue-commons/store/store'
import { optionsIzi } from "../vue-commons/notifications/notifications"
import { DateArgFilter } from '../vue-commons/filters/DateGlobalFilter';
import Promotions from './components/Promotions'
import 'vue-directive-tooltip/css/index.css'

Vue.use(VueNotifications, optionsIzi).use(VueCookies).use(Tooltip).use(VueSimplemde).filter('dateArg', DateArgFilter);

window.EventBus = new Vue();

const promotionsStoreApp = new Vue({
    el: '#content_backend',
    store,
    render: h => h(Promotions)
});
