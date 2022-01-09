<template>
    <div class="row mt-3">
        <div class="col-xl-10 col-9">
            <input
                type="text" 
                v-model="message"
                @keyup.enter="sendMessage()"
                placeholder="Say something..."
                class=" form-control "
            />       
        </div>    
        <div class="col-2">
            <button @click="sendMessage()" class="btn btn-outline-primary">Send</button> 
        </div>        
    </div>
</template>

<script>
    export default {
        props: ['room'],
        data: function() {
            return {
                message: ''
            }
        },
        methods: {
            sendMessage() {
                if ( this.message == '' ) {
                    return;
                }

                axios.post( 'ChatLive/room/' + this.room.id + '/message', {
                    message: this.message
                })
                .then( response => {
                    if ( response.status == 201 ) {
                        this.message = '';
                        this.$emit('messagesent');
                    }
                })
                .catch( error => {
                    console.log( error );
                }) 
            }
        }
    }
</script>
