@extends('layouts.layout')
@section('css-title')
    <title>{{ $data['title'] }}</title>
    <!-- 设置页面不缓存 -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Cache" content="no-cache">
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <!-- 前端设置不缓存 -->
    @if ($hasPathApph5)
        <link href="{{asset("app-h5/assets/css/common-fulltext.css?v=".config('app.version'))}}" rel="stylesheet" type="text/css" />
    @else
        <link href="{{asset("assets/css/common-fulltext.css?v=".config('app.version'))}}" rel="stylesheet" type="text/css" />
    @endif
@endsection
@section('content')
    <div class="news-box">
        <div class="title">{{ $data['title'] }}</div>
        <div class="meta-content">
            <!-- data-id 为频道的id -->
            <a id="channel" data-id="{{ $data['channelId'] }}">
                <img class="photo" src="{{ $data['headPortrait'] }}"/>
            </a>
            <div class="channel-box">
                <span class="channel"> {{ $data['channelName'] }}</span>
                <div class="date"><span>{{ date("Y-m-d",strtotime($data['createDate'])) }}</span></div>
            </div>
        </div>
        <div class="content">
            <div class="quill-editor">
                <div class="ql-container ql-bubble">
                    <div class="ql-editor" id="content">
                        <!--内容开始-->
                    {!! $data['content'] !!}
                    <!--内容结束-->
                    </div>
                </div>
            </div>
        </div>
        <div class="source">
            @if (!empty($data['source']))
                <p>文章来源：{{ $data['source'] }}</p>
            @endif
            @if (!empty($data['primaryAddress']))
                <a href="{{ $data['primaryAddress'] }}" id="source">查看原文</a>
            @endif
        </div>
    </div>
    <script>
    // 获取像素
    function getPixel () {
        var oPhoto = document.querySelector(".news-box .photo"),
            top = oPhoto.offsetTop,
            height = oPhoto.offsetHeight;
        return [height, top];
    }
    </script>
@endsection
@section('footer-js')

@endsection
