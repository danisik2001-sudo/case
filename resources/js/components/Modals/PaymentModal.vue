<template>
    <div
        class="modals rules-modals"
        v-show="active"
        :class="{ opened: active }"
    >
        <button type="button" class="abs-link"></button>
        <div class="deposit-content">
            <div class="deposit__container">
                <div class="section__left">
                    <div class="deposit__head">
                        <svg
                            width="28"
                            height="24"
                            viewBox="0 0 28 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                            class="deposit__icon"
                        >
                            <g clip-path="url(#clip0_149_44251)">
                                <path
                                    d="M26.6013 9.12959H23.6892C22.9051 9.12959 22.1914 9.43789 21.6732 9.96973C21.0853 10.5439 20.749 11.3697 20.8331 12.2516C20.9589 13.7637 22.3452 14.8697 23.8573 14.8697H26.6013C27.3853 14.8417 28.0013 14.2114 28.0013 13.4417V10.5576C28.0013 9.78789 27.3853 9.15762 26.6013 9.12959Z"
                                    fill="url(#paint0_linear_149_44251)"
                                />
                                <path
                                    d="M25.8583 16.9697H23.8561C21.1962 16.9697 18.9561 14.9675 18.7318 12.4197C18.6061 10.9637 19.1379 9.50761 20.2016 8.47197C21.0978 7.54775 22.3433 7.03027 23.6879 7.03027H25.8576C26.2637 7.03027 26.5993 6.69394 26.5576 6.28857C26.2493 2.88632 23.9955 0.562787 20.6493 0.170404C20.313 0.114349 19.963 0.100677 19.5993 0.100677H7C6.6083 0.100677 6.23027 0.128705 5.86592 0.18476C2.29619 0.63183 0 3.29169 0 7.09999V16.9C0 20.7637 3.13633 23.9 7 23.9H19.6C23.5197 23.9 26.222 21.45 26.5583 17.7121C26.6 17.306 26.2644 16.9704 25.8583 16.9704V16.9697ZM15.4 8.84999H7C6.42578 8.84999 5.95 8.37421 5.95 7.79999C5.95 7.22577 6.42578 6.74999 7 6.74999H15.4C15.9742 6.74999 16.45 7.22577 16.45 7.79999C16.45 8.37421 15.9742 8.84999 15.4 8.84999Z"
                                    fill="url(#paint1_linear_149_44251)"
                                />
                            </g>
                            <defs>
                                <linearGradient
                                    id="paint0_linear_149_44251"
                                    x1="24.4108"
                                    y1="9.12959"
                                    x2="24.4108"
                                    y2="14.8697"
                                    gradientUnits="userSpaceOnUse"
                                >
                                    <stop stop-color="#75CB7D" />
                                    <stop offset="1" stop-color="#419049" />
                                </linearGradient>
                                <linearGradient
                                    id="paint1_linear_149_44251"
                                    x1="13.2809"
                                    y1="0.100677"
                                    x2="13.2809"
                                    y2="23.9"
                                    gradientUnits="userSpaceOnUse"
                                >
                                    <stop stop-color="#75CB7D" />
                                    <stop offset="1" stop-color="#419049" />
                                </linearGradient>
                                <clipPath id="clip0_149_44251">
                                    <rect width="28" height="24" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>

                        <div class="deposit__title">
                            {{ $t("deposit.wallet") }}
                        </div>
                    </div>
                    <div class="methods__wrapper">
                        <div class="depositMethods__list">
                            <button
                                v-for="method in paymentMethods"
                                :key="method.name"
                                @click="selectMethod(method.name)"
                                :aria-selected="selectedMethod === method.name"
                                :class="{
                                    selected: selectedMethod === method.name,
                                }"
                                class="money__method"
                                type="button"
                            >
                                <div class="item__check">
                                    <svg
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        class="icon item_check"
                                    >
                                        <path
                                            d="M23.442 3.549a1.925 1.925 0 00-2.692 0L8.635 15.476 3.25 10.175a1.925 1.925 0 00-2.692 0 1.853 1.853 0 000 2.65l6.73 6.626c.372.366.86.549 1.346.549a1.91 1.91 0 001.347-.55L23.442 6.2a1.853 1.853 0 000-2.651z"
                                            fill="var(--color-gray-secondary)"
                                        ></path>
                                    </svg>
                                </div>
                                <img
                                    :src="method.icon"
                                    :alt="method.name"
                                    class="method__item_image"
                                />
                                <div class="item__background"></div>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="section__right">
                    <div class="deposit__form">
                        <div class="deposit__card">
                            <div class="form__head">
                                <div class="deposit__title">
                                    {{ $t("deposit.title") }}
                                </div>
                                <button
                                    type="button"
                                    class="modals-close-btn"
                                    @click="active = false"
                                >
                                    <i></i>
                                </button>
                            </div>
                            <div
                                class="deposit__card color--primary-gradient deposit__selectedMethod"
                            >
                                <div class="card__body size--large">
                                    <div class="selected__method">
                                        <div class="method__info">
                                            <div class="method__info-title">
                                                {{ $t("deposit.method") }}
                                            </div>
                                            <div class="method__info-desc">
                                                {{
                                                    selectedMethod
                                                        ? selectedMethod
                                                        : "Не выбран"
                                                }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="depositFinal__form"
                                v-if="selectedMethod !== 'crypto'"
                            >
                                <form class="amount_link__form">
                                    <div class="amount_form__fields">
                                        <div class="amount_form__info">
                                            <div
                                                class="amount_form__info-title uppercase"
                                            >
                                                {{ $t("deposit.amount") }}
                                            </div>
                                        </div>
                                        <div
                                            class="controls color--dark size--large full-width inputWrapper flex-start"
                                        >
                                            <div class="label">₽</div>
                                            <input
                                                type="text"
                                                placeholder="5"
                                                autocomplete="off"
                                                name="amount"
                                                class="inputAmount"
                                                v-model="depositSum"
                                            />
                                        </div>
                                    </div>
                                </form>
                                <div class="form__buttons">
                                    <button
                                        @click="setDepositSum(3)"
                                        class="controls size--small-deposit full-width button"
                                        type="button"
                                        :class="
                                            depositSum === 3
                                                ? 'color--gray-primary-lite'
                                                : 'color--gray-primary'
                                        "
                                    >
                                        <div class="button__content">
                                            <div class="123">3</div>
                                        </div></button
                                    ><button
                                        @click="setDepositSum(5)"
                                        class="controls color--gray-primary size--small-deposit full-width button"
                                        type="button"
                                        :class="
                                            depositSum === 5
                                                ? 'color--gray-primary-lite'
                                                : 'color--gray-primary'
                                        "
                                    >
                                        <div class="button__content">
                                            <div class="123">5</div>
                                        </div></button
                                    ><button
                                        @click="setDepositSum(10)"
                                        class="controls color--gray-primary size--small-deposit full-width button"
                                        type="button"
                                        :class="
                                            depositSum === 10
                                                ? 'color--gray-primary-lite'
                                                : 'color--gray-primary'
                                        "
                                    >
                                        <div class="button__content">
                                            <div class="123">10</div>
                                        </div></button
                                    ><button
                                        @click="setDepositSum(50)"
                                        class="controls color--gray-primary size--small-deposit full-width button"
                                        type="button"
                                        :class="
                                            depositSum === 50
                                                ? 'color--gray-primary-lite'
                                                : 'color--gray-primary'
                                        "
                                    >
                                        <div class="button__content">
                                            <div class="123">50</div>
                                        </div>
                                    </button>
                                </div>
                                <form class="amount_link__form">
                                    <div class="amount_form__fields">
                                        <div class="amount_form__info">
                                            <div
                                                class="amount_form__info-title uppercase"
                                            >
                                                {{ $t("deposit.promocode") }}
                                            </div>
                                        </div>
                                        <div
                                            class="controls color--gray-dark size--large full-width inputWrapper flex-start"
                                        >
                                            <div class="label">
                                                <svg
                                                    width="18"
                                                    height="18"
                                                    viewBox="0 0 18 18"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <path
                                                        d="M1.5 11.25H8.25V18H5.25C4.25544 18 3.30161 17.6049 2.59835 16.9016C1.89509 16.1984 1.5 15.2446 1.5 14.25V11.25ZM18 8.25C18 8.64782 17.842 9.02936 17.5607 9.31066C17.2794 9.59196 16.8978 9.75 16.5 9.75H9.75V6.71775C9.498 6.73725 9.24675 6.75 9 6.75C8.75325 6.75 8.502 6.73725 8.25 6.71775V9.75H1.5C1.10218 9.75 0.720644 9.59196 0.43934 9.31066C0.158035 9.02936 0 8.64782 0 8.25C0 7.45435 0.316071 6.69129 0.87868 6.12868C1.44129 5.56607 2.20435 5.25 3 5.25H4.3035C3.87945 4.8762 3.54285 4.41366 3.31758 3.8952C3.09231 3.37674 2.98388 2.81506 3 2.25C3 2.05109 3.07902 1.86032 3.21967 1.71967C3.36032 1.57902 3.55109 1.5 3.75 1.5C3.94891 1.5 4.13968 1.57902 4.28033 1.71967C4.42098 1.86032 4.5 2.05109 4.5 2.25C4.5 4.2165 6.27825 4.8975 7.6305 5.13075C7.13139 4.24579 6.83093 3.26278 6.75 2.25C6.75 1.65326 6.98705 1.08097 7.40901 0.65901C7.83097 0.237053 8.40326 0 9 0C9.59674 0 10.169 0.237053 10.591 0.65901C11.0129 1.08097 11.25 1.65326 11.25 2.25C11.1691 3.26278 10.8686 4.24579 10.3695 5.13075C11.7218 4.8975 13.5 4.2165 13.5 2.25C13.5 2.05109 13.579 1.86032 13.7197 1.71967C13.8603 1.57902 14.0511 1.5 14.25 1.5C14.4489 1.5 14.6397 1.57902 14.7803 1.71967C14.921 1.86032 15 2.05109 15 2.25C15.0161 2.81506 14.9077 3.37674 14.6824 3.8952C14.4572 4.41366 14.1206 4.8762 13.6965 5.25H15C15.7956 5.25 16.5587 5.56607 17.1213 6.12868C17.6839 6.69129 18 7.45435 18 8.25ZM8.25 2.25C8.34054 3.04712 8.59595 3.81668 9 4.50975C9.40405 3.81668 9.65946 3.04712 9.75 2.25C9.75 2.05109 9.67098 1.86032 9.53033 1.71967C9.38968 1.57902 9.19891 1.5 9 1.5C8.80109 1.5 8.61032 1.57902 8.46967 1.71967C8.32902 1.86032 8.25 2.05109 8.25 2.25ZM9.75 18H12.75C13.2425 18 13.7301 17.903 14.1851 17.7145C14.64 17.5261 15.0534 17.2499 15.4017 16.9016C15.7499 16.5534 16.0261 16.14 16.2145 15.6851C16.403 15.2301 16.5 14.7425 16.5 14.25V11.25H9.75V18Z"
                                                        fill="#687894"
                                                    ></path>
                                                </svg>
                                            </div>
                                            <input
                                                type="text"
                                                :placeholder="
                                                    $t('deposit.promocode')
                                                "
                                                autocomplete="off"
                                                name="promocode"
                                                class="inputAmount"
                                                v-model="promocodeValue"
                                            />
                                        </div>
                                    </div>
                                </form>
                                <button
                                    :class="{
                                        'controls radius-8 size--small-deposit full-width button': true,
                                        'color--green-lite': success, // если success true
                                        'color--red-lite': !success, // если success false
                                    }"
                                >
                                    <div class="button__content">
                                        <div
                                            v-if="message"
                                            class="deposit__btn-text"
                                        >
                                            {{ message }}
                                        </div>
                                        <div v-else class="deposit__btn-text">
                                            Ваш бонус 0% к депозиту
                                        </div>
                                    </div>
                                </button>
                                <div class="form__submit" @click="createOrder">
                                    <button
                                        class="controls radius-14 color--blue-gradient size--wide full-width button"
                                    >
                                        <div class="button__content">
                                            <div class="favorite__btn-text">
                                                {{ $t("deposit.order") }}
                                            </div>
                                        </div>
                                    </button>
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
import axios from "axios";

export default {
    data() {
        return {
            paymentMethods: [],
            cryptoMethods: [],
            selectedMethod: null,
            depositSum: null,
            promocodeValue: "",
            userId: null,
            active: false,
            message: "",
            percent: null,
            success: true,
            selectedCurrency: "RUB",
            currencies: [
                { code: "RUB", icon: "/assets/icons/rub.svg" },
                { code: "USD", icon: "/assets/icons/usd.svg" },
                { code: "UAH", icon: "/assets/icons/uah.svg" },
            ],
            conversionRates: {
                RUB: 1,
                USD: 90,
                UAH: 2.0927111499,
            },
        };
    },
    metaInfo() {
        return {
            title: `SPACEDROP - ДЕПОЗИТ`,
        };
    },
    mounted() {
        this.$root.$on("openPaymentModal", () => {
            this.active = true;
        });
        this.fetchPaymentMethods();
    },
    watch: {
        depositSum(newVal) {
            this.depositSum = newVal;
        },
        percent(newVal) {
            this.percent = newVal;
        },
        promocodeValue(newValue) {
            if (newValue.length > 0) {
                this.checkPromocode();
            }
        },
    },

    computed: {
        selectedMinDep() {
            const method = this.paymentMethods.find(
                (m) => m.name === this.selectedMethod
            );
            return method ? method.min_dep : null;
        },
        promoPercent() {
            const convertedSum = parseFloat(this.convertedSum) || 0;
            const percent = parseFloat(this.percent) / 100 || 0;
            const bonus = convertedSum * percent;
            const total = convertedSum + bonus;
            return total.toFixed(2);
        },
        convertedSum() {
            const depositSum = parseFloat(this.depositSum) || 0;
            const rate = this.conversionRates[this.selectedCurrency] || 1;
            const converted = Math.round(depositSum * rate);
            return converted;
        },
    },
    methods: {
        async fetchPaymentMethods() {
            try {
                const response = await axios.get("/payment/get", {
                    params: {
                        currency: this.selectedCurrency,
                    },
                });
                if (response.data.success) {
                    this.paymentMethods = response.data.paymentMethods;
                    this.cryptoMethods = response.data.cryptoMethods;
                } else {
                    this.$toast.error(response.data.message);
                }
            } catch (error) {
                console.error("Ошибка при запросе методов оплаты:", error);
            }
        },
        async cryptoCloud() {
            await this.axios.post(`/payment/create/cryptocloud`).then((res) => {
                const result = res.data;
            });
        },
        setDepositSum(sum) {
            this.depositSum = sum;
        },

        selectMethod(methodName) {
            this.selectedMethod = methodName;
        },
        selectCurrency(code) {
            this.selectedCurrency = code;
            this.fetchPaymentMethods();
        },
        async checkPromocode() {
            // Ждем 3 секунды перед отправкой запроса
            try {
                const response = await axios.post(
                    "/payment/promocode/approve",
                    {
                        promocode: this.promocodeValue,
                    }
                );

                this.success = response.data.success;

                if (response.data.success) {
                    this.message = response.data.message;
                    this.percent = response.data.percent;
                } else {
                    this.message = response.data.message;
                }
            } catch (error) {
                console.error("Ошибка при проверке промокода:", error);
                this.message = "Произошла ошибка при проверке промокода.";
            }
        },

        async createOrder() {
            if (!this.selectedMethod) {
                this.$toast.error("Выберите метод оплаты!");
                return;
            }

            // Вызов API для создания заказа
            const requestData = {
                method_name: this.selectedMethod,
                sum: this.depositSum,
                promocode: this.promocodeValue,
                user_id: this.$root.user.id,
            };

            const apiUrl =
                this.paymentMethods.find(
                    (method) => method.name === this.selectedMethod
                )?.apiUrl ||
                this.cryptoMethods.find(
                    (method) => method.name === this.selectedMethod
                )?.apiUrl;

            if (!apiUrl) {
                this.$toast.error(
                    "Не найден API URL для выбранного метода оплаты!"
                );
                return;
            }

            try {
                const response = await axios.post(apiUrl, requestData);

                if (response.data.success) {
                    this.$toast.success("Заказ успешно создан!");

                    window.location.href = response.data.url;
                } else {
                    this.$toast.error(response.data.message);
                }
            } catch (error) {
                console.error("Ошибка при создании заказа:", error);
            }
        },
    },
};
</script>
