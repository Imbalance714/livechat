<template>
    <div class="width100">
        <div class="form-group width100" style="padding-top: 30px;">
            <textarea class="form-control" v-model="text" rows="4"></textarea>

            <div class="float-right">
                <button @click="sendMessage()" class="btn btn-success">
                    Send
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'message-form-component',
        props: {
            user: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                text: '',
            }
        },
        created () {
        },
        methods: {
            sendMessage() {
                console.log(this.user.id)
                window.conn.send(JSON.stringify({userId: this.user.id, text: this.text, isSystem: false}))
                this.$emit('myNewMessage')
            }
        }
    }
</script>

<style>
    .width100 {
        width: 100%;
    }
</style>
