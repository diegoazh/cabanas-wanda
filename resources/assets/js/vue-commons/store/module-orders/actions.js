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
    setDesayunos({commit}, desayunos) {
        commit('setDesayunos', desayunos);
    },
    setAlmuerzos({commit}, almuerzos) {
        commit('setAlmuerzos', almuerzos);
    },
    setMeriendas({commit}, meriendas) {
        commit('setMeriendas', meriendas);
    },
    setCenas({commit}, cenas) {
        commit('setCenas', cenas);
    },
    findReserva(cntx, payload) {
        return new Promise((resolve, reject) => {
            http.post('rentals/find', payload, {
                params: {
                    token: cntx.rootGetters['auth/getToken'],
                }
            }).then(response => {
                cntx.dispatch('auth/setToken', response, {root: true});
                cntx.dispatch('setRental', response.data.reserva);
                resolve({
                    title: '¡Excelente!',
                    message: 'Encontramos la reserva, ahora puedes realizar las operaciones necesarias',
                    useSwal: true
                });
            }).catch(error => {
                reject(handlingXhrErrors(error));
            });
        });
    },
    sendOrder(cntx, payload) {
        return new Promise((resolve, reject) => {
            http.post('orders/store', payload, {
                params: {
                    token: cntx.rootGetters['auth/getToken']
                }
            }).then(response => {
                cntx.dispatch('auth/setToken', response, {root: true});
                resolve({
                    title: 'PEDIDO REALIZADO',
                    message: response.data.message,
                    useSwal: true,
                });
            }).catch(error => {
                cntx.dispatch('auth/setToken', error.response, {root: true});
                reject(handlingXhrErrors(error))
            });
        });
    }
}