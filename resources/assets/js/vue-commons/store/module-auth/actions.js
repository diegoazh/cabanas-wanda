export default {
    setToken({commit}, token) {
        commit('setToken', token);
    },
    setQueryFinished({commit}, bool) {
        commit('setQueryFinished', bool);
    },
    refreshToken({dispatch}, headers) {
        if (headers.authorization) {
            dispatch('setToken', headers.authorization.split(' ')[1]);
        }
    }
}