<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <h3 class="text-center">Primero necesitamos saber a que reserva pertenecerá</h3>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
            <div class="text-center">
                <p id="p-for-code"><span :class="{'text-deleted': forCode, 'text-muted': forCode, 'text-primary': !forCode}">DNI + email</span> <a @click="toggleIcon" role="button"><icon-app iconId="on-off-code" :iconImage="toggleIconCode" aditionalClasses="text-muted"></icon-app></a> <span :class="{'text-deleted': !forCode, 'text-muted': !forCode, 'text-primary': forCode}">Código de reserva</span></p>
            </div>
            <form @submit.prevent="sendFindParameters" class="form-inline">
                <fieldset>
                    <legend>{{ forCode ? 'Código de reserva' : 'DNI + email' }}</legend>
                    <div class="form-group">
                        <label :for="forCode ? 'codigo-reserva' : 'dni-reseva'" class="sr-only">Código de reserva</label>
                        <div class="input-group">
                            <div class="input-group-addon"><icon-app :iconImage="forCode ? 'barcode' : 'hashtag'"></icon-app></div>
                            <input type="text" class="form-control" id="codigo-reserva" v-model="reserva" v-if="forCode">
                            <input type="number" class="form-control" id="dni-reseva" v-model="dni" v-else>
                        </div>
                    </div>
                    <div class="form-group" v-if="!forCode">
                        <label for="emal-reserva" class="sr-only">Email</label>
                        <div class="input-group">
                            <div class="input-group-addon"><icon-app iconImage="at"></icon-app></div>
                            <input type="email" class="form-control" id="emal-reserva" v-model="email">
                        </div>
                    </div>
                    <button class="btn btn-primary"><icon-app iconImage="search"></icon-app> Buscar</button>
                </fieldset>
            </form>
        </div>
    </div>
</template>

<script>
    import Icon from '../../vue-commons/components/Icon.vue'

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
            }
        },
        methods: {
            toggleIcon() {
                this.forCode = !this.forCode;
            },
            sendFindParameters() {

            }
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