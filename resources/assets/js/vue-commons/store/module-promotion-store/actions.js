import { http, handlingXhrErrors} from '../../axios/app-axios'
import moment from 'moment'

export default {
    createNewPromotion(cntx, payload) {
        return new Promise((resolve, reject) => {
            http.post('promotion/store', payload, {
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
