import state from './state'
import getters from './getters'
import mutations from './mutations'
import actions from './actions'

export const moduleDash = {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
};