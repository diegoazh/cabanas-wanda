<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <button @click="goBackToReservas" v-if="!dataForm" class="btn btn-link pull-right"><icon-app iconImage="arrow-left"></icon-app> Volver a reservas <icon-app iconImage="handshake-o"></icon-app></button>
            <button @click="goBackToFindUser" v-if="dataForm" class="btn btn-link pull-right"><icon-app iconImage="arrow-left"></icon-app> Volver a buscar usuario <icon-app iconImage="search"></icon-app></button>
        </div>
        <div v-if="!dataForm" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h2 class="text-center">
                Por favor ingrese sus sus datos
                <br>
                <small>
                    Si ya fué nuestro huesped o es un usuario del sitio
                    <br>
                    completaremos automáticamente sus datos
                </small>
            </h2>
            <div class="text-center">
                <form @submit.prevent="findUser(true)" class="form-inline">
                    <h3 id="tt-find-btn-document" @click="onOffImg" role="button" class="text-center"><span :class="{'text-mutted': onOff, 'text-deleted': onOff, 'text-primary': !onOff}">DNI</span> <icon-app :iconImage="onOffBtn" :aditionalClasses="changeToogle"></icon-app> <span :class="{'text-mutted': !onOff, 'text-deleted': !onOff, 'text-primary': onOff}">Pasaporte</span></h3>
                    <div :class="['form-group', {'has-error': !document}]">
                        <label for="find-document" class="sr-only">{{ !onOff ? 'DNI' : 'Pasaporte' }}:</label>
                        <div class="input-group">
                            <div class="input-group-addon">{{ !onOff ? 'DNI' : 'Pasaporte' }}</div>
                            <input type="number" id="find-document" class="form-control" name="document" v-model="document">
                        </div>
                    </div>
                    <div :class="['form-group', {'has-error': !email}]">
                        <label for="mail" class="sr-only">e-mail: </label>
                        <div class="input-group">
                            <div class="input-group-addon"><icon-app iconId="at" iconImage="at"></icon-app></div>
                            <input type="email" id="mail" class="form-control" name="mail" v-model="email">
                        </div>
                    </div>
                    <br><br>
                    <div class="text-center">
                        <button class="btn btn-primary btn-lg">Buscar información <icon-app :iconImage="toggleIconImage" :aditionalClasses="btnClasses"></icon-app></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-offset-3 col-md-6 col-lg-offset-3 col-lg-6" v-else>
            <h2 v-if="!userNotFound" class="text-center">La reserva se hará a nombre de:</h2>
            <div class="alert alert-info text-center" v-else>
                <p>
                    <icon-app iconImage="info-circle"></icon-app>
                    Le pedimos disculpas, no hemos podido encontrar su información.<br>
                    Por favor complete el siguente formulario.
                </p>
            </div>
            <form @submit.prevent="closeDeal">
                <div :class="['form-group', {'has-error': !name}]">
                    <label for="name" class="sr-only">Nombres: </label>
                    <div class="input-group">
                        <div class="input-group-addon">Nombres</div>
                        <input type="text" id="name" class="form-control" name="name" v-model="name">
                    </div>
                </div>
                <div :class="['form-group', {'has-error': !lastname}]">
                    <label for="lastname" class="sr-only">Apellidos: </label>
                    <div class="input-group">
                        <div class="input-group-addon">Apellidos</div>
                        <input type="text" id="lastname" class="form-control" name="lastname" v-model="lastname">
                    </div>
                </div>
                <div :class="['form-group', {'has-error': !email}]">
                    <label for="email" class="sr-only">e-mail: </label>
                    <div class="input-group">
                        <div class="input-group-addon">e-mail</div>
                        <input type="email" id="email" class="form-control" name="email" v-model="email">
                    </div>
                </div>
                <div :class="['form-group', {'has-error': !document}]">
                    <label for="document" class="sr-only">{{ !onOff ? 'DNI' : 'Pasaporte' }}:</label>
                    <h3 id="tt-btn-document" @click="onOffImg" role="button" class="text-center"><span :class="{'text-mutted': onOff, 'text-deleted': onOff, 'text-primary': !onOff}">DNI</span> <icon-app :iconImage="onOffBtn" :aditionalClasses="changeToogle"></icon-app> <span :class="{'text-mutted': !onOff, 'text-deleted': !onOff, 'text-primary': onOff}">Pasaporte</span></h3>
                    <div class="input-group">
                        <div class="input-group-addon">{{ !onOff ? 'DNI' : 'Pasaporte' }}</div>
                        <input type="number" id="document" class="form-control" name="document" v-model="document">
                    </div>
                </div>
                <div :class="['form-group', {'has-error': !genre}]">
                    <label for="genero" class="sr-only">Genero: </label>
                    <div class="input-group">
                        <div class="input-group-addon">Genero</div>
                        <select id="genero" class="form-control" name="genero" v-model="genre" placeholder="Elija su genero por favor...">
                            <option value="m">Masculino</option>
                            <option value="f">Femenino</option>
                            <option value="o">Otro</option>
                        </select>
                    </div>
                </div>
                <div :class="['form-group', {'has-error': !country}]">
                    <label for="country" class="sr-only">País: </label>
                    <div class="input-group">
                        <div class="input-group-addon">País</div>
                        <select id="country" class="form-control" name="country" v-model="country" placeholder="Elija su país por favor...">
                            <option v-for="pais in countries" :value="pais.id">{{ pais.country }}</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="text-center">
                    <button class="btn btn-success btn-lg">
                        Finalizar reserva <icon-app :iconImage="toggleIconImage" :aditionalClasses="btnClasses"></icon-app>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import VueNoti from 'vue-notifications'
    import Icon from './Icon.vue'
    import { mapActions, mapState } from 'vuex'

    export default {
        components: {
            'icon-app': Icon
        },
        mounted() {
            this.email = this.user.email || this.user;
            this.findUser();
        },
        data() {
            return {
                onOff: false,
                name: '',
                lastname: '',
                email: '',
                document: 0,
                genre: '',
                country: '',
                dataForm: false,
                userNotFound: false
            }
        },
        computed: {
            toggleIconImage() {
                return !this.queryFinished ? 'spinner' : 'search';
            },
            toggleIconFinReserva() {
                return !this.queryFinished ? 'spinner' : 'thumbs-o-up';
            },
            onOffBtn() {
                return this.onOff ? 'toggle-on' : 'toggle-off';
            },
            btnClasses() {
                return !this.queryFinished ? 'fa-spin fa-fw' : '';
            },
            changeToogle() {
                return this.onOff ? 'text-primary' : 'text-muted';
            },
            ...mapState({
                token: state => state.xhr.token,
                isAdmin: state => state.data.isAdmin,
                user: state => state.data.user,
                queryFinished: state => state.xhr.queryFinished,
                countries: state => state.data.countries,
                toRentals: state => state.data.toRentals,
                isForCottage: state => state.frmCmp.isForCottage,
                dateFrom: state => state.lastQueryData.dateFrom,
                dateTo: state => state.lastQueryData.dateTo,
            })
        },
        methods: {
            verifyUser() {
                if (this.token) {
                    this.name = this.user.name;
                    this.lastname = this.user.lastname;
                    this.email = this.user.email;
                    this.document = this.user.dni ? this.user.dni : this.user.passport;
                    this.genre = this.user.genre;
                    this.country = this.user.country_id;
                    this.dataForm = true;
                }
            },
            onOffImg() {
                this.onOff = !this.onOff;
                this.document = this.onOff ? (this.user ? this.user.passport : null) : (this.user ? this.user.dni : null);
                window.document.querySelector('#find-document, #find-document').getAttribute('type') === 'number' ? window.document.querySelector('#find-document, #find-document').setAttribute('type', 'text') : window.document.querySelector('#find-document, #find-document').setAttribute('type', 'number');
            },
            findUser(bool = false) {
                this.setQueryFinished(!bool);
                this.authenticateUser({
                    isAdmin: this.isAdmin,
                    dni: this.document,
                    email: this.email
                }).then((response) => {
                        this.verifyUser();
                        this.setQueryFinished(true);
                        response.type === 'success' ? VueNoti.success(response) : VueNoti.warn(response);
                        if (bool) {
                            this.dataForm = true;
                            this.userNotFound = true;
                        }
                    }).catch(error => {
                        VueNoti.warn({
                            title: 'LO SENTIMOS',
                            message: 'No hemos encontrado sus datos, por favor complete el siguiente formulario.',
                            useSwal: true
                        });
                });
            },
            closeDeal() {
                const deal = {};
                deal.name = this.name;
                deal. lastname = this.lastname;
                deal.email = this.email;
                deal.document = this.document;
                deal.genre = this.genre;
                deal.country = this.country;
                deal.toRentals = this.toRentals;
                deal.user = this.user;
                deal.isDni = !this.onOff;
                deal.dateFrom = this.dateFrom;
                deal.dateTo = this.dateTo;

                this.setQueryFinished(false);

                this.sendClosedDeal(deal)
                    .then(response => {
                        VueNoti.success(response);
                        this.setQueryFinished(true);
                    })
                    .catch(error => {
                        VueNoti.error(error);
                        this.setQueryFinished(true);
                    });
            },
            goBackToReservas() {
                this.setDeal(false);
            },
            goBackToFindUser() {
                this.dataForm = false;
                this.userNotFound = false;
            },
            ...mapActions(['authenticateUser', 'setQueryFinished', 'sendClosedDeal', 'setDeal'])
        }
    }
</script>

<style>
    .text-deleted {
        text-decoration: line-through;
    }
</style>