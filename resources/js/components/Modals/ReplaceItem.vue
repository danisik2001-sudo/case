<template>
    <div id="replace-item-modal" class="w__modal color--light size--m">
        <div class="modal__overlay"></div>
        <div class="modal_scroll__container">
            <div class="modalContainer">
                <div class="modal">
                    <div class="container__content">
                        <div class="modalContainerHeader">
                            <div class="modalTitle">
                                <div class="modal__title">
                                    <svg
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <g clip-path="url(#clip0_28086_43742)">
                                            <path
                                                d="M0 6.99995C0 6.73473 0.105357 6.48038 0.292893 6.29284C0.48043 6.1053 0.734784 5.99995 1 5.99995H18V2.63895C18.002 2.4834 18.0497 2.33188 18.1372 2.20329C18.2247 2.07469 18.3482 1.97472 18.4922 1.91585C18.6362 1.85698 18.7943 1.84181 18.9469 1.87223C19.0994 1.90266 19.2396 1.97734 19.35 2.08695L23.768 6.44795C23.8408 6.51985 23.8986 6.60549 23.9381 6.6999C23.9775 6.79431 23.9978 6.89562 23.9978 6.99795C23.9978 7.10027 23.9775 7.20158 23.9381 7.29599C23.8986 7.39041 23.8408 7.47605 23.768 7.54795L19.35 11.9129C19.2396 12.0226 19.0994 12.0972 18.9469 12.1277C18.7943 12.1581 18.6362 12.1429 18.4922 12.084C18.3482 12.0252 18.2247 11.9252 18.1372 11.7966C18.0497 11.668 18.002 11.5165 18 11.3609V7.99995H1C0.734784 7.99995 0.48043 7.89459 0.292893 7.70705C0.105357 7.51952 0 7.26516 0 6.99995ZM23 15.9999H6V12.6389C5.99804 12.4834 5.95032 12.3319 5.86279 12.2033C5.77526 12.0747 5.6518 11.9747 5.50781 11.9158C5.36383 11.857 5.2057 11.8418 5.05314 11.8722C4.90059 11.9027 4.76038 11.9773 4.65 12.0869L0.232 16.4479C0.159194 16.5198 0.101388 16.6055 0.061935 16.6999C0.0224816 16.7943 0.00216572 16.8956 0.00216572 16.9979C0.00216572 17.1003 0.0224816 17.2016 0.061935 17.296C0.101388 17.3904 0.159194 17.476 0.232 17.5479L4.65 21.9129C4.76038 22.0226 4.90059 22.0972 5.05314 22.1277C5.2057 22.1581 5.36383 22.1429 5.50781 22.084C5.6518 22.0252 5.77526 21.9252 5.86279 21.7966C5.95032 21.668 5.99804 21.5165 6 21.3609V17.9999H23C23.2652 17.9999 23.5196 17.8946 23.7071 17.7071C23.8946 17.5195 24 17.2652 24 16.9999C24 16.7347 23.8946 16.4804 23.7071 16.2928C23.5196 16.1053 23.2652 15.9999 23 15.9999Z"
                                                fill="url(#paint0_linear_28086_43742)"
                                            />
                                        </g>
                                        <defs>
                                            <linearGradient
                                                id="paint0_linear_28086_43742"
                                                x1="12"
                                                y1="1.85693"
                                                x2="12"
                                                y2="22.143"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop stop-color="#5CB1FF" />
                                                <stop
                                                    offset="1"
                                                    stop-color="#396CF4"
                                                />
                                            </linearGradient>
                                            <clipPath id="clip0_28086_43742">
                                                <rect
                                                    width="24"
                                                    height="24"
                                                    fill="white"
                                                />
                                            </clipPath>
                                        </defs>
                                    </svg>

                                    <div class="replaceItem__text">
                                        {{ $t("replaceItem.title") }}
                                    </div>
                                    <div class="moneyback__container">
                                        <div class="moneyback__wrap">
                                            <div class="moneyback__text">
                                                {{ $t("replaceItem.return") }}
                                                {{
                                                    calculatePriceDifference(
                                                        item
                                                    )
                                                }}
                                                ₽
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="modalClose" @click="$emit('close')">
                                <svg
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M19.6278 4.37222C19.3894 4.13389 19.0661 4 18.729 4C18.3919 4 18.0686 4.13389 17.8302 4.37222L12 10.2024L6.16983 4.37222C5.93143 4.13389 5.60813 4 5.27103 4C4.93392 4 4.61062 4.13389 4.37222 4.37222C4.13389 4.61062 4 4.93392 4 5.27103C4 5.60813 4.13389 5.93143 4.37222 6.16983L10.2024 12L4.37222 17.8302C4.13389 18.0686 4 18.3919 4 18.729C4 19.0661 4.13389 19.3894 4.37222 19.6278C4.61062 19.8661 4.93392 20 5.27103 20C5.60813 20 5.93143 19.8661 6.16983 19.6278L12 13.7976L17.8302 19.6278C18.0686 19.8661 18.3919 20 18.729 20C19.0661 20 19.3894 19.8661 19.6278 19.6278C19.8661 19.3894 20 19.0661 20 18.729C20 18.3919 19.8661 18.0686 19.6278 17.8302L13.7976 12L19.6278 6.16983C19.8661 5.93143 20 5.60813 20 5.27103C20 4.93392 19.8661 4.61062 19.6278 4.37222Z"
                                        fill="#687894"
                                    />
                                </svg>
                            </button>
                        </div>
                        <div class="modalContainerBody">
                            <div class="modal__content">
                                <div class="skinReplace__preview">
                                    <div class="skinReplace__item">
                                        <div class="item__info">
                                            <div class="item__firstName">
                                                {{
                                                    getItemType(
                                                        replaceable.item
                                                            .market_hash_name
                                                    )
                                                }}
                                            </div>

                                            <div class="moneyback__container">
                                                <div class="moneyback__wrap">
                                                    <div
                                                        class="moneyback__text"
                                                    >
                                                        {{
                                                            replaceable.item
                                                                .price
                                                        }}
                                                        ₽
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item__secondName">
                                            {{
                                                getItemName(
                                                    replaceable.item
                                                        .market_hash_name
                                                )
                                            }}
                                        </div>
                                    </div>
                                    <div class="skinReplace__delimiter">
                                        <svg
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <g
                                                clip-path="url(#clip0_28086_43936)"
                                            >
                                                <path
                                                    d="M0 6.99995C0 6.73473 0.105357 6.48038 0.292893 6.29284C0.48043 6.1053 0.734784 5.99995 1 5.99995H18V2.63895C18.002 2.4834 18.0497 2.33188 18.1372 2.20329C18.2247 2.07469 18.3482 1.97472 18.4922 1.91585C18.6362 1.85698 18.7943 1.84181 18.9469 1.87223C19.0994 1.90266 19.2396 1.97734 19.35 2.08695L23.768 6.44795C23.8408 6.51985 23.8986 6.60549 23.9381 6.6999C23.9775 6.79431 23.9978 6.89562 23.9978 6.99795C23.9978 7.10027 23.9775 7.20158 23.9381 7.29599C23.8986 7.39041 23.8408 7.47605 23.768 7.54795L19.35 11.9129C19.2396 12.0226 19.0994 12.0972 18.9469 12.1277C18.7943 12.1581 18.6362 12.1429 18.4922 12.084C18.3482 12.0252 18.2247 11.9252 18.1372 11.7966C18.0497 11.668 18.002 11.5165 18 11.3609V7.99995H1C0.734784 7.99995 0.48043 7.89459 0.292893 7.70705C0.105357 7.51952 0 7.26516 0 6.99995ZM23 15.9999H6V12.6389C5.99804 12.4834 5.95032 12.3319 5.86279 12.2033C5.77526 12.0747 5.6518 11.9747 5.50781 11.9158C5.36383 11.857 5.2057 11.8418 5.05314 11.8722C4.90059 11.9027 4.76038 11.9773 4.65 12.0869L0.232 16.4479C0.159194 16.5198 0.101388 16.6055 0.061935 16.6999C0.0224816 16.7943 0.00216572 16.8956 0.00216572 16.9979C0.00216572 17.1003 0.0224816 17.2016 0.061935 17.296C0.101388 17.3904 0.159194 17.476 0.232 17.5479L4.65 21.9129C4.76038 22.0226 4.90059 22.0972 5.05314 22.1277C5.2057 22.1581 5.36383 22.1429 5.50781 22.084C5.6518 22.0252 5.77526 21.9252 5.86279 21.7966C5.95032 21.668 5.99804 21.5165 6 21.3609V17.9999H23C23.2652 17.9999 23.5196 17.8946 23.7071 17.7071C23.8946 17.5195 24 17.2652 24 16.9999C24 16.7347 23.8946 16.4804 23.7071 16.2928C23.5196 16.1053 23.2652 15.9999 23 15.9999Z"
                                                    fill="url(#paint0_linear_28086_43936)"
                                                />
                                            </g>
                                            <defs>
                                                <linearGradient
                                                    id="paint0_linear_28086_43936"
                                                    x1="12"
                                                    y1="1.85693"
                                                    x2="12"
                                                    y2="22.143"
                                                    gradientUnits="userSpaceOnUse"
                                                >
                                                    <stop
                                                        stop-color="#5CB1FF"
                                                    />
                                                    <stop
                                                        offset="1"
                                                        stop-color="#396CF4"
                                                    />
                                                </linearGradient>
                                                <clipPath
                                                    id="clip0_28086_43936"
                                                >
                                                    <rect
                                                        width="24"
                                                        height="24"
                                                        fill="white"
                                                    />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </div>
                                    <div class="skinReplace__itemRight">
                                        <div
                                            v-if="selectedReplaceItem === null"
                                            class="item__none"
                                        >
                                            {{ $t("replaceItem.desc") }}
                                        </div>
                                        <div class="item__info" v-else>
                                            <div class="item__firstName">
                                                {{
                                                    getItemType(
                                                        selectedReplaceItem.market_hash_name
                                                    )
                                                }}
                                            </div>

                                            <div class="moneyback__container">
                                                <div class="moneyback__wrap">
                                                    <div
                                                        class="moneyback__text"
                                                    >
                                                        {{
                                                            selectedReplaceItem.price
                                                        }}
                                                        ₽
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="item__secondName"
                                            v-if="selectedReplaceItem !== null"
                                        >
                                            {{
                                                getItemName(
                                                    selectedReplaceItem.market_hash_name
                                                )
                                            }}
                                        </div>
                                    </div>
                                </div>
                                <div class="skinReplace__body">
                                    <div class="body__scroll">
                                        <div class="skinReplace__list">
                                            <button
                                                v-for="item in items"
                                                :key="item.id"
                                                class="list__item"
                                                :class="[
                                                    getItemRarityClass(
                                                        item.rarity
                                                    ),
                                                ]"
                                                @click="setReplaceItem(item.id)"
                                                :aria-disabled="
                                                    selectedReplaceItem &&
                                                    selectedReplaceItem.id ===
                                                        item.id
                                                        ? 'true'
                                                        : 'false'
                                                "
                                            >
                                                <div
                                                    class="skin__container size--medium"
                                                    :class="[
                                                        getItemRarityClass(
                                                            item.rarity
                                                        ),
                                                    ]"
                                                >
                                                    <div class="skinCard">
                                                        <div
                                                            class="skinCard__price"
                                                        >
                                                            <div
                                                                class="skinCard__price-item"
                                                            >
                                                                {{ item.price }}
                                                                ₽
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="skinCard__image_wrapper"
                                                        >
                                                            <img
                                                                :srcset="
                                                                    'https://steamcommunity-a.akamaihd.net/economy/image/' +
                                                                    item.icon_url
                                                                "
                                                                :alt="
                                                                    item.market_hash_name
                                                                "
                                                                class="skinCard__image"
                                                                loading="lazy"
                                                                decoding="async"
                                                            />
                                                        </div>
                                                        <div
                                                            class="skinCard__backdrop"
                                                        >
                                                            <div
                                                                class="skinIcon__background"
                                                                :class="[
                                                                    getItemRarityClass(
                                                                        item.rarity
                                                                    ),
                                                                ]"
                                                            ></div>
                                                        </div>
                                                        <div
                                                            class="skinCard__footer"
                                                        >
                                                            <div
                                                                class="skinCard__footer_left_side"
                                                            >
                                                                <div
                                                                    class="drops__names"
                                                                >
                                                                    <div
                                                                        class="text color--secondary-text variant--h6"
                                                                    >
                                                                        {{
                                                                            getItemType(
                                                                                item.market_hash_name
                                                                            )
                                                                        }}
                                                                    </div>
                                                                    <div
                                                                        class="name__bottom_replace"
                                                                    >
                                                                        <span
                                                                            class="text color--inherit variant--h6 bold noWrap"
                                                                        >
                                                                            {{
                                                                                getItemName(
                                                                                    item.market_hash_name
                                                                                )
                                                                            }}</span
                                                                        >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="skinCard__backdrop"
                                                    >
                                                        <div
                                                            class="skinIcon__background"
                                                            :class="[
                                                                getItemRarityClass(
                                                                    item.rarity
                                                                ),
                                                            ]"
                                                        ></div>
                                                    </div>
                                                    <div
                                                        class="skinCard__divider"
                                                        :class="[
                                                            getItemRarityClass(
                                                                item.rarity
                                                            ),
                                                        ]"
                                                    ></div>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer__controls">
                                    <button
                                        class="controls color--blue-gradient size--large full-width button"
                                        :disabled="
                                            !selectedReplaceItem || !replaceable
                                        "
                                        type="button"
                                        @click="replaceItem"
                                    >
                                        <div class="button__content">
                                            <div
                                                class="text color--inherit variant--h5 bold uppercase"
                                            >
                                                {{ $t("replaceItem.replace") }}
                                            </div>
                                        </div></button
                                    ><button
                                        @click="$emit('close')"
                                        class="controls color--gray-primary size--large full-width button"
                                        type="button"
                                    >
                                        <div class="button__content">
                                            <div
                                                class="text color--inherit variant--h5 bold uppercase"
                                            >
                                                {{ $t("replaceItem.cancel") }}
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
import {
    getExteriorInsideBrackets,
    getItemName,
    getItemRarityClass,
    getItemType,
} from "../../helpers/helper.js";
export default {
    data() {
        return {
            selectedReplaceItem: null,
            item: [],
        };
    },
    props: {
        items: {
            type: Array,
            required: true,
        },
        replaceable: {
            type: [Array, Object],
            required: true,
        },
    },
    methods: {
        setReplaceItem(id) {
            this.$root.playSound("upgrade-select-item2");

            let index = this.items.findIndex((item) => item.id === id);
            let item = this.items[index];

            console.log("item:", item);
            console.log("index:", index);

            this.selectedReplaceItem = this.items[index];
            this.$forceUpdate();
        },
        async replaceItem() {
            if (!this.replaceable || !this.selectedReplaceItem) {
                this.$toast.error("Выберите новый предмет для замены");
                return;
            }

            try {
                const response = await axios.post("/user/replace", {
                    current_item_id: this.replaceable.id,
                    new_item_id: this.selectedReplaceItem.id,
                });

                console.log("replaceable", this.replaceable);

                if (response.data.success) {
                    console.log("Замена выполнена успешно:", response.data);

                    this.$toast.success(response.data.message);
                    this.$emit("close");
                    this.$emit("profileFetched");
                    this.$emit("update-items");
                    this.$forceUpdate();
                } else {
                    this.$toast.error(response.data.message);
                }
            } catch (error) {
                console.error("Ошибка при вызове API:", error);
            }
        },
        calculatePriceDifference(item) {
            if (this.selectedReplaceItem) {
                return (
                    this.replaceable.price - this.selectedReplaceItem.price
                ).toFixed(2); // округляем до двух знаков
            }
            return 0;
        },
        getExteriorInsideBrackets,
        getItemName,
        getItemRarityClass,
        getItemType,
    },
};
</script>
