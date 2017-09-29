export default {
    toggleConfig: (state, getters) => {
        return state.data.isAdmin ? state.frmCmp.configForAdmin : state.frmCmp.configForUser;
    },
}