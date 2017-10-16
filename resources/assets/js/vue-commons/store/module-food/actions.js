import { http, handlingXhrErrors } from '../../axios/app-axios'

export default {
    setXhrToken({commit}, token) {
        commit('auth/setToken', token, {root: true});
        window.clearTimeout(window.verifyToken);
        delete window.verifyToken;
    },
    setFood({commit}, food) {
        commit('setFood', food);
    },
    setCreate({commit}, bool) {
        commit('setCreate', bool);
    },
    getAllFood({dispatch}) {
        return new Promise((resolve, reject) => {
           http.get('food/all')
               .then(response => {
                   dispatch('setFood', response.data.comidas);
                   resolve();
               })
               .catch(error => reject(handlingXhrErrors(error)));
        });
    },
    sendNewFood(context, payload) {
        return new Promise((resolve, reject) => {
            http.post('food/store', payload, {
                params: {
                    token: context.rootState.auth.xhr.token,
                }
            }).then(response => {
                context.dispatch('auth/refreshToken', response.headers, {root: true});
                resolve({
                    title: 'Creado',
                    message: response.data.message,
                    useSwal: true
                });
            }).catch(error => {
                context.commit('auth/setQueryFinished', bool, {root: true});
                reject(handlingXhrErrors(error));
            });
        });
    }
}