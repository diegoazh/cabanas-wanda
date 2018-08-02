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
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(rental, index) in pagination.data" :key="index">
                <td><icon-app iconImage="hashtag"></icon-app> {{ rowNumber(index) }}</td>
                <td><span class="text-to-14px badge badge-secondary">{{ rental.dateFrom | DateArg('YYYY-MM-DD', 'DD/MM/YYYY') }}</span></td>
                <td><span class="text-to-14px badge badge-secondary">{{ rental.dateTo | DateArg('YYYY-MM-DD', 'DD/MM/YYYY') }}</span></td>
                <td><span class="text-to-14px badge badge-primary">{{ rental.total_days }}</span></td>
                <td><span class="text-to-14px badge badge-warning"><icon-app iconImage="dollar"></icon-app>  {{ setSenia(rental.cottage_price) }}</span></td>
                <td><span class="text-to-14px badge badge-danger">{{ rental.dateReservationPayment | DateArg }}</span></td>
                <td>
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <button class="btn btn-info" v-tooltip.left="'Ver reserva: ' + rowNumber(index)" data-toggle="modal" data-target="#b3-modal-id" @click="findRental(rental.id)">
                                <icon-app iconImage="eye"></icon-app>
                            </button>
                        </div>
                    </div>
                </td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="7"></td>
            </tr>
            </tfoot>
        </table>
        <modal-app :modalTitle="modalAppTitle" modalSize="lg" :onModalHidden="clearRental" iconBtnSave="save" :actionBtnSave="saveNewInfo" iconBtnClose="times" modal-header-classes="bg-dark text-light" modal-footer-classes="bg-light" type-btn-close="btn-outline-secondary" type-btn-save="btn-outline-primary">
            <div class="container-fluid" v-if="rental">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <h2 class="text-center">
                            Reserva caba&ntilde;a <span class="text-capitalize badge badge-info">{{ rental.cottage.name }}</span>
                            <br>
                            <small>
                                Desde: <span class="badge badge-secondary">{{ rental.dateFrom | DateArg('YYYY-MM-DD', 'DD/MM/YYYY') }}</span>
                                &nbsp;|&nbsp;
                                Hasta: <span class="badge badge-secondary">{{ rental.dateTo | DateArg('YYYY-MM-DD', 'DD/MM/YYYY') }}</span>
                                <br>
                                <span :class="['text-uppercase', 'badge', setClassState(rental.state)]" v-if="!editState">{{ rental.state }}</span>&nbsp;
                                <sup role="button" class="cursorPointer">
                                    <a class="cursorPointer" role="button" @click.prevent="editState = true; trash.state = rental.state;" v-tooltip.hover="'Editar estado'" v-if="!editState">
                                        <icon-app iconImage="edit"></icon-app>
                                    </a>
                                </sup>
                                <form class="form-inline justify-content-center" v-if="editState">
                                    <div :class="['alert', setClassPenalty(rental.dateFrom)]" role="alert">
                                        <h5 v-html="setMsgPenalty(rental.dateFrom, setSenia(+rental.cottage_price))"></h5>
                                    </div>
                                    <div class="form-group form-row">
                                        <label for="state" class="col-form-label sr-only">Estado: </label>
                                        <div class="input-group mr-2">
                                            <div class="input-group-prepend"><div class="input-group-text">Estado</div></div>
                                            <select name="state" id="state" class="form-control" v-model="trash.state">
                                                <option value="pendiente" :selected="rental.state === 'pendiente'">Pendiente</option>
                                                <option value="confirmada" :selected="rental.state === 'confirmada'">Confirmada</option>
                                                <option value="en_curso" :selected="rental.state === 'en_curso'">En curso</option>
                                                <option value="cancelada" :selected="rental.state === 'cancelada'">Cancelada</option>
                                                <option value="finalizada" :selected="rental.state === 'finalizada'">Finalizada</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-outline-secondary mr-2" @click.prevent="editState = false; trash.state = '';">Cancelar</button>
                                            <button class="btn btn-outline-primary" @click.prevent="saveNewState">Actualizar</button>
                                        </div>
                                    </div>
                                </form>
                            </small>
                        </h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-12">
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Concepto</th>
                                    <th>Detalle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Vto reserva:</th>
                                    <td>
                                        <span class="text-to-14px badge badge-secondary">{{ rental.dateReservationPayment | DateArg }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Cantidad de días:</th>
                                    <td>
                                        <span class="text-to-14px badge badge-secondary">{{ rental.total_days }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ rental.user ? 'Usuario' : 'Pasajero' }}:</th>
                                    <td>
                                        <span class="text-to-14px text-capitatrze badge badge-info">{{ fullName(rental) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Precio al reservar:</th>
                                    <td>
                                        <span class="text-to-14px badge badge-danger"><icon-app iconImage="dollar"></icon-app> {{ rental.cottage_price }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Promoción:</th>
                                    <td>
                                        <span class="text-to-14px badge badge-warning">{{ rental.promotion || 'Sin promoci&oacute;n' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Descuentos:</th>
                                    <td>
                                        <span class="text-to-14px badge badge-primary"><icon-app iconImage="dollar"></icon-app> {{ rental.deductions || 0 }}</span>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-12">
                        <h3 class="text-center">
                            Descripción <sup role="button" class="cursorPointer"><a class="cursorPointer" role="button" @click.prevent="initEditorMd" v-tooltip.hover="'Editar descripción'"><icon-app :iconImage="editDescription ? 'times' : 'edit'"></icon-app></a></sup>
                            <br>
                            <small class="text-muted">Aquí puede agregar cualquier comentario que necesite vincular a está reserva.</small>
                        </h3>
                        <hr>
                        <vue-markdown :source="rental.description || '### Sin descripción'" v-if="!editDescription"></vue-markdown>
                        <div v-else>
                            <div class="form-group">
                                <label for="description" class="sr-only">Descripión:</label>
                                <div id="editormd">
                                    <!-- TODO (Diego): Verificar si funciona correctamente con v-model en lugar de mustache -->
                                    <textarea id="description" name="description" class="form-control">{{ rental.description }}</textarea>
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-outline-secondary" @click.prevent="editDescription = !editDescription"><b> Cancelar <icon-app iconImage="times-o"></icon-app></b></button>
                                <button class="btn btn-outline-primary" @click.prevent="setTextMarkdown"><b> Actualizar <icon-app iconImage="update"></icon-app></b></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </modal-app>
    </div>
</template>

<script>
    import moment from 'moment';
    import VueNoti from 'vue-notifications';
    import VueMarkdown from 'vue-markdown';
    import { mapState, mapActions } from 'vuex';
    import Icon from '../../vue-commons/components/Icon.vue';
    import Modal from '../../vue-commons/components/Modal.vue';

    export default {
        components: {
            VueMarkdown,
            'icon-app': Icon,
            'modal-app': Modal
        },
        data() {
            return {
                rental: null,
                modalAppTitle: '',
                editState: false,
                editDescription: false,
                trash: {
                    state: ''
                }
            }
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
            },
            setClassState(state) {
                let classString = '';

                switch (state) {
                    case 'pendiente': classString = 'badge-warning';
                        break;
                    case 'confirmada': classString = 'badge-info';
                        break;
                    case 'en curso': classString = 'badge-success';
                        break;
                    case 'finalizada': classString = 'badge-secondary';
                        break;
                    case 'cancelada': classString = 'badge-danger';
                        break;
                }

                return classString;
            },
            fullName(rental) {
                return `${rental.user.lastname}, ${rental.user.name}`;
            },
            setSenia(price) {
                return +(30 / 100 * +price).toFixed(2);
            },
            setClassPenalty(dateFrom) {
                if (!dateFrom || typeof dateFrom !== 'string') { console.error('La fecha no debe ser nula y debe ser un string.'); return; }
                let arg = moment(dateFrom, 'YYYY-MM-DD');
                if (arg.diff(moment.now(), 'days') < 2) {
                    return 'alert-danger';
                } else {
                    return 'alert-warning';
                }
            },
            setMsgPenalty(dateFrom, senia) {
                if (!dateFrom || typeof dateFrom !== 'string' || !senia || typeof senia !== 'number') {
                    console.error('La fecha no debe ser nula y debe ser un string y la seña debe ser un entero y no debe ser nulo.');
                    return;
                }
                let arg = moment(dateFrom, 'YYYY-MM-DD');
                if (arg.diff(moment.now(), 'days') < 2) {
                    let penalty = (30 / 100 * senia).toFixed(2);
                    return 'Tenga en cuenta que si cancela la reserva con menos de 48 hs tiene 72 hs para devolver devolver la seña de <b>$ ' + senia + '</b> más el <b>30%</b> de la misma en concepto de penalización (<b>$ ' + penalty + '</b>) es decir <b>$ ' + (+senia + +penalty).toFixed(2) + '</b>';
                } else {
                    return 'Recuerde que si cancela la reserva tiene 72 hs para devolver la seña de <b>$ ' + senia + '</b>';
                }
            },
            clearRental() {
                this.rental = null;
                this.editState = false;
                this.editDescription = false;
                this.modalAppTitle = '';
                this.trash.state = '';
                delete window.appDash;
            },
            saveNewState() {
                this.rental.state = this.trash.state;
                this.editState = !this.editState;
                this.trash.state = '';
            },
            initEditorMd() {
                this.editDescription = !this.editDescription;
                const module = this;
                window.jQuery(window.document).ready(function () {
                    window.appDash = {};
                    if (!module.editDescription) return;
                    window.appDash.editor = editormd({
                        id      : 'editormd',
                        width   : '100%',
                        height  : '400px',
                        path    : '/lib/editor.md/lib/',
                        theme: 'dark',
                        previweTheme: 'default',
                        editorTheme: 'pastel-on-dark',
                        syncScrolling : true,
                        saveHTMLToTextarea : true,
                        /*onchange: function() {
                            module.setTextMarkdown();
                        }*/
                    });
                });
            },
            setTextMarkdown() {
                this.rental.description = window.appDash.editor.getMarkdown();
                this.editDescription = !this.editDescription;
            },
            findRental(id) {
                this.rentalsOrOrdersForId({
                    isRentals: true,
                    id: id
                }).then(rental => {
                    this.rental = rental;
                    this.modalAppTitle = 'Detalles reserva: cabaña ' + this.rental.cottage.name;
                    VueNoti.success({
                        title: 'OK!',
                        message: 'Reserva cargada con éxito',
                        timeout: 3000
                    });
                }).catch(error => {
                    VueNoti.error(error);
                });
            },
            saveNewInfo() {
                this.updateRental({
                    id: this.rental.id,
                    description: this.rental.description,
                    state: this.rental.state,
                    side: true
                }).then(response => {
                    if (/sin cambios/.test(response.message)) {
                        response.title = '¡Sin actualización!';
                        VueNoti.warn(response);
                    } else {
                        VueNoti.success(response);
                    }
                    window.EventBus.$emit('page-change', this.page);
                }).catch(error => {
                    VueNoti.error(error);
                });
                window.jQuery('#b3-modal-id').modal('hide');
            },
            ...mapActions('dash', ['rentalsOrOrdersForId', 'updateRental'])
        },
        filters: {},
        created() {
        },
        mounted() {
        }
    }
</script>

<style>
    .text-to-14px {
        font-size: 14px;
    }
</style>