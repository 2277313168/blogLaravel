@extends('admin/layout/layout1')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/index')}}">首页</a> &raquo; <a href="#"></a> &raquo; 全部分类
    </div>
    <!--面包屑导航 结束-->

	<!--结果页快捷搜索框 开始-->
	<div class="search_wrap">
        <form action="" method="post">
            <table class="search_tab">
                <tr>
                    <th width="120">选择分类:</th>
                    <td>
                        <select onchange="javascript:location.href=this.value;">
                            <option value="">全部</option>
                            <option value="http://www.baidu.com">百度</option>
                            <option value="http://www.sina.com">新浪</option>
                        </select>
                    </td>
                    <th width="70">关键字:</th>
                    <td><input type="text" name="keywords" placeholder="关键字"></td>
                    <td><input type="submit" name="sub" value="查询"></td>
                </tr>
            </table>
        </form>
    </div>
    <!--结果页快捷搜索框 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('cat/add')}}"><i class="fa fa-plus"></i>添加分类</a>
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
                        <th class="tc">ID</th>
                        <th>分类名称</th>
                        <th>标题</th>
                        <th>点击</th>
                        {{--<th>发布人</th>--}}
                        {{--<th>更新时间</th>--}}
                        {{--<th>评论</th>--}}
                        <th>操作</th>
                    </tr>

                    <?php foreach($data as $k=>$v): ?>
                    <tr>
                        <td class="tc"><input type="checkbox" name="id[]" value="59"></td>
                        <td class="tc">
                            <input type="text" onchange="changeOrder(this,{{$v['cat_id']}})"  name="ord[]" value="{{$v['cat_order']}}">
                        </td>
                        <td class="tc">{{$v['cat_id']}}</td>
                        <td>
                            <a href="#"><?php echo str_repeat('|---',$v['level']) ?>{{$v['cat_name']}}</a>
                        </td>
                        <td>{{$v['cat_title']}}</td>
                        <td>{{$v['cat_view']}}</td>
                        {{--<td>admin</td>--}}
                        {{--<td>2014-03-15 21:11:01</td>--}}
                        {{--<td></td>--}}
                        <td>
                            <a href="{{url('cat/edit/'.$v['cat_id'])}}">修改</a>
                            {{--<a href="{{url('cat/delete/'.$v['cat_id'])}}">删除</a>--}}
                            <a href="javascript:void(0);"  onclick = "deleteCat({{$v['cat_id']}})">删除</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    


                </table>


<div class="page_nav">
<div>
<a class="first" href="/wysls/index.php/Admin/Tag/index/p/1.html">第一页</a> 
<a class="prev" href="/wysls/index.php/Admin/Tag/index/p/7.html">上一页</a> 
<a class="num" href="/wysls/index.php/Admin/Tag/index/p/6.html">6</a>
<a class="num" href="/wysls/index.php/Admin/Tag/index/p/7.html">7</a>
<span class="current">8</span>
<a class="num" href="/wysls/index.php/Admin/Tag/index/p/9.html">9</a>
<a class="num" href="/wysls/index.php/Admin/Tag/index/p/10.html">10</a> 
<a class="next" href="/wysls/index.php/Admin/Tag/index/p/9.html">下一页</a> 
<a class="end" href="/wysls/index.php/Admin/Tag/index/p/11.html">最后一页</a> 
<span class="rows">11 条记录</span>
</div>
</div>



                <div class="page_list">
                    <ul>
                        <li class="disabled"><a href="#">&laquo;</a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">&raquo;</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->


    <script>

        function changeOrder(obj,id) {
           var order= $(obj).val();

            $.ajax({
                url : "{{url('cat/changeOrder')}}" ,
                type : 'POST' ,
                data : {'_token':'{{csrf_token()}}',
                     'order': order,
                    'catId' : id
                   },
                dataType : 'json',
                success : function (data) {
                   // alert(data['msg']);
                    if(data['ok']){
                        layer.msg(data['msg'], {icon: 6});
                    }else{
                        layer.msg(data['msg'], {icon: 5});
                    }
                }

            })
        }


        function deleteCat(catId) {
            //询问框
            layer.confirm('您确认删除该分类吗？', {
                btn: ['是', '否'] //按钮
            }, function () {
                $.ajax({
                    url: "{{url('cat/delete')}}" + '/' + catId,
                    type: 'GET',
                    dataType: 'Json',
                    success: function (data) {
                        if (data['ok']) {
                            layer.msg(data['msg'], {icon: 6});
                            {{--location.href= "{{url('cat/index')}}" ;--}}
                            location.href = location.href;
                        } else {
                            layer.msg(data['msg'], {icon: 5});
                        }
                    }
                })
            });
        }



    </script>


@endsection

