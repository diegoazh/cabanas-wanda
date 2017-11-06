export default {
    setRentals(state, rentals) {
        state.data.rentals = rentals;
    },
    setDataReportRentals(state, data) {
        state.data.rentalsForMonth.data.datasets[0].data = data;
    }
}