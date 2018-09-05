<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Fay blog</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="hold-transition login-page">
    <div id="app" class="{{ route_class() }}-page">
        <admin-login-component></admin-login-component>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>

</body>
</html>