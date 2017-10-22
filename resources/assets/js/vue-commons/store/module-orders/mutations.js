export default {
    PAGINATE(state, page) {
        state.page = page
    },
    setRental(state, rental) {
        state.data.rental = rental;
        sessionStorage.setItem('reserva', JSON.stringify(rental));
    },
    setOrders(state, food) {
        if (food.checked) {
            state.data.orders.push(food);
        } else {
            state.data.orders.splice(state.data.orders.findIndex(element => element.name === food.name), 1);
        }
    },
    setCloseOrder(state, bool) {
        state.data.closeOrder = bool;
    },
    setDesayunos(state, desayunos) {
        state.data.desayunos = desayunos;
    },
    setAlmuerzos(state, almuerzos) {
        state.data.almuerzos = almuerzos;
    },
    setMeriendas(state, meriendas) {
        state.data.meriendas = meriendas;
    },
    setCenas(state, cenas) {
        state.data.cenas = cenas;
    },
}