@extends('admin/layout/layout1')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('links/index')}}">首页</a> &raquo; <a href="#"></a> &raquo; 全部链接
    </div>
    <!--面包屑导航 结束-->


    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('links/add')}}"><i class="fa fa-plus"></i>添加链接</a>
                    <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                    <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc" width="5%"><input type="checkbox" name=""></th>
                        <th class="tc">排序</th>
                        <th>名称</th>
                        <th>链接</th>
                        <th>描述</th>
                        {{--<th>发布时间</th>--}}
                        {{--<th>发布人</th>--}}
                        {{--<th>更新时间</th>--}}
                        {{--<th>评论</th>--}}
                        <th>操作</th>
                    </tr>

                    <?php foreach($links as $k=>$v): ?>
                    <tr>
                        <td class="tc"><input type="checkbox" name="id[]" value=""></td>
                        <td class="tc">
                            <input type="text" onchange="changeOrder(this,{{$v['links_id']}})"  name="order[]" value="{{$v['links_order']}}">
                        </td>
                        <td>
                            {{$v['links_name']}}
                        </td>
                        <td>{{$v['links_url']}}</td>
                        <td>{{$v['links_desc']}}</td>
                        {{--<td>{{date('Y-m-d' ,$v['links_time'])}}</td>--}}
                        {{--<td>2014-03-15 21:11:01</td>--}}
                        {{--<td></td>--}}
                        <td>
                            <a href="{{url('links/edit/'.$v['links_id'])}}">修改</a>
                            <a href="javascript:void(0);"  onclick = "deleteLinks({{$v['links_id']}})">删除</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    


                </table>


                <div class="page_list">
                       {{--{{$linksList->links()}}--}}
                </div>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->
<style>
    .result_content ul li span {
        font-style: 15px;
        padding: 6px 12px;
    }
</style>


    <script>
        function changeOrder(obj,id) {
            var order = $(obj).val();
            $.ajax({
                url : "{{url('links/ajaxChangeOrder')}}" ,
                data : {
                    '_token' : "{{csrf_token()}}" ,
                    'id' : id,
                    'order' : order
                },
                type : 'POST',
                dataType : 'JSON',
                success: function (data) {
                    if(data == 1){
                        location.href = location.href;
                    }
                }
            })
        }

        function deleteLinks(id) {
            layer.confirm('您确认删除该分类吗？', {
                btn: ['是', '否'] //按钮
            }, function () {
                $.ajax({
                    url : "{{url('links/delete')}}" + '/'+id,
                    type:'GET',
                    dataType: 'JSON',
                    success:function (data) {
                        if(data == 1){
                            location.href = location.href;
                            layer.msg('删除成功', {icon: 6});
                        }else{
                            layer.msg('删除失败', {icon: 5});
                        }
                    }

                })

            })
        }


    </script>



@endsection

