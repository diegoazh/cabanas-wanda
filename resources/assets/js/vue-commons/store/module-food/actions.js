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
    setItemToUpdate({commit}, food) {
        commit('setItemToUpdate', food);
    },
    setCreate({commit}, bool) {
        commit('setCreate', bool);
    },
    setItemsPerPage({commit}, items) {
        commit('setItemsPerPage', items);
    },
    pagination({commit}, page) {
        commit('PAGINATE', page);
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
    storeFood(context, payload) {
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
    },
    updateFood(context, payload) {
        return new Promise((resolve, reject) => {
            http.put('food/update/' + payload.id, payload, {
                params: {
                    token: context.rootState.auth.xhr.token,
                }
            }).then(response => {
                context.dispatch('auth/refreshToken', response.headers, {root: true});
                resolve({
                    title: 'Actualizado',
                    message: response.data.message,
                    useSwal: true
                });
            }).catch(error => {
                context.commit('auth/setQueryFinished', bool, {root: true});
                reject(handlingXhrErrors(error));
            });
        });
    },
    deleteFood(context, id) {
        return new Promise((resolve, reject) => {
            http.delete('food/destroy/' + id, {
                params: {
                    token: context.rootState.auth.xhr.token,
                }
            }).then(response => {
                context.dispatch('auth/refreshToken', response.headers, {root: true});
                resolve({
                    title: 'Eliminado',
                    message: response.data.message,
                    useSwal: true
                });
            }).catch(error => {
                context.commit('auth/setQueryFinished', bool, {root: true});
                reject(handlingXhrErrors(error));
            });
        });
    },
}