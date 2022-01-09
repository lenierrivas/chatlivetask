<template>
    <div>
        <div v-if="message.user.name != user.name">
            <div class="alert alert-warning" style="margin-right: 20%;">
                <strong>{{ message.user.name }}</strong><small class="float-right ms-2">{{ getHumanDate(message.created_at) }}</small>
                <br><span class="text-muted">{{ message.message }}</span>
            </div>
        </div>
        <div v-if="message.user.name == user.name">
            <div class="alert alert-success" style="margin-left: 20%;">
                <strong>{{ message.user.name }}</strong><small class="float-right ms-2">{{ getHumanDate(message.created_at) }}</small>
                <br><span class="text-muted">{{ message.message }}</span>
            </div>
        </div>
    </div>
</template>

<script>

    import moment from 'moment';

    export default {
        props: ['message', 'user'],
        methods: {
            getHumanDate : function (date) {
                return moment(date).calendar();
            }
        }
    }
</script>
