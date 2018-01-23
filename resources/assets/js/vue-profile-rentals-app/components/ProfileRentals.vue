<template>
    <div class="row justify-content-center">
        <div class="col-7">
            <table class="table table-striped">
                <thead class="bg-dark text-light">
                <tr>
                    <th><i class="fa fa-calendar" aria-hidden="true"></i> Desde</th>
                    <th><i class="fa fa-calendar" aria-hidden="true"></i> Hasta</th>
                    <th><i class="fa fa-home" aria-hidden="true"></i> Cabaña</th>
                    <th><i class="fa fa-dollar" aria-hidden="true"></i> Precio</th>
                    <th><i class="fa fa-info-circle" aria-hidden="true"></i> Acciones</th>
                </tr>
                </thead>
                <tbody v-if="rentals.length > 0">
                <tr v-for="rental in rentals">
                    <td>
                        <span class="badge badge-success">{{ rental.dateFrom.format('DD/MM/YYYY') }}</span>
                        <sup class="badge badge-info font-italic" v-if="isCurrent(rental.dateFrom, rental.dateTo)">{{'En curso'}}</sup>
                    </td>
                    <td><span class="badge badge-danger">{{ rental.dateTo.format('DD/MM/YYYY') }}</span></td>
                    <td><span class="badge badge-secondary">{{ rental.cottage.name.toUpperCase() }}</span></td>
                    <td><i class="fa fa-dollar" aria-hidden="true"></i> {{ rental.cottage_price }} <sup style="text-decoration: underline;"><b>ARS</b></sup></td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalNewCode" @click.prevent="rentalModal = rental"><i class="fa fa-barcode"></i> Nuevo código</button>
                    </td>
                </tr>
                </tbody>
                <tfoot class="bg-light">
                <tr>
                    <td colspan="5" class="text-right">Reservas ordenadas por {{ orden }}.</td>
                </tr>
                </tfoot>
            </table>
            <modal-app
                    id="modalNewCode"
                    :modal-title="titleModal"
                    modal-header-classes="bg-dark text-light"
                    modal-footer-classes="bg-light"
                    type-btn-save="btn-outline-success"
                    type-btn-close="btn-outline-secondary"
                    txt-btn-save="Generar código"
                    txt-btn-close="Cerrar"
                    :on-modal-hidden="setRentalModalNull"
                    :action-btn-save="sendQueryForNewCode">
                <h4>Esta por generar un nuevo código de reserva.</h4>
                <hr>
                <p class="text-danger">¿Está seguro de querer cambiarlo?</p>
                <p>Si es así presione el botón <b>generar código</b> de lo contrario presione <b>cerrar</b>.</p>
            </modal-app>
        </div>
    </div>
</template>

<script>
    import VueNoti from 'vue-notifications'
    import { mapActions, mapState } from 'vuex'
    import Modal from '../../vue-commons/components/Modal'

    export default {
        name: 'profile-rentals',
        components: {
            'modal-app': Modal
        },
        data() {
            return {
                orden: 'fecha',
                rentalModal: null
            }
        },
        computed: {
            titleModal() {
              if (this.rentalModal) {
                  return 'Actualizar código de reserva ' + this.rentalModal.dateFrom.format('DD/MM/YYYY')
              }
              return 'Actualizar código de reserva';
            },
            ...mapState('auth', {
                token: state => state.xhr.token
            }),
            ...mapState('profile_rentals', {
                rentals: state => state.data.rentals
            })
        },
        methods: {
            isCurrent(dateFrom, dateTo) {
                return moment().isBetween(dateFrom, dateTo, null, '[]')
            },
            setRentalModalNull() {
                this.rentalModal = null;
            },
            sendQueryForNewCode() {
                if (this.rentalModal) {
                    this.updateRentalCode({id: this.rentalModal.id})
                        .then(response => {
                            VueNoti.success(response);
                        })
                        .catch(error => {
                            VueNoti.error(error);
                        });
                }

                window.jQuery('#modalNewCode').modal('hide');
            },
            ...mapActions('auth', ['fireSetTokenMutation']),
            ...mapActions('profile_rentals', ['getMyRentals', 'updateRentalCode'])
        },
        filters: {},
        created() {
        },
        mounted() {
            if (this.$cookies.isKey('info_one')) {
                this.fireSetTokenMutation(this.$cookies.get('info_one'));
                this.getMyRentals(this.$cookies.get('info_one'))
                    .then(response => VueNoti.success(response))
                    .catch(error => VueNoti.error(error));
            }
        }
    }
</script>

<style scoped>

</style>