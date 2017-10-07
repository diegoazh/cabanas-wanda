import { http } from '../axios/my-axios'

export default {
    setBasicInfo({commit}, payload) {
        commit('setIsAdmin', payload.basicOne);
        commit('setUser', payload.basicTwo);
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
                title: 'ERROR ' + error.response.status,
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
                        title: 'Info loaded',
                        message: 'Info loaded successfully!'
                    });
                }).catch(err => reject(dispatch('handlingXhrErrors', err)));
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
                dni: payload.dni,
                email: payload.email
            })
                .then(response => {
                    dispatch('setUserData', response.data.user);
                    dispatch('setToken', response.data.token);
                    dispatch('setCountries', response.data.countries);
                    resolve();
                })
                .catch(err => {
                    dispatch('handlingXhrErrors', err);
                    reject();
                });
        });
    },
    sendClosedDeal(context, payload) {
        return new Promise((resolve, reject) => {
            http.post('rentals/store?token=' + context.state.xhr.token, payload)
                .then(response => {
                    context.dispatch('setResponseMessage', response.data.message);
                    context.commit('setClosedDeal', true);
                })
                .catch(err => context.dispatch('handlingXhrErrors', err));
        })
    }
};