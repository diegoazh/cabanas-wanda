<template>
    <div class="row">
        <div v-if="!hasUser" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
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
                    <div :class="['form-group', {'has-error': !dni}]">
                        <label for="dni" class="sr-only">DNI: </label>
                        <div class="input-group">
                            <div class="input-group-addon">DNI</div>
                            <input type="number" id="dni" class="form-control" name="dni" v-model="dni">
                        </div>
                    </div>
                    <div :class="['form-group', {'has-error': !email}]">
                        <label for="email" class="sr-only">e-mail: </label>
                        <div class="input-group">
                            <div class="input-group-addon"><icon-app iconId="at" iconImage="at"></icon-app></div>
                            <input type="email" id="email" class="form-control" name="email" v-model="user ? user : email">
                        </div>
                    </div>
                    <br>
                    <div class="text-center">
                        <button class="btn btn-primary btn-lg">Buscar información <icon-app iconImage="toggleIconImage" :aditionalClasses="btnClasses"></icon-app></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" v-else>
            <h2 class="text-center">Bienvenido {{user.name + ', ' + user.lastname }}</h2>
            form
        </div>
    </div>
</template>

<script>
    import Icon from './Icon.vue'
    import { mapActions, mapState } from 'vuex'

    export default {
        components: {
            'icon-app': Icon
        },
        mounted() {
            this.findUser();
        },
        data() {
            return {
                dni: 0,
                email: '',
                hasUser: false,
            }
        },
        computed: {
            toggleIconImage() {
                return !this.queryFinished ? 'spinner' : 'search';
            },
            btnClasses() {
                return !this.queryFinished ? 'fa-spin fa-fw' : '';
            },
            ...mapState({
                token: state => state.xhr.token,
                isAdmin: state => state.data.isAdmin,
                user: state => state.data.user,
                queryFinished: state => state.xhr.queryFinished
            })
        },
        methods: {
            verifyUser() {
                if (this.token) {
                    this.hasUser = true;
                }
            },
            findUser(bool = false) {
                this.setQueryFinished(!bool);
                this.authenticateUser({
                    isAdmin: this.isAdmin,
                    dni: this.dni,
                    email: this.user
                })
                    .then(() => this.verifyUser());
            },
            ...mapActions(['authenticateUser', 'setQueryFinished'])
        }
    }
</script>

<style></style>