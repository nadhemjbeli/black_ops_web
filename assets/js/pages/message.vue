<template>
    <div
        id="inner"
        :class="asideClass"
    >
        <div>
            <!--                src="https://bootdey.com/img/Content/avatar/avatar1.png"-->
            <img
                :src="imageRoute"
                class="rounded-circle mr-1"
                alt="Chris Wood"
                width="40"
                height="40"
            >
            <br>
            <div class="float-right text-muted small text-nowrap mt-2">
                {{ toHour }} : {{ toMinutes }}
            </div>
        </div>
        <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
            <div class="font-weight-bold mb-1">
                {{ message.idCl.username }} <span v-if="checkCurrent">You</span>
            </div>
            {{ message.contenuMessage }}
        </div>
        <br>
    </div>
</template>

<script>

export default {
    name: 'Message',
    props: {
        message: {
            type: Object,
            required: true,
        },
        current: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {

        };
    },
    computed: {
        imageRoute() {
            return `/uploads/user_image/${this.message.idCl.image}`;
        },
        checkCurrent() {
            return this.current.username === this.message.idCl.username;
        },
        asideClass() {
            // console.log(this.message);
            return this.current.username === this.message.idCl.username ? 'chat-message-right pb-4' : 'chat-message-left pb-4';
        },
        toHour() {
            const date = Date.parse(this.message.dateMessage);
            const datetime = new Date(date * 1000);
            return datetime.getHours();
        },
        toMinutes() {
            const date = Date.parse(this.message.dateMessage);
            const datetime = new Date(date * 1000);
            return datetime.getMinutes();
        },
    },

};

</script>

<style scoped>

</style>
