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
        <link href="{{asset("app-h5/assets/css/app.css?v=".config('app.version'))}}" rel="stylesheet" type="text/css" />
    @else
        <link href="{{asset("assets/css/app.css?v=".config('app.version'))}}" rel="stylesheet" type="text/css" />
    @endif
@endsection
@section('content')
    <div class="news-box">
        <div class="title">{{ $data['title'] }}</div>
        <div class="meta-content">
            <!-- data-id 为频道的id -->
            <a id="channel" data-id="{{ $data['publisherUser']['id'] }}">
                @if(!empty($data['publisherUser']['avatar']))
                <img class="photo" src="{{ $data['publisherUser']['avatar'] }}"/>
                @else
                <img class="photo" src="{{asset($pathprefix . "assets/images/default_reply-3x.png")}}"/>
                @endif
            </a>
            <div class="channel-box">
                <span class="channel">{{ $data['publisherUser']['nickName'] }}</span>
                <div class="date">{{ date("Y-m-d",strtotime($data['publishTime'])) }}</div>
            </div>
        </div>
        <div class="content">
            <div class="quill-editor">
                <div class="ql-container ql-bubble">
                    @if($data['type'] == 0)
                    <div class="ql-editor" id="content">
                        <!--内容开始-->
                        {!! $data['content'] !!}
                        <!--内容结束-->
                    </div>
                    @else
                    <div class="ql-editor" id="images">
                        <!--图集开始-->
                        @foreach($data['images'] as $image)
                        <p>{{ $image['desc'] }}</p>
                        <img src="{{ $image['url'] }}" width="500">
                        @endforeach
                        <!--图集结束-->
                    </div>
                    @endif
                </div>
            </div>

        </div>
        <div class="source">
            <p>作者：{{ $data['publisherUser']['nickName'] }}</p>
        </div>
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
(function () {
    let  lastP = document.getElementById('content').lastElementChild;
    if (lastP.innerHTML === '<br>') {
        lastP.remove();
    }
})();
</script>
@endsection
@section('footer-js')

@endsection
