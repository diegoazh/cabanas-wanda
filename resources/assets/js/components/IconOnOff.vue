<template>
    <i id="buttonOnOff" :class="toggleOnOffClass" aria-hidden="true"></i>
</template>

<script>
    export default {
        props: ['icon'],
        computed: {
            toggleOnOffClass() {
                return 'fa fa-toggle-' + this.icon;
            }
        }
    }
</script>

<style>
    i#buttonOnOff {
        position: relative;
        top: -25px;
    }
</style>