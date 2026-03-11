<template>
    <div
        class="modals rules-modals"
        v-show="isOpened"
        :class="{ opened: isOpened }"
    >
        <button type="button" class="abs-link"></button>
        <div class="modals-content">
            <button
                type="button"
                class="modals-close-btn"
                @click="isOpened = false"
            >
                <i></i>
            </button>
            <div class="modals-title-wrap">
                <span class="modals-title">{{ $t("login.title") }}</span>
            </div>
            <form class="form rules-agree-form" @submit.prevent="submitForm">
                <div class="form-group">
                    <label class="custom-checkbox"
                        ><input
                            type="checkbox"
                            name="agree_terms"
                            v-model="agreeTerms"
                            value="" /><span
                            class="checkbox-holder"
                            style="display: block"
                            >{{ $t("login.title1") }}
                            <a href="/terms-of-use"
                                >{{ $t("login.title2") }},</a
                            >
                            <a href="/privacy">{{ $t("login.title3") }},</a>
                            {{ $t("login.title4") }}</span
                        ><i class="ch-btn"></i
                    ></label>
                </div>
                <div class="form-group">
                    <label class="custom-checkbox"
                        ><input
                            v-model="agreeLegalAges"
                            type="checkbox"
                            name="agree_legal_ages"
                            value="" /><span
                            style="display: block"
                            class="checkbox-holder"
                            >{{ $t("login.subtitle") }}</span
                        ><i class="ch-btn"></i
                    ></label>
                </div>
                <div class="form-submit-row">
                    <button
                        type="submit"
                        :disabled="!isFormValid"
                        class="apply"
                    >
                        <span class="uppercase">{{ $t("login.apply") }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            isOpened: false,
            agreeLegalAges: false,
            agreeTerms: false,
        };
    },
    computed: {
        isFormValid() {
            return this.agreeLegalAges && this.agreeTerms;
        },
    },
    methods: {
        submitForm() {
            if (this.isFormValid) {
                window.location.href = "/api/auth/steam";
            }
        },
    },
    mounted() {
        this.$root.$on("openLoginModal", () => {
            this.isOpened = true;
        });
    },
};
</script>
