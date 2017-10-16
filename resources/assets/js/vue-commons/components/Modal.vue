<template>
    <div class="modal fade" :id="modalId" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div :class="['modal-dialog', {'modal-lg': modalSize === 'lg', 'modal-sm': modalSize === 'sm'}]" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">{{ modalTitle }}</h4>
                </div>
                <div class="modal-body bg-light">
                    <slot></slot>
                </div>
                <div class="modal-footer bg-dark">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ txtBtnClose }}</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                show: this.displayModal
            }
        },
        props: ['modalId', 'modalTitle', 'modalSize', 'txtBtnClose']
    }
</script>

<style></style>