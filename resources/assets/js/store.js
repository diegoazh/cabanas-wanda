import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        cottages: [],
        rentals: null,
        isForCottage: false,
        isAdmin: false,
        user: ''
    },
    mutations: {
        mRentals(state, rentals) {
            state.rentals = rentals;
        },
        mCottages(state, cottages) {
            state.cottages = cottages;
        },
        mIsForCottage(state, bool) {
            state.isForCottage = bool;
        },
        mIsAdmin(state, admin) {
            state.isAdmin = admin;
        },
        mUser(state, user) {
          state.user = user;
        }
    },
    actions: {
        setRentals(){}
    }
});