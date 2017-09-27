import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        rentals: null
    },
    mutations: {
        setRentals(state, rentals) {
            state.rentals = rentals;
        }
    }
});