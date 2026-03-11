<template>
    <div
        v-show="isOpened"
        :class="{ opened: isOpened }"
        class="modal confirm-sell-modal"
    >
        <button type="button" class="abs-link"></button>
        <div class="modal-content">
            <button
                @click="closeSaleModal"
                type="button"
                class="modal-close-btn"
            >
                <i></i>
            </button>
            <div class="modal-title-wrap">
                <span class="modal-title"
                    >ВЫ ДЕЙСТВИТЕЛЬНО ХОТИТЕ ПРОДАТЬ ВСЕ СВОИ ПРЕДМЕТЫ?</span
                >
            </div>
            <div class="confirm-sell-textbox">
                <p>
                    Подтвердите продажу {{ countItems }}
                    {{
                        morph(countItems, ["предмет", "предмета", "предметов"])
                    }}
                    за {{ allPrice | number }}₽
                </p>
            </div>
            <div class="bordered-panel">
                <span class="case-content-title">Предметы к продаже</span>
                <div class="case-skins-list">
                    <div
                        v-for="(item, index) in items"
                        :key="index"
                        :class="[getItemRarityClass(item.item.rarity)]"
                        class="_weapon-item"
                        style="opacity: 1"
                    >
                        <div class="item-holder">
                            <div class="weapon-pic">
                                <picture>
                                    <img
                                        :srcset="
                                            'https://steamcommunity-a.akamaihd.net/economy/image/' +
                                            item.item.icon_url +
                                            '/170fx128f/image.png'
                                        "
                                        alt=""
                                        class="img-responsive"
                                    />
                                </picture>
                            </div>
                            <div class="item-desc">
                                <span
                                    class="weapon-type"
                                    v-html="
                                        getItemType(item.item.market_hash_name)
                                    "
                                ></span>
                                <span
                                    class="weapon-name"
                                    v-html="
                                        getItemName(item.item.market_hash_name)
                                    "
                                ></span>
                            </div>
                            <div class="center-target">
                                <div class="gradient"></div>
                                <img
                                    src="/assets/images/target-bg.webp"
                                    alt=""
                                />
                            </div>
                            <div class="glow">
                                <i class="glow-line"><i></i></i>
                            </div>
                        </div>
                    </div>

                    <div
                        v-for="(element, elementIndex) in 9 - items.length"
                        class="_weapon-item rare-1"
                        style="opacity: 0.3"
                    >
                        <div class="item-holder">
                            <div class="weapon-pic"></div>
                            <div class="item-desc">
                                <span class="weapon-name"></span>
                            </div>
                            <div class="center-target">
                                <div class="gradient"></div>
                                <img
                                    src="/assets/images/target-bg.webp"
                                    alt=""
                                />
                            </div>
                            <div class="glow">
                                <i class="glow-line"><i></i></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form class="form rules-agree-form">
                <div class="form-submit-row">
                    <button
                        @click="sellAllItems"
                        class="button _with-arrow"
                        type="button"
                    >
                        <span>Подтвердить</span>
                    </button>
                    <button
                        @click="closeSaleModal"
                        class="button _with-border"
                        type="button"
                    >
                        <span>Отклонить</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import {
    getItemName,
    getItemRarityClass,
    getItemType,
    morph,
} from "../../helpers/helper";

export default {
    data() {
        return {
            isOpened: false,
            items: [],
            allPrice: 0,
            countItems: 0,
        };
    },
    mounted() {
        this.$root.$on("openSaleModal", () => {
            this.isOpened = true;
            this.getItemsForSale();
        });
    },
    methods: {
        morph,
        async getItemsForSale() {
            await this.axios
                .post("/user/profile/sale-items/get")
                .then((res) => {
                    const result = res.data;

                    this.items = result.items;
                    this.allPrice = result.allPrice;
                    this.countItems = result.countItems;
                });
        },
        async sellAllItems() {
            if (this.items.length < 1) {
                return this.$toast.error("Нет предметов для продажи");
            }

            this.$root.sellItems([], true);
            this.isOpened = false;
            this.$root.$emit("itemsSellSuccess");
        },
        closeSaleModal() {
            this.isOpened = false;
        },
        getItemName,
        getItemType,
        getItemRarityClass,
    },
};
</script>
