export default {
    PAGINATE(state, page) {
        state.page = page
    },
    setToken(state, token) {
        state.data.token = token;
    },
    setRentals(state, rentals) {
        state.data.rentals = rentals;
    }
}