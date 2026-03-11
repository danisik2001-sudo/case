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
            <span class="uppercase">Барабан бонусов</span>
        </div>
        <section class="wheel_wheelPage">
            <div class="wheel">
                <div class="wheel_contentWrapper">
                    <div class="wheel_content">
                        <div class="wheel_wheelWrapper">
                            <div
                                class="wheel_wheelInner"
                                v-if="
                                    state === 'default' || state === 'roulette'
                                "
                            >
                                <div
                                    class="wheel_wheel"
                                    v-bind:style="{
                                        transform:
                                            'rotate(' +
                                            rullet.animation.rotate +
                                            'deg)',
                                    }"
                                    :class="{
                                        wheel_active:
                                            this.rullet.animation.status,
                                    }"
                                >
                                    <ul>
                                        <li
                                            v-bind:style="{
                                                transform:
                                                    'rotate(' +
                                                    -rullet.animation.rotate +
                                                    'deg)',
                                            }"
                                            v-for="item in rullet.items"
                                            :key="item.id"
                                            class="wheel_prizeItem"
                                        >
                                            <img
                                                class="wheel_prizeImage"
                                                :src="item.image"
                                                alt="Бонус на пополнение"
                                            />
                                        </li>
                                    </ul>
                                </div>
                                <div class="wheel_mainContent">
                                    <div
                                        class="wheel_contentColdown"
                                        :style="[
                                            !rullet.available.status
                                                ? {}
                                                : { display: 'none' },
                                        ]"
                                    >
                                        <div class="wheel_timerTitle">
                                            {{ $t("wheel.free") }}
                                            <p>{{ $t("wheel.open1") }}</p>
                                        </div>
                                        <countdown
                                            :time="this.rullet.available.time"
                                            :transform="this.$root.transform"
                                            @end="handleCountdownEnd"
                                        >
                                            <div
                                                class="wheel_timer"
                                                id="timerBonus"
                                                slot-scope="props"
                                            >
                                                <div
                                                    class="wheel_timer__container"
                                                >
                                                    <div
                                                        class="wheel_timerItem"
                                                    >
                                                        <div
                                                            class="wheel_timerValue"
                                                        >
                                                            {{
                                                                props.totalHours
                                                            }}
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="wheel_timerLabel"
                                                    >
                                                        {{ $t("wheel.hours") }}
                                                    </div>
                                                </div>

                                                <div
                                                    class="wheel_timer__container"
                                                >
                                                    <div
                                                        class="wheel_timerItem"
                                                    >
                                                        <div
                                                            class="wheel_timerValue"
                                                        >
                                                            {{ props.minutes }}
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="wheel_timerLabel"
                                                    >
                                                        {{
                                                            $t("wheel.minutes")
                                                        }}
                                                    </div>
                                                </div>

                                                <div
                                                    class="wheel_timer__container"
                                                >
                                                    <div
                                                        class="wheel_timerItem"
                                                    >
                                                        <div
                                                            class="wheel_timerValue"
                                                        >
                                                            {{ props.seconds }}
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="wheel_timerLabel"
                                                    >
                                                        {{
                                                            $t("wheel.seconds")
                                                        }}
                                                    </div>
                                                </div>
                                            </div>
                                        </countdown>
                                    </div>
                                    <div
                                        class="wheel_contentStandard"
                                        :style="[
                                            rullet.available.status
                                                ? {}
                                                : { display: 'none' },
                                        ]"
                                    >
                                        <div
                                            class="wheel_btnWrapper"
                                            v-if="state === 'roulette'"
                                        >
                                            <button class="wheel_btn_open">
                                                {{ $t("wheel.spin") }}
                                            </button>
                                        </div>
                                        <h1
                                            class="wheel_title"
                                            v-if="state === 'default'"
                                        >
                                            {{ $t("wheel.title") }}<br />
                                            {{ $t("wheel.subTitle") }}
                                        </h1>
                                        <div
                                            class="wheel_btnWrapper"
                                            v-if="state === 'default'"
                                        >
                                            <button
                                                class="wheel_btn"
                                                v-on:click="open()"
                                            >
                                                {{ $t("wheel.open") }}
                                            </button>
                                        </div>
                                        <!-- <div
                                            class="wheel_skipAnimation"
                                            v-if="state === 'default'"
                                        >
                                            Пропустить анимацию
                                            <div
                                                class="wheel_skipAnimationToggle"
                                            ></div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="wheel_overlay" v-if="state === 'win'">
                                <div class="wheel_overlayContent">
                                    <img
                                        src="/assets/contract/spiral.svg"
                                        alt="spiral"
                                        class="wheel__result_spiral"
                                    />
                                    <div class="wheel_overlayContentWrapper">
                                        <img
                                            class="wheel_overlayImage"
                                            :src="rullet.win_item.image"
                                            :alt="rullet.win_item.name"
                                        />
                                        <div class="wheel_overlayTitle">
                                            {{ rullet.win_item.desc }}
                                        </div>
                                        <button
                                            v-if="promoCode"
                                            class="wheel_overlayPromo"
                                            :data-value="promoCode"
                                            @click="copyPromoCode"
                                        >
                                            {{ $t("wheel.promo") }}
                                            <p>{{ promoCode }}</p>
                                        </button>
                                        <div class="wheel_overlayButton">
                                            <button
                                                @click="refresh"
                                                class="wheel_overlay_button use"
                                            >
                                                {{ $t("wheel.use") }}
                                            </button>
                                            <button
                                                @click="refresh"
                                                class="wheel_overlay_button refresh"
                                            >
                                                {{ $t("wheel.refresh") }}
                                            </button>
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
                        {{ $t("wheel.what") }}
                    </div>
                </div>
            </div>
            <ul class="prizes_list">
                <li class="prizes_item" v-for="item in items" :key="item.id">
                    <div class="prizes_itemContent">
                        <div class="prizes_imageWrapper">
                            <img
                                class="prizes_image"
                                :src="item.image"
                                alt=""
                            />
                        </div>
                        <div class="prizes_itemTitle">
                            {{ item.desc }}
                        </div>
                    </div>
                </li>
            </ul>
        </section>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            items: [],
            state: "default", // default, roulette, win
            promoCode: null,
            rullet: {
                available: {
                    status: true,
                    time: 0,
                },
                items: [],
                animation: {
                    status: false,
                    rotate: 0,
                },
                win_item: [],
            },
        };
    },
    methods: {
        async get() {
            const request = await axios.post("/wheel/get");

            if (request.data.success) {
                this.items = request.data.items;
                this.rullet.items = request.data.rullet.items;

                this.rullet.available.status = request.data.rullet.status;
                this.rullet.available.time = request.data.rullet.time;
            } else {
                this.$router.go(-1);
            }
        },
        handleCountdownEnd: function () {
            this.rullet.available.status = true;
        },
        async open() {
            const request = await axios.post("/wheel/open");

            if (request.data.success) {
                this.rullet.animation.status = true;
                this.rullet.items = request.data.rullet.items; // Обновляем ленту с предметами сразу
                this.rullet.win_item = request.data.item; // Выигранный предмет
                this.rullet.available.time = request.data.time;

                if (request.data.promo_code) {
                    this.promoCode = request.data.promo_code;
                }

                this.$root.playSound("wheel_scroll");
                this.state = "roulette";

                // Обновляем анимацию
                if (this.rullet.animation.rotate >= 1130) {
                    this.rullet.animation.rotate += 1130;
                } else {
                    this.rullet.animation.rotate = 1130;
                }

                // Добавляем выигранный предмет на ленту сразу
                this.rullet.items.push(this.rullet.win_item);

                setTimeout(() => {
                    // Завершаем анимацию и скрываем её
                    this.rullet.animation.status = false;
                    this.rullet.available.status = false;

                    // Показ уведомления

                    this.$toast.success(request.data.msg);

                    // Запускаем анимацию "пинка" для всех предметов
                    this.$nextTick(() => {
                        // Применяем анимацию "пинка" ко всем элементам
                        const allItems =
                            document.querySelectorAll(".wheel_prizeItem"); // Выбираем все элементы

                        allItems.forEach((item) => {
                            item.classList.add("kicked-up"); // Добавляем класс анимации ко всем предметам

                            // Убираем анимацию после завершения
                            setTimeout(() => {
                                item.classList.remove("kicked-up");
                            }, 300); // Время анимации (300ms)
                        });

                        // Находим выигравший предмет по индексу
                        const winItemIndex = this.rullet.items.indexOf(
                            this.rullet.win_item
                        );
                        const winItemElement = document.querySelector(
                            `.wheel_prizeItem:nth-child(${winItemIndex + 1})` // Учитываем, что индексация с 1
                        );

                        // Добавляем класс активности только для выигравшего предмета
                        if (winItemElement) {
                            winItemElement.classList.add("wheel_active"); // Добавляем класс активности
                            this.$root.playSound("wheel_shot");

                            // Убираем класс wheel_active через 2 секунды
                            setTimeout(() => {
                                winItemElement.classList.remove("wheel_active");
                            }, 2000); // Убираем через 2 секунды
                        }
                    });
                }, 5500); // Делаем это через 5500 мс после завершения вращения

                setTimeout(() => {
                    this.$root.playSound("wheel_prize");
                    this.state = "win";
                }, 6500);
            } else {
                if (request.data.status == 1) {
                    this.rullet.available.status = false;
                    this.rullet.available.time = request.data.time;
                }

                return this.$toast.error(request.data.msg);
            }
        },
        copyPromoCode(event) {
            const promoElement = event.currentTarget;
            const promoCode = promoElement.getAttribute("data-value");

            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard
                    .writeText(promoCode)
                    .then(() => {
                        this.$toast.success(
                            `Вы скопировали промокод: ${promoCode}`
                        );
                    })
                    .catch((err) => {
                        this.$toast.error("Не удалось скопировать промокод");
                        console.error("Ошибка при копировании промокода:", err);
                    });
            } else {
                // Альтернативный метод: использование textarea
                const textArea = document.createElement("textarea");
                textArea.value = promoCode;
                textArea.style.position = "fixed"; // Чтобы элемент не прокручивался
                textArea.style.opacity = "0"; // Скрыть элемент
                document.body.appendChild(textArea);
                textArea.focus();
                textArea.select();

                try {
                    document.execCommand("copy");
                    this.$toast.success(
                        `Вы скопировали промокод: ${promoCode}`
                    );
                } catch (err) {
                    this.$toast.error("Не удалось скопировать промокод");
                    console.error("Ошибка при копировании промокода:", err);
                }

                document.body.removeChild(textArea);
            }
        },
        refresh() {
            this.items = [];
            this.state = "default"; // Возвращаем состояние в default
            this.rullet = {
                available: {
                    status: true,
                    time: 0,
                },
                items: [],
                animation: {
                    status: false,
                    rotate: 0,
                },
                win_item: [],
            };
            this.get(); // Повторно загружаем данные
        },
    },
    mounted() {
        this.get();
    },
};
</script>

<style>
.wheel_wheel.wheel_active {
    will-change: transform;
}

.wheel_wheel.wheel_active {
    translate: none;
    rotate: none;
    scale: none;
}

/* Ключевая анимация для пинка */
@keyframes kick-up {
    0% {
        transform: translate(0, 0) rotate(-1130deg); /* Начальное положение */
    }
    50% {
        transform: translate(-10px, -8px) rotate(-1130deg); /* Поднятие вверх */
    }
    100% {
        transform: translateX(0, 0) rotate(-1130deg); /* Возвращение на место */
    }
}

/* Применение анимации к выигранному предмету */
.wheel_prizeItem.kicked-up {
    animation: kick-up 0.3s ease-out; /* Быстрая анимация */
}

.wheel_prizeItem.wheel_active:before {
    opacity: 1;
}
</style>
