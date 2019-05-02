<template>
    <div class="notification" :class="type" v-if="active">
        <button class="delete" @click="close"></button>
        <p><slot></slot></p>
    </div>
</template>

<script>
    export default {
        props: [ 'type' ],
        data() {
            return {
                active: true,
            }
        },
        methods: {
            close() {
                this.active = false;
            }
        }
    }
</script>
