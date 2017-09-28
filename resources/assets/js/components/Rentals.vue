<template>
    <div id="reservas-component" class="container jumbotron">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h1 class="text-center">Reservas</h1>
                <div class="alert alert-info text-center">
                    Esta consultando por: <b>{{ stateButton ? 'Cabaña' : 'Capacidad' }}</b>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-offset-1 col-md-7 col-lg-offset-1 col-lg-7 text-right">
                <h4 id="text-onOff" class="text-info">Para consultar la disponibilidad por cabaña utilice este boton <i class="fa fa-hand-o-right" aria-hidden="true"></i></h4>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1">
                <h1>
                    <a id="link-onOff" :class="{'text-muted': !stateButton, 'text-primary': stateButton}" role="button" @click="toggleButton">
                        <icon-app iconId="iconImage" :iconImage="stateButton ? 'toggle-on' : 'toggle-off'"></icon-app>
                    </a>
                </h1>
            </div>
        </div>
        <div class="row">
            <app-form></app-form>
        </div>
    </div>
</template>

<script>
    import Icon from './Icon.vue'
    import Form from './Form.vue'

    export default {
        components: {
            'icon-app': Icon,
            'app-form': Form
        },
        data() {
          return {
            stateButton: false
          }
        },
        computed: {
            prueba() {
                return this.$store.state.rentals;
            }
        },
        methods: {
            toggleButton() {
              this.$store.commit('toggleIsForCottage', !this.$store.state.isForCottage);
              this.stateButton = this.$store.state.isForCottage;
              EventBus.$emit('choice-change');
            }
        }
    }
</script>

<style>
    #reservas-component {
        margin-top: 30px;
    }
    #text-onOff {
        margin-top: 35px;
    }
    a#link-onOff {
        font-size: inherit;
        font-weight: inherit;
    }
    i#iconImage {
        position: relative;
        top: -25px;
    }
</style>
