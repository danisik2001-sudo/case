<template>
    <div class="layout">
        <Header />
        <Subheader />
        <Live />
        <LoginModal />
        <PaymentModal v-if="$root.isAuthorized" />
        <div class="main__wrapper">
            <router-view :key="$route.fullPath" />
        </div>

        <Footer />
        <mobileBottom @toggle-burger-menu="handleToggleBurgerMenu" />
        <burgerMenu
            :isHidden="isBurgerHidden"
            @toggle-burger-menu="handleToggleBurgerMenu"
        />
    </div>
</template>
<script>
import Header from "./Header.vue";
import Subheader from "./Subheader.vue";
import mobileBottom from "./mobileBottom.vue";
import burgerMenu from "./burgerMenu.vue";
import Live from "./Live.vue";
import Footer from "./Footer.vue";
import LoginModal from "../components/Modals/Login.vue";
import PaymentModal from "../components/Modals/PaymentModal.vue";

export default {
    components: {
        Footer,
        Live,
        Header,
        Subheader,
        mobileBottom,
        LoginModal,
        burgerMenu,
        PaymentModal,
    },
    data() {
        return {
            isBurgerHidden: false,
        };
    },
    methods: {
        handleToggleBurgerMenu() {
            this.isBurgerHidden = !this.isBurgerHidden; // Меняет `aria-hidden` на true
        },
    },
    sockets: {
        updateUser: function (data) {
            if (
                this.$root.isAuthorized &&
                parseInt(data.user_id) === parseInt(this.$root.user.id)
            ) {
                this.$root.user.balance = data.balance;
            }
        },
        notify: function (data) {
            if (data.user_id === this.$root.user.id) {
                if (data.success) {
                    return this.$toast.success(data.message);
                } else {
                    return this.$toast.error(data.message);
                }
            }
        },
    },
};
</script>
