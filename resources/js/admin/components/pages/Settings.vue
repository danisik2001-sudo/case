<template>
    <div>
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">Настройки</h3>
            </div>
        </div>

        <div
            class="kt-content kt-grid__item kt-grid__item--fluid"
            id="kt_content"
        >
            <div class="kt-portlet kt-portlet--tabs">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-toolbar">
                        <ul
                            class="nav nav-tabs nav-tabs-line nav-tabs-line-danger nav-tabs-line-2x nav-tabs-line-right"
                            role="tablist"
                        >
                            <li class="nav-item">
                                <a
                                    class="nav-link active"
                                    data-toggle="tab"
                                    href="#site"
                                    role="tab"
                                    aria-selected="true"
                                >
                                    Настройки сайта
                                </a>
                            </li>
                            <li class="nav-item">
                                <a
                                    class="nav-link"
                                    data-toggle="tab"
                                    href="#bot"
                                    role="tab"
                                    aria-selected="false"
                                >
                                    Настройки бота
                                </a>
                            </li>
                            <li class="nav-item">
                                <a
                                    class="nav-link"
                                    data-toggle="tab"
                                    href="#description"
                                    role="tab"
                                    aria-selected="false"
                                >
                                    Настройки розыгрыша
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <form class="kt-form" onclick="return false;">
                    <div class="kt-portlet__body">
                        <div class="tab-content">
                            <div
                                class="tab-pane active"
                                id="site"
                                role="tabpanel"
                            >
                                <div class="kt-section">
                                    <h3 class="kt-section__title">
                                        Общие настройки:
                                    </h3>
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label>Имя сайта:</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                placeholder="sitename.ru"
                                                v-model="config.sitename"
                                                name="sitename"
                                            />
                                        </div>
                                        <div class="col-lg-6">
                                            <label
                                                >Заголовок сайта (титул):</label
                                            >
                                            <input
                                                type="text"
                                                class="form-control"
                                                placeholder="sitename.ru - краткое описание"
                                                v-model="config.title"
                                                name="title"
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label
                                                >Описание для поисковых
                                                систем:</label
                                            >
                                            <input
                                                type="text"
                                                class="form-control"
                                                placeholder="Описание для сайта..."
                                                v-model="config.description"
                                                name="description"
                                            />
                                        </div>
                                        <div class="col-lg-6">
                                            <label
                                                >Ключевые слова для поисковых
                                                систем:</label
                                            >
                                            <input
                                                type="text"
                                                class="form-control"
                                                placeholder="сайт, имя, домен и тд..."
                                                v-model="config.keywords"
                                                name="keywords"
                                            />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label
                                                >Чистый профит сайта (₽):</label
                                            >
                                            <input
                                                disabled
                                                type="text"
                                                class="form-control"
                                                placeholder="Профит сайта..."
                                                v-model="config.pure_profit"
                                                name="profit"
                                            />
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Банк игры сайта (₽):</label>
                                            <input
                                                disabled
                                                type="text"
                                                class="form-control"
                                                placeholder="Профит сайта..."
                                                v-model="config.site_profit"
                                                name="profit"
                                            />
                                        </div>

                                        <div class="col-lg-3">
                                            <label
                                                >Окупаемость сайта: 90 = 90% в
                                                банк сайта:</label
                                            >
                                            <input
                                                type="text"
                                                class="form-control"
                                                placeholder="сайт, имя, домен и тд..."
                                                v-model="config.profit_percent"
                                                name="percent"
                                            />
                                        </div>
                                        <div class="col-lg-3">
                                            <label
                                                >Чистый доход (0.1 =
                                                10%):</label
                                            >
                                            <input
                                                type="text"
                                                class="form-control"
                                                placeholder="сайт, имя, домен и тд..."
                                                v-model="config.pure_percent"
                                                name="percent"
                                            />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label
                                                >Минимальная сумма вывода
                                                (₽):</label
                                            >
                                            <input
                                                type="text"
                                                class="form-control"
                                                placeholder="сайт, имя, домен и тд..."
                                                v-model="
                                                    config.withdraw_min_sum
                                                "
                                                name="withdraw"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="bot" role="tabpanel">
                                <div class="kt-section">
                                    <h3 class="kt-section__title">
                                        Настройки бота:
                                    </h3>
                                    <div class="form-group row">
                                        <div class="col-lg-4">
                                            <label>MARKET API KEY:</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                placeholder="FJ82K8941c213KDSJ"
                                                v-model="config.market_key"
                                                name="bot_key"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="tab-pane"
                                id="description"
                                role="tabpanel"
                            >
                                <div class="kt-section">
                                    <h3 class="kt-section__title">
                                        Минимальный депозит по розыгрышам:
                                    </h3>
                                    <div class="form-group row">
                                        <div class="col-lg-4">
                                            <label>Каждый час:</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                placeholder="Значение"
                                                v-model="config.raffle_dep_hour"
                                            />
                                        </div>

                                        <div class="col-lg-4">
                                            <label>Каждый день:</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                placeholder="Значение"
                                                v-model="config.raffle_dep_day"
                                            />
                                        </div>

                                        <div class="col-lg-4">
                                            <label>Каждую неделю:</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                placeholder="Значение"
                                                v-model="config.raffle_dep_week"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button
                                type="submit"
                                class="btn btn-primary"
                                @click="save"
                            >
                                Сохранить
                            </button>
                            <button
                                type="reset"
                                class="btn btn-secondary"
                                @click="reset"
                            >
                                Сбросить
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            oldConfig: {},
            config: {
                sitename: null,
                title: null,
                description: null,
                keywords: null,
                site_profit: null,
                pure_profit: null,
                profit_percent: null,
                pure_percent: null,
                withdraw_min_sum: null,
                market_key: null,
                tg_group: null,
                raffle_dep_hour: null,
                raffle_dep_day: null,
                raffle_dep_week: null,
                multiplier: null,
                youtube_link: null,
                discord_link: null,
                merchant_id: null,
                merchant_secret_1: null,
                merchant_secret_2: null,
                min_dep: null,
                battle_min_add_sum: null,
            },
        };
    },
    methods: {
        load() {
            this.axios.post("/settings/load").then((res) => {
                let result = res.data;
                result.logotype = null;

                this.config = result;
                this.oldConfig = result;
            });
        },
        reset() {
            this.config = this.oldConfig;
        },
        save() {
            this.axios
                .post("/settings/save", { settings: this.config })
                .then((res) => {
                    let result = res.data;

                    this.$toast.success(result.message);
                });
        },
    },
    mounted() {
        this.load();
    },
};
</script>
