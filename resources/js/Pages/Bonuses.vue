<template>
    <div class="container">
        <div class="missions__header">
            <svg
                width="18"
                height="18"
                viewBox="0 0 18 18"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <g clip-path="url(#clip0_118_1636)">
                    <path
                        d="M9 11.2444C7.75737 11.2444 6.75 12.2518 6.75 13.4944V17.9944H11.25V13.4944C11.25 12.2518 10.2426 11.2444 9 11.2444Z"
                        fill="url(#paint0_linear_118_1636)"
                    />
                    <path
                        d="M12.75 13.4944V17.9944H15.75C16.9926 17.9944 18 16.987 18 15.7444V8.90367C18.0002 8.51403 17.8488 8.13962 17.5777 7.85967L11.2043 0.969396C10.0797 -0.247362 8.18167 -0.322069 6.96491 0.802509C6.90711 0.855947 6.85143 0.911599 6.79802 0.969396L0.435762 7.85742C0.156551 8.13853 -0.000105416 8.51871 5.32206e-08 8.91492V15.7444C5.32206e-08 16.987 1.00737 17.9944 2.25 17.9944H5.24999V13.4944C5.26402 11.4493 6.9152 9.77924 8.9088 9.73114C10.9691 9.68143 12.7343 11.3799 12.75 13.4944Z"
                        fill="url(#paint1_linear_118_1636)"
                    />
                    <path
                        d="M9 11.2444C7.75737 11.2444 6.75 12.2518 6.75 13.4944V17.9944H11.25V13.4944C11.25 12.2518 10.2426 11.2444 9 11.2444Z"
                        fill="url(#paint2_linear_118_1636)"
                    />
                </g>
                <defs>
                    <linearGradient
                        id="paint0_linear_118_1636"
                        x1="9"
                        y1="11.2444"
                        x2="9"
                        y2="17.9944"
                        gradientUnits="userSpaceOnUse"
                    >
                        <stop stop-color="#5CB1FF" />
                        <stop offset="1" stop-color="#396CF4" />
                    </linearGradient>
                    <linearGradient
                        id="paint1_linear_118_1636"
                        x1="9"
                        y1="0.00561523"
                        x2="9"
                        y2="17.9944"
                        gradientUnits="userSpaceOnUse"
                    >
                        <stop stop-color="#5CB1FF" />
                        <stop offset="1" stop-color="#396CF4" />
                    </linearGradient>
                    <linearGradient
                        id="paint2_linear_118_1636"
                        x1="9"
                        y1="11.2444"
                        x2="9"
                        y2="17.9944"
                        gradientUnits="userSpaceOnUse"
                    >
                        <stop stop-color="#5CB1FF" />
                        <stop offset="1" stop-color="#396CF4" />
                    </linearGradient>
                    <clipPath id="clip0_118_1636">
                        <rect width="18" height="18" fill="white" />
                    </clipPath>
                </defs>
            </svg>
            <svg
                width="18"
                height="18"
                viewBox="0 0 18 18"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M10.2737 9L6.92385 13.0199C6.65868 13.3381 6.70167 13.811 7.01988 14.0762C7.33809 14.3413 7.81101 14.2983 8.07618 13.9801L11.8262 9.48013C12.058 9.202 12.058 8.79799 11.8262 8.51986L8.07618 4.01986C7.81101 3.70165 7.33809 3.65866 7.01988 3.92383C6.70167 4.189 6.65868 4.66193 6.92385 4.98013L10.2737 9Z"
                    fill="#687894"
                />
            </svg>
            <span class="uppercase">Бонусы</span>
        </div>
        <div class="bonuses_main__wrapper">
            <div class="bonus__heading_wrapper">
                <div class="heading__title uppercase">
                    {{ $t("bonuses.title") }}
                </div>
                <div class="heading__sub_title">
                    {{ $t("bonuses.ot") }} <span>caseblaze</span>
                </div>
                <div class="heading__desc text color--inherit variant--h3">
                    {{ $t("bonuses.text") }}
                    <span>{{ regday }} {{ $t("bonuses.text1") }},</span>
                    {{ $t("bonuses.text2") }}
                </div>
            </div>
        </div>
        <div class="bonuses__background"></div>
        <div class="bonuses_navigation__wrapper">
            <div class="bonuses_navigation">
                <button class="navigation__item" @click="activeTab = 1">
                    <div class="nav_item__content">
                        <div class="nav_item__title">
                            <div
                                class="text color--inherit variant--h2 uppercase"
                            >
                                {{ $t("bonuses.item") }}
                            </div>
                        </div>
                        <div class="nav_item__sub_title">
                            <div class="text color--inherit variant--h5">
                                {{ $t("bonuses.itemDesc") }}
                            </div>
                        </div>
                    </div>
                    <div class="nav_item__image_wrapper">
                        <img
                            src="/assets/bonuses/navigation/nav-cases.png"
                            alt="nav image"
                            class="nav_item__image"
                        />
                    </div>
                </button>
                <button class="navigation__item" @click="activeTab = 2">
                    <div class="nav_item__content">
                        <div class="nav_item__title">
                            <div
                                class="text color--inherit variant--h2 uppercase"
                            >
                                {{ $t("bonuses.item1") }}
                            </div>
                        </div>
                        <div class="nav_item__sub_title">
                            <div class="text color--inherit variant--h5">
                                {{ $t("bonuses.item1Desc") }}
                            </div>
                        </div>
                    </div>
                    <div class="nav_item__image_wrapper">
                        <img
                            src="/assets/bonuses/navigation/nav-bonus.png"
                            alt="nav image"
                            class="nav_item__image"
                        />
                    </div>
                </button>
            </div>
        </div>
        <div class="bonuses_main__wrapper" v-show="activeTab === 2">
            <div class="daily_bonus">
                <div class="daily_bonus__left_wrapper">
                    <div class="daily_bonus__heading">
                        <div class="heading__title">
                            <svg
                                width="40"
                                height="40"
                                viewBox="0 0 40 40"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M33.3334 19.9997V29.9997C33.3334 33.683 30.35 36.6663 26.6667 36.6663H13.3334C9.65002 36.6663 6.66669 33.683 6.66669 29.9997V19.9997C6.66669 19.083 7.41669 18.333 8.33335 18.333H11.6167C12.5334 18.333 13.2834 19.083 13.2834 19.9997V25.233C13.2834 26.4663 13.9667 27.5997 15.05 28.183C15.5334 28.4497 16.0667 28.583 16.6167 28.583C17.25 28.583 17.8834 28.3997 18.4334 28.033L20.0167 26.9997L21.4834 27.983C22.5 28.6663 23.8 28.7497 24.8834 28.1663C25.9834 27.583 26.6667 26.4663 26.6667 25.2163V19.9997C26.6667 19.083 27.4167 18.333 28.3334 18.333H31.6667C32.5834 18.333 33.3334 19.083 33.3334 19.9997Z"
                                    fill="url(#paint0_linear_4077_25700)"
                                />
                                <path
                                    d="M35.8334 11.6663V13.333C35.8334 15.1663 34.95 16.6663 32.5 16.6663H7.50002C4.95002 16.6663 4.16669 15.1663 4.16669 13.333V11.6663C4.16669 9.83301 4.95002 8.33301 7.50002 8.33301H32.5C34.95 8.33301 35.8334 9.83301 35.8334 11.6663Z"
                                    fill="url(#paint1_linear_4077_25700)"
                                />
                                <path
                                    d="M19.4 8.33372H10.2C9.63336 7.71706 9.65003 6.76706 10.25 6.16706L12.6167 3.80039C13.2334 3.18372 14.25 3.18372 14.8667 3.80039L19.4 8.33372Z"
                                    fill="url(#paint2_linear_4077_25700)"
                                />
                                <path
                                    d="M29.7833 8.33372H20.5833L25.1166 3.80039C25.7333 3.18372 26.75 3.18372 27.3666 3.80039L29.7333 6.16706C30.3333 6.76706 30.35 7.71706 29.7833 8.33372Z"
                                    fill="url(#paint3_linear_4077_25700)"
                                />
                                <path
                                    d="M23.2834 18.333C24.2 18.333 24.95 19.083 24.95 19.9997V25.2163C24.95 26.5497 23.4667 27.3497 22.3667 26.5997L20.8667 25.5997C20.3167 25.233 19.6 25.233 19.0334 25.5997L17.4667 26.633C16.3667 27.3663 14.9 26.5663 14.9 25.2497V19.9997C14.9 19.083 15.65 18.333 16.5667 18.333H23.2834Z"
                                    fill="url(#paint4_linear_4077_25700)"
                                />
                                <defs>
                                    <linearGradient
                                        id="paint0_linear_4077_25700"
                                        x1="20"
                                        y1="18.333"
                                        x2="20"
                                        y2="36.6663"
                                        gradientUnits="userSpaceOnUse"
                                    >
                                        <stop stop-color="#5CB1FF" />
                                        <stop offset="1" stop-color="#396CF4" />
                                    </linearGradient>
                                    <linearGradient
                                        id="paint1_linear_4077_25700"
                                        x1="20"
                                        y1="8.33301"
                                        x2="20"
                                        y2="16.6663"
                                        gradientUnits="userSpaceOnUse"
                                    >
                                        <stop stop-color="#5CB1FF" />
                                        <stop offset="1" stop-color="#396CF4" />
                                    </linearGradient>
                                    <linearGradient
                                        id="paint2_linear_4077_25700"
                                        x1="14.5936"
                                        y1="3.33789"
                                        x2="14.5936"
                                        y2="8.33372"
                                        gradientUnits="userSpaceOnUse"
                                    >
                                        <stop stop-color="#5CB1FF" />
                                        <stop offset="1" stop-color="#396CF4" />
                                    </linearGradient>
                                    <linearGradient
                                        id="paint3_linear_4077_25700"
                                        x1="25.3897"
                                        y1="3.33789"
                                        x2="25.3897"
                                        y2="8.33372"
                                        gradientUnits="userSpaceOnUse"
                                    >
                                        <stop stop-color="#5CB1FF" />
                                        <stop offset="1" stop-color="#396CF4" />
                                    </linearGradient>
                                    <linearGradient
                                        id="paint4_linear_4077_25700"
                                        x1="19.925"
                                        y1="18.333"
                                        x2="19.925"
                                        y2="26.9119"
                                        gradientUnits="userSpaceOnUse"
                                    >
                                        <stop stop-color="#5CB1FF" />
                                        <stop offset="1" stop-color="#396CF4" />
                                    </linearGradient>
                                </defs>
                            </svg>

                            <div class="text variant--h1">
                                {{ $t("bonuses.item1") }}
                            </div>
                        </div>
                    </div>
                    <div class="daily_bonus__body">
                        <div
                            v-for="day in 10"
                            :key="day"
                            :aria-selected="
                                isBonusReceived(day) ? 'true' : 'false'
                            "
                            class="daily_bonus__progress_item"
                        >
                            <div class="progress_item__day">
                                <div
                                    class="text color--inherit variant--h10 bold"
                                >
                                    {{ day }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="daily_bonus__right_wrapper">
                    <div class="bonus_card">
                        <div class="bonus_card__title">
                            <div
                                class="text color--gray variant--h15 bold uppercase"
                            >
                                {{ $t("bonuses.you_bonus") }}
                            </div>
                        </div>
                        <div
                            class="controls color--gray-secondary size--wide fit-content bonus_card__indicator"
                        >
                            <div
                                class="text color--inherit variant--h12 bold uppercase"
                            >
                                {{ amount || "?" }} ₽
                            </div>
                        </div>
                        <button
                            @click="loadBonus"
                            type="button"
                            class="controls color--blue-gradient size--wide full-width button"
                        >
                            <div class="button__content">
                                <div class="text color-white bold uppercase">
                                    {{ $t("bonuses.take") }}
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="bonus__cases" v-show="activeTab === 1">
            <div class="cases__inner">
                <div
                    class="bonus__card"
                    v-for="(box, index) in list"
                    :key="index"
                >
                    <router-link
                        :to="{
                            name: 'case',
                            params: {
                                url: box.url,
                            },
                        }"
                    >
                        <div class="case__label">
                            <div class="label__content">
                                <div class="label__text" data-special="false">
                                    {{ index + 1 }}
                                </div>
                            </div>
                        </div>
                        <div class="box__content">
                            <div class="case__image__wrapper">
                                <picture class="picture case__image"
                                    ><img
                                        :src="'/assets/img/cases/' + box.image"
                                        :alt="box.name"
                                        loading="lazy"
                                        decoding="async"
                                /></picture>
                            </div>
                            <div class="bottom__content">
                                <div class="timer__wrapper">
                                    <ul class="timer__items">
                                        <li class="timer_item_days">
                                            <div class="timer">
                                                <div
                                                    v-if="box.id === 4"
                                                    class="text variant--h20 color--inherit bold uppercase"
                                                >
                                                    1 {{ $t("bonuses.text1") }}
                                                </div>
                                                <div
                                                    v-if="box.id === 5"
                                                    class="text variant--h20 color--inherit bold uppercase"
                                                >
                                                    31 {{ $t("bonuses.text1") }}
                                                </div>
                                                <div
                                                    v-if="box.id === 6"
                                                    class="text variant--h20 color--inherit bold uppercase"
                                                >
                                                    61 {{ $t("bonuses.text1") }}
                                                </div>
                                                <div
                                                    v-if="box.id === 7"
                                                    class="text variant--h20 color--inherit bold uppercase"
                                                >
                                                    91 {{ $t("bonuses.text1") }}
                                                </div>
                                                <div
                                                    v-if="box.id === 8"
                                                    class="text variant--h20 color--inherit bold uppercase"
                                                >
                                                    121
                                                    {{ $t("bonuses.text1") }}
                                                </div>
                                            </div>
                                        </li>
                                        <div class="time">
                                            <li class="timer_item">
                                                <div class="timer">
                                                    <div
                                                        class="text variant--h20 color--inherit bold uppercase"
                                                    >
                                                        0
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="timer_item">
                                                <div class="timer">
                                                    <div
                                                        class="text variant--h20 color--inherit bold uppercase"
                                                    >
                                                        0
                                                    </div>
                                                </div>
                                            </li>
                                            <label>:</label>
                                            <li class="timer_item">
                                                <div class="timer">
                                                    <div
                                                        class="text variant--h20 color--inherit bold uppercase"
                                                    >
                                                        0
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="timer_item">
                                                <div class="timer">
                                                    <div
                                                        class="text variant--h20 color--inherit bold uppercase"
                                                    >
                                                        0
                                                    </div>
                                                </div>
                                            </li>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </router-link>
                </div>
            </div>
        </div>
        <div class="tasks">
            <div class="MainContainer__header">
                <div
                    class="text color--disabled variant--h1 align--center bold uppercase"
                >
                    {{ $t("bonuses.bonus") }}
                </div>
            </div>
            <div class="oneTimeTaskList">
                <button
                    aria-label="telegram"
                    class="oneTimeTask"
                    @click="openTg"
                >
                    <div class="oneTimeTask_imageWrapper">
                        <img
                            src="/assets/bonuses/one-time-bonuses/telegram.png"
                            alt="telegram"
                            loading="lazy"
                            class="task__image"
                        />
                    </div>
                    <div class="task__text">
                        {{ $t("bonuses.subscribe") }}
                        <p>{{ $t("bonuses.to") }} telegram (+5 ₽)</p>
                    </div>
                </button>

                <button
                    aria-label="vkontakte"
                    class="oneTimeTask"
                    @click="openVk"
                >
                    <div class="oneTimeTask_imageWrapper">
                        <img
                            src="/assets/bonuses/one-time-bonuses/vkontakte.png"
                            alt="vkontakte"
                            loading="lazy"
                            class="task__image"
                        />
                    </div>
                    <div class="task__text">
                        {{ $t("bonuses.subscribe") }}
                        <p>{{ $t("bonuses.to") }} vkontakte (+5 ₽)</p>
                    </div>
                </button>
            </div>
        </div>
        <DiscordModal />
        <InstModal />
        <TgModal />
        <TikTokModal />
        <VkModal />
    </div>
</template>

<script>
import axios from "axios";
import DiscordModal from "../components/Modals/DiscordModal.vue";
import InstModal from "../components/Modals/InstModal.vue";
import TgModal from "../components/Modals/TgModal.vue";
import TikTokModal from "../components/Modals/TikTokModal.vue";
import VkModal from "../components/Modals/VkModal.vue";

export default {
    components: { DiscordModal, InstModal, TgModal, TikTokModal, VkModal },
    data() {
        return {
            bonusForToday: 0,
            bonuses: [],
            list: [],
            activeTab: 1,
            regday: 0,
            amount: null,
            claimed_bonuses: [],
        };
    },
    methods: {
        setInfo(data) {
            if (data.cases !== undefined) {
                this.cases = data.cases;
            }
            if (data.regday !== undefined) {
                this.regday = data.regday;
            }
            if (data.bonus_for_today !== undefined) {
                this.bonusForToday = data.bonus_for_today;
            }
            if (data.bonuses !== undefined) {
                this.bonuses = data.bonuses;
            }
        },
        async loadBonus() {
            const request = await axios.post("/bonus/claim-bonus");

            if (request.data.type === "success") {
                this.$toast.success(request.data.message);
                this.amount = request.data.amount;
                this.claimed_bonuses = request.data.claimed_bonuses;
            } else {
                this.$toast.error(request.data.message);
            }

            this.setInfo(request.data);
        },
        async getBonusHistory() {
            const request = await axios.post("/bonus/getBonusHistory");

            if (request.data.type === "success") {
                this.amount = request.data.amount;
                this.claimed_bonuses = request.data.claimed_bonuses;
            } else {
                this.$toast.error(request.data.message);
            }

            this.setInfo(request.data);
        },
        isBonusReceived(day) {
            return this.claimed_bonuses.some((bonus) => bonus.day === day);
        },

        async getBoxes() {
            await this.axios.get("/case/getAll").then((res) => {
                const result = res.data;
                // Фильтруем категории, чтобы оставить только `partners`, и затем собираем их кейсы
                this.list = result.list
                    .filter((category) => category.name === "partners") // Фильтруем только категорию `partners`
                    .flatMap((category) => category.boxes); // Извлекаем кейсы из отфильтрованной категории
                console.log("list", this.list);
            });
        },

        openDs() {
            this.$root.$emit("discordBlock");
        },
        openInst() {
            this.$root.$emit("instBlock");
        },
        openTg() {
            this.$root.$emit("tgBlock");
        },
        openTT() {
            this.$root.$emit("tikBlock");
        },
        openVk() {
            this.$root.$emit("vkBlock");
        },
    },
    mounted() {
        this.getBoxes();
        this.getBonusHistory();
    },
};
</script>
