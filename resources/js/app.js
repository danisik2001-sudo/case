import Vue from "vue";
import VueCookie from "vue-cookie";
import VueI18n from "vue-i18n";
import VueAxios from "vue-axios";
import VueSocketIO from "vue-socket.io";
import VueCountdown from "@chenfengyuan/vue-countdown";

import axios from "axios";
import router from "./router";
import App from "./components/App.vue";
import languages from "./languages";

import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

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
    newestOnTop: true,
};

Vue.use(Toast, ToastOptions);
Vue.use(VueCookie);
Vue.use(VueAxios, axios);
Vue.use(VueI18n);
Vue.component(VueCountdown.name, VueCountdown);

const port = window.location.protocol === "https:" ? "8443" : "8081";

Vue.use(
    new VueSocketIO({
        connection: `${window.location.origin}:${port}`,
    })
);

const lang = VueCookie.get("lang") || "RU";

const i18n = new VueI18n({
    locale: lang,
    fallbackLocale: lang,
    messages: languages,
});

Vue.filter("number", (value) => new Intl.NumberFormat().format(value));

axios.defaults.withCredentials = true;
axios.defaults.baseURL = "/api";

new Vue({
    el: "#app",
    i18n,
    data() {
        return {
            isAuthorized: false,
            user: {
                id: null,
                username: null,
                steamid: null,
                avatar: null,
                balance: 0,
                tradeLink: null,
                lvl: 0,
                exp: 0,
            },
            settings: {
                sitename: null,
            },
            lang: lang,
        };
    },
    mounted() {
        this.initializeApp();
    },
    methods: {
        async initializeApp() {
            if (this.$cookie.get("token")) await this.getUser();
            this.lang = this.$cookie.get("lang") || this.lang;
            await this.getSettings();
        },
        async getSettings() {
            try {
                const { data } = await axios.get("/settings");
                this.settings = data;
            } catch (error) {
                console.error("Failed to fetch settings:", error);
            }
        },
        async getUser() {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + this.$cookie.get("token");
            try {
                const { data, status } = await axios.get("/user/get", {
                    headers: {
                        "Content-Type": "application/json",
                    },
                });
                if (status === 200) {
                    this.isAuthorized = true;
                    Object.assign(this.user, data.user);
                }
            } catch (error) {
                this.$cookie.delete("token");
            }
        },
        initUser(token) {
            this.$cookie.set("token", token, { expires: "30d" });
            this.getUser();
        },
        async sellItems(ids, isAll) {
            try {
                const { data } = await axios.post("/user/items/sell", {
                    ids: ids,
                    isAll: isAll,
                });
                this.toast(data.success ? "success" : "error", data.message);
            } catch (error) {
                this.toast("error", "Failed to sell items");
            }
        },
        async sellItemsCase(ids, isAll) {
            try {
                const { data } = await axios.post("/user/items/sell/case", {
                    ids: ids,
                    isAll: isAll,
                });
                this.toast(data.success ? "success" : "error", data.message);
            } catch (error) {
                this.toast("error", "Failed to sell items");
            }
        },
        toast(type, message) {
            if (type === "error") this.playSound("notification-bad");
            if (type === "success") this.playSound("notification-good");
            return this.$toast[type](message);
        },
        playSound(sound) {
            const audio = new Audio(`/sounds/${sound}.mp3`);
            audio.volume = 0.3;
            audio
                .play()
                .catch((err) => console.error("Sound play error:", err));
        },
    },
    components: {
        App,
    },
    router,
});
