@extends('admin/layout/layout1')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">链接管理</a> &raquo; 添加链接
    </div>
    <!--面包屑导航 结束-->

    <!--结果集标题与导航组件 开始-->
    <div class="result_wrap">
        <div class="result_title">


            <?php if(count($errors) > 0): ?>
            <div class="mark">
                <?php foreach (($errors->all()) as $k=>$v): ?>
                <p>{{$v}}</p>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>


        {{--<div class="result_content">--}}
        {{--<div class="short_wrap">--}}
        {{--<a href="{{url('cat/add')}}"><i class="fa fa-plus"></i>新增链接</a>--}}
        {{--<a href="#"><i class="fa fa-recycle"></i>批量删除</a>--}}
        {{--<a href="#"><i class="fa fa-refresh"></i>更新排序</a>--}}
        {{--</div>--}}
        {{--</div>--}}
    </div>
    <!--结果集标题与导航组件 结束-->




    <div class="result_wrap">

        <form action="{{url('links/edit/'.$links['links_id'])}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th><i class="require">*</i>链接名称：</th>
                    <td>
                        <input type="text" name="links_name" size="50px" value="{{$links['links_name']}}">
                        <span><i class="fa fa-exclamation-circle yellow"></i>链接名称必须填写</span>
                    </td>
                </tr>

                <tr>
                    <th><i class="require">*</i>URL地址：</th>
                    <td>
                        {{url('/')}}<input type="text" size="15px" name="links_url" value="{{$links['links_url']}}">
                        <span><i class="fa fa-exclamation-circle yellow"></i>链接地址必须填写</span>
                    </td>
                </tr>


                <tr>
                    <th>链接描述：</th>
                    <td>
                        <input type="text" name="links_desc" size="50px" value="{{$links['links_desc']}}">
                    </td>
                </tr>

                <tr>
                    <th>链接排序：</th>
                    <td>
                        <input type="text" name="links_order" value="0" size="3px" value="{{$links['links_order']}}">
                    </td>
                </tr>






                <td>
                    <input type="submit" value="提交">
                    <input type="button" class="back" onclick="history.go(-1)" value="返回">
                </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>

    <script>

    </script>

@endsection