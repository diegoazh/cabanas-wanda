import Vue from 'vue'
import VueResource from 'vue-resource'

import store from './store'
import Rentals from './components/Rentals.vue'

Vue.use(VueResource);

const app = new Vue({
    el: '#vue-app',
    store,
    render: h => h(Rentals),
    created() {
        this.prueba();
    },
    methods: {
        prueba() {
            this.$http.get('http://homestead.app/api/query')
                .then(response => {
                    this.$store.commit('setRentals', response.body);
                });
        }
    }
});
