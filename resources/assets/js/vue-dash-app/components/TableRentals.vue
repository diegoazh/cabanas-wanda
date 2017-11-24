<template>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Orden</th>
                <th>Desde</th>
                <th>Hasta</th>
                <th>Dias</th>
                <th>Se&ntilde;a</th>
                <th>Vto se&ntilde;a</th>
                <th>Estado</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(rental, index) in pagination.data">
                <td>{{ rowNumber(index) }}</td>
                <td>{{ rental.dateFrom }}</td>
                <td>{{ rental.dateTo }}</td>
                <td>{{ rental.total_days }}</td>
                <td>{{ (100 / 30 * rental.cottage_price).toFixed(2) }}</td>
                <td>{{ rental.dateReservationPayment }}</td>
                <td>{{ rental.state }}</td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="7"></td>
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