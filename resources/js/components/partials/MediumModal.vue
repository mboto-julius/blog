<template>
    <div>
        <div class="modal-overlay" @click="$emit('close')"></div>
        <div
            class="modal"
            id="medium-modal"
            style="display: block"
            aria-hidden="true"
            tabindex="-1"
            role="dialog"
        >
            <div
                class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
            >
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">
                            <slot name="header"></slot>
                        </h4>
                        <button
                            type="button"
                            class="btn-close"
                            @click="$emit('close')"
                            data-dismiss="modal"
                        ></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <slot name="body"></slot>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <slot name="footer"></slot>
                        <button
                            type="button"
                            @click="$emit('close')"
                            class="btn btn-danger"
                            data-dismiss="modal"
                        >
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script></script>

<style scoped>
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    z-index: 1040;
}

.modal {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1050;
}
</style>
