@extends('admin/layout/layout1')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('conf/index')}}">首页</a> &raquo; <a href="#"></a> &raquo; 全部配置项
    </div>
    <!--面包屑导航 结束-->


    <!--搜索结果页面 列表 开始-->

    <div class="result_wrap">
        <!--快捷导航 开始-->
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('conf/add')}}"><i class="fa fa-plus"></i>添加配置项</a>
                <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
            </div>
        </div>
        <!--快捷导航 结束-->
    </div>

    <div class="result_wrap">
        <div class="result_content">
            <form action="{{url('conf/changeContent')}}" method="post">
                {{csrf_field()}}
                <table class="list_tab">
                    <tr>
                        <th class="tc" width="5%"><input type="checkbox" name=""></th>
                        <th class="tc">排序</th>
                        <th>名称</th>
                        <th>变量名</th>
                        <th>内容</th>

                        <th>操作</th>
                    </tr>


                    <?php foreach($data as $k=>$v): ?>
                    <tr>
                        <td class="tc"><input type="checkbox" name="id[]" value=""></td>
                        <td class="tc">
                            <input type="text" onchange="ajaxChangeOrder(this,{{$v['conf_id']}})" name="order[]"
                                   value="{{$v['conf_order']}}">
                        </td>
                        <td>
                            {{$v['conf_title']}}
                        </td>
                        <td>{{$v['conf_name']}}</td>
                        <td>
                            <input type="hidden" name="conf_id[]" value=" {{$v['conf_id']}}"/>
                            {!!$v['html']!!}
                        </td>
                        <td>
                            <a href="{{url('conf/edit/'.$v['conf_id'])}}">修改</a>
                            <a href="javascript:void(0);" onclick="deleteLinks({{$v['conf_id']}})">删除</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>


                </table>
                </br></br>
                <tr>
                    <input type="submit" value="提交">
                    <input type="button" class="back" onclick="history.go(-1)" value="返回">
                </tr>
            </form>


            <div class="page_list">
                {{--{{$confList->conf()}}--}}
            </div>
        </div>
    </div>

    <!--搜索结果页面 列表 结束-->
    <style>
        .result_content ul li span {
            font-style: 15px;
            padding: 6px 12px;
        }
    </style>


    <script>
        function ajaxChangeOrder(obj, conf_id) {
            var order = $(obj).val();
            $.ajax({
                url: "{{url('conf/ajaxChangeOrder')}}",
                type: 'POST',
                data: {
                    '_token': "{{csrf_token()}}",
                    'id': conf_id,
                    'order': order
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data == 1) {
                        location.href = location.href;
                    } else {
                        alert('修改排序失败');
                    }

                }

            })
        }

        function deleteLinks(id) {
            //询问框
            layer.confirm('您确认删除该分类吗？', {
                btn: ['是', '否'] //按钮
            }, function () {
                $.ajax({
                    url: "{{url('conf/delete')}}" + '/' + id,
                    dataType: 'Json',
                    type: 'GET',
                    success: function (data) {
                        if (data == 1) {
                            location.href = location.href;
                            layer.msg('删除成功', {icon: 6});
                        } else {
                            layer.msg('删除失败', {icon: 5});
                        }
                    }
                });
            })
        }


    </script>



@endsection

