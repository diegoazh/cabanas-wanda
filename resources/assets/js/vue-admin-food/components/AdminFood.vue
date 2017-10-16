<template>
    <div class="container-fluid panel panel-body">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <h1 class="text-center">Administración de platos</h1>
                <div class="text-center">
                    <ul class="nav nav-tabs">
                        <li role="presentation" :class="{'active': !create}"><a @click="toogleCreate" role="button">Lista de platos</a></li>
                        <li role="presentation" :class="{'active': create}"><a @click="toogleCreate" role="button">Crear platos</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <food-list-app v-if="!create"></food-list-app>
        <food-create-app v-else></food-create-app>
    </div>
</template>

<script>
    import VueNoti from 'vue-notifications'
    import { createNamespacedHelpers } from 'vuex'
    import Icon from '../../vue-commons/components/Icon.vue'
    import FoodCreate from './FoodCreate.vue'
    import FoodList from './FoodList.vue'

    const { mapActions, mapState } = createNamespacedHelpers('food');

    export default {
        components: {
            'icon-app': Icon,
            'food-list-app': FoodList,
            'food-create-app': FoodCreate
        },
        mounted() {
            this.defineXhrToken();
            this.getFoodFromBackend();
        },
        computed: {
            ...mapState({
                create: state => state.data.create,
            })
        },
        methods: {
            defineXhrToken() {
                window.verifyToken = setTimeout(() => {
                    if (window.adminInfo) {
                        this.setXhrToken(window.adminInfo.token);
                        delete window.adminInfo;
                    }
                }, 1000);
            },
            getFoodFromBackend() {
                this.getAllFood()
                    .then(response => {})
                    .catch(error => {
                        VueNoti.error({
                            title: error.title,
                            message: error.message,
                            useSwal: false
                        });
                    });
            },
            toogleCreate() {
                this.setCreate(!this.create);
            },
            ...mapActions(['setXhrToken', 'getAllFood', 'setCreate'])
        }
    }
</script>

<style></style>