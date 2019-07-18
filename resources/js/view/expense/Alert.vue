<template>
    <v-snackbar
        v-model="snackbar"
        multi-line
        right
        top
        :timeout="timeout"
        color="blue-grey darken-3"
    >
        <span>
            <v-icon class="yellow--text">check_circle</v-icon>
            {{ alert }}
        </span>
    </v-snackbar>
</template>

<script>
export default {
    computed: {
        alert() {
            return this.$store.state.expense.alert
        }
    },
    data() {
        return {
            snackbar: false,
            timeout: 6000
        }
    },
    watch: {
        alert: {
            handler() {
                this.snackbar = true
            },
            deep: true
        }
    }
}
</script>
