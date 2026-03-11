<template>
    <div class="container">
        <!-- <div class="eventBanner__wrapper">
            <div class="event__banner">
                <div
                    class="event__background imageBanner fresnel-lessThan-smXl fresnel-:r0:"
                    style="background-image: url('/assets/event/banner.png')"
                ></div>
                <div
                    class="event__background imageBanner fresnel-greaterThanOrEqual-smXl fresnel-:r1:"
                    style="background-image: url('/assets/event/banner.png')"
                ></div>
                <div class="event__banner__content">
                    <div class="eventLogo__wrapper">
                        <div
                            class="event__logo fresnel-lessThan-smXl fresnel-:r2:"
                            style="
                                background-image: url('/assets/event/logo.png');
                            "
                        ></div>
                        <div
                            class="event__logo fresnel-greaterThanOrEqual-smXl fresnel-:r3:"
                            style="
                                background-image: url('/assets/event/logo.png');
                            "
                        ></div>
                    </div>
                </div>
            </div>
           <div class="global-intro__secondary-item">
                <div
                    class="carousel-item carousel-item_mini carousel-item_code"
                    action="copy"
                    data-value="7E1B96EC-6AB3-46C2-9878"
                >
                    <div class="carousel-item__title">
                        Бонус к пополнению
                        <strong>{{ dailyPromo.percent }} %</strong>
                    </div>
                    <div class="carousel-item__text">{{ dailyPromo.code }}</div>
                    <div class="carousel-item__timer"></div>
                    <div class="carousel-item__btn">
                        <button
                            @click="copyPromo"
                            class="carousel-item__btn-mix btn_custom btn_color-light btn_uppercase btn_fullwidth btn_with-icon"
                        >
                            <div class="btn__content">
                                <div class="btn__label">Скопировать</div>
                            </div>
                        </button>
                    </div>
                </div>
            </div> 
        </div> -->
        <div class="global-intro">
            <div class="global-intro__grid">
                <div class="global-intro__main">
                    <div class="global-carousel">
                        <div class="global-carousel__wrapper">
                            <div class="global-carousel__items">
                                <div
                                    class="global-carousel__item"
                                    style="order: 0"
                                >
                                    <div
                                        class="carousel-item carousel-item_big carousel-item_responsive carousel-item_event"
                                        style="
                                            background-image: url(/assets/event/banner.png);
                                        "
                                    >
                                        <!-- <div class="carousel-item__title">
                                            Pick’em IEM Melbourne
                                        </div>
                                        <div class="carousel-item__text">
                                            Новый ивент от ForceDrop к турниру
                                            IEM Melbourne 2025. Угадывай места
                                            команд и получай награды
                                        </div> -->

                                        <!-- <div class="carousel-item__btn">
                                            <button
                                                class="home__btn home__btn_color-light home__btn_uppercase home__btn_fullwidth"
                                            >
                                                <div class="home__btn__content">
                                                    <div
                                                        class="home__btn__label"
                                                    >
                                                        К событию
                                                    </div>
                                                </div>
                                            </button>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="global-intro__secondary">
                    <div class="global-intro__secondary-item">
                        <div
                            class="carousel-item carousel-item_mini carousel-item_code"
                        >
                            <div class="carousel-item__title">
                                Бонус к пополнению
                                <strong>{{ dailyPromo.percent }} %</strong>
                            </div>
                            <div class="carousel-item__text">
                                {{ dailyPromo.code }}
                            </div>
                            <div class="carousel-item__timer"></div>
                            <div class="carousel-item__btn">
                                <button
                                    @click="copyPromo"
                                    class="carousel-item__btn-mix home__btn home__btn_color-light home__btn_uppercase home__btn_fullwidth home__btn_with-icon"
                                >
                                    <div class="home__btn__content">
                                        <div class="home__btn__label">
                                            Скопировать
                                        </div>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="global-intro__secondary-item">
                        <router-link
                            to="/wheel"
                            class="carousel-item carousel-item_mini carousel-item_dailybonus carousel-item_available"
                        >
                            <div class="carousel-item__title">
                                Ежедневный бонус
                            </div>
                            <div class="carousel-item__text">Уже доступен!</div>

                            <div class="carousel-item__btn">
                                <button
                                    class="home__btn home__btn_color-info home__btn_uppercase home__btn_fullwidth home__btn_with-icon"
                                >
                                    <div class="home__btn__content">
                                        <div
                                            class="home__btn__icon home__icon icon_dialy"
                                        ></div>
                                        <div class="home__btn__label">
                                            Получить
                                        </div>
                                    </div>
                                </button>
                            </div>
                        </router-link>
                    </div>
                </div>
            </div>
            <div class="global-intro__popups"></div>
        </div>
        <div class="banner__wrapper">
            <div class="MainContainer">
                <div class="CategoryFilter">
                    <div class="IconCategoryFilter">
                        <svg
                            class="IconCategoryFilter"
                            width="48"
                            height="48"
                            viewBox="0 0 48 48"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <rect
                                x="0.5"
                                y="0.5"
                                width="47"
                                height="47"
                                rx="11.5"
                                fill="url(#paint0_linear_4_659)"
                            />
                            <rect
                                x="0.5"
                                y="0.5"
                                width="47"
                                height="47"
                                rx="11.5"
                                stroke="url(#paint1_linear_4_659)"
                            />
                            <g clip-path="url(#clip0_4_659)">
                                <path
                                    d="M24 26.4938C22.6193 26.4938 21.5 27.6131 21.5 28.9938V33.9938H26.5V28.9938C26.5 27.6131 25.3807 26.4938 24 26.4938Z"
                                    fill="#1C439E"
                                />
                                <path
                                    d="M28.1667 28.9938V33.9938H31.5C32.8807 33.9938 34 32.8745 34 31.4938V23.893C34.0002 23.46 33.832 23.044 33.5308 22.733L26.4492 15.0771C25.1996 13.7251 23.0907 13.6421 21.7388 14.8917C21.6746 14.951 21.6127 15.0129 21.5534 15.0771L14.4842 22.7305C14.1739 23.0428 13.9999 23.4652 14 23.9055V31.4938C14 32.8745 15.1193 33.9938 16.5 33.9938H19.8333V28.9938C19.8489 26.7214 21.6836 24.8658 23.8987 24.8124C26.1879 24.7571 28.1492 26.6444 28.1667 28.9938Z"
                                    fill="#1C439E"
                                />
                                <path
                                    d="M24 26.4938C22.6193 26.4938 21.5 27.6131 21.5 28.9938V33.9938H26.5V28.9938C26.5 27.6131 25.3807 26.4938 24 26.4938Z"
                                    fill="#1C439E"
                                />
                            </g>
                            <defs>
                                <linearGradient
                                    id="paint0_linear_4_659"
                                    x1="24"
                                    y1="0"
                                    x2="24"
                                    y2="48"
                                    gradientUnits="userSpaceOnUse"
                                >
                                    <stop stop-color="#5CB1FF" />
                                    <stop offset="1" stop-color="#396CF4" />
                                </linearGradient>
                                <linearGradient
                                    id="paint1_linear_4_659"
                                    x1="24"
                                    y1="0"
                                    x2="24"
                                    y2="48"
                                    gradientUnits="userSpaceOnUse"
                                >
                                    <stop stop-color="#9FCFFF" />
                                    <stop offset="1" stop-color="#1B4ECA" />
                                </linearGradient>
                                <clipPath id="clip0_4_659">
                                    <rect
                                        width="20"
                                        height="20"
                                        fill="white"
                                        transform="translate(14 14)"
                                    />
                                </clipPath>
                            </defs>
                        </svg>
                    </div>
                    <ul class="ListCategoryFilter">
                        <li
                            class="ListCategoryFilter__elem"
                            :aria-checked="
                                activeCategory === category.name
                                    ? 'true'
                                    : 'false'
                            "
                            v-for="(category, index) in filteredCategories"
                            :key="index"
                            @click="scrollToCategory(category.name)"
                        >
                            <a
                                href="javascript:void(0)"
                                class="ListCategoryFilter__link uppercase"
                            >
                                {{
                                    category[
                                        $root.lang === "EN"
                                            ? "name_en"
                                            : $root.lang === "UK"
                                            ? "name_uk"
                                            : $root.lang === "RU"
                                            ? "name"
                                            : "name"
                                    ] || category.name
                                }}
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="PriceFilter"></div>
            </div>
        </div>
        <div
            class="categoryContainer casesSection"
            v-for="(category, index) in filteredCategories"
            :key="index"
            :id="`category-${category.name.replace(/\s/g, '-')}`"
        >
            <div
                class="CategoryHeading"
                v-if="category.name === 'Бесплатные кейсы'"
            >
                <button
                    class="controls color--gray fit-content button CategoryHeading__button"
                    type="button"
                >
                    <div class="button__content">
                        <svg
                            width="22"
                            height="22"
                            viewBox="0 0 24 24"
                            fill="none"
                            class="icon"
                        >
                            <g
                                clip-path="url(#info-filled_svg__info-filled_svg__clip0_11866_22071)"
                            >
                                <path
                                    d="M12 0C5.368 0 0 5.367 0 12c0 6.632 5.367 12 12 12 6.632 0 12-5.367 12-12 0-6.632-5.367-12-12-12zm1.232 16.764c0 .379-.552.758-1.232.758-.71 0-1.216-.38-1.216-.758v-6.019c0-.442.505-.742 1.216-.742.68 0 1.232.3 1.232.742v6.019zM12 8.55c-.726 0-1.295-.537-1.295-1.138 0-.6.569-1.121 1.295-1.121.711 0 1.28.521 1.28 1.121S12.71 8.55 12 8.55z"
                                    fill="#687894"
                                ></path>
                            </g>
                            <defs>
                                <clipPath
                                    id="info-filled_svg__info-filled_svg__clip0_11866_22071"
                                >
                                    <path fill="#fff" d="M0 0h24v24H0z"></path>
                                </clipPath>
                            </defs>
                        </svg>
                        <div class="text color--text3 variant--h20 uppercase">
                            {{ $t("main.what") }}
                        </div>
                    </div>
                </button>
                <div class="desc_hover">
                    <div class="text variant--h30">
                        {{ $t("main.desc") }}
                    </div>
                </div>
                <div class="MainContainer__header">
                    <div
                        class="text color--inherit variant--h1 align--center bold uppercase"
                    >
                        {{
                            category[
                                $root.lang === "EN"
                                    ? "name_en"
                                    : $root.lang === "UK"
                                    ? "name_uk"
                                    : $root.lang === "RU"
                                    ? "name"
                                    : "name"
                            ] || category.name
                        }}
                    </div>
                    <span
                        class="uppercase"
                        v-if="category.name === 'Бесплатные кейсы'"
                        >{{ $t("main.pay") }} <b>0.00 $</b>
                    </span>
                </div>
            </div>
            <div
                class="MainContainer__header"
                v-if="category.name !== 'Бесплатные кейсы'"
            >
                <div
                    class="text color--inherit variant--h1 align--center bold uppercase"
                >
                    {{
                        category[
                            $root.lang === "EN"
                                ? "name_en"
                                : $root.lang === "UK"
                                ? "name_uk"
                                : $root.lang === "RU"
                                ? "name"
                                : "name"
                        ] || category.name
                    }}
                </div>
            </div>
            <div class="cases__list">
                <div class="cases__list" v-if="loading">
                    <div class="box__wrapper" v-for="n in 5" :key="n">
                        <div class="box__card">
                            <div class="PaperBoxStyled">
                                <img
                                    src="/assets/cases/unknown.png"
                                    alt="unknown"
                                    class="box__image"
                                />
                            </div>
                            <div class="box__info">
                                <div class="box__name_unknown"></div>
                                <div class="box__price_unknown"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <router-link
                    v-else
                    :to="{
                        name: 'case',
                        params: {
                            url: box.url,
                        },
                    }"
                    class="box__wrapper"
                    v-for="(box, index) in category.boxes"
                    :key="index"
                >
                    <div class="box__card">
                        <!-- <div class="Label__NEW">NEW</div> -->
                        <div class="PaperBoxStyled">
                            <img
                                class="box__image"
                                :src="'/assets/img/cases/' + box.image"
                                :alt="box.name"
                            />
                        </div>
                        <div class="box__info">
                            <div class="box__name">
                                {{
                                    box[
                                        $root.lang === "EN"
                                            ? "name_en"
                                            : $root.lang === "UK"
                                            ? "name_uk"
                                            : $root.lang === "RU"
                                            ? "name"
                                            : "name"
                                    ] || box.name
                                }}
                            </div>

                            <div class="box__price">
                                <span>
                                    {{
                                        box.price === 0
                                            ? "FREE"
                                            : `${box.price} ₽`
                                    }}</span
                                >
                            </div>
                        </div>
                    </div>
                </router-link>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            list: [],
            activeCategory: null,
            loading: true,
            dailyPromo: null,
        };
    },
    computed: {
        filteredCategories() {
            return this.list.filter(
                (category) =>
                    category.name !== "partners" &&
                    category.name !== "free_cases" && // Исключаем категорию 'partners'
                    category.boxes &&
                    category.boxes.length > 0 // Оставляем только категории с кейсами
            );
        },
    },
    mounted() {
        this.getBoxes();
        this.getDailyPromo();
    },
    methods: {
        async getDailyPromo() {
            try {
                const res = await this.axios.get("/live/dailyPromo");
                this.dailyPromo = res.data;
                console.log("daily", this.dailyPromo);
            } catch (error) {
                console.error("Error fetching live data:", error);
            }
        },
        async getBoxes() {
            await this.axios.get("/case/getAll").then((res) => {
                const result = res.data;
                this.list = result.list;
                console.log("кейсы", this.list);

                this.loading = false;
            });
        },
        copyPromo() {
            navigator.clipboard.writeText(this.dailyPromo.code).then(() => {
                this.$toast.success("Промокод скопирован");
            });
        },
        scrollToCategory(categoryName) {
            this.activeCategory = categoryName; // Устанавливаем активную категорию
            const elementId = `category-${categoryName.replace(/\s/g, "-")}`;
            const targetElement = document.getElementById(elementId);
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: "smooth",
                    block: "start",
                });
            }
        },
    },
};
</script>
