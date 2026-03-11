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
            <span class="uppercase" v-if="user">{{ user.username }}</span>
            <span class="uppercase" v-else>Загрузка...</span>
        </div>
        <div class="page__container" v-if="user">
            <div class="profile__header">
                <div class="profile__form">
                    <div class="card color--primary">
                        <div class="card__body size--medium">
                            <div class="user__card">
                                <div class="user_card__avatar">
                                    <div class="avatar">
                                        <img
                                            :src="user.avatar"
                                            :alt="user.username"
                                            class="avatarImage"
                                            loading="lazy"
                                            decoding="async"
                                        />
                                    </div>
                                </div>
                                <div class="user_card__details">
                                    <div class="details__username">
                                        <div
                                            class="text color--inherit variant--h4 bold noWrap uppercase"
                                        >
                                            {{ user.username }}
                                        </div>
                                    </div>
                                    <div>
                                        <a
                                            target="_blank"
                                            :href="`https://steamcommunity.com/profiles/${user.steamid}`"
                                            rel="noreferrer"
                                        >
                                            <button
                                                class="controls color--gray-dark size--large fit-content button"
                                                type="button"
                                            >
                                                <div class="button__content">
                                                    <div
                                                        class="text color--inherit variant--h3 bold"
                                                    >
                                                        Steam
                                                    </div>
                                                    <svg
                                                        width="24"
                                                        height="24"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        style="
                                                            width: 16px;
                                                            height: 16px;
                                                        "
                                                        class="icon variant--h4"
                                                    >
                                                        <g
                                                            clip-path="url(#steam_svg__steam_svg__clip0_8371_10388)"
                                                            fill="currentColor"
                                                        >
                                                            <path
                                                                d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm4.094 13.303l-4.057 2.932c-.147 1.584-1.503 2.824-3.135 2.824a3.158 3.158 0 01-3.083-2.463l-2.135-.848v-3.944l3.607 1.442c.563-.335 1.195-.486 1.931-.421l2.633-3.738c.017-2.29 1.91-4.146 4.23-4.146 2.334 0 4.226 1.877 4.23 4.176 0 2.317-1.896 4.185-4.221 4.185z"
                                                            ></path>
                                                            <path
                                                                d="M8.902 13.63c-.17 0-.338.018-.502.056l.965.387a1.818 1.818 0 01.63 2.974 1.841 1.841 0 01-2.007.41c-.376-.146-.762-.305-1.139-.447a2.316 2.316 0 102.053-3.38zm7.188-7.311c-1.572 0-2.84 1.257-2.84 2.803 0 1.554 1.272 2.803 2.84 2.803 1.554.004 2.832-1.249 2.827-2.803 0-1.546-1.273-2.803-2.827-2.803zm-.007 4.486a1.683 1.683 0 11.036-3.367 1.683 1.683 0 01-.036 3.367z"
                                                            ></path>
                                                        </g>
                                                        <defs>
                                                            <clipPath
                                                                id="steam_svg__steam_svg__clip0_8371_10388"
                                                            >
                                                                <path
                                                                    fill="#fff"
                                                                    d="M0 0h24v24H0z"
                                                                ></path>
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                </div></button
                                        ></a>
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
                                                    Любимый кейс
                                                </div>
                                                <div
                                                    v-if="
                                                        user.best.case.info ===
                                                        null
                                                    "
                                                    class="favorite__name-item"
                                                >
                                                    Отсутствует
                                                </div>
                                                <div
                                                    v-else
                                                    class="favorite__name-item"
                                                >
                                                    {{
                                                        user.best.case.info.case
                                                            .name
                                                    }}
                                                </div>
                                            </div>
                                            <div class="favorite__btn_wrapper">
                                                <a
                                                    v-if="
                                                        user.best.case.info ===
                                                        null
                                                    "
                                                    href="/"
                                                    class="controls radius-14 color--blue-gradient size--wide full-width button"
                                                >
                                                    <div
                                                        class="button__content"
                                                    >
                                                        <div
                                                            class="favorite__btn-text"
                                                        >
                                                            Открыть кейсы
                                                        </div>
                                                    </div>
                                                </a>
                                                <router-link
                                                    v-else
                                                    :to="{
                                                        name: 'case',
                                                        params: {
                                                            url: user.best.case
                                                                .info.case.url,
                                                        },
                                                    }"
                                                    class="controls radius-14 color--blue-gradient size--wide full-width button"
                                                >
                                                    <div
                                                        class="button__content"
                                                    >
                                                        <div
                                                            class="favorite__btn-text"
                                                        >
                                                            Открыть
                                                        </div>
                                                    </div>
                                                </router-link>
                                            </div>
                                        </div>
                                        <div
                                            class="favorite__image_wrapper"
                                            v-if="user.best.case.info !== null"
                                        >
                                            <img
                                                :srcset="
                                                    '/assets/img/cases/' +
                                                    user.best.case.info.case
                                                        .image +
                                                    ', /assets/img/cases/' +
                                                    user.best.case.info.case
                                                        .image +
                                                    ' 2x'
                                                "
                                                :alt="
                                                    user.best.case.info.case
                                                        .name
                                                "
                                                class="favorite_image"
                                                loading="lazy"
                                                decoding="async"
                                            />
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
                                                    Лучший дроп
                                                </div>
                                                <div
                                                    v-if="
                                                        user.best.drop === null
                                                    "
                                                    class="favorite__name-item"
                                                >
                                                    Отсутствует
                                                </div>
                                                <div
                                                    v-else
                                                    class="favorite__name-item"
                                                >
                                                    {{
                                                        getItemType(
                                                            user.best.drop.item
                                                                .market_hash_name
                                                        )
                                                    }}
                                                    <p>
                                                        {{
                                                            getItemName(
                                                                user.best.drop
                                                                    .item
                                                                    .market_hash_name
                                                            )
                                                        }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="favorite__btn_wrapper">
                                                <div
                                                    v-if="
                                                        user.best.drop === null
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
                                                                user.best.drop
                                                                    .price
                                                            }}
                                                            ₽
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="favorite-item"
                                            v-if="user.best.drop !== null"
                                        >
                                            <div
                                                class="drops__card"
                                                :class="
                                                    getItemRarityClass(
                                                        user.best.drop.item
                                                            .rarity
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
                                                                    user.best
                                                                        .drop
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
                                                                user.best.drop
                                                                    .item
                                                                    .icon_url +
                                                                ', https://steamcommunity-a.akamaihd.net/economy/image/' +
                                                                user.best.drop
                                                                    .item
                                                                    .icon_url +
                                                                '2x'
                                                            "
                                                            :alt="
                                                                user.best.drop
                                                                    .item
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
                                                                    <span></span>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="drops__names_skin"
                                                            >
                                                                <div
                                                                    class="name-h2"
                                                                >
                                                                    <span></span>
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab__content">
                <div
                    class="inventory__container"
                    id="items"
                    v-show="tab === 'items'"
                >
                    <div class="inventory__list">
                        <div
                            class="list__item"
                            v-for="(item, index) in filteredItems"
                            :key="index"
                        >
                            <div class="item__status__controller">
                                <div class="item__statuses">
                                    <div
                                        v-if="item.status === 1"
                                        class="status"
                                        datatype="sell"
                                        data-tip="Продан"
                                        currentitem="false"
                                    >
                                        <svg
                                            width="16"
                                            height="16"
                                            viewBox="0 0 16 16"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <g
                                                clip-path="url(#clip0_140_35979)"
                                            >
                                                <path
                                                    d="M15.142 2.718C14.9545 2.49296 14.7197 2.31197 14.4544 2.18788C14.189 2.06379 13.8996 1.99964 13.6067 2H2.828L2.8 1.766C2.7427 1.27961 2.50892 0.831155 2.14299 0.505652C1.77706 0.180149 1.30442 0.000227862 0.814667 0L0.666667 0C0.489856 0 0.320286 0.0702379 0.195262 0.195262C0.0702379 0.320286 0 0.489856 0 0.666667C0 0.843478 0.0702379 1.01305 0.195262 1.13807C0.320286 1.2631 0.489856 1.33333 0.666667 1.33333H0.814667C0.977956 1.33335 1.13556 1.3933 1.25758 1.50181C1.3796 1.61032 1.45756 1.75983 1.47667 1.922L2.394 9.722C2.48923 10.5332 2.87899 11.2812 3.48927 11.824C4.09956 12.3668 4.8879 12.6667 5.70467 12.6667H12.6667C12.8435 12.6667 13.013 12.5964 13.1381 12.4714C13.2631 12.3464 13.3333 12.1768 13.3333 12C13.3333 11.8232 13.2631 11.6536 13.1381 11.5286C13.013 11.4036 12.8435 11.3333 12.6667 11.3333H5.70467C5.29204 11.3322 4.88987 11.2034 4.55329 10.9647C4.21671 10.726 3.96221 10.389 3.82467 10H11.7713C12.5529 10 13.3096 9.72549 13.9092 9.22429C14.5089 8.7231 14.9134 8.02713 15.052 7.258L15.5753 4.35533C15.6276 4.06734 15.6158 3.77138 15.5409 3.48843C15.4661 3.20547 15.3299 2.94245 15.142 2.718Z"
                                                    fill="url(#paint0_linear_140_35979)"
                                                />
                                                <path
                                                    d="M4.66927 16C5.40565 16 6.0026 15.403 6.0026 14.6666C6.0026 13.9303 5.40565 13.3333 4.66927 13.3333C3.93289 13.3333 3.33594 13.9303 3.33594 14.6666C3.33594 15.403 3.93289 16 4.66927 16Z"
                                                    fill="url(#paint1_linear_140_35979)"
                                                />
                                                <path
                                                    d="M11.3333 16C12.0697 16 12.6667 15.403 12.6667 14.6666C12.6667 13.9303 12.0697 13.3333 11.3333 13.3333C10.597 13.3333 10 13.9303 10 14.6666C10 15.403 10.597 16 11.3333 16Z"
                                                    fill="url(#paint2_linear_140_35979)"
                                                />
                                            </g>
                                            <defs>
                                                <linearGradient
                                                    id="paint0_linear_140_35979"
                                                    x1="7.80369"
                                                    y1="0"
                                                    x2="7.80369"
                                                    y2="12.6667"
                                                    gradientUnits="userSpaceOnUse"
                                                >
                                                    <stop
                                                        stop-color="#75CB7D"
                                                    />
                                                    <stop
                                                        offset="1"
                                                        stop-color="#419049"
                                                    />
                                                </linearGradient>
                                                <linearGradient
                                                    id="paint1_linear_140_35979"
                                                    x1="4.66927"
                                                    y1="13.3333"
                                                    x2="4.66927"
                                                    y2="16"
                                                    gradientUnits="userSpaceOnUse"
                                                >
                                                    <stop
                                                        stop-color="#75CB7D"
                                                    />
                                                    <stop
                                                        offset="1"
                                                        stop-color="#419049"
                                                    />
                                                </linearGradient>
                                                <linearGradient
                                                    id="paint2_linear_140_35979"
                                                    x1="11.3333"
                                                    y1="13.3333"
                                                    x2="11.3333"
                                                    y2="16"
                                                    gradientUnits="userSpaceOnUse"
                                                >
                                                    <stop
                                                        stop-color="#75CB7D"
                                                    />
                                                    <stop
                                                        offset="1"
                                                        stop-color="#419049"
                                                    />
                                                </linearGradient>
                                                <clipPath id="clip0_140_35979">
                                                    <rect
                                                        width="16"
                                                        height="16"
                                                        fill="white"
                                                    />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </div>
                                    <div
                                        v-if="item.status === 7"
                                        class="status"
                                        datatype="contracts"
                                        data-tip="Использован в контракте"
                                        currentitem="false"
                                    >
                                        <svg
                                            width="16"
                                            height="16"
                                            viewBox="0 0 16 16"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                d="M14.6693 2.16669H1.33594C1.0626 2.16669 0.835938 1.94002 0.835938 1.66669C0.835938 1.39335 1.0626 1.16669 1.33594 1.16669H14.6693C14.9426 1.16669 15.1693 1.39335 15.1693 1.66669C15.1693 1.94002 14.9426 2.16669 14.6693 2.16669Z"
                                                fill="url(#paint0_linear_4197_30632)"
                                            />
                                            <path
                                                d="M2.44531 1.66669V9.64669C2.44531 10.3 2.75198 10.92 3.27865 11.3134L6.75198 13.9134C7.49198 14.4667 8.51198 14.4667 9.25198 13.9134L12.7253 11.3134C13.252 10.92 13.5586 10.3 13.5586 9.64669V1.66669H2.44531ZM10.6653 9.16669H5.33198C5.05865 9.16669 4.83198 8.94002 4.83198 8.66669C4.83198 8.39335 5.05865 8.16669 5.33198 8.16669H10.6653C10.9386 8.16669 11.1653 8.39335 11.1653 8.66669C11.1653 8.94002 10.9386 9.16669 10.6653 9.16669ZM10.6653 5.83335H5.33198C5.05865 5.83335 4.83198 5.60669 4.83198 5.33335C4.83198 5.06002 5.05865 4.83335 5.33198 4.83335H10.6653C10.9386 4.83335 11.1653 5.06002 11.1653 5.33335C11.1653 5.60669 10.9386 5.83335 10.6653 5.83335Z"
                                                fill="url(#paint1_linear_4197_30632)"
                                            />
                                            <defs>
                                                <linearGradient
                                                    id="paint0_linear_4197_30632"
                                                    x1="8.0026"
                                                    y1="1.16669"
                                                    x2="8.0026"
                                                    y2="2.16669"
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
                                                    id="paint1_linear_4197_30632"
                                                    x1="8.00198"
                                                    y1="1.66669"
                                                    x2="8.00198"
                                                    y2="14.3284"
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
                                            </defs>
                                        </svg>
                                    </div>
                                    <div
                                        v-if="item.status === 8"
                                        class="status"
                                        datatype="upgrade"
                                        data-tip="Использован в апгрейде"
                                        currentitem="false"
                                    >
                                        <svg
                                            width="16"
                                            height="16"
                                            viewBox="0 0 16 16"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <g
                                                clip-path="url(#clip0_204_27154)"
                                            >
                                                <path
                                                    d="M1.88693 12.3427C1.1136 12.6914 0.353599 11.8314 0.793599 11.104L7.25693 0.417358C7.33375 0.289959 7.44218 0.184571 7.57172 0.111415C7.70126 0.0382589 7.8475 -0.000183105 7.99626 -0.000183105C8.14503 -0.000183105 8.29127 0.0382589 8.42081 0.111415C8.55035 0.184571 8.65878 0.289959 8.7356 0.417358L15.2003 11.104C15.6403 11.8307 14.8803 12.6914 14.1063 12.3427L11.1229 10.9974C11.038 10.959 10.9623 10.9027 10.9011 10.8324C10.8399 10.762 10.7946 10.6793 10.7684 10.5898C10.7422 10.5003 10.7357 10.4062 10.7492 10.314C10.7628 10.2217 10.7961 10.1335 10.8469 10.0554C10.8997 9.97456 10.9337 9.88299 10.9464 9.78735C10.9592 9.6917 10.9504 9.59442 10.9207 9.50262C10.8909 9.41083 10.841 9.32685 10.7747 9.25684C10.7083 9.18683 10.627 9.13256 10.5369 9.09802L9.5356 8.71602C9.39254 8.66105 9.26669 8.56901 9.17093 8.44936L8.6696 7.82669C8.5887 7.72588 8.4862 7.64453 8.36966 7.58862C8.25312 7.53272 8.12552 7.5037 7.99626 7.5037C7.86701 7.5037 7.73941 7.53272 7.62287 7.58862C7.50633 7.64453 7.40383 7.72588 7.32293 7.82669L6.8216 8.45002C6.7256 8.57002 6.5996 8.66136 6.45693 8.71602L5.4556 9.09802C5.36545 9.13249 5.28415 9.18671 5.21768 9.25669C5.15121 9.32666 5.10125 9.41064 5.07146 9.50244C5.04167 9.59424 5.0328 9.69155 5.04552 9.78723C5.05823 9.8829 5.0922 9.97452 5.14493 10.0554C5.19579 10.1335 5.22916 10.2217 5.24276 10.3139C5.25636 10.4061 5.24986 10.5002 5.22371 10.5896C5.19756 10.6791 5.15237 10.7618 5.09125 10.8322C5.03013 10.9026 4.95452 10.9589 4.8696 10.9974L1.88693 12.3427Z"
                                                    fill="url(#paint0_linear_204_27154)"
                                                />
                                                <path
                                                    d="M3.38161 16C2.44961 16 2.17694 14.7267 3.02694 14.344L7.64361 12.2627C7.75509 12.2124 7.87598 12.1864 7.99827 12.1864C8.12057 12.1864 8.24146 12.2124 8.35294 12.2627L12.9696 14.344C13.8196 14.7273 13.5469 16 12.6149 16H10.4336C10.2049 16 9.98494 15.9087 9.82294 15.7467L8.60961 14.5307C8.52941 14.4503 8.43413 14.3864 8.32922 14.3429C8.22432 14.2994 8.11185 14.277 7.99827 14.277C7.88469 14.277 7.77223 14.2994 7.66733 14.3429C7.56242 14.3864 7.46714 14.4503 7.38694 14.5307L6.17361 15.746C6.09345 15.8265 5.99818 15.8904 5.89327 15.934C5.78836 15.9776 5.67588 16 5.56227 16H3.38161Z"
                                                    fill="url(#paint1_linear_204_27154)"
                                                />
                                            </g>
                                            <defs>
                                                <linearGradient
                                                    id="paint0_linear_204_27154"
                                                    x1="7.99693"
                                                    y1="-0.000183105"
                                                    x2="7.99693"
                                                    y2="12.4227"
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
                                                <linearGradient
                                                    id="paint1_linear_204_27154"
                                                    x1="7.99827"
                                                    y1="12.1864"
                                                    x2="7.99827"
                                                    y2="16"
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
                                                <clipPath id="clip0_204_27154">
                                                    <rect
                                                        width="16"
                                                        height="16"
                                                        fill="white"
                                                    />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </div>
                                </div>
                                <div
                                    class="skin__container size--medium"
                                    :class="[
                                        getItemRarityClass(item.item.rarity),
                                    ]"
                                >
                                    <div class="inventory__item">
                                        <div
                                            class="inventory__link"
                                            data-isuser="true"
                                        >
                                            <div class="inventory__item__price">
                                                {{ item.price }} ₽
                                            </div>
                                            <div
                                                class="inventory__item__image_wrapper"
                                            >
                                                <img
                                                    :srcset="
                                                        'https://steamcommunity-a.akamaihd.net/economy/image/' +
                                                        item.item.icon_url
                                                    "
                                                    :alt="
                                                        item.item
                                                            .market_hash_name
                                                    "
                                                    loading="lazy"
                                                    decoding="async"
                                                />
                                            </div>
                                            <div
                                                class="inventory__item__footer"
                                            >
                                                <div
                                                    class="inventory__item__footer_left_side"
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
                                                        <div
                                                            class="name__bottom"
                                                        >
                                                            <span
                                                                class="text color--disabled variant--h4 bold noWrap"
                                                            >
                                                                {{
                                                                    getItemName(
                                                                        item
                                                                            .item
                                                                            .market_hash_name
                                                                    )
                                                                }}</span
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="inventory-item__backdrop">
                                        <div
                                            class="inventory-item__background"
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
                    <div class="empty__alert" v-if="filteredItems.length < 1">
                        <div class="empty__alert-text">
                            У пользователя еще нет предметов.
                        </div>
                    </div>
                    <div
                        class="show_more__wrapper"
                        v-if="pagination.items.more"
                    >
                        <button
                            @click="getUserItems"
                            class="controls color--gray-dark size--large fit-content button"
                            type="button"
                        >
                            <div class="button__content">
                                <div
                                    class="text color--inherit variant--h3 bold"
                                >
                                    Показать ещё
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
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
    </div>
</template>

<script>
import {
    getExteriorInsideBrackets,
    getItemName,
    getItemRarityClass,
    getItemType,
} from "../helpers/helper";
import UpgradesTab from "../components/Tabs/Upgrades.vue";
import ContractsTab from "../components/Tabs/Contracts.vue";
export default {
    components: {
        UpgradesTab,
        ContractsTab,
    },
    data() {
        return {
            user: null,
            items: [],
            upgrades: [],
            contracts: [],
            tab: "items",
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

    computed: {
        filteredItems() {
            return this.items.filter((item) =>
                this.forSale ? item.status === 0 : item
            );
        },
    },

    mounted() {
        this.getProfile();
    },
    methods: {
        async getProfile() {
            const profileId = this.$route.params.id;
            try {
                const response = await this.axios.post(`/user/profile-other`, {
                    id: profileId,
                });
                const result = response.data;
                if (result.success) {
                    this.user = result.user;

                    if (this.user.id === this.$root.user.id) {
                        this.$router.push("/dashboard");
                        return;
                    }

                    this.best = result.best;
                    this.tradeLink = result.tradeLink;
                    this.allPrice = result.allPrice;
                } else {
                    console.error("Пользователь не найден");
                }
            } catch (error) {
                console.error("Ошибка при загрузке профиля:", error);
            }
            this.getUserItems();
            this.getUserUpgrades();
            this.getUserContracts();
        },

        async getUserHistory() {
            await this.axios
                .get(`/user/profile-other/history`, {
                    params: {
                        id: this.$route.params.id,
                    },
                })
                .then((res) => {
                    const result = res.data;
                    this.items = result.items.data;
                });
        },
        async getUserItems() {
            await this.axios
                .get(`/user/profile-other/history`, {
                    params: {
                        items: this.pagination.items.page,
                        id: this.$route.params.id,
                    },
                })
                .then((res) => {
                    const result = res.data.items;

                    const items = result.data;

                    if (result.current_page !== result.last_page) {
                        this.pagination.items.more = true;
                    } else {
                        this.pagination.items.more = false;
                    }

                    if (items.length > 0) {
                        items.forEach((element) => {
                            this.items.push(element);
                        });
                        this.pagination.items.page += 1;
                    }
                });
        },
        async getUserUpgrades() {
            try {
                const response = await this.axios.get(
                    `/user/profile-other/history`,
                    {
                        params: {
                            upgrades: this.pagination.upgrades.page,
                            id: this.$route.params.id,
                        },
                    }
                );
                const result = response.data.upgrades;
                console.log(result);

                this.upgrades = result.data; // Заменяем содержимое текущей страницы
                this.pagination.upgrades.more =
                    result.current_page < result.last_page;
            } catch (error) {
                console.error("Ошибка при загрузке предметов:", error);
            }
        },
        async getUserContracts() {
            try {
                const response = await this.axios.get(
                    `/user/profile-other/history`,
                    {
                        params: {
                            contracts: this.pagination.contracts.page,
                            id: this.$route.params.id,
                        },
                    }
                );
                const result = response.data.contracts;
                this.contracts = result.data; // Заменяем содержимое текущей страницы
                this.pagination.contracts.more =
                    result.current_page < result.last_page;
            } catch (error) {
                console.error("Ошибка при загрузке предметов:", error);
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
