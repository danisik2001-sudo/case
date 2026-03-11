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
            <span class="uppercase">Контракты</span>
        </div>
        <div class="MainContainer__header">
            <div
                class="text color--disabled variant--h1 align--center bold uppercase"
            >
                {{ $t("contracts.title") }}
            </div>
        </div>
        <div class="contract__wrapper" v-if="state === 'default'">
            <ul class="contract__list">
                <template v-for="i in contracts.maxItems">
                    <li class="contract__item">
                        <div
                            class="item__image_wrapper"
                            v-if="
                                typeof contracts.selected[i - 1] === 'undefined'
                            "
                        >
                            <img
                                class="item__image"
                                src="/assets/contract/item_none.png"
                                alt=""
                            />
                        </div>
                        <div
                            class="item__container size--medium"
                            :class="
                                getItemRarityClass(
                                    contracts.selected[i - 1].item.rarity
                                )
                            "
                            @click="unsetSkin(contracts.selected[i - 1].id)"
                            v-else-if="
                                contracts.selected[i - 1].selected === true
                            "
                        >
                            <div class="contractCard">
                                <div class="contractCard__image_wrapper">
                                    <img
                                        :srcset="
                                            'https://steamcommunity-a.akamaihd.net/economy/image/' +
                                            contracts.selected[i - 1].item
                                                .icon_url
                                        "
                                        :alt="
                                            contracts.selected[i - 1].item
                                                .market_hash_name
                                        "
                                        loading="lazy"
                                        decoding="async"
                                        class="contractCard__image"
                                    />
                                </div>
                                <div class="contractCard__footer">
                                    <div class="contractCard__footer_left_side">
                                        <div class="drops__names">
                                            <div
                                                class="text color--secondary-text variant--h6"
                                            >
                                                {{
                                                    getItemType(
                                                        contracts.selected[
                                                            i - 1
                                                        ].item.market_hash_name
                                                    )
                                                }}
                                            </div>
                                            <div class="name__bottom">
                                                <span
                                                    class="text color--disabled variant--h4 bold noWrap"
                                                    >{{
                                                        getItemName(
                                                            contracts.selected[
                                                                i - 1
                                                            ].item
                                                                .market_hash_name
                                                        )
                                                    }}</span
                                                >
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="contractCard__footer_right_side"
                                    >
                                        <div
                                            class="text color--disabled variant--h4 bold noWrap"
                                        >
                                            {{
                                                contracts.selected[i - 1].price
                                            }}
                                            ₽
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="contractCard__backdrops">
                                <div
                                    class="skinIcon__backgrounds"
                                    :class="
                                        getItemRarityClass(
                                            contracts.selected[i - 1].item
                                                .rarity
                                        )
                                    "
                                ></div>
                            </div>
                        </div>
                    </li>
                </template>
            </ul>
        </div>
        <div class="contract__win" v-if="state === 'win'">
            <div class="contract__result">
                <img
                    class="contract__result_spiral"
                    src="/assets/contract/spiral.svg"
                    alt="spiral"
                />
                <div class="contract__result_title uppercase">
                    {{ $t("contracts.happy") }}
                </div>
                <div class="contract__result_item">
                    <div
                        class="drops__card"
                        :class="[getItemRarityClass(winItem.rarity)]"
                    >
                        <div class="drops__card__visible">
                            <div class="drops__card__rarity">
                                <div
                                    class="skinIcon__background"
                                    :class="[
                                        getItemRarityClass(winItem.rarity),
                                    ]"
                                ></div>
                            </div>
                            <div class="drops__image_wrapper">
                                <img
                                    :srcset="
                                        'https://steamcommunity-a.akamaihd.net/economy/image/' +
                                        winItem.icon_url
                                    "
                                    :alt="winItem.market_hash_name"
                                    loading="lazy"
                                    decoding="async"
                                />
                            </div>
                            <div class="drops__names__wrapper">
                                <div class="drops__names">
                                    <div class="drops__names_weapon">
                                        <div class="name-h1 uppercase">
                                            {{
                                                getItemType(
                                                    winItem.market_hash_name
                                                )
                                            }}
                                        </div>
                                    </div>
                                    <div class="drops__names_skin">
                                        <div class="name-h2">
                                            {{
                                                getItemName(
                                                    winItem.market_hash_name
                                                )
                                            }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="drops__item__price">
                                {{ winItem.price }} ₽
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contract__result_btns">
                    <div
                        class="contract__btn-sell"
                        v-on:click="sellItem(winItem.id)"
                    >
                        <div class="contract__btn-sell-text uppercase">
                            {{ $t("contracts.sell") }} {{ winItem.price }} ₽
                        </div>
                    </div>
                    <div class="contract__btn-refresh" @click="refresh">
                        <div class="contract__btn-refresh-text uppercase">
                            {{ $t("contracts.refresh") }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="contract__create" v-if="state === 'default'">
            <div class="contract__create_header">
                <div class="contract__create_text">
                    <div class="contract__create_title uppercase">
                        {{ $t("contracts.contract") }}
                        <div class="contract__create_title_btns">
                            <button class="btn_reset">
                                <svg
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M16.19 2H7.81C4.17 2 2 4.17 2 7.81V16.18C2 19.83 4.17 22 7.81 22H16.18C19.82 22 21.99 19.83 21.99 16.19V7.81C22 4.17 19.83 2 16.19 2ZM17.85 14.1C17.81 14.19 17.76 14.27 17.69 14.34L14.65 17.38C14.5 17.53 14.31 17.6 14.12 17.6C13.93 17.6 13.74 17.53 13.59 17.38C13.3 17.09 13.3 16.61 13.59 16.32L15.35 14.56H6.85C6.44 14.56 6.1 14.22 6.1 13.81C6.1 13.4 6.44 13.06 6.85 13.06H17.16C17.26 13.06 17.35 13.08 17.45 13.12C17.63 13.2 17.78 13.34 17.86 13.53C17.92 13.71 17.92 13.92 17.85 14.1ZM17.15 10.93H6.85C6.75 10.93 6.66 10.91 6.56 10.87C6.38 10.79 6.23 10.65 6.15 10.46C6.07 10.28 6.07 10.07 6.15 9.89C6.19 9.8 6.24 9.72 6.31 9.65L9.35 6.61C9.64 6.32 10.12 6.32 10.41 6.61C10.7 6.9 10.7 7.38 10.41 7.67L8.66 9.43H17.16C17.57 9.43 17.91 9.77 17.91 10.18C17.91 10.59 17.57 10.93 17.15 10.93Z"
                                        fill="#687894"
                                    />
                                </svg>
                            </button>
                            <button class="btn_reset">
                                <svg
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M12 22C17.51 22 22 17.51 22 12C22 6.49 17.51 2 12 2C6.49 2 2 6.49 2 12C2 17.51 6.49 22 12 22ZM12.75 16C12.75 16.41 12.41 16.75 12 16.75C11.59 16.75 11.25 16.41 11.25 16L11.25 11C11.25 10.59 11.59 10.25 12 10.25C12.41 10.25 12.75 10.59 12.75 11L12.75 16ZM11.08 7.62C11.13 7.49 11.2 7.39 11.29 7.29C11.39 7.2 11.5 7.13 11.62 7.08C11.74 7.03 11.87 7 12 7C12.13 7 12.26 7.03 12.38 7.08C12.5 7.13 12.61 7.2 12.71 7.29C12.8 7.39 12.87 7.49 12.92 7.62C12.97 7.74 13 7.87 13 8C13 8.13 12.97 8.26 12.92 8.38C12.87 8.5 12.8 8.61 12.71 8.71C12.61 8.8 12.5 8.87 12.38 8.92C12.14 9.02 11.86 9.02 11.62 8.92C11.5 8.87 11.39 8.8 11.29 8.71C11.2 8.61 11.13 8.5 11.08 8.38C11.03 8.26 11 8.13 11 8C11 7.87 11.03 7.74 11.08 7.62Z"
                                        fill="#687894"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="contract__create_desc">
                        {{ $t("contracts.add") }}&nbsp;<span
                            >3 {{ $t("contracts.item") }}</span
                        >
                    </div>
                </div>
                <button
                    class="contract__create_btn"
                    @click="playGame"
                    :disabled="contracts.items < 3"
                >
                    {{ $t("contracts.create") }}
                </button>
            </div>
            <div class="contract__create_body">
                <div class="contract__create_body_progress">
                    <div
                        class="contract__progress-bar"
                        :style="{ width: progress + '%' }"
                    ></div>
                    <span>{{ contracts.price.toFixed(2) }} ₽</span>
                </div>

                <div class="contract__create_body_val_wrapper">
                    <div class="contract__create_body_val">0</div>
                    <div class="contract__create_body_val">1</div>
                    <div class="contract__create_body_val">2</div>
                    <div
                        class="contract__create_body_val contract__create_body_val_min"
                    >
                        3
                    </div>
                    <div class="contract__create_body_val">4</div>
                    <div class="contract__create_body_val">5</div>
                    <div class="contract__create_body_val">6</div>
                    <div class="contract__create_body_val">7</div>
                    <div class="contract__create_body_val">8</div>
                    <div class="contract__create_body_val">9</div>
                    <div class="contract__create_body_val">10</div>
                </div>
            </div>
            <button
                @click="playGame"
                :disabled="contracts.items < 3"
                class="contract__create_btn-mobile"
            >
                {{ $t("contracts.create") }}
            </button>
        </div>
        <div class="openCaseContent">
            <div class="MainContainer__header">
                <div
                    class="text color--disabled variant--h1 align--center bold uppercase"
                >
                    {{ $t("contracts.available") }}
                </div>
            </div>
            <div class="contract__items__warn" v-if="showedItems.length < 1">
                <img
                    src="/assets/contract/danger.png"
                    alt="danger"
                    style="width: 50px; height: 50px"
                />
                <div class="contract__items__warn_text">
                    <h3 class="contract_items__warn_title">
                        {{ $t("contracts.warning") }}
                    </h3>
                    <p class="contract_items__warn_desc">
                        <span> {{ $t("contracts.warning2") }}</span
                        >,&nbsp; {{ $t("contracts.warning3") }}
                    </p>
                </div>
            </div>
            <div class="openCaseContent__container">
                <div
                    class="skinCard__wrapper"
                    v-if="showedItems.length > 0"
                    v-for="(item, index) in showedItems"
                    :key="index"
                    @click="selectSkin(item.id)"
                >
                    <div
                        class="skin__container size--medium"
                        :class="[getItemRarityClass(item.item.rarity)]"
                    >
                        <div class="skinCard">
                            <div class="skinCard__price">
                                <div class="skinCard__price-item">
                                    {{ item.item.price }}
                                    ₽
                                </div>
                            </div>
                            <div class="skinCard__image_wrapper">
                                <img
                                    :srcset="
                                        'https://steamcommunity-a.akamaihd.net/economy/image/' +
                                        item.item.icon_url
                                    "
                                    :alt="item.item.market_hash_name"
                                    class="skinCard__image"
                                    loading="lazy"
                                    decoding="async"
                                />
                            </div>

                            <div class="skinCard__footer">
                                <div class="skinCard__footer_left_side">
                                    <div class="drops__names">
                                        <div
                                            class="text color--secondary-text variant--h6"
                                        >
                                            {{
                                                getItemType(
                                                    item.item.market_hash_name
                                                )
                                            }}
                                        </div>
                                        <div class="name__bottom">
                                            <span
                                                class="text color--disabled variant--h4 bold noWrap"
                                                >{{
                                                    getItemName(
                                                        item.item
                                                            .market_hash_name
                                                    )
                                                }}</span
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="skinCard__backdrops">
                            <div
                                class="skinIcon__backgrounds"
                                :class="[getItemRarityClass(item.item.rarity)]"
                            ></div>
                        </div>
                        <div
                            class="skinCard__divider"
                            :class="[getItemRarityClass(item.item.rarity)]"
                        ></div>
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
    morph,
} from "../helpers/helper";
import axios from "axios";

export default {
    data() {
        return {
            userItems: [],
            state: "default",
            winItem: null,
            progress: 0,
            contracts: {
                selected: [],
                items: 0,
                price: 0,
                maxItems: 10,
            },
            isStarted: false,
            video: null,
        };
    },
    computed: {
        showedItems() {
            return this.userItems.filter((item) => !item.selected);
        },
    },
    mounted() {
        this.getUserItems();
    },
    methods: {
        async playGame() {
            if (this.state === "win") return;
            if (this.isStarted) return;
            this.isStarted = true;

            if (this.contracts.price > 100000) {
                return this.$root.toast(
                    "error",
                    "Максимальная сумма контракта 100 000₽"
                );
            }

            if (this.contracts.items < 3) {
                return this.$root.toast(
                    "error",
                    "Минимум 3 предмета в контракте"
                );
            }

            let itemsId = [];

            for (const item of this.contracts.selected) {
                itemsId.push(item.id);
            }

            await this.axios
                .post("/contracts/create", {
                    items: itemsId,
                })
                .then((res) => {
                    const result = res.data;

                    if (!result.success) {
                        this.state = "default";
                        return this.$root.toast("error", result.message);
                    }

                    if (result.success) {
                        this.$root.playSound("contract-run");
                        this.winItem = result.winItem;
                        this.state = "win";
                    }
                });
        },
        async sellItem(id) {
            const request = await axios.post("/user/items/sellItem", {
                id: id,
            });
            const data = request.data;

            if (data.type === "error") {
                this.$toast.error(data.message);
            } else if (data.type === "success") {
                this.$toast.success(data.message);
            }

            this.refresh();
        },
        refresh() {
            this.state = "default";
            this.isStarted = false;
            this.contracts.selected = [];
            this.contracts.items = 0;
            this.contracts.price = 0;
            this.progress = 0;
            this.getUserItems();
        },
        selectSkin(id) {
            if (this.state === "win") return;
            if (this.contracts.selected.length === this.contracts.maxItems) {
                return this.$root.toast(
                    "error",
                    `Максимум ${this.contracts.maxItems} предметов в контракте`
                );
            }

            const index = this.userItems.findIndex((item) => item.id === id);
            if (index > -1) {
                this.userItems[index].selected = true;
                this.contracts.selected.push(this.userItems[index]);
                this.contracts.price += Number(this.userItems[index].price);
                this.contracts.items += 1;
                this.progress = Math.min(this.progress + 10, 100);
                this.$root.playSound("contract-add-skin");
                this.$forceUpdate();
            }
        },
        unsetSkin(id) {
            if (this.state === "win") return;
            const index = this.userItems.findIndex((x) => x.id === id);

            if (index > -1) {
                const indexSelected = this.contracts.selected.findIndex(
                    (x) => x.id === id
                );

                if (indexSelected > -1) {
                    this.contracts.selected.splice(indexSelected, 1);
                }

                this.userItems[index].selected = false;
                this.contracts.price -= Number(this.userItems[index].price);
                this.contracts.items -= 1;
                this.progress = Math.max(this.progress - 10, 0);

                this.$forceUpdate();
            }
        },
        async getUserItems() {
            await this.axios.get("/contracts/user/items").then((res) => {
                const result = res.data;

                if (result.success) {
                    this.userItems = result.items;
                }
            });
        },
        morph,
        getItemName,
        getItemType,
        getItemRarityClass,
    },
};
</script>
