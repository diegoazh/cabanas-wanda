<template>
    <button type="button" class="list-group-item btn-item" @click="deleteItemToRentals(index)">
        <img :src="cottage.images" alt="" class="img-responsive img-thumbnail img-circle img-btn-item">
        <h4 class="text-capitalize label label-info tt-btn-item">{{ cottage.name }}</h4>
        <p class="capacity-btn-item"><span class="text-info">Capacidad:</span> <b>{{ cottage.accommodation }}</b></p>
        <p class="number-btn-item"><span class="text-info">Cabaña número:</span> <b>{{ cottage.number }}</b></p>
        &nbsp;
        <span :class="['label', {'label-primary': cottage.type === 'simple', 'label-success': cottage.type === 'matrimonial'}]"><b class="text-capitalize">{{ cottage.type }}</b></span>
        <icon-app iconImage="check-square-o" aditionalClasses="pull-right icon-btn-item"></icon-app>
    </button>
</template>

<script>
    import { mapActions } from 'vuex'
    import Icon from './Icon.vue'

    export default {
        components: {
            'icon-app': Icon
        },
        props: ['cottage', 'index'],
        methods: {
            ...mapActions(['deleteItemToRentals'])
        }
    }
</script>

<style>
    .img-btn-item {
        max-width: 20%;
        display: inline-block;
        -webkit-box-shadow: inset 2px 3px 3px #333333;
        -moz-box-shadow: inset 2px 3px 3px #333333;
        box-shadow: inset 2px 3px 3px #333333;
        border-color: #333d53;
    }
    .tt-btn-item {
        display: inline-block;
        margin-left: 1.5%;
        font-size: 18px;
        font-weight: bolder;
        text-transform: uppercase;
    }
    .capacity-btn-item {
        display: inline-block;
        margin-left: 1.5%;
        font-size: 14px !important;
    }
    .number-btn-item {
        display: inline-block;
        margin-left: 1.5%;
        font-size: 14px !important;
    }
    .icon-btn-item:before {
        font-size: 220%;
        position: relative;
        top: 32px;
    }
    .btn-item {
        -webkit-box-shadow: 2px 2px 5px #333333;
        -moz-box-shadow: 2px 2px 5px #333333;
        box-shadow: 2px 2px 5px #333333;
    }
    .btn-item i:before {
        color: #5cb85c;
    }
    .btn-item:hover i:before {
        color: #d9534f;
        content: '\f057';
        font-family: FontAwesome;
    }
</style>