<template>
    <v-layout row>
        <v-flex xs12 md8 offset-md2 lg6 offset-lg3>
            <v-card>
                <v-card-title class="headline">Sign In</v-card-title>
                <form @submit.prevent="login" @keydown="error.clear($event.target.name)">
                    <v-divider></v-divider>
                    <v-card-text>
                        <v-container grid-list-md>
                            <v-flex xs12>
                                <v-text-field
                                    name="email"
                                    label="Email"
                                    prepend-icon="contact_mail"
                                    v-model="credential.email"
                                    :error-messages="error.get('email')"
                                    autofocus
                                ></v-text-field>
                            </v-flex>

                            <v-flex xs12>
                                <v-text-field
                                    name="password"
                                    type="password"
                                    label="Password"
                                    prepend-icon="lock"
                                    v-model="credential.password"
                                    :error-messages="error.get('password')"
                                ></v-text-field>
                            </v-flex>
                        </v-container>
                    </v-card-text>
                    <v-divider></v-divider>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn dark type="submit" class="indigo" :loading="loading">Sign In</v-btn>
                    </v-card-actions>
                </form>
            </v-card>
        </v-flex>
    </v-layout>
</template>

<script>
export default {
    computed: {
        loading() {
            return this.$store.getters.loading
        },
        error() {
            return this.$store.getters.error
        }
    },
    data: () => ({
        credential: {}
    }),
    methods: {
        login() {
            this.$store.dispatch('login', this.credential)
        }
    }
}
</script>
