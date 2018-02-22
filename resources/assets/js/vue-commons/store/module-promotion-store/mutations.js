export default {
    setPromotions(state, promotions) {
        if (!Array.isArray(promotions)) return;
        state.data.promotions = promotions
    }
}