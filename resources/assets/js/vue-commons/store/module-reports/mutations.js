export default {
    setRentals(state, rentals) {
        state.data.rentals = rentals;
    },
    setExecutingOrdersQuery(state, bool) {
        state.data.executingOrdersQuery = bool;
    },
    setLastQueryOrders(state, time) {
        state.data.lastQueryOrders = time;
    },
}