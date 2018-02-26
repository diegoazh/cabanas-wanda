import { http, handlingXhrErrors } from '../../axios/app-axios'

export default {
    rentalsOrOrdersForState(cntx, payload) {
        return new Promise((resolve, reject) => {
            let url = (payload.isRentals ? 'rentals/' : 'orders/') + 'for-state/';
            http.get(url + payload.state + '/' + cntx.state.per_page, {
                params: {
                    page: payload.query || 1,
                    token: payload.token || '',
                    order: payload.order.for,
                    sent: payload.order.sent
                }
            }).then(response => {
                cntx.dispatch('auth/setToken', response, {root: true});
                cntx.commit('setPagination', response.data);
                cntx.commit('setPerPage', +response.data.per_page);
                cntx.commit('setTotal', response.data.total);
                cntx.commit('PAGINATE', response.data.current_page);
                resolve();
            }).catch(error => {
                cntx.dispatch('auth/setToken', error, {root: true});
                let err = handlingXhrErrors(error);
                err.timeout = 3000;
                reject(err);
            });
        });
    },
    rentalsOrOrdersForId(cntx, payload) {
        return new Promise((resolve, reject) => {
            let url = (payload.isRentals ? 'rentals/' : 'orders/') + 'for-id/';
            http.get(url + payload.id, {
                params: {
                    token: cntx.rootState.auth.xhr.token || ''
                }
            }).then(response => {
                cntx.dispatch('auth/setToken', response, {root: true});
                resolve(response.data);
            }).catch(error => {
                cntx.dispatch('auth/setToken', error, {root: true});
                let err = handlingXhrErrors(error);
                err.timeout = 3000;
                reject(err);
            })
        });
    },
    updateRental(cntx, payload) {
        return new Promise((resolve, reject) => {
            http.put('rentals/update/' + payload.id, payload)
                .then(response => {
                    response.data.title = "¡Actualizción Ok!";
                    response.data.useSwal = true;
                    resolve(response.data);
                }).catch(error => {
                    let err = handlingXhrErrors(error);
                    err.useSwal = true;
                    reject(err);
                });
        });
    },
    updateOrder(cntx, payload) {
        return new Promise((resolve, reject) => {
           http.put('orders/update-states/' + payload.id, payload, {
               params: {
                   token: cntx.rootState.auth.xhr.token || ''
               }
           }).then(response => {
               cntx.dispatch('auth/setToken', response, {root: true});
               response.data.title = "¡Actualizción Ok!";
               response.data.useSwal = true;
               resolve(response.data);
           }).catch(error => {
               cntx.dispatch('auth/setToken', error, {root: true});
               let err = handlingXhrErrors(error);
               err.useSwal = true;
               reject(err);
           });
        });
    }
}