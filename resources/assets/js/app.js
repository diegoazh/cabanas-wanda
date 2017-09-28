import Vue from 'vue'
import VueResource from 'vue-resource'

import store from './store'
import Rentals from './components/Rentals.vue'

Vue.use(VueResource);

window.EventBus = new Vue();

const app = new Vue({
    el: '#vue-app',
    store,
    render: h => h(Rentals),
    created() {
        this.prueba();
    },
    methods: {
        prueba() {
            this.$http.get('http://homestead.app/api/basic')
                .then(response => {
                    this.$store.commit('setCottages', response.body.cottages);
                });
        }
    }
});
