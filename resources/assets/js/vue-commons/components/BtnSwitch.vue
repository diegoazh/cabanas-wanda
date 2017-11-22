<template>
    <div class="text-center">
        <h2>
            <span role="button" :class="applyLeftSide" @click="toggleLeft">{{ textLeft }}</span>&nbsp;
            <span @click="toggleSide">
                <icon-app role="button" :iconImage="applyBtnType" :aditionalClasses="aditionalClassesForBtn"></icon-app>&nbsp;
            </span>
            <span role="button" :class="applyRightSide" @click="toggleRight">{{ textRight }}</span>
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
                required: true,
                validator: value => typeof value === 'boolean'
            },
            textLeft: {
                type: String,
                default: 'Text-left',
                required: true,
                validator: value => value !== undefined && typeof value === 'string'
            },
            textRight: {
                type: String,
                default: 'Text-right',
                required: true,
                validator: value => value !== undefined && typeof value === 'string'
            },
            classOnActive: {
                type: String,
                default: 'text-primary',
                required: false,
                validator: value => value !== undefined && typeof value === 'string'
            },
            classOnInactive: {
                type: String,
                default: 'text-muted',
                required: false,
                validator: value => value !== undefined && typeof value === 'string'
            },
            textDeleted: {
                type: Boolean,
                default: true,
                required: false,
                validator: value => typeof value === 'boolean'
            },
            aditionalClassesForBtn: {
                type: String,
                default: 'text-muted',
                required: false,
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

<style>
    .text-deleted {
        text-decoration: line-through;
    }
</style>