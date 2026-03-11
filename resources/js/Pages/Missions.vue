<template>
    <div class="container">
        <div class="missions__wrapper">
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
                <span class="uppercase"> {{ $t("missions.header") }}</span>
            </div>
            <div class="MainContainer__header">
                <div
                    class="text color--disabled variant--h1 align--center bold uppercase"
                >
                    {{ $t("missions.header") }}
                </div>
            </div>
            <div class="missions__container">
                <div
                    class="missions__element"
                    v-for="mission in missions"
                    :key="mission.id"
                >
                    <div class="missions__element-left">
                        <div class="missions__element-title">
                            <span>{{ mission.title }}</span>
                            <svg
                                width="18"
                                height="18"
                                viewBox="0 0 18 18"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <g clip-path="url(#clip0_166_11268)">
                                    <path
                                        d="M9 0C7.21997 0 5.47991 0.527841 3.99987 1.51677C2.51983 2.50571 1.36628 3.91131 0.685088 5.55585C0.00389953 7.20038 -0.17433 9.00998 0.172937 10.7558C0.520203 12.5016 1.37737 14.1053 2.63604 15.364C3.89472 16.6226 5.49836 17.4798 7.24419 17.8271C8.99002 18.1743 10.7996 17.9961 12.4442 17.3149C14.0887 16.6337 15.4943 15.4802 16.4832 14.0001C17.4722 12.5201 18 10.78 18 9C17.9972 6.61391 17.0481 4.32636 15.3609 2.63914C13.6736 0.951924 11.3861 0.00280987 9 0ZM9 14.7273C8.83819 14.7272 8.68001 14.6793 8.54547 14.5893C8.41092 14.4994 8.30605 14.3717 8.24411 14.2222C8.1822 14.0727 8.166 13.9082 8.19757 13.7495C8.22914 13.5908 8.30706 13.445 8.42147 13.3305C8.53591 13.2162 8.68169 13.1383 8.84039 13.1067C8.99909 13.0752 9.16358 13.0914 9.31306 13.1533C9.46255 13.2152 9.59033 13.3201 9.68023 13.4546C9.77015 13.5891 9.81816 13.7473 9.8182 13.9091C9.8182 14.0165 9.79704 14.1229 9.75592 14.2222C9.71481 14.3215 9.65454 14.4117 9.57856 14.4876C9.50259 14.5636 9.41239 14.6239 9.31312 14.665C9.21385 14.7061 9.10745 14.7273 9 14.7273ZM10.9145 9.19965C10.5903 9.41363 10.3217 9.70181 10.131 10.0403C9.94036 10.3788 9.83312 10.7579 9.8182 11.1461V11.4545C9.8182 11.562 9.79703 11.6684 9.75591 11.7676C9.71479 11.8669 9.65452 11.9571 9.57854 12.0331C9.50257 12.1091 9.41237 12.1693 9.31311 12.2105C9.21384 12.2516 9.10745 12.2727 9 12.2727C8.89256 12.2727 8.78616 12.2516 8.6869 12.2105C8.58763 12.1693 8.49744 12.1091 8.42147 12.0331C8.34549 11.9571 8.28522 11.8669 8.2441 11.7676C8.20298 11.6684 8.18181 11.562 8.18181 11.4545V11.1461C8.19479 10.4985 8.36268 9.86344 8.67143 9.29405C8.98018 8.72467 9.42082 8.23751 9.95646 7.87335C10.2167 7.68629 10.4163 7.42692 10.5305 7.12743C10.6446 6.82794 10.6683 6.50152 10.5986 6.18869C10.5289 5.87585 10.3689 5.59038 10.1383 5.3677C9.90782 5.14502 9.61698 4.99493 9.30193 4.93608C9.06549 4.89173 8.82218 4.90003 8.58932 4.96041C8.35646 5.02079 8.13977 5.13174 7.95467 5.28539C7.76961 5.43908 7.6207 5.63168 7.51855 5.84947C7.4164 6.06727 7.36351 6.3049 7.36366 6.54546C7.36366 6.65291 7.34249 6.7593 7.30137 6.85857C7.26025 6.95783 7.19998 7.04802 7.124 7.12399C7.04803 7.19998 6.95784 7.26025 6.85857 7.30137C6.75931 7.3425 6.65291 7.36366 6.54547 7.36366C6.43802 7.36366 6.33163 7.3425 6.23236 7.30137C6.13309 7.26025 6.0429 7.19998 5.96693 7.12399C5.89095 7.04802 5.83068 6.95783 5.78956 6.85857C5.74844 6.7593 5.72727 6.65291 5.72727 6.54546C5.72727 5.98502 5.87118 5.43397 6.14522 4.94509C6.41925 4.45622 6.81424 4.0459 7.29232 3.75346C8.01444 3.31181 8.87959 3.16711 9.70612 3.34975C10.5327 3.53238 11.2563 4.02814 11.7251 4.73295C12.1939 5.43775 12.3714 6.2968 12.2202 7.12969C12.0691 7.96257 11.6011 8.7045 10.9145 9.19965Z"
                                        fill="#687894"
                                    />
                                </g>
                                <defs>
                                    <clipPath id="clip0_166_11268">
                                        <rect
                                            width="18"
                                            height="18"
                                            fill="white"
                                        />
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <div class="missions__info">
                            <div
                                class="missions__task"
                                v-for="(task, index) in mission.tasks"
                                :key="index"
                            >
                                <div
                                    class="missions__task-process"
                                    :class="{ done: task.done }"
                                ></div>
                                <div
                                    class="missions__task-text"
                                    :class="{ done: task.done }"
                                >
                                    {{ task.description }}
                                </div>
                            </div>
                        </div>
                        <div
                            class="missions__button"
                            :disabled="mission.completed ? true : false"
                            :class="{ done: mission.completed }"
                            @click="completeMission(mission.id)"
                        >
                            <span class="uppercase done">{{
                                mission.completed ? "Выполнена" : "Забрать"
                            }}</span>
                        </div>
                    </div>
                    <div class="missions__element-right">
                        <img
                            class="missions__prize"
                            :src="mission.prize"
                            :class="{
                                'mix-blend-mode': mission.id == 4,
                            }"
                        />
                    </div>

                    <div class="ellipses">
                        <div class="ellipse ellipse-1"></div>
                        <div class="ellipse ellipse-2"></div>
                        <div class="ellipse ellipse-3"></div>
                        <div class="ellipse ellipse-4"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            missions: [], // Данные миссий
        };
    },
    methods: {
        // Загрузка данных миссий
        async fetchMissions() {
            try {
                const response = await axios.get("/missions/get");
                this.missions = response.data.missions;
            } catch (error) {
                console.error("Ошибка загрузки миссий:", error);
            }
        },
        // Завершение миссии
        async completeMission(missionId) {
            const response = await axios.post("/missions/complete", {
                missionId,
            });

            // Обновляем статус миссии в списке

            if (response.data.done) {
                this.$toast.success(response.data.message);
                this.missions = this.missions.map((mission) =>
                    mission.id === missionId
                        ? { ...mission, completed: true }
                        : mission
                );
            } else {
                this.$toast.error(response.data.message);
            }
        },
    },
    mounted() {
        this.fetchMissions();
    },
};
</script>
