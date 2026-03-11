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
                        width="25"
                        height="24"
                        viewBox="0 0 25 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <g clip-path="url(#clip0_149_45595)">
                            <path
                                d="M0.5 6.99999C0.5 6.73478 0.605357 6.48042 0.792893 6.29289C0.98043 6.10535 1.23478 5.99999 1.5 5.99999H18.5V2.63899C18.502 2.48345 18.5497 2.33193 18.6372 2.20333C18.7247 2.07474 18.8482 1.97477 18.9922 1.91589C19.1362 1.85702 19.2943 1.84185 19.4469 1.87228C19.5994 1.90271 19.7396 1.97738 19.85 2.08699L24.268 6.44799C24.3408 6.51989 24.3986 6.60553 24.4381 6.69995C24.4775 6.79436 24.4978 6.89567 24.4978 6.99799C24.4978 7.10032 24.4775 7.20162 24.4381 7.29604C24.3986 7.39045 24.3408 7.47609 24.268 7.54799L19.85 11.913C19.7396 12.0226 19.5994 12.0973 19.4469 12.1277C19.2943 12.1581 19.1362 12.143 18.9922 12.0841C18.8482 12.0252 18.7247 11.9252 18.6372 11.7967C18.5497 11.6681 18.502 11.5165 18.5 11.361V7.99999H1.5C1.23478 7.99999 0.98043 7.89464 0.792893 7.7071C0.605357 7.51956 0.5 7.26521 0.5 6.99999ZM23.5 16H6.5V12.639C6.49804 12.4834 6.45032 12.3319 6.36279 12.2033C6.27526 12.0747 6.1518 11.9748 6.00781 11.9159C5.86383 11.857 5.7057 11.8419 5.55314 11.8723C5.40059 11.9027 5.26038 11.9774 5.15 12.087L0.732 16.448C0.659194 16.5199 0.601388 16.6055 0.561935 16.6999C0.522482 16.7944 0.502166 16.8957 0.502166 16.998C0.502166 17.1003 0.522482 17.2016 0.561935 17.296C0.601388 17.3905 0.659194 17.4761 0.732 17.548L5.15 21.913C5.26038 22.0226 5.40059 22.0973 5.55314 22.1277C5.7057 22.1581 5.86383 22.143 6.00781 22.0841C6.1518 22.0252 6.27526 21.9252 6.36279 21.7967C6.45032 21.6681 6.49804 21.5165 6.5 21.361V18H23.5C23.7652 18 24.0196 17.8946 24.2071 17.7071C24.3946 17.5196 24.5 17.2652 24.5 17C24.5 16.7348 24.3946 16.4804 24.2071 16.2929C24.0196 16.1053 23.7652 16 23.5 16Z"
                                fill="url(#paint0_linear_149_45595)"
                            />
                        </g>
                        <defs>
                            <linearGradient
                                id="paint0_linear_149_45595"
                                x1="12.5"
                                y1="1.85698"
                                x2="12.5"
                                y2="22.143"
                                gradientUnits="userSpaceOnUse"
                            >
                                <stop stop-color="#75CB7D" />
                                <stop offset="1" stop-color="#419049" />
                            </linearGradient>
                            <clipPath id="clip0_149_45595">
                                <rect
                                    width="24"
                                    height="24"
                                    fill="white"
                                    transform="translate(0.5)"
                                />
                            </clipPath>
                        </defs>
                    </svg>

                    {{ $t("trade.url") }}
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
                <span>{{ $t("trade.desc") }} </span>
            </div>

            <div class="trade_form__wrapper">
                <form class="trade_link__form" data-gtm-form-interact-id="0">
                    <div class="trade_form__fields">
                        <div class="trade_form__info">
                            <div class="trade_form__info-title uppercase">
                                {{ $t("trade.link") }}
                            </div>
                            <div class="trade_form__info-href uppercase">
                                <a
                                    href="https://steamcommunity.com/my/tradeoffers/privacy#trade_offer_access_url"
                                    target="_blank"
                                >
                                    {{ $t("trade.where") }}
                                </a>
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
                                    <g clip-path="url(#clip0_149_45603)">
                                        <path
                                            d="M5.91994 12.078C5.48044 11.6393 5.48044 10.926 5.91994 10.4873C6.35944 10.0478 7.07119 10.0478 7.51069 10.4873C8.50519 11.4818 10.2407 11.4825 11.2352 10.4873L14.9769 6.74551C16.0037 5.71876 16.0037 4.04776 14.9769 3.02101C13.9502 1.99426 12.2792 1.99426 11.2524 3.02101C10.8129 3.46051 10.1012 3.46051 9.66169 3.02101C9.22219 2.58226 9.22219 1.86901 9.66169 1.43026C11.5652 -0.473987 14.6642 -0.473987 16.5677 1.43026C18.4719 3.33451 18.4719 6.43201 16.5677 8.33626L12.8259 12.078C11.8734 13.0305 10.6232 13.506 9.37294 13.506C8.12269 13.506 6.87169 13.0298 5.91994 12.078ZM4.88194 17.9978C6.13219 17.9978 7.38244 17.5215 8.33494 16.5698C8.77444 16.131 8.77444 15.4178 8.33494 14.979C7.89544 14.5395 7.18369 14.5395 6.74419 14.979C5.71669 16.0065 4.04569 16.0058 3.01969 14.979C1.99294 13.9523 1.99294 12.2813 3.01969 11.2545L6.74044 7.53376C7.76794 6.50626 9.43894 6.50626 10.4649 7.53376C10.9044 7.97326 11.6162 7.97326 12.0557 7.53376C12.4952 7.09501 12.4952 6.38176 12.0557 5.94301C10.1514 4.03876 7.05394 4.03876 5.14969 5.94301L1.42819 9.66376C-0.476063 11.568 -0.476063 14.6655 1.42819 16.5698C2.38069 17.5223 3.63169 17.9978 4.88194 17.9978Z"
                                            fill="#687894"
                                        />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_149_45603">
                                            <rect
                                                width="18"
                                                height="18"
                                                fill="white"
                                            />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <input
                                type="text"
                                :placeholder="$t('trade.enterLink')"
                                class="inputTrade"
                                autocomplete="off"
                                name="tradeLink"
                                v-model="tradeLink"
                                value=""
                                data-gtm-form-interact-field-id="0"
                            />
                        </div>
                    </div>
                </form>
            </div>

            <div class="form-submit">
                <button type="submit" class="apply" @click="saveTradeLink">
                    <span class="uppercase">{{ $t("trade.apply") }}</span>
                </button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            active: false,
            isChecked: false,
            isDisabled: true,
            tradeLink: "",
        };
    },
    mounted() {
        this.$root.$on("tradeUrl", () => {
            this.active = true;
        });
        this.getTrade();
    },
    methods: {
        toggleCheckStatus() {
            this.isChecked = !this.isChecked;
            this.isDisabled = !this.isChecked;
        },
        async getTrade() {
            await this.axios.post(`/user/profile`).then((res) => {
                const result = res.data;
                this.tradeLink = result.tradeLink;
            });
        },
        async saveTradeLink() {
            this.axios
                .post("/user/update-trade-link", {
                    link: this.tradeLink,
                })
                .then((res) => {
                    let data = res.data;

                    if (data.success) {
                        return this.$toast.success(data.message);
                    }

                    this.$toast.error(data.message);
                });
            this.active = false;
        },
    },
};
</script>
