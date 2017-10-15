export default {
    setToken({commit}, token) {
        commit('setToken', token);
    },
    setQueryFinished({commit}, bool) {
        commit('setQueryFinished', bool);
    },
}