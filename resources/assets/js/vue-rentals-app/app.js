import Vue from 'vue'
import { mapActions } from 'vuex'

import store from './store/store'
import Rentals from './components/Rentals.vue'

window.EventBus = new Vue();

const app = new Vue({
    el: '#vue-rentals-app',
    store,
    render: h => h(Rentals),
    created() {
        this.setCottages();
    },
    methods: {
        ...mapActions(['setCottages'])
    }
});
