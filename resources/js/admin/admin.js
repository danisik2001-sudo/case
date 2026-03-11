import Vue from 'vue';
import VueRouter from 'vue-router';

import axios from "axios";
import Toast from 'vue-toastification'
import "vue-toastification/dist/index.css";

import router from "./router";
import VueCookie from "vue-cookie";
import VueAxios from "vue-axios";

const ToastOptions = {
    position: "top-right",
    timeout: 3000,
    closeOnClick: true,
    pauseOnFocusLoss: false,
    pauseOnHover: true,
    draggable: true,
    draggablePercent: 0.6,
    showCloseButtonOnHover: false,
    hideProgressBar: false,
    closeButton: false,
    icon: true,
    rtl: false,
    transition: "Vue-Toastification__bounce",
    newestOnTop: true
};

Vue.use(Toast, ToastOptions)
Vue.use(VueRouter);
Vue.use(VueCookie);
Vue.use(VueAxios, axios);

import App from "./components/App";

axios.defaults.withCredentials = true;
axios.defaults.baseURL = '/api/admin';

const admin = new Vue({
    el: '#app',
    data: {
        user: {
            id: null,
            username: null,
            avatar: null,
            steamid: null,
        },
    },
    mounted() {
        if (this.$cookie.get('token')) {
            this.getUser();
        }
    },
    methods: {
        getUser() {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.$cookie.get('token');
            axios.get('/user/get', {
                headers: {
                    "Content-Type": "application/json"
                }
            }).then(res => {
                if(res.status === 200) {
                    this.user = {
                        id: res.data.user.id,
                        username: res.data.user.username,
                        avatar: res.data.user.avatar,
                        steamid: res.data.user.steamid,
                    };
                }
            }).catch(error => {
                console.log(error)
                this.$cookie.delete('token');
            });
        },
    },
    components: {
        App
    },
    router
});
