import { http } from '../axios/my-axios'

export default {
    setBasicInfo({commit}, payload) {
        commit('setIsAdmin', payload.admin);
        commit('setUser', payload.user);
    },
    setIsForCottage({commit}, bool) {
        commit('setIsForCottage', bool);
    },
    setToRentals({commit}, toRentals) {
        commit('setToRentals', toRentals);
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
    setCottages({commit}){
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
};