<template>
    <div class="flex-grow-0 py-3 px-4 border-top">
        <loading v-show="loadingForm" />
        <!--        <div v-if="show">-->
        <i
            v-show="addToCartLoading"
            class="fas fa-spinner fa-spin"
        />
        <!--        </div>-->
        <div
            ref="form"
            class="input-group"
            @submit.prevent="onSubmit"
        >
            <!--            <input-->
            <!--                v-model="inputMessage"-->
            <!--                type="text"-->
            <!--                class="form-control"-->
            <!--                name="message"-->
            <!--                placeholder="Type your message"-->
            <!--            >-->
            <!--            <button-->
            <!--                class="btn btn-primary"-->
            <!--                @click="insertMessage"-->
            <!--            >-->
            <!--                Send-->
            <!--            </button>-->
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Loading from '@/js/components/loading';

export default {
    name: 'Input',
    components: {
        Loading,
    },
    props: {
        current: {
            type: Object,
            required: true,
        },
        addToCartLoading: {
            type: Boolean,
            required: true,
        },
    },
    data() {
        return {
            loadingForm: false,
            show: false,
        };
    },
    async mounted() {
        try {
            this.loadingForm = true;
            const { data } = await axios.get('/client/message/get_form');
            console.log(data);
            this.$refs.form.innerHTML = data.form;
            this.loadingForm = false;
        } catch (e) {
            console.log(e);
        }
    },
    methods: {
        onSubmit(e) {
            const formData = new FormData(e.target);
            this.show = true;
            axios.post('postMessage', formData).then((response) => {
                // console.log(response);
                // this.inputMessage = '';
            });

            this.$emit('load_again');
            document.getElementById('message_client_contenuMessage').value = '';
        },
    },
};
</script>

<style scoped>

</style>
