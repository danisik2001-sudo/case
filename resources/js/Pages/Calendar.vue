<template>
    <div class="container">
        <div class="winterCalendar__page">
            <div class="calendar_page__container">
                <div class="winterCalendar__content">
                    <div class="page__heading">
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
                                        <rect
                                            width="18"
                                            height="18"
                                            fill="white"
                                        />
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
                            <span class="uppercase">Calendar</span>
                        </div>
                    </div>
                    <!-- <div class="calendar__banner">
                        <div class="calendar__banners">
                            <div class="calendar__banner_card">
                                <div class="right__side">
                                    <div class="banner__info">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="calendar__wrapper">
                        <div class="calendar__banner">
                            <div
                                class="calendar__background imageBanner fresnel-lessThan-smXl fresnel-:r0:"
                                style="
                                    background-image: url('/assets/calendar/banner/banner-winter.png');
                                "
                            ></div>
                            <div
                                class="calendar__background imageBanner fresnel-greaterThanOrEqual-smXl fresnel-:r1:"
                                style="
                                    background-image: url('/assets/calendar/banner/banner-winter.png');
                                "
                            ></div>
                            <div class="calendar__banner__content">
                                <div class="calendar__flex">
                                    <div class="calendarLogo__wrapper">
                                        <div
                                            class="calendar__logo fresnel-lessThan-smXl fresnel-:r2:"
                                            style="
                                                background-image: url('/assets/calendar/banner/logo.svg');
                                            "
                                        ></div>
                                        <div
                                            class="calendar__logo fresnel-greaterThanOrEqual-smXl fresnel-:r3:"
                                            style="
                                                background-image: url('/assets/calendar/banner/logo.svg');
                                            "
                                        ></div>
                                    </div>
                                    <div class="calendar__info">
                                        <div class="color-white">
                                            {{ $t("calendar.top.text") }}
                                        </div>
                                    </div>
                                    <div class="calendar__rules">
                                        <svg
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                d="M12 22C17.51 22 22 17.51 22 12C22 6.49 17.51 2 12 2C6.49 2 2 6.49 2 12C2 17.51 6.49 22 12 22ZM12.75 16C12.75 16.41 12.41 16.75 12 16.75C11.59 16.75 11.25 16.41 11.25 16L11.25 11C11.25 10.59 11.59 10.25 12 10.25C12.41 10.25 12.75 10.59 12.75 11L12.75 16ZM11.08 7.62C11.13 7.49 11.2 7.39 11.29 7.29C11.39 7.2 11.5 7.13 11.62 7.08C11.74 7.03 11.87 7 12 7C12.13 7 12.26 7.03 12.38 7.08C12.5 7.13 12.61 7.2 12.71 7.29C12.8 7.39 12.87 7.49 12.92 7.62C12.97 7.74 13 7.87 13 8C13 8.13 12.97 8.26 12.92 8.38C12.87 8.5 12.8 8.61 12.71 8.71C12.61 8.8 12.5 8.87 12.38 8.92C12.14 9.02 11.86 9.02 11.62 8.92C11.5 8.87 11.39 8.8 11.29 8.71C11.2 8.61 11.13 8.5 11.08 8.38C11.03 8.26 11 8.13 11 8C11 7.87 11.03 7.74 11.08 7.62Z"
                                                fill="white"
                                            />
                                        </svg>

                                        <span class="uppercase">{{
                                            $t("calendar.top.rules")
                                        }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="MainContainer__header">
                        <div
                            class="text color--disabled variant--h1 align--center bold uppercase"
                        >
                            Ноябрь
                            <p>день 4</p>
                        </div>
                    </div>
                    <div class="page__body">
                        <div>
                            <div class="calendar">
                                <div
                                    class="calendarSlot__wrapper"
                                    :aria-disabled="day !== currentDay"
                                    v-for="day in total_days"
                                    :key="day"
                                >
                                    <div class="calendarSlot__inner">
                                        <div
                                            class="calendarSlot"
                                            :aria-disabled="day !== currentDay"
                                        >
                                            <div
                                                class="slot__day"
                                                data-special="false"
                                            >
                                                {{ day }}
                                            </div>
                                            <div
                                                v-if="
                                                    day === currentDay &&
                                                    !isErased &&
                                                    !isBonusReceived(day)
                                                "
                                                class="slot__eraser"
                                            >
                                                <canvas
                                                    class="eraser"
                                                    width="179"
                                                    height="179"
                                                    @mousedown="startErase"
                                                    @mousemove="erase"
                                                    @mouseup="stopErase"
                                                    @mouseleave="stopErase"
                                                ></canvas>
                                                <div class="slot__text">
                                                    СОТРИТЕ <br />ПОКРЫТИЕ
                                                </div>
                                            </div>
                                            <div
                                                v-if="isBonusReceived(day)"
                                                class="slotResult__wrapper"
                                            >
                                                <div class="calendar__prizee">
                                                    <div>
                                                        <img
                                                            v-if="
                                                                getBonusType(
                                                                    day
                                                                ) ===
                                                                'bonus_balance'
                                                            "
                                                            src="/assets/calendar/prize/rub.png"
                                                            alt="box key"
                                                            class="prize__image"
                                                            loading="lazy"
                                                            decoding="async"
                                                        />
                                                        <img
                                                            v-if="
                                                                getBonusType(
                                                                    day
                                                                ) ===
                                                                'free_item'
                                                            "
                                                            src="/assets/calendar/prize/item.png"
                                                            alt="box key"
                                                            class="prize__image"
                                                            loading="lazy"
                                                            decoding="async"
                                                        />
                                                        <img
                                                            v-if="
                                                                getBonusType(
                                                                    day
                                                                ) ===
                                                                'promocode'
                                                            "
                                                            src="/assets/calendar/prize/promo.png"
                                                            alt="box key"
                                                            class="prize__image"
                                                            loading="lazy"
                                                            decoding="async"
                                                        />
                                                        <img
                                                            v-if="
                                                                getBonusType(
                                                                    day
                                                                ) ===
                                                                'free_case'
                                                            "
                                                            src="/assets/calendar/prize/key.png"
                                                            alt="box key"
                                                            class="prize__image"
                                                            loading="lazy"
                                                            decoding="async"
                                                        />
                                                    </div>
                                                    <div class="prize__button">
                                                        <button
                                                            v-if="
                                                                getBonusType(
                                                                    day
                                                                ) ===
                                                                'bonus_balance'
                                                            "
                                                            class="slot__button"
                                                        >
                                                            +{{
                                                                getBonusAmount(
                                                                    day
                                                                )
                                                            }}
                                                            ₽
                                                        </button>
                                                        <button
                                                            v-if="
                                                                getBonusType(
                                                                    day
                                                                ) ===
                                                                'free_item'
                                                            "
                                                            class="slot__button"
                                                        >
                                                            Рандомный скин
                                                        </button>
                                                        <button
                                                            @click="
                                                                copyPromocode(
                                                                    promocode_id
                                                                )
                                                            "
                                                            v-if="
                                                                getBonusType(
                                                                    day
                                                                ) ===
                                                                'promocode'
                                                            "
                                                            class="slot__button"
                                                        >
                                                            {{ promocode_id }}
                                                        </button>
                                                        <router-link
                                                            :to="`/case/${case_id}`"
                                                            v-if="
                                                                type ===
                                                                'free_case'
                                                            "
                                                            class="slot__button"
                                                        >
                                                            Открыть кейс
                                                        </router-link>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                v-if="
                                                    day == currentDay &&
                                                    !isBonusReceived(day)
                                                "
                                                class="slotResult__wrapper"
                                            >
                                                <div class="calendar__prizee">
                                                    <div>
                                                        <img
                                                            v-if="
                                                                type ===
                                                                'bonus_balance'
                                                            "
                                                            src="/assets/calendar/prize/rub.png"
                                                            alt="box key"
                                                            class="prize__image"
                                                            loading="lazy"
                                                            decoding="async"
                                                        />
                                                        <img
                                                            v-if="
                                                                type ===
                                                                'free_item'
                                                            "
                                                            src="/assets/calendar/prize/item.png"
                                                            alt="box key"
                                                            class="prize__image"
                                                            loading="lazy"
                                                            decoding="async"
                                                        />
                                                        <img
                                                            v-if="
                                                                type ===
                                                                'promocode'
                                                            "
                                                            src="/assets/calendar/prize/promo.png"
                                                            alt="box key"
                                                            class="prize__image"
                                                            loading="lazy"
                                                            decoding="async"
                                                        />
                                                        <img
                                                            v-if="
                                                                type ===
                                                                'free_case'
                                                            "
                                                            src="/assets/calendar/prize/key.png"
                                                            alt="box key"
                                                            class="prize__image"
                                                            loading="lazy"
                                                            decoding="async"
                                                        />
                                                    </div>
                                                    <div class="prize__button">
                                                        <button
                                                            v-if="
                                                                type ===
                                                                'bonus_balance'
                                                            "
                                                            class="slot__button"
                                                        >
                                                            +{{ bonus_balance }}
                                                            ₽
                                                        </button>
                                                        <button
                                                            v-if="
                                                                type ===
                                                                'free_item'
                                                            "
                                                            class="slot__button"
                                                        >
                                                            Рандомный скин
                                                        </button>
                                                        <button
                                                            @click="
                                                                copyPromocode(
                                                                    promocode_id
                                                                )
                                                            "
                                                            v-if="
                                                                type ===
                                                                'promocode'
                                                            "
                                                            class="slot__button"
                                                        >
                                                            {{ promocode_id }}
                                                        </button>
                                                        <router-link
                                                            :to="`/case/${case_id}`"
                                                            v-if="
                                                                type ===
                                                                'free_case'
                                                            "
                                                            class="slot__button"
                                                        >
                                                            Открыть кейс
                                                        </router-link>
                                                    </div>
                                                </div>
                                            </div>

                                            <div
                                                class="slot__placeholder"
                                                v-if="
                                                    !isBonusReceived(day) &&
                                                    day !== currentDay
                                                "
                                            ></div>
                                            <div
                                                class="slot__lock"
                                                v-if="
                                                    !isBonusReceived(day) &&
                                                    day !== currentDay
                                                "
                                            >
                                                <svg
                                                    width="84"
                                                    height="84"
                                                    viewBox="0 0 84 84"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <g
                                                        filter="url(#filter0_b_4004_27293)"
                                                    >
                                                        <circle
                                                            cx="42"
                                                            cy="42"
                                                            r="42"
                                                            fill="url(#paint0_linear_4004_27293)"
                                                            fill-opacity="0.45"
                                                        />
                                                        <circle
                                                            cx="42"
                                                            cy="42"
                                                            r="41.5"
                                                            stroke="#87C5FF"
                                                            stroke-opacity="0.35"
                                                        />
                                                    </g>
                                                    <path
                                                        d="M42 50.4708C43.4254 50.4708 44.5809 49.3153 44.5809 47.8899C44.5809 46.4646 43.4254 45.3091 42 45.3091C40.5747 45.3091 39.4192 46.4646 39.4192 47.8899C39.4192 49.3153 40.5747 50.4708 42 50.4708Z"
                                                        fill="#96CDFF"
                                                    />
                                                    <path
                                                        d="M51.9434 38.089V36.1098C51.9434 31.8348 50.9142 26.1665 42.0001 26.1665C33.0859 26.1665 32.0567 31.8348 32.0567 36.1098V38.089C27.6234 38.6432 26.1667 40.8915 26.1667 46.4173V49.3623C26.1667 55.854 28.1459 57.8332 34.6376 57.8332H49.3626C55.8542 57.8332 57.8334 55.854 57.8334 49.3623V46.4173C57.8334 40.8915 56.3767 38.6432 51.9434 38.089ZM42.0001 52.6715C39.3559 52.6715 37.2184 50.5182 37.2184 47.8898C37.2184 45.2457 39.3717 43.1082 42.0001 43.1082C44.6284 43.1082 46.7817 45.2615 46.7817 47.8898C46.7817 50.534 44.6442 52.6715 42.0001 52.6715ZM34.6376 37.9465C34.5109 37.9465 34.4001 37.9465 34.2734 37.9465V36.1098C34.2734 31.4707 35.5876 28.3832 42.0001 28.3832C48.4126 28.3832 49.7267 31.4707 49.7267 36.1098V37.9623C49.6001 37.9623 49.4892 37.9623 49.3626 37.9623H34.6376V37.9465Z"
                                                        fill="#96CDFF"
                                                    />
                                                    <defs>
                                                        <filter
                                                            id="filter0_b_4004_27293"
                                                            x="-45"
                                                            y="-45"
                                                            width="174"
                                                            height="174"
                                                            filterUnits="userSpaceOnUse"
                                                            color-interpolation-filters="sRGB"
                                                        >
                                                            <feFlood
                                                                flood-opacity="0"
                                                                result="BackgroundImageFix"
                                                            />
                                                            <feGaussianBlur
                                                                in="BackgroundImageFix"
                                                                stdDeviation="22.5"
                                                            />
                                                            <feComposite
                                                                in2="SourceAlpha"
                                                                operator="in"
                                                                result="effect1_backgroundBlur_4004_27293"
                                                            />
                                                            <feBlend
                                                                mode="normal"
                                                                in="SourceGraphic"
                                                                in2="effect1_backgroundBlur_4004_27293"
                                                                result="shape"
                                                            />
                                                        </filter>
                                                        <linearGradient
                                                            id="paint0_linear_4004_27293"
                                                            x1="42"
                                                            y1="0"
                                                            x2="42"
                                                            y2="84"
                                                            gradientUnits="userSpaceOnUse"
                                                        >
                                                            <stop
                                                                stop-color="#487BEF"
                                                            />
                                                            <stop
                                                                offset="1"
                                                                stop-color="#3160CD"
                                                            />
                                                        </linearGradient>
                                                    </defs>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="calendar__prizes">
                            <div class="MainContainer__header">
                                <div
                                    class="text color--disabled variant--h1 align--center bold uppercase"
                                >
                                    {{ $t("calendar.title") }}
                                </div>
                            </div>
                            <div class="prizes__wrapper">
                                <div class="calendar__prize">
                                    <div class="slot__wrapper">
                                        <div class="slot">
                                            <div class="calendar__prize__slot">
                                                <img
                                                    src="/assets/calendar/prize/rub.png"
                                                    alt="Бонус на баланс"
                                                    class="prize__picture"
                                                    loading="lazy"
                                                    decoding="async"
                                                />
                                                <div
                                                    class="text variant--h12 bold prize__name"
                                                >
                                                    {{
                                                        $t(
                                                            "calendar.bottom.bonus"
                                                        )
                                                    }}
                                                    <p>
                                                        {{
                                                            $t(
                                                                "calendar.bottom.balance"
                                                            )
                                                        }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slot__wrapper">
                                        <div class="slot">
                                            <div class="calendar__prize__slot">
                                                <img
                                                    src="/assets/calendar/prize/key.png"
                                                    alt="Бонус на баланс"
                                                    class="prize__picture"
                                                    loading="lazy"
                                                    decoding="async"
                                                />
                                                <div
                                                    class="text variant--h12 bold prize__name"
                                                >
                                                    {{
                                                        $t(
                                                            "calendar.bottom.key"
                                                        )
                                                    }}
                                                    <p>
                                                        {{
                                                            $t(
                                                                "calendar.bottom.case"
                                                            )
                                                        }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slot__wrapper">
                                        <div class="slot">
                                            <div class="calendar__prize__slot">
                                                <img
                                                    src="/assets/calendar/prize/item.png"
                                                    alt="Бонус на баланс"
                                                    class="prize__picture"
                                                    loading="lazy"
                                                    decoding="async"
                                                />
                                                <div
                                                    class="text variant--h12 bold prize__name"
                                                >
                                                    {{
                                                        $t(
                                                            "calendar.bottom.random"
                                                        )
                                                    }}
                                                    <p>
                                                        {{
                                                            $t(
                                                                "calendar.bottom.item"
                                                            )
                                                        }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slot__wrapper">
                                        <div class="slot">
                                            <div class="calendar__prize__slot">
                                                <img
                                                    src="/assets/calendar/prize/promo.png"
                                                    alt="Бонус на баланс"
                                                    class="prize__picture"
                                                    loading="lazy"
                                                    decoding="async"
                                                />
                                                <div
                                                    class="text variant--h12 bold prize__name"
                                                >
                                                    {{
                                                        $t(
                                                            "calendar.bottom.promo"
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
    </div>
</template>

<script>
import axios from "axios";
import { nextTick } from "vue";
export default {
    data() {
        return {
            total_days: 0,
            currentDay: 0,
            isErasing: false,
            isErased: false,
            canvas: null,
            ctx: null,
            received_bonuses: [],
        };
    },
    async mounted() {
        await this.fetchCalendarData();

        await nextTick();
        this.initializeCanvas();
    },
    methods: {
        initializeCanvas() {
            this.canvas = this.$el.querySelector("canvas");
            if (this.canvas) {
                this.ctx = this.canvas.getContext("2d");
                if (this.ctx) {
                    this.drawBackground();
                } else {
                    console.error(
                        "Ошибка: Не удалось получить контекст для canvas."
                    );
                }
            }
        },
        drawBackground() {
            if (this.ctx && this.canvas) {
                // Создаем линейный градиент
                const gradient = this.ctx.createLinearGradient(
                    0,
                    0,
                    0,
                    this.canvas.height
                );

                // Определяем цвета градиента
                gradient.addColorStop(0, "#75CB7D"); // Верхний цвет
                gradient.addColorStop(1, "#419049"); // Нижний цвет

                // Применяем градиент как заливку
                this.ctx.fillStyle = gradient;
                this.ctx.fillRect(0, 0, this.canvas.width, this.canvas.height);
            }
        },
        startErase(event) {
            this.isErasing = true;
            this.erase(event);
        },
        erase(event) {
            if (!this.isErasing) return;

            const rect = this.canvas.getBoundingClientRect();
            const x = event.clientX - rect.left;
            const y = event.clientY - rect.top;

            this.clearCircle(x, y, 10);
        },
        stopErase() {
            this.isErasing = false;

            this.checkIfErased();
        },
        checkIfErased() {
            const imageData = this.ctx.getImageData(
                0,
                0,
                this.canvas.width,
                this.canvas.height
            );
            const pixels = imageData.data;

            for (let i = 3; i < pixels.length; i += 4) {
                if (pixels[i] === 0) {
                    this.isErased = true;
                    break;
                }
            }

            if (this.isErased) {
                this.claimBonus();
            }
        },
        clearCircle(x, y, radius) {
            this.ctx.globalCompositeOperation = "destination-out"; // Это сделает стирание прозрачным

            this.ctx.beginPath();
            this.ctx.arc(x, y, radius, 0, Math.PI * 2);
            this.ctx.fill();

            this.ctx.globalCompositeOperation = "source-over";
        },
        isBonusReceived(day) {
            return this.received_bonuses.some((bonus) => bonus.day === day);
        },
        getBonusType(day) {
            const bonus = this.received_bonuses.find(
                (bonus) => bonus.day === day
            );
            return bonus ? bonus.type : null;
        },
        getBonusAmount(day) {
            const bonus = this.received_bonuses.find(
                (bonus) => bonus.day === day
            );
            return bonus ? bonus.bonus_balance : null;
        },
        async fetchCalendarData() {
            try {
                const response = await axios.get("/calendar/get");
                console.log(response.data);

                this.currentDay = response.data.currentDay;
                this.total_days = response.data.total_days;
                this.bonus_balance = response.data.bonus_balance;
                this.promocode_id = response.data.promocode_id;
                this.case_id = response.data.case_id;
                this.type = response.data.type;
                this.received_bonuses = response.data.received_bonuses;
            } catch (error) {
                console.error("Ошибка при получении данных:", error);
            }
        },
        async claimBonus() {
            try {
                const response = await axios.post("/calendar/claim-bonus");

                this.$toast.success(
                    response.data.message || "Бонус начислен успешно!"
                );
            } catch (error) {
                console.error("Ошибка при начислении бонуса:", error);
                console.error("Response:", error.response);

                const errorMessage =
                    error.response &&
                    error.response.data &&
                    error.response.data.message
                        ? error.response.data.message
                        : "Произошла ошибка при начислении бонуса.";

                this.$toast.error(errorMessage);
            }
        },
        copyPromocode(promocode_id) {
            if (promocode_id) {
                const textArea = document.createElement("textarea");
                textArea.value = promocode_id;

                // Скрываем элемент с текстом для копирования из видимой области
                textArea.style.position = "fixed";
                textArea.style.top = "-9999px";

                document.body.appendChild(textArea);

                // Выделяем текст в элементе и копируем его
                textArea.select();
                try {
                    document.execCommand("copy");
                    this.$toast.success("Промокод успешно скопирован!");
                } catch (err) {
                    console.error("Could not copy promocode:", err);
                    this.$toast.error("Не удалось скопировать промокод.");
                }

                // Удаляем временный элемент
                document.body.removeChild(textArea);
            }
        },
    },
};
</script>

<style>
.eraser {
    border-radius: 24px;
}
</style>
