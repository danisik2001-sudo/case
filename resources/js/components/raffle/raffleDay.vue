<template>
    <div class="giveawayCard">
        <div class="raffleItem__wrapper">
            <div class="raffle_card">
                <div class="top_side">
                    <div class="top_block">
                        <button class="raffle_prize_info green">
                            <div
                                class="raffle-h1 color-raffle-green uppercase noWrap"
                            >
                                {{ $t("raffleDay.title") }}
                            </div>
                        </button>
                        <div class="raffle_prize_stats">
                            <div class="raffle_prize_deposit">
                                <div class="text variant--h33">
                                    <span>{{ $t("raffleHour.dep") }}</span>
                                    {{ raffle.current.minDep }} ₽
                                </div>
                            </div>
                            <div class="raffle_prize_deposit">
                                <div class="text variant--h33">
                                    {{ raffle.current.users.length }}
                                </div>
                                <svg
                                    width="20"
                                    height="20"
                                    viewBox="0 0 20 20"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="icon variant--h6"
                                >
                                    <path
                                        d="M7.50008 1.66602C5.31675 1.66602 3.54175 3.44102 3.54175 5.62435C3.54175 7.76602 5.21675 9.49935 7.40008 9.57435C7.46675 9.56602 7.53341 9.56602 7.58342 9.57435C7.60008 9.57435 7.60841 9.57435 7.62508 9.57435C7.63341 9.57435 7.63341 9.57435 7.64175 9.57435C9.77508 9.49935 11.4501 7.76602 11.4584 5.62435C11.4584 3.44102 9.68341 1.66602 7.50008 1.66602Z"
                                        fill="#687894"
                                    />
                                    <path
                                        d="M11.7333 11.7914C9.4083 10.2414 5.61663 10.2414 3.27497 11.7914C2.21663 12.4997 1.6333 13.4581 1.6333 14.4831C1.6333 15.5081 2.21663 16.4581 3.26663 17.1581C4.4333 17.9414 5.96663 18.3331 7.49997 18.3331C9.0333 18.3331 10.5666 17.9414 11.7333 17.1581C12.7833 16.4497 13.3666 15.4997 13.3666 14.4664C13.3583 13.4414 12.7833 12.4914 11.7333 11.7914Z"
                                        fill="#687894"
                                    />
                                    <path
                                        d="M16.6583 6.11708C16.7916 7.73374 15.6416 9.15041 14.05 9.34208C14.0416 9.34208 14.0416 9.34208 14.0333 9.34208H14.0083C13.9583 9.34208 13.9083 9.34207 13.8666 9.35874C13.0583 9.40041 12.3166 9.14207 11.7583 8.66707C12.6166 7.90041 13.1083 6.75041 13.0083 5.50041C12.95 4.82541 12.7166 4.20874 12.3666 3.68374C12.6833 3.52541 13.05 3.42541 13.425 3.39208C15.0583 3.25041 16.5166 4.46708 16.6583 6.11708Z"
                                        fill="#687894"
                                    />
                                    <path
                                        d="M18.3251 13.8247C18.2584 14.633 17.7418 15.333 16.8751 15.808C16.0418 16.2663 14.9918 16.483 13.9501 16.458C14.5501 15.9163 14.9001 15.2413 14.9668 14.5247C15.0501 13.4913 14.5584 12.4997 13.5751 11.708C13.0168 11.2663 12.3668 10.9163 11.6584 10.658C13.5001 10.1247 15.8168 10.483 17.2418 11.633C18.0084 12.2497 18.4001 13.0247 18.3251 13.8247Z"
                                        fill="#687894"
                                    />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="center_block">
                        <div class="raffle_prize_image_wrapper">
                            <div class="raffle_prize_icon">
                                <div
                                    class="skinIcon__background"
                                    :class="[
                                        getItemRarityClass(
                                            raffle.current.itemInfo.rarity
                                        ),
                                    ]"
                                ></div>
                            </div>
                            <img
                                :srcset="
                                    'https://steamcommunity-a.akamaihd.net/economy/image/' +
                                    raffle.current.itemInfo.icon_url
                                "
                                :alt="raffle.current.itemInfo.market_hash_name"
                                class="raffle_prize_image"
                                loading="lazy"
                                decoding="async"
                            />
                        </div>
                    </div>
                    <div class="skinInfo_block">
                        <div class="name-h4">
                            <span
                                >{{
                                    getItemType(
                                        raffle.current.itemInfo.market_hash_name
                                    )
                                }}
                                |</span
                            >
                            {{
                                getItemName(
                                    raffle.current.itemInfo.market_hash_name
                                )
                            }}
                        </div>
                        <div class="skinInfo_price">
                            <div class="color-gold">
                                {{ raffle.current.itemInfo.price }} ₽
                            </div>
                        </div>
                    </div>
                    <div class="bottom_block">
                        <div class="raffle_prize_lastTime">
                            <div class="raffle_prize_strip"></div>
                            <div class="text variant--h20 noWrap">
                                {{ $t("raffleHour.time") }}
                            </div>
                            <div class="raffle_prize_strip"></div>
                        </div>
                        <div class="test" v-if="raffle.current.time">
                            <countdown :time="raffle.current.time">
                                <div class="raffle_timer" slot-scope="props">
                                    <div class="countDownTimer__wrapper">
                                        <div class="countDownTimer__section">
                                            <div class="countDownTimer__number">
                                                0
                                            </div>
                                            <div class="countDownTimer__number">
                                                0
                                            </div>
                                            <div class="countDownTimer__timer">
                                                {{ $t("raffleHour.day") }}
                                            </div>
                                        </div>
                                        <div class="countDownTimer__separator">
                                            :
                                        </div>
                                        <div class="countDownTimer__section">
                                            <div class="countDownTimer__number">
                                                {{
                                                    Math.floor(
                                                        props.totalHours / 10
                                                    )
                                                }}
                                            </div>
                                            <div class="countDownTimer__number">
                                                {{ props.totalHours % 10 }}
                                            </div>
                                            <div class="countDownTimer__timer">
                                                {{ $t("raffleHour.hour") }}
                                            </div>
                                        </div>
                                        <div class="countDownTimer__separator">
                                            :
                                        </div>
                                        <div class="countDownTimer__section">
                                            <div class="countDownTimer__number">
                                                {{
                                                    Math.floor(
                                                        props.minutes / 10
                                                    )
                                                }}
                                            </div>
                                            <div class="countDownTimer__number">
                                                {{ props.minutes % 10 }}
                                            </div>
                                            <div class="countDownTimer__timer">
                                                {{ $t("raffleHour.min") }}
                                            </div>
                                        </div>
                                        <div class="countDownTimer__separator">
                                            :
                                        </div>
                                        <div class="countDownTimer__section">
                                            <div class="countDownTimer__number">
                                                {{
                                                    Math.floor(
                                                        props.seconds / 10
                                                    )
                                                }}
                                            </div>
                                            <div class="countDownTimer__number">
                                                {{ props.seconds % 10 }}
                                            </div>
                                            <div class="countDownTimer__timer">
                                                {{ $t("raffleHour.sec") }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </countdown>
                        </div>
                        <button
                            v-on:click="open()"
                            type="button"
                            class="controls color--raffle--green-gradient size--raffle full-width button"
                        >
                            <div class="button__content uppercase deposit">
                                {{ $t("raffleHour.participate") }}
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="historyItem__wrapper">
            <div class="winner_cards_section">
                <div class="winner_card winner_card_title rarity--4">
                    <div class="text color--inherit variant--h20">
                        {{ $t("raffleHour.winners") }}
                    </div>
                </div>
                <div
                    v-for="(winner, index) in displayedWinners"
                    :key="index"
                    class="winner_card"
                >
                    <router-link
                        :to="{
                            name: 'user',
                            params: { id: winner.user.id },
                        }"
                        ><div class="avatar size--big">
                            <img
                                :src="
                                    winner.user.avatar || 'default-avatar.png'
                                "
                                :alt="
                                    winner.user.username ||
                                    'Неизвестный пользователь'
                                "
                                class="avatarImage"
                                loading="lazy"
                                decoding="async"
                            /></div
                    ></router-link>
                    <div class="winner_card_info">
                        <div class="info__skinName">
                            <span class="text variant--h20 noWrap">
                                {{
                                    getItemType(
                                        winner.itemInfo.market_hash_name || ""
                                    )
                                }}
                                | </span
                            ><span class="text variant--h20 noWrap">
                                {{
                                    getItemName(
                                        winner.itemInfo.market_hash_name || ""
                                    )
                                }}</span
                            >
                        </div>
                        <div class="winner_card_price">
                            <div class="color-gold">
                                {{ winner.itemInfo.price || "0.00" }} ₽
                            </div>
                        </div>
                        <div>
                            <div class="text variant--h11">
                                {{ winner.created_at | formatDate }}
                            </div>
                        </div>
                    </div>
                    <div class="winner_card_prize_wrapper">
                        <div class="winner_card_prize">
                            <div
                                class="bg_drop"
                                :class="[
                                    getItemRarityClass(
                                        winner.itemInfo.rarity || ''
                                    ),
                                ]"
                            ></div>
                            <div class="winner_card_image_wrapper">
                                <img
                                    :srcset="
                                        'https://steamcommunity-a.akamaihd.net/economy/image/' +
                                        winner.itemInfo.icon_url
                                    "
                                    :alt="
                                        winner.itemInfo.market_hash_name ||
                                        'Нет данных'
                                    "
                                    class="winner_card_image"
                                    loading="lazy"
                                    decoding="async"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <button
                    v-if="showLoadMoreButton"
                    @click="loadMoreWinners"
                    class="controls color--blue-light size--medium full-width button"
                    type="button"
                >
                    <div class="button__content">
                        <b class="text color--inherit variant--h7 uppercase"
                            >{{ $t("raffleHour.show") }}...</b
                        >
                    </div>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

import {
    getItemName,
    getItemRarityClass,
    getItemType,
} from "../../helpers/helper";

export default {
    data() {
        return {
            info: {
                status: false,
                place: "",
            },
            raffle: {
                current: {
                    itemInfo: {
                        icon_url: "",
                        market_hash_name: "",
                        price: "",
                        rarity: "",
                    },
                    limit: 0,
                    minDep: 0,
                    time: 0,
                    users: [],
                },
                last: {
                    winners: [],
                },
            },
            displayedWinners: [], // Победители, которые отображаются на странице
            winnersToLoad: 3, // Количество победителей для загрузки за один раз
            showLoadMoreButton: true, // Показать ли кнопку "Показать ещё"
        };
    },
    methods: {
        setInfo(data) {
            this.raffle.current.itemInfo.icon_url =
                data.raffle.current.itemInfo.icon_url;
            this.raffle.current.itemInfo.price =
                data.raffle.current.itemInfo.price;
            this.raffle.current.itemInfo.market_hash_name =
                data.raffle.current.itemInfo.market_hash_name;
            this.raffle.current.itemInfo.rarity =
                data.raffle.current.itemInfo.rarity;
            this.raffle.current.users = data.raffle.current.users;
            this.raffle.current.time = data.raffle.current.time;
            this.raffle.current.limitUsersInLottery =
                data.raffle.current.limitUsersInLottery;
            this.raffle.current.minDep = data.raffle.current.minDep;

            if (data.raffle.last.created_at) {
                this.raffle.last.created_at = data.raffle.last.created_at;
            }

            if (data.raffle.last.winners) {
                this.raffle.last.winners = data.raffle.last.winners; // Инициализируем массив winners
            } else {
                this.raffle.last.winners = []; // Убедитесь, что winners всегда массив
            }

            this.displayedWinners = this.raffle.last.winners.slice(
                0,
                this.winnersToLoad
            );

            this.info.place = data.info.place;
            this.info.status = data.info.status;
        },
        async get() {
            const request = await axios.post("/raffle/day/get");

            if (request.data.success) {
                this.setInfo(request.data);
            } else {
                this.$router.go(-1);
            }
        },
        async open() {
            const request = await axios.post("/raffle/day/open");
            const data = request.data;

            if (!data.success) {
                return this.$toast.error(data.msg);
            }

            this.info.place = data.place;
            this.info.status = true;

            this.raffle.current.users.push({});

            return this.$toast.success("Вы успешно заняли место");
        },
        loadMoreWinners() {
            const nextWinners = this.raffle.last.winners.slice(
                this.displayedWinners.length,
                this.displayedWinners.length + this.winnersToLoad
            );
            this.displayedWinners = [...this.displayedWinners, ...nextWinners];

            // Если все победители уже загружены, скрыть кнопку
            if (
                this.displayedWinners.length >= this.raffle.last.winners.length
            ) {
                this.showLoadMoreButton = false;
            }
        },
        getItemName,
        getItemType,
        getItemRarityClass,
    },

    filters: {
        formatDate(value) {
            if (!value) return "";
            const date = new Date(value);
            const day = String(date.getDate()).padStart(2, "0");
            const month = String(date.getMonth() + 1).padStart(2, "0");
            const year = date.getFullYear();
            const hours = String(date.getHours()).padStart(2, "0");
            const minutes = String(date.getMinutes()).padStart(2, "0");

            return `${day}.${month}.${year} ${hours}:${minutes}`;
        },
    },

    mounted() {
        this.get();
    },
};
</script>
