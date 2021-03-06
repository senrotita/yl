@extends('admin.master',['headerTitle'=>'会员管理'])
@section('style')
    <style>
        .mb-12{
            margin-bottom: 12px;
        }

        .t-al-r{text-align: right;}

        .user-list-item{font-size: 14px;padding: 6px 2px;}
        .user-list-item:hover{background-color: #f5f5f5}
    </style>
@stop
@section('left_content')
    <div class="mt-32 padding-col">
        <h4>会员信息</h4>
        <div class="row m-t-20">
            <div class="col-md-12 col-lg-12">

                <form class="form-inline" id="search_form">
                    <div class="form-group">
                        <label for="dtp_input2" class="col-md-2 control-label" style="width: 120px;
    padding: 0;
    text-align: left;">奖金</label>
                        <div class="input-group">
                            <select type="text" class="form-control" name="charge" id="exampleInputAmount">
                                <option></option>
                                <option value="0" {{(\Illuminate\Support\Facades\Request::input('charge') === '0')?' selected':''}}>否</option>
                                <option value="1" {{(\Illuminate\Support\Facades\Request::input('charge') == 1)?' selected':''}}>是</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group v-a-b">
                        <div class="input-group">
                            <input type="text" class="form-control" id="exampleInputAmount" name="keyword" placeholder="输入姓名、手机号搜索" value="{{\Illuminate\Support\Facades\Request::input('keyword')}}">
                            <div class="input-group-addon" onclick="search()"><i class="fa fa-search"></i></div>
                        </div>
                    </div>

                    <div class="form-group v-a-b">
                        <div class="input-group">
                            <a class="btn btn-info" href="javascript:commonDownload()">下载</a>
                        </div>
                    </div>
                </form>
            </div>


            {{--<div class="col-md-2 col-lg-2">--}}
            {{--<a class="btn btn-info" href="javascript:commonDownload()">下载</a>--}}
            {{--</div>--}}
        </div>
        <div class="block-card">
            <div class="row paginate-list-row">
                <div class="col-md-2 col-lg-2">ID</div>
                <div class="col-md-2 col-lg-2">标题\</div>
                <div class="col-md-1 col-lg-1">主讲人</div>
                <div class="col-md-1 col-lg-1">讲课时间</div>
            </div>
            @foreach($paginate as $item)
                <div class="row paginate-list-row" onclick="goDetail({{$item->id}})">
                    <div class="col-md-2 col-lg-2">{{$item->id}}</div>
                    <div class="col-md-2 col-lg-2">{{$item->title}}</div>
                    <div class="col-md-1 col-lg-1">{{$item->owner_name}}</div>
                    <div class="col-md-1 col-lg-1">{{$item->open_time}}</div>
                </div>
            @endforeach
        </div>

        <div class="fl-r"><?php echo $paginate->appends(\Illuminate\Support\Facades\Request::all())->render(); ?></div>

    </div>

    <div style="position: fixed;right: 60px;bottom: 60px;">
        <div style="width: 56px;height:56px;border-radius:96px;background-color:#697b8c; "><a style="width: 100%;display: block;line-height: 56px;text-align: center;font-size: 40px;color:#ffffff;" href="javascript:openAddMember()"><i class="fa fa-plus"></i></a></div>
    </div>

    <div style="position: fixed;top:0;bottom:0;left:0;right: 0;background-color: rgba(0,0,0,.6);z-index: 99;display: none;" id="add_member_panel">
        <div style="padding: 14px;background-color: #ffffff;border-radius: 8px;transform: translate(-50%,-50%);position: absolute;top:50%;left: 50%;width: 540px;">
            <h4>新增会员</h4>
            <form id="data_form">

                <div class="row mb-12" id="up_user_phone_panel">
                    <div class="col-md-3 col-lg-3 t-al-r">上级手机号:</div>
                    <div class="col-md-9 col-lg-9" style="position: relative;">
                        <input class="form-control" name="new_user_up_phone" readonly/>

                        <div style="position: absolute;left:15px;right: 15px;top: 36px;padding: 12px;border: 1px solid rgb(211,211,211);height: 300px;background-color: #ffffff;z-index: 999;overflow: scroll;display: none;" id="user_list_scroll">
                            <input class="form-control" name="search_user"/>
                            <div id="user-list">
                                {{--<div class="user-list-item">18681224578-水水-510322198712324712</div>--}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-12">
                    <div class="col-md-3 col-lg-3 t-al-r">新会员手机:</div>
                    <div class="col-md-9 col-lg-9">
                        <input class="form-control" name="new_user_phone"/>
                    </div>
                </div>

                <div class="row mb-12">
                    <div class="col-md-3 col-lg-3 t-al-r">姓名:</div>
                    <div class="col-md-9 col-lg-9">
                        <input class="form-control" name="new_user_real_name"/>
                    </div>
                </div>
                <div class="row mb-12">
                    <div class="col-md-3 col-lg-3 t-al-r">身份证:</div>
                    <div class="col-md-9 col-lg-9">
                        <input class="form-control" name="new_user_id_card"/>
                    </div>
                </div>

                <div class="row mb-12">
                    <div class="col-md-3 col-lg-3 t-al-r">报单库存:</div>
                    <div class="col-md-9 col-lg-9">
                        <input class="form-control" name="get_good" value="0"/>
                    </div>
                </div>

                <div class="row mb-12">
                    <div class="col-md-3 col-lg-3 t-al-r">复购库存:</div>
                    <div class="col-md-9 col-lg-9">
                        <input class="form-control" name="re_get_good" value="0"/>
                    </div>
                </div>

            </form>
            <div>
                <button type="button" class="btn btn-success col-gray-btn mt-32" id="next_step">确认</button>
                <button type="button" class="btn btn-success col-gray-btn mt-32" onclick="closeAddMember()">取消</button>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>

        var pageConfig = {
            user_list:{!! json_encode(DB::table('users')->whereIn('vip_level',[\App\Model\User::LEVEL_MASTER,\APP\Model\User::LEVEL_VIP])->selectRaw('phone,id_card,real_name')->orderBy('id','desc')->get()) !!}
        }


        $(document).click(function(e){
            e = window.event || e; // 兼容IE7
            obj = $(e.srcElement || e.target);
            if ($(obj).is("#up_user_phone_panel,#up_user_phone_panel *")) {
                // alert('内部区域');
                console.log('内部区域');
            } else {
                console.log('你的点击不在目标区域');
                if($('#user_list_scroll').css('display') == 'block') {
                    $('#user_list_scroll').hide();
                }
            }
        });

        // $('#add_member_panel').click(function(){
        //     console.log();
        //     if($('#user_list_scroll').css('display') == 'block') {
        //              $('#user_list_scroll').hide();
        //     }
        // });
        // $('body').on('click',function(e){
        //     if( e.target !== $('#user_list_scroll') ){
        //
        //         if($('#user_list_scroll').css('display') == 'block') {
        //             $('#user_list_scroll').hide();
        //         }
        //         // if($('#user_list_scroll').isShow()) {
        //         //     $('#user_list_scroll').hide();
        //         // }
        //     }
        // });

        $('body').on('click','.user-list-item',function(){
            $('input[name="new_user_up_phone"]').val( $(this).attr('data-phone') );
            $('#user_list_scroll').hide();
        });

        $('input[name="new_user_up_phone"]').click(function(){
            // console.log(456);
            if($('#user_list_scroll').css('display') == 'block') {
                $('#user_list_scroll').hide();
            }else {
                $('#user_list_scroll').show();
            }
        });
        ;


        $('input[name="search_user"]').bind('input propertychange', function() {
            // console.log($(this).val());
            changeUserList($(this).val());
        });

        // $('#user_list_scroll').hide(function()
        // {
        //     // alert(123);
        //     // changeUserList();
        //     console.log(456);
        //     $('input[name="search_user"]').val('');
        //     changeUserList();
        // });

        // $('#user_list_scroll').blur(function(){
        //     // alert(123);
        //     console.log(456);
        // });
        //
        // $('input[name="new_user_up_phone"]').blur(function(){
        //     // console.log(123);
        //     $('#user_list_scroll').hide();
        // });

        changeUserList();

        function changeUserList(searchVal)
        {
            $('input[name="search_user"]').val();

            var innerHtml = '';

            $.each(pageConfig.user_list,function(ind,obj){

                if(searchVal) {
                    var showFlag = false;

                    if ( obj.phone === null || obj.phone.indexOf(searchVal) != 0 )
                    {

                    } else {
                        showFlag = true;
                    }


                    if ( obj.real_name === null || obj.real_name.indexOf(searchVal) != 0 )
                    {

                    } else {
                        showFlag = true;
                    }

                    if ( obj.id_card === null || obj.id_card.indexOf(searchVal) != 0 )
                    {

                    } else {
                        showFlag = true;
                    }

                    if( ! showFlag )
                    {
                        return true;
                    }

                    // if( obj.phone.indexOf(searchVal) != 0 && obj.real_name.indexOf(searchVal) != 0 &&  obj.id_card.indexOf(searchVal) != 0 ) {
                    //     return;
                    // }
                }

                innerHtml += '<div class="user-list-item" data-phone="'+obj.phone+'">' + obj.phone + '-' + obj.real_name + '-'+obj.id_card+'</div>';
            });

            console.log(innerHtml);
            $('#user-list').html('');
            $('#user-list').html(innerHtml);
        }

        // changeUserList();



        function goDetail(id)
        {
            location.href = '/admin/index/member-detail?user_id=' + id;
        }

        // $('#add_member_panel').show();

        function closeAddMember()
        {
            $('#add_member_panel').hide();
        }

        function openAddMember()
        {
            $('#add_member_panel').show();
        }

        function search()
        {
//    alert(1);
//    $val = $('#search_user').val();
            $('#search_form').submit();

        }


        new SubmitButton({
            selectorStr:'#next_step',
            url:'/admin/index/add-user',
            prepositionJudge:function()
            {
                if(!(/^1[3|4|5|8|7][0-9]\d{8}$/.test($('input[name="new_user_phone"]').val()))) {
                    mAlert('请输入正确的手机号');
                    return false;
                }

                if(!($('input[name="new_user_real_name"]').val())) {
                    mAlert('请输入姓名');
                    return;
                }

                if(!/^(^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$)|(^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])((\d{4})|\d{3}[Xx])$)$/.test($('input[name="new_user_id_card"]').val())){
                    mAlert('请输入正确的身份证号');
                    return;
                }

                return true;
            },
            callback:function(el,data)
            {
                if(data.status){
                    mAlert('添加成功');
                    location.href="/admin/index/members";
                } else {
                    mAlert(data.desc);
                }
            },
            data:function(){
                return $('#data_form').serialize();
            }
        });


    </script>
@stop