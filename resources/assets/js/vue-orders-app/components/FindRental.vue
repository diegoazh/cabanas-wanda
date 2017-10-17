<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <h3 class="text-center">Primero necesitamos saber a que reserva pertenecerá</h3>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
            <div class="text-center">
                <p id="p-for-code"><span :class="{'text-deleted': this.forCode, 'text-muted': this.forCode, 'text-primary': !this.forCode}">DNI + email</span> <a @click="toggleIcon" role="button"><icon-app iconId="on-off-code" :iconImage="toggleIconCode" aditionalClasses="text-muted"></icon-app></a> <span :class="{'text-deleted': !this.forCode, 'text-muted': !this.forCode, 'text-primary': this.forCode}">Código de reserva</span></p>
            </div>
            <form class="form-inline">
                <fieldset>
                    <legend>Código de reserva</legend>
                    <div class="form-group">
                        <label for="code-reserva" class="sr-only">Código de reserva</label>
                        <div class="input-group">
                            <div class="input-group-addon"><icon-app iconImage="barcode"></icon-app></div>
                            <input type="text" class="form-control" id="code-reserva">
                        </div>
                        <button class="btn btn-primary"><icon-app iconImage="search"></icon-app>Buscar</button>
                    </div>
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
                forCode: true
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