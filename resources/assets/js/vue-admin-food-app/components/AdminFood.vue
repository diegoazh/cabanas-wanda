<template>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-dark text-light">
                <h1 class="text-center">Administración de platos</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <transition-group name="quantity-animation"
                            enter-active-class="animated bounceIn"
                            leave-active-class="animated bounceOut">
                            <div class="form-group float-left" v-if="!create" key="quantity">
                                <label class="col-form-label" for="perPage" role="button">Por página</label>
                                <input id="perPage" type="number" class="form-control-sm" v-model="userItemsPerPage" @change="refreshItemsPerPage">
                                <small class="text-muted">Presiona <kbd>Enter ↵</kbd></small>
                            </div>
                            <div class="form-group float-right" v-if="!create" key="search">
                                <label class="col-form-label" for="search" role="button">Buscar</label>
                                <input id="search" type="text" class="form-control-sm" v-model="userSearch" @change="refreshSearch">
                                <small class="text-muted">Presiona <kbd>Enter ↵</kbd></small>
                            </div>
                        </transition-group>
                    </div>
                    <div class="col-12 col-md-12">
                        <div class="text-center">
                            <ul class="nav nav-tabs">
                                <li role="presentation" class="nav-item"><a href="#" @click="toogleCreate" role="button" :class="['nav-link', {'active': !create}]">Lista de platos</a></li>
                                <li role="presentation" class="nav-item"><a href="#" @click="toogleCreate" role="button" :class="['nav-link', {'active': create}]">Crear platos</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <food-list-app v-if="!create"></food-list-app>
                <food-create-app v-else></food-create-app>
            </div>
        </div>
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
        data() {
            return {
                userItemsPerPage: 15,
                userSearch: '',
            }
        },
        components: {
            'icon-app': Icon,
            'food-list-app': FoodList,
            'food-create-app': FoodCreate
        },
        mounted() {
            this.defineXhrToken();
        },
        computed: {
            ...mapState({
                create: state => state.data.create,
                page: state => state.page
            })
        },
        methods: {
            defineXhrToken() {
                if (this.$cookies.isKey('info_one')) {
                    this.setXhrToken(this.$cookies.get('info_one'));
                }
            },
            toogleCreate() {
                this.setCreate(!this.create);
            },
            refreshItemsPerPage() {
                this.pagination(1)
                    .then(response => {
                        let bool = true;
                        while (bool) {
                            if (this.page === 1) {
                                this.setItemsPerPage(+this.userItemsPerPage);
                                bool = false;
                            }
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            refreshSearch() {
                this.pagination(1)
                    .then(response => {
                        let bool = true;
                        while (bool) {
                            if (this.page === 1) {
                                this.setSearch(this.userSearch);
                                bool = false;
                            }
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            ...mapActions(['setXhrToken', 'setCreate', 'setItemsPerPage', 'setSearch', 'pagination'])
        }
    }
</script>

<style></style>