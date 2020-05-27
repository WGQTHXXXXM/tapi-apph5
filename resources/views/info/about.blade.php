@extends('layouts.layout')
@section('css-title')
    <title>关于奇点</title>
    @if ($hasPathApph5)
        <link href="{{asset("app-h5/assets/css/common-fulltext.css?v=".config('app.version'))}}" rel="stylesheet" type="text/css" />
    @else
        <link href="{{asset("assets/css/common-fulltext.css?v=".config('app.version'))}}" rel="stylesheet" type="text/css" />
    @endif
@endsection
@section('content')
    <div class="about-box">
        <div class="content">
            <div class="quill-editor">
                <div class="ql-container ql-bubble">
                    <div class="ql-editor">
                        <!--内容开始-->
                            {!! $data['content'] !!}
                        <!--内容结束-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
