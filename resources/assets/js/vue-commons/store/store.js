import Vue from 'vue'
import Vuex from 'vuex'
import { moduleAuth } from './module-auth/moduleAuth'
import { moduleRentals } from './module-rentals/moduleRentals'
import { moduleFood } from './module-food/moduleFood'

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        auth: moduleAuth,
        rentals: moduleRentals,
        food: moduleFood
    }
});
