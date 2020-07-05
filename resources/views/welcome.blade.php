<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
        
<!--    <meta name="viewport" content="width=device-width, initial-scale=1">   -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Venlop</title>

    </head>
    <body>
        <div id='app'>

            <router-view></router-view>

        </div>

    <script src='/js/app.js'></script>

    </body>
</html>
