<template>
    <div>
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">Статистика</h3>
            </div>
        </div>

        <div
            class="kt-content kt-grid__item kt-grid__item--fluid"
            id="kt_content"
        >
            <!--            Баланс market csgo -->

            <div class="kt-portlet">
                <div
                    class="kt-portlet__body kt-portlet__body--fit d-flex flex-wrap"
                >
                    <div class="row row-no-padding row-col-separator-xl">
                        <div class="col-12">
                            <!--begin::New Users-->
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <h4 class="kt-widget24__title">
                                            Баланс кошелька бота
                                        </h4>
                                        <span class="kt-widget24__desc">
                                            MARKET RUB
                                        </span>
                                    </div>

                                    <span
                                        class="kt-widget24__stats kt-font-warning"
                                    >
                                        <span v-if="balance.loading">
                                            <img
                                                src="https://icons8.com/preloaders/preloaders/1476/Rocket.gif"
                                                height="26px"
                                            />
                                        </span>
                                        <span v-else>
                                            {{ balance.sum }}
                                        </span>
                                        <i class="la la-rub"></i>
                                    </span>
                                </div>
                            </div>
                            <!--end::New Users-->
                        </div>
                    </div>
                </div>
            </div>

            <!--            Пополнения-->
            <div class="kt-portlet">
                <div class="kt-portlet__body kt-portlet__body--fit">
                    <div class="row row-no-padding row-col-separator-xl">
                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <!--begin::Total Profit-->
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <h4 class="kt-widget24__title">
                                            Пополнений на
                                        </h4>
                                        <span class="kt-widget24__desc">
                                            за сегодня
                                        </span>
                                    </div>

                                    <span
                                        class="kt-widget24__stats kt-font-success"
                                    >
                                        {{ stat.payments.today
                                        }}<i class="la la-rub"></i>
                                    </span>
                                </div>
                            </div>
                            <!--end::Total Profit-->
                        </div>

                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <!--begin::New Feedbacks-->
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <h4 class="kt-widget24__title">
                                            Пополнений на
                                        </h4>
                                        <span class="kt-widget24__desc">
                                            за 7 дней
                                        </span>
                                    </div>

                                    <span
                                        class="kt-widget24__stats kt-font-success"
                                    >
                                        {{ stat.payments.week
                                        }}<i class="la la-rub"></i>
                                    </span>
                                </div>
                            </div>
                            <!--end::New Feedbacks-->
                        </div>

                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <!--begin::New Orders-->
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <h4 class="kt-widget24__title">
                                            Пополнений на
                                        </h4>
                                        <span class="kt-widget24__desc">
                                            за месяц
                                        </span>
                                    </div>

                                    <span
                                        class="kt-widget24__stats kt-font-success"
                                    >
                                        {{ stat.payments.month
                                        }}<i class="la la-rub"></i>
                                    </span>
                                </div>
                            </div>
                            <!--end::New Orders-->
                        </div>

                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <!--begin::New Users-->
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <h4 class="kt-widget24__title">
                                            Пополнений на
                                        </h4>
                                        <span class="kt-widget24__desc">
                                            за все время
                                        </span>
                                    </div>

                                    <span
                                        class="kt-widget24__stats kt-font-success"
                                    >
                                        {{ stat.payments.all
                                        }}<i class="la la-rub"></i>
                                    </span>
                                </div>
                            </div>
                            <!--end::New Users-->
                        </div>
                    </div>
                </div>
            </div>

            <!--            Выводы -->
            <div class="kt-portlet">
                <div class="kt-portlet__body kt-portlet__body--fit">
                    <div class="row row-no-padding row-col-separator-xl">
                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <!--begin::Total Profit-->
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <h4 class="kt-widget24__title">
                                            Выводов
                                        </h4>
                                        <span class="kt-widget24__desc">
                                            за сегодня
                                        </span>
                                    </div>

                                    <span
                                        class="kt-widget24__stats kt-font-success"
                                    >
                                        {{ stat.withdraws.today
                                        }}<i class="la la-rub"></i>
                                    </span>
                                </div>
                            </div>
                            <!--end::Total Profit-->
                        </div>

                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <!--begin::New Feedbacks-->
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <h4 class="kt-widget24__title">
                                            Выводов
                                        </h4>
                                        <span class="kt-widget24__desc">
                                            за 7 дней
                                        </span>
                                    </div>

                                    <span
                                        class="kt-widget24__stats kt-font-success"
                                    >
                                        {{ stat.withdraws.week
                                        }}<i class="la la-rub"></i>
                                    </span>
                                </div>
                            </div>
                            <!--end::New Feedbacks-->
                        </div>

                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <!--begin::New Orders-->
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <h4 class="kt-widget24__title">
                                            Выводов
                                        </h4>
                                        <span class="kt-widget24__desc">
                                            за месяц
                                        </span>
                                    </div>

                                    <span
                                        class="kt-widget24__stats kt-font-success"
                                    >
                                        {{ stat.withdraws.month
                                        }}<i class="la la-rub"></i>
                                    </span>
                                </div>
                            </div>
                            <!--end::New Orders-->
                        </div>

                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <!--begin::New Users-->
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <h4 class="kt-widget24__title">
                                            Выводов
                                        </h4>
                                        <span class="kt-widget24__desc">
                                            за все время
                                        </span>
                                    </div>

                                    <span
                                        class="kt-widget24__stats kt-font-success"
                                    >
                                        {{ stat.withdraws.all
                                        }}<i class="la la-rub"></i>
                                    </span>
                                </div>
                            </div>
                            <!--end::New Users-->
                        </div>
                    </div>
                </div>
            </div>

            <!--            Пользователи -->
            <div class="kt-portlet">
                <div class="kt-portlet__body kt-portlet__body--fit">
                    <div class="row row-no-padding row-col-separator-xl">
                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <!--begin::Total Profit-->
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <h4 class="kt-widget24__title">
                                            Пользователей
                                        </h4>
                                        <span class="kt-widget24__desc">
                                            за сегодня
                                        </span>
                                    </div>

                                    <span
                                        class="kt-widget24__stats kt-font-success"
                                    >
                                        {{ stat.users.today
                                        }}<i class="la la-user"></i>
                                    </span>
                                </div>
                            </div>
                            <!--end::Total Profit-->
                        </div>

                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <!--begin::New Feedbacks-->
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <h4 class="kt-widget24__title">
                                            Пользователей
                                        </h4>
                                        <span class="kt-widget24__desc">
                                            за 7 дней
                                        </span>
                                    </div>

                                    <span
                                        class="kt-widget24__stats kt-font-success"
                                    >
                                        {{ stat.users.week
                                        }}<i class="la la-user"></i>
                                    </span>
                                </div>
                            </div>
                            <!--end::New Feedbacks-->
                        </div>

                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <!--begin::New Orders-->
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <h4 class="kt-widget24__title">
                                            Пользователей
                                        </h4>
                                        <span class="kt-widget24__desc">
                                            за месяц
                                        </span>
                                    </div>

                                    <span
                                        class="kt-widget24__stats kt-font-success"
                                    >
                                        {{ stat.users.month
                                        }}<i class="la la-user"></i>
                                    </span>
                                </div>
                            </div>
                            <!--end::New Orders-->
                        </div>

                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <!--begin::New Users-->
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <h4 class="kt-widget24__title">
                                            Пользователей
                                        </h4>
                                        <span class="kt-widget24__desc">
                                            за все время
                                        </span>
                                    </div>

                                    <span
                                        class="kt-widget24__stats kt-font-success"
                                    >
                                        {{ stat.users.all
                                        }}<i class="la la-user"></i>
                                    </span>
                                </div>
                            </div>
                            <!--end::New Users-->
                        </div>
                    </div>
                </div>
            </div>

            <!--            Статистика режимов -->
            <div class="kt-portlet">
                <div class="kt-portlet__body kt-portlet__body--fit">
                    <div class="row row-no-padding row-col-separator-xl">
                        <!--                        <div class="col-md-12 col-lg-3 col-xl-3">-->
                        <!--                            &lt;!&ndash;begin::Total Profit&ndash;&gt;-->
                        <!--                            <div class="kt-widget24">-->
                        <!--                                <div class="kt-widget24__details">-->
                        <!--                                    <div class="kt-widget24__info">-->
                        <!--                                        <h4 class="kt-widget24__title">-->
                        <!--                                            Пользователей-->
                        <!--                                        </h4>-->
                        <!--                                        <span class="kt-widget24__desc">-->
                        <!--									всего-->
                        <!--								</span>-->
                        <!--                                    </div>-->

                        <!--                                    <span class="kt-widget24__stats kt-font-brand">-->
                        <!--								        {{ stat.stats.users }}-->
                        <!--                                        <i class="la la-user"></i>-->
                        <!--							        </span>-->
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--                            &lt;!&ndash;end::Total Profit&ndash;&gt;-->
                        <!--                        </div>-->

                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <!--begin::Total Profit-->
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <h4 class="kt-widget24__title">
                                            Открытий
                                        </h4>
                                        <span class="kt-widget24__desc">
                                            всего
                                        </span>
                                    </div>

                                    <span
                                        class="kt-widget24__stats kt-font-brand"
                                    >
                                        {{ stat.stats.opens }}
                                        <i class="la la-archive"></i>
                                    </span>
                                </div>
                            </div>
                            <!--end::Total Profit-->
                        </div>

                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <!--begin::Total Profit-->
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <h4 class="kt-widget24__title">
                                            Контрактов
                                        </h4>
                                        <span class="kt-widget24__desc">
                                            всего
                                        </span>
                                    </div>

                                    <span
                                        class="kt-widget24__stats kt-font-brand"
                                    >
                                        {{ stat.stats.contracts }}
                                        <i class="la la-file"></i>
                                    </span>
                                </div>
                            </div>
                            <!--end::Total Profit-->
                        </div>

                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <!--begin::Total Profit-->
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <h4 class="kt-widget24__title">
                                            Апгрейдов
                                        </h4>
                                        <span class="kt-widget24__desc">
                                            всего
                                        </span>
                                    </div>

                                    <span
                                        class="kt-widget24__stats kt-font-brand"
                                    >
                                        {{ stat.stats.upgrades }}
                                        <i class="la la-plus-square"></i>
                                    </span>
                                </div>
                            </div>
                            <!--end::Total Profit-->
                        </div>
                    </div>
                </div>
            </div>

            <!--            Профит режимов -->
            <div class="kt-portlet">
                <div class="kt-portlet__body kt-portlet__body--fit">
                    <div class="row row-no-padding row-col-separator-xl">
                        <!--                        <div class="col-md-12 col-lg-3 col-xl-3">-->
                        <!--                            &lt;!&ndash;begin::Total Profit&ndash;&gt;-->
                        <!--                            <div class="kt-widget24">-->
                        <!--                                <div class="kt-widget24__details">-->
                        <!--                                    <div class="kt-widget24__info">-->
                        <!--                                        <h4 class="kt-widget24__title">-->
                        <!--                                            Пользователей-->
                        <!--                                        </h4>-->
                        <!--                                        <span class="kt-widget24__desc">-->
                        <!--									всего-->
                        <!--								</span>-->
                        <!--                                    </div>-->

                        <!--                                    <span class="kt-widget24__stats kt-font-brand">-->
                        <!--								        {{ stat.stats.users }}-->
                        <!--                                        <i class="la la-user"></i>-->
                        <!--							        </span>-->
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--                            &lt;!&ndash;end::Total Profit&ndash;&gt;-->
                        <!--                        </div>-->

                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <!--begin::Total Profit-->
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <h4 class="kt-widget24__title">
                                            Профит
                                        </h4>
                                        <span class="kt-widget24__desc">
                                            всех кейсов
                                        </span>
                                    </div>

                                    <span
                                        class="kt-widget24__stats kt-font-brand"
                                    >
                                        {{ stat.profit.cases }}
                                        <i class="la la-rub"></i>
                                    </span>
                                </div>
                            </div>
                            <!--end::Total Profit-->
                        </div>

                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <!--begin::Total Profit-->
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <h4 class="kt-widget24__title">
                                            Профит
                                        </h4>
                                        <span class="kt-widget24__desc">
                                            контрактов
                                        </span>
                                    </div>

                                    <span
                                        class="kt-widget24__stats kt-font-brand"
                                    >
                                        {{ stat.profit.contracts }}
                                        <i class="la la-rub"></i>
                                    </span>
                                </div>
                            </div>
                            <!--end::Total Profit-->
                        </div>

                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <!--begin::Total Profit-->
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <h4 class="kt-widget24__title">
                                            Профит
                                        </h4>
                                        <span class="kt-widget24__desc">
                                            апгрейдов
                                        </span>
                                    </div>

                                    <span
                                        class="kt-widget24__stats kt-font-brand"
                                    >
                                        {{ stat.profit.upgrades }}
                                        <i class="la la-rub"></i>
                                    </span>
                                </div>
                            </div>
                            <!--end::Total Profit-->
                        </div>

                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <!--begin::Total Profit-->
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <h4 class="kt-widget24__title">
                                            Предметов выведено
                                        </h4>
                                        <span class="kt-widget24__desc">
                                            на сумму
                                        </span>
                                    </div>

                                    <span
                                        class="kt-widget24__stats kt-font-brand"
                                    >
                                        {{ stat.profit.withdraw_sum }}
                                        <i class="la la-rub"></i>
                                    </span>
                                </div>
                            </div>
                            <!--end::Total Profit-->
                        </div>
                    </div>
                </div>
            </div>

            <!--            Таблицы -->
            <div class="row">
                <div class="col-xl-4">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Последние пополнения
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div
                                class="kt-widget3 kt-scroll"
                                data-scroll="true"
                                data-height="616"
                            >
                                <div
                                    v-for="payment in stat.lastPayments"
                                    :key="payment.id"
                                    class="kt-widget3__item"
                                >
                                    <div class="kt-widget3__header">
                                        <div class="kt-widget3__user-img">
                                            <img
                                                class="kt-widget3__img"
                                                :src="payment.user.avatar"
                                                alt=""
                                            />
                                        </div>
                                        <div class="kt-widget3__info">
                                            <router-link
                                                tag="a"
                                                :to="{
                                                    name: 'user',
                                                    params: {
                                                        id: payment.user.id,
                                                    },
                                                }"
                                                class="kt-widget3__username"
                                            >
                                                {{ payment.user.username }}
                                            </router-link>
                                            <br />
                                            <span class="kt-widget3__time">
                                                {{ payment.time }}
                                            </span>
                                        </div>
                                        <span
                                            class="kt-widget3__status kt-font-success"
                                        >
                                            {{ payment.sum
                                            }}<i class="la la-rub"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Последние пользователи
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div
                                class="kt-widget3 kt-scroll"
                                data-scroll="true"
                                data-height="616"
                            >
                                <div
                                    v-for="user in stat.lastUsers"
                                    :key="user.id"
                                    class="kt-widget3__item"
                                >
                                    <div class="kt-widget3__header">
                                        <div class="kt-widget3__user-img">
                                            <img
                                                class="kt-widget3__img"
                                                :src="user.avatar"
                                                alt=""
                                            />
                                        </div>
                                        <div class="kt-widget3__info">
                                            <router-link
                                                tag="a"
                                                :to="{
                                                    name: 'user',
                                                    params: { id: user.id },
                                                }"
                                                class="kt-widget3__username"
                                            >
                                                {{ user.username }}
                                            </router-link>
                                            <br />
                                            <span class="kt-widget3__time">
                                            </span>
                                        </div>
                                        <span
                                            class="kt-widget3__status kt-font-success"
                                        >
                                            {{ user.time }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            stat: {
                payments: {
                    today: 0,
                    week: 0,
                    month: 0,
                    all: 0,
                },
                withdraws: {
                    today: 0,
                    week: 0,
                    month: 0,
                    all: 0,
                },
                users: {
                    today: 0,
                    week: 0,
                    month: 0,
                    all: 0,
                },
                stats: {
                    users: 0,
                    opens: 0,
                    contracts: 0,
                    upgrades: 0,
                },
                profit: {
                    cases: 0,
                    contracts: 0,
                    upgrades: 0,
                    withdraw_sum: 0,
                },
                lastPayments: {},
                lastUsers: {},
            },
            balance: {
                sum: 0,
                loading: true,
            },
        };
    },
    mounted() {
        this.load();
        this.getBalance();
    },
    methods: {
        load() {
            this.$root.axios.get("/stats").then((res) => {
                this.stat = res.data;
            });
        },
        getBalance() {
            this.$root.axios.get("/market/balance").then((res) => {
                let result = res.data;

                if (result.success) {
                    this.balance = {
                        sum: result.balance,
                        loading: false,
                    };
                }
            });
        },
    },
};
</script>
