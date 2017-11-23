import { http, handlingXhrErrors } from '../../axios/app-axios'

export default {
    rentalsForState(cntx, payload) {
        return new Promise((resolve, reject) => {
            http.get('rentals/for-state/' + payload.state, {
                params: {
                    token: payload.token
                }
            }).then(response => {
                cntx.dispatch('auth/setToken', response, {root: true});
                resolve(response.data.rentals)
            })
                .catch(error => {
                    let err = handlingXhrErrors(error);
                    err.timeout = 3000;
                    reject(err);
                });
        });
    }
}