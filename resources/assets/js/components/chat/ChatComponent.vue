<template>
    <div v-if="isConnected" class="container flex-column-center">
        <div class="flex-row width100">
            <chat-users-component v-if="isReinitializeUsersList"></chat-users-component>
            <message-list-component v-if="isReinitialize" :currentUserId="user.id" @reloadOnlineUsers="reloadUsersList"></message-list-component>
    </div>
        <div class="flex-row width100">
            <message-form-component :user="user" @myNewMessage="reloadMessages"></message-form-component>
        </div>
        <button class="btn btn-danger btn-sm" v-text="'Отключится от чата'" @click="closeConnection()"></button>
    </div>
    <div v-else class="flex-column-center">
        <button class="btn btn-success btn-lg" v-text="'Подключится к чату'" @click="openConnection()"></button>
    </div>
</template>

<script>
    //    import MessageComponent from  './src/MessageComponent'
    import ChatUsersComponent from './src/ChatUsersComponent'
    import MessageListComponent from './src/MessageListComponent'
    import MessageFormComponent from './src/MessageFormComponent'

    import HttpService from './../../HttpService';

    export default {
        name: 'chat-component',
        components: {
            MessageFormComponent,
            'chat-users-component': ChatUsersComponent,
            'message-list-component': MessageListComponent
        },
        created() {
            HttpService.makeGetRequest('/test', response => {
                this.user = response.data.data;
                localStorage.setItem('USER_ID', this.user.id);
                localStorage.setItem('USER_NAME', this.user.name);
                console.log(this.user);
                this.isReinitialize = true
            })
        },
        data() {
            return {
                user: {},
                messages: [],
                isConnected: false,
                isReinitialize: false,
                isReinitializeUsersList: false,
            }
        },
        methods: {
            openConnection() {
                var self = this;
                window.conn = new WebSocket('ws://localhost:8080');
                window.conn.onerror = function () {
                    self.isConnected = false;
                    console.log("ERROR: Connection do not established!");
                }
                window.conn.onopen = function (e) {
                    console.log("SUCCESS: Connection established!");
                    self.isConnected = true;
                    self.isReinitializeUsersList = true;
                    window.conn.send(JSON.stringify({userId: localStorage.getItem('USER_ID'), text: 'system', isSystem: true}));
                };
                window.conn.close = function (e) {
                    console.log("Connection closed!");
                };
                window.conn.disconnect = function (e) {
                    console.log("disconnected");
                };

                console.log(this.isConnected)
            },
            reloadMessages() {
                this.isReinitialize= false;
                setInterval(()=>{
                    this.isReinitialize = true
                },10)
            },
            reloadUsersList() {
                this.isReinitializeUsersList= false;
                setInterval(()=>{
                    this.isReinitializeUsersList = true
                },10)
            },
            closeConnection() {
                window.conn.send(JSON.stringify({userId: localStorage.getItem('USER_ID'), text: 'disconnect', isSystem: true}));
                window.conn.close(1000);
                this.isConnected = false;
                window.conn = null;
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style>
    .flex-row {
        display: flex;
        flex-direction: row;
    }

    .flex-column {
        display: flex;
        flex-direction: column;
    }

    .flex-column-center {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .width100 {
        width: 100%;
    }
</style>