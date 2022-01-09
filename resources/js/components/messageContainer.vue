<template>
    <div style="height:400px;" class="overflow-auto">
        <div v-for="(message, index) in messages" :key="index">
            <messageItem :user="user" :message="message"></messageItem>
            <span id="end"></span>
        </div>
    </div>
</template>

<script>

    import messageItem from './messageItem.vue'

    export default {
        components: {
            messageItem
        },
        props: ['messages', 'user']   
    }
</script>
