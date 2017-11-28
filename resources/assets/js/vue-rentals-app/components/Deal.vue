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
                        <button class="btn btn-primary btn-lg" :disabled="documentOrEmail">Buscar información <icon-app :iconImage="toggleIconImage" :aditionalClasses="btnClasses"></icon-app></button>
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
                    <button class="btn btn-success btn-lg" :disabled="btnCreateNewUser">
                        Finalizar reserva <icon-app :iconImage="toggleIconImage" :aditionalClasses="btnClasses"></icon-app>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import { mapActions, mapState, mapMutations } from 'vuex'
    import VueNoti from 'vue-notifications'
    import Icon from '../../vue-commons/components/Icon.vue'

    export default {
        components: {
            'icon-app': Icon
        },
        mounted() {
            this.email = this.user.email || (!this.isAdmin ? this.userLogged : '');
            if (!this.isAdmin) this.findUser();
        },
        data() {
            return {
                onOff: false,
                name: '',
                lastname: '',
                email: '',
                document: null,
                genre: '',
                country: '',
                dataForm: false,
                userNotFound: false,
                createNew: false
            }
        },
        computed: {
            documentOrEmail() {
                return this.isNullOrUndefined(this.document) || this.isNullOrUndefined(this.email);
            },
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
            btnCreateNewUser() {
                 return !(this.name && this.lastname && this.email && this.document && this.genre && this.country);
            },
            ...mapState('rentals', {
                token: state => state.xhr.token,
                isAdmin: state => state.data.isAdmin,
                userLogged: state => state.data.userLogged,
                user: state => state.data.user,
                queryFinished: state => state.xhr.queryFinished,
                countries: state => state.data.countries,
                toRentals: state => state.data.toRentals,
                isForCottage: state => state.frmCmp.isForCottage,
                dateFrom: state => state.lastQueryData.dateFrom,
                dateTo: state => state.lastQueryData.dateTo,
            }),
            ...mapState('auth', {
                token: state => state.xhr.token,
                queryFinished: state => state.xhr.queryFinished,
            })
        },
        methods: {
            verifyUser() {
                if (this.token || this.user) {
                    this.name = this.user.name;
                    this.lastname = this.user.lastname;
                    this.email = this.user.email;
                    this.document = this.user.dni ? this.user.dni : this.user.passport;
                    this.genre = this.user.genre;
                    this.country = this.user.country_id;
                    this.dataForm = true;
                } else {
                    this.name = '';
                    this.lastname = '';
                    this.genre = '';
                    this.country = '';
                    this.userNotFound = true;
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
                    userLogged: this.userLogged,
                    document: this.document,
                    email: this.email
                }).then((response) => {
                        this.verifyUser();
                        this.setQueryFinished(true);
                        if (response.type === 'success') {
                            VueNoti.success(response);
                            this.createNew = false;
                        } else {
                            VueNoti.warn(response);
                            this.createNew = true;
                        }
                        if (bool) {
                            this.dataForm = true;
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
                const deal = {
                    name: this.name,
                    lastname: this.lastname,
                    email: this.email,
                    dni: this.onOff ? null : this.document,
                    passport: this.onOff ? this.document : null,
                    genre: this.genre,
                    country: this.country,
                    toRentals: this.toRentals,
                    user: this.user,
                    dateFrom: this.dateFrom,
                    dateTo: this.dateTo,
                    createNew: this.createNew,
                };

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
                this.setToken('');
                this.setUserData({});
                this.dataForm = false;
                this.userNotFound = false;
            },
            isNullOrUndefined(val) {
                return typeof val === 'undefined' || val === null;
            },
            ...mapActions('rentals', ['authenticateUser', 'sendClosedDeal', 'setDeal', 'setUserData']),
            ...mapActions('auth', ['setQueryFinished']),
            ...mapMutations('auth', ['setToken'])
        }
    }
</script>

<style>
    .text-deleted {
        text-decoration: line-through;
    }
</style>