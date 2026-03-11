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
            <span class="uppercase">Рефералка</span>
        </div>
        <div class="MainContainer__header">
            <div
                class="text color--disabled variant--h1 align--center bold uppercase"
            >
                {{ $t("referral.title") }}
            </div>
        </div>
        <div class="referral-page">
            <div class="referral__top">
                <div class="referral__top_left_side">
                    <img
                        v-if="stats.level === 1"
                        class="referral__lvl-img"
                        src="/assets/referral/lvls/lvl-1-240.png"
                    />
                    <img
                        v-if="stats.level === 2"
                        class="referral__lvl-img"
                        src="/assets/referral/lvls/lvl-2-240.png"
                    />
                    <img
                        v-if="stats.level === 3"
                        class="referral__lvl-img"
                        src="/assets/referral/lvls/lvl-3-240.png"
                    />
                </div>
                <div class="referral__top_right_side">
                    <div class="referral__header">
                        <div
                            class="referral__lvl-name"
                            v-if="stats.level === 1"
                        >
                            {{ $t("referral.silver") }}
                        </div>
                        <div
                            class="referral__lvl-name"
                            v-if="stats.level === 2"
                        >
                            {{ $t("referral.gold") }}
                        </div>
                        <div
                            class="referral__lvl-name"
                            v-if="stats.level === 3"
                        >
                            {{ $t("referral.platinum") }}
                        </div>
                        <div class="referral__lvl-gain">
                            <div class="referral__gain user">
                                {{ stats.total_deposit }} ₽
                            </div>
                            <label>/</label>
                            <div class="referral__gain">
                                <span v-if="stats.level === 1">150</span>
                                <span v-if="stats.level === 2">500</span>
                                <span v-if="stats.level === 3">500 +</span>
                                ₽
                            </div>
                        </div>
                    </div>
                    <div class="referral__promocode">
                        <div class="referral__promocode-label">
                            {{ $t("referral.promocode") }}
                        </div>
                        <form
                            class="referral-topbar__promocode-form"
                            name="promocode"
                            @submit.prevent="submitPromoCode"
                        >
                            <div class="referral-topbar__promocode-input">
                                <input
                                    v-if="stats.promocode === null"
                                    v-model="promoCode"
                                    class="referral-topbar__promocode-field"
                                    type="text"
                                    name="promocodeID"
                                    :placeholder="$t('referral.platinum')"
                                />
                                <input
                                    v-if="stats.promocode !== null"
                                    class="referral-topbar__promocode-field"
                                    type="text"
                                    name="promocodeID"
                                    :placeholder="stats.promocode"
                                    readonly="readonly"
                                    ref="promocodeName"
                                />
                            </div>
                            <div class="referral-topbar__promocode-btn">
                                <button
                                    v-if="stats.promocode === null"
                                    type="submit"
                                    class="btn btn_size-fill btn_type-fullwidth btn_color-success btn_uppercase"
                                >
                                    <div class="btn__content" type="submit">
                                        <div class="btn__label">
                                            {{ $t("referral.create") }}
                                        </div>
                                    </div>
                                </button>
                                <button
                                    v-if="stats.promocode !== null"
                                    type="button"
                                    @click="copyPromocode"
                                    class="btn btn_size-fill btn_type-fullwidth btn_color-success btn_uppercase"
                                >
                                    <div class="btn__content">
                                        <div class="btn__label">
                                            {{ $t("referral.copy") }}
                                        </div>
                                    </div>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="referral__stats">
                        <div class="stat-card card1">
                            <div class="stat-title">
                                {{ $t("referral.discount") }}
                            </div>
                            <div class="stat-info">
                                <div class="stat-icon">
                                    <svg
                                        width="20"
                                        height="21"
                                        viewBox="0 0 20 21"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <g clip-path="url(#clip0_4078_49060)">
                                            <g
                                                clip-path="url(#clip1_4078_49060)"
                                            >
                                                <mask
                                                    id="mask0_4078_49060"
                                                    style="mask-type: luminance"
                                                    maskUnits="userSpaceOnUse"
                                                    x="0"
                                                    y="0"
                                                    width="20"
                                                    height="21"
                                                >
                                                    <path
                                                        d="M20 0.5H0V20.5H20V0.5Z"
                                                        fill="white"
                                                    />
                                                </mask>
                                                <g
                                                    mask="url(#mask0_4078_49060)"
                                                >
                                                    <path
                                                        d="M15.8333 1.33301H2.5C1.125 1.33301 0 2.458 0 3.833V5.91635C0 6.37467 0.375 6.74967 0.833333 6.74967H1.25C1.94167 6.74967 2.5 7.308 2.5 7.99967C2.5 8.69133 1.94167 9.24967 1.25 9.24967H0.833333C0.375 9.24967 0 9.62467 0 10.083V12.1663C0 13.5413 1.125 14.6663 2.5 14.6663H7.50833C7.5 14.5247 7.5 14.3913 7.5 14.2497C7.5 13.8247 7.54167 13.408 7.61667 12.9997H2.5C2.04167 12.9997 1.66667 12.6247 1.66667 12.1663V10.883C3.075 10.683 4.16667 9.46633 4.16667 7.99967C4.16667 6.533 3.075 5.31634 1.66667 5.11634V3.833C1.66667 3.37467 2.04167 2.99967 2.5 2.99967H15.8333C16.2917 2.99967 16.6667 3.37467 16.6667 3.833V5.11634C16.0417 5.19967 15.475 5.483 15.025 5.933C14.6667 6.29135 14.4167 6.708 14.2833 7.17467C14.3833 7.16635 14.4833 7.16635 14.5833 7.16635C15.0833 7.16635 15.5667 7.21634 16.0417 7.31634C16.0833 7.24134 16.1417 7.17467 16.2 7.11634C16.4333 6.883 16.75 6.74967 17.0833 6.74967H17.5C17.9583 6.74967 18.3333 6.37467 18.3333 5.91635V3.833C18.3333 2.458 17.2083 1.33301 15.8333 1.33301Z"
                                                        fill="url(#paint0_linear_4078_49060)"
                                                    />
                                                    <path
                                                        d="M6.66658 4.45768C6.20658 4.45768 5.83325 4.08435 5.83325 3.62435V2.37435C5.83325 1.91435 6.20658 1.54102 6.66658 1.54102C7.12658 1.54102 7.49991 1.91435 7.49991 2.37435V3.62435C7.49991 4.08435 7.12658 4.45768 6.66658 4.45768Z"
                                                        fill="url(#paint1_linear_4078_49060)"
                                                    />
                                                    <path
                                                        d="M6.66658 10.026C6.20658 10.026 5.83325 9.65266 5.83325 9.19266V6.80598C5.83325 6.34598 6.20658 5.97266 6.66658 5.97266C7.12658 5.97266 7.49991 6.34598 7.49991 6.80598V9.19266C7.49991 9.65266 7.12658 10.026 6.66658 10.026Z"
                                                        fill="url(#paint2_linear_4078_49060)"
                                                    />
                                                    <path
                                                        d="M6.66658 14.4577C6.20658 14.4577 5.83325 14.0843 5.83325 13.6243V12.3743C5.83325 11.9143 6.20658 11.541 6.66658 11.541C7.12658 11.541 7.49991 11.9143 7.49991 12.3743V13.6243C7.49991 14.0843 7.12658 14.4577 6.66658 14.4577Z"
                                                        fill="url(#paint3_linear_4078_49060)"
                                                    />
                                                    <path
                                                        d="M14.5834 8.83301C11.5967 8.83301 9.16675 11.263 9.16675 14.2497C9.16675 17.2363 11.5967 19.6663 14.5834 19.6663C17.5701 19.6663 20.0001 17.2363 20.0001 14.2497C20.0001 11.263 17.5701 8.83301 14.5834 8.83301ZM14.4792 13.6247H14.6876C15.5492 13.6247 16.2501 14.3255 16.2501 15.1872C16.2501 15.8646 15.8134 16.438 15.2084 16.6539V16.958C15.2084 17.3031 14.9284 17.5831 14.5834 17.5831C14.2384 17.5831 13.9584 17.3031 13.9584 16.958V16.7496H13.5417C13.1967 16.7496 12.9167 16.4696 12.9167 16.1246C12.9167 15.7796 13.1967 15.4996 13.5417 15.4996H14.6876C14.8601 15.4996 15.0001 15.3596 15.0001 15.1872C15.0001 15.0146 14.8601 14.8746 14.6876 14.8746H14.4792C13.6176 14.8746 12.9167 14.1738 12.9167 13.3122C12.9167 12.6347 13.3534 12.0614 13.9584 11.8455V11.5414C13.9584 11.1964 14.2384 10.9164 14.5834 10.9164C14.9284 10.9164 15.2084 11.1964 15.2084 11.5414V11.7497H15.6251C15.9701 11.7497 16.2501 12.0297 16.2501 12.3747C16.2501 12.7197 15.9701 12.9997 15.6251 12.9997H14.4792C14.3068 12.9997 14.1667 13.1397 14.1667 13.3122C14.1667 13.4847 14.3068 13.6247 14.4792 13.6247Z"
                                                        fill="url(#paint4_linear_4078_49060)"
                                                    />
                                                </g>
                                            </g>
                                        </g>
                                        <defs>
                                            <linearGradient
                                                id="paint0_linear_4078_49060"
                                                x1="9.16664"
                                                y1="1.33301"
                                                x2="9.16664"
                                                y2="14.6663"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop stop-color="#5CB1FF" />
                                                <stop
                                                    offset="1"
                                                    stop-color="#396CF4"
                                                />
                                            </linearGradient>
                                            <linearGradient
                                                id="paint1_linear_4078_49060"
                                                x1="6.66658"
                                                y1="1.54102"
                                                x2="6.66658"
                                                y2="4.45768"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop stop-color="#5CB1FF" />
                                                <stop
                                                    offset="1"
                                                    stop-color="#396CF4"
                                                />
                                            </linearGradient>
                                            <linearGradient
                                                id="paint2_linear_4078_49060"
                                                x1="6.66658"
                                                y1="5.97266"
                                                x2="6.66658"
                                                y2="10.026"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop stop-color="#5CB1FF" />
                                                <stop
                                                    offset="1"
                                                    stop-color="#396CF4"
                                                />
                                            </linearGradient>
                                            <linearGradient
                                                id="paint3_linear_4078_49060"
                                                x1="6.66658"
                                                y1="11.541"
                                                x2="6.66658"
                                                y2="14.4577"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop stop-color="#5CB1FF" />
                                                <stop
                                                    offset="1"
                                                    stop-color="#396CF4"
                                                />
                                            </linearGradient>
                                            <linearGradient
                                                id="paint4_linear_4078_49060"
                                                x1="14.5834"
                                                y1="8.83301"
                                                x2="14.5834"
                                                y2="19.6663"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop stop-color="#5CB1FF" />
                                                <stop
                                                    offset="1"
                                                    stop-color="#396CF4"
                                                />
                                            </linearGradient>
                                            <clipPath id="clip0_4078_49060">
                                                <rect
                                                    width="20"
                                                    height="20"
                                                    fill="white"
                                                    transform="translate(0 0.5)"
                                                />
                                            </clipPath>
                                            <clipPath id="clip1_4078_49060">
                                                <rect
                                                    width="20"
                                                    height="20"
                                                    fill="white"
                                                    transform="translate(0 0.5)"
                                                />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="stat-value">
                                    {{ stats.percent }} <span>%</span>
                                </div>
                            </div>
                        </div>
                        <div class="stat-card card2">
                            <div class="stat-title">
                                {{ $t("referral.percent") }}
                            </div>
                            <div class="stat-info">
                                <div class="stat-icon">
                                    <svg
                                        width="20"
                                        height="21"
                                        viewBox="0 0 20 21"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <g clip-path="url(#clip0_4078_49079)">
                                            <g
                                                clip-path="url(#clip1_4078_49079)"
                                            >
                                                <mask
                                                    id="mask0_4078_49079"
                                                    style="mask-type: luminance"
                                                    maskUnits="userSpaceOnUse"
                                                    x="0"
                                                    y="1"
                                                    width="19"
                                                    height="19"
                                                >
                                                    <path
                                                        d="M18.6667 1.16699H0V19.8337H18.6667V1.16699Z"
                                                        fill="white"
                                                    />
                                                </mask>
                                                <g
                                                    mask="url(#mask0_4078_49079)"
                                                >
                                                    <path
                                                        d="M12.3717 5.67362C11.5138 5.67362 10.8162 4.97595 10.8162 4.11806C10.8162 3.26017 11.5138 2.5625 12.3717 2.5625C13.2296 2.5625 13.9273 3.26017 13.9273 4.11806C13.9273 4.97595 13.2296 5.67362 12.3717 5.67362Z"
                                                        fill="url(#paint0_linear_4078_49079)"
                                                    />
                                                    <path
                                                        d="M17.0384 10.3406C16.1805 10.3406 15.4828 9.64295 15.4828 8.78505C15.4828 7.92716 16.1805 7.22949 17.0384 7.22949C17.8963 7.22949 18.594 7.92716 18.594 8.78505C18.594 9.64295 17.8963 10.3406 17.0384 10.3406Z"
                                                        fill="url(#paint1_linear_4078_49079)"
                                                    />
                                                    <path
                                                        d="M12.371 10.3403C12.2092 10.3403 12.0451 10.2898 11.9051 10.1848C11.5613 9.92734 11.4921 9.43967 11.7495 9.0959L16.4161 2.87368C16.6744 2.53068 17.1613 2.4599 17.5051 2.71812C17.8488 2.97556 17.918 3.46323 17.6607 3.80702L12.994 10.0292C12.8415 10.233 12.6074 10.3403 12.371 10.3403Z"
                                                        fill="url(#paint2_linear_4078_49079)"
                                                    />
                                                    <path
                                                        d="M0.382666 10.5017C0.170333 10.5056 0 10.6783 0 10.8906V18.0835C0 18.1908 0.0871111 18.2779 0.194445 18.2779H2.03933C2.21356 18.2779 2.366 18.1628 2.41345 17.9956L4.13466 11.9305C4.24589 11.5385 4.03589 11.1263 3.65245 10.987C2.94778 10.7304 1.86666 10.4768 0.382666 10.5017Z"
                                                        fill="url(#paint3_linear_4078_49079)"
                                                    />
                                                    <path
                                                        d="M17.1113 14.7782C15.5557 14.7782 12.4445 16.7467 10.889 16.7467C9.33343 16.7467 7.58343 15.5559 7.58343 15.5559C7.58343 15.5559 9.67877 15.9449 10.889 15.9449C12.0992 15.9449 12.4445 15.5319 12.4445 14.9726C12.4445 13.6116 10.133 13.4 8.96321 13.2219C7.81521 12.5826 7.21865 12.077 5.31698 11.916C5.3061 12.0272 5.28898 12.1377 5.25787 12.2473L3.69531 17.7539C5.46477 18.559 8.5121 19.8338 10.1112 19.8338C12.4445 19.8338 18.6667 16.7226 18.6667 15.9449C18.6667 15.1671 17.889 14.7782 17.1113 14.7782Z"
                                                        fill="url(#paint4_linear_4078_49079)"
                                                    />
                                                </g>
                                            </g>
                                        </g>
                                        <defs>
                                            <linearGradient
                                                id="paint0_linear_4078_49079"
                                                x1="12.3717"
                                                y1="2.5625"
                                                x2="12.3717"
                                                y2="5.67362"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop stop-color="#5CB1FF" />
                                                <stop
                                                    offset="1"
                                                    stop-color="#396CF4"
                                                />
                                            </linearGradient>
                                            <linearGradient
                                                id="paint1_linear_4078_49079"
                                                x1="17.0384"
                                                y1="7.22949"
                                                x2="17.0384"
                                                y2="10.3406"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop stop-color="#5CB1FF" />
                                                <stop
                                                    offset="1"
                                                    stop-color="#396CF4"
                                                />
                                            </linearGradient>
                                            <linearGradient
                                                id="paint2_linear_4078_49079"
                                                x1="14.7051"
                                                y1="2.5625"
                                                x2="14.7051"
                                                y2="10.3403"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop stop-color="#5CB1FF" />
                                                <stop
                                                    offset="1"
                                                    stop-color="#396CF4"
                                                />
                                            </linearGradient>
                                            <linearGradient
                                                id="paint3_linear_4078_49079"
                                                x1="2.08218"
                                                y1="10.5"
                                                x2="2.08218"
                                                y2="18.2779"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop stop-color="#5CB1FF" />
                                                <stop
                                                    offset="1"
                                                    stop-color="#396CF4"
                                                />
                                            </linearGradient>
                                            <linearGradient
                                                id="paint4_linear_4078_49079"
                                                x1="11.181"
                                                y1="11.916"
                                                x2="11.181"
                                                y2="19.8338"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop stop-color="#5CB1FF" />
                                                <stop
                                                    offset="1"
                                                    stop-color="#396CF4"
                                                />
                                            </linearGradient>
                                            <clipPath id="clip0_4078_49079">
                                                <rect
                                                    width="20"
                                                    height="20"
                                                    fill="white"
                                                    transform="translate(0 0.5)"
                                                />
                                            </clipPath>
                                            <clipPath id="clip1_4078_49079">
                                                <rect
                                                    width="18.6667"
                                                    height="20"
                                                    fill="white"
                                                    transform="translate(0 0.5)"
                                                />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="stat-value">
                                    {{ stats.earnings_percent }} <span>%</span>
                                </div>
                            </div>
                        </div>
                        <div class="stat-card card3">
                            <div class="stat-title">
                                {{ $t("referral.limit") }}
                            </div>
                            <div class="stat-info">
                                <div class="stat-icon">
                                    <svg
                                        width="20"
                                        height="21"
                                        viewBox="0 0 20 21"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <g clip-path="url(#clip0_4078_49096)">
                                            <g
                                                clip-path="url(#clip1_4078_49096)"
                                            >
                                                <mask
                                                    id="mask0_4078_49096"
                                                    style="mask-type: luminance"
                                                    maskUnits="userSpaceOnUse"
                                                    x="0"
                                                    y="0"
                                                    width="20"
                                                    height="21"
                                                >
                                                    <path
                                                        d="M20 0.5H0V20.5H20V0.5Z"
                                                        fill="white"
                                                    />
                                                </mask>
                                                <g
                                                    mask="url(#mask0_4078_49096)"
                                                >
                                                    <path
                                                        d="M17.308 15.3082C16.7378 15.3082 16.2046 15.0278 15.8817 14.5581L15.0347 13.3261C14.0371 15.1149 12.1404 16.2698 10.0003 16.2698C7.01386 16.2698 4.55011 13.9887 4.25965 11.0775H4.80796C5.02218 11.0775 5.21882 10.9588 5.31855 10.7691C5.41827 10.5795 5.40472 10.3502 5.28335 10.1737L4.44233 8.95043L3.16796 7.09677C3.06038 6.94024 2.88257 6.84668 2.69257 6.84668C2.66882 6.84668 2.64527 6.84813 2.62198 6.85098C2.59871 6.85383 2.57578 6.85813 2.55323 6.86372C2.49691 6.87774 2.44316 6.90012 2.39382 6.93C2.32476 6.9718 2.26422 7.02824 2.21715 7.09673L0.101759 10.1737C-0.0196083 10.3502 -0.0331631 10.5795 0.0665633 10.7691C0.166289 10.9587 0.362931 11.0775 0.577187 11.0775H1.1725C1.30976 13.2232 2.21105 15.2217 3.74511 16.7558C5.41593 18.4266 7.63737 19.3467 10.0003 19.3467C12.3631 19.3467 14.5846 18.4266 16.2555 16.7558C16.6996 16.3116 17.093 15.8243 17.4306 15.3036C17.3898 15.3063 17.3491 15.3082 17.308 15.3082Z"
                                                        fill="url(#paint0_linear_4078_49096)"
                                                    />
                                                    <path
                                                        d="M10.4402 9.92355H9.56112C9.39448 9.92355 9.25893 9.788 9.25893 9.62137V9.18179C9.25893 9.01519 9.39448 8.87964 9.56112 8.87964H10.4402C10.6069 8.87964 10.7424 9.01519 10.7424 9.18179C10.7424 9.50043 11.0007 9.7587 11.3193 9.7587C11.6379 9.7587 11.8962 9.50039 11.8962 9.18179C11.8962 8.42532 11.3162 7.80192 10.5775 7.73247V7.42359C10.5775 7.10497 10.3192 6.84668 10.0006 6.84668C9.68198 6.84668 9.42369 7.105 9.42369 7.42359V7.73247C8.68503 7.80192 8.10498 8.42532 8.10498 9.18179V9.62137C8.10498 10.4243 8.75816 11.0774 9.56104 11.0774H10.4401C10.6068 11.0774 10.7423 11.213 10.7423 11.3796V11.8192C10.7423 11.9858 10.6067 12.1214 10.4401 12.1214H9.56104C9.39441 12.1214 9.25886 11.9858 9.25886 11.8192C9.25886 11.5006 9.00053 11.2423 8.68194 11.2423C8.36334 11.2423 8.10503 11.5006 8.10503 11.8192C8.10503 12.5757 8.68503 13.1991 9.42373 13.2686V13.5774C9.42373 13.8961 9.68205 14.1543 10.0007 14.1543C10.3193 14.1543 10.5776 13.8959 10.5776 13.5774V13.2686C11.3162 13.1991 11.8963 12.5757 11.8963 11.8192V11.3796C11.8962 10.5767 11.2431 9.92355 10.4402 9.92355Z"
                                                        fill="url(#paint1_linear_4078_49096)"
                                                    />
                                                    <path
                                                        d="M19.9347 10.2319C19.8349 10.0423 19.6383 9.9235 19.424 9.9235H18.8288C18.6914 7.77776 17.7902 5.77933 16.2562 4.24523C14.5853 2.57445 12.3639 1.6543 10.001 1.6543C7.63817 1.6543 5.41664 2.57445 3.74587 4.24526C3.30169 4.68945 2.90837 5.17671 2.57068 5.69753C2.61134 5.69464 2.6522 5.69276 2.69333 5.69276C3.26345 5.69276 3.79662 5.97324 4.11954 6.443L4.96649 7.67495C5.96419 5.88609 7.86078 4.73124 10.001 4.73124C12.9874 4.73124 15.4512 7.01233 15.7415 9.92354H15.1933C14.979 9.92354 14.7824 10.0423 14.6827 10.2319C14.5829 10.4215 14.5965 10.6508 14.7179 10.8273L15.5589 12.0506L16.8333 13.9043C16.8602 13.9434 16.8915 13.9786 16.9263 14.0094C17.0305 14.1017 17.1662 14.1543 17.3087 14.1543C17.4987 14.1543 17.6765 14.0608 17.7842 13.9043L18.5479 12.7932L19.8995 10.8274C20.0209 10.6507 20.0344 10.4214 19.9347 10.2319Z"
                                                        fill="url(#paint2_linear_4078_49096)"
                                                    />
                                                </g>
                                            </g>
                                        </g>
                                        <defs>
                                            <linearGradient
                                                id="paint0_linear_4078_49096"
                                                x1="8.71541"
                                                y1="6.84668"
                                                x2="8.71541"
                                                y2="19.3467"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop stop-color="#5CB1FF" />
                                                <stop
                                                    offset="1"
                                                    stop-color="#396CF4"
                                                />
                                            </linearGradient>
                                            <linearGradient
                                                id="paint1_linear_4078_49096"
                                                x1="10.0006"
                                                y1="6.84668"
                                                x2="10.0006"
                                                y2="14.1543"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop stop-color="#5CB1FF" />
                                                <stop
                                                    offset="1"
                                                    stop-color="#396CF4"
                                                />
                                            </linearGradient>
                                            <linearGradient
                                                id="paint2_linear_4078_49096"
                                                x1="11.2858"
                                                y1="1.6543"
                                                x2="11.2858"
                                                y2="14.1543"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop stop-color="#5CB1FF" />
                                                <stop
                                                    offset="1"
                                                    stop-color="#396CF4"
                                                />
                                            </linearGradient>
                                            <clipPath id="clip0_4078_49096">
                                                <rect
                                                    width="20"
                                                    height="20"
                                                    fill="white"
                                                    transform="translate(0 0.5)"
                                                />
                                            </clipPath>
                                            <clipPath id="clip1_4078_49096">
                                                <rect
                                                    width="20"
                                                    height="20"
                                                    fill="white"
                                                    transform="translate(0 0.5)"
                                                />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="stat-value">
                                    {{ stats.count_deposit }}
                                    <span>/ {{ stats.count }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="stat-card card4">
                            <div class="stat-title">
                                {{ $t("referral.total_deposit") }}
                            </div>
                            <div class="stat-info">
                                <div class="stat-icon">
                                    <svg
                                        width="20"
                                        height="21"
                                        viewBox="0 0 20 21"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <g clip-path="url(#clip0_4078_49113)">
                                            <g
                                                clip-path="url(#clip1_4078_49113)"
                                            >
                                                <mask
                                                    id="mask0_4078_49113"
                                                    style="mask-type: luminance"
                                                    maskUnits="userSpaceOnUse"
                                                    x="0"
                                                    y="0"
                                                    width="20"
                                                    height="20"
                                                >
                                                    <path
                                                        d="M19.3333 0.5H0.666626V19.1667H19.3333V0.5Z"
                                                        fill="white"
                                                    />
                                                </mask>
                                                <g
                                                    mask="url(#mask0_4078_49113)"
                                                >
                                                    <path
                                                        d="M6.88271 4H13.1174L14.4629 2.92356C14.9211 2.558 15.0921 1.96456 14.8985 1.41078C14.7048 0.857 14.2016 0.5 13.6167 0.5H6.38338C5.7985 0.5 5.29527 0.857777 5.1016 1.41078C4.90794 1.96377 5.07904 2.558 5.53638 2.92277L6.88271 4Z"
                                                        fill="url(#paint0_linear_4078_49113)"
                                                    />
                                                    <path
                                                        d="M13.2239 5.16699H6.77611C4.652 7.25222 3 10.9109 3 13.917C3 16.5295 4.38289 19.167 7.47223 19.167H12.7222C15.3612 19.167 17 17.1549 17 13.917C17 10.9109 15.348 7.25222 13.2239 5.16699ZM9.70444 11.5837H10.2956C11.2048 11.5837 11.9444 12.3233 11.9444 13.2326C11.9444 14.0501 11.3549 14.7227 10.5833 14.8597V15.4718C10.5833 15.7938 10.322 16.0551 10 16.0551C9.678 16.0551 9.41667 15.7938 9.41667 15.4718V14.8893H8.63889C8.31689 14.8893 8.05556 14.6279 8.05556 14.3059C8.05556 13.9839 8.31689 13.7226 8.63889 13.7226H10.2956C10.5616 13.7226 10.7778 13.5063 10.7778 13.2403C10.7778 12.9666 10.5616 12.7503 10.2956 12.7503H9.70444C8.79523 12.7503 8.05556 12.0107 8.05556 11.1014C8.05556 10.284 8.64511 9.61122 9.41667 9.47433V8.86143C9.41667 8.53943 9.678 8.2781 10 8.2781C10.322 8.2781 10.5833 8.53943 10.5833 8.86143V9.44477H11.3611C11.6831 9.44477 11.9444 9.7061 11.9444 10.0281C11.9444 10.3501 11.6831 10.6114 11.3611 10.6114H9.70444C9.43844 10.6114 9.22223 10.8277 9.22223 11.0937C9.22223 11.3674 9.43844 11.5837 9.70444 11.5837Z"
                                                        fill="url(#paint1_linear_4078_49113)"
                                                    />
                                                </g>
                                            </g>
                                        </g>
                                        <defs>
                                            <linearGradient
                                                id="paint0_linear_4078_49113"
                                                x1="10"
                                                y1="0.5"
                                                x2="10"
                                                y2="4"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop stop-color="#5CB1FF" />
                                                <stop
                                                    offset="1"
                                                    stop-color="#396CF4"
                                                />
                                            </linearGradient>
                                            <linearGradient
                                                id="paint1_linear_4078_49113"
                                                x1="10"
                                                y1="5.16699"
                                                x2="10"
                                                y2="19.167"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop stop-color="#5CB1FF" />
                                                <stop
                                                    offset="1"
                                                    stop-color="#396CF4"
                                                />
                                            </linearGradient>
                                            <clipPath id="clip0_4078_49113">
                                                <rect
                                                    width="20"
                                                    height="20"
                                                    fill="white"
                                                    transform="translate(0 0.5)"
                                                />
                                            </clipPath>
                                            <clipPath id="clip1_4078_49113">
                                                <rect
                                                    width="20"
                                                    height="18.6667"
                                                    fill="white"
                                                    transform="translate(0 0.5)"
                                                />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="stat-value">
                                    <b>{{ stats.total_deposit }} ₽</b>
                                </div>
                            </div>
                        </div>
                        <div class="stat-card card5">
                            <div class="stat-title">
                                {{ $t("referral.gain") }}
                            </div>
                            <div class="stat-info">
                                <div class="stat-icon">
                                    <svg
                                        width="20"
                                        height="21"
                                        viewBox="0 0 20 21"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <g clip-path="url(#clip0_4078_49126)">
                                            <g
                                                clip-path="url(#clip1_4078_49126)"
                                            >
                                                <mask
                                                    id="mask0_4078_49126"
                                                    style="mask-type: luminance"
                                                    maskUnits="userSpaceOnUse"
                                                    x="0"
                                                    y="0"
                                                    width="20"
                                                    height="20"
                                                >
                                                    <path
                                                        d="M19.3333 0.5H0.666626V19.1667H19.3333V0.5Z"
                                                        fill="white"
                                                    />
                                                </mask>
                                                <g
                                                    mask="url(#mask0_4078_49126)"
                                                >
                                                    <path
                                                        d="M6.09016 11.1591C6.61473 11.1591 7.12179 11.1253 7.60161 11.0622V5.80297C7.12184 5.73995 6.61473 5.70605 6.09016 5.70605C3.09489 5.70605 0.666748 6.80732 0.666748 8.16585V8.69931C0.666748 10.0578 3.09489 11.1591 6.09016 11.1591Z"
                                                        fill="url(#paint0_linear_4078_49126)"
                                                    />
                                                    <path
                                                        d="M6.09016 13.9053C6.61473 13.9053 7.12179 13.8714 7.60161 13.8084V12.2668C7.12169 12.3299 6.61488 12.3642 6.09016 12.3642C3.47561 12.3642 1.2934 11.525 0.780812 10.4082C0.706164 10.5709 0.666748 10.7393 0.666748 10.912V11.4455C0.666748 12.804 3.09489 13.9053 6.09016 13.9053Z"
                                                        fill="url(#paint1_linear_4078_49126)"
                                                    />
                                                    <path
                                                        d="M7.60149 15.1327V15.013C7.12157 15.0759 6.61475 15.1103 6.09003 15.1103C3.47549 15.1103 1.29328 14.2711 0.78069 13.1543C0.706042 13.3169 0.666626 13.4854 0.666626 13.6581V14.1915C0.666626 15.55 3.09477 16.6514 6.09003 16.6514C6.68903 16.6514 7.26516 16.6072 7.80391 16.5259C7.67037 16.2527 7.60149 15.9646 7.60149 15.6662V15.1327Z"
                                                        fill="url(#paint2_linear_4078_49126)"
                                                    />
                                                    <path
                                                        d="M13.9098 1.54004C10.9146 1.54004 8.48645 2.6413 8.48645 3.99985V4.5333C8.48645 5.89185 10.9146 6.99312 13.9098 6.99312C16.905 6.99312 19.3333 5.89185 19.3333 4.5333V3.99985C19.3333 2.6413 16.905 1.54004 13.9098 1.54004Z"
                                                        fill="url(#paint3_linear_4078_49126)"
                                                    />
                                                    <path
                                                        d="M13.9098 8.19819C11.2953 8.19819 9.1131 7.35907 8.60052 6.24219C8.52586 6.40483 8.48645 6.57327 8.48645 6.746V7.27945C8.48645 8.63799 10.9146 9.73925 13.9098 9.73925C16.905 9.73925 19.3333 8.63799 19.3333 7.27945V6.746C19.3333 6.57327 19.2938 6.40483 19.2192 6.24219C18.7066 7.35907 16.5244 8.19819 13.9098 8.19819Z"
                                                        fill="url(#paint4_linear_4078_49126)"
                                                    />
                                                    <path
                                                        d="M13.9098 10.9443C11.2953 10.9443 9.1131 10.1051 8.60052 8.98828C8.52586 9.15091 8.48645 9.31936 8.48645 9.49208V10.0255C8.48645 11.3841 10.9146 12.4854 13.9098 12.4854C16.905 12.4854 19.3333 11.3841 19.3333 10.0255V9.49208C19.3333 9.31936 19.2938 9.15091 19.2192 8.98828C18.7066 10.1052 16.5244 10.9443 13.9098 10.9443Z"
                                                        fill="url(#paint5_linear_4078_49126)"
                                                    />
                                                    <path
                                                        d="M13.9098 13.8388C11.2953 13.8388 9.1131 12.9997 8.60052 11.8828C8.52586 12.0455 8.48645 12.2139 8.48645 12.3866V12.9201C8.48645 14.2786 10.9146 15.38 13.9098 15.38C16.905 15.38 19.3333 14.2786 19.3333 12.9201V12.3866C19.3333 12.2139 19.2938 12.0454 19.2192 11.8828C18.7066 12.9996 16.5244 13.8388 13.9098 13.8388Z"
                                                        fill="url(#paint6_linear_4078_49126)"
                                                    />
                                                    <path
                                                        d="M13.9098 16.5849C11.2953 16.5849 9.1131 15.7458 8.60052 14.629C8.52586 14.7917 8.48645 14.9601 8.48645 15.1328V15.6662C8.48645 17.0248 10.9146 18.126 13.9098 18.126C16.905 18.126 19.3333 17.0248 19.3333 15.6662V15.1326C19.3333 14.96 19.2938 14.7916 19.2192 14.6289C18.7066 15.7458 16.5244 16.5849 13.9098 16.5849Z"
                                                        fill="url(#paint7_linear_4078_49126)"
                                                    />
                                                </g>
                                            </g>
                                        </g>
                                        <defs>
                                            <linearGradient
                                                id="paint0_linear_4078_49126"
                                                x1="4.13418"
                                                y1="5.70605"
                                                x2="4.13418"
                                                y2="11.1591"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop stop-color="#75CB7D" />
                                                <stop
                                                    offset="1"
                                                    stop-color="#419049"
                                                />
                                            </linearGradient>
                                            <linearGradient
                                                id="paint1_linear_4078_49126"
                                                x1="4.13418"
                                                y1="10.4082"
                                                x2="4.13418"
                                                y2="13.9053"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop stop-color="#75CB7D" />
                                                <stop
                                                    offset="1"
                                                    stop-color="#419049"
                                                />
                                            </linearGradient>
                                            <linearGradient
                                                id="paint2_linear_4078_49126"
                                                x1="4.23527"
                                                y1="13.1543"
                                                x2="4.23527"
                                                y2="16.6514"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop stop-color="#75CB7D" />
                                                <stop
                                                    offset="1"
                                                    stop-color="#419049"
                                                />
                                            </linearGradient>
                                            <linearGradient
                                                id="paint3_linear_4078_49126"
                                                x1="13.9099"
                                                y1="1.54004"
                                                x2="13.9099"
                                                y2="6.99312"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop stop-color="#75CB7D" />
                                                <stop
                                                    offset="1"
                                                    stop-color="#419049"
                                                />
                                            </linearGradient>
                                            <linearGradient
                                                id="paint4_linear_4078_49126"
                                                x1="13.9099"
                                                y1="6.24219"
                                                x2="13.9099"
                                                y2="9.73925"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop stop-color="#75CB7D" />
                                                <stop
                                                    offset="1"
                                                    stop-color="#419049"
                                                />
                                            </linearGradient>
                                            <linearGradient
                                                id="paint5_linear_4078_49126"
                                                x1="13.9099"
                                                y1="8.98828"
                                                x2="13.9099"
                                                y2="12.4854"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop stop-color="#75CB7D" />
                                                <stop
                                                    offset="1"
                                                    stop-color="#419049"
                                                />
                                            </linearGradient>
                                            <linearGradient
                                                id="paint6_linear_4078_49126"
                                                x1="13.9099"
                                                y1="11.8828"
                                                x2="13.9099"
                                                y2="15.38"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop stop-color="#75CB7D" />
                                                <stop
                                                    offset="1"
                                                    stop-color="#419049"
                                                />
                                            </linearGradient>
                                            <linearGradient
                                                id="paint7_linear_4078_49126"
                                                x1="13.9099"
                                                y1="14.6289"
                                                x2="13.9099"
                                                y2="18.126"
                                                gradientUnits="userSpaceOnUse"
                                            >
                                                <stop stop-color="#75CB7D" />
                                                <stop
                                                    offset="1"
                                                    stop-color="#419049"
                                                />
                                            </linearGradient>
                                            <clipPath id="clip0_4078_49126">
                                                <rect
                                                    width="20"
                                                    height="20"
                                                    fill="white"
                                                    transform="translate(0 0.5)"
                                                />
                                            </clipPath>
                                            <clipPath id="clip1_4078_49126">
                                                <rect
                                                    width="20"
                                                    height="18.6667"
                                                    fill="white"
                                                    transform="translate(0 0.5)"
                                                />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="stat-value">
                                    {{ stats.referral_earned }} ₽
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="referral__bottom">
                <div class="referral__levels">
                    <div class="referral__levels-item">
                        <div class="referral__levels-image">
                            <img
                                class="referral__levels-img"
                                src="/assets/referral/lvls/lvl-1.png"
                            />
                        </div>
                        <div class="referral-level__content">
                            <div class="referral-level__name">
                                {{ $t("referral.silver") }}
                            </div>
                            <div class="referral-level__terms">
                                <div class="referral-level__terms-label">
                                    {{ $t("referral.dep") }}
                                </div>
                                <div class="referral-level__terms-value">
                                    0 ₽
                                </div>
                            </div>
                            <div class="referral-level__benefits">
                                <div class="referral-level__benefit">
                                    <div class="referral-level__benefit-label">
                                        {{ $t("referral.discount") }}
                                    </div>
                                    <div class="referral-level__benefit-value">
                                        40%
                                    </div>
                                </div>
                                <div class="referral-level__benefit">
                                    <div class="referral-level__benefit-label">
                                        {{ $t("referral.percent") }}
                                    </div>
                                    <div class="referral-level__benefit-value">
                                        3%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="referral__levels-item">
                        <div class="referral__levels-image">
                            <img
                                class="referral__levels-img"
                                src="/assets/referral/lvls/lvl-2.png"
                            />
                        </div>
                        <div class="referral-level__content">
                            <div class="referral-level__name">
                                {{ $t("referral.gold") }}
                            </div>
                            <div class="referral-level__terms">
                                <div class="referral-level__terms-label">
                                    {{ $t("referral.dep") }}
                                </div>
                                <div class="referral-level__terms-value">
                                    150 ₽
                                </div>
                            </div>
                            <div class="referral-level__benefits">
                                <div class="referral-level__benefit">
                                    <div class="referral-level__benefit-label">
                                        {{ $t("referral.discount") }}
                                    </div>
                                    <div class="referral-level__benefit-value">
                                        40%
                                    </div>
                                </div>
                                <div class="referral-level__benefit">
                                    <div class="referral-level__benefit-label">
                                        {{ $t("referral.percent") }}
                                    </div>
                                    <div class="referral-level__benefit-value">
                                        5%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="referral__levels-item">
                        <div class="referral__levels-image">
                            <img
                                class="referral__levels-img"
                                src="/assets/referral/lvls/lvl-3.png"
                            />
                        </div>
                        <div class="referral-level__content">
                            <div class="referral-level__name">
                                {{ $t("referral.platinum") }}
                            </div>
                            <div class="referral-level__terms">
                                <div class="referral-level__terms-label">
                                    {{ $t("referral.dep") }}
                                </div>
                                <div class="referral-level__terms-value">
                                    500 ₽
                                </div>
                            </div>
                            <div class="referral-level__benefits">
                                <div class="referral-level__benefit">
                                    <div class="referral-level__benefit-label">
                                        {{ $t("referral.discount") }}
                                    </div>
                                    <div class="referral-level__benefit-value">
                                        40%
                                    </div>
                                </div>
                                <div class="referral-level__benefit">
                                    <div class="referral-level__benefit-label">
                                        {{ $t("referral.percent") }}
                                    </div>
                                    <div class="referral-level__benefit-value">
                                        7%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="MainContainer__header">
                <div
                    class="text color--disabled variant--h1 align--center bold uppercase"
                >
                    {{ $t("faq.title") }}
                </div>
            </div>
            <ul class="faq__items">
                <li class="faq__item">
                    <div class="accordion">
                        <div
                            class="accordion__toggle"
                            v-on:click="open(1)"
                            :aria-expanded="this.faq_1 ? 'true' : 'false'"
                        >
                            <div class="accordion__title">
                                {{ $t("faq.item") }}
                            </div>
                            <div
                                class="accordion__arrow"
                                :aria-expanded="this.faq_1 ? 'true' : 'false'"
                            ></div>
                        </div>
                        <div
                            class="accordion__body"
                            :aria-expanded="this.faq_1 ? 'true' : 'false'"
                        >
                            <div class="text color--inherit variant--h5">
                                {{ $t("faq.desc") }}
                            </div>
                        </div>
                    </div>
                </li>
                <li class="faq__item">
                    <div class="accordion">
                        <div
                            class="accordion__toggle"
                            v-on:click="open(2)"
                            :aria-expanded="this.faq_2 ? 'true' : 'false'"
                        >
                            <div class="accordion__title">
                                {{ $t("faq.item1") }}
                            </div>
                            <div
                                class="accordion__arrow"
                                :aria-expanded="this.faq_2 ? 'true' : 'false'"
                            ></div>
                        </div>
                        <div
                            class="accordion__body"
                            :aria-expanded="this.faq_2 ? 'true' : 'false'"
                        >
                            <div class="text color--inherit variant--h5">
                                {{ $t("faq.desc1") }}
                            </div>
                        </div>
                    </div>
                </li>
                <li class="faq__item">
                    <div class="accordion">
                        <div
                            class="accordion__toggle"
                            v-on:click="open(3)"
                            :aria-expanded="this.faq_3 ? 'true' : 'false'"
                        >
                            <div class="accordion__title">
                                {{ $t("faq.item2") }}
                            </div>
                            <div
                                class="accordion__arrow"
                                :aria-expanded="this.faq_3 ? 'true' : 'false'"
                            ></div>
                        </div>
                        <div
                            class="accordion__body"
                            :aria-expanded="this.faq_3 ? 'true' : 'false'"
                        >
                            <div class="text color--inherit variant--h5">
                                {{ $t("faq.desc2") }}
                            </div>
                        </div>
                    </div>
                </li>
                <li class="faq__item">
                    <div class="accordion">
                        <div
                            class="accordion__toggle"
                            v-on:click="open(4)"
                            :aria-expanded="this.faq_4 ? 'true' : 'false'"
                        >
                            <div class="accordion__title">
                                {{ $t("faq.item3") }}
                            </div>
                            <div
                                class="accordion__arrow"
                                :aria-expanded="this.faq_4 ? 'true' : 'false'"
                            ></div>
                        </div>
                        <div
                            class="accordion__body"
                            :aria-expanded="this.faq_4 ? 'true' : 'false'"
                        >
                            <div class="text color--inherit variant--h5">
                                {{ $t("faq.desc3") }}
                            </div>
                        </div>
                    </div>
                </li>
                <li class="faq__item">
                    <div class="accordion">
                        <div
                            class="accordion__toggle"
                            v-on:click="open(5)"
                            :aria-expanded="this.faq_5 ? 'true' : 'false'"
                        >
                            <div class="accordion__title">
                                {{ $t("faq.item4") }}
                            </div>
                            <div
                                class="accordion__arrow"
                                :aria-expanded="this.faq_5 ? 'true' : 'false'"
                            ></div>
                        </div>
                        <div
                            class="accordion__body"
                            :aria-expanded="this.faq_5 ? 'true' : 'false'"
                        >
                            <div class="text color--inherit variant--h5">
                                {{ $t("faq.desc4") }}
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Faq from "../Pages/Faq.vue";

export default {
    components: { Faq },
    data() {
        return {
            promoCode: "",
            stats: {
                percent: 0,
                earnings_percent: 0,
                count: 0,
                level: 0,
                promocode: "",
                total_deposit: 0,
                count_deposit: 0,
                referral_earned: 0,
            },
            faq_1: false,
            faq_2: false,
            faq_3: false,
            faq_4: false,
            faq_5: false,
        };
    },
    mounted() {
        this.getReferralStats();
    },
    methods: {
        async submitPromoCode() {
            try {
                const response = await axios.post("referral/createCode", {
                    promocodeID: this.promoCode,
                });

                const message = response.data.message || "Неизвестная ошибка"; // Замените на ваше значение по умолчанию

                if (response.data.success) {
                    return this.$toast.success(message);
                } else {
                    return this.$toast.error(message);
                }
            } catch (error) {
                this.$toast.error("Произошла ошибка при выполнении запроса.");
            }
        },
        copyPromocode() {
            if (this.stats.promocode !== null) {
                const promocode = this.stats.promocode;

                const tempInput = document.createElement("input");
                tempInput.value = promocode;
                document.body.appendChild(tempInput);
                tempInput.select();
                document.execCommand("copy");
                document.body.removeChild(tempInput);

                return this.$toast.success("Промокод скопирован");
            }
        },

        async getReferralStats() {
            try {
                const response = await this.axios.get("/referral/get");
                this.stats = response.data;
            } catch (error) {
                console.error("Ошибка при получении статистики:", error);
            }
        },
        open(id) {
            const vm = this;
            switch (id) {
                case 1:
                    if (vm.faq_1) {
                        vm.faq_1 = false;
                    } else {
                        vm.faq_1 = true;
                    }
                    break;
                case 2:
                    if (vm.faq_2) {
                        vm.faq_2 = false;
                    } else {
                        vm.faq_2 = true;
                    }
                    break;
                case 3:
                    if (vm.faq_3) {
                        vm.faq_3 = false;
                    } else {
                        vm.faq_3 = true;
                    }
                    break;
                case 4:
                    if (vm.faq_4) {
                        vm.faq_4 = false;
                    } else {
                        vm.faq_4 = true;
                    }
                    break;
                case 5:
                    if (vm.faq_5) {
                        vm.faq_5 = false;
                    } else {
                        vm.faq_5 = true;
                    }
                    break;
            }
        },
    },
};
</script>
