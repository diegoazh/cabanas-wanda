<template>
    <div class="row">
        <div class="col-12 col-md-12">
            <h3 class="text-center">Primero necesitamos saber a que reserva pertenecerá</h3>
        </div>
        <div class="col-12 col-md-8 offset-md-2">
            <div class="text-center">
                <p id="p-for-code" class="text-center"><span :class="{'text-deleted': forCode, 'text-muted': forCode, 'text-primary': !forCode}">DNI + email</span> <a @click="toggleIcon" role="button"><icon-app iconId="on-off-code" :iconImage="toggleIconCode" aditionalClasses="text-muted"></icon-app></a> <span :class="{'text-deleted': !forCode, 'text-muted': !forCode, 'text-primary': forCode}">Código de reserva</span></p> <!-- TODO(Diego) Cambiar esto a btnSwitch. -->
            </div>
            <form @submit.prevent="sendFindParameters" class="form-inline">
                <fieldset>
                    <legend>{{ forCode ? 'Código de reserva' : 'DNI + email' }}</legend>
                    <div class="form-group form-row">
                        <label :for="forCode ? 'codigo-reserva' : 'dni-reseva'" class="col-form-label sr-only">Código de reserva</label>
                        <div class="input-group mr-2" v-if="forCode">
                            <div class="input-group-prepend"><div class="input-group-text"><icon-app :iconImage="forCode ? 'barcode' : 'hashtag'"></icon-app></div></div>
                            <input type="text" class="form-control" id="codigo-reserva" v-model="reserva">
                        </div>
                        <label :for="forCode ? 'codigo-reserva' : 'dni-reseva'" class="col-form-label sr-only">Código de reserva</label>
                        <div class="input-group mr-2" v-if="!forCode">
                            <div class="input-group-prepend"><div class="input-group-text"><icon-app :iconImage="forCode ? 'barcode' : 'hashtag'"></icon-app></div></div>
                            <input type="number" class="form-control" id="dni-reseva" v-model="dni">
                        </div>
                        <label for="emal-reserva" class="col-form-label sr-only">Email</label>
                        <div class="input-group mr-2" v-if="!forCode">
                            <div class="input-group-prepend"><div class="input-group-text"><icon-app iconImage="at"></icon-app></div></div>
                            <input type="email" class="form-control" id="emal-reserva" v-model="email">
                        </div>
                        <button class="btn btn-outline-primary pull-right"><icon-app :iconImage="toggleBtnIcon" :aditionalClasses="toggleBtnClasses"></icon-app> Buscar</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</template>

<script>
    import VueNoti from 'vue-notifications'
    import Icon from '../../vue-commons/components/Icon.vue'
    import { mapActions, mapState } from 'vuex';

    export default {
        data() {
            return {
                forCode: true,
                reserva: '',
                dni: '',
                email: ''
            }
        },
        components: {
            'icon-app': Icon
        },
        computed: {
            toggleIconCode() {
                return this.forCode ? 'toggle-on' : 'toggle-off';
            },
            toggleBtnIcon() {
                return this.queryFinished ? 'search' : 'spinner';
            },
            toggleBtnClasses() {
                return this.queryFinished ? '' : 'fa-pulse fa-fw';
            },
            ...mapState('auth', {
                queryFinished: state => state.xhr.queryFinished
            })
        },
        methods: {
            toggleIcon() {
                this.forCode = !this.forCode;
            },
            sendFindParameters() {
                this.setQueryFinished(false);
                this.findReserva({
                    reserva: this.reserva,
                    dni: this.dni,
                    email: this.email
                }).then(response => {
                    this.setQueryFinished(true);
                    VueNoti.success(response);
                    this.reserva = '';
                    this.dni = '';
                    this.email = '';
                }).catch(error => {
                    this.setQueryFinished(true);
                    VueNoti.error({
                        title: error.title,
                        message : error.message,
                        useSwal: true
                    });
                })
            },
            ...mapActions('orders', ['findReserva']),
            ...mapActions('auth', ['setQueryFinished']),
        }
    }
</script>

<style>
    #on-off-code {
        font-size: 250%;
        cursor: pointer;
        position: relative;
        top: 7px;
    }
    .text-deleted {
        text-decoration: line-through;
        font-size: inherit;
    }
    #p-for-code span {
        font-size: inherit;
    }
</style>
