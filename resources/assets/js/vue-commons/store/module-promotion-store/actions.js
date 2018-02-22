import { http, handlingXhrErrors} from '../../axios/app-axios'

export default {
    promotionsList(cntx, payload) {
        return new Promise((resolve, reject) => {
            http.get('promotions/list')
                .then(response => {
                    cntx.dispatch('auth/setToken', response, {root: true});
                    cntx.commit('setPromotions', response.data.promotions);
                    resolve({
                        title: 'OK!',
                        message: 'Data founded correctly',
                        timeout: 4000
                    })
                }).catch(error => {
                    context.dispatch('auth/setToken', error.response, {root: true});
                    reject(handlingXhrErrors(error));
                });
        });
    },
    createNewPromotion(cntx, payload) {
        return new Promise((resolve, reject) => {
            http.post('promotions/store', payload, {
                params: {
                  token: cntx.rootState.auth.xhr.token
                }
            }).then(response => {
              cntx.dispatch('auth/setToken', response, {root: true});
              resolve({
                title: 'OPERACIÓN EXITOSA',
                message: response.data.message,
                useSwal: true
              });
            }).catch(error => {
              context.dispatch('auth/setToken', error.response, {root: true});
              reject(handlingXhrErrors(error));
            });
        });
    }
}
