export default {
    setXhrToken(state, token) {
        state.xhr.token = token;
    },
    setQueryFinished(state, bool) {
        state.xhr.queryFinished = bool;
    }
}