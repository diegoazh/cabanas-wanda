import { http } from '../../vue-commons/axios/app-axios'

export default {
    setBasicInfo({commit}, payload) {
        commit('setIsAdmin', payload.basicOne);
        commit('setUserLogged', payload.basicTwo);
        window.clearTimeout(window.verify);
        delete window.verify;
    },
    setIsForCottage({commit}, bool) {
        commit('setIsForCottage', bool);
    },
    setToRentals({commit}, toRentals) {
        commit('setToRentals', toRentals);
    },
    setCountries({commit}, countries) {
        commit('setCountries', countries);
    },
    deleteItemToRentals({commit}, index) {
        commit('deleteItemToRentals', index);
    },
    setLastQueryData({commit}, payload) {
        commit('setLastQuery', payload.choice);
        commit('setLastSimple', payload.simple);
        commit('setLasDateFrom', payload.dateFrom);
        commit('setLasDateTo', payload.dateTo);
    },
    setQueryFinished({commit}, bool) {
        commit('setQueryFinished', bool);
    },
    handlingXhrErrors({dispatch}, error) {
        dispatch('setQueryFinished', true);
        if (error.response) {
            // The request was made and the server responded with a status code
            // that falls out of the range of 2xx
            return {
                title: error.response.data.title ? error.response.data.title : 'ERROR ' + error.response.status,
                message: error.response.data.error
            };
        } else if (error.request) {
            // The request was made but no response was received
            // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
            // http.ClientRequest in node.js
            console.log('Info', error.request);
            return {
                title: 'Se produjo un error',
                message: 'No hemos recibido respuesta desde el servidor.'
            };
        } else {
            // Something happened in setting up the request that triggered an Error
            console.log('Error', error.message);
            return {
                title: 'Se produjo un error',
                message: 'Algo ocurrio generando la petición al servidor.'
            }
        }
    },
    setCottages({commit, dispatch}){
        return new Promise((resolve, reject) => {
            http.get('rentals/basic/')
                .then(response => {
                    commit('setCottages', response.data.cottages);
                    resolve({
                        title: 'Ok!',
                        message: 'Widget cargado correctamente!'
                    });
                }).catch(err => {
                    dispatch('handlingXhrErrors', err)
                        .then(response => reject(response))
                        .catch(error => reject({title: 'ERROR', messagge: error}))
                });
        });
    },
    queryCottagesAvailables({dispatch}, payload) {
        return new Promise((resolve, reject) => {
            const url = 'rentals/availables/';
            http.post(url, {
                query: payload.choice,
                simple: payload.simple,
                dateFrom: payload.dateFrom,
                dateTo: payload.dateTo,
                isForCottage: payload.isForCottage
            }).then(response => {
                dispatch('setToRentals', response.data.cottages);
                dispatch('setQueryFinished', true);
                resolve();
            }).catch(err => {
                dispatch('setToRentals', []);
                dispatch('handlingXhrErrors', err)
                    .then(response => reject(response))
                    .catch(error => reject({title: 'ERROR', messagge: error}))
            });
            dispatch('setLastQueryData', payload);
        });
    },
    setDeal({commit}, bool) {
        commit('setDeal', bool);
    },
    setClosedDeal({commit}, bool) {
        commit('setClosedDeal', bool);
    },
    setUserData({commit}, user) {
        commit('setUser', user);
    },
    setToken({commit}, token) {
        commit('setToken', token);
    },
    authenticateUser({dispatch}, payload) {
        return new Promise((resolve, reject) => {
            http.post('rentals/auth/', {
                isAdmin: payload.isAdmin,
                userLogged: payload.userLogged,
                document: payload.dni,
                email: payload.email
            }).then(response => {
                    let obj = {};
                    dispatch('setUserData', response.data.user);
                    dispatch('setToken', response.data.token);
                    dispatch('setCountries', response.data.countries);
                    if (response.data.token) {
                        obj = {
                            title: 'ClIENTE IDENTIFICADO',
                            message: 'Hemos identificado tus datos. Por favor verifica que sean correctos.',
                            type: 'success',
                            useSwal: true
                        }
                    } else {
                        obj = {
                            title: 'ClIENTE ANONIMO',
                            message: 'No hemos podido identificarte, por favor ingresa completa los siguientes datos. Muchas gracias.',
                            type: 'warn',
                            useSwal: true
                        }
                    }
                    resolve(obj);
            }).catch(err => {
                dispatch('handlingXhrErrors', err)
                    .then(response => reject(response))
                    .catch(error => reject({title: 'ERROR', messagge: error}))
            });
        });
    },
    sendClosedDeal(context, payload) {
        return new Promise((resolve, reject) => {
            http.post('rentals/store?token=' + context.state.xhr.token, payload)
                .then(response => {
                    let token = response.headers.authorization.split(' ')[1];
                    context.commit('setToken', token);
                    context.commit('setClosedDeal', true);
                    context.commit('setInfoDeal', response.data.rentals);
                    resolve({
                        title: 'RESERVA EXITOSA',
                        message: 'Se concretó con éxito la reserva, por favor toma nota de los códigos de reserva generados. Muchas gracias',
                        useSwal: true
                    });
                }).catch(err => {
                    dispatch('handlingXhrErrors', err)
                    .then(response => reject(response))
                    .catch(error => reject({title: 'ERROR', messagge: error}))
            });
        })
    }
};