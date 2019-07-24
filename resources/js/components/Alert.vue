<template>
    <v-snackbar v-model="show" :color="color" top right auto-height :timeout="6000">
        {{ message }}
        <v-btn round flat small @click="show = false">
            <v-icon>clear</v-icon>
        </v-btn>
    </v-snackbar>
</template>

<script>
export default {
    computed: {
        message() {
            return this.$store.getters.alert.message
        },
        color() {
            return this.$store.getters.alert.color
        },
        show: {
            get() {
                return this.$store.getters.showAlert
            },
            set(arg) {
                this.$store.commit('showAlert', arg)
            }
        }
    }
}
</script>
