<template>
    <div class="contracts__container">
        <ul class="contracts__list" v-if="contracts.length >= 1">
            <div
                class="list__item"
                v-for="(contract, index) in contracts"
                :key="index"
            >
                <div class="contracts__item">
                    <div class="contracts__bets">
                        <div class="contracts__info">
                            <div class="contracts__info_header">
                                <div class="contracts__info_price">
                                    <div class="contracts__info_text">
                                        Сумма контракта
                                    </div>
                                    <div class="contracts__info_value">
                                        {{ contract.priceAll.toFixed(2) }} ₽
                                    </div>
                                </div>
                            </div>
                            <div class="line"></div>
                            <div class="contracts__bet_items">
                                <div
                                    v-for="(
                                        usedItem, index
                                    ) in contract.itemsList"
                                    :key="index"
                                    class="drops__card"
                                    :class="[
                                        getItemRarityClass(usedItem.rarity),
                                    ]"
                                >
                                    <div class="drops__card__visible">
                                        <div class="drops__card__rarity">
                                            <div
                                                class="skinIcon__background"
                                                :class="[
                                                    getItemRarityClass(
                                                        usedItem.rarity
                                                    ),
                                                ]"
                                            ></div>
                                        </div>
                                        <div class="drops__image_wrapper">
                                            <img
                                                :srcset="
                                                    'https://steamcommunity-a.akamaihd.net/economy/image/' +
                                                    usedItem.icon_url
                                                "
                                                :alt="usedItem.market_hash_name"
                                                loading="lazy"
                                                decoding="async"
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="drops__card rarity--0"
                                    v-for="(element, elementIndex) in 10 -
                                    contract.itemsList.length"
                                >
                                    <div class="drops__card__visible">
                                        <div class="drops__card__rarity">
                                            <div
                                                class="skinIcon__background rarity--0"
                                            ></div>
                                        </div>
                                        <div class="drops__image_wrapper">
                                            <img
                                                style="
                                                    width: 56px;
                                                    height: 42px;
                                                "
                                                src="/assets/contract/item_none.png"
                                                alt="undefined"
                                                loading="lazy"
                                                decoding="async"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="contracts__result_item">
                            <div class="up-arrow">
                                <svg
                                    width="46"
                                    height="46"
                                    viewBox="0 0 46 46"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <rect
                                        x="22.625"
                                        y="0.707107"
                                        width="31"
                                        height="31"
                                        rx="7.5"
                                        transform="rotate(45 22.625 0.707107)"
                                        fill="url(#paint0_linear_4747_38589)"
                                        stroke="url(#paint1_linear_4747_38589)"
                                    />
                                    <path
                                        d="M14.2891 22.6274C14.2891 27.2274 18.0224 30.9607 22.6224 30.9607C27.2224 30.9607 30.9557 27.2274 30.9557 22.6274C30.9557 18.0274 27.2224 14.294 22.6224 14.294C18.0224 14.294 14.2891 18.0274 14.2891 22.6274ZM23.4807 19.6857L25.9807 22.1857C26.1057 22.3107 26.1641 22.469 26.1641 22.6274C26.1641 22.7857 26.1057 22.944 25.9807 23.069L23.4807 25.569C23.2391 25.8107 22.8391 25.8107 22.5974 25.569C22.3557 25.3274 22.3557 24.9274 22.5974 24.6857L24.0307 23.2524L19.7057 23.2524C19.3641 23.2524 19.0807 22.969 19.0807 22.6274C19.0807 22.2857 19.3641 22.0024 19.7057 22.0024L24.0307 22.0024L22.5974 20.569C22.3557 20.3274 22.3557 19.9274 22.5974 19.6857C22.8391 19.444 23.2391 19.444 23.4807 19.6857Z"
                                        fill="white"
                                    />
                                    <defs>
                                        <linearGradient
                                            id="paint0_linear_4747_38589"
                                            x1="38.625"
                                            y1="0"
                                            x2="38.625"
                                            y2="32"
                                            gradientUnits="userSpaceOnUse"
                                        >
                                            <stop stop-color="#5CB1FF" />
                                            <stop
                                                offset="1"
                                                stop-color="#396CF4"
                                            />
                                        </linearGradient>
                                        <linearGradient
                                            id="paint1_linear_4747_38589"
                                            x1="38.625"
                                            y1="0"
                                            x2="38.625"
                                            y2="32"
                                            gradientUnits="userSpaceOnUse"
                                        >
                                            <stop stop-color="#2CF3FF" />
                                            <stop
                                                offset="1"
                                                stop-color="#337FFF"
                                            />
                                        </linearGradient>
                                    </defs>
                                </svg>
                            </div>
                            <div
                                class="skin__container contracts__result size--large"
                                :class="[
                                    getItemRarityClass(
                                        contract.win_item.rarity
                                    ),
                                ]"
                            >
                                <div class="skinCard contracts__result">
                                    <div class="skinCard__image_wrapper">
                                        <img
                                            :srcset="
                                                'https://steamcommunity-a.akamaihd.net/economy/image/' +
                                                contract.win_item.icon_url
                                            "
                                            :alt="
                                                contract.win_item
                                                    .market_hash_name
                                            "
                                            loading="lazy"
                                            decoding="async"
                                            class="skinCard__image-contracts"
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
                                                            contract.win_item
                                                                .market_hash_name
                                                        )
                                                    }}
                                                </div>
                                                <div class="name__bottom">
                                                    <span
                                                        class="text color--disabled variant--h4 bold noWrap"
                                                        >{{
                                                            getItemName(
                                                                contract
                                                                    .win_item
                                                                    .market_hash_name
                                                            )
                                                        }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="skinCard__backdrops">
                                    <div
                                        class="skinIcon__backgrounds"
                                        :class="[
                                            getItemRarityClass(
                                                contract.win_item.rarity
                                            ),
                                        ]"
                                    ></div>
                                </div>
                                <div
                                    class="skinCard__divider"
                                    :class="[
                                        getItemRarityClass(
                                            contract.win_item.rarity
                                        ),
                                    ]"
                                ></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </ul>
        <div class="empty__alert" v-if="contracts.length === 0">
            <div class="empty__alert-text">Контракты отсутствуют.</div>
        </div>
        <div class="show_more__wrapper" v-if="contracts.length >= 4">
            <button
                :disabled="pagination.contracts.page === 1"
                @click="prevPageContracts"
                class="controls color--gray-dark size--large fit--content button radius-14 min--48"
                type="button"
            >
                <div class="button__content">
                    <svg
                        width="7"
                        height="14"
                        viewBox="0 0 7 14"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M2.30168 7.00003L6.7682 1.64021C7.12176 1.21593 7.06444 0.585368 6.64016 0.231804C6.21588 -0.12176 5.58532 -0.0644362 5.23175 0.359841L0.231754 6.35984C-0.0772842 6.73069 -0.0772842 7.26936 0.231754 7.64021L5.23175 13.6402C5.58532 14.0645 6.21588 14.1218 6.64016 13.7682C7.06444 13.4147 7.12176 12.7841 6.7682 12.3598L2.30168 7.00003Z"
                            fill="#687894"
                        />
                    </svg>
                </div>
            </button>
            <button
                class="controls color--blue-gradient size--large fit--content button radius-14 min--48"
                type="button"
            >
                <div class="button__content">
                    {{ pagination.contracts.page }}
                </div>
            </button>
            <button
                :disabled="!pagination.contracts.more"
                @click="nextPageContracts"
                class="controls color--gray-dark size--large fit--content button radius-14 min--48"
                type="button"
            >
                <div class="button__content">
                    <svg
                        width="7"
                        height="14"
                        viewBox="0 0 7 14"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M4.69832 6.99998L0.231804 12.3598C-0.12176 12.7841 -0.0644364 13.4146 0.35984 13.7682C0.784117 14.1218 1.41468 14.0644 1.76825 13.6402L6.76825 7.64016C7.07728 7.26931 7.07728 6.73064 6.76825 6.35979L1.76825 0.359791C1.41468 -0.0644863 0.784119 -0.12181 0.359842 0.231754C-0.0644347 0.585319 -0.121758 1.21588 0.231806 1.64016L4.69832 6.99998Z"
                            fill="#687894"
                        />
                    </svg>
                </div>
            </button>
        </div>
    </div>
</template>

<script>
import {
    getExteriorInsideBrackets,
    getItemName,
    getItemRarityClass,
    getItemType,
} from "../../helpers/helper.js";
export default {
    props: {
        contracts: {
            type: Array,
            required: true,
        },
        pagination: {
            type: Object,
            required: true,
        },
        prevPageContracts: {
            type: Function,
            required: true,
        },
        nextPageContracts: {
            type: Function,
            required: true,
        },
    },
    methods: {
        getExteriorInsideBrackets,
        getItemName,
        getItemRarityClass,
        getItemType,
    },
};
</script>
