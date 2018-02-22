export default {
    PAGINATE(state, page) {
        state.page = page
    },
    setRental(state, rental) {
        state.data.rental = rental;
        sessionStorage.setItem('reserva', JSON.stringify(rental));
    },
    setOrders(state, food) {
        if (Array.isArray(food) && food.length === 0) {
            state.data.orders = food;
        } else if (food.checked) {
            state.data.orders.push(food);
        } else {
            state.data.orders.splice(state.data.orders.findIndex(element => element.name === food.name), 1);
        }
    },
    setOrderToEdit(state, bool) {
        state.data.orderToEdit = bool;
    },
    setOrderId(state, id) {
        state.data.orderId = id;
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