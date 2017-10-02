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
    setResponseStatus({commit}, status) {
        commit('setResponseStatus', status);
    },
    setResponseError({commit}, error) {
        commit('setResponseError', error);
    },
    setResponseMessage({commit}, message) {
        commit('setResponseMessage', message);
    },
    handlingXhrErrors({dispatch}, error) {
        if (error.response) {
            // The request was made and the server responded with a status code
            // that falls out of the range of 2xx
            dispatch('setResponseStatus', +error.response.status);
            dispatch('setResponseError', 'ERROR - ' + error.response.status + ': ' + error.response.data.error);
        } else if (error.request) {
            // The request was made but no response was received
            // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
            // http.ClientRequest in node.js
            console.log(error.request);
        } else {
            // Something happened in setting up the request that triggered an Error
            console.log('Error', error.message);
        }
        dispatch('setQueryFinished', true);
    },
    setCottages({commit, dispatch}){
        http.get('rentals/basic/')
            .then(response => {
                commit('setCottages', response.data.cottages);
            }).catch(err => dispatch('handlingXhrErrors', err));
    },
    queryForCapacity({dispatch}, payload) {
        http.post('rentals/capacity/', {
            query: payload.choice,
            simple: payload.simple,
            dateFrom: payload.dateFrom,
            dateTo: payload.dateTo
        }).then(response => {
            dispatch('setToRentals', response.data.cottages);
            dispatch('setQueryFinished', true);
        })
            .catch(err => dispatch('handlingXhrErrors', err));
        dispatch('setLastQueryData', payload);
    },
    queryForCottage({dispatch}, payload) {
        http.post('rentals/cottage/', {
            query: payload.choice,
            simple: payload.simple,
            dateFrom: payload.dateFrom,
            dateTo: payload.dateTo
        }).then(response => {
            dispatch('setToRentals', response.data.cottage);
            dispatch('setQueryFinished', true);
        })
            .catch(err => dispatch('handlingXhrErrors', err));
        dispatch('setLastQueryData', payload);
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