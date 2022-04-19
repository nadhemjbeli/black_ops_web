<template>
    <div>
        <main class="content">
            <div class="container p-0">
                <h1 class="h3 mb-3">
                    Messages
                </h1>

                <div class="card">
                    <div class="row g-0">
                        <div class="col-12 col-lg-7 col-xl-12">
                            <div class="col-12">
                                <div class="mt-4">
                                    <loading v-show="loading" />

                                    <h5
                                        v-show="!loading && messages.length === 0"
                                        class="ml-4"
                                    >
                                        Whoopsie Daisy, no messages found!
                                    </h5>
                                </div>
                            </div>
                            <div
                                id="chatscreen"
                                class="chat-messages p-4"
                            >
                                <message
                                    v-for="message in messages"
                                    :key="message['@id']"
                                    :message="message"
                                    :current="currentUser"
                                />
                            </div>

                            <div class="position-relative">
                                <inputt
                                    :current="currentUser"
                                    :add-to-cart-loading="addToCartLoading"
                                    @load_again="loadAddedMessages"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script>

import { getCurrentUser } from '@/js/services/page-context';
import Message from '@/js/pages/message';
import Inputt from '@/js/pages/input';
import Loading from '@/js/components/loading';
import { fetchMessages } from '@/js/services/messages-service';
import axios from 'axios';

export default {
    name: 'Chat',
    components: {
        Message,
        Inputt,
        Loading,
    },
    data() {
        return {
            currentUser: getCurrentUser(),
            messages: [],
            loading: false,
            addToCartLoading: false,
            addToCartSuccess: false,
        };
    },
    created() {
        this.loadMessages();
    },
    methods: {
        async loadMessages() {
            this.loading = true;
            let response;
            try {
                response = await axios.get('/api/messages');
                this.loading = false;
            } catch (e) {
                this.loading = false;

                return;
            }
            this.messages = response.data['hydra:member'].sort((a, b) =>
            // Turn your strings into dates, and then subtract them
            // to get a value that is either negative, positive, or zero.
                a.idMessage - b.idMessage).reverse();
            // console.log(this.messages);
        },
        async loadAddedMessages() {
            this.addToCartLoading = true;
            let response;
            try {
                response = await axios.get('/api/messages');
                this.loading = false;
                this.addToCartLoading = false;
            } catch (e) {
                this.loading = false;
                this.addToCartLoading = false;
                // this.addToCartSuccess = true;
                return;
            }

            this.messages = response.data['hydra:member'].sort((a, b) =>
            // Turn your strings into dates, and then subtract them
            // to get a value that is either negative, positive, or zero.
                a.idMessage - b.idMessage).reverse();

            this.addToCartLoading = false;
        },
    },
};
</script>

<style scoped>

</style>
