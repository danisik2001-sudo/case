import Vue from "vue";
import VueRouter from "vue-router";
import VueCookie from "vue-cookie";

Vue.use(VueCookie);
Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "main",
            component: () => import("./Pages/Main.vue"),
            props: true,
        },
        {
            path: "/case/:url",
            name: "case",
            component: () => import("./Pages/Case.vue"),
            props: true,
        },
        {
            path: "/free_case",
            name: "free_case",
            component: () => import("./Pages/FreeCase.vue"),
            props: true,
        },
        {
            path: "/contracts",
            name: "contracts",
            component: () => import("./Pages/Contracts.vue"),
        },
        {
            path: "/upgrade",
            name: "upgrade",
            component: () => import("./Pages/Upgrade.vue"),
        },
        {
            path: "/bonuses",
            name: "bonuses",
            component: () => import("./Pages/Bonuses.vue"),
        },
        {
            path: "/referral",
            name: "referral",
            component: () => import("./Pages/Referral.vue"),
        },
        {
            path: "/dashboard",
            name: "dashboard",
            component: () => import("./Pages/Dashboard.vue"),
            props: true,
        },
        {
            path: "/user/:id",
            name: "user",
            component: () => import("./Pages/User.vue"),
            props: true,
        },
        // {
        //     path: "/missions",
        //     name: "missions",
        //     component: () => import("./Pages/Missions.vue"),
        // },

        {
            path: "/faq",
            name: "faq",
            component: () => import("./Pages/Faq.vue"),
        },
        {
            path: "/raffle",
            name: "raffle",
            component: () => import("./Pages/Raffle.vue"),
        },
        {
            path: "/wheel",
            name: "wheel",
            component: () => import("./Pages/Wheel.vue"),
        },
        {
            path: "/knife-game",
            name: "knife_game",
            component: () => import("./Pages/KnifeGame.vue"),
        },
        {
            path: "/cookie",
            name: "cookie",
            component: () => import("./Pages/Cookie.vue"),
        },
        {
            path: "/disclaimer",
            name: "disclaimer",
            component: () => import("./Pages/Disclaimer.vue"),
        },
        {
            path: "/privacy",
            name: "privacy",
            component: () => import("./Pages/Privacy.vue"),
        },
        {
            path: "/terms-of-use",
            name: "terms-of-use",
            component: () => import("./Pages/TermsOfUse.vue"),
        },
        {
            path: "/deposit",
            name: "deposit",
            component: () => import("./Pages/Deposit.vue"),
        },
        {
            path: "*",
            name: "404",
            component: () => import("./Pages/404.vue"),
        },
        {
            path: "/auth/callback",
            name: "auth.callback",
            component: () => import("./Pages/AuthCallback.vue"),
        },
    ],
    scrollBehavior(to, from) {
        return { x: 0, y: 0 };
    },
});
export default router;
