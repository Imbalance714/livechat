<template>
    <div class="flex-column width35">
        <ul class="list-group width100 flex-column">
            <li v-for="user in users" :key="user.user.id" class="list-group-item width100">
                <label v-text="user.user.name"></label>
                <span class="badge badge-success">Online</span>
                <!--<span v-else class="badge badge-warning">Offline</span>-->
            </li>
        </ul>
    </div>
</template>

<script>
    import HttpService from './../../../HttpService';

    export default {
        name: 'chat-users-component',
        data() {
            return {
                users: []
            }
        },
        created () {
            this.getOnlineUsers()
        },
        methods: {
            getOnlineUsers () {
                HttpService.makeGetRequest('/online-users', response => {
                    console.log(response)
                    this.users = response.data.data
                })
            }
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
    .width35 {
        width: 35%;
    }
    .width100 {
        width: 100%;
    }
</style>