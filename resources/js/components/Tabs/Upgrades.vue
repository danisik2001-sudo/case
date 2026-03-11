<template>
    <div class="upgrades__container">
        <ul class="upgrades__list" v-if="upgrades.length >= 1">
            <div
                class="list__item"
                v-for="(upgrade, index) in upgrades"
                v-if="upgrade.used_item && upgrade.win_item"
                :key="index"
            >
                <div class="upgrade__item">
                    <div class="upgrade__bets">
                        <div class="upgrade__bet__item">
                            <div
                                class="skin__container size--medium"
                                :class="[
                                    getItemRarityClass(
                                        upgrade.used_item.rarity
                                    ),
                                ]"
                            >
                                <div class="skinCard">
                                    <div class="skinCard__price">
                                        <div class="skinCard__price-upgrade">
                                            {{ upgrade.used_item.price }} ₽
                                        </div>
                                    </div>
                                    <div class="skinCard__image_wrapper">
                                        <img
                                            :srcset="
                                                'https://steamcommunity-a.akamaihd.net/economy/image/' +
                                                upgrade.used_item.icon_url
                                            "
                                            :alt="
                                                upgrade.used_item
                                                    .market_hash_name
                                            "
                                            class="skinCard__image-upgrade"
                                            loading="lazy"
                                            decoding="async"
                                        />
                                    </div>
                                    <div class="skinCard__backdrop">
                                        <div
                                            class="skinIcon__backgrounds"
                                            :class="[
                                                getItemRarityClass(
                                                    upgrade.used_item.rarity
                                                ),
                                            ]"
                                        ></div>
                                    </div>
                                    <div class="skinCard__footer">
                                        <div class="skinCard__footer_left_side">
                                            <div class="drops__names__wrap">
                                                <div class="drops__names">
                                                    <div
                                                        class="drops__names_weapon"
                                                    >
                                                        <div
                                                            class="name-h1 uppercase"
                                                        >
                                                            <span
                                                                v-html="
                                                                    getItemType(
                                                                        upgrade
                                                                            .used_item
                                                                            .market_hash_name
                                                                    )
                                                                "
                                                            ></span>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="drops__names_skin"
                                                    >
                                                        <div class="name-h2">
                                                            <span
                                                                v-html="
                                                                    getItemName(
                                                                        upgrade
                                                                            .used_item
                                                                            .market_hash_name
                                                                    )
                                                                "
                                                            ></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="skinCard__divider"
                                    :class="[
                                        getItemRarityClass(
                                            upgrade.used_item.rarity
                                        ),
                                    ]"
                                ></div>
                            </div>
                        </div>
                        <div class="upgrade__pointer" aria-label="false">
                            <svg
                                width="46"
                                height="46"
                                viewBox="0 0 46 46"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <rect
                                    x="23"
                                    y="1.07967"
                                    width="31"
                                    height="31"
                                    rx="7.5"
                                    transform="rotate(45 23 1.07967)"
                                    fill="url(#paint0_linear_4743_37099)"
                                    stroke="url(#paint1_linear_4743_37099)"
                                />
                                <path
                                    d="M14.6641 23C14.6641 27.6 18.3974 31.3333 22.9974 31.3333C27.5974 31.3333 31.3307 27.6 31.3307 23C31.3307 18.4 27.5974 14.6666 22.9974 14.6666C18.3974 14.6666 14.6641 18.4 14.6641 23ZM23.8557 20.0583L26.3557 22.5583C26.4807 22.6833 26.5391 22.8416 26.5391 23C26.5391 23.1583 26.4807 23.3166 26.3557 23.4416L23.8557 25.9416C23.6141 26.1833 23.2141 26.1833 22.9724 25.9416C22.7307 25.7 22.7307 25.3 22.9724 25.0583L24.4057 23.625L20.0807 23.625C19.7391 23.625 19.4557 23.3416 19.4557 23C19.4557 22.6583 19.7391 22.375 20.0807 22.375L24.4057 22.375L22.9724 20.9416C22.7307 20.7 22.7307 20.3 22.9724 20.0583C23.2141 19.8166 23.6141 19.8166 23.8557 20.0583Z"
                                    fill="white"
                                />
                                <defs>
                                    <linearGradient
                                        id="paint0_linear_4743_37099"
                                        x1="39"
                                        y1="0.372559"
                                        x2="39"
                                        y2="32.3726"
                                        gradientUnits="userSpaceOnUse"
                                    >
                                        <stop stop-color="#5CB1FF" />
                                        <stop offset="1" stop-color="#396CF4" />
                                    </linearGradient>
                                    <linearGradient
                                        id="paint1_linear_4743_37099"
                                        x1="39"
                                        y1="0.372559"
                                        x2="39"
                                        y2="32.3726"
                                        gradientUnits="userSpaceOnUse"
                                    >
                                        <stop stop-color="#2CF3FF" />
                                        <stop offset="1" stop-color="#337FFF" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                        <div class="upgrade__desired__item">
                            <div
                                class="skin__container size--medium"
                                :class="[
                                    getItemRarityClass(upgrade.win_item.rarity),
                                ]"
                            >
                                <div class="skinCard">
                                    <div class="skinCard__price">
                                        <div class="skinCard__price-upgrade">
                                            {{ upgrade.win_item.price }} ₽
                                        </div>
                                    </div>
                                    <div class="skinCard__image_wrapper">
                                        <img
                                            :srcset="
                                                'https://steamcommunity-a.akamaihd.net/economy/image/' +
                                                upgrade.win_item.icon_url
                                            "
                                            :alt="
                                                upgrade.win_item
                                                    .market_hash_name
                                            "
                                            class="skinCard__image-upgrade"
                                            loading="lazy"
                                            decoding="async"
                                        />
                                    </div>
                                    <div class="skinCard__backdrop">
                                        <div
                                            class="skinIcon__backgrounds"
                                            :class="[
                                                getItemRarityClass(
                                                    upgrade.win_item.rarity
                                                ),
                                            ]"
                                        ></div>
                                    </div>
                                    <div class="skinCard__footer">
                                        <div class="skinCard__footer_left_side">
                                            <div class="drops__names__wrap">
                                                <div class="drops__names">
                                                    <div
                                                        class="drops__names_weapon"
                                                    >
                                                        <div
                                                            class="name-h1 uppercase"
                                                        >
                                                            <span
                                                                v-html="
                                                                    getItemType(
                                                                        upgrade
                                                                            .win_item
                                                                            .market_hash_name
                                                                    )
                                                                "
                                                            ></span>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="drops__names_skin"
                                                    >
                                                        <div class="name-h2">
                                                            <span
                                                                v-html="
                                                                    getItemName(
                                                                        upgrade
                                                                            .win_item
                                                                            .market_hash_name
                                                                    )
                                                                "
                                                            ></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="skinCard__divider"
                                    :class="[
                                        getItemRarityClass(
                                            upgrade.win_item.rarity
                                        ),
                                    ]"
                                ></div>
                            </div>
                        </div>
                    </div>
                    <div class="upgrade__info">
                        <div class="upgrade_info__chance">
                            <div class="info__chance">ШАНС</div>
                            <div class="info__percent">
                                {{ upgrade.percent }}%
                            </div>
                        </div>
                        <div class="upgrade_info__result">
                            <div
                                class="upgrade__result"
                                :aria-label="upgrade.status ? 'true' : 'false'"
                            >
                                <div
                                    class="upgrade__result-status"
                                    :aria-label="
                                        upgrade.status ? 'true' : 'false'
                                    "
                                >
                                    {{
                                        upgrade.status ? "Выиграл" : "Проиграл"
                                    }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </ul>
        <div class="empty__alert" v-if="upgrades.length === 0">
            <div class="empty__alert-text">Апгрейды отсутствуют.</div>
        </div>
        <div class="show_more__wrapper" v-if="upgrades.length >= 8">
            <button
                :disabled="pagination.upgrades.page === 1"
                @click="prevPageUpgrade"
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
                    {{ pagination.upgrades.page }}
                </div>
            </button>
            <button
                :disabled="!pagination.upgrades.more"
                @click="nextPageUpgrade"
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
        upgrades: {
            type: Array,
            required: true,
        },
        pagination: {
            type: Object,
            required: true,
        },
        prevPageUpgrade: {
            type: Function,
            required: true,
        },
        nextPageUpgrade: {
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
