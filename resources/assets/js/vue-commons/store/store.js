import Vue from 'vue'
import Vuex from 'vuex'
import { moduleAuth } from './module-auth/moduleAuth'
import { moduleRentals } from './module-rentals/moduleRentals'
import { moduleFood } from './module-food/moduleFood'
import { moduleOrders } from './module-orders/moduleOrders';
import { moduleLiquidation } from './module-liquidation/moduleLiquidation';
import { moduleReports } from './module-reports/moduleReports';
import { moduleDash } from './module-dash/moduleDash';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        auth: moduleAuth,
        rentals: moduleRentals,
        food: moduleFood,
        orders: moduleOrders,
        liquidation: moduleLiquidation,
        reports: moduleReports,
        dash: moduleDash
    }
});
