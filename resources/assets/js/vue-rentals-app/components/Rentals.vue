<template>
    <div v-if="!deal" id="reservas-component" class="container jumbotron">
        <div class="row">
            <div class="col-12 col-md-12">
                <h1 class="text-center bg-dark text-light rounded p-2">Reservas</h1>
            </div>
        </div>
        <div class="row justify-content-center">
            <form-app></form-app>
        </div>
        <div class="row">
            <list-group-app></list-group-app>
        </div>
    </div>
    <div id="reservas-component2" class="container jumbotron" v-else>
        <div class="row">
            <div class="col-12 col-md-12">
                <h1 class="text-center bg-dark text-light rounded p-2">Reservas</h1>
            </div>
        </div>
        <deal-app v-if="!closedDeal"></deal-app>
        <closed-deal-app v-else></closed-deal-app>
    </div>
</template>

<script>
    import { createNamespacedHelpers } from 'vuex'
    import Vue from 'vue'
    import VueNotifications from 'vue-notifications'
    import { optionsIzi } from '../../vue-commons/notifications/notifications'
    import Icon from '../../vue-commons/components/Icon.vue'
    import Form from './Form.vue'
    import List from './List-group.vue'
    import Deal from './Deal.vue'
    import CloseDeal from './ClosedDeal.vue'

    Vue.use(VueNotifications, optionsIzi);

    const { mapActions, mapState } = createNamespacedHelpers('rentals');


    export default {
        components: {
            'icon-app': Icon,
            'form-app': Form,
            'list-group-app': List,
            'deal-app': Deal,
            'closed-deal-app': CloseDeal
        },
        data() {
          return {
            stateButton: false
          }
        },
        computed: {
            ...mapState({
                isForCottage: state => state.frmCmp.isForCottage,
                deal: state => state.data.deal,
                closedDeal: state => state.data.closedDeal
            })
        },
        methods: {
            toggleButton() {
              this.setIsForCottage(!this.isForCottage);
              this.stateButton = this.isForCottage;
              EventBus.$emit('choice-change');
            },
            ...mapActions(['setIsForCottage'])
        }
    }
</script>

<style>
    #reservas-component,
    #reservas-component2 {
        margin-top: 30px;
        background-color: rgba(238,238,238,0.4);
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
