import Vue from 'vue'

import AdminFood from './components/AdminFood.vue'

const adminFoodApp = new Vue({
    el: '.panel',
    render: h => h(AdminFood)
});