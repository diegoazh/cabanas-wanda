import Vue from 'vue'
import Vuex from 'vuex'
import { moduleAuth } from './auth/moduleAuth'
import { moduleRentals } from './rentals/moduleRentals'
import { moduleFood } from './food/moduleFood'

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        auth: moduleAuth,
        rentals: moduleRentals,
        food: moduleFood
    }
});
