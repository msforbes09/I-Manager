<template>
    <v-alert
        :value="alert.status"
        type="success"
        icon="check_circle"
        transition="scale-transition"
    >{{ alert.message }}</v-alert>
</template>

<script>
export default {
    computed: {
        alert() {
            return this.$store.state.income.alert;
        }
    }
};
</script>