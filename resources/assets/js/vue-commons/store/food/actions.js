import { http, handlingXhrErrors } from '../../axios/app-axios'

export default {
    setXhrToken({commit}, token) {
        commit('setToken', token, {root: true});
        window.clearTimeout(window.verifyToken);
        delete window.verifyToken;
    },
    sendNewFood(context, payload) {
        return new Promise((resolve, reject) => {
            http.post('food/rentals', payload, {
                params: {
                    token: context.state.auth.xhr.token,
                }
            }).then(response => resolve(response.data))
                .catch(error => {
                    context.commit('setQueryFinished', bool, {root: true});
                    reject(handlingXhrErrors(error))
                });
        });
    }
}