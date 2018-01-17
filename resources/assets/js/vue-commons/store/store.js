import Vue from 'vue';
import Vuex from 'vuex';
import { moduleAuth } from './module-auth/moduleAuth';
import { moduleRentals } from './module-rentals/moduleRentals';
import { moduleRentalsEdit } from './module-rentals-edit/moduleRentalsEdit';
import { moduleFood } from './module-food/moduleFood';
import { moduleOrders } from './module-orders/moduleOrders';
import { moduleLiquidation } from './module-liquidation/moduleLiquidation';
import { moduleReports } from './module-reports/moduleReports';
import { moduleDash } from './module-dash/moduleDash';
import { moduleProfileRentals } from './module-profile-rentals/moduleProfileRentals';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        auth: moduleAuth,
        rentals: moduleRentals,
        rentals_edit: moduleRentalsEdit,
        food: moduleFood,
        orders: moduleOrders,
        liquidation: moduleLiquidation,
        reports: moduleReports,
        dash: moduleDash,
        profile_rentals: moduleProfileRentals
    }
});
