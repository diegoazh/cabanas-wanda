<template>
    <div id="orders-component" class="container jumbotron">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <h1 class="text-center">Ordenes</h1>
                <p class="text-center">Puedes programar los pedidos que desee para cada día de tu estadía</p>
            </div>
        </div>
        <find-rental-app></find-rental-app>
    </div>
</template>

<script>
    import FindRental from './FindRental.vue'

    export default {
        components: {
            'find-rental-app': FindRental
        }
    }
</script>

<style>
    #orders-component {
        margin-top: 30px;
        background-color: rgba(238,238,238,0.4);
    }
</style>