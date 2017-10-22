import { http, handlingXhrErrors} from '../../axios/app-axios'

export default {
    pagination({commit}, page) {
        commit('PAGINATE', page);
    },
    setRental({commit}, rental) {
        commit('setRental', rental);
    },
    setOrders({commit}, food) {
        commit('setOrders', food);
    },
    setCloseOrder({commit}, bool) {
        commit('setCloseOrder', bool);
    },
    findReserva(cntx, payload) {
        return new Promise((resolve, reject) => {
            http.post('rentals/find', payload, {
                params: {
                    token: cntx.rootGetters['auth/getToken'],
                }
            }).then(response => {
                cntx.commit('auth/setToken', response.data.token, {root: true});
                cntx.commit('setRental', response.data.reserva);
                resolve({
                    title: '¡Excelente!',
                    message: 'Encontramos la reserva, ahora puedes realizar tus pedidos sin ningún problema',
                    useSwal: true
                });
            }).catch(error => {
                reject(handlingXhrErrors(error));
            });
        });
    },
}