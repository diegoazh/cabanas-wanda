<template>
    <div class="modal fade" :id="modalId" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div :class="['modal-dialog', {'modal-lg': modalSize === 'lg', 'modal-sm': modalSize === 'sm'}]" role="document">
            <div class="modal-content">
                <div :class="['modal-header', modalHeaderClasses]">
                    <slot name="b3-modal-header">
                        <h4 class="modal-title" id="myModalLabel">{{ modalTitle }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </slot>
                </div>
                <div class="modal-body">
                    <slot></slot>
                </div>
                <div :class="['modal-footer', modalFooterClasses]">
                    <slot name="b3-modal-footer">
                        <button v-if="showBtnClose" type="button" :class="['btn', typeBtnClose]" data-dismiss="modal" @click="setActionClose">
                            <icon-app :iconImage="iconBtnClose" v-if="iconBtnClose"></icon-app> {{ txtBtnClose }}
                        </button>
                        <button v-if="showBtnSave" type="button" :class="['btn', typeBtnSave]" @click="setActionSave">
                            <icon-app :iconImage="iconBtnSave" v-if="iconBtnSave"></icon-app> {{ txtBtnSave }}
                        </button>
                    </slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Icon from './Icon.vue';

    export default {
        name: 'b3-modal-app',
        data() {
            return {
                show: this.displayModal
            }
        },
        mounted() {
            this.handledEventsToModal();
        },
        components: {
            'icon-app': Icon
        },
        props: {
            modalId:{
                type: String,
                default: 'b3-modal-id',
            },
            modalSize: {
                type: String,
                default: ''
            },
            modalHeaderClasses: {
                type: String,
                default: ''
            },
            modalFooterClasses: {
                type: String,
                default: ''
            },
            modalTitle: {
                type: String,
                default: '',
                required: true
            },
            showBtnSave: {
                type: Boolean,
                default: true,
            },
            txtBtnSave: {
                type: String,
                default: 'Guardar',
            },
            iconBtnSave: {
                type: String,
                default: ''
            },
            actionBtnSave: {
                type: Function,
                default: null
            },
            typeBtnSave: {
                type: String,
                default: 'btn-primary'
            },
            showBtnClose: {
                type: Boolean,
                default: true,
            },
            txtBtnClose: {
                type: String,
                default: 'Cerrar',
            },
            iconBtnClose: {
                type: String,
                default: ''
            },
            actionBtnClose: {
                type: Function,
                default: null
            },
            typeBtnClose: {
                type: String,
                default: 'btn-secondary'
            },
            onModalShown: {
                type: Function,
                default: null
            },
            onModalHidden: {
                type: Function,
                default: null
            },
        },
        computed: {
            setActionSave() {
                if (this.actionBtnSave) {
                    return this.actionBtnSave
                }
                return () => {}
            },
            setActionClose() {
                if (this.actionBtnClose) {
                    return this.actionBtnClose
                }
                return () => {}
            }
        },
        methods: {
            handledEventsToModal() {
                const module = this;
                window.jQuery(window.document).ready(function (e) {
                    window.jQuery('#' + module.modalId).on('shown.bs.modal', function(e) {
                        if (module.onModalShown) {
                            module.onModalShown();
                        }
                    });

                    window.jQuery('#' + module.modalId).on('hidden.bs.modal', function(e) {
                        if (module.onModalHidden) {
                            module.onModalHidden();
                        }
                    });
                });
            }
        }
    }
</script>

<style></style>