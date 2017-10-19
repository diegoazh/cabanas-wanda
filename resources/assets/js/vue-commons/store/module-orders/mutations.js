export default {
    setRental(state, rental) {
        state.data.rental = rental;
        sessionStorage.setItem('reserva', JSON.stringify(rental));
    }
}