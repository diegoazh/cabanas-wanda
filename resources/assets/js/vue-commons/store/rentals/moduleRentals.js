import state from './state'
import mutations from './mutations'
import actions from './actions'
import getters from './getters'

export const moduleRentals = {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
};