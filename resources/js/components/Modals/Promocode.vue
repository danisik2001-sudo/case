<template>
    <div
        class="modals rules-modals"
        v-show="active"
        :class="{ opened: active }"
    >
        <button type="button" class="abs-link"></button>
        <div class="modals-content">
            <div class="modals-content-header">
                <div class="modals-content-header-title">
                    <svg
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <g clip-path="url(#clip0_149_45597)">
                            <path
                                d="M2 15H11V24H7C5.67392 24 4.40215 23.4732 3.46447 22.5355C2.52678 21.5979 2 20.3261 2 19V15ZM24 11C24 11.5304 23.7893 12.0391 23.4142 12.4142C23.0391 12.7893 22.5304 13 22 13H13V8.957C12.664 8.983 12.329 9 12 9C11.671 9 11.336 8.983 11 8.957V13H2C1.46957 13 0.960859 12.7893 0.585786 12.4142C0.210714 12.0391 0 11.5304 0 11C0 9.93913 0.421427 8.92172 1.17157 8.17157C1.92172 7.42143 2.93913 7 4 7H5.738C5.1726 6.5016 4.7238 5.88488 4.42344 5.1936C4.12307 4.50232 3.97851 3.75341 4 3C4 2.73478 4.10536 2.48043 4.29289 2.29289C4.48043 2.10536 4.73478 2 5 2C5.26522 2 5.51957 2.10536 5.70711 2.29289C5.89464 2.48043 6 2.73478 6 3C6 5.622 8.371 6.53 10.174 6.841C9.50852 5.66105 9.10791 4.35037 9 3C9 2.20435 9.31607 1.44129 9.87868 0.87868C10.4413 0.31607 11.2044 0 12 0C12.7956 0 13.5587 0.31607 14.1213 0.87868C14.6839 1.44129 15 2.20435 15 3C14.8921 4.35037 14.4915 5.66105 13.826 6.841C15.629 6.53 18 5.622 18 3C18 2.73478 18.1054 2.48043 18.2929 2.29289C18.4804 2.10536 18.7348 2 19 2C19.2652 2 19.5196 2.10536 19.7071 2.29289C19.8946 2.48043 20 2.73478 20 3C20.0215 3.75341 19.8769 4.50232 19.5766 5.1936C19.2762 5.88488 18.8274 6.5016 18.262 7H20C21.0609 7 22.0783 7.42143 22.8284 8.17157C23.5786 8.92172 24 9.93913 24 11ZM11 3C11.1207 4.06283 11.4613 5.08891 12 6.013C12.5387 5.08891 12.8793 4.06283 13 3C13 2.73478 12.8946 2.48043 12.7071 2.29289C12.5196 2.10536 12.2652 2 12 2C11.7348 2 11.4804 2.10536 11.2929 2.29289C11.1054 2.48043 11 2.73478 11 3ZM13 24H17C17.6566 24 18.3068 23.8707 18.9134 23.6194C19.52 23.3681 20.0712 22.9998 20.5355 22.5355C20.9998 22.0712 21.3681 21.52 21.6194 20.9134C21.8707 20.3068 22 19.6566 22 19V15H13V24Z"
                                fill="url(#paint0_linear_149_45597)"
                            />
                        </g>
                        <defs>
                            <linearGradient
                                id="paint0_linear_149_45597"
                                x1="12"
                                y1="0"
                                x2="12"
                                y2="24"
                                gradientUnits="userSpaceOnUse"
                            >
                                <stop stop-color="#5CB1FF" />
                                <stop offset="1" stop-color="#396CF4" />
                            </linearGradient>
                            <clipPath id="clip0_149_45597">
                                <rect width="24" height="24" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>

                    {{ $t("promocode.title") }}
                </div>

                <button
                    type="button"
                    class="modals-close-btn"
                    @click="active = false"
                >
                    <i></i>
                </button>
            </div>
            <div class="modals-content-desc-offer">
                <span> {{ $t("promocode.desc") }} </span>
            </div>

            <div class="trade_form__wrapper">
                <form class="trade_link__form" @submit.prevent="applyPromocode">
                    <div class="trade_form__fields">
                        <div class="trade_form__info">
                            <div class="trade_form__info-title uppercase">
                                {{ $t("promocode.title") }}
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
                                    />
                                </svg>
                            </div>
                            <input
                                type="text"
                                v-model="promocode"
                                :placeholder="$t('promocode.title')"
                                class="inputTrade"
                                autocomplete="off"
                                name="promocode"
                            />
                        </div>
                    </div>
                    <div class="form-submit">
                        <button type="submit" class="apply">
                            <span class="uppercase">
                                {{ $t("promocode.apply") }}</span
                            >
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";

export default {
    data() {
        return {
            active: false,
            promocode: "",
        };
    },
    mounted() {
        this.$root.$on("PromocodeUser", () => {
            this.active = true;
        });
    },
    methods: {
        async applyPromocode() {
            axios
                .post("/case/promocode", {
                    promocode: this.promocode,
                })
                .then((response) => {
                    if (response.data.success) {
                        this.$toast.success(response.data.message);
                        this.active = false;
                    } else {
                        this.$toast.error(response.data.message);
                    }
                })
                .catch((error) => {
                    this.message = "An error occurred. Please try again.";
                });
        },
    },
};
</script>
