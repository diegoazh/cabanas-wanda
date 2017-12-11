import {http, handlingXhrErrors} from '../../axios/app-axios'

export default {
    setBasicInfo({commit}, payload) {
        commit('setIsAdmin', payload.infoOne);
        commit('setUserLogged', payload.infoTwo);
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
    setDeal({commit}, bool) {
        commit('setDeal', bool);
    },
    setClosedDeal({commit}, bool) {
        commit('setClosedDeal', bool);
    },
    setUserData({commit}, user) {
        commit('setUser', user);
    },
    setCottages({commit, dispatch}) {
        return new Promise((resolve, reject) => {
            http.get('cottages/enabled/')
                .then(response => {
                    commit('setCottages', response.data.cottages);
                    resolve({
                        title: 'Ok!',
                        message: 'Widget cargado correctamente!'
                    });
                }).catch(err => {
                dispatch('auth/setQueryFinished', true);
                reject(handlingXhrErrors(err));
            });
        });
    },
    queryCottagesAvailables({dispatch}, payload) {
        return new Promise((resolve, reject) => {
            http.post('rentals/availables/', {
                query: payload.choice,
                simple: payload.simple,
                dateFrom: payload.dateFrom,
                dateTo: payload.dateTo,
                isForCottage: payload.isForCottage
            }).then(response => {
                dispatch('setToRentals', response.data.cottages);
                dispatch('auth/setQueryFinished', true, {root: true});
                resolve();
            }).catch(err => {
                dispatch('setToRentals', []);
                dispatch('auth/setQueryFinished', true, {root: true});
                reject(handlingXhrErrors(err));
            });
            dispatch('setLastQueryData', payload);
        });
    },
    authenticateUser({dispatch}, payload) {
        return new Promise((resolve, reject) => {
            http.post('auth/auth/', {
                isAdmin: payload.isAdmin,
                userLogged: payload.userLogged,
                document: payload.document,
                email: payload.email
            }).then(response => {
                let obj = {};
                dispatch('setUserData', response.data.user);
                dispatch('auth/setToken', response, {root: true});
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
                dispatch('auth/setQueryFinished', true, {root: true});
                reject(handlingXhrErrors(err));
            });
        });
    },
    sendClosedDeal(context, payload) {
        return new Promise((resolve, reject) => {
            if (payload.createNew) {
                http.post('passengers/store', payload)
                    .then(response => {
                        context.dispatch('auth/setToken', response, {root: true});
                        http.post('rentals/store?token=' + context.rootState.auth.xhr.token, payload)
                            .then(response => {
                                context.dispatch('auth/setToken', response, {root: true});
                                context.commit('setClosedDeal', true);
                                context.commit('setInfoDeal', response.data.rentals);
                                resolve({
                                    title: 'RESERVA EXITOSA',
                                    message: 'Se concretó con éxito la reserva, por favor toma nota de los códigos de reserva generados. Muchas gracias',
                                    useSwal: true
                                });
                            })
                    })
                    .catch(err => {
                        context.dispatch('auth/setToken', err.response, {root: true});
                        context.dispatch('auth/setQueryFinished', true, {root: true});
                        reject(handlingXhrErrors(err));
                    });
            } else {
                http.post('rentals/store?token=' + context.rootState.auth.xhr.token, payload)
                    .then(response => {
                        context.dispatch('auth/setToken', response, {root: true});
                        context.commit('setClosedDeal', true);
                        context.commit('setInfoDeal', response.data.rentals);
                        resolve({
                            title: 'RESERVA EXITOSA',
                            message: 'Se concretó con éxito la reserva, por favor toma nota de los códigos de reserva generados. Muchas gracias',
                            useSwal: true
                        });
                    })
                    .catch(err => {
                        context.dispatch('auth/setToken', err.response, {root: true});
                        context.dispatch('auth/setQueryFinished', true, {root: true});
                        reject(handlingXhrErrors(err));
                    });
            }

        })
    }
};