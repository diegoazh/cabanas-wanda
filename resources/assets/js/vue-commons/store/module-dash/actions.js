import { http, handlingXhrErrors } from '../../axios/app-axios'

export default {
    rentalsOrOrdersForState(cntx, payload) {
        return new Promise((resolve, reject) => {
            let url = (payload.isRentals ? 'rentals/' : 'orders/') + 'for-state/';
            http.get(url + payload.state + '/' + cntx.state.per_page, {
                params: {
                    page: payload.query || 1,
                    token: payload.token || ''
                }
            }).then(response => {
                let data = payload.isRentals ? response.data.rentals : response.data.orders;
                cntx.dispatch('auth/setToken', response, {root: true});
                cntx.commit('setPagination', data);
                cntx.commit('setPerPage', +data.per_page);
                cntx.commit('setTotal', data.total);
                cntx.commit('PAGINATE', data.current_page);
                resolve();
            }).catch(error => {
                let err = handlingXhrErrors(error);
                err.timeout = 3000;
                reject(err);
            });
        });
    },
}