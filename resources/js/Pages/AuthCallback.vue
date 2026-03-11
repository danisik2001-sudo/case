<template>

</template>

<script>
export default {
    data() {
        return {

        }
    },
    mounted() {
        this.initUser();
    },
    methods: {
        initUser() {
            const urlSearchParams = new URLSearchParams(window.location.search);
            const params = Object.fromEntries(urlSearchParams.entries());
            let token = params.token;
            this.$root.initUser(token)
            this.$router.push({'name': 'main'})
        }
    }
}
</script>
