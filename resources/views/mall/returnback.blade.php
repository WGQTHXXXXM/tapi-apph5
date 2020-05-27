@extends('layouts.mall')
@section('title','退换货说明')
@section('header')
    @if ($hasPathApph5)
        <link href="{{asset("app-h5/assets/css/common-mall.css?v=".config('app.version'))}}" rel="stylesheet" type="text/css" />
    @else
        <link href="{{asset("assets/css/common-mall.css?v=".config('app.version'))}}" rel="stylesheet" type="text/css" />
    @endif
    {{--<div class="header">
        <a id="back" class="back iconfont icon-back"></a>
        <div class="title">退换货说明</div>
    </div>--}}
@endsection

@section('content')

        <div class="content bgw fix-header">
            <div class="content-text">
                <h3>7天内无理由退货</h3>
                <p class="pdnone">用户收到商品的7天内，如因“不喜欢/不想要了”等主观原因不愿意完成本次交易，可以通过联系客服申请无理由退货服务，邮费自理。</p>
                <p class="pdnone">若用户申请退货的商品影响奇点的二次发放，则不适用“七天无理由退货”（具体适用标准参照国家工商总局发布的《网络购买商品七日无理由退还暂行办法》的规定执行）。</p>
                <p class="pdnone">审核通过后所付积分将在10个工作日内退还至用户账户。</p>
                <hr>
                <h3>30天质量保证</h3>
                <p class="pdnone">用户收到商品的30天内，如果发现有质量问题，可以联系客服申请无忧换货服务，审核通过后按照需求进行换货服务。</p>
                <p class="pdnone"><strong>换货服务：</strong>回收商品抵达公司的10个工作日内，将快递新的商品给用户。</p>
                <hr>
                <h3>PS:以上质量问题不包括人为损坏或因使用不当造成的破损、形变、染色等问题。</h3>
            </div>
        </div>
@endsection

@section('nav-wrap')
@endsection

@section('ext-js')
@endsection

