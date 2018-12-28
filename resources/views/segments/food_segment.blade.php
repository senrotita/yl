@extends('_layout.master')
@section('title')
    <title>助餐服务</title>
@stop
@section('style')
    <style>
        html,body{background-color: #f8f8f8;}
        .item-footer{margin-top: 4px;}
        .item-header,.item-footer{background-color: #ffffff;padding: 10px;}
        .income-list{font-size: 12px;}
        .mui-table-view{background-color: inherit;}
        .mui-table-view:before{display: none;}
        .mui-table-view:after{display: none;}
    </style>
@stop
@section('container')
    {{--@include('segments.header',['headerTile'=>'开发记录'])--}}
    <div class=" ">
        <ul class="mui-table-view income-list">
            @if(count($list))
                @foreach($list as $key=>$item)
                    <li style="padding: 22px;margin-bottom: 14px;background-color: #ffffff;border-top: 1px solid #ebeaea;border-bottom:1px solid #ebeaea;" data-id="{{$item->id}}" onclick="goBillDetail('/pages/billdetail/main?id={{$item->id}}')">
                        <div class="cus-row cus-row-v-m">
                            <div class="cus-row-col-6"><span class="fs-14-fc-212229" style="margin-top: 4px;display: inline-block;">助餐服务</span></div>
                            <div class="cus-row-col-6 t-al-r"><a href="tel:{{$item->phone}}" class="fs-14-fc-98CC3D">{{$item->phone}}</a></div>
                        </div>
                        <div class="cus-row cus-row-v-m">
                            <div class="cus-row-col-6"><span class="fs-14-fc-212229" style="margin-top: 4px;display: inline-block;">套餐名称:{{\App\Model\Product::find($item->product_id)->product_name}}</span></div>
                        </div>

                        <div class="cus-row cus-row-v-m">
                            <div class="cus-row-col-6"><span class="fs-14-fc-212229" style="margin-top: 4px;display: inline-block;">服务时间:{{$item->service_start_time}}</span></div>
                        </div>
                    </li>
                    {{--<li class="mui-table-view-cell">--}}
                    {{--<a class="mui-navigate mui-row">--}}
                    {{--<div class="mui-col-sm-3 mui-col-xs-3">@if($item->sub_cash_type == 1) 直 @else 间 @endif <br/> @if($item->sub_cash_type == 1) vip会员 @else 高级会员 @endif </div>--}}
                    {{--<div class="mui-col-sm-3 mui-col-xs-3">{{$item->real_name}}<br/>{{$item->phone}}</div>--}}
                    {{--<div class="mui-col-sm-3 mui-col-xs-3">{{date('Y-m-d',strtotime($item->created_at))}}<br/>{{date('H:i',strtotime($item->created_at))}}</div>--}}
                    {{--<div class="mui-col-sm-3 mui-col-xs-3">￥{{$item->price}}</div>--}}

                    {{--</a>--}}
                    {{--</li>--}}
                @endforeach
            @else
                <div class="t-al-c" style="margin-top: 80px;"><img src="/images/icon_img.png" style="display: inline-block;"/></div>
                <div class="t-al-c" style="margin-top: 24px;"><span style="font-size: 16px;color:#a8a8a8;">暂无内容</span></div>
            @endif
        </ul>
    </div>
@stop

@section('script')
<script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.3.2.js"></script>
<script>
    function goBillDetail(url)
    {
        parent.goBillDetail(url);
        // wx.miniProgram.navigateTo(
        // {
        //     url: url
        // });
    }
</script>
@stop