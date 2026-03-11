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
            <span class="uppercase">{{ $root.user.username }}</span>
        </div>
        <div class="page__container">
            <div class="profile__header">
                <div class="profile__form">
                    <div class="card color--primary">
                        <div class="card__body size--medium">
                            <div class="profile__card">
                                <div class="card__top_side">
                                    <div class="profile_card__info">
                                        <div class="profile_card__info__avatar">
                                            <div class="avatar size--small">
                                                <img
                                                    :src="$root.user.avatar"
                                                    :alt="$root.user.username"
                                                    class="avatarImage"
                                                />
                                            </div>
                                        </div>
                                        <div class="profile__info__flex">
                                            <div class="profile__info__details">
                                                <div
                                                    class="profile_info__username"
                                                >
                                                    <span>{{
                                                        $root.user.username
                                                    }}</span>
                                                    <a
                                                        class="redirect_steamProfile"
                                                        target="_blank"
                                                        :href="`https://steamcommunity.com/profiles/${$root.user.steamid}`"
                                                    >
                                                        <svg
                                                            width="16"
                                                            height="16"
                                                            viewBox="0 0 16 16"
                                                            fill="none"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                        >
                                                            <path
                                                                fill-rule="evenodd"
                                                                clip-rule="evenodd"
                                                                d="M12.667 6C12.6677 6.26869 12.6152 6.53486 12.5127 6.78322C12.4101 7.03157 12.2595 7.2572 12.0694 7.44715C11.8794 7.6371 11.6537 7.78761 11.4053 7.89004C11.1569 7.99247 10.8907 8.04479 10.622 8.044C10.3534 8.04466 10.0873 7.99224 9.83902 7.88975C9.59073 7.78727 9.36514 7.63673 9.1752 7.4468C8.98527 7.25686 8.83473 7.03127 8.73225 6.78298C8.62976 6.5347 8.57734 6.26861 8.578 6C8.578 4.889 9.467 3.956 10.622 3.956C11.733 3.956 12.667 4.889 12.667 6ZM9.11 6C9.11 6.844 9.777 7.511 10.621 7.511C11.466 7.511 12.132 6.844 12.132 6C12.132 5.156 11.466 4.489 10.622 4.489C9.777 4.489 9.11 5.156 9.11 6ZM5.956 9.911L4.933 9.467C5.333 9.333 5.778 9.333 6.178 9.467C6.622 9.644 6.933 9.956 7.111 10.4C7.289 10.844 7.289 11.289 7.111 11.733C7.0269 11.9406 6.90261 12.1295 6.74526 12.2889C6.58791 12.4483 6.40062 12.5751 6.19414 12.6619C5.98766 12.7487 5.76606 12.7938 5.54208 12.7947C5.3181 12.7956 5.09616 12.7522 4.889 12.667C4.50429 12.496 4.19031 12.1975 4 11.822L4.978 12.222C5.6 12.489 6.356 12.178 6.622 11.556C6.889 10.933 6.578 10.178 5.956 9.911ZM8 16C4.4 16 1.333 13.6 0.311 10.356L3.333 11.6C3.40673 11.9505 3.56761 12.2769 3.80076 12.5488C4.03391 12.8208 4.33183 13.0296 4.667 13.156C4.93478 13.2726 5.22333 13.334 5.5154 13.3365C5.80747 13.339 6.09703 13.2826 6.36677 13.1706C6.6365 13.0585 6.88085 12.8932 7.08519 12.6845C7.28954 12.4758 7.44967 12.228 7.556 11.956C7.689 11.644 7.733 11.333 7.733 11.022L10.533 9.022H10.623C12.311 9.022 13.644 7.644 13.644 5.956C13.6435 5.15459 13.3249 4.38613 12.7584 3.81935C12.1918 3.25258 11.4234 2.93379 10.622 2.933C9.82059 2.93379 9.05224 3.25258 8.48565 3.81935C7.91906 4.38613 7.60053 5.15459 7.6 5.956V6L5.6 8.889C5.28005 8.88335 4.9624 8.94396 4.667 9.067C4.533 9.111 4.4 9.2 4.311 9.244L0 7.467C0.267 3.289 3.733 0 8 0C12.444 0 16 3.6 16 8C16 12.4 12.4 16 8 16Z"
                                                                fill="currentColor"
                                                            />
                                                        </svg>
                                                    </a>
                                                </div>
                                                <div
                                                    class="profile_info__balance"
                                                >
                                                    <span
                                                        >{{
                                                            $root.user.balance
                                                        }}
                                                        ₽</span
                                                    >
                                                </div>
                                            </div>
                                            <!-- <button
                                                @click="logOut"
                                                class="profile_info__logout"
                                            >
                                                <svg
                                                    width="16"
                                                    height="16"
                                                    viewBox="0 0 16 16"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <path
                                                        d="M16 10.0002C16 10.4115 15.84 10.7982 15.548 11.0895L14.1667 12.4715C14.0367 12.6015 13.866 12.6668 13.6953 12.6668C13.5247 12.6668 13.354 12.6015 13.224 12.4715C12.9633 12.2108 12.9633 11.7895 13.224 11.5288L14.0854 10.6668H10C9.63134 10.6668 9.33334 10.3688 9.33334 10.0002C9.33334 9.6315 9.63134 9.3335 10 9.3335H14.0854L13.224 8.4715C12.9633 8.21083 12.9633 7.7895 13.224 7.52883C13.4847 7.26816 13.906 7.26816 14.1667 7.52883L15.5487 8.9115C15.84 9.20216 16 9.58883 16 10.0002ZM9.33334 7.3335V4.00016C9.33334 3.26482 8.73534 2.66682 8.00001 2.66682V14.6662H8.66668C9.03468 14.6662 9.33334 14.3675 9.33334 13.9995V12.6662C9.33334 12.2975 9.63134 11.9995 10 11.9995C10.3687 11.9995 10.6667 12.2975 10.6667 12.6662V13.9995C10.6667 15.1022 9.76935 15.9995 8.66668 15.9995H2C0.897334 15.9995 0 15.1022 0 13.9995V3.74749C0 2.16416 1.12667 0.789488 2.67934 0.478821L4.81067 0.0528205C5.59801 -0.104513 6.40467 0.0968205 7.02467 0.605488C7.27468 0.810155 7.46801 1.06216 7.62601 1.33349H8.00001C9.47068 1.33349 10.6667 2.52949 10.6667 4.00016V7.3335C10.6667 7.70216 10.3687 8.00016 10 8.00016C9.63134 8.00016 9.33334 7.70216 9.33334 7.3335ZM6.00001 8.3335C6.00001 7.7815 5.55201 7.3335 5.00001 7.3335C4.44801 7.3335 4 7.7815 4 8.3335C4 8.8855 4.44801 9.3335 5.00001 9.3335C5.55201 9.3335 6.00001 8.8855 6.00001 8.3335Z"
                                                        fill="#FC5763"
                                                    />
                                                </svg>
                                                Выйти
                                            </button> -->
                                        </div>
                                    </div>
                                    <div class="profile_card__buttons">
                                        <div class="deposit__button">
                                            <router-link
                                                :to="{
                                                    name: 'deposit',
                                                }"
                                                type="button"
                                                class="controls color--green size--wide fit-content button radius-14"
                                            >
                                                <div
                                                    class="button__content uppercase deposit"
                                                >
                                                    <svg
                                                        width="19"
                                                        height="16"
                                                        viewBox="0 0 19 16"
                                                        fill="none"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                    >
                                                        <g
                                                            clip-path="url(#clip0_140_35456)"
                                                        >
                                                            <path
                                                                d="M17.9008 6.0864H15.9594C15.4367 6.0864 14.9609 6.29193 14.6155 6.64649C14.2236 7.0293 13.9993 7.57982 14.0554 8.16771C14.1393 9.17578 15.0635 9.91315 16.0715 9.91315H17.9008C18.4236 9.89447 18.8342 9.47429 18.8342 8.96114V7.03841C18.8342 6.52526 18.4236 6.10508 17.9008 6.0864Z"
                                                                fill="currentColor"
                                                            />
                                                            <path
                                                                d="M17.4029 11.3132H16.0681C14.2949 11.3132 12.8014 9.97832 12.652 8.27982C12.5681 7.30912 12.9227 6.33841 13.6318 5.64798C14.2292 5.03184 15.0596 4.68685 15.956 4.68685H17.4025C17.6732 4.68685 17.8969 4.46263 17.8691 4.19238C17.6636 1.92422 16.1611 0.375196 13.9303 0.113608C13.7061 0.076238 13.4727 0.0671234 13.2303 0.0671234H4.83073C4.5696 0.0671234 4.31758 0.0858083 4.07467 0.123178C1.69486 0.421225 0.164062 2.19447 0.164062 4.73333V11.2667C0.164062 13.8424 2.25495 15.9333 4.83073 15.9333H13.2307C15.8439 15.9333 17.6454 14.3 17.8696 11.8081C17.8974 11.5374 17.6736 11.3136 17.4029 11.3136V11.3132ZM10.4307 5.9H4.83073C4.44792 5.9 4.13073 5.58281 4.13073 5.2C4.13073 4.81719 4.44792 4.5 4.83073 4.5H10.4307C10.8135 4.5 11.1307 4.81719 11.1307 5.2C11.1307 5.58281 10.8135 5.9 10.4307 5.9Z"
                                                                fill="currentColor"
                                                            />
                                                        </g>
                                                        <defs>
                                                            <clipPath
                                                                id="clip0_140_35456"
                                                            >
                                                                <rect
                                                                    width="18.6667"
                                                                    height="16"
                                                                    fill="white"
                                                                    transform="translate(0.164062)"
                                                                />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>

                                                    {{
                                                        $t(
                                                            "profile.profileTop.deposit"
                                                        )
                                                    }}
                                                </div>
                                            </router-link>
                                        </div>

                                        <div class="deposit__button">
                                            <button
                                                @click="openTradeLink"
                                                type="button"
                                                class="controls color--blue-gradient size--wide fit-content button radius-14"
                                            >
                                                <div
                                                    class="button__content uppercase deposit"
                                                >
                                                    <svg
                                                        width="19"
                                                        height="18"
                                                        viewBox="0 0 19 18"
                                                        fill="none"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                    >
                                                        <g
                                                            clip-path="url(#clip0_142_38471)"
                                                        >
                                                            <path
                                                                d="M0.5 5.25001C0.5 5.05109 0.579018 4.86033 0.71967 4.71968C0.860322 4.57902 1.05109 4.50001 1.25 4.50001H14V1.97926C14.0015 1.8626 14.0373 1.74896 14.1029 1.65251C14.1686 1.55607 14.2612 1.48109 14.3691 1.43693C14.4771 1.39278 14.5957 1.3814 14.7101 1.40422C14.8246 1.42704 14.9297 1.48305 15.0125 1.56526L18.326 4.83601C18.3806 4.88993 18.424 4.95416 18.4535 5.02497C18.4831 5.09578 18.4984 5.17176 18.4984 5.24851C18.4984 5.32525 18.4831 5.40123 18.4535 5.47204C18.424 5.54285 18.3806 5.60708 18.326 5.66101L15.0125 8.93476C14.9297 9.01696 14.8246 9.07297 14.7101 9.09579C14.5957 9.11861 14.4771 9.10723 14.3691 9.06308C14.2612 9.01892 14.1686 8.94395 14.1029 8.8475C14.0373 8.75106 14.0015 8.63741 14 8.52076V6.00001H1.25C1.05109 6.00001 0.860322 5.92099 0.71967 5.78034C0.579018 5.63968 0.5 5.44892 0.5 5.25001ZM17.75 12H5V9.47926C4.99853 9.3626 4.96274 9.24896 4.89709 9.15251C4.83144 9.05607 4.73885 8.98109 4.63086 8.93693C4.52287 8.89278 4.40427 8.8814 4.28986 8.90422C4.17544 8.92704 4.07028 8.98305 3.9875 9.06526L0.674 12.336C0.619396 12.3899 0.576041 12.4542 0.546451 12.525C0.516861 12.5958 0.501624 12.6718 0.501624 12.7485C0.501624 12.8252 0.516861 12.9012 0.546451 12.972C0.576041 13.0428 0.619396 13.1071 0.674 13.161L3.9875 16.4348C4.07028 16.517 4.17544 16.573 4.28986 16.5958C4.40427 16.6186 4.52287 16.6072 4.63086 16.5631C4.73885 16.5189 4.83144 16.4439 4.89709 16.3475C4.96274 16.2511 4.99853 16.1374 5 16.0208V13.5H17.75C17.9489 13.5 18.1397 13.421 18.2803 13.2803C18.421 13.1397 18.5 12.9489 18.5 12.75C18.5 12.5511 18.421 12.3603 18.2803 12.2197C18.1397 12.079 17.9489 12 17.75 12Z"
                                                                fill="white"
                                                            />
                                                        </g>
                                                        <defs>
                                                            <clipPath
                                                                id="clip0_142_38471"
                                                            >
                                                                <rect
                                                                    width="18"
                                                                    height="18"
                                                                    fill="white"
                                                                    transform="translate(0.5)"
                                                                />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>

                                                    {{
                                                        $t(
                                                            "profile.profileTop.tradeUrl"
                                                        )
                                                    }}
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress-container">
                                    <div class="level-badge">
                                        {{ $root.user.lvl }} LVL
                                    </div>
                                    <div class="progress-details">
                                        <div class="progress-info">
                                            <div class="xp-text">
                                                XP {{ $root.user.exp }} /
                                                {{ nextLevelThreshold }}
                                            </div>
                                            <a
                                                href="/free_case"
                                                class="help-link"
                                            >
                                                {{
                                                    $t(
                                                        "profile.profileTop.howWork"
                                                    )
                                                }}</a
                                            >
                                        </div>
                                        <div class="progress-bar">
                                            <div
                                                class="progress"
                                                :style="{
                                                    width: levelProgress + '%',
                                                }"
                                            ></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile__favorites">
                    <div class="profile__favorite">
                        <div class="profile_favorite__additional">
                            <div class="card color--primary">
                                <div class="card__body size--medium">
                                    <div class="favorite">
                                        <div class="favorite__info">
                                            <div class="favorite__content">
                                                <div class="favorite__title">
                                                    {{
                                                        $t(
                                                            "profile.profileTop.promocode"
                                                        )
                                                    }}
                                                </div>
                                                <div class="favorite__name">
                                                    {{
                                                        $t(
                                                            "profile.profileTop.promocodeText"
                                                        )
                                                    }}
                                                </div>
                                            </div>
                                            <div class="favorite__btn_wrapper">
                                                <button
                                                    @click="openPromocodeUser"
                                                    class="controls radius-14 color--blue-gradient size--wide fit-content button"
                                                >
                                                    <div
                                                        class="button__content"
                                                    >
                                                        <div
                                                            class="favorite__btn-text"
                                                        >
                                                            {{
                                                                $t(
                                                                    "profile.profileTop.enterPromocode"
                                                                )
                                                            }}
                                                        </div>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="profile_favorite__additional">
                            <div class="card color--primary">
                                <div class="card__body size--medium">
                                    <div class="favorite">
                                        <div class="favorite__info">
                                            <div class="favorite__content">
                                                <div class="favorite__title">
                                                    {{
                                                        $t(
                                                            "profile.profileTop.bestDrop.title"
                                                        )
                                                    }}
                                                </div>
                                                <div
                                                    v-if="best.drop === null"
                                                    class="favorite__name-item"
                                                >
                                                    {{
                                                        $t(
                                                            "profile.profileTop.bestDrop.subtitle"
                                                        )
                                                    }}
                                                </div>
                                                <div
                                                    v-if="best.case !== null"
                                                    class="favorite__name-item"
                                                >
                                                    {{ best.case.case.name }}
                                                </div>
                                                <div
                                                    class="favorite__btn_wrapper"
                                                >
                                                    <div
                                                        v-if="
                                                            best.drop === null
                                                        "
                                                        class="controls radius-14 color--blue-gradient size--wide full-width button"
                                                    >
                                                        <div
                                                            class="button__content"
                                                        >
                                                            <div
                                                                class="favorite__btn-text"
                                                            >
                                                                0.00 ₽
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        v-else
                                                        class="controls radius-14 color--blue-gradient size--wide full-width button"
                                                    >
                                                        <div
                                                            class="button__content"
                                                        >
                                                            <div
                                                                class="favorite__btn-text"
                                                            >
                                                                {{
                                                                    best.drop
                                                                        .price
                                                                }}
                                                                ₽
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="favorite-item"
                                            v-if="best.drop !== null"
                                        >
                                            <div
                                                class="drops__card"
                                                :class="
                                                    getItemRarityClass(
                                                        best.drop.item.rarity
                                                    )
                                                "
                                            >
                                                <div
                                                    class="drops__card__visible"
                                                >
                                                    <div
                                                        class="drops__card__rarity"
                                                    >
                                                        <div
                                                            class="skinIcon__background"
                                                            :class="
                                                                getItemRarityClass(
                                                                    best.drop
                                                                        .item
                                                                        .rarity
                                                                )
                                                            "
                                                        ></div>
                                                    </div>
                                                    <div
                                                        class="drops__image_wrapper"
                                                    >
                                                        <img
                                                            :srcset="
                                                                'https://steamcommunity-a.akamaihd.net/economy/image/' +
                                                                best.drop.item
                                                                    .icon_url +
                                                                ', https://steamcommunity-a.akamaihd.net/economy/image/' +
                                                                best.drop.item
                                                                    .icon_url +
                                                                '2x'
                                                            "
                                                            :alt="
                                                                best.drop.item
                                                                    .market_hash_name
                                                            "
                                                            loading="lazy"
                                                            decoding="async"
                                                        />
                                                    </div>
                                                    <div
                                                        class="drops__names__wrapper"
                                                    >
                                                        <div
                                                            class="drops__names"
                                                        >
                                                            <div
                                                                class="drops__names_weapon"
                                                            >
                                                                <div
                                                                    class="name-h1 uppercase"
                                                                >
                                                                    <span
                                                                        v-html="
                                                                            getItemType(
                                                                                best
                                                                                    .drop
                                                                                    .item
                                                                                    .market_hash_name
                                                                            )
                                                                        "
                                                                    ></span>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="drops__names_skin"
                                                            >
                                                                <div
                                                                    class="name-h2"
                                                                >
                                                                    <span
                                                                        v-html="
                                                                            getItemName(
                                                                                best
                                                                                    .drop
                                                                                    .item
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="user__tabs__wrapper">
                <div class="card color--primary">
                    <div class="card__body size--medium">
                        <div class="user_tabs">
                            <ul class="user_tabs__list">
                                <li>
                                    <button
                                        @click="setTab('items')"
                                        :class="[
                                            'controls',
                                            'size--wide',
                                            'full-width',
                                            'button',
                                            'radius-14',
                                            tab === 'items'
                                                ? 'color--blue-gradient'
                                                : 'color--grey-gradient',
                                        ]"
                                        type="button"
                                    >
                                        <div class="button__content uppercase">
                                            <svg
                                                width="22"
                                                height="22"
                                                viewBox="0 0 22 22"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <g
                                                    clip-path="url(#clip0_140_35572)"
                                                >
                                                    <path
                                                        d="M21.3528 5.76837C21.304 5.76837 21.2567 5.77422 21.2109 5.7844V8.4091C21.2567 8.41933 21.304 8.42513 21.3528 8.42513C21.7107 8.42513 22.001 8.13492 22.001 7.77695V6.41651C22.001 6.05858 21.7107 5.76837 21.3528 5.76837Z"
                                                        fill="currentColor"
                                                    />
                                                    <path
                                                        d="M19.7013 5.37094H19.471C19.471 5.36587 19.4717 5.36092 19.4717 5.35585V5.11553C19.4717 4.83516 19.2934 4.59707 19.0442 4.50671C18.9752 4.4817 18.9012 4.46735 18.8235 4.46735C18.7459 4.46735 18.6719 4.4817 18.6029 4.50671C18.3537 4.59707 18.1754 4.83516 18.1754 5.11553V5.35585C18.1754 5.36097 18.176 5.36587 18.1761 5.37094H2.71418C2.44893 5.37094 2.2108 5.53344 2.11403 5.78039L1.94886 6.20208L1.19188 5.765L0.988253 5.64744C0.68601 5.47294 0.291815 5.55506 0.103268 5.84875C-0.0980403 6.16233 0.00517061 6.57672 0.324214 6.76093L0.713725 6.98583L1.47071 7.42291L1.3412 7.75351H16.1734V7.30547C16.1734 7.06683 16.3669 6.87334 16.6055 6.87334H20.3458V6.01547C20.3458 5.65951 20.0572 5.37094 19.7013 5.37094Z"
                                                        fill="currentColor"
                                                    />
                                                    <path
                                                        d="M17.04 7.73761V8.18565C17.04 8.42429 16.8465 8.61778 16.6078 8.61778H1.14232V9.14037C0.987591 9.21891 0.864314 9.35882 0.81172 9.54165C0.770943 9.68323 0.783189 9.83552 0.839134 9.97181C0.954376 10.2525 1.03516 10.5445 1.08277 10.8412C1.1776 11.4319 1.13863 12.0413 0.961853 12.619L0.165814 15.2198C-0.00197931 15.7679 0.0972785 16.3466 0.438193 16.8075C0.779064 17.2683 1.30341 17.5326 1.87661 17.5326H4.95266C5.27261 17.5326 5.54473 17.2991 5.59333 16.9829L6.09009 13.7508H7.51179C9.0759 13.7508 10.3439 12.4829 10.3439 10.9187V10.8412V9.97701H19.7036C20.0595 9.97701 20.3481 9.68843 20.3481 9.33248V7.73761H17.04ZM9.04754 10.9188C9.04754 11.7655 8.35862 12.4545 7.51179 12.4545H6.28933L6.33746 12.1414C6.72628 12.3046 7.17655 12.0455 7.23099 11.6282L7.33365 10.8413L7.44635 9.97706H9.04754V10.9188Z"
                                                        fill="currentColor"
                                                    />
                                                </g>
                                                <defs>
                                                    <clipPath
                                                        id="clip0_140_35572"
                                                    >
                                                        <rect
                                                            width="22"
                                                            height="22"
                                                            fill="white"
                                                        />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                            <span>
                                                {{
                                                    $t(
                                                        "profile.profileBottom.skins"
                                                    )
                                                }}</span
                                            >
                                        </div>
                                    </button>
                                </li>
                                <li>
                                    <button
                                        @click="setTab('upgrades')"
                                        :class="[
                                            'controls',
                                            'size--wide',
                                            'full-width',
                                            'button',
                                            'radius-14',
                                            tab === 'upgrades'
                                                ? 'color--blue-gradient'
                                                : 'color--grey-gradient',
                                        ]"
                                        type="button"
                                    >
                                        <div class="button__content uppercase">
                                            <svg
                                                width="20"
                                                height="20"
                                                viewBox="0 0 20 20"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <g
                                                    clip-path="url(#clip0_4743_35877)"
                                                >
                                                    <path
                                                        d="M2.35671 15.4283C1.39005 15.8642 0.440046 14.7892 0.990046 13.88L9.06921 0.521682C9.16523 0.362433 9.30078 0.230699 9.4627 0.139254C9.62462 0.0478084 9.80742 -0.000244141 9.99338 -0.000244141C10.1793 -0.000244141 10.3621 0.0478084 10.5241 0.139254C10.686 0.230699 10.8215 0.362433 10.9175 0.521682L18.9984 13.88C19.5484 14.7883 18.5984 15.8642 17.6309 15.4283L13.9017 13.7467C13.7955 13.6987 13.7009 13.6284 13.6244 13.5404C13.5479 13.4525 13.4914 13.3491 13.4586 13.2372C13.4258 13.1254 13.4176 13.0078 13.4346 12.8925C13.4515 12.7772 13.4932 12.6669 13.5567 12.5692C13.6226 12.4682 13.6651 12.3537 13.6811 12.2342C13.697 12.1146 13.686 11.993 13.6489 11.8783C13.6117 11.7635 13.5494 11.6585 13.4664 11.571C13.3834 11.4835 13.2818 11.4157 13.1692 11.3725L11.9175 10.895C11.7387 10.8263 11.5814 10.7113 11.4617 10.5617L10.835 9.78335C10.7339 9.65734 10.6058 9.55564 10.4601 9.48576C10.3145 9.41588 10.1549 9.37961 9.99338 9.37961C9.83181 9.37961 9.67231 9.41588 9.52663 9.48576C9.38096 9.55564 9.25283 9.65734 9.15171 9.78335L8.52505 10.5625C8.40505 10.7125 8.24755 10.8267 8.06921 10.895L6.81755 11.3725C6.70486 11.4156 6.60324 11.4834 6.52015 11.5708C6.43706 11.6583 6.37461 11.7633 6.33737 11.878C6.30013 11.9928 6.28905 12.1144 6.30494 12.234C6.32084 12.3536 6.3633 12.4681 6.42921 12.5692C6.49279 12.6668 6.5345 12.7771 6.5515 12.8923C6.56849 13.0076 6.56037 13.1252 6.52768 13.237C6.49499 13.3488 6.43851 13.4523 6.36211 13.5403C6.28571 13.6282 6.1912 13.6986 6.08505 13.7467L2.35671 15.4283Z"
                                                        fill="currentColor"
                                                    />
                                                    <path
                                                        d="M4.23091 20C3.06591 20 2.72508 18.4083 3.78758 17.93L9.55842 15.3283C9.69776 15.2655 9.84888 15.233 10.0017 15.233C10.1546 15.233 10.3057 15.2655 10.4451 15.3283L16.2159 17.93C17.2784 18.4092 16.9376 20 15.7726 20H13.0459C12.7601 20 12.4851 19.8858 12.2826 19.6833L10.7659 18.1633C10.6657 18.0628 10.5466 17.983 10.4154 17.9286C10.2843 17.8742 10.1437 17.8462 10.0017 17.8462C9.85977 17.8462 9.71919 17.8742 9.58806 17.9286C9.45693 17.983 9.33783 18.0628 9.23758 18.1633L7.72091 19.6825C7.62072 19.7831 7.50164 19.863 7.3705 19.9175C7.23936 19.9719 7.09875 20 6.95675 20H4.23091Z"
                                                        fill="currentColor"
                                                    />
                                                </g>
                                                <defs>
                                                    <clipPath
                                                        id="clip0_4743_35877"
                                                    >
                                                        <rect
                                                            width="20"
                                                            height="20"
                                                            fill="white"
                                                        />
                                                    </clipPath>
                                                </defs>
                                            </svg>

                                            <span>
                                                {{
                                                    $t(
                                                        "profile.profileBottom.upgrade"
                                                    )
                                                }}</span
                                            >
                                        </div>
                                    </button>
                                </li>
                                <li>
                                    <button
                                        @click="setTab('contracts')"
                                        :class="[
                                            'controls',
                                            'size--wide',
                                            'full-width',
                                            'button',
                                            'radius-14',
                                            tab === 'contracts'
                                                ? 'color--blue-gradient'
                                                : 'color--grey-gradient',
                                        ]"
                                        type="button"
                                    >
                                        <div class="button__content uppercase">
                                            <svg
                                                width="20"
                                                height="20"
                                                viewBox="0 0 20 20"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <path
                                                    d="M18.3307 2.70831H1.66406C1.3224 2.70831 1.03906 2.42498 1.03906 2.08331C1.03906 1.74165 1.3224 1.45831 1.66406 1.45831H18.3307C18.6724 1.45831 18.9557 1.74165 18.9557 2.08331C18.9557 2.42498 18.6724 2.70831 18.3307 2.70831Z"
                                                    fill="currentColor"
                                                />
                                                <path
                                                    d="M3.05469 2.08331V12.0583C3.05469 12.875 3.43802 13.65 4.09635 14.1416L8.43802 17.3916C9.36302 18.0833 10.638 18.0833 11.563 17.3916L15.9047 14.1416C16.563 13.65 16.9464 12.875 16.9464 12.0583V2.08331H3.05469ZM13.3297 11.4583H6.66302C6.32135 11.4583 6.03802 11.175 6.03802 10.8333C6.03802 10.4916 6.32135 10.2083 6.66302 10.2083H13.3297C13.6714 10.2083 13.9547 10.4916 13.9547 10.8333C13.9547 11.175 13.6714 11.4583 13.3297 11.4583ZM13.3297 7.29165H6.66302C6.32135 7.29165 6.03802 7.00831 6.03802 6.66665C6.03802 6.32498 6.32135 6.04165 6.66302 6.04165H13.3297C13.6714 6.04165 13.9547 6.32498 13.9547 6.66665C13.9547 7.00831 13.6714 7.29165 13.3297 7.29165Z"
                                                    fill="currentColor"
                                                />
                                            </svg>

                                            <span>
                                                {{
                                                    $t(
                                                        "profile.profileBottom.contracts"
                                                    )
                                                }}</span
                                            >
                                        </div>
                                    </button>
                                </li>
                            </ul>
                            <div class="user_tabs__additional">
                                <div class="user_tabs__available">
                                    <button
                                        class="user_tabs__button-available"
                                        type="button"
                                    >
                                        <div class="content__label uppercase">
                                            {{
                                                $t(
                                                    "profile.profileBottom.stock"
                                                )
                                            }}
                                        </div>
                                        <div
                                            @click="forSale = !forSale"
                                            class="toggle size--small"
                                            :class="{ active: forSale }"
                                        >
                                            <div class="toggleSlide"></div>
                                        </div>
                                    </button>
                                </div>
                                <button
                                    @click="sellAction"
                                    class="controls color--green-gradient size--wide fit-content button radius-14"
                                    type="button"
                                >
                                    <div class="button__content uppercase">
                                        <svg
                                            width="20"
                                            height="20"
                                            viewBox="0 0 20 20"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <g
                                                clip-path="url(#clip0_140_35620)"
                                            >
                                                <path
                                                    d="M18.9275 3.3975C18.6931 3.1162 18.3996 2.88996 18.0679 2.73485C17.7363 2.57973 17.3745 2.49955 17.0083 2.5H3.535L3.5 2.2075C3.42837 1.59951 3.13615 1.03894 2.67874 0.632065C2.22133 0.225186 1.63052 0.000284828 1.01833 0L0.833333 0C0.61232 0 0.400358 0.0877974 0.244078 0.244078C0.0877974 0.400358 0 0.61232 0 0.833333C0 1.05435 0.0877974 1.26631 0.244078 1.42259C0.400358 1.57887 0.61232 1.66667 0.833333 1.66667H1.01833C1.22244 1.66669 1.41945 1.74163 1.57198 1.87726C1.72451 2.0129 1.82195 2.19979 1.84583 2.4025L2.9925 12.1525C3.11154 13.1665 3.59873 14.1015 4.36159 14.78C5.12445 15.4585 6.10988 15.8334 7.13083 15.8333H15.8333C16.0543 15.8333 16.2663 15.7455 16.4226 15.5893C16.5789 15.433 16.6667 15.221 16.6667 15C16.6667 14.779 16.5789 14.567 16.4226 14.4107C16.2663 14.2545 16.0543 14.1667 15.8333 14.1667H7.13083C6.61505 14.1652 6.11233 14.0043 5.69161 13.7059C5.27089 13.4075 4.95276 12.9863 4.78083 12.5H14.7142C15.6911 12.5001 16.6369 12.1569 17.3865 11.5304C18.1361 10.9039 18.6417 10.0339 18.815 9.0725L19.4692 5.44417C19.5345 5.08417 19.5198 4.71422 19.4262 4.36053C19.3326 4.00684 19.1623 3.67806 18.9275 3.3975Z"
                                                    fill="white"
                                                />
                                                <path
                                                    d="M5.83073 20C6.7512 20 7.4974 19.2538 7.4974 18.3334C7.4974 17.4129 6.7512 16.6667 5.83073 16.6667C4.91025 16.6667 4.16406 17.4129 4.16406 18.3334C4.16406 19.2538 4.91025 20 5.83073 20Z"
                                                    fill="white"
                                                />
                                                <path
                                                    d="M14.1667 20C15.0871 20 15.8333 19.2538 15.8333 18.3334C15.8333 17.4129 15.0871 16.6667 14.1667 16.6667C13.2462 16.6667 12.5 17.4129 12.5 18.3334C12.5 19.2538 13.2462 20 14.1667 20Z"
                                                    fill="white"
                                                />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_140_35620">
                                                    <rect
                                                        width="20"
                                                        height="20"
                                                        fill="white"
                                                    />
                                                </clipPath>
                                            </defs>
                                        </svg>

                                        <span class="white-color">{{
                                            $t("profile.profileBottom.sell")
                                        }}</span>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab__content">
                <ItemsTab
                    v-show="tab === 'items'"
                    :pagination="pagination"
                    :items="items"
                    :prevPage="prevPage"
                    :nextPage="nextPage"
                    :filteredItems="filteredItems"
                    :sell-skin="sellSkin"
                    :withdraw="withdraw"
                    @update-items="getUserItems"
                />
                <UpgradesTab
                    v-show="tab === 'upgrades'"
                    :pagination="pagination"
                    :upgrades="upgrades"
                    :prevPageUpgrade="prevPageUpgrade"
                    :nextPageUpgrade="nextPageUpgrade"
                />
                <ContractsTab
                    v-show="tab === 'contracts'"
                    :pagination="pagination"
                    :contracts="contracts"
                    :prevPageContracts="prevPageContracts"
                    :nextPageContracts="nextPageContracts"
                />
            </div>
        </div>
        <TradeUrl />
        <PromocodeUser />
    </div>
</template>

<script>
import {
    getExteriorInsideBrackets,
    getItemName,
    getItemRarityClass,
    getItemType,
} from "../helpers/helper";
import TradeUrl from "../components/Modals/TradeUrl.vue";
import PromocodeUser from "../components/Modals/Promocode.vue";
import ItemsTab from "../components/Tabs/Items.vue";
import UpgradesTab from "../components/Tabs/Upgrades.vue";
import ContractsTab from "../components/Tabs/Contracts.vue";
import axios from "axios";
export default {
    components: {
        TradeUrl,
        PromocodeUser,
        ItemsTab,
        UpgradesTab,
        ContractsTab,
    },
    data() {
        return {
            nextLevelThreshold: 0,
            levelProgress: 0,
            allPrice: 0,
            best: {
                case: null,
                drop: null,
            },
            items: [],
            upgrades: [],
            contracts: [],
            tab: "items",
            tradeLink: "",
            forSale: false,
            pagination: {
                items: {
                    more: false,
                    page: 1,
                },
                upgrades: {
                    more: false,
                    page: 1,
                },
                contracts: {
                    more: false,
                    page: 1,
                },
            },
        };
    },
    mounted() {
        this.$root.$on("itemsSellSuccess", () => {
            const itemsWithStatusForSell = this.items.filter(
                (item) => item.status === 0
            );
            for (let i = 0; i < itemsWithStatusForSell.length; i++) {
                itemsWithStatusForSell[i].status = 1;
                this.allPrice = 0;
                this.$forceUpdate();
            }
        });
        this.getProfile();
    },
    computed: {
        filteredItems() {
            return this.items.filter((item) =>
                this.forSale ? item.status === 0 : item
            );
        },
    },
    methods: {
        async getProfile() {
            await this.axios.post(`/user/profile`).then((res) => {
                const result = res.data;
                this.best = result.best;
                console.log("best", result);
                this.tradeLink = result.tradeLink;
                this.allPrice = result.allPrice;
                this.levelProgress = result.levelProgress; // Прогресс
                this.currentLevel = result.currentLevel; // Текущий уровень
                this.nextLevelThreshold = result.nextLevelThreshold; // Порог следующего уровня

                this.getUserItems();
                this.getUserUpgrades();
                this.getUserContracts();
            });
        },

        async getUserHistory() {
            await this.axios
                .get(`/user/profile/history`, {
                    params: {
                        steamid: this.$root.user.steamid,
                    },
                })
                .then((res) => {
                    const result = res.data;
                    this.items = result.items.data;

                    this.pagination.items.totalPages = result.items_total_pages;
                });
        },
        async getUserItems() {
            try {
                const response = await this.axios.get(`/user/profile/history`, {
                    params: {
                        items: this.pagination.items.page,
                        steamid: this.$root.user.steamid,
                    },
                });
                const result = response.data.items;
                this.items = result.data; // Заменяем содержимое текущей страницы
                this.pagination.items.more =
                    result.current_page < result.last_page;
            } catch (error) {
                console.error("Ошибка при загрузке предметов:", error);
            }
        },
        async getUserUpgrades() {
            try {
                const response = await this.axios.get(`/user/profile/history`, {
                    params: {
                        upgrades: this.pagination.upgrades.page,
                        steamid: this.$root.user.steamid,
                    },
                });
                const result = response.data.upgrades;
                this.upgrades = result.data; // Заменяем содержимое текущей страницы
                this.pagination.upgrades.more =
                    result.current_page < result.last_page;
            } catch (error) {
                console.error("Ошибка при загрузке предметов:", error);
            }
        },
        async getUserContracts() {
            try {
                const response = await this.axios.get(`/user/profile/history`, {
                    params: {
                        contracts: this.pagination.contracts.page,
                        steamid: this.$root.user.steamid,
                    },
                });
                const result = response.data.contracts;
                this.contracts = result.data; // Заменяем содержимое текущей страницы
                this.pagination.contracts.more =
                    result.current_page < result.last_page;
            } catch (error) {
                console.error("Ошибка при загрузке предметов:", error);
            }
        },
        async prevPage() {
            if (this.pagination.items.page > 1) {
                this.pagination.items.page -= 1;
                await this.getUserItems();
            }
        },

        async nextPage() {
            if (this.pagination.items.more) {
                this.pagination.items.page += 1;
                await this.getUserItems();
            }
        },
        async prevPageUpgrade() {
            if (this.pagination.upgrades.page > 1) {
                this.pagination.upgrades.page -= 1;
                await this.getUserUpgrades();
            }
        },

        async nextPageUpgrade() {
            if (this.pagination.upgrades.more) {
                this.pagination.upgrades.page += 1;
                await this.getUserUpgrades();
            }
        },
        async prevPageContracts() {
            if (this.pagination.contracts.page > 1) {
                this.pagination.contracts.page -= 1;
                await this.getUserContracts();
            }
        },

        async nextPageContracts() {
            if (this.pagination.contracts.more) {
                this.pagination.contracts.page += 1;
                await this.getUserContracts();
            }
        },
        async saveTradeLink() {
            this.axios
                .post("/user/update-trade-link", {
                    link: this.tradeLink,
                })
                .then((res) => {
                    let data = res.data;

                    if (data.success) {
                        return this.$toast.success(data.message);
                    }

                    this.$toast.error(data.message);
                });
        },

        async withdraw(id) {
            axios.post("/user/items/withdraw", { id }).then((response) => {
                const data = response.data;

                if (data.success) {
                    const item = this.items.find((item) => item.id === id);
                    if (item) {
                        item.status = 2;
                        this.$forceUpdate();
                    }

                    this.$toast.success(data.message);
                } else {
                    this.$toast.error(data.message);
                }
            });
        },
        logOut() {
            this.axios.post("/user/logout").then((res) => {
                this.$cookie.delete("token");
                window.location.reload();
            });
        },
        async sellAction() {
            const itemsWithStatusZero = this.items.filter(
                (item) => item.status === 0
            );

            if (itemsWithStatusZero.length < 1) {
                return this.$toast.error("Нет предметов для продажи");
            }

            this.$root.sellItems(itemsWithStatusZero, true);
            this.isOpened = false;
            this.$root.$emit("itemsSellSuccess");
        },
        sellSkin(id) {
            let historyIndex = this.items.findIndex((item) => item.id === id);
            this.$root.sellItems([id]);
            this.items[historyIndex].status = 1;
            this.allPrice -= this.items[historyIndex].price;
            this.$forceUpdate();
        },
        openPayment() {
            this.$root.$emit("openPaymentModal");
        },
        openTradeLink() {
            this.$root.$emit("tradeUrl");
        },
        openPromocodeUser() {
            this.$root.$emit("PromocodeUser");
        },
        setTab(tab) {
            this.tab = tab;
        },
        getExteriorInsideBrackets,
        getItemRarityClass,
        getItemName,
        getItemType,
    },
};
</script>
