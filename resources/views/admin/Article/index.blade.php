@extends('admin/layout/layout1')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('arti/index')}}">首页</a> &raquo; <a href="#"></a> &raquo; 全部分类
    </div>
    <!--面包屑导航 结束-->


    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('arti/add')}}"><i class="fa fa-plus"></i>添加文章</a>
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
                        <th class="tc">ID</th>
                        <th>标题</th>
                        <th>点击次数</th>
                        <th>编者</th>
                        <th>发布时间</th>
                        {{--<th>发布人</th>--}}
                        {{--<th>更新时间</th>--}}
                        {{--<th>评论</th>--}}
                        <th>操作</th>
                    </tr>

                    <?php foreach($artiList as $k=>$v): ?>
                    <tr>
                        <td class="tc"><input type="checkbox" name="id[]" value=""></td>
                        <td class="tc">{{$v['arti_id']}}</td>
                        <td>
                            {{$v['arti_title']}}
                        </td>
                        <td>{{$v['arti_view']}}</td>
                        <td>{{$v['arti_editor']}}</td>
                        <td>{{date('Y-m-d' ,$v['arti_time'])}}</td>
                        {{--<td>2014-03-15 21:11:01</td>--}}
                        {{--<td></td>--}}
                        <td>
                            <a href="{{url('arti/edit/'.$v['arti_id'])}}">修改</a>
                            <a href="{{url('arti/delete/'.$v['arti_id'])}}">删除</a>
                            {{--<a href="javascript:void(0);"  onclick = "deleteCat({{$v['cat_id']}})">删除</a>--}}
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    


                </table>


                <div class="page_list">
                       {{$artiList->links()}}
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



@endsection

