export default {
    toRentals: (state, getters) => { return state.data.toRentals },
    isForCottage: (state, getters) => { return state.frmCmp.isForCottage },
    cottages: (state, getters) => { return state.data.cottages },
    toggleConfig: (state, getters) => {
        return state.data.isAdmin ? state.frmCmp.configForAdmin : state.frmCmp.configForUser;
    },
    responseError: (state, getters) => { return state.xhr.responseError },
    responseStatus: (state, getters) => { return state.xhr.responseStatus },
    queryFinished: (state, getters) => { return state.xhr.queryFinished }
}