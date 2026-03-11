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
                        <g clip-path="url(#clip0_4130_30647)">
                            <path
                                d="M10.6566 13.3271C8.67998 13.3271 2.86251 13.3271 2.86251 13.3271C2.24495 13.3271 1.73962 13.8324 1.73962 14.45V22.8777C1.73962 23.4953 2.24495 24.0005 2.86251 24.0005C2.86251 24.0005 8.80171 24.0005 10.7877 24.0005C11.0518 24.0005 11.0518 23.7167 11.0518 23.7167V13.7087C11.0518 13.7087 11.0517 13.3271 10.6566 13.3271Z"
                                fill="url(#paint0_linear_4130_30647)"
                            />
                            <path
                                d="M21.1376 13.3271C21.1376 13.3271 15.2979 13.3271 13.3515 13.3271C12.8772 13.3271 12.9482 13.821 12.9482 13.821V23.7259C12.9482 23.7259 12.9444 24.0003 13.2296 24.0003C15.2066 24.0003 21.1375 24.0003 21.1375 24.0003C21.755 24.0003 22.2603 23.495 22.2603 22.8775V14.45C22.2605 13.8324 21.7552 13.3271 21.1376 13.3271Z"
                                fill="url(#paint1_linear_4130_30647)"
                            />
                            <path
                                d="M11.0517 6.69591C11.0517 6.69591 11.0517 6.31543 10.6757 6.31543C8.42427 6.31543 1.59444 6.31543 1.59444 6.31543C0.97688 6.31543 0.471558 6.82075 0.471558 7.43823V10.9433C0.471558 11.5608 0.97688 12.0661 1.59444 12.0661C1.59444 12.0661 8.45487 12.0661 10.7064 12.0661C11.0517 12.0661 11.0517 11.7666 11.0517 11.7666V6.69591Z"
                                fill="url(#paint2_linear_4130_30647)"
                            />
                            <path
                                d="M22.4054 6.31543C22.4054 6.31543 15.5728 6.31543 13.2952 6.31543C12.9482 6.31543 12.9482 6.64601 12.9482 6.64601V11.7736C12.9482 11.7736 12.9482 12.0661 13.37 12.0661C15.6288 12.0661 22.4054 12.0661 22.4054 12.0661C23.023 12.0661 23.5283 11.5608 23.5283 10.9433V7.43823C23.5283 6.82075 23.023 6.31543 22.4054 6.31543Z"
                                fill="url(#paint3_linear_4130_30647)"
                            />
                            <path
                                d="M7.23255 5.48435C6.71881 5.48435 6.24956 5.44361 5.83807 5.36319C4.7929 5.159 4.07455 4.76158 3.64196 4.14836C3.25436 3.59878 3.13574 2.92125 3.28929 2.13451C3.55827 0.758025 4.48269 0 5.89206 0C6.19033 0 6.51789 0.0344408 6.86573 0.102423C7.75056 0.275281 8.88228 0.782649 9.89317 1.4596C11.6083 2.60826 11.6931 3.32235 11.6077 3.75961C11.4821 4.40212 10.8816 4.86122 9.77168 5.16326C9.02184 5.36728 8.09636 5.48435 7.23255 5.48435ZM5.89214 1.79967C5.34633 1.79967 5.15874 1.95216 5.05575 2.47957C4.97149 2.91078 5.07775 3.06139 5.1126 3.11088C5.25855 3.31785 5.63871 3.49046 6.18313 3.59673C6.4769 3.65416 6.83988 3.68451 7.23247 3.68451C8.09578 3.68451 8.85634 3.5537 9.36101 3.41062C9.39774 3.40023 9.45476 3.35679 9.39365 3.32039C8.73388 2.78291 7.52681 2.06522 6.52067 1.86864C6.28629 1.82299 6.07474 1.79967 5.89214 1.79967Z"
                                fill="url(#paint4_linear_4130_30647)"
                            />
                            <path
                                d="M16.7934 5.48427C16.7934 5.48427 16.7934 5.48427 16.7933 5.48427C15.9295 5.48427 15.0041 5.3672 14.2542 5.16317C13.1443 4.86122 12.5438 4.40204 12.4182 3.75961C12.3329 3.32235 12.4176 2.60826 14.1328 1.4596C15.1436 0.782649 16.2753 0.275281 17.1603 0.102423C17.5081 0.0344408 17.8357 0 18.1337 0C19.5434 0 20.4677 0.758107 20.7365 2.13459C20.8902 2.92125 20.7716 3.59878 20.384 4.14836C19.9514 4.76167 19.2331 5.159 18.1877 5.36319C17.7764 5.44345 17.3071 5.48427 16.7934 5.48427ZM14.6467 3.30918C14.5882 3.34313 14.6165 3.39671 14.6468 3.40547C15.1512 3.55051 15.9198 3.68451 16.7933 3.68451C17.186 3.68451 17.5489 3.65416 17.8427 3.59673C18.387 3.49038 18.7674 3.31785 18.9132 3.11088C18.9482 3.06139 19.0546 2.91078 18.9701 2.47957C18.8672 1.95216 18.6795 1.79967 18.1336 1.79967C17.9511 1.79967 17.7397 1.82291 17.5052 1.86872C16.4989 2.06522 15.3064 2.77163 14.6467 3.30918Z"
                                fill="url(#paint5_linear_4130_30647)"
                            />
                        </g>
                        <defs>
                            <linearGradient
                                id="paint0_linear_4130_30647"
                                x1="6.39572"
                                y1="13.3271"
                                x2="6.39572"
                                y2="24.0005"
                                gradientUnits="userSpaceOnUse"
                            >
                                <stop stop-color="#75CB7D" />
                                <stop offset="1" stop-color="#419049" />
                            </linearGradient>
                            <linearGradient
                                id="paint1_linear_4130_30647"
                                x1="17.6024"
                                y1="13.3271"
                                x2="17.6024"
                                y2="24.0003"
                                gradientUnits="userSpaceOnUse"
                            >
                                <stop stop-color="#75CB7D" />
                                <stop offset="1" stop-color="#419049" />
                            </linearGradient>
                            <linearGradient
                                id="paint2_linear_4130_30647"
                                x1="5.76162"
                                y1="6.31543"
                                x2="5.76162"
                                y2="12.0661"
                                gradientUnits="userSpaceOnUse"
                            >
                                <stop stop-color="#75CB7D" />
                                <stop offset="1" stop-color="#419049" />
                            </linearGradient>
                            <linearGradient
                                id="paint3_linear_4130_30647"
                                x1="18.2383"
                                y1="6.31543"
                                x2="18.2383"
                                y2="12.0661"
                                gradientUnits="userSpaceOnUse"
                            >
                                <stop stop-color="#75CB7D" />
                                <stop offset="1" stop-color="#419049" />
                            </linearGradient>
                            <linearGradient
                                id="paint4_linear_4130_30647"
                                x1="7.42697"
                                y1="0"
                                x2="7.42697"
                                y2="5.48435"
                                gradientUnits="userSpaceOnUse"
                            >
                                <stop stop-color="#75CB7D" />
                                <stop offset="1" stop-color="#419049" />
                            </linearGradient>
                            <linearGradient
                                id="paint5_linear_4130_30647"
                                x1="16.5989"
                                y1="0"
                                x2="16.5989"
                                y2="5.48427"
                                gradientUnits="userSpaceOnUse"
                            >
                                <stop stop-color="#75CB7D" />
                                <stop offset="1" stop-color="#419049" />
                            </linearGradient>
                            <clipPath id="clip0_4130_30647">
                                <rect width="24" height="24" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>

                    {{ $t("socialModals.title") }}
                </div>
                <button
                    type="button"
                    class="modals-close-btn"
                    @click="active = false"
                >
                    <i></i>
                </button>
            </div>
            <div class="modals-content-info-text">
                {{ $t("socialModals.desc") }}
            </div>
            <div class="section__wrapper">
                <div class="checkbox__wrapper">
                    <label
                        for="nicknameStatus"
                        :aria-checked="isChecked ? 'true' : 'false'"
                        :aria-disabled="isDisabled ? 'true' : 'false'"
                        class="input__checkbox"
                        ><input
                            id="nicknameStatus"
                            type="checkbox"
                            class="checkbox"
                            v-model="isChecked" />
                        <div
                            class="checkbox__overloaded color--gold size--small undefined"
                        ></div></label
                    ><label class="checkbox__label"
                        ><div class="section__heading">
                            <div class="text color--inherit variant--h5">
                                {{ $t("socialModals.condition") }}
                                <span class="subscription__link"
                                    ><a
                                        @click="toggleCheckStatus"
                                        href="https://vk.com/caseblaze"
                                        target="_blank"
                                        rel="noreferrer"
                                        >Vkontakte</a
                                    ></span
                                >
                            </div>
                        </div></label
                    >
                </div>
            </div>
            <div class="modals-content-info-desc">
                <span> {{ $t("socialModals.important") }}</span>
                {{ $t("socialModals.desc2") }}
            </div>
            <div class="form-submit">
                <a
                    href="https://vk.com/caseblaze"
                    target="_blank"
                    rel="noreferrer"
                    v-if="!isChecked"
                    @click="toggleCheckStatus"
                    class="apply"
                >
                    <span class="uppercase" style="color: #fff"
                        >Подписаться</span
                    >
                </a>
                <button
                    v-else
                    type="submit"
                    :disabled="isDisabled"
                    class="apply"
                    @click="claimBonus"
                >
                    <span class="uppercase">Я ВЫПОЛНИЛ УСЛОВИЯ</span>
                </button>
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
            isChecked: false,
            isDisabled: true,
        };
    },
    mounted() {
        this.$root.$on("vkBlock", () => {
            this.active = true;
        });
    },
    methods: {
        toggleCheckStatus() {
            this.isChecked = !this.isChecked;
            this.isDisabled = !this.isChecked;
        },
        claimBonus() {
            axios
                .post("/bonus/subscription/vk")
                .then((response) => {
                    if (response.data.type === "success") {
                        this.$toast.success(
                            response.data.msg +
                                " Получено: " +
                                response.data.amount +
                                " ₽ на баланс."
                        );
                    } else {
                        this.$toast.error(response.data.msg);
                    }
                    this.active = false;
                })
                .catch((error) => {
                    console.error(
                        "Произошла ошибка при получении бонуса:",
                        error.response ? error.response.data : error.message
                    );
                    this.$root.$notify({
                        type: "error",
                        text: "Произошла ошибка при получении бонуса. Пожалуйста, попробуйте снова позже.",
                    });
                    this.active = false;
                });
        },
    },
};
</script>
