import Vue from "vue";
import VueRouter from "vue-router";

import Index from "./components/pages/Index.vue";
import Settings from "./components/pages/Settings.vue";
import AllItems from "./components/pages/items/AllItems.vue";
import Cases from "./components/pages/cases/Cases.vue";
import CasesItems from "./components/pages/cases/Items.vue";
import Categories from "./components/pages/cases/Categories.vue";
import Users from "./components/pages/users/users.vue";
import User from "./components/pages/users/user.vue";
import Payments from "./components/pages/Payments.vue";
import Promocodes from "./components/pages/Promocodes.vue";
import Notification from "./components/pages/Notification.vue";
import Calendar from "./components/pages/calendar/Calendar.vue";
import Withdraws from "./components/pages/Withdraws.vue";
import Logs from "./components/pages/Logs.vue";
import RaffleHour from "./components/pages/raffle/Hour.vue";
import RaffleDay from "./components/pages/raffle/Day.vue";
import RaffleWeek from "./components/pages/raffle/Week.vue";
import WheelItems from "./components/pages/WheelItems.vue";
import PaymentMethods from "./components/pages/PaymentMethods.vue";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/admin",
            name: "index",
            component: Index,
        },
        {
            path: "/admin/settings",
            name: "settings",
            component: Settings,
        },
        {
            path: "/admin/all_items",
            name: "all_items",
            component: AllItems,
        },
        {
            path: "/admin/promocodes",
            name: "promocodes",
            component: Promocodes,
        },
        {
            path: "/admin/notification",
            name: "notification",
            component: Notification,
        },
        {
            path: "/admin/cases",
            name: "cases",
            component: Cases,
        },
        {
            path: "/admin/cases/:id/items",
            name: "cases.items",
            component: CasesItems,
        },
        {
            path: "/admin/categories",
            name: "categories",
            component: Categories,
        },
        {
            path: "/admin/users",
            name: "users",
            component: Users,
        },
        {
            path: "/admin/user/:id",
            name: "user",
            component: User,
        },
        {
            path: "/admin/payments",
            name: "payments",
            component: Payments,
        },
        {
            path: "/admin/calendar",
            name: "calendar",
            component: Calendar,
        },
        {
            path: "/admin/raffleHour",
            name: "raffleHour",
            component: RaffleHour,
        },
        {
            path: "/admin/raffleDay",
            name: "raffleDay",
            component: RaffleDay,
        },
        {
            path: "/admin/raffleWeek",
            name: "raffleWeek",
            component: RaffleWeek,
        },
        {
            path: "/admin/withdraws",
            name: "withdraws",
            component: Withdraws,
        },
        {
            path: "/admin/wheelItems",
            name: "wheelItems",
            component: WheelItems,
        },
        {
            path: "/admin/paymentMethods",
            name: "paymentMethods",
            component: PaymentMethods,
        },
        {
            path: "/admin/logs",
            name: "logs",
            component: Logs,
        },
        {
            path: "*",
            redirect: "/admin",
        },
    ],
});

export default router;
