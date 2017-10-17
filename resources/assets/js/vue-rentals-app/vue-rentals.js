import Vue from 'vue'
import VueNotifications from 'vue-notifications'
import VTooltip from 'v-tooltip'
import { createNamespacedHelpers } from 'vuex'
import { optionsIzi } from "../vue-commons/notifications/notifications"
import store from '../vue-commons/store/store'
import Rentals from './components/Rentals.vue'

Vue.use(VueNotifications, optionsIzi).use(VTooltip);

const { mapActions } = createNamespacedHelpers('rentals');

window.EventBus = new Vue();

const rentalsApp = new Vue({
    el: '#vue-rentals-app',
    store,
    render: h => h(Rentals),
    created() {
        this.setCottages()
            .then(response => VueNotifications.success({title: response.title, message: response.message, timeout: 4000, useSwal: false}))
            .catch(error => VueNotifications.error({title: error.title, message: error.message, timeout: 4000, useSwal: false}));
    },
    methods: {
        ...mapActions(['setCottages'])
    },
});
