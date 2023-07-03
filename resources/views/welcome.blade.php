<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet"> <!--Añadimos el css generado con webpack-->

    <!-- Add Bootstrap and Bootstrap-Vue CSS to the <head> section -->
    <link type="text/css" rel="stylesheet" href="https://unpkg.com/bootstrap/dist/css/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.css"/>
</head>
<body>
<div id="app" class="content"><!--La equita id debe ser app, como hemos visto en app.js-->

    <nav>
        <router-link :to="{ name: '/' }" class="nav-link text-center">
            Inicio
        </router-link>
        <router-link :to="{ name: '/empleados' }" class="nav-link text-center">
            Empleados
        </router-link>
    </nav>
    <router-view></router-view>
</div>
<script src="{{asset('js/app.js')}}"></script> <!--Añadimos el js generado con webpack, donde se encuentra nuestro componente vuejs-->

<!-- Add Vue and Bootstrap-Vue JS just before the closing </body> tag -->
<script src="https://unpkg.com/vue/dist/vue.min.js"></script>
<script src="https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.js"></script>
</body>
</html>