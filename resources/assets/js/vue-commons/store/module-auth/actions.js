export default {
    setToken({commit}, response) {
        if (response && response.headers.authorization) {
            commit('setToken', response.headers.authorization.split(' ')[1]);
        } else if (response && response.data.token) {
            commit('setToken', response.data.token);
        } else {
            commit('setToken', '');
        }
    },
    setQueryFinished({commit}, bool) {
        commit('setQueryFinished', bool);
    },
    fireSetTokenMutation({commit}, token) {
        commit('setToken', token);
    }
}