<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/myStyle.css')}}">
    <link rel="stylesheet" href="{{asset('css/modal.css')}}">
    <link rel="stylesheet" href="{{asset('css/client.css')}}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="{{asset('css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    @yield('css')
    <title>Mộc Vũ Long</title>
</head>
<body>
    @include('client.layout.top')
    @yield('content')
    @include('client.layout.footer')
</body>
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
@yield('js')
<script>
    function addCart(productId) {
        $.get('/ajax/add-cart/' + productId, function (data) {
            location.reload();
        })
    }
    function removeCart(key) {
        $.get('/ajax/remove-cart/' + key, function (data) {
            location.reload();
        })
    }
</script>
</html>
