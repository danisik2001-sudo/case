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
                    ></path>
                    <path
                        d="M12.75 13.4944V17.9944H15.75C16.9926 17.9944 18 16.987 18 15.7444V8.90367C18.0002 8.51403 17.8488 8.13962 17.5777 7.85967L11.2043 0.969396C10.0797 -0.247362 8.18167 -0.322069 6.96491 0.802509C6.90711 0.855947 6.85143 0.911599 6.79802 0.969396L0.435762 7.85742C0.156551 8.13853 -0.000105416 8.51871 5.32206e-08 8.91492V15.7444C5.32206e-08 16.987 1.00737 17.9944 2.25 17.9944H5.24999V13.4944C5.26402 11.4493 6.9152 9.77924 8.9088 9.73114C10.9691 9.68143 12.7343 11.3799 12.75 13.4944Z"
                        fill="url(#paint1_linear_118_1636)"
                    ></path>
                    <path
                        d="M9 11.2444C7.75737 11.2444 6.75 12.2518 6.75 13.4944V17.9944H11.25V13.4944C11.25 12.2518 10.2426 11.2444 9 11.2444Z"
                        fill="url(#paint2_linear_118_1636)"
                    ></path>
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
                        <stop stop-color="#5CB1FF"></stop>
                        <stop offset="1" stop-color="#396CF4"></stop>
                    </linearGradient>
                    <linearGradient
                        id="paint1_linear_118_1636"
                        x1="9"
                        y1="0.00561523"
                        x2="9"
                        y2="17.9944"
                        gradientUnits="userSpaceOnUse"
                    >
                        <stop stop-color="#5CB1FF"></stop>
                        <stop offset="1" stop-color="#396CF4"></stop>
                    </linearGradient>
                    <linearGradient
                        id="paint2_linear_118_1636"
                        x1="9"
                        y1="11.2444"
                        x2="9"
                        y2="17.9944"
                        gradientUnits="userSpaceOnUse"
                    >
                        <stop stop-color="#5CB1FF"></stop>
                        <stop offset="1" stop-color="#396CF4"></stop>
                    </linearGradient>
                    <clipPath id="clip0_118_1636">
                        <rect width="18" height="18" fill="white"></rect>
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
                ></path>
            </svg>
            <span class="uppercase">{{ $t("upgrade.header") }}</span>
        </div>
        <div class="MainContainer__header">
            <div
                class="text color--inherit variant--h1 align--center bold uppercase"
            >
                {{ $t("upgrade.header") }}
            </div>
        </div>
        <div class="topSection">
            <div class="mainUpgrade">
                <div class="upgradeTop">
                    <div class="betContainer">
                        <div class="betVisual">
                            <div
                                class="selectedSkin__price"
                                v-if="selectedUserItem !== null"
                            >
                                <div class="selectedSkin__price-container">
                                    <div class="selectedSkin__price-value">
                                        {{ selectedUserItem.price }} ₽
                                    </div>
                                </div>
                            </div>
                            <div class="ellipseXs">
                                <img
                                    src="/assets/upgrade/ellipse/ellipse-default.svg"
                                    class="ellipseUpgrade"
                                />
                            </div>
                            <div
                                class="selectedSkin__info"
                                v-if="selectedUserItem !== null"
                            >
                                <div class="selectedSkin__name">
                                    {{
                                        getItemType(
                                            selectedUserItem.item
                                                .market_hash_name
                                        )
                                    }}
                                </div>
                                <div class="selectedSkin__name">
                                    {{
                                        getItemName(
                                            selectedUserItem.item
                                                .market_hash_name
                                        )
                                    }}
                                </div>
                                <div class="selectedSkin__flotValue">
                                    {{ selectedUserItem.item.exterior }}
                                </div>
                            </div>
                            <div class="selectedSkin">
                                <img
                                    v-if="selectedUserItem === null"
                                    src="/assets/upgrade/skin-placeholder.png"
                                    alt="AKR | Scylla"
                                    class=""
                                />
                                <img
                                    v-else
                                    :srcset="
                                        'https://steamcommunity-a.akamaihd.net/economy/image/' +
                                        selectedUserItem.item.icon_url
                                    "
                                    :alt="
                                        selectedUserItem.item.market_hash_name
                                    "
                                    class=""
                                />
                            </div>
                            <img
                                src="/assets/upgrade/podium.png"
                                alt="podium-upgrade"
                                class="podiumImage"
                            />
                        </div>
                        <!-- <button
                            class="betVisualDiscard"
                            v-if="selectedUserItem !== null"
                        >
                            <div class="betVisualDiscard__content">
                                <svg
                                    width="18"
                                    height="18"
                                    viewBox="0 0 18 18"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <g clip-path="url(#clip0_178_11418)">
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M7.3687 2.98981C7.8394 2.80081 8.3587 2.75041 8.8591 2.84761C9.35684 2.94281 9.81599 3.18115 10.1803 3.53341L10.9975 4.32271L13.6921 1.70461C13.9054 1.50481 14.1907 1.39501 14.4868 1.39681C14.7829 1.39951 15.0664 1.51471 15.2752 1.71811C15.4849 1.92151 15.6037 2.19601 15.6064 2.48311C15.6075 2.6264 15.58 2.76848 15.5256 2.90105C15.4712 3.03363 15.391 3.15405 15.2896 3.25531L12.5923 5.87071L13.4077 6.66001C13.7677 7.01101 14.0134 7.45741 14.1133 7.94341C14.2123 8.42941 14.161 8.93341 13.9657 9.39061L13.3789 10.7676L5.9521 3.55951L7.3687 2.98981ZM4.4482 4.16701L12.7525 12.2301L11.4493 15.282C11.3863 15.4287 11.2873 15.5583 11.1613 15.6591C10.9681 15.81 10.7272 15.8864 10.4824 15.8745C10.2375 15.8627 10.0051 15.7632 9.8275 15.5943L0.984099 7.00381C0.809225 6.83807 0.704849 6.61138 0.692617 6.37076C0.680384 6.13013 0.761234 5.89403 0.918399 5.71141C1.0219 5.58901 1.1542 5.49271 1.3054 5.43241L4.4482 4.16701ZM15.7405 15.5196C15.7405 16.1244 16.2463 16.6158 16.87 16.6158C17.4937 16.6158 17.9995 16.1244 17.9995 15.5196C17.9995 14.9139 17.4937 14.4225 16.87 14.4225C16.2463 14.4225 15.7405 14.9139 15.7405 15.5196ZM14.2348 15.1524C14.0384 15.1553 13.8489 15.0802 13.7079 14.9435C13.5668 14.8068 13.4857 14.6198 13.4824 14.4234C13.4824 14.0193 13.819 13.6926 14.2348 13.6926C14.6497 13.6926 14.9863 14.0193 14.9863 14.4225C14.9832 14.6189 14.9024 14.806 14.7615 14.9429C14.6206 15.0797 14.4312 15.1551 14.2348 15.1524ZM15.7405 12.2301C15.7405 12.6333 16.0771 12.96 16.4929 12.96C16.6894 12.9629 16.8791 12.8876 17.0202 12.7508C17.1612 12.6139 17.2422 12.4266 17.2453 12.2301C17.2439 12.1327 17.2233 12.0366 17.1847 11.9471C17.1462 11.8577 17.0903 11.7767 17.0205 11.7089C16.9506 11.641 16.8681 11.5876 16.7775 11.5516C16.687 11.5157 16.5903 11.4979 16.4929 11.4993C16.3955 11.4979 16.2988 11.5157 16.2083 11.5516C16.1177 11.5876 16.0352 11.641 15.9653 11.7089C15.8955 11.7767 15.8396 11.8577 15.8011 11.9471C15.7625 12.0366 15.7419 12.1327 15.7405 12.2301Z"
                                            fill="#687894"
                                        />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_178_11418">
                                            <rect
                                                width="18"
                                                height="18"
                                                fill="white"
                                            />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <div class="betVisualDiscard__text">
                                    Discard
                                </div>
                            </div>
                        </button> -->
                    </div>
                    <div class="chanceContainer">
                        <div class="contentChance">
                            <div class="chanceCircle">
                                <svg
                                    width="380"
                                    height="380"
                                    viewBox="0 0 380 380"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M190 380C294.934 380 380 294.934 380 190C380 85.0659 294.934 0 190 0C85.0659 0 0 85.0659 0 190C0 294.934 85.0659 380 190 380Z"
                                        fill="#101823"
                                    />
                                    <path
                                        d="M190 363.311C285.717 363.311 363.311 285.717 363.311 190C363.311 94.2831 285.717 16.6892 190 16.6892C94.2833 16.6892 16.6895 94.2831 16.6895 190C16.6895 285.717 94.2833 363.311 190 363.311Z"
                                        fill="#151A25"
                                    />

                                    <path
                                        d="M190 368.018C288.317 368.018 368.018 288.317 368.018 190C368.018 91.6834 288.317 11.982 190 11.982C91.6838 11.982 11.9824 91.6834 11.9824 190C11.9824 288.317 91.6838 368.018 190 368.018Z"
                                        stroke="#212838"
                                        stroke-dasharray="2 2"
                                    />
                                    <path
                                        v-if="
                                            state === 'init' ||
                                            state === 'ready'
                                        "
                                        d="M190 344.91C275.554 344.91 344.91 275.554 344.91 190C344.91 104.446 275.554 35.0901 190 35.0901C104.445 35.0901 35.0898 104.446 35.0898 190C35.0898 275.554 104.445 344.91 190 344.91Z"
                                        fill="#151A25"
                                    />
                                    <path
                                        v-if="state === 'win'"
                                        d="M190 344.91C275.554 344.91 344.91 275.554 344.91 190C344.91 104.446 275.554 35.0901 190 35.0901C104.445 35.0901 35.0898 104.446 35.0898 190C35.0898 275.554 104.445 344.91 190 344.91Z"
                                        fill="url(#linear_gradient)"
                                    />
                                    <path
                                        v-if="state === 'lose'"
                                        d="M190 344.91C275.554 344.91 344.91 275.554 344.91 190C344.91 104.446 275.554 35.0901 190 35.0901C104.445 35.0901 35.0898 104.446 35.0898 190C35.0898 275.554 104.445 344.91 190 344.91Z"
                                        fill="url(#radial_gradient)"
                                    />

                                    <path
                                        v-if="
                                            state === 'init' ||
                                            state === 'ready'
                                        "
                                        d="M190 52.6351C208.151 52.6351 226.125 56.2103 242.895 63.1566C259.664 70.1028 274.902 80.2841 287.737 93.1188C300.571 105.954 310.753 121.192 317.7 137.961C324.646 154.731 328.221 172.705 328.221 190.856C328.221 209.008 324.646 226.981 317.7 243.75C310.753 260.52 300.571 275.758 287.737 288.593C274.902 301.427 259.664 311.609 242.895 318.556C226.125 325.502 208.151 329.077 190 329.077C171.848 329.077 153.875 325.502 137.106 318.556C120.335 311.609 105.098 301.427 92.263 288.593C79.4282 275.758 69.247 260.52 62.3007 243.75C55.3545 226.981 51.7793 209.007 51.7793 190.856C51.7793 172.704 55.3545 154.731 62.3008 137.961C69.247 121.191 79.4282 105.954 92.263 93.1188C105.098 80.284 120.336 70.1027 137.106 63.1565C153.875 56.2103 171.849 52.6351 190 52.6351Z"
                                        stroke="#1A202D"
                                        stroke-width="6"
                                        stroke-linecap="round"
                                    />

                                    <path
                                        v-if="
                                            state === 'init' ||
                                            state === 'ready'
                                        "
                                        stroke="url(#paint1_linear_28053_30957)"
                                        stroke-width="10"
                                        stroke-linecap="round"
                                        id="chanceCircle"
                                        :d="calculatePath()"
                                    />
                                    <path
                                        v-if="state === 'win'"
                                        stroke="url(#paint1_linear_28053_30956)"
                                        stroke-width="10"
                                        stroke-linecap="round"
                                        id="chanceCircle"
                                        :d="calculatePath()"
                                    />
                                    <path
                                        v-if="state === 'lose'"
                                        stroke="#FC5763"
                                        stroke-width="10"
                                        stroke-linecap="round"
                                        id="chanceCircle"
                                        :d="calculatePath()"
                                    />
                                    <defs>
                                        <linearGradient
                                            id="paint0_linear_28053_30957"
                                            x1="190"
                                            y1="45.3604"
                                            x2="190"
                                            y2="334.64"
                                            gradientUnits="userSpaceOnUse"
                                        >
                                            <stop
                                                stop-color="#263346"
                                                stop-opacity="0"
                                            />
                                            <stop
                                                offset="1"
                                                stop-color="#F85369"
                                            />
                                        </linearGradient>

                                        <linearGradient
                                            id="paint1_linear_28053_30957"
                                            x1="190"
                                            y1="16.2613"
                                            x2="190"
                                            y2="363.739"
                                            gradientUnits="userSpaceOnUse"
                                        >
                                            <stop stop-color="#5BAFFE" />
                                            <stop
                                                offset="1"
                                                stop-color="#2F62E4"
                                            />
                                        </linearGradient>
                                        <linearGradient
                                            id="paint1_linear_28053_30956"
                                            x1="190"
                                            y1="16.2613"
                                            x2="190"
                                            y2="363.739"
                                            gradientUnits="userSpaceOnUse"
                                        >
                                            <stop stop-color="#75CB7D" />
                                            <stop
                                                offset="1"
                                                stop-color="#419049"
                                            />
                                        </linearGradient>
                                        <radialGradient
                                            id="radial_gradient"
                                            cx="50%"
                                            cy="50%"
                                            r="50%"
                                            fx="50%"
                                            fy="50%"
                                            gradientUnits="objectBoundingBox"
                                        >
                                            <stop
                                                offset="0%"
                                                stop-color="rgba(252, 87, 99, 0)"
                                            />
                                            <stop
                                                offset="100%"
                                                stop-color="rgba(220, 39, 52, 0.2345)"
                                            />
                                        </radialGradient>
                                        <linearGradient
                                            id="linear_gradient"
                                            x1="0%"
                                            y1="0%"
                                            x2="0%"
                                            y2="100%"
                                            gradientUnits="objectBoundingBox"
                                        >
                                            <stop
                                                offset="0%"
                                                stop-color="rgba(117, 203, 125, 0.1)"
                                            />
                                            <stop
                                                offset="100%"
                                                stop-color="rgba(65, 144, 73, 0.1)"
                                            />
                                        </linearGradient>
                                    </defs>
                                </svg>
                                <div
                                    class="chancePoint"
                                    v-if="state === 'init' || state === 'ready'"
                                >
                                    <div
                                        class="chancePoint__container"
                                        :style="{
                                            transform:
                                                'rotate(' +
                                                circleRotate +
                                                'deg)',
                                        }"
                                    >
                                        <svg
                                            width="44"
                                            height="45"
                                            viewBox="0 0 44 45"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <g
                                                clip-path="url(#clip0_4348_31748)"
                                            >
                                                <g
                                                    clip-path="url(#clip1_4348_31748)"
                                                >
                                                    <path
                                                        d="M3.98361 34.7137C1.79048 35.6944 -0.364829 33.2756 0.882983 31.23L19.2126 1.17375C19.4304 0.815444 19.738 0.519041 20.1053 0.31329C20.4727 0.107538 20.8874 -0.000579834 21.3093 -0.000579834C21.7312 -0.000579834 22.1459 0.107538 22.5133 0.31329C22.8806 0.519041 23.1882 0.815444 23.406 1.17375L41.7394 31.23C42.9872 33.2737 40.8319 35.6944 38.6369 34.7137L30.1763 30.93C29.9353 30.8221 29.7207 30.6638 29.5472 30.4659C29.3737 30.2681 29.2453 30.0354 29.171 29.7837C29.0966 29.5321 29.078 29.2675 29.1165 29.008C29.1549 28.7486 29.2494 28.5004 29.3936 28.2806C29.5432 28.0534 29.6396 27.7958 29.6758 27.5268C29.712 27.2579 29.687 26.9842 29.6027 26.7261C29.5184 26.4679 29.3769 26.2317 29.1886 26.0348C29.0003 25.8379 28.77 25.6853 28.5145 25.5881L25.6747 24.5138C25.2691 24.3591 24.9121 24.1003 24.6406 23.7638L23.2188 22.0125C22.9894 21.729 22.6987 21.5002 22.3682 21.3429C22.0377 21.1857 21.6759 21.1041 21.3093 21.1041C20.9427 21.1041 20.5809 21.1857 20.2504 21.3429C19.9199 21.5002 19.6292 21.729 19.3998 22.0125L17.978 23.7656C17.7058 24.1031 17.3484 24.36 16.9438 24.5138L14.1041 25.5881C13.8485 25.6851 13.6179 25.8375 13.4294 26.0344C13.2409 26.2312 13.0992 26.4673 13.0147 26.7255C12.9302 26.9837 12.9051 27.2574 12.9412 27.5265C12.9772 27.7956 13.0735 28.0533 13.2231 28.2806C13.3673 28.5003 13.462 28.7483 13.5005 29.0077C13.5391 29.2671 13.5207 29.5316 13.4465 29.7832C13.3723 30.0349 13.2442 30.2676 13.0709 30.4656C12.8975 30.6635 12.6831 30.8219 12.4423 30.93L3.98361 34.7137Z"
                                                        fill="url(#paint0_linear_4348_31748)"
                                                    />
                                                    <path
                                                        d="M8.21954 40C5.57645 40 4.80318 36.4187 7.21373 35.3425L20.3063 29.4887C20.6225 29.3473 20.9653 29.2742 21.3121 29.2742C21.6589 29.2742 22.0018 29.3473 22.3179 29.4887L35.4105 35.3425C37.8211 36.4206 37.0478 40 34.4047 40H28.2186C27.5701 40 26.9462 39.7431 26.4868 39.2875L23.0458 35.8675C22.8184 35.6413 22.5482 35.4618 22.2507 35.3394C21.9532 35.2169 21.6342 35.1539 21.3121 35.1539C20.99 35.1539 20.6711 35.2169 20.3736 35.3394C20.0761 35.4618 19.8059 35.6413 19.5784 35.8675L16.1375 39.2856C15.9102 39.512 15.64 39.6917 15.3425 39.8143C15.045 39.9369 14.726 40 14.4038 40H8.21954Z"
                                                        fill="url(#paint1_linear_4348_31748)"
                                                    />
                                                </g>
                                            </g>
                                            <defs>
                                                <linearGradient
                                                    id="paint0_linear_4348_31748"
                                                    x1="21.3112"
                                                    y1="-0.000579834"
                                                    x2="21.3112"
                                                    y2="34.9389"
                                                    gradientUnits="userSpaceOnUse"
                                                >
                                                    <stop
                                                        stop-color="#F8B434"
                                                    />
                                                    <stop
                                                        offset="1"
                                                        stop-color="#B9730D"
                                                    />
                                                </linearGradient>
                                                <linearGradient
                                                    id="paint1_linear_4348_31748"
                                                    x1="21.3121"
                                                    y1="29.2742"
                                                    x2="21.3121"
                                                    y2="40"
                                                    gradientUnits="userSpaceOnUse"
                                                >
                                                    <stop
                                                        stop-color="#F8B434"
                                                    />
                                                    <stop
                                                        offset="1"
                                                        stop-color="#B9730D"
                                                    />
                                                </linearGradient>
                                                <clipPath id="clip0_4348_31748">
                                                    <rect
                                                        width="44"
                                                        height="45"
                                                        fill="white"
                                                    />
                                                </clipPath>
                                                <clipPath id="clip1_4348_31748">
                                                    <rect
                                                        width="45.375"
                                                        height="45"
                                                        fill="white"
                                                        transform="translate(-1.375)"
                                                    />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="upgradeInfoUpgrade"
                                v-if="state === 'init' || state === 'ready'"
                            >
                                <div class="largeText uppercase">
                                    {{ $t("upgrade.header") }}
                                </div>
                            </div>
                            <div
                                class="upgradeInfo_lose"
                                v-if="state === 'lose'"
                            >
                                <div class="largeText uppercase">YOU LOST</div>
                            </div>
                            <div
                                class="upgradeInfo"
                                v-if="state === 'init' || state === 'ready'"
                            >
                                <div class="upgradeInfoChance">
                                    {{ $t("upgrade.info") }}
                                    <p>{{ $t("upgrade.chance") }}</p>
                                </div>
                                <div class="largeText">
                                    {{ getGameChance.gameChance }}%
                                </div>
                            </div>
                            <div class="upgrade__card" v-if="state === 'win'">
                                <div class="upgrade_card__visible">
                                    <div class="upgrade__card__rarity">
                                        <div
                                            class="skinIcon__background"
                                            :class="[
                                                getItemRarityClass(
                                                    selectedSiteItem.rarity
                                                ),
                                            ]"
                                        ></div>
                                    </div>
                                    <div class="upgrade__image_wrapper">
                                        <img
                                            :srcset="
                                                'https://steamcommunity-a.akamaihd.net/economy/image/' +
                                                selectedSiteItem.icon_url
                                            "
                                            :alt="
                                                selectedSiteItem.market_hash_name
                                            "
                                            loading="lazy"
                                            decoding="async"
                                        />
                                    </div>
                                    <div class="drops__names__wrapper">
                                        <div class="drops__names">
                                            <div class="drops__names_weapon">
                                                <div class="name-h3 uppercase">
                                                    {{
                                                        getItemType(
                                                            selectedSiteItem.market_hash_name
                                                        )
                                                    }}
                                                </div>
                                            </div>
                                            <div class="drops__names_skin">
                                                <div class="name-h4">
                                                    {{
                                                        getItemName(
                                                            selectedSiteItem.market_hash_name
                                                        )
                                                    }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="upgradeDecor">
                                <img
                                    src="/assets/upgrade/decor.png"
                                    class="decor"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="betContainer">
                        <div class="betVisual">
                            <div
                                class="selectedSkin__price"
                                v-if="selectedSiteItem !== null"
                            >
                                <div class="selectedSkin__price-container">
                                    <div class="selectedSkin__price-value">
                                        {{ selectedSiteItem.price }} ₽
                                    </div>
                                </div>
                            </div>
                            <div class="ellipseXs">
                                <img
                                    src="/assets/upgrade/ellipse/ellipse-default.svg"
                                    class="ellipseUpgrade"
                                />
                            </div>
                            <div
                                class="selectedSkin__info"
                                v-if="selectedSiteItem !== null"
                            >
                                <div class="selectedSkin__name">
                                    {{
                                        getItemType(
                                            selectedSiteItem.market_hash_name
                                        )
                                    }}
                                </div>
                                <div class="selectedSkin__name">
                                    {{
                                        getItemName(
                                            selectedSiteItem.market_hash_name
                                        )
                                    }}
                                </div>
                                <div class="selectedSkin__flotValue">
                                    {{ selectedSiteItem.exterior }}
                                </div>
                            </div>
                            <div class="selectedSkin">
                                <img
                                    v-if="selectedSiteItem === null"
                                    src="/assets/upgrade/skin-placeholder.png"
                                    alt="AKR | Scylla"
                                    class=""
                                />
                                <img
                                    v-else
                                    :srcset="
                                        'https://steamcommunity-a.akamaihd.net/economy/image/' +
                                        selectedSiteItem.icon_url
                                    "
                                    :alt="selectedSiteItem.market_hash_name"
                                    class=""
                                />
                            </div>
                            <img
                                src="/assets/upgrade/podium.png"
                                alt="podium-upgrade"
                                class="podiumImage"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="centerSection">
            <!---->
            <!---->
            <div class="upgradeButtons__container">
                <div class="control">
                    <div class="toggle__buttons">
                        <button
                            @click="setChance(1.2)"
                            :class="{ 'color--gray-gradient': chance === 1.2 }"
                            class="controls size--large fit-content toggle__button color--gray"
                        >
                            <div class="text color--white variant--h3 bold">
                                X1.2
                            </div>
                        </button>
                        <button
                            :class="{ 'color--gray-gradient': chance === 1.5 }"
                            @click="setChance(1.5)"
                            class="controls size--large fit-content toggle__button color--gray"
                        >
                            <div class="text color--disabled variant--h3 bold">
                                X1.5
                            </div>
                        </button>
                        <button
                            :class="{ 'color--gray-gradient': chance === 2 }"
                            @click="setChance(2)"
                            class="controls size--large fit-content toggle__button color--gray"
                        >
                            <div class="text color--disabled variant--h3 bold">
                                X2
                            </div>
                        </button>
                        <button
                            :class="{ 'color--gray-gradient': chance === 5 }"
                            @click="setChance(5)"
                            class="controls size--large fit-content toggle__button color--gray"
                        >
                            <div class="text color--disabled variant--h3 bold">
                                X5
                            </div>
                        </button>
                        <button
                            :class="{ 'color--gray-gradient': chance === 10 }"
                            @click="setChance(10)"
                            class="controls size--large fit-content toggle__button color--gray"
                        >
                            <div class="text color--disabled variant--h3 bold">
                                X10
                            </div>
                        </button>
                    </div>
                </div>
            </div>
            <button class="upgrade__btn" @click="startUpgrade">
                {{ $t("upgrade.header") }}
            </button>
            <!---->
            <!---->
        </div>
        <section class="bottomSection">
            <div class="selectors__container">
                <div class="your_inventory__wrapper">
                    <div class="site_inventory__heading">
                        <div class="heading">
                            <div class="header__title uppercase">
                                {{ $t("upgrade.yourItems") }}
                            </div>
                            <div class="skinFilterRight">
                                <div class="skinFilterRight__main">
                                    <div class="dropDown">
                                        <div class="button__wrapper">
                                            <button
                                                @click="filterPrice"
                                                :class="{
                                                    actived:
                                                        orderByPrice === 'desc',
                                                }"
                                                class="skinFilterRight__dropdownTrigger skinFilterRight__dropdownTriggerRarity"
                                                type="button"
                                            >
                                                <div class="dropdown__selected">
                                                    <div
                                                        class="dropdown__selectedText"
                                                    >
                                                        {{
                                                            $t("upgrade.price")
                                                        }}
                                                    </div>
                                                </div>
                                                <div
                                                    class="dropdown__selectedIcon"
                                                >
                                                    <div
                                                        class="icon__wrapper"
                                                        :style="
                                                            orderByPrice ===
                                                            'desc'
                                                                ? 'transform: rotate(0deg)'
                                                                : 'transform: rotate(180deg)'
                                                        "
                                                    >
                                                        <svg
                                                            width="20"
                                                            height="20"
                                                            viewBox="0 0 20 20"
                                                            fill="none"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                        >
                                                            <path
                                                                d="M9.99937 11.4153L5.53286 7.69317C5.17929 7.39853 4.65382 7.4463 4.35919 7.79987C4.06455 8.15343 4.11232 8.6789 4.46588 8.97354L9.46588 13.1402C9.77492 13.3977 10.2238 13.3977 10.5329 13.1402L15.5329 8.97354C15.8864 8.6789 15.9342 8.15343 15.6396 7.79987C15.3449 7.4463 14.8194 7.39853 14.4659 7.69317L9.99937 11.4153Z"
                                                                fill="#687894"
                                                            />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="your_inventory__container">
                        <!-- <div class="your_inventory__empty">
                            <div
                                class="text color--gray-light variant--h5 align--center"
                            >
                                Ничего не найдено
                            </div>
                        </div> -->
                        <div class="your_inventory__content">
                            <div class="upgrade__items">
                                <button
                                    v-for="(
                                        userItem, index
                                    ) in filterUserItemsByDesc"
                                    :key="index"
                                    :class="[
                                        getItemRarityClass(
                                            userItem.item.rarity
                                        ),
                                        {
                                            selected:
                                                selectedUserItem !== null &&
                                                selectedUserItem.id ===
                                                    userItem.id,
                                        },
                                    ]"
                                    @click="setUserItem(userItem.id)"
                                    type="button"
                                    class="upgrade__item"
                                    :aria-selected="
                                        selectedUserItem !== null &&
                                        selectedUserItem.id === userItem.id
                                            ? 'true'
                                            : 'false'
                                    "
                                >
                                    <div
                                        class="skin__container size--medium"
                                        :class="[
                                            getItemRarityClass(
                                                userItem.item.rarity
                                            ),
                                            {
                                                selected:
                                                    selectedUserItem !== null &&
                                                    selectedUserItem.id ===
                                                        userItem.id,
                                            },
                                        ]"
                                    >
                                        <div class="skinCard">
                                            <div class="skinCard__price">
                                                {{ userItem.price }} ₽
                                            </div>
                                            <div
                                                class="skinCard__image_wrapper"
                                            >
                                                <img
                                                    :srcset="
                                                        'https://steamcommunity-a.akamaihd.net/economy/image/' +
                                                        userItem.item.icon_url
                                                    "
                                                    :alt="
                                                        userItem.item
                                                            .market_hash_name
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
                                                                    userItem
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
                                                                        userItem
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
                                        <div class="skinCard__backdrops">
                                            <div
                                                class="skinIcon__backgrounds"
                                                :class="[
                                                    getItemRarityClass(
                                                        userItem.item.rarity
                                                    ),
                                                    {
                                                        selected:
                                                            selectedUserItem !==
                                                                null &&
                                                            selectedUserItem.id ===
                                                                userItem.id,
                                                    },
                                                ]"
                                            ></div>
                                        </div>
                                        <div
                                            class="skinCard__divider"
                                            :class="[
                                                getItemRarityClass(
                                                    userItem.item.rarity
                                                ),
                                                {
                                                    selected:
                                                        selectedUserItem !==
                                                            null &&
                                                        selectedUserItem.id ===
                                                            userItem.id,
                                                },
                                            ]"
                                        ></div>
                                    </div>
                                </button>
                            </div>
                        </div>
                        <div class="show_more__wrapper">
                            <button
                                :disabled="currentPageUser === 1"
                                @click="goToPageUser(currentPageUser - 1)"
                                type="button"
                                class="controls color--gray-dark size--large fit--content button radius-14 min--48"
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
                                        ></path>
                                    </svg>
                                </div>
                            </button>
                            <button
                                type="button"
                                class="controls color--blue-gradient size--large fit--content button radius-14 min--48"
                            >
                                <div class="button__content">
                                    {{ currentPageUser }}
                                </div>
                            </button>
                            <button
                                :disabled="currentPageUser === totalPagesUser"
                                @click="goToPageUser(currentPageUser + 1)"
                                type="button"
                                class="controls color--gray-dark size--large fit--content button radius-14 min--48"
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
                                        ></path>
                                    </svg>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="site_inventory__wrapper">
                    <div class="site_inventory__heading">
                        <div class="heading">
                            <div class="header__title uppercase">
                                {{ $t("upgrade.siteItems") }}
                            </div>
                            <div
                                class="skinFilterRight"
                                v-if="filter === 'all'"
                            >
                                <div class="skinFilterRight__main">
                                    <div class="skinFilterRight__sum">
                                        <div class="skinFilterRight__field">
                                            <div
                                                class="text color--gray-light variant--h6 skinFilterRight__fieldIcon"
                                            >
                                                ₽
                                            </div>
                                            <input
                                                v-model="searchPrice"
                                                class="skinFilterRight__sumInput"
                                                type="number"
                                                :placeholder="
                                                    $t('upgrade.price') + '>'
                                                "
                                            />
                                        </div>
                                    </div>
                                </div>
                                <button
                                    @click="filterRightPrice"
                                    type="button"
                                    class="skinFilterRight__searchTrigger mobile"
                                >
                                    <svg
                                        width="19"
                                        height="19"
                                        viewBox="0 0 19 19"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M8.14202 0.428589C3.88154 0.428589 0.427734 3.88239 0.427734 8.14287C0.427734 12.4034 3.88154 15.8572 8.14202 15.8572C9.96346 15.8572 11.6375 15.2259 12.9572 14.1702L16.9645 18.1775C17.2992 18.5123 17.8419 18.5123 18.1767 18.1775C18.5114 17.8428 18.5114 17.3001 18.1767 16.9654L14.1694 12.958C15.225 11.6383 15.8563 9.96432 15.8563 8.14287C15.8563 3.88239 12.4025 0.428589 8.14202 0.428589ZM8.14202 2.14287C4.82831 2.14287 2.14202 4.82917 2.14202 8.14287C2.14202 11.4566 4.82831 14.1429 8.14202 14.1429C11.4557 14.1429 14.142 11.4566 14.142 8.14287C14.142 4.82917 11.4557 2.14287 8.14202 2.14287Z"
                                            fill="#687894"
                                        />
                                    </svg>
                                </button>
                            </div>
                            <div
                                class="skinFilterRight"
                                v-if="filter === 'price'"
                            >
                                <div class="skinFilterRight__searchBar">
                                    <input
                                        v-model="searchName"
                                        class="skinFilterRight__searchBarInput"
                                        placeholder="Поиск"
                                        value=""
                                    /><svg
                                        width="16"
                                        height="16"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        class="skinFilterRight__searchBarIcon"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M9.387 3.097a6.29 6.29 0 100 12.58 6.29 6.29 0 000-12.58zM0 9.387a9.387 9.387 0 1118.774 0A9.387 9.387 0 010 9.387z"
                                            fill="var(--color-text2)"
                                        ></path>
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M14.389 14.389a1.548 1.548 0 012.19 0l6.968 6.968a1.548 1.548 0 11-2.19 2.19l-6.968-6.968a1.548 1.548 0 010-2.19z"
                                            fill="var(--color-text2)"
                                        ></path>
                                    </svg>
                                </div>
                                <button
                                    @click="filterRightAll"
                                    type="button"
                                    class="skinFilterRight__searchTrigger"
                                >
                                    <svg
                                        width="16"
                                        height="16"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        class="icon"
                                    >
                                        <g
                                            clip-path="url(#close_svg__close_svg__clip0_8402_11181)"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M14.55 12l8.921 8.922a1.803 1.803 0 01-2.549 2.55L12 14.549l-8.923 8.923a1.803 1.803 0 01-2.549-2.55L9.451 12 .528 3.077A1.803 1.803 0 013.078.528L12 9.451 20.922.528a1.803 1.803 0 012.55 2.55L14.549 12z"
                                                fill="var(--color-red-light)"
                                            ></path>
                                        </g>
                                        <defs>
                                            <clipPath
                                                id="close_svg__close_svg__clip0_8402_11181"
                                            >
                                                <path
                                                    fill="#fff"
                                                    d="M0 0h24v24H0z"
                                                ></path>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="site_inventory__container">
                        <div class="site_inventory__content">
                            <div class="upgrade__items">
                                <button
                                    @click="setSiteItem(siteItem.id)"
                                    v-for="(siteItem, index) in siteItems"
                                    :key="index"
                                    type="button"
                                    class="upgrade__item"
                                    :class="[
                                        getItemRarityClass(siteItem.rarity),
                                        {
                                            selected:
                                                selectedSiteItem &&
                                                selectedSiteItem.id ===
                                                    siteItem.id,
                                        },
                                    ]"
                                    :aria-selected="
                                        selectedSiteItem &&
                                        selectedSiteItem.id === siteItem.id
                                            ? 'true'
                                            : 'false'
                                    "
                                >
                                    <div
                                        class="skin__container size--medium"
                                        :class="[
                                            getItemRarityClass(siteItem.rarity),
                                            {
                                                selected:
                                                    selectedSiteItem &&
                                                    selectedSiteItem.id ===
                                                        siteItem.id,
                                            },
                                        ]"
                                    >
                                        <div class="skinCard">
                                            <div class="skinCard__price">
                                                {{ siteItem.price }} ₽
                                            </div>
                                            <div
                                                class="skinCard__image_wrapper"
                                            >
                                                <img
                                                    :srcset="
                                                        'https://steamcommunity-a.akamaihd.net/economy/image/' +
                                                        siteItem.icon_url
                                                    "
                                                    :alt="
                                                        siteItem.market_hash_name
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
                                                                    siteItem.market_hash_name
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
                                                                        siteItem.market_hash_name
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
                                                        siteItem.rarity
                                                    ),
                                                    {
                                                        selected:
                                                            selectedSiteItem &&
                                                            selectedSiteItem.id ===
                                                                siteItem.id,
                                                    },
                                                ]"
                                            ></div>
                                        </div>
                                        <div
                                            class="skinCard__divider"
                                            :class="[
                                                getItemRarityClass(
                                                    siteItem.rarity
                                                ),
                                                {
                                                    selected:
                                                        selectedSiteItem &&
                                                        selectedSiteItem.id ===
                                                            siteItem.id,
                                                },
                                            ]"
                                        ></div>
                                    </div>
                                </button>
                            </div>
                        </div>
                        <div class="show_more__wrapper">
                            <button
                                :disabled="currentPage === 1"
                                @click="goToPage(currentPage - 1)"
                                type="button"
                                class="controls color--gray-dark size--large fit--content button radius-14 min--48"
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
                                        ></path>
                                    </svg>
                                </div>
                            </button>
                            <button
                                type="button"
                                class="controls color--blue-gradient size--large fit--content button radius-14 min--48"
                            >
                                <div class="button__content">
                                    {{ currentPage }}
                                </div>
                            </button>
                            <button
                                :disabled="currentPage === totalPages"
                                @click="goToPage(currentPage + 1)"
                                type="button"
                                class="controls color--gray-dark size--large fit--content button radius-14 min--48"
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
                                        ></path>
                                    </svg>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import { set } from "vue";
import VueSlider from "vue-slider-component";
import {
    getItemName,
    getItemRarityClass,
    getItemType,
} from "../helpers/helper";
export default {
    data() {
        return {
            state: "init", //init, ready, win, lose
            filter: "all",
            inGame: false,
            chance: 1.2,
            plusViaBalance: 0,
            userBalance: 0,
            totalSearchPrice: 0,
            searchName: "",
            searchPrice: null,
            circleRotate: 0,
            rounds: 4,
            dropList: false,
            orderByPrice: "desc",
            selectedRarity: "Все",
            rarities: [
                "Все",
                "Контрабанда",
                "Тайное",
                "Засекреченное",
                "Запрещенное",
                "Армейское",
                "Промышленное",
            ],
            rarityMapping: {
                Все: null,
                Контрабанда: "★",
                Тайное: "Covert",
                Засекреченное: "Classified",
                Запрещенное: "Restricted",
                Армейское: "Mil-Spec Grade",
                Промышленное: "Industrial Grade",
            },
            userItems: [],
            siteItems: [],
            currentPage: 1,
            totalPages: 1,
            currentPageUser: 1,
            totalPagesUser: 1,
            selectedUserItem: null,
            selectedSiteItem: null,
            userBalanceSliderOptions: {
                direction: "ltr",
                disabled: true,
                max: 100,
                tooltip: "none",
                interval: 1,
            },
            chanceSliderOptions: {
                direction: "ltr",
                min: 1.2,
                max: 10,
                interval: 1,
                data: [1.2, 1.5, 2, 5, 10],
                tooltip: "none",
                duration: 0.5,
            },
        };
    },
    watch: {
        plusViaBalance(oldValue, newValue) {
            if (this.plusViaBalance > this.userBalance) {
                return (this.plusViaBalance = this.userBalance);
            }
            if (this.plusViaBalance < 0) {
                return (this.plusViaBalance = 0);
            }
            this.totalSearchPrice =
                parseInt(this.totalSearchPrice) + this.searchPrice;
            this.getSiteItems();
        },
        selectedUserItem() {
            this.selectedSiteItem = null;
            this.getSiteItems();
        },
        searchPrice() {
            this.totalSearchPrice = Number(this.searchPrice) + 1;
            this.selectedSiteItem = null;
            this.getSiteItems();
        },

        chance(oldValue, newValue) {
            this.totalSearchPrice = this.selectedUserItem.price * this.chance;
            this.getSiteItems();
        },
        searchName() {
            this.selectedSiteItem = null;
            this.getSiteItems();
        },
    },
    computed: {
        getGameChance() {
            let gameChance = 100,
                transformChance = 1;
            const itemOrBalance = this.selectedUserItem
                ? this.selectedUserItem.price + this.plusViaBalance
                : this.plusViaBalance;

            if (this.selectedSiteItem !== null) {
                gameChance =
                    (itemOrBalance / this.selectedSiteItem.price) * 100;

                gameChance = Math.min(gameChance, 75);
                transformChance = gameChance / 100;
            }

            return {
                gameChance: parseInt(gameChance.toFixed(0)),
                transformChance: transformChance.toFixed(2),
            };
        },
        filterUserItemsByDesc() {
            return this.userItems.sort((a, b) => {
                if (this.orderByPrice === "desc") {
                    return a.price - b.price;
                }
                return b.price - a.price;
            });
        },
    },
    mounted() {
        this.getUserItems();
        this.getSiteItems();
        setTimeout(() => {
            this.userBalance = this.$root.user.balance;
            this.userBalanceSliderOptions.disabled = this.$root.isAuthorized
                ? false
                : true;
            this.userBalanceSliderOptions.max = this.$root.user.balance;
        }, 300);
    },
    methods: {
        selectRarity(rarity) {
            this.selectedRarity = rarity;
            this.dropList = false;
            this.getSiteItems();
        },
        startUpgrade() {
            if (this.inGame) return;
            this.inGame = true;

            if (this.selectedUserItem === null && this.plusViaBalance === 0) {
                this.inGame = false;
                return this.$toast.error(
                    `Ваш предмет не выбран, либо не указана сумма`
                );
            }
            if (this.selectedSiteItem === null) {
                this.inGame = false;
                return this.$toast.error(`Предмет сайта не выбран`);
            }
            this.axios
                .post("/upgrades/create", {
                    userItem:
                        this.selectedUserItem !== null
                            ? this.selectedUserItem.id
                            : null,
                    plusBalance: this.plusViaBalance,
                    gameChance: this.getGameChance.gameChance,
                    siteItem: this.selectedSiteItem.id,
                })
                .then((res) => {
                    const result = res.data;

                    if (!result.success) {
                        this.inGame = false;
                        return this.$toast.error(result.message);
                    }
                    if (result.success) {
                        this.startAnimation(result);
                    }
                });
        },
        startAnimation(data) {
            let chanceInDeg, angle, state;
            const gameChance = this.getGameChance.gameChance;

            if (data.win) {
                // Генерируем случайное число в диапазоне от 0 до gameChance
                const randomValue = this.getRandomArbitrary(0, gameChance);
                chanceInDeg = (randomValue / 100) * 360;
                angle =
                    360 * this.rounds + this.getRandomArbitrary(0, chanceInDeg);
                this.circleRotate = angle;
                setTimeout(() => {
                    this.$root.playSound("upgrade-success");
                }, 5500);
                state = "win";
            } else {
                // Генерируем случайное число больше, чем gameChance, но не больше 100
                const randomValue = this.getRandomArbitrary(
                    gameChance + 1,
                    100
                );
                chanceInDeg = (randomValue / 100) * 360;
                angle =
                    360 * this.rounds +
                    this.getRandomArbitrary(chanceInDeg + 1, 360);
                this.circleRotate = angle;
                setTimeout(() => {
                    this.$root.playSound("upgrade-fail");
                }, 5500);
                state = "lose";
            }

            setTimeout(() => {
                this.state = state;

                setTimeout(() => {
                    this.resetGame();
                }, 5000);
            }, 5500);
        },

        // Примерная реализация getRandomArbitrary
        getRandomArbitrary(min, max) {
            return Math.random() * (max - min) + min;
        },
        getRandomArbitrary(min, max) {
            return Math.floor(Math.random() * (max - min) + min);
        },
        calculatePath() {
            const angle = (this.getGameChance.gameChance / 100) * 360;
            const radius = 150;

            const centerX = 190;
            const centerY = 190;

            const largeArcFlag = angle <= 180 ? 0 : 1;
            const sweepFlag = 1;

            const startAngle = -90;
            const endAngle = startAngle + angle;

            const radiansStart = startAngle * (Math.PI / 180);
            const radiansEnd = endAngle * (Math.PI / 180);

            const startX = centerX + radius * Math.cos(radiansStart);
            const startY = centerY + radius * Math.sin(radiansStart);

            const endX = centerX + radius * Math.cos(radiansEnd);
            const endY = centerY + radius * Math.sin(radiansEnd);

            return `M ${startX} ${startY} A ${radius} ${radius} 0 ${largeArcFlag} ${sweepFlag} ${endX} ${endY}`;
        },
        resetGame() {
            this.state = "init";
            this.inGame = false;
            this.chance = 1.2;
            this.plusViaBalance = 0;
            this.totalSearchPrice = 0;
            this.searchName = "";
            this.searchPrice = 0;
            this.orderByPrice = "desc";
            this.selectedUserItem = null;
            this.selectedSiteItem = null;
            this.circleRotate = 0;

            this.getUserItems();
            this.getSiteItems();
        },
        async getUserItems() {
            try {
                const response = await this.axios.get("/upgrades/user/items", {
                    params: { page: this.currentPageUser }, // Передаём текущую страницу
                });
                const result = response.data;
                this.userItems = result.userItems;
                this.totalPagesUser = result.pagination.last_page; // Общее количество страниц
                this.currentPageUser = result.pagination.current_page; // Текущая страница
            } catch (error) {
                console.error(
                    "Ошибка загрузки пользовательских предметов:",
                    error
                );
            }
        },
        async getSiteItems() {
            try {
                const response = await this.axios.post("/upgrades/site/items", {
                    name: this.searchName,
                    price:
                        this.totalSearchPrice === 0
                            ? 20
                            : this.totalSearchPrice,
                    rarity: this.rarityMapping[this.selectedRarity],
                    page: this.currentPage, // Передаём текущую страницу на сервер
                });
                this.siteItems = response.data.siteItems.data;
                this.totalPages = response.data.siteItems.last_page; // Общее количество страниц
                this.currentPage = response.data.siteItems.current_page; // Текущая страница
            } catch (error) {
                console.error("Ошибка загрузки сайтовских предметов:", error);
            }
        },
        goToPage(page) {
            if (page < 1 || page > this.totalPages) return;
            this.currentPage = page;
            this.getSiteItems(); // Загрузка данных для новой страницы
        },
        goToPageUser(page) {
            if (page < 1 || page > this.totalPagesUser) return;
            this.currentPageUser = page;
            this.getUserItems(); // Загрузка данных для новой страницы
        },
        setUserItem(id) {
            if (this.state == "win" || this.state == "lose") {
                return this.$toast.error("Нельзя выбрать во время игры");
            }

            this.$root.playSound("upgrade-select-item2");

            const itemIndex = this.userItems.findIndex(
                (item) => item.id === id
            );
            const item = this.userItems[itemIndex].item;

            this.selectedUserItem = this.userItems[itemIndex];
            this.totalSearchPrice = (
                this.userItems[itemIndex].price * this.chance
            ).toFixed(0);
            if (
                this.selectedSiteItem !== null &&
                this.selectedUserItem !== null
            ) {
                this.state = "ready";
            }
            this.$forceUpdate();
        },
        setSiteItem(id) {
            if (this.state == "win" || this.state == "lose") {
                return this.$toast.error("Нельзя выбрать во время игры");
            }

            this.$root.playSound("upgrade-select-item2");

            let index = this.siteItems.findIndex((item) => item.id === id);
            let item = this.siteItems[index];

            this.selectedSiteItem = this.siteItems[index];
            if (
                this.selectedSiteItem !== null &&
                this.selectedUserItem !== null
            ) {
                this.state = "ready";
            }
            this.$forceUpdate();
        },
        filterPrice() {
            this.orderByPrice = this.orderByPrice === "desc" ? "asc" : "desc";
            this.$forceUpdate();
        },
        filterRightAll() {
            this.filter = "all";
        },
        filterRightPrice() {
            this.filter = "price";
        },
        toggleDropList() {
            this.dropList = !this.dropList;
        },
        setChance(chance) {
            this.chance = chance;
        },
        getItemName,
        getItemType,
        getItemRarityClass,
    },
    components: {
        VueSlider,
    },
};
</script>
