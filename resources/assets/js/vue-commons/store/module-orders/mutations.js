export default {
    PAGINATE(state, page) {
        state.page = page
    },
    setRental(state, rental) {
        state.data.rental = rental;
        sessionStorage.setItem('reserva', JSON.stringify(rental));
    }
}