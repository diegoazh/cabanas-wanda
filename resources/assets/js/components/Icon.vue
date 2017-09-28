<template>
    <i :id="dinamycId" :class="toggleIconClass" aria-hidden="true"></i>
</template>

<script>
    export default {
        props: {
            iconImage: {
                type: String,
                default: '',
                required: true
            },
            iconId: {
                type: String,
                default: '',
                required: false
            }
        },
        computed: {
            toggleIconClass() {
                return 'fa fa-' + this.iconImage;
            },
            dinamycId() {
                return this.iconId;
            }
        }
    }
</script>

<style>
</style>