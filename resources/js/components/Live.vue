<template>
    <div class="layout__lastDrop">
        <div class="switcher__container">
            <div class="switcher">
                <button
                    class="switcher__button"
                    @click="setType('best')"
                    :disabled="liveType === 'best'"
                >
                    <svg
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M22.0001 8.67C21.7153 8.47697 21.3791 8.37379 21.0351 8.37379C20.691 8.37379 20.3549 8.47697 20.0701 8.67L17.0701 10.53C17.0402 10.5435 17.0078 10.5505 16.9751 10.5505C16.9423 10.5505 16.9099 10.5435 16.8801 10.53C16.8133 10.512 16.7561 10.469 16.7201 10.41L13.5201 4.65C13.3645 4.39114 13.1446 4.17695 12.8818 4.02824C12.6189 3.87954 12.3221 3.80139 12.0201 3.80139C11.7181 3.80139 11.4212 3.87954 11.1584 4.02824C10.8955 4.17695 10.6756 4.39114 10.5201 4.65L7.20006 10.4C7.16405 10.459 7.10679 10.502 7.04006 10.52C7.01022 10.5335 6.97783 10.5405 6.94506 10.5405C6.91229 10.5405 6.8799 10.5335 6.85006 10.52L3.90006 8.63C3.61446 8.44925 3.28194 8.35665 2.94403 8.36376C2.60612 8.37088 2.27779 8.47739 2.00006 8.67C1.71502 8.86476 1.49436 9.13991 1.36615 9.46044C1.23794 9.78097 1.20797 10.1324 1.28006 10.47L2.96006 18.36C3.04259 18.7526 3.25749 19.1049 3.56879 19.358C3.8801 19.611 4.26889 19.7494 4.67006 19.75H19.3601C19.7612 19.7494 20.15 19.611 20.4613 19.358C20.7726 19.1049 20.9875 18.7526 21.0701 18.36L22.7501 10.47C22.8191 10.1294 22.7846 9.77588 22.6509 9.45507C22.5172 9.13425 22.2905 8.86082 22.0001 8.67Z"
                            fill="currentColor"
                        />
                    </svg>
                </button>
                <button
                    class="switcher__button"
                    @click="setType('all')"
                    :disabled="liveType === 'all'"
                >
                    <svg
                        width="18"
                        height="18"
                        viewBox="0 0 18 18"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <g clip-path="url(#clip0_4_318)">
                            <path
                                d="M0 2.00025C0 1.46975 0.21074 0.960979 0.58586 0.58586C0.960979 0.21074 1.46975 0 2.00025 0L6 0C6.5305 0 7.03927 0.21074 7.41439 0.58586C7.78951 0.960979 8.00025 1.46975 8.00025 2.00025V6C8.00025 6.5305 7.78951 7.03927 7.41439 7.41439C7.03927 7.78951 6.5305 8.00025 6 8.00025H2.00025C1.46975 8.00025 0.960979 7.78951 0.58586 7.41439C0.21074 7.03927 0 6.5305 0 6L0 2.00025ZM9.99975 2.00025C9.99975 1.46975 10.2105 0.960979 10.5856 0.58586C10.9607 0.21074 11.4695 0 12 0L15.9998 0C16.2624 0 16.5225 0.051738 16.7652 0.15226C17.0079 0.252782 17.2284 0.400119 17.4141 0.58586C17.5999 0.7716 17.7472 0.992106 17.8477 1.23479C17.9483 1.47747 18 1.73757 18 2.00025V6C18 6.26268 17.9483 6.52278 17.8477 6.76546C17.7472 7.00814 17.5999 7.22865 17.4141 7.41439C17.2284 7.60013 17.0079 7.74747 16.7652 7.84799C16.5225 7.94851 16.2624 8.00025 15.9998 8.00025H12C11.4695 8.00025 10.9607 7.78951 10.5856 7.41439C10.2105 7.03927 9.99975 6.5305 9.99975 6V2.00025ZM0 12C0 11.4695 0.21074 10.9607 0.58586 10.5856C0.960979 10.2105 1.46975 9.99975 2.00025 9.99975H6C6.5305 9.99975 7.03927 10.2105 7.41439 10.5856C7.78951 10.9607 8.00025 11.4695 8.00025 12V15.9998C8.00025 16.2624 7.94851 16.5225 7.84799 16.7652C7.74747 17.0079 7.60013 17.2284 7.41439 17.4141C7.22865 17.5999 7.00814 17.7472 6.76546 17.8477C6.52278 17.9483 6.26268 18 6 18H2.00025C1.73757 18 1.47747 17.9483 1.23479 17.8477C0.992106 17.7472 0.7716 17.5999 0.58586 17.4141C0.400119 17.2284 0.252782 17.0079 0.15226 16.7652C0.051738 16.5225 0 16.2624 0 15.9998L0 12ZM9.99975 12C9.99975 11.4695 10.2105 10.9607 10.5856 10.5856C10.9607 10.2105 11.4695 9.99975 12 9.99975H15.9998C16.2624 9.99975 16.5225 10.0515 16.7652 10.152C17.0079 10.2525 17.2284 10.3999 17.4141 10.5856C17.5999 10.7713 17.7472 10.9919 17.8477 11.2345C17.9483 11.4772 18 11.7373 18 12V15.9998C18 16.2624 17.9483 16.5225 17.8477 16.7652C17.7472 17.0079 17.5999 17.2284 17.4141 17.4141C17.2284 17.5999 17.0079 17.7472 16.7652 17.8477C16.5225 17.9483 16.2624 18 15.9998 18H12C11.7373 18 11.4772 17.9483 11.2345 17.8477C10.9919 17.7472 10.7713 17.5999 10.5856 17.4141C10.3999 17.2284 10.2525 17.0079 10.152 16.7652C10.0515 16.5225 9.99975 16.2624 9.99975 15.9998V12Z"
                                fill="currentColor"
                            />
                        </g>
                    </svg>
                </button>
            </div>
        </div>
        <div class="drops__container" v-if="loading">
            <div v-for="n in 20" :key="n" class="liveDrop__wrapper">
                <div class="drops__card rarity--unknown">
                    <div class="drops__card__visible">
                        <div class="drops__card__rarity">
                            <div
                                class="skinIcon__background rarity--unknown"
                            ></div>
                        </div>

                        <div class="drops__names__wrapper">
                            <div class="drops__names">
                                <div class="drops__names_unknown"></div>
                                <div class="drops__name_unknown"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else class="drops__container">
            <div
                class="liveDrop__wrapper"
                :class="{ 'new-item': item.isNew }"
                v-for="(item, index) in liveType === 'best' ? best : all"
                :key="index"
                :style="{
                    '--animation-duration': currentAnimationDuration + 'ms',
                }"
            >
                <div
                    class="drops__card"
                    :class="[getItemRarityClass(item.item.rarity)]"
                >
                    <div class="drops__card__visible live">
                        <div class="drops__card__rarity">
                            <div
                                class="skinIcon__background"
                                :class="[getItemRarityClass(item.item.rarity)]"
                            ></div>
                        </div>
                        <div class="drops__image_wrapper">
                            <img
                                :srcset="
                                    'https://steamcommunity-a.akamaihd.net/economy/image/' +
                                    item.item.icon_url
                                "
                                :alt="item.item.market_hash_name"
                                loading="lazy"
                                decoding="async"
                            />
                        </div>
                        <div class="drops__names__wrapper">
                            <div class="drops__names">
                                <div class="drops__names_weapon">
                                    <div
                                        class="name-h1 uppercase"
                                        v-html="
                                            getItemType(
                                                item.item.market_hash_name
                                            )
                                        "
                                    ></div>
                                </div>
                                <div class="drops__names_skin">
                                    <div
                                        class="name-h2"
                                        v-html="
                                            getItemName(
                                                item.item.market_hash_name
                                            )
                                        "
                                    ></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="drops__card__hovered">
                        <router-link
                            class="drops__image_hovered_wrapper"
                            v-if="item.type === 'case'"
                            :to="{
                                name: 'case',
                                params: {
                                    url: item.case.url,
                                },
                            }"
                            ><img
                                :src="'/assets/img/cases/' + item.case.image"
                                :alt="item.case.name"
                                class="image"
                                loading="lazy"
                                decoding="async"
                        /></router-link>
                        <router-link
                            class="drops__image_hovered_wrapper"
                            v-if="item.type === 'upgrade'"
                            :to="{
                                name: 'upgrade',
                            }"
                            ><img
                                src="/assets/upgrade/upgrade-skin-placeholder.png"
                                alt="Апгрейд"
                                class="image"
                                loading="lazy"
                                decoding="async"
                        /></router-link>
                        <router-link
                            class="drops__image_hovered_wrapper"
                            v-if="item.type === 'contract'"
                            :to="{
                                name: 'contracts',
                            }"
                            ><img
                                src="/assets/contract/contracts-skin-placeholder.png"
                                alt="Контракт"
                                class="image"
                                loading="lazy"
                                decoding="async"
                        /></router-link>
                        <router-link
                            class="drops__image_hovered_wrapper"
                            v-if="item.type === 'wheel'"
                            :to="{
                                name: 'wheel',
                            }"
                            ><img
                                src="/assets/wheel/wheel-placeholder.png"
                                alt="Барабан"
                                class="image"
                                loading="lazy"
                                decoding="async"
                        /></router-link>
                        <router-link
                            class="drops__image_hovered_wrapper"
                            v-if="item.type === 'raffle'"
                            :to="{
                                name: 'raffle',
                            }"
                            ><img
                                src="/assets/raffle/raffle-skin-placeholder.png"
                                alt="Розыгрыш"
                                class="image"
                                loading="lazy"
                                decoding="async"
                        /></router-link>
                        <router-link
                            class="drops__image_hovered_wrapper"
                            v-if="item.type === 'missions'"
                            :to="{
                                name: 'missions',
                            }"
                            ><img
                                src="/assets/missions/missions-skin-placeholder.png"
                                alt="Миссия"
                                class="image"
                                loading="lazy"
                                decoding="async"
                        /></router-link>

                        <div
                            class="drops__image_hovered_wrapper"
                            v-if="item.type === 'calendar'"
                        >
                            <img
                                src="/assets/calendar/calendar-placeholder.png"
                                alt="Календарь"
                                class="image"
                                loading="lazy"
                                decoding="async"
                            />
                        </div>
                        <div class="drops__names__wrapper">
                            <div class="drops__names">
                                <div class="drops__names_weapon">
                                    <div class="name-h1 uppercase">
                                        {{ item.user.username }}
                                    </div>
                                </div>
                                <div class="drops__names_skin">
                                    <div
                                        class="name-h2"
                                        v-if="item.type === 'case'"
                                    >
                                        {{ item.case.name }}
                                    </div>
                                    <div
                                        class="name-h2"
                                        v-if="item.type === 'upgrade'"
                                    >
                                        Апгрейд
                                    </div>
                                    <div
                                        class="name-h2"
                                        v-if="item.type === 'contract'"
                                    >
                                        Контракт
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="user__link_wrapper">
                            <router-link
                                class="drops__user_avatar"
                                :to="{
                                    name: 'user',
                                    params: {
                                        id: item.user.id,
                                    },
                                }"
                                ><img
                                    :src="item.user.avatar"
                                    :alt="item.user.username"
                                    loading="lazy"
                                    decoding="async"
                            /></router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {
    getItemName,
    getItemRarityClass,
    getItemType,
} from "../helpers/helper";

export default {
    data() {
        return {
            all: [],
            best: [],
            liveType: "all",
            loading: true,
            itemQueue: [],
            animationInterval: null,
            randomBoostInterval: null,
            randomBoost: 0,
            isProcessingQueue: false,
            initialDelay: 10000,
            defaultAnimationDuration: 500,
            fastAnimationDuration: 200,
            queueThreshold: 10,
            useFastMode: false,
            expensiveThreshold: 2000, // Порог стоимости для "дорогих" предметов (настройте под свои нужды)
        };
    },
    mounted() {
        this.getLive();
        this.startRandomBoost();
    },
    beforeDestroy() {
        if (this.randomBoostInterval) {
            clearInterval(this.randomBoostInterval);
        }
        if (this.animationInterval) {
            clearInterval(this.animationInterval);
        }
    },
    computed: {
        currentAnimationDuration() {
            return this.useFastMode ||
                this.itemQueue.length > this.queueThreshold
                ? this.fastAnimationDuration
                : this.defaultAnimationDuration;
        },
    },

    methods: {
        async getLive() {
            try {
                const res = await this.axios.get("/live");
                this.all = res.data.all;
                this.best = res.data.best;
                this.loading = false;
                this.displayedOnline = this.boostedOnline;
            } catch (error) {
                console.error("Error fetching live data:", error);
            }
        },
        setType(type) {
            this.liveType = type;
        },

        startRandomBoost() {
            this.randomBoost = Math.floor(Math.random() * (30 - 5 + 1)) + 5;
            this.randomBoostInterval = setInterval(() => {
                this.randomBoost = Math.floor(Math.random() * (30 - 5 + 1)) + 5;
            }, 50000);
        },
        async processQueue() {
            if (this.isProcessingQueue || !this.itemQueue.length) return;

            this.isProcessingQueue = true;

            if (
                !this.useFastMode &&
                this.itemQueue.length > this.queueThreshold
            ) {
                this.useFastMode = true;
            }

            const item = this.itemQueue.shift();
            // Определяем, дорогой предмет или нет
            const isExpensive = item.price >= this.expensiveThreshold;

            try {
                // Добавляем предмет в обычную ленту (all) независимо от стоимости
                if (this.all.length >= 10) {
                    this.all.pop();
                }
                item.isNew = true;
                this.all.unshift(item);

                // Если предмет дорогой, добавляем его также в best
                if (isExpensive) {
                    if (this.best.length >= 10) {
                        this.best.pop();
                    }
                    this.best.unshift({ ...item }); // Копируем объект, чтобы не дублировать ссылку
                }

                // Анимация "нового" предмета
                setTimeout(() => {
                    item.isNew = false;
                }, this.currentAnimationDuration);

                await new Promise((resolve) =>
                    setTimeout(resolve, this.currentAnimationDuration)
                );
            } catch (error) {
                console.error("Error processing queue item:", error);
            } finally {
                if (this.itemQueue.length === 0) {
                    this.useFastMode = false;
                }
                this.isProcessingQueue = false;

                if (this.itemQueue.length > 0) {
                    this.processQueue();
                }
            }
        },
        processUserItems(items) {
            setTimeout(() => {
                this.itemQueue.push(...items);
                this.processQueue();
            }, this.initialDelay);
        },
        getItemName,
        getItemType,
        getItemRarityClass,
    },
    sockets: {
        live(data) {
            if (!data?.item?.all?.length) {
                console.error("Invalid data received:", data);
                return;
            }

            const newItems = data.item.all.filter((item) => item?.id);
            const isCurrentUser =
                this.$root.user &&
                newItems.some(
                    (item) =>
                        parseInt(item.user.id) === parseInt(this.$root.user.id)
                );

            if (isCurrentUser) {
                this.processUserItems(newItems);
            } else {
                this.itemQueue.push(...newItems);
                this.processQueue();
            }
        },
    },
};
</script>

<style>
.drops__container {
    display: flex;
    flex-direction: row;
    gap: 1px;
    overflow-x: auto;
    white-space: nowrap;
}

.liveDrop__wrapper.new-item {
    animation: dropFromTop var(--animation-duration) ease-out forwards;
    transform-origin: top center;
}

@keyframes dropFromTop {
    0% {
        opacity: 0;
        transform: translateX(-100px);
    }
    70% {
        opacity: 1;
        transform: translateX(10px);
    }
    100% {
        opacity: 1;
        transform: translateX(0);
    }
}

.drops__card {
    display: inline-block;
    transition: opacity 0.3s ease;
}

@keyframes flipUp {
    0% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-100%);
    }
    51% {
        transform: translateY(100%);
    }
    100% {
        transform: translateY(0);
    }
}

@keyframes flipDown {
    0% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(100%);
    }
    51% {
        transform: translateY(-100%);
    }
    100% {
        transform: translateY(0);
    }
}

.flip-up {
    animation: flipUp 0.5s ease-in-out;
}

.flip-down {
    animation: flipDown 0.5s ease-in-out;
}
</style>
