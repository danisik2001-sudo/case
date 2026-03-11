<template>
    <div class="container">
        <div class="box__page">
            <div class="box__pageMain">
                <div class="caseHeader__wrapper">
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
                    <span class="uppercase">
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
                        }}</span
                    >
                </div>
                <div class="caseMain__wrapper">
                    <div class="MainContainer__header">
                        <div
                            class="text color--disabled variant--h1 align--center bold uppercase"
                        >
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
                    </div>
                    <div
                        class="openCaseMain__wrapper"
                        :class="{
                            open: state === 'roulette' || state === 'win',
                        }"
                    >
                        <div class="playing__runners">
                            <div class="box__roulette">
                                <div class="box__roulettes">
                                    <div class="rouletteRow__wrapper">
                                        <div class="roulette__row">
                                            <div
                                                class="started__state"
                                                v-if="
                                                    winItems.length < 2 &&
                                                    (state === 'roulette' ||
                                                        state === 'win')
                                                "
                                                :aria-hidden="
                                                    state === 'roulette'
                                                        ? 'false'
                                                        : 'true'
                                                "
                                            >
                                                <div class="roulette__spin">
                                                    <div
                                                        class="roulette__paper"
                                                        :aria-hidden="
                                                            state === 'roulette'
                                                                ? 'false'
                                                                : 'true'
                                                        "
                                                    >
                                                        <div
                                                            class="left__shadow"
                                                        ></div>
                                                        <div
                                                            class="roulette__items"
                                                        >
                                                            <div
                                                                class="rouletteItem__wrapper"
                                                                v-for="(
                                                                    item, index
                                                                ) in rouletteItems"
                                                                :key="index"
                                                            >
                                                                <div
                                                                    class="skin__container size--medium"
                                                                    :class="[
                                                                        getItemRarityClass(
                                                                            item.item &&
                                                                                item
                                                                                    .item
                                                                                    .rarity
                                                                        ),
                                                                    ]"
                                                                >
                                                                    <div
                                                                        class="skinCard"
                                                                    >
                                                                        <div
                                                                            class="skinCard__image_wrapper"
                                                                        >
                                                                            <img
                                                                                :srcset="
                                                                                    'https://steamcommunity-a.akamaihd.net/economy/image/' +
                                                                                    (item.item &&
                                                                                        item
                                                                                            .item
                                                                                            .icon_url)
                                                                                "
                                                                                :alt="
                                                                                    item.item &&
                                                                                    item
                                                                                        .item
                                                                                        .market_hash_name
                                                                                "
                                                                                loading="lazy"
                                                                                decoding="async"
                                                                                class="skinCard__image"
                                                                            />
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
                                                                                                item.item &&
                                                                                                    item
                                                                                                        .item
                                                                                                        .market_hash_name
                                                                                            )
                                                                                        }}
                                                                                    </div>
                                                                                    <div
                                                                                        class="name__bottom"
                                                                                    >
                                                                                        <span
                                                                                            class="text color--disabled variant--h4 bold noWrap"
                                                                                            >{{
                                                                                                getItemName(
                                                                                                    item.item &&
                                                                                                        item
                                                                                                            .item
                                                                                                            .market_hash_name
                                                                                                )
                                                                                            }}
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="skinCard__backdrops"
                                                                    >
                                                                        <div
                                                                            class="skinIcon__backgrounds"
                                                                            :class="[
                                                                                getItemRarityClass(
                                                                                    item.item &&
                                                                                        item
                                                                                            .item
                                                                                            .rarity
                                                                                ),
                                                                            ]"
                                                                        ></div>
                                                                    </div>
                                                                    <div
                                                                        class="skinCard__divider"
                                                                        :class="[
                                                                            getItemRarityClass(
                                                                                item.item &&
                                                                                    item
                                                                                        .item
                                                                                        .rarity
                                                                            ),
                                                                        ]"
                                                                    ></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="right__shadow"
                                                        ></div>
                                                    </div>
                                                    <div
                                                        class="arrow__top"
                                                        :aria-hidden="
                                                            state === 'roulette'
                                                                ? 'false'
                                                                : 'true'
                                                        "
                                                    >
                                                        <svg
                                                            width="34"
                                                            height="31"
                                                            viewBox="0 0 34 31"
                                                            fill="none"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                        >
                                                            <path
                                                                d="M22.7589 25.2461C20.2014 29.5847 13.7986 29.5847 11.2411 25.2461L2.39893 10.2461C-0.146285 5.92836 3.02452 0.5 8.15772 0.5H25.8423C30.9755 0.5 34.1463 5.92835 31.6011 10.2461L22.7589 25.2461Z"
                                                                fill="#252E40"
                                                                stroke="#323E56"
                                                            />
                                                            <g
                                                                filter="url(#filter0_d_119_3448)"
                                                            >
                                                                <path
                                                                    d="M19.653 21.5C18.474 23.5 15.5266 23.5 14.3476 21.5L7.27382 9.5C6.09486 7.5 7.56859 5 9.92652 5H24.0741C26.432 5 27.9058 7.5 26.7268 9.5L19.653 21.5Z"
                                                                    fill="url(#paint0_linear_119_3448)"
                                                                />
                                                            </g>
                                                            <defs>
                                                                <filter
                                                                    id="filter0_d_119_3448"
                                                                    x="0.858887"
                                                                    y="1"
                                                                    width="32.2827"
                                                                    height="30"
                                                                    filterUnits="userSpaceOnUse"
                                                                    color-interpolation-filters="sRGB"
                                                                >
                                                                    <feFlood
                                                                        flood-opacity="0"
                                                                        result="BackgroundImageFix"
                                                                    />
                                                                    <feColorMatrix
                                                                        in="SourceAlpha"
                                                                        type="matrix"
                                                                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                                                                        result="hardAlpha"
                                                                    />
                                                                    <feOffset
                                                                        dy="2"
                                                                    />
                                                                    <feGaussianBlur
                                                                        stdDeviation="3"
                                                                    />
                                                                    <feComposite
                                                                        in2="hardAlpha"
                                                                        operator="out"
                                                                    />
                                                                    <feColorMatrix
                                                                        type="matrix"
                                                                        values="0 0 0 0 0.0376273 0 0 0 0 0.114716 0 0 0 0 0.265102 0 0 0 0.45 0"
                                                                    />
                                                                    <feBlend
                                                                        mode="normal"
                                                                        in2="BackgroundImageFix"
                                                                        result="effect1_dropShadow_119_3448"
                                                                    />
                                                                    <feBlend
                                                                        mode="normal"
                                                                        in="SourceGraphic"
                                                                        in2="effect1_dropShadow_119_3448"
                                                                        result="shape"
                                                                    />
                                                                </filter>
                                                                <linearGradient
                                                                    id="paint0_linear_119_3448"
                                                                    x1="17.0003"
                                                                    y1="26"
                                                                    x2="17.0003"
                                                                    y2="-2"
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
                                                            </defs>
                                                        </svg>
                                                    </div>
                                                    <div
                                                        class="arrow__bottom"
                                                        :aria-hidden="
                                                            state === 'roulette'
                                                                ? 'false'
                                                                : 'true'
                                                        "
                                                    >
                                                        <svg
                                                            width="34"
                                                            height="32"
                                                            viewBox="0 0 34 32"
                                                            fill="none"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                        >
                                                            <path
                                                                d="M11.2411 3.75391C13.7986 -0.584671 20.2014 -0.58467 22.7589 3.75391L31.6011 18.7539C34.1463 23.0716 30.9755 28.5 25.8423 28.5L8.1577 28.5C3.02447 28.5 -0.146278 23.0716 2.39894 18.7539L11.2411 3.75391Z"
                                                                fill="#252E40"
                                                                stroke="#323E56"
                                                            />
                                                            <g
                                                                filter="url(#filter0_d_119_3451)"
                                                            >
                                                                <path
                                                                    d="M14.347 7.5C15.526 5.5 18.4734 5.5 19.6524 7.5L26.7262 19.5C27.9051 21.5 26.4314 24 24.0735 24L9.92589 24C7.56796 24 6.09423 21.5 7.2732 19.5L14.347 7.5Z"
                                                                    fill="url(#paint0_linear_119_3451)"
                                                                />
                                                            </g>
                                                            <defs>
                                                                <filter
                                                                    id="filter0_d_119_3451"
                                                                    x="0.858398"
                                                                    y="2"
                                                                    width="32.2827"
                                                                    height="30"
                                                                    filterUnits="userSpaceOnUse"
                                                                    color-interpolation-filters="sRGB"
                                                                >
                                                                    <feFlood
                                                                        flood-opacity="0"
                                                                        result="BackgroundImageFix"
                                                                    />
                                                                    <feColorMatrix
                                                                        in="SourceAlpha"
                                                                        type="matrix"
                                                                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                                                                        result="hardAlpha"
                                                                    />
                                                                    <feOffset
                                                                        dy="2"
                                                                    />
                                                                    <feGaussianBlur
                                                                        stdDeviation="3"
                                                                    />
                                                                    <feComposite
                                                                        in2="hardAlpha"
                                                                        operator="out"
                                                                    />
                                                                    <feColorMatrix
                                                                        type="matrix"
                                                                        values="0 0 0 0 0.0376273 0 0 0 0 0.114716 0 0 0 0 0.265102 0 0 0 0.45 0"
                                                                    />
                                                                    <feBlend
                                                                        mode="normal"
                                                                        in2="BackgroundImageFix"
                                                                        result="effect1_dropShadow_119_3451"
                                                                    />
                                                                    <feBlend
                                                                        mode="normal"
                                                                        in="SourceGraphic"
                                                                        in2="effect1_dropShadow_119_3451"
                                                                        result="shape"
                                                                    />
                                                                </filter>
                                                                <linearGradient
                                                                    id="paint0_linear_119_3451"
                                                                    x1="16.9997"
                                                                    y1="3"
                                                                    x2="16.9997"
                                                                    y2="31"
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
                                                            </defs>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="preview__state"
                                                v-if="state === 'default'"
                                            >
                                                <div class="roulette__box">
                                                    <div class="box__image">
                                                        <img
                                                            :src="
                                                                '/assets/img/cases/' +
                                                                box.image
                                                            "
                                                            :alt="box.name"
                                                            class="image"
                                                            loading="eager"
                                                            decoding="async"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="roulette__rows"
                                                v-if="
                                                    winItems.length >= 2 &&
                                                    (state === 'roulette' ||
                                                        state === 'win')
                                                "
                                            >
                                                <div
                                                    class="slot__row"
                                                    v-for="(
                                                        winItem, winIndex
                                                    ) in winItems"
                                                    :key="winIndex"
                                                >
                                                    <div
                                                        class="row__column"
                                                        :aria-hidden="
                                                            state === 'roulette'
                                                                ? 'false'
                                                                : 'true'
                                                        "
                                                    >
                                                        <div
                                                            class="started__state"
                                                            :aria-hidden="
                                                                state ===
                                                                'roulette'
                                                                    ? 'false'
                                                                    : 'true'
                                                            "
                                                        >
                                                            <div class="slot">
                                                                <div
                                                                    class="slot__items"
                                                                >
                                                                    <div
                                                                        class="slot__drop"
                                                                        v-for="(
                                                                            item,
                                                                            itemIndex
                                                                        ) in rouletteItems[
                                                                            winIndex
                                                                        ]"
                                                                        :key="
                                                                            itemIndex
                                                                        "
                                                                        style="
                                                                            margin: 3px;
                                                                        "
                                                                        :class="[
                                                                            getItemRarityClass(
                                                                                item
                                                                                    .item
                                                                                    .rarity
                                                                            ),
                                                                        ]"
                                                                    >
                                                                        <div
                                                                            class="drop__imageContainer"
                                                                        >
                                                                            <div
                                                                                class="rarity__icon"
                                                                            >
                                                                                <div
                                                                                    class="skinIcon__background"
                                                                                    :class="[
                                                                                        getItemRarityClass(
                                                                                            item
                                                                                                .item
                                                                                                .rarity
                                                                                        ),
                                                                                    ]"
                                                                                ></div>
                                                                            </div>
                                                                            <img
                                                                                :srcset="
                                                                                    'https://steamcommunity-a.akamaihd.net/economy/image/' +
                                                                                    item
                                                                                        .item
                                                                                        .icon_url +
                                                                                    '/170fx128f'
                                                                                "
                                                                                class="drop__icon"
                                                                                loading="lazy"
                                                                                decoding="async"
                                                                            />
                                                                            <div
                                                                                class="skinCard__divider"
                                                                                :class="[
                                                                                    getItemRarityClass(
                                                                                        item
                                                                                            .item
                                                                                            .rarity
                                                                                    ),
                                                                                ]"
                                                                            ></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="result__state"
                                                            v-if="
                                                                winItems.length >
                                                                    1 &&
                                                                state === 'win'
                                                            "
                                                        >
                                                            <div
                                                                class="result__item"
                                                            >
                                                                <div
                                                                    class="item__drop"
                                                                >
                                                                    <div
                                                                        class="main__container"
                                                                    >
                                                                        <div
                                                                            class="skin__icon"
                                                                        >
                                                                            <div
                                                                                class="skinIcon__background"
                                                                                :class="
                                                                                    getItemRarityClass(
                                                                                        winItem.item &&
                                                                                            winItem
                                                                                                .item
                                                                                                .rarity
                                                                                    )
                                                                                "
                                                                            ></div>
                                                                        </div>
                                                                    </div>
                                                                    <img
                                                                        :srcset="
                                                                            'https://steamcommunity-a.akamaihd.net/economy/image/' +
                                                                            (winItem.item &&
                                                                                winItem
                                                                                    .item
                                                                                    .icon_url)
                                                                        "
                                                                        :alt="
                                                                            winItem.item &&
                                                                            winItem
                                                                                .item
                                                                                .market_hash_name
                                                                        "
                                                                        class="drop__image"
                                                                        loading="eager"
                                                                        decoding="async"
                                                                    />
                                                                    <div
                                                                        class="drop__info"
                                                                    >
                                                                        <div
                                                                            class="info__weapon"
                                                                        >
                                                                            {{
                                                                                getItemType(
                                                                                    winItem.item &&
                                                                                        winItem
                                                                                            .item
                                                                                            .market_hash_name
                                                                                )
                                                                            }}
                                                                        </div>
                                                                        <div
                                                                            class="info__name"
                                                                        >
                                                                            {{
                                                                                getItemName(
                                                                                    winItem.item &&
                                                                                        winItem
                                                                                            .item
                                                                                            .market_hash_name
                                                                                )
                                                                            }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="arrow__left"
                                                    :aria-hidden="
                                                        state === 'roulette'
                                                            ? 'false'
                                                            : 'true'
                                                    "
                                                >
                                                    <svg
                                                        width="30"
                                                        height="35"
                                                        viewBox="0 0 30 35"
                                                        fill="none"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                    >
                                                        <path
                                                            d="M26.2461 10.7411C30.5847 13.2986 30.5847 19.7014 26.2461 22.2589L11.2461 31.1011C6.92836 33.6463 1.5 30.4755 1.5 25.3423L1.5 7.6577C1.5 2.52447 6.92835 -0.646279 11.2461 1.89894L26.2461 10.7411Z"
                                                            fill="#252E40"
                                                            stroke="#323E56"
                                                        />
                                                        <g
                                                            filter="url(#filter0_d_122_5699)"
                                                        >
                                                            <path
                                                                d="M22.5 13.847C24.5 15.026 24.5 17.9734 22.5 19.1524L10.5 26.2262C8.5 27.4052 6 25.9314 6 23.5735L6 9.42592C6 7.06799 8.5 5.59426 10.5 6.77323L22.5 13.847Z"
                                                                fill="url(#paint0_linear_122_5699)"
                                                            />
                                                        </g>
                                                        <defs>
                                                            <filter
                                                                id="filter0_d_122_5699"
                                                                x="0"
                                                                y="2.35828"
                                                                width="30"
                                                                height="32.2829"
                                                                filterUnits="userSpaceOnUse"
                                                                color-interpolation-filters="sRGB"
                                                            >
                                                                <feFlood
                                                                    flood-opacity="0"
                                                                    result="BackgroundImageFix"
                                                                />
                                                                <feColorMatrix
                                                                    in="SourceAlpha"
                                                                    type="matrix"
                                                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                                                                    result="hardAlpha"
                                                                />
                                                                <feOffset
                                                                    dy="2"
                                                                />
                                                                <feGaussianBlur
                                                                    stdDeviation="3"
                                                                />
                                                                <feComposite
                                                                    in2="hardAlpha"
                                                                    operator="out"
                                                                />
                                                                <feColorMatrix
                                                                    type="matrix"
                                                                    values="0 0 0 0 0.0376273 0 0 0 0 0.114716 0 0 0 0 0.265102 0 0 0 0.45 0"
                                                                />
                                                                <feBlend
                                                                    mode="normal"
                                                                    in2="BackgroundImageFix"
                                                                    result="effect1_dropShadow_122_5699"
                                                                />
                                                                <feBlend
                                                                    mode="normal"
                                                                    in="SourceGraphic"
                                                                    in2="effect1_dropShadow_122_5699"
                                                                    result="shape"
                                                                />
                                                            </filter>
                                                            <linearGradient
                                                                id="paint0_linear_122_5699"
                                                                x1="27"
                                                                y1="16.4997"
                                                                x2="-1"
                                                                y2="16.4997"
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
                                                        </defs>
                                                    </svg>
                                                </div>
                                                <div
                                                    class="arrow__right"
                                                    :aria-hidden="
                                                        state === 'roulette'
                                                            ? 'false'
                                                            : 'true'
                                                    "
                                                >
                                                    <svg
                                                        width="30"
                                                        height="35"
                                                        viewBox="0 0 30 35"
                                                        fill="none"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                    >
                                                        <path
                                                            d="M3.75391 22.2589C-0.58467 19.7014 -0.58467 13.2986 3.75391 10.7411L18.7539 1.89893C23.0716 -0.646285 28.5 2.52452 28.5 7.65772L28.5 25.3423C28.5 30.4755 23.0716 33.6463 18.7539 31.1011L3.75391 22.2589Z"
                                                            fill="#252E40"
                                                            stroke="#323E56"
                                                        />
                                                        <g
                                                            filter="url(#filter0_d_122_5702)"
                                                        >
                                                            <path
                                                                d="M7.5 19.153C5.5 17.974 5.5 15.0265 7.5 13.8476L19.5 6.77379C21.5 5.59483 24 7.06856 24 9.42649L24 23.5741C24 25.932 21.5 27.4057 19.5 26.2268L7.5 19.153Z"
                                                                fill="url(#paint0_linear_122_5702)"
                                                            />
                                                        </g>
                                                        <defs>
                                                            <filter
                                                                id="filter0_d_122_5702"
                                                                x="0"
                                                                y="2.35886"
                                                                width="30"
                                                                height="32.2829"
                                                                filterUnits="userSpaceOnUse"
                                                                color-interpolation-filters="sRGB"
                                                            >
                                                                <feFlood
                                                                    flood-opacity="0"
                                                                    result="BackgroundImageFix"
                                                                />
                                                                <feColorMatrix
                                                                    in="SourceAlpha"
                                                                    type="matrix"
                                                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                                                                    result="hardAlpha"
                                                                />
                                                                <feOffset
                                                                    dy="2"
                                                                />
                                                                <feGaussianBlur
                                                                    stdDeviation="3"
                                                                />
                                                                <feComposite
                                                                    in2="hardAlpha"
                                                                    operator="out"
                                                                />
                                                                <feColorMatrix
                                                                    type="matrix"
                                                                    values="0 0 0 0 0.0376273 0 0 0 0 0.114716 0 0 0 0 0.265102 0 0 0 0.45 0"
                                                                />
                                                                <feBlend
                                                                    mode="normal"
                                                                    in2="BackgroundImageFix"
                                                                    result="effect1_dropShadow_122_5702"
                                                                />
                                                                <feBlend
                                                                    mode="normal"
                                                                    in="SourceGraphic"
                                                                    in2="effect1_dropShadow_122_5702"
                                                                    result="shape"
                                                                />
                                                            </filter>
                                                            <linearGradient
                                                                id="paint0_linear_122_5702"
                                                                x1="3"
                                                                y1="16.5003"
                                                                x2="31"
                                                                y2="16.5003"
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
                                                        </defs>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="result__state"
                                            v-if="
                                                winItems.length < 2 &&
                                                state === 'win'
                                            "
                                        >
                                            <div class="result__item">
                                                <div
                                                    class="item__drop"
                                                    v-for="(
                                                        winItem, index
                                                    ) in winItems"
                                                    :key="winItem.id"
                                                >
                                                    <div
                                                        class="main__container"
                                                    >
                                                        <div class="skin__icon">
                                                            <div
                                                                class="skinIcon__background"
                                                                :class="
                                                                    getItemRarityClass(
                                                                        winItem.item &&
                                                                            winItem
                                                                                .item
                                                                                .rarity
                                                                    )
                                                                "
                                                            ></div>
                                                        </div>
                                                    </div>
                                                    <img
                                                        :srcset="
                                                            'https://steamcommunity-a.akamaihd.net/economy/image/' +
                                                            (winItem.item &&
                                                                winItem.item
                                                                    .icon_url)
                                                        "
                                                        :alt="
                                                            winItem.item &&
                                                            winItem.item
                                                                .market_hash_name
                                                        "
                                                        class="drop__image"
                                                        loading="eager"
                                                        decoding="async"
                                                    />
                                                    <div class="drop__info">
                                                        <div
                                                            class="info__weapon"
                                                        >
                                                            {{
                                                                getItemType(
                                                                    winItem.item &&
                                                                        winItem
                                                                            .item
                                                                            .market_hash_name
                                                                )
                                                            }}
                                                        </div>
                                                        <div class="info__name">
                                                            {{
                                                                getItemName(
                                                                    winItem.item &&
                                                                        winItem
                                                                            .item
                                                                            .market_hash_name
                                                                )
                                                            }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="caseDescription__wrapper">
                    <!--- unauthorized -->

                    <div
                        class="caseDescription__login"
                        v-if="!$root.isAuthorized"
                    >
                        <div class="caseDescription__info">
                            <svg
                                width="42"
                                height="42"
                                viewBox="0 0 42 42"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <rect
                                    width="42"
                                    height="42"
                                    rx="12"
                                    fill="#FC4B55"
                                />
                                <path
                                    d="M29.31 23.4975L23.25 13.9275C22.74 13.1925 21.8925 12.75 21 12.75C20.1075 12.75 19.26 13.185 18.7275 13.95L12.6975 23.4825C11.9325 24.5775 11.79 25.89 12.3225 26.9025C12.8475 27.915 13.95 28.4925 15.33 28.4925H26.67C28.0575 28.4925 29.1525 27.915 29.6775 26.9025C30.2025 25.89 30.06 24.585 29.31 23.4975ZM20.25 17.25C20.25 16.8375 20.5875 16.5 21 16.5C21.4125 16.5 21.75 16.8375 21.75 17.25V21.75C21.75 22.1625 21.4125 22.5 21 22.5C20.5875 22.5 20.25 22.1625 20.25 21.75V17.25ZM21 26.25C20.3775 26.25 19.875 25.7475 19.875 25.125C19.875 24.5025 20.3775 24 21 24C21.6225 24 22.125 24.5025 22.125 25.125C22.125 25.7475 21.6225 26.25 21 26.25Z"
                                    fill="white"
                                />
                            </svg>
                            <span>{{ $t("cases.warning") }}</span>
                        </div>
                    </div>
                    <a
                        class="unAuth__btn"
                        v-if="!$root.isAuthorized"
                        href="/api/auth/steam"
                    >
                        <svg
                            width="18"
                            height="18"
                            viewBox="0 0 18 18"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <g clip-path="url(#clip0_118_1474)">
                                <path
                                    d="M13.4272 1.3125C10.9155 1.3125 8.8665 3.3345 8.847 5.8275L5.99475 9.89775C5.199 9.82575 4.51275 9.99 3.906 10.3582L0 8.7855V13.0807L2.31 14.0055C2.64375 15.5347 4.0185 16.6875 5.64525 16.6875C7.41375 16.6875 8.87925 15.3352 9.0405 13.6132L13.4318 10.419C15.951 10.419 18 8.38575 18 5.86425L17.9993 5.8635C17.9993 3.354 15.9502 1.3125 13.4272 1.3125ZM5.64525 15.7815C4.68 15.7815 3.849 15.2408 3.42675 14.4525C3.83625 14.6085 4.25025 14.7802 4.6605 14.9408C5.68575 15.3607 6.8505 14.8605 7.26 13.8397C7.674 12.819 7.1715 11.667 6.14775 11.2582L5.103 10.8383C5.28375 10.7978 5.4645 10.7782 5.64525 10.7782C7.0395 10.7782 8.15625 11.8905 8.15625 13.2795C8.15625 14.6692 7.0395 15.7815 5.64525 15.7815ZM13.4318 8.9145C11.736 8.9145 10.3582 7.55325 10.3582 5.86425C10.3582 4.18275 11.7323 2.814 13.4318 2.814C15.1155 2.814 16.4932 4.18275 16.4932 5.86425C16.4932 7.55775 15.1147 8.919 13.4318 8.9145Z"
                                    fill="white"
                                />
                                <path
                                    d="M13.44 3.41699C12.0862 3.41699 10.9897 4.50974 10.9897 5.85824C10.9897 7.20674 12.0825 8.29949 13.44 8.29949C14.7855 8.29949 15.8902 7.21049 15.8902 5.85824C15.8902 4.50599 14.7855 3.41699 13.44 3.41699Z"
                                    fill="white"
                                />
                            </g>
                            <defs>
                                <clipPath id="clip0_118_1474">
                                    <rect width="18" height="18" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                        {{ $t("cases.sign") }}
                    </a>

                    <div
                        class="caseDescription__login"
                        v-if="
                            $root.isAuthorized &&
                            parseFloat($root.user.balance) <
                                parseFloat(box.price) &&
                            state === 'default' &&
                            box.type !== 'free'
                        "
                    >
                        <div class="caseDescription__info">
                            <svg
                                width="42"
                                height="42"
                                viewBox="0 0 42 42"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <rect
                                    width="42"
                                    height="42"
                                    rx="12"
                                    fill="#FC4B55"
                                />
                                <path
                                    d="M29.31 23.4975L23.25 13.9275C22.74 13.1925 21.8925 12.75 21 12.75C20.1075 12.75 19.26 13.185 18.7275 13.95L12.6975 23.4825C11.9325 24.5775 11.79 25.89 12.3225 26.9025C12.8475 27.915 13.95 28.4925 15.33 28.4925H26.67C28.0575 28.4925 29.1525 27.915 29.6775 26.9025C30.2025 25.89 30.06 24.585 29.31 23.4975ZM20.25 17.25C20.25 16.8375 20.5875 16.5 21 16.5C21.4125 16.5 21.75 16.8375 21.75 17.25V21.75C21.75 22.1625 21.4125 22.5 21 22.5C20.5875 22.5 20.25 22.1625 20.25 21.75V17.25ZM21 26.25C20.3775 26.25 19.875 25.7475 19.875 25.125C19.875 24.5025 20.3775 24 21 24C21.6225 24 22.125 24.5025 22.125 25.125C22.125 25.7475 21.6225 26.25 21 26.25Z"
                                    fill="white"
                                />
                            </svg>
                            <span
                                >{{ box.price }} ₽, {{ $t("cases.enough") }}
                                {{
                                    Number(
                                        box.price - $root.user.balance
                                    ).toFixed(2)
                                }}₽</span
                            >
                        </div>
                    </div>
                    <router-link
                        :to="{
                            name: 'deposit',
                        }"
                        class="unAuth__btn"
                        v-if="
                            $root.isAuthorized &&
                            parseFloat($root.user.balance) <
                                parseFloat(box.price) &&
                            state === 'default' &&
                            box.type !== 'free'
                        "
                    >
                        {{ $t("cases.deposit") }}
                    </router-link>
                    <!--- open case -->

                    <div
                        class="buyButtons__container"
                        v-if="
                            $root.isAuthorized &&
                            parseFloat($root.user.balance) >
                                parseFloat(box.price) &&
                            state === 'default' &&
                            box.type !== 'free' &&
                            box.category_id !== 3
                        "
                    >
                        <div class="control">
                            <div class="toggle__buttons">
                                <button
                                    :class="[
                                        'controls',
                                        'size--large',
                                        'fit-content',
                                        'toggle__button',
                                        selectedCount === 1
                                            ? 'color--gray-gradient'
                                            : 'color--gray',
                                    ]"
                                    @click="selectedCount = 1"
                                >
                                    <div
                                        class="text color--white variant--h3 bold"
                                    >
                                        x1
                                    </div>
                                </button>
                                <button
                                    :class="[
                                        'controls',
                                        'size--large',
                                        'fit-content',
                                        'toggle__button',
                                        selectedCount === 2
                                            ? 'color--gray-gradient'
                                            : 'color--gray',
                                    ]"
                                    @click="selectedCount = 2"
                                >
                                    <div
                                        class="text color--disabled variant--h3 bold"
                                    >
                                        x2
                                    </div>
                                </button>
                                <button
                                    :class="[
                                        'controls',
                                        'size--large',
                                        'fit-content',
                                        'toggle__button',
                                        selectedCount === 3
                                            ? 'color--gray-gradient'
                                            : 'color--gray',
                                    ]"
                                    @click="selectedCount = 3"
                                >
                                    <div
                                        class="text color--disabled variant--h3 bold"
                                    >
                                        x3
                                    </div>
                                </button>
                                <button
                                    :class="[
                                        'controls',
                                        'size--large',
                                        'fit-content',
                                        'toggle__button',
                                        selectedCount === 4
                                            ? 'color--gray-gradient'
                                            : 'color--gray',
                                    ]"
                                    @click="selectedCount = 4"
                                >
                                    <div
                                        class="text color--disabled variant--h3 bold"
                                    >
                                        x4
                                    </div>
                                </button>
                                <button
                                    :class="[
                                        'controls',
                                        'size--large',
                                        'fit-content',
                                        'toggle__button',
                                        selectedCount === 5
                                            ? 'color--gray-gradient'
                                            : 'color--gray',
                                    ]"
                                    @click="selectedCount = 5"
                                >
                                    <div
                                        class="text color--disabled variant--h3 bold"
                                    >
                                        x5
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                    <button
                        class="open__btn"
                        v-if="
                            $root.isAuthorized &&
                            parseFloat($root.user.balance) >
                                parseFloat(box.price) &&
                            state === 'default'
                        "
                        @click="openBox('default')"
                    >
                        {{
                            box.price === 0
                                ? "открыть бесплатно"
                                : `открыть за ₽${(
                                      box.price * selectedCount
                                  ).toFixed(2)}`
                        }}
                    </button>

                    <!--- loading open -->
                    <div class="boxControls" v-if="state === 'roulette'">
                        <div class="started__container">
                            <div
                                class="controls color--transparent size--small full-width"
                            >
                                <div class="control__content">
                                    <div class="loader color--gray">
                                        <span></span><span></span><span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="boxControls" v-if="state === 'win'">
                        <div class="results__container">
                            <div class="control">
                                <button
                                    @click="refresh"
                                    class="controls color--gray-dark size--medium full-width button"
                                    type="button"
                                >
                                    <div class="button__content">
                                        <svg
                                            width="19"
                                            height="18"
                                            viewBox="0 0 19 18"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <g
                                                clip-path="url(#clip0_178_11321)"
                                            >
                                                <path
                                                    d="M17.332 8.99103C16.7643 8.99606 16.2872 9.41899 16.2142 9.98201C15.6733 13.6776 12.239 16.2349 8.54343 15.694C4.84787 15.1532 2.29051 11.7188 2.83139 8.02328C3.37228 4.32772 6.80661 1.77036 10.5022 2.31124C11.7619 2.49561 12.9439 3.03182 13.9124 3.85821L13.0641 4.70656C12.7709 4.99977 12.771 5.47513 13.0642 5.76827C13.2055 5.90953 13.3973 5.98864 13.5971 5.98807H17.04C17.4546 5.98807 17.7907 5.65196 17.7907 5.23734V1.79443C17.7906 1.37981 17.4544 1.04377 17.0398 1.04384C16.8408 1.04387 16.6499 1.12295 16.5092 1.26364L15.5092 2.26363C11.7888 -1.0325 6.10082 -0.688616 2.80465 3.03178C-0.491521 6.75218 -0.147563 12.4402 3.5728 15.7364C7.29316 19.0325 12.9812 18.6886 16.2774 14.9682C17.4377 13.6586 18.1911 12.039 18.4454 10.3078C18.5449 9.68806 18.1231 9.10491 17.5033 9.00539C17.4467 8.99627 17.3894 8.99149 17.332 8.99103Z"
                                                    fill="#687894"
                                                />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_178_11321">
                                                    <rect
                                                        width="18"
                                                        height="18"
                                                        fill="white"
                                                        transform="translate(0.5)"
                                                    />
                                                </clipPath>
                                            </defs>
                                        </svg>

                                        <div
                                            class="text variant--h7 bold noWrap uppercase"
                                        >
                                            {{ $t("cases.return") }}
                                        </div>
                                    </div>
                                </button>
                            </div>
                            <div class="control">
                                <button
                                    v-if="
                                        winItems.length === 1 && state === 'win'
                                    "
                                    v-on:click="sellItem(winItems[0].id)"
                                    class="controls color--blue-gradient size--medium full-width button"
                                    type="button"
                                >
                                    <div class="button__content">
                                        <div
                                            class="text color--primary variant--h8 bold noWrap uppercase"
                                        >
                                            {{ $t("cases.sell") }} ₽{{
                                                parseFloat(
                                                    winItems[0].item.price
                                                ).toFixed(2)
                                            }}
                                        </div>
                                    </div>
                                </button>
                                <button
                                    @click="sellAllItems"
                                    v-if="
                                        winItems.length > 1 && state === 'win'
                                    "
                                    class="controls color--blue-gradient size--medium full-width button"
                                    type="button"
                                >
                                    <div class="button__content">
                                        <div
                                            class="text color--primary variant--h8 bold noWrap uppercase"
                                        >
                                            {{ $t("cases.sellAll") }} ₽{{
                                                totalPrice.toFixed(2)
                                            }}
                                        </div>
                                    </div>
                                </button>
                            </div>
                            <div class="control">
                                <a
                                    href="/upgrade"
                                    class="controls color--gray-dark size--medium full-width button"
                                    type="button"
                                >
                                    <div class="button__content">
                                        <svg
                                            width="19"
                                            height="18"
                                            viewBox="0 0 19 18"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <g
                                                clip-path="url(#clip0_178_11328)"
                                            >
                                                <path
                                                    d="M2.62671 13.8855C1.75671 14.2777 0.901706 13.3102 1.39671 12.492L8.66796 0.46949C8.75437 0.326165 8.87636 0.207604 9.02209 0.125304C9.16782 0.0430031 9.33234 -0.000244141 9.4997 -0.000244141C9.66707 -0.000244141 9.83159 0.0430031 9.97732 0.125304C10.123 0.207604 10.245 0.326165 10.3315 0.46949L17.6042 12.492C18.0992 13.3095 17.2442 14.2777 16.3735 13.8855L13.0172 12.372C12.9216 12.3288 12.8365 12.2655 12.7676 12.1864C12.6988 12.1072 12.6479 12.0141 12.6184 11.9135C12.5889 11.8128 12.5815 11.707 12.5968 11.6032C12.612 11.4994 12.6495 11.4002 12.7067 11.3122C12.766 11.2213 12.8043 11.1183 12.8186 11.0107C12.833 10.9031 12.8231 10.7937 12.7897 10.6904C12.7562 10.5871 12.7001 10.4927 12.6254 10.4139C12.5507 10.3351 12.4593 10.2741 12.358 10.2352L11.2315 9.80549C11.0705 9.74364 10.9289 9.6401 10.8212 9.50549L10.2572 8.80499C10.1662 8.69158 10.0509 8.60005 9.91978 8.53716C9.78867 8.47427 9.64512 8.44162 9.4997 8.44162C9.35429 8.44162 9.21074 8.47427 9.07963 8.53716C8.94853 8.60005 8.83321 8.69158 8.74221 8.80499L8.17821 9.50624C8.07021 9.64124 7.92845 9.74399 7.76795 9.80549L6.64146 10.2352C6.54003 10.274 6.44858 10.335 6.3738 10.4137C6.29902 10.4925 6.24281 10.5869 6.2093 10.6902C6.17578 10.7935 6.16581 10.903 6.18011 11.0106C6.19442 11.1182 6.23263 11.2213 6.29196 11.3122C6.34917 11.4001 6.38671 11.4993 6.40201 11.6031C6.41731 11.7068 6.41 11.8126 6.38058 11.9133C6.35116 12.0139 6.30033 12.107 6.23157 12.1862C6.16281 12.2654 6.07774 12.3288 5.98221 12.372L2.62671 13.8855Z"
                                                    fill="#687894"
                                                />
                                                <path
                                                    d="M4.30626 18C3.25776 18 2.95101 16.5675 3.90726 16.137L9.10101 13.7955C9.22643 13.739 9.36243 13.7097 9.50001 13.7097C9.63759 13.7097 9.7736 13.739 9.89901 13.7955L15.0928 16.137C16.049 16.5683 15.7423 18 14.6938 18H12.2398C11.9825 18 11.735 17.8973 11.5528 17.715L10.1878 16.347C10.0975 16.2566 9.99035 16.1848 9.87233 16.1358C9.75431 16.0868 9.62779 16.0616 9.50001 16.0616C9.37223 16.0616 9.24571 16.0868 9.12769 16.1358C9.00968 16.1848 8.90249 16.2566 8.81226 16.347L7.44726 17.7143C7.35709 17.8048 7.24991 17.8767 7.13189 17.9258C7.01386 17.9748 6.88732 18 6.75951 18H4.30626Z"
                                                    fill="#687894"
                                                />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_178_11328">
                                                    <rect
                                                        width="18"
                                                        height="18"
                                                        fill="white"
                                                        transform="translate(0.5)"
                                                    />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <div
                                            class="text variant--h7 bold noWrap uppercase"
                                        >
                                            {{ $t("cases.upgrade") }}
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="openCaseDescription__wrapper"
                    v-if="box.type === 'free'"
                >
                    <div class="openCaseDescription type--free">
                        <div class="descriptionItem">
                            <div class="item__title">
                                <svg
                                    width="38"
                                    height="38"
                                    viewBox="0 0 38 38"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M34.1367 17.0059L31.9992 14.5043C31.6033 14.0293 31.2708 13.1426 31.2708 12.5093V9.8176C31.2708 8.13927 29.8933 6.76177 28.215 6.76177H25.5233C24.89 6.76177 23.9875 6.42927 23.5125 6.03344L21.0108 3.89594C19.9183 2.96177 18.1292 2.96177 17.0367 3.89594L14.5033 6.03344C14.0283 6.42927 13.1417 6.76177 12.5083 6.76177H9.76917C8.09083 6.76177 6.71333 8.13927 6.71333 9.8176V12.5093C6.71333 13.1268 6.39667 14.0134 6.00083 14.4884L3.86333 17.0059C2.945 18.1143 2.945 19.8876 3.86333 20.9643L6.00083 23.4818C6.39667 23.9409 6.71333 24.8434 6.71333 25.4609V28.1684C6.71333 29.8468 8.09083 31.2243 9.76917 31.2243H12.5242C13.1417 31.2243 14.0442 31.5568 14.5192 31.9526L17.0208 34.0901C18.1133 35.0243 19.9025 35.0243 20.995 34.0901L23.4967 31.9526C23.9717 31.5568 24.8583 31.2243 25.4917 31.2243H28.1833C29.8617 31.2243 31.2392 29.8468 31.2392 28.1684V25.4768C31.2392 24.8434 31.5717 23.9568 31.9675 23.4818L34.105 20.9801C35.0708 19.9034 35.0708 18.1143 34.1367 17.0059ZM17.8125 12.8734C17.8125 12.2243 18.3508 11.6859 19 11.6859C19.6492 11.6859 20.1875 12.2243 20.1875 12.8734V20.5209C20.1875 21.1701 19.6492 21.7084 19 21.7084C18.3508 21.7084 17.8125 21.1701 17.8125 20.5209V12.8734ZM19 26.7118C18.1292 26.7118 17.4167 25.9993 17.4167 25.1284C17.4167 24.2576 18.1133 23.5451 19 23.5451C19.8708 23.5451 20.5833 24.2576 20.5833 25.1284C20.5833 25.9993 19.8867 26.7118 19 26.7118Z"
                                        fill="url(#paint0_linear_4454_66042)"
                                    />
                                    <defs>
                                        <linearGradient
                                            id="paint0_linear_4454_66042"
                                            x1="19.004"
                                            y1="3.19531"
                                            x2="19.004"
                                            y2="34.7907"
                                            gradientUnits="userSpaceOnUse"
                                        >
                                            <stop stop-color="#FC5763" />
                                            <stop
                                                offset="1"
                                                stop-color="#95272F"
                                            />
                                        </linearGradient>
                                    </defs>
                                </svg>
                            </div>
                            <div class="item__title">
                                <div class="text variant--h20 bold uppercase">
                                    {{ $t("cases.free.title") }}
                                </div>
                            </div>
                            <div class="item__description">
                                <div
                                    class="text color--secondary-text variant--h4 mgb-24"
                                >
                                    {{ $t("cases.free.text") }}
                                    <b>{{ box.min_dep }} ₽ </b>
                                    <p>
                                        {{ $t("cases.free.text1") }}
                                        <b>{{ box.deposits_sum }} ₽ </b>
                                    </p>
                                </div>
                                <div
                                    class="text color--secondary-text variant--h4"
                                >
                                    <b>
                                        {{ $t("cases.free.text2") }}
                                        <p>
                                            {{ $t("cases.free.text3") }}
                                        </p></b
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="openCaseContent__wrapper">
                    <div class="openCaseContent">
                        <div class="openCaseContent__title">
                            <div
                                class="text color--white variant--h2 uppercase"
                            >
                                {{ $t("cases.content") }}
                            </div>
                        </div>
                        <div class="openCaseContent__container">
                            <div
                                class="skinCard__wrapper"
                                v-for="(item, index) in items"
                                :key="index"
                            >
                                <div
                                    class="skin__container size--medium"
                                    :class="[
                                        getItemRarityClass(item.item.rarity),
                                    ]"
                                >
                                    <div class="skinCard">
                                        <div class="skinCard__price">
                                            <div class="skinCard__price-item">
                                                {{ item.price }}
                                                ₽
                                            </div>
                                        </div>
                                        <div class="skinCard__image_wrapper">
                                            <img
                                                :srcset="
                                                    'https://steamcommunity-a.akamaihd.net/economy/image/' +
                                                    item.item.icon_url
                                                "
                                                :alt="
                                                    item.item.market_hash_name
                                                "
                                                class="skinCard__image"
                                                loading="lazy"
                                                decoding="async"
                                            />
                                        </div>

                                        <div class="skinCard__footer">
                                            <div
                                                class="skinCard__footer_left_side"
                                            >
                                                <div class="drops__names">
                                                    <div
                                                        class="text color--secondary-text variant--h6"
                                                    >
                                                        {{
                                                            getItemType(
                                                                item.item
                                                                    .market_hash_name
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
                                            :class="[
                                                getItemRarityClass(
                                                    item.item.rarity
                                                ),
                                            ]"
                                        ></div>
                                    </div>
                                    <div
                                        class="skinCard__divider"
                                        :class="[
                                            getItemRarityClass(
                                                item.item.rarity
                                            ),
                                        ]"
                                    ></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="caseContent__wrapper"></div>
        </div>
    </div>
</template>

<script>
import {
    getItemName,
    getItemRarityClass,
    getItemType,
    randomInteger,
    shuffleArray,
} from "../helpers/helper";
import PromocodeUser from "../components/Modals/Promocode.vue";
import { gsap } from "gsap";
import axios from "axios";

export default {
    components: {
        PromocodeUser,
    },

    data() {
        return {
            box: {},
            items: [],
            rouletteItems: [],
            winItems: [],
            state: "default",
            isOpening: false,
            totalPrice: 0,
            selectedCount: 1,
            fastMode: false,
            playEndSound: true,
            isImageLoaded: false,
        };
    },

    mounted() {
        this.getBox();
    },
    beforeDestroy() {
        this.playEndSound = false; // Отключаем звук при выходе с компонента
    },
    methods: {
        toggleFastMode() {
            this.fastMode = !this.fastMode;
        },
        async openBox(type) {
            if (this.isOpening) return;
            this.isOpening = true;

            const mode = this.fastMode ? "fast" : type;

            try {
                const { data: result } = await this.axios.post("/case/open", {
                    id: this.box.id,
                    count: this.selectedCount,
                });

                if (!result.success) {
                    this.$root.toast("error", result.message);
                    this.isOpening = false;
                    return;
                }

                this.$root.toast("success", result.message);

                this.winItems = result.winItems;
                if (this.box.category_id !== 12) {
                    this.box.price = result.case.price;
                }
                this.state = mode === "fast" ? "win" : "roulette";

                if (this.winItems.length === 1) {
                    this.setRouletteWinItems(result.winItems);
                    if (type === "default") this.initOneRoulette();
                } else if (this.winItems.length > 1) {
                    this.initMultipleRoulettes(
                        this.selectedCount,
                        result.winItems
                    );
                    if (type === "default") this.initMultiRoulettes();
                }

                if (type === "fast") {
                    this.$root.playSound("level");
                }
            } catch (error) {
                console.error("Error opening box:", error);
            } finally {
                this.isOpening = false;
            }
        },
        openAuth() {
            window.location.href = "/api/auth/steam";
        },
        initOneRoulette() {
            this.startRouletteAnimation(
                ".roulette__items",
                ".rouletteItem__wrapper",
                -10300,
                600,
                9500,
                10000
            );
        },
        initMultiRoulettes() {
            let finalPosition = -11247;

            if (window.innerWidth <= 550) {
                finalPosition = -5925;
            }

            this.startMultipleAnimations(
                ".slot__items",
                finalPosition,
                9500,
                10000
            );
        },

        initMultipleRoulettes(count, winItems) {
            this.rouletteItems = Array.from({ length: count }, (_, i) => {
                const roulette = Array.from(
                    { length: 70 },
                    () => this.items[randomInteger(0, this.items.length - 1)]
                );
                roulette[36] = winItems[i];
                return roulette;
            });
        },
        initRoulette() {
            this.rouletteItems = Array.from(
                { length: 70 },
                () => this.items[randomInteger(0, this.items.length - 1)]
            );
            this.rouletteItems = shuffleArray(this.rouletteItems);
        },
        setRouletteWinItems(winItems) {
            winItems.forEach((item, index) => {
                this.rouletteItems[36 + index] = item;
            });
        },

        startRouletteAnimation(
            containerSelector,
            itemSelector,
            finalPosition,
            startDelay,
            stopDelay,
            finishDelay
        ) {
            setTimeout(() => {
                const container = document.querySelector(containerSelector);
                const items = document.querySelectorAll(itemSelector);

                if (!container || items.length === 0) return;

                const randomOffset = Math.random() * 200 - 100;
                container.style.transform = `translateX(${
                    finalPosition + randomOffset
                }px)`;

                this.playAnimationSound(container, items, finalPosition);
            }, startDelay);

            setTimeout(() => {
                const container = document.querySelector(containerSelector);
                if (container) {
                    container.style.transition = "transform 0.5s ease";
                    container.style.transform = `translateX(${finalPosition}px)`;
                }
            }, stopDelay);

            setTimeout(() => {
                if (this.playEndSound) {
                    // Проверяем флаг
                    this.$root.playSound("case-open-fast");
                }
                this.state = "win";
            }, finishDelay);
        },

        startMultipleAnimations(selector, finalPosition) {
            setTimeout(() => {
                document.querySelectorAll(selector).forEach((container) => {
                    const randomOffset = Math.random() * 200 - 100;
                    gsap.to(container, {
                        y: finalPosition + randomOffset,
                        duration: 8.5,
                        ease: "power2.out",
                        onStart: () => {
                            this.$root.playSound("spin-start");
                        },
                        onComplete: () => {
                            gsap.to(container, {
                                y: finalPosition,
                                duration: 1,
                                ease: "power2.inOut",
                                onComplete: () => {
                                    this.state = "win";
                                    if (this.playEndSound) {
                                        this.$root.playSound("case-open-fast");
                                    }
                                },
                            });
                        },
                    });
                });
            }, 0);
        },
        playAnimationSound(container, items, finalPosition) {
            const itemWidth = items[0].offsetWidth;
            const containerCenter = container.offsetWidth / 2;
            let lastPlayedIndex = -1;

            const animateSound = () => {
                const currentTransform = Math.abs(
                    parseFloat(
                        getComputedStyle(container).transform.split(",")[4] || 0
                    )
                );

                items.forEach((item, index) => {
                    const itemCenter = item.offsetLeft + itemWidth / 2;
                    const isVisible =
                        itemCenter - currentTransform >=
                            containerCenter - itemWidth / 2 &&
                        itemCenter - currentTransform <=
                            containerCenter + itemWidth / 2;

                    if (isVisible && lastPlayedIndex !== index) {
                        this.$root.playSound("case_open");
                        lastPlayedIndex = index;
                    }
                });

                if (currentTransform < Math.abs(finalPosition)) {
                    requestAnimationFrame(animateSound);
                }
            };

            requestAnimationFrame(animateSound);
        },
        async sellSingleItem(item) {
            try {
                const { data } = await axios.post("/user/items/sellItem", {
                    id: item.id,
                });

                this.$root.toast(data.type, data.message);

                if (data.type === "success") {
                    this.winItems = this.winItems.filter(
                        (winItem) => winItem.id !== item.id
                    );
                    this.calculateTotalPrice();
                }
            } catch (error) {
                console.error("Ошибка при продаже предмета:", error);
            }
        },
        async getBox() {
            try {
                const { data: result } = await this.axios.get("/case/one", {
                    params: { url: this.$route.params.url },
                });

                if (!result.case) return this.$router.push({ name: "404" });

                this.box = result.case;
                console.log("Box", result.case);

                this.items = this.sortItemsByRarity(result.items);
                console.log("Предметы", result.items);
                this.initRoulette();

                const img = new Image();
                img.src = `/assets/img/cases/${this.box.image}`;
                img.onload = () => {
                    this.isImageLoaded = true;
                };
            } catch (error) {
                console.error("Error fetching box:", error);
            }
        },
        onImageLoad() {
            this.isImageLoaded = true; // Устанавливаем флаг после загрузки
        },
        sortItemsByRarity(items) {
            const orderByArray = [
                "Agent",
                "Consumer",
                "industrial",
                "mil-spec",
                "restricted",
                "classified",
                "covert",
                "★",
                "Contraband",
            ];
            return orderByArray
                .map((rarity) =>
                    items.filter((item) =>
                        item.item.rarity
                            .toLowerCase()
                            .includes(rarity.toLowerCase())
                    )
                )
                .flat();
        },
        calculateTotalPrice() {
            this.totalPrice = this.winItems.reduce((total, item) => {
                const cleanedPrice = parseFloat(
                    item.item.price.replace(/[^\d.-]/g, "")
                );
                return total + cleanedPrice;
            }, 0);
        },
        async sellItem(id) {
            try {
                const { data } = await axios.post("/user/items/sellItem", {
                    id,
                });
                this.$toast[data.type](data.message);
                this.refresh();
            } catch (error) {
                console.error("Error selling item:", error);
            }
        },
        async sellAllItems() {
            const ids = this.winItems.map((item) => item.id);
            await this.$root.sellItemsCase(ids, true); // Передаем массив id и флаг isAll
            this.winItems = [];
            this.refresh();
        },

        refresh() {
            this.winItems = [];
            this.state = "default";
            this.isOpening = false;
            this.initRoulette();
        },
        openPromocodeUser() {
            this.$root.$emit("PromocodeUser");
        },
        openPayment() {
            this.$root.$emit("openPaymentModal");
        },

        getItemRarityClass,
        getItemName,
        getItemType,
    },
    watch: {
        winItems(newVal) {
            if (newVal.length) this.calculateTotalPrice();
        },
    },
};
</script>

<style scoped>
.roulette__items {
    transition: transform 8.5s ease;
}
.image__placeholder {
    width: 100%; /* Размеры должны совпадать с image__case */
    height: 100%; /* Укажите нужную высоту */
}
</style>
