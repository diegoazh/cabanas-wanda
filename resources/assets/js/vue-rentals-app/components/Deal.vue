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
                {{ isAdmin }} | {{ cottages }}
            </h2>
            <div class="text-center">
                <form action="" class="form-inline">
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
                            <input type="email" id="email" class="form-control" name="email" v-model="email">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex'
    import Icon from './Icon.vue'

    export default {
        components: {
            'icon-app': Icon
        },
        data() {
            return {
                dni: 0,
                email: '',
                hasUser: false,
            }
        },
        mounted() {
            this.authenticateUser({
                isAdmin: this.isAdmin,
                dni: this.dni,
                email: this.email
            });
            this.verifyUser();
        },
        updated() {
            console.log(this.isAdmin);
        },
        cumputed: {
            ...mapState({
                cottages: state => state.data.cottages,
                token: state => state.xhr.token,
                isAdmin: state => state.data.isAdmin
            })
        },
        methods: {
            verifyUser() {
                if (this.token) {
                    this.hasUser = true;
                }
            },
            ...mapActions(['authenticateUser'])
        }
    }
</script>

<style></style>