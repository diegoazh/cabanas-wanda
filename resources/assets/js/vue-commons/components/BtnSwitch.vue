<template>
    <div class="text-center">
        <h2>
            <span role="button" :class="['cursorPointer', classTxtLeft ,applyLeftSide]" @click="toggleLeft">
                <icon-app :typeIcon="typeIconLeft" :iconImage="iconTextLeft" v-if="iconTextLeft"></icon-app> {{ textLeft }}
            </span>&nbsp;
            <span @click="toggleSide" class="cursorPointer">
                <icon-app role="button" :iconImage="applyBtnType" :aditionalClasses="aditionalClassesForBtn"></icon-app>&nbsp;
            </span>
            <span role="button" :class="['cursorPointer', classTxtRight, applyRightSide]" @click="toggleRight">
                {{ textRight }} <icon-app :typeIcon="typeIconRight" :iconImage="iconTextRight" v-if="iconTextRight"></icon-app>
            </span>
        </h2>
    </div>
</template>

<script>
    import Icon from './Icon.vue';

    export default {
        components: {
            'icon-app': Icon
        },
        data() {
            return {
                left: this.initLeft
            }
        },
        props: {
            initLeft: {
                type: Boolean,
                default: true,
                validator: value => typeof value === 'boolean'
            },
            textLeft: {
                type: String,
                default: '',
                required: true,
                validator: value => value !== undefined && typeof value === 'string'
            },
            typeIconLeft: {
                type: String,
                default: 's'
            },
            iconTextLeft: {
                type: String,
                default : '',
                validator: value => value !== undefined && typeof value === 'string'
            },
            textRight: {
                type: String,
                default: '',
                required: true,
                validator: value => value !== undefined && typeof value === 'string'
            },
            typeIconRight: {
                type: String,
                default: 's'
            },
            iconTextRight: {
                type: String,
                default : '',
                validator: value => value !== undefined && typeof value === 'string'
            },
            classOnActive: {
                type: String,
                default: 'text-primary',
                validator: value => value !== undefined && typeof value === 'string'
            },
            classOnInactive: {
                type: String,
                default: 'text-muted',
                validator: value => value !== undefined && typeof value === 'string'
            },
            textDeleted: {
                type: Boolean,
                default: true,
                validator: value => typeof value === 'boolean'
            },
            aditionalClassesForBtn: {
                type: String,
                default: 'text-muted',
                validator: value => value !== undefined && typeof value === 'string'
            },
            classTxtLeft: {
                type: String,
                default: '',
                validator: value => value !== undefined && typeof value === 'string'
            },
            classTxtRight: {
                type: String,
                default: '',
                validator: value => value !== undefined && typeof value === 'string'
            }
        },
        computed: {
            applyBtnType() {
                return this.left ? 'toggle-off' : 'toggle-on';
            },
            applyLeftSide() {
                return this.left ? this.classOnActive : (this.textDeleted ? this.classOnInactive + ' text-deleted' : this.classOnInactive);
            },
            applyRightSide() {
                return this.left ? (this.textDeleted ? this.classOnInactive + ' text-deleted' : this.classOnInactive) : this.classOnActive;
            }
        },
        methods: {
            toggleSide() {
                this.left = !this.left;
                window.EventBus.$emit('change-side', this.left);
            },
            toggleLeft() {
                this.left = true;
                window.EventBus.$emit('change-side', this.left);
            },
            toggleRight() {
                this.left = false;
                window.EventBus.$emit('change-side', this.left);
            }
        },
        filters: {},
        created() {
        },
        mounted() {
        }
    }
</script>

<style scoped>
    .text-deleted {
        text-decoration: line-through;
    }

    .cursorPointer {
        cursor: pointer;
    }
</style>