export default {
    setXhrToken({commit}, token) {
        commit('setXhrToken', token);
        window.clearTimeout(window.verifyToken);
        delete window.verifyToken;
    }
}