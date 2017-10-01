<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

        </div>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex'

    export default {
        created() {
            this.getUserData();
        },
        cumputed: {
            ...mapState({
                isAdmin: state => state.data.isLogged
            })
        },
        methods: {
            ...mapActions(['getUserData'])
        }
    }
</script>

<style></style>