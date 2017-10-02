export default {
    setToRentals(state, toRentals) {
        if (Array.isArray(toRentals)) {
            state.data.toRentals = toRentals;
        } else {
            state.data.toRentals = new Array(toRentals);
        }
    },
    deleteItemToRentals(state, index) {
        state.data.toRentals.splice(index, 1);
    },
    setCottages(state, cottages) {
        if (Array.isArray(cottages)) {
            state.data.cottages = cottages;
        } else {
            state.data.cottages = new Array(cottages);
        }
    },
    setCountries(state, countries) {
        if (Array.isArray(countries)) {
            state.data.countries = countries;
        } else {
            state.data.countries = new Array(countries);
        }
    },
    setIsForCottage(state, bool) {
        state.frmCmp.isForCottage = bool;
    },
    setIsAdmin(state, admin) {
        state.data.isAdmin = admin;
    },
    setUser(state, user) {
        state.data.user = user;
    },
    setToken(state, token) {
        state.xhr.token = token;
    },
    setDeal(state, bool) {
        state.data.deal = bool;
    },
    setClosedDeal(state, bool) {
        state.data.closedDeal = bool;
    },
    setResponseMessage(state, message) {
        state.xhr.responseMessage = message;
    },
    setResponseError(state, error) {
        state.xhr.responseError = error;
    },
    setResponseStatus(state, status) {
        state.xhr.responseStatus = status;
    },
    setQueryFinished(state, bool) {
        state.xhr.queryFinished = bool;
    },
    setLastQuery(state, number) {
        state.lastQueryData.query = number;
    },
    setLastSimple(state, bool) {
        state.lastQueryData.simple = bool;
    },
    setLasDateFrom(state, date) {
        state.lastQueryData.dateFrom = date;
    },
    setLasDateTo(state, date) {
        state.lastQueryData.dateTo = date;
    }
};