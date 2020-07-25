<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Material+Icons" rel="stylesheet">

        <title>Venlop</title>

    </head>
    <body>

        <div id='app'>
            <v-app>

            <top-bar></top-bar>

                <router-view></router-view>

            <bottom-bar></bottom-bar>

            </v-app>
        </div>

    <script src='/js/app.js'></script>

    </body>
</html>
