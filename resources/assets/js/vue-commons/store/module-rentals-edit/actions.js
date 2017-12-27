import {http, handlingXhrErrors} from '../../axios/app-axios'

export default {
    findRental(cntx, payload) {
        return new Promise((resolve, reject) => {
            http.post('rentals/find', payload)
                .then(response => {
                    if (response.data) cntx.commit('setRental', response.data);
                    let res = {
                        title: '¡Excelente!',
                        message: 'Encontramos la reserva, ahora puede decidir que deseas realizar.',
                        useSwal: true
                    };
                    resolve(res);
                })
                .catch(error => {
                    let err = handlingXhrErrors(error);
                    err.useSwal = true;
                    reject(err);
                });
        });
    },
    updateRental(cntx, payload) {
        return new Promise((resolve, reject) => {
            http.put('rentals/update-with-code/' + payload.id, payload)
                .then(response => {
                    if(response.data.rental) cntx.commit('setUpdatedRental', response.data.rental);
                    if(!response.data.title) {
                        response.data.title = '¡Actualización exitosa!';
                        response.data.message += '\n Enviamos un email con los datos de la actualización al correo electrónico asociado a la reserva.';
                    }
                    response.data.useSwal = true;
                    resolve(response.data);
                })
                .catch(error => {
                    let err = handlingXhrErrors(error);
                    err.useSwal = true;
                    reject(err);
                })
        });
    }
};