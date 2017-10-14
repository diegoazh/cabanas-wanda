import Vue from 'vue'
import Vuex from 'vuex'
import { moduleRentals } from './rentals/moduleRentals'
import { moduleFood } from "./food/moduleFood";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        rentals: moduleRentals,
        food: moduleFood
    }
});

