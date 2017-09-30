<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex'

    export default {
        created() {

        },
        cumputed: {
            ...mapState({
                isAdmin: state => state.data.isLogged
            })
        }
    }
</script>

<style></style>