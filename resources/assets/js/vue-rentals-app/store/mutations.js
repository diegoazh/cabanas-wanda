export default {
    setToRentals(state, toRentals) {
        state.data.toRentals = toRentals;
    },
    setCottages(state, cottages) {
        state.data.cottages = cottages;
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
    setResponseError(state, error) {
        state.xhr.responseError = error;
    },
    setResponseStatus(state, status) {
        state.xhr.responseStatus = status;
    },
    setQueryFinished(state, bool) {
        state.xhr.queryFinished = bool;
    }
};