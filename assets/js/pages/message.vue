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
            <br>
            <!--            <div class="float-right">-->
            <!--                <a href="javascript:void(0)">-->

            <div class="float-right">
                <font-awesome-icon
                    v-if="liked"
                    icon="fa fa-heart"
                    size="1x"
                    style="cursor:hand; color: #ff0077;"
                    @click="toggleLike(message.idMessage)"
                />
                <font-awesome-icon
                    v-if="!liked"
                    icon="fa-regular fa-heart"
                    size="1x"
                    style="cursor:hand"
                    @click="toggleLike(message.idMessage)"
                />
                <span
                    class="float-right"
                    style="margin-left: 3px"
                > {{ countedLikes }}</span>
                <span
                    v-if="countedLikes==null"
                    class="float-right"
                    style="margin-left: 3px"
                >0</span>
            </div>
            <!--                    <br>-->
            <!--            <font-awesome-layers class="fa-lg">-->
            <!--                <font-awesome-icon icon="fa-solid fa-envelope" />-->
            <!--                <font-awesome-layers-text-->
            <!--                    counter-->
            <!--                    value="5"-->
            <!--                    position="top-right"-->
            <!--                />-->
            <!--            </font-awesome-layers>-->
            <!--                </a>-->
            <!--            </div>-->
        </div>
        <br>
    </div>
</template>

<script>

import axios from 'axios';

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
            liked: false,
            countedLikes: 0,
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
    created() {
        this.countLikes(this.message.idMessage);
    },
    methods: {
        async toggleLike(id) {
            this.liked = !this.liked;
            if (this.liked === true) {
                this.countedLikes++;
                await axios.post(`add_like/${id}`);
            } else {
                this.countedLikes--;
                await axios.post(`add_unlike/${id}`);
            }
            // this.countLikes(this.message.idMessage);
        },
        async countLikes(id) {
            let response;
            try {
                response = await axios.get(`api_likes/${id}`);
            } catch (e) {

            }
            console.log(response.data.current_user);
            this.countedLikes = response.data.counted;
            this.liked = response.data.current_user;
        },
        async reactToMessage(id) {
            this.toggleLike();
            let response;
        },
    },

};

</script>

<style scoped>

</style>
