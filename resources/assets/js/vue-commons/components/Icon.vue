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
            },
            aditionalClasses: {
                type: String,
                default: '',
                required: false
            }
        },
        computed: {
            toggleIconClass() {
                let classes = 'fa fa-' + this.iconImage;
                if (this.aditionalClasses) {
                    classes += ' ' + this.aditionalClasses;
                }
                return classes;
            },
            dinamycId() {
                return this.iconId;
            }
        }
    }
</script>

<style>
</style>