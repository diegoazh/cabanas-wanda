import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        cottages: [],
        rentals: null,
        isForCottage: false
    },
    mutations: {
        setRentals(state, rentals) {
            state.rentals = rentals;
        },
        setCottages(state, cottages) {
            state.cottages = cottages;
        },
        toggleIsForCottage(state, bool) {
            state.isForCottage = bool;
        }
    }
});