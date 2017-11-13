export default {
    setCreate(state, bool) {
        state.data.create = bool;
    },
    setFood(state, food) {
        state.data.food = food;
    },
    setItemToUpdate(state, food) {
        state.data.itemToUpdate = food;
    },
    setItemsPerPage(state, items) {
        state.itemsPerPage = items;
    },
    PAGINATE(state, page) {
        state.page = page
    }
}