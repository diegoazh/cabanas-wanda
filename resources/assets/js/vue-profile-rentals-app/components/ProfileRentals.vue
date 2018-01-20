<template>
    <div class="row justify-content-center">
        <div class="col-12">
            <table class="table table-striped">
                <thead class="bg-dark text-light">
                <tr>
                    <th>Desde</th>
                    <th>Hasta</th>
                    <th>Cabaña</th>
                    <th>Precio</th>
                    <th>Acción</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="5" class="text-right">Reservas ordenadas por {{ orden }}.</td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'profile-rentals',
        components: {},
        data() {
            return {
                orden: 'fecha'
            }
        },
        computed: {},
        methods: {},
        filters: {},
        created() {
        },
        mounted() {
        }
    }
</script>

<style scoped>

</style>