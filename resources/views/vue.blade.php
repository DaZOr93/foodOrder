<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">
</head>
<body>
<div id="app">
    <header-component></header-component>
    <div class="container">
        <v-notification></v-notification>
        <router-view></router-view>
    </div>

</div>
<script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
</body>
</html>
<script>

</script>
