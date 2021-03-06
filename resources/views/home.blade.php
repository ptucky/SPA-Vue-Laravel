<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{!! csrf_token() !!}">
        
        <title>Vue-Laravel :: Image Gallery</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/open-iconic/1.1.1/font/css/open-iconic-bootstrap.css" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet"/>
        <link href="{{ asset('css/vue-image-lightbox.min.css') }}" rel="stylesheet"/>
    </head>
    <body>
        <div id="app">
            <main-app/>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/vue-image-lightbox.min.js') }}"></script>
    </body>
</html>