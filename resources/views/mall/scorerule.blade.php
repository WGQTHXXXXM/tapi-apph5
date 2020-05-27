@extends('layouts.mall')

@section('title','积分规则')

@section('head')
    @if ($hasPathApph5)
        <link href="{{asset("app-h5/assets/css/common-mall.css?v=".config('app.version'))}}" rel="stylesheet" type="text/css" />
    @else
        <link href="{{asset("assets/css/common-mall.css?v=".config('app.version'))}}" rel="stylesheet" type="text/css" />
    @endif
@endsection

@section('header')
    {{--<div class="header">
        <a id="back" class="back iconfont icon-back"></a>
        <div class="title">积分规则</div>
    </div>--}}
@endsection

@section('content')
    <div class="content bgw fix-header">
        <div class="content-text">
            <h3><img src="{{asset('assets/images/qmark.svg?v='.config('app.version'))}}" /> 积分有什么用？</h3>
            <p>积分可在商城兑换到虚拟或实物商品，还可参加线上抽奖等积分活动。</p>
            <hr>
            <h3><img src="{{asset('assets/images/qmark.svg?v='.config('app.version'))}}" />  如何获得积分？</h3>
            <p>1. 每日签到：
                用户可通过每日点击签到按钮，获取积分。当用户漏签时，累计签到天数重置。
            </p>
            <table>
                <thead>
                    <tr><th>连续签到天数</th><th>签到获取积分数</th></tr>
                </thead>
                <tbody>
                    <tr><td>1</td><td class="highlight">20</td></tr>
                    <tr><td>2</td><td class="highlight">40</td></tr>
                    <tr><td>3</td><td class="highlight">40</td></tr>
                    <tr><td>4</td><td class="highlight">60</td></tr>
                    <tr><td>5</td><td class="highlight">60</td></tr>
                    <tr><td>6</td><td class="highlight">60</td></tr>
                    <tr><td>7</td><td class="highlight">80</td></tr>
                    <tr><td>8</td><td class="highlight">80</td></tr>
                    <tr><td>9</td><td class="highlight">80</td></tr>
                    <tr><td>10</td><td class="highlight">80</td></tr>
                    <tr><td>11</td><td class="highlight">100</td></tr>
                    <tr><td>11+</td><td class="highlight">100</td></tr>
                </tbody>
            </table>
            <p>2. 手机绑定：
                用户关注奇点公众号后，并在奇点汽车微信公众号内完成手机绑定即可一次性获得500积分。</p>
            <p>3. 线上活动：
                线上活动为奇点汽车策划，如：投票，问卷，节日红包，抽奖游戏等。获取分值根据当前活动情况而定。
            </p>
            <p>4. 参观展厅、车展、巡展等活动现场签到：
                当用户参观展厅、车展、巡展等活动时，扫描现场签到二维码，即可获得积分；参加现场活动，根据活动内容获取积分奖励。
            </p>
            <p>5. 分享转发：
                分享转发奇点汽车APP30天以内发布的资讯，每天首次分享成功即可获得50积分奖励
            </p>
            <hr>
            <h3><img src="{{asset('assets/images/qmark.svg?v='.config('app.version'))}}" />  如何使用积分？</h3>
            <p>线上兑换：奇点积分商城支持积分兑换商品；</p>
            <p>线下活动：奇点汽车举办线下活动时也会提供积分兑换礼品活动。</p>
            <hr>
            <h3><img src="{{asset('assets/images/qmark.svg?v='.config('app.version'))}}" />  积分是否可以转账？</h3>
            <p>积分以账号为单位，不可以转移给其他账号。</p>
            <hr>
            <h3><img src="{{asset('assets/images/qmark.svg?v='.config('app.version'))}}" />  积分是否会失效？</h3>
            <p>积分暂时不设有效期，后续如有变更会提前进行通知。</p>
            <hr>
            <h3><img src="{{asset('assets/images/qmark.svg?v='.config('app.version'))}}" />  如何兑换虚拟商品？</h3>
            <p>请查看商品详情页面介绍及详细的帮助信息。</p>
            <hr>
        </div>
    </div>
@endsection

@section('nav-wrap')
@endsection

@section('ext-js')
@endsection

