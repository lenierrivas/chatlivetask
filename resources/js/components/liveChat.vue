<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-md-8 col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <template>
                            <chatRoomSelections
                                v-if="currentRoom.id"
                                :rooms="chatRooms"
                                :currentRoom="currentRoom"
                                v-on:roomchanged="setRoom( $event )"
                            ></chatRoomSelections>
                        </template>
                    </div>
                    <div class="card-body">
                        <messageContainer :user="user" :messages="messages"></messageContainer>
                        <inputMessage :room="currentRoom" v-on:messagesent="getMessages()"></inputMessage>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import messageContainer from './messageContainer.vue'
    import inputMessage from './inputMessage.vue'
    import chatRoomSelections from './chatRoomSelections.vue'

    export default {
        components: {
            messageContainer,
            chatRoomSelections,
            inputMessage
        },

        data: function() {
            return {
                chatRooms: [],
                currentRoom: [],
                messages: [],
                user: []
            }
        },
        watch: {
            currentRoom( val, oldVal ) {
                if ( oldVal.id ) {
                    this.disconnect( oldVal );
                }
                this.connect();
            }
        },
        methods: {
            connect() {
                if ( this.currentRoom.id ) {
                    let vm = this;
                    this.getMessages();
                    window.Echo.private('chat.' + this.currentRoom.id )
                    .listen('.message.new', e => {
                        vm.getMessages();
                    });
                }
            },
            disconnect( room ){
                window.Echo.leave('chat.' + room.id );
            },
            getRooms() {
                axios.get('ChatLive/rooms')
                    .then( response => {
                        this.chatRooms = response.data;
                        this.setRoom( response.data[0] );
                    })
                    .catch( error => {
                        console.log( error );
                    })  
            },
            setRoom ( room ) {
                this.currentRoom = room;
            },
            getMessages() {
                axios.get('ChatLive/room/' + this.currentRoom.id + '/message')
                .then( response => {
                    this.messages = response.data;
                })
                .catch( error => {
                    console.log( error );
                })
            },
            getUser() {
                axios.get('user')
                    .then( response => {
                        this.user = response.data;
                    })
                    .catch( error => {
                        console.log( error );
                    })  
            }
        },

        created() {
            this.getRooms();
            this.getUser();
        }
    }
</script>