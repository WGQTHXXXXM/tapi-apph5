<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0,minimal-ui">
    <meta name="screen-orientation"content="portrait">
    <meta name="x5-orientation"content="portrait">
    <meta name="x5-fullscreen" content="true">
    <meta name="full-screen" content="yes">
    <title>@yield('title', '') - 积分商城</title>
    <meta name="keywords" content="奇点汽车 奇点商城 奇点积分商城">
    <meta name="description" content="奇点汽车积分商城">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="">
    <script type="text/javascript" src="{{asset('assets/js/adaptUILayout.js')}}"></script>
    @section('head')
    @show
</head>
<body>
<div class="page">
    @section('header')
    @show

    @section('content')
    @show

    @section('nav-wrap')
    @show
</div>
@section('wx-js')
@show

@section('ext-js')
@show
</body>
</html>
