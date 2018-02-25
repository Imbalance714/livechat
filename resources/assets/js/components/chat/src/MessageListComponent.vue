<template>
    <div class="width100">
        <message-component v-for="message in messages" :key="message.id"  :currentUserId="currentUserId" :messageIn="message">
        </message-component>
    </div>
</template>

<script>
    import MessageComponent from './MessageComponent';
    import HttpService from './../../../HttpService';

    export default {
        name: 'message-list-component',
        components: {
            'message-component': MessageComponent
        },
        props: {
            messagesProp: {
                type: Array,
            },
            currentUserId: {
                type: Number,
                required: true
            }
        },
        data () {
            return {
                messages: []
            }
        },
        created () {
            var self = this;
            HttpService.makeGetRequest('/messages', response => {
                this.messages = response.data.data
                this.isReinitialize= false;
                console.log('done');
                setInterval(()=>{
                    this.isReinitialize = true
                },10)
            })
//            this.message = this.messagesProp;
            window.conn.onmessage = function(e) {
//                console.log(self, e);
                let message = JSON.parse(e.data);
                if(message.isSystem) {
                    self.$emit('reloadOnlineUsers');
                } else {
                    self.pushNewMessage(message);
                }
            };
        },
        methods: {
            pushNewMessage(msg){
                this.messages.push(msg)
            }
        }
    }
</script>

<style>
    .width100{
        width: 100%;
    }
</style>