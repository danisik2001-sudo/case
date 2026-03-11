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
            <span class="uppercase">faq</span>
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
</template>

<script>
export default {
    data() {
        return {
            faq_1: false,
            faq_2: false,
            faq_3: false,
            faq_4: false,
            faq_5: false,
        };
    },
    methods: {
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
