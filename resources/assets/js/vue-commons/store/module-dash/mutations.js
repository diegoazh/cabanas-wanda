export default {
    PAGINATE(state, page) {
        if (state.page !== page) {
            window.EventBus.$emit('page-change', page);
            state.page = page;
        }
    },
    setTotal(state, total) {
        state.total = total;
    },
    setPerPage(state, per_page) {
        state.per_page = per_page;
    },
    setPagination(state, pagination) {
        state.data.pagination = pagination;
    }
}