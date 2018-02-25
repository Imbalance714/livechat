<template>
    <div>
        <div v-if="message.user_id === currentUserId" class="card flex-float-right width100">
            <div class="media block-update-card">
                <div class="media-body update-card-body">
                    <h5 v-text="message.user.name" class="media-heading"></h5>
                    <p v-text="message.message"></p>
                    <div class="float-left">
                        <span v-text="message.created_at" class="badge badge-primary"></span>
                    </div>
                </div>
                <a class="pull-left" style="padding-right: 10px;" href="#">
                    <img class="media-object update-card-MDimentions"
                         src="https://cdn0.iconfinder.com/data/icons/avatar-vol-2-4/512/9-64.png" alt="">
                </a>
            </div>
        </div>
        <div v-else class="card flex-float-left width100">
            <div class="media block-update-card">
                <a class="pull-left" style="padding-right: 10px;" href="#">
                    <img class="media-object update-card-MDimentions"
                         src="https://cdn4.iconfinder.com/data/icons/web-ui-color/128/Account-64.png" alt="">
                </a>
                <div class="media-body update-card-body">
                    <h5 v-text="message.user.name" class="media-heading"></h5>
                    <p v-text="message.message"></p>
                    <div class="float-right">
                        <span v-text="message.created_at" class="badge badge-primary"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'message-component',
        props: {
            messageIn: {
                type: Object,
                required: true
            },
            currentUserId: {
                type: Number,
                required: true
            }
        },
        data() {
            return {
                message: {}
            }
        },
        created() {
            this.message = this.messageIn;
        },
        methods: {
            openMessageForEdit() {
                console.log(this.messageIn)
            }
        }
    }
</script>

<style>
    .flex-column {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .flex-item-align-end {
        align-self: flex-end;
    }

    .width100 {
        width: 100%;
    }

    .flex-float-right {
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        align-items: flex-end;
        padding: 10px;
    }

    .flex-float-left {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 10px;
    }
</style>