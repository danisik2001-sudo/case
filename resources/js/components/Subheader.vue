<template>
    <div class="layout__subheader">
        <div class="subheader">
            <div class="header__left">
                <div class="header__nav">
                    <div class="header__nav">
                        <nav class="nav-main">
                            <!-- <router-link
                                :to="{ name: 'missions' }"
                                class="nav-main__elem"
                            >
                                <missions />

                                {{ $t("subheader.missions") }}
                            </router-link> -->
                            <!-- <router-link
                                :to="{ name: 'calendar' }"
                                class="nav-main__elem"
                            >
                                <calendar />
                                {{ $t("subheader.calendar") }}
                            </router-link> -->

                            <router-link
                                :to="{ name: 'referral' }"
                                class="nav-main__elem"
                            >
                                {{ $t("subheader.referral") }}
                            </router-link>
                            <router-link
                                :to="{ name: 'faq' }"
                                class="nav-main__elem"
                            >
                                <faq />

                                {{ $t("subheader.faq") }}
                            </router-link>
                        </nav>
                    </div>
                </div>
            </div>
            <router-link :to="{ name: 'free_case' }" class="header__right">
                <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <g clip-path="url(#clip0_4130_31351)">
                        <path
                            d="M0 19H24C24 21.757 21.757 24 19 24H5C2.243 24 0 21.757 0 19ZM24 11V17H0V11C0 8.24305 2.243 6.00005 5 6.00005H6.253C4.836 4.60005 4.628 2.79705 5.706 1.36005C6.251 0.633047 7.046 0.162047 7.945 0.034047C8.844 -0.096953 9.739 0.135047 10.466 0.680047C11.144 1.18805 11.644 1.83405 12.013 2.49205C12.382 1.83405 12.882 1.18705 13.56 0.680047C14.286 0.135047 15.179 -0.096953 16.081 0.034047C16.98 0.162047 17.775 0.633047 18.32 1.36005C19.404 2.80505 19.187 4.62005 17.775 6.00005H19.001C21.758 6.00005 24 8.24305 24 11ZM13.006 6.00005C13.143 6.00005 14.807 5.96505 16.377 4.57205C16.764 4.20305 17.361 3.41405 16.72 2.55905C16.496 2.26005 16.168 2.06605 15.798 2.01305C15.43 1.96405 15.059 2.05505 14.76 2.28005C13.482 3.23805 13.11 5.09805 13.021 5.69605L13.023 5.71705L13.006 6.00005ZM11.008 6.00005H11.02C11.02 6.00005 11.004 5.70605 11.005 5.69605C10.917 5.10105 10.544 3.23905 9.265 2.28005C9.02 2.09605 8.728 2.00005 8.428 2.00005C7.958 2.00005 7.53 2.26105 7.305 2.56005C6.664 3.41505 7.262 4.20305 7.675 4.59705C9.21 5.95805 10.866 5.99905 11.007 6.00005H11.008ZM18 12C18 11.447 17.552 11 17 11C16.837 11 13 10.966 13 8.00005H11C11 10.936 7.182 10.999 6.999 11C6.447 11 6 11.448 6 12C6 12.552 6.448 13 7 13C8.417 13 10.697 12.512 12 10.944C13.303 12.513 15.583 13 17 13C17.552 13 18 12.553 18 12Z"
                            fill="currentColor"
                        />
                    </g>
                    <defs>
                        <clipPath id="clip0_4130_31351">
                            <rect width="24" height="24" fill="white" />
                        </clipPath>
                    </defs>
                </svg>

                <span class="uppercase"> {{ $t("subheader.freeCase") }}</span>
            </router-link>
        </div>
    </div>
</template>

<script>
import missions from "../components/Icons/missions.vue";
import calendar from "../components/Icons/calendar.vue";
import faq from "../components/Icons/faq.vue";

export default {
    components: {
        missions,
        calendar,
        faq,
    },
};
</script>
