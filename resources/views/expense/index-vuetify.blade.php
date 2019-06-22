<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hello Vuetify</title>
</head>
<body>
    <div id="app">
        <v-app>
            <v-content>
                <v-container>
                    <expense />
                </v-container>
            </v-content>
        </v-app>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
