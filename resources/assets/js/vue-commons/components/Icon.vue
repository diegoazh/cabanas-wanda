<template>
    <i :id="dinamycId" :class="toggleIconClass" aria-hidden="true"></i>
</template>

<script>
    export default {
        name: 'icon-app',
        props: {
            typeIcon: {
              type: String,
              default: 's',
            },
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
                let classes = (this.typeIcon === 'l' ? 'fal' : (this.typeIcon === 'r' ? 'far' : 'fas')) + ' fa-' + this.iconImage;
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