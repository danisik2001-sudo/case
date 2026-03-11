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
            <span class="uppercase">{{ $t("freecase.header") }}</span>
        </div>
        <div class="MainContainer__header">
            <div class="MainContainer__container">
                <div
                    class="text color--disabled variant--h1 align--center uppercase flex flex-col"
                >
                    {{ $t("freecase.title") }}
                    <span> {{ $t("freecase.desc") }}</span>
                    <span> {{ $t("freecase.desc2") }}</span>
                </div>
            </div>
        </div>
        <div class="categoryContainer casesSection">
            <div class="cases__list">
                <div
                    class="box__wrapper"
                    v-for="(box, index) in list"
                    :key="index"
                >
                    <div class="box__card">
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
                            <div class="box__free"><span>FREE</span></div>
                        </div>
                        <button
                            v-if="!isCaseOpen(box.name)"
                            class="button__lock"
                        >
                            <svg
                                width="19"
                                height="18"
                                viewBox="0 0 19 18"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M14.75 6.318V5.24999C14.75 2.35051 12.3995 0 9.49999 0C6.60048 0 4.25 2.35051 4.25 5.24999V6.318C2.88502 6.91372 2.00197 8.2607 2 9.74999V14.25C2.00246 16.32 3.67994 17.9975 5.74998 18H13.25C15.32 17.9975 16.9975 16.32 17 14.25V9.74999C16.998 8.2607 16.115 6.91372 14.75 6.318ZM10.25 12.75C10.25 13.1642 9.9142 13.5 9.49999 13.5C9.08578 13.5 8.75 13.1642 8.75 12.75V11.25C8.75 10.8358 9.08578 10.5 9.49999 10.5C9.9142 10.5 10.25 10.8358 10.25 11.25V12.75ZM13.25 6.00001H5.74998V5.25002C5.74998 3.17897 7.4289 1.50001 9.49999 1.50001C11.5711 1.50001 13.25 3.17893 13.25 5.25002V6.00001Z"
                                    fill="#687894"
                                />
                            </svg>
                            <div class="button__lock-text uppercase">
                                {{ $t("freecase.lock") }}
                            </div>
                        </button>
                        <router-link
                            :to="{
                                name: 'case',
                                params: {
                                    url: box.url,
                                },
                            }"
                            v-if="isCaseOpen(box.name)"
                            class="button__open-free"
                        >
                            <div class="button__open-text uppercase">
                                {{ $t("freecase.open") }}
                            </div>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            list: [],
            caseLevels: {
                free1: 10,
                free2: 20,
                free3: 30,
                free4: 40,
                free5: 50,
            },
        };
    },
    mounted() {
        this.getBoxes();
    },
    methods: {
        async getBoxes() {
            await this.axios.get("/case/getAll").then((res) => {
                const result = res.data;

                this.list = result.list
                    .filter((category) => category.name === "free_cases")
                    .flatMap((category) => category.boxes);
                console.log(this.list);
            });
        },
        isCaseOpen(caseName) {
            const requiredLevel = this.caseLevels[caseName]; // Получаем минимальный уровень для кейса
            console.log("requiredLevel", requiredLevel);
            console.log("this.$root.user.lvl", this.$root.user.lvl); // Проверяем, доступен ли кейс
            return this.$root.user.lvl >= requiredLevel;
        },
    },
};
</script>
