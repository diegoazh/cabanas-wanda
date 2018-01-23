import { http, handlingXhrErrors} from '../../axios/app-axios'
import moment from 'moment'

export default {
    getMyRentals(cntx, payload) {
        return new Promise((resolve, reject) => {
            http.get('profile/rentals', {
                params: {
                    token: payload
                }
            }).then(response => {
                cntx.dispatch('auth/setToken', response, { root: true });
                response.data.rentals.forEach(rental => {
                    rental.dateFrom = moment(rental.dateFrom, 'YYYY-MM-DD');
                    rental.dateTo = moment(rental.dateTo, 'YYYY-MM-DD');
                });
                cntx.commit('setRentals', response.data.rentals);
                resolve({
                    title: 'Listado de reservas',
                    message: 'Hemos localizado todas sus reservas.',
                    type: 'success',
                    useSwal: true
                });
            }).catch(error => {
                cntx.dispatch('auth/setToken', error.response, {root: true});
                reject(handlingXhrErrors(error));
            });
        })
    },
    updateRentalCode(cntx, payload) {
        return new Promise((resolve, reject) => {
            http.post('rentals/update-code', payload, {
                params: {
                    token: cntx.rootGetters['auth/getToken']
                }
            }).then(response => {
                cntx.dispatch('auth/setToken', response, { root: true });
                resolve({
                    title: 'Nuevo código',
                    message: `El nuevo código de su reserva es: ${response.data.code}
                              Se lo enviamos a su casilla de correo electrónico.`,
                    useSwal: true
                });
            }).catch(error => {
                cntx.dispatch('auth/setToken', error.response, { root: true });
                reject(handlingXhrErrors(error));
            })
        });
    }
}