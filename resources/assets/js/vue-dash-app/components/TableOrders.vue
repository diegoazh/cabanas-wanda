<template>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Orden</th>
                <th>Cabaña</th>
                <th>Se&ntilde;a</th>
                <th>Fecha de se&ntilde;a</th>
                <th>Estado</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(orders, index) in pagination.data">
                <td>{{ rowNumber(index) }}</td>
                <td>{{ orders.rental.cottage.name }}</td>
                <td>{{ orders.senia }}</td>
                <td>{{ orders.senia_date }}</td>
                <td>{{ orders.state }}</td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="4"></td>
            </tr>
            </tfoot>
        </table>
    </div>
</template>

<script>
    import { mapState } from 'vuex';

    export default {
        components: {},
        data() {
            return {}
        },
        computed: {
            ...mapState('dash', {
                pagination: state => state.data.pagination,
                page: state => state.page,
            }),
        },
        methods: {
            rowNumber(index) {
                let adition = (this.page - 1) * 15;
                return index + 1 + adition;
            }
        },
        filters: {},
        created() {
        },
        mounted() {
        }
    }
</script>

<style></style>