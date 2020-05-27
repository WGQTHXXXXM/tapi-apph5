<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0,minimal-ui">
    <meta name="screen-orientation"content="portrait">
    <meta name="x5-orientation"content="portrait">
    <meta name="x5-fullscreen" content="true">
    <meta name="full-screen" content="no">
    <meta name="keywords" content="奇点汽车">
    <meta name="description" content="奇点汽车">
    <title></title>
    @if ($hasPathApph5)
        <link href="/app-h5/css/vihecle.css" rel="stylesheet" type="text/css" />
    @else
        <link href="/css/vihecle.css" rel="stylesheet" type="text/css" />
    @endif
</head>
<body>
    @yield('content')
</body>

<script>
    if(location.hash) {
        document.body.className = location.hash.substring(1);
    } else {
        document.body.className = 'appMode';
    }
    window.addEventListener("hashchange",function(e){
        document.body.className = location.hash.substring(1);
    },false);
</script>

</html>
