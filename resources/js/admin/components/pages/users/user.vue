<template>
    <div>
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">Редактирование пользователя</h3>
            </div>
        </div>

        <div
            class="kt-content kt-grid__item kt-grid__item--fluid"
            id="kt_content"
        >
            <div class="row">
                <div class="col-xl-4">
                    <div
                        class="kt-portlet kt-portlet--fit kt-portlet--head-lg kt-portlet--head-overlay"
                    >
                        <div class="kt-portlet__head kt-portlet__space-x">
                            <div
                                class="kt-portlet__head-label"
                                style="width: 100%"
                            >
                                <h3
                                    class="kt-portlet__head-title text-center"
                                    style="width: 100%"
                                >
                                    {{ user.username }}
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-widget28">
                                <div
                                    class="kt-widget28__visual"
                                    :style="
                                        'background: url(' +
                                        user.avatar +
                                        ') bottom center no-repeat'
                                    "
                                ></div>
                                <div
                                    class="kt-widget28__wrapper kt-portlet__space-x"
                                >
                                    <div class="tab-content">
                                        <div
                                            id="menu11"
                                            class="tab-pane active"
                                        >
                                            <div class="kt-widget28__tab-items">
                                                <div class="kt-widget12">
                                                    <div
                                                        class="kt-widget12__content"
                                                    >
                                                        <div
                                                            class="kt-widget12__item"
                                                        >
                                                            <div
                                                                class="kt-widget12__info text-center"
                                                            >
                                                                <span
                                                                    class="kt-widget12__desc"
                                                                    >Открыто
                                                                    кейсов</span
                                                                >
                                                                <span
                                                                    class="kt-widget12__value"
                                                                    >{{
                                                                        user.cases_count
                                                                    }}</span
                                                                >
                                                            </div>

                                                            <div
                                                                class="kt-widget12__info text-center"
                                                            >
                                                                <span
                                                                    class="kt-widget12__desc"
                                                                    >Контрактов</span
                                                                >
                                                                <span
                                                                    class="kt-widget12__value"
                                                                    >{{
                                                                        user.contracts_count
                                                                    }}</span
                                                                >
                                                            </div>

                                                            <div
                                                                class="kt-widget12__info text-center"
                                                            >
                                                                <span
                                                                    class="kt-widget12__desc"
                                                                    >Апгрейдов</span
                                                                >
                                                                <span
                                                                    class="kt-widget12__value"
                                                                    >{{
                                                                        user.upgrades_count
                                                                    }}</span
                                                                >
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div
                                                        class="kt-widget12__content"
                                                    >
                                                        <div
                                                            class="kt-widget12__item"
                                                        >
                                                            <div
                                                                class="kt-widget12__info text-center"
                                                            >
                                                                <span
                                                                    class="kt-widget12__desc"
                                                                    >Сумма
                                                                    пополнений</span
                                                                >
                                                                <span
                                                                    class="kt-widget12__value"
                                                                    >{{
                                                                        user.payments_payed_sum_sum ||
                                                                        0
                                                                    }}
                                                                    ₽</span
                                                                >
                                                            </div>

                                                            <div
                                                                class="kt-widget12__info text-center"
                                                            >
                                                                <span
                                                                    class="kt-widget12__desc"
                                                                    >Сумма
                                                                    выводов</span
                                                                >
                                                                <span
                                                                    class="kt-widget12__value"
                                                                    >{{
                                                                        user.withdrawed
                                                                    }}
                                                                    ₽</span
                                                                >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="kt-widget12__content"
                                                    >
                                                        <div
                                                            class="kt-widget12__item"
                                                        >
                                                            <div
                                                                class="kt-widget12__info text-center"
                                                            >
                                                                <span
                                                                    class="kt-widget12__desc"
                                                                    >Заработано
                                                                    с
                                                                    рефералов:</span
                                                                >
                                                                <span
                                                                    class="kt-widget12__value"
                                                                    >{{
                                                                        user.referral_earned
                                                                    }}
                                                                    ₽</span
                                                                >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Информация о пользователе
                                </h3>
                            </div>
                        </div>

                        <form
                            class="kt-form"
                            @submit="save"
                            onsubmit="return false;"
                        >
                            <div class="kt-portlet__body">
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Имя:</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="user.username"
                                            disabled
                                        />
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Ссылка на обмен:</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="user.trade_link"
                                            disabled
                                        />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label>Баланс:</label>
                                        <div class="kt-input-icon">
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="balance"
                                                v-model="user.balance"
                                            />
                                            <span
                                                class="kt-input-icon__icon kt-input-icon__icon--right"
                                                ><span
                                                    ><i
                                                        class="la la-rub"
                                                    ></i></span
                                            ></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Привилегии:</label>
                                        <select
                                            class="form-control"
                                            v-model="user.is_admin"
                                        >
                                            <option
                                                :selected="user.is_admin"
                                                value="1"
                                            >
                                                Администратор
                                            </option>
                                            <option
                                                :selected="user.is_admin"
                                                value="2"
                                            >
                                                Ютубер
                                            </option>
                                            <option
                                                :selected="!user.is_admin"
                                                value="0"
                                            >
                                                Пользователь
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Тип:</label>
                                        <select
                                            class="form-control"
                                            v-model="user.type"
                                        >
                                            <option
                                                :selected="user.type"
                                                value="default"
                                            >
                                                Обычный
                                            </option>
                                            <option
                                                :selected="user.type"
                                                value="fake"
                                            >
                                                Бот
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label>Реферальный код:</label>
                                        <div class="kt-input-icon">
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="level"
                                                v-model="user.referral_code"
                                            />
                                            <span
                                                class="kt-input-icon__icon kt-input-icon__icon--right"
                                                ><span
                                                    ><i
                                                        class="la la-bookmark"
                                                    ></i></span
                                            ></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Вывод открыт:</label>
                                        <select
                                            class="form-control"
                                            v-model="user.block_withdraw"
                                        >
                                            <option
                                                :selected="user.block_withdraw"
                                                value="0"
                                            >
                                                Да
                                            </option>
                                            <option
                                                :selected="user.block_withdraw"
                                                value="1"
                                            >
                                                Нет
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-lg-4">
                                        <label>Умник:</label>
                                        <select
                                            class="form-control"
                                            v-model="user.blocked"
                                        >
                                            <option
                                                :selected="user.blocked"
                                                value="1"
                                            >
                                                Да
                                            </option>
                                            <option
                                                :selected="user.blocked"
                                                value="0"
                                            >
                                                Нет
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label
                                            >Выдать дроп (id предмета):</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="user.drop_item_id"
                                            placeholder="Введите ID предмета (необязательно)"
                                        />
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Выдать личный профит:</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="user.personal_profit"
                                            placeholder="Введите ID предмета (необязательно)"
                                        />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Дата регистрации:</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            :value="formatDate(user.created_at)"
                                            disabled
                                        />
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Последний вход:</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            :value="formatDate(user.updated_at)"
                                            disabled
                                        />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Рег. ip:</label>
                                        <div class="kt-input-icon">
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="level"
                                                v-model="user.reg_ip"
                                                disabled
                                            />
                                            <span
                                                class="kt-input-icon__icon kt-input-icon__icon--right"
                                                ><span
                                                    ><i
                                                        class="la la-bank"
                                                    ></i></span
                                            ></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Ласт ip:</label>
                                        <div class="kt-input-icon">
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="level"
                                                v-model="user.last_ip"
                                                disabled
                                            />
                                            <span
                                                class="kt-input-icon__icon kt-input-icon__icon--right"
                                                ><span
                                                    ><i
                                                        class="la la-bank"
                                                    ></i></span
                                            ></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="kt-portlet__foot kt-portlet__foot--solid"
                            >
                                <div class="kt-form__actions">
                                    <div class="row">
                                        <div class="col-12">
                                            <button
                                                type="submit"
                                                class="btn btn-brand"
                                            >
                                                Сохранить
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
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
            user: {},
        };
    },
    methods: {
        formatDate(dateString) {
            const date = new Date(dateString);
            const day = String(date.getDate()).padStart(2, "0");
            const month = String(date.getMonth() + 1).padStart(2, "0");
            const year = date.getFullYear(); // Год
            const hours = String(date.getHours()).padStart(2, "0");
            const minutes = String(date.getMinutes()).padStart(2, "0");

            return `${day}.${month}.${year} ${hours}:${minutes}`;
        },
        load() {
            if (this.user.is_ban && this.user.ban_reason === null)
                return this.$toast.error("Вы не указали причину блокировки");
            this.axios
                .post("/users/get", { id: this.$route.params.id })
                .then((res) => {
                    let result = res.data;

                    if (result.success) {
                        this.user = result.user;
                    }

                    if (!result.success) {
                        this.$router.go(-1);
                    }
                });
        },
        save() {
            this.axios
                .post("/users/save", {
                    id: this.$route.params.id,
                    user: this.user,
                })
                .then((res) => {
                    let result = res.data;

                    if (result.success) {
                        this.$toast.success(result.message);
                        if (this.user.drop_item_id) {
                            this.giveDrop(this.user.drop_item_id);
                        }
                    }

                    if (!result.success) {
                        this.$toast.error(result.message);
                    }
                });
        },
        giveDrop(itemId) {
            this.axios
                .post("/users/give", {
                    user_id: this.$route.params.id,
                    item_id: itemId,
                })
                .then((res) => {
                    let result = res.data;

                    if (result.success) {
                        this.$toast.success(result.message);
                    } else {
                        this.$toast.error(result.message);
                    }
                })
                .catch(() => {
                    this.$toast.error("Ошибка при выдаче дропа");
                });
        },
    },
    mounted() {
        this.load();
    },
};
</script>
