@extends('admin/layout/layout1')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">商品管理</a> &raquo; 添加商品
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
        {{--<a href="{{url('cat/add')}}"><i class="fa fa-plus"></i>新增分类</a>--}}
        {{--<a href="#"><i class="fa fa-recycle"></i>批量删除</a>--}}
        {{--<a href="#"><i class="fa fa-refresh"></i>更新排序</a>--}}
        {{--</div>--}}
        {{--</div>--}}
    </div>
    <!--结果集标题与导航组件 结束-->




    <div class="result_wrap">

        <form action="{{url('cat/edit/'.$cat['cat_id'])}}" method="post">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th><i class="require">*</i>分类名称：</th>
                    <td>
                        <input type="text" name="cat_name" value="{{$cat['cat_name']}}">
                        <span><i class="fa fa-exclamation-circle yellow"></i>分类名称必须填写</span>
                    </td>
                </tr>

                <tr>
                    <th width="120"><i class="require">*</i>上级分类：</th>
                    <td>
                        <select name="cat_pid">
                            <option value="0">---顶级分类---</option>
                            <?php foreach($catList as $k=>$v): ?>
                            <option value="{{$v['cat_id']}}"   <?php if($v['cat_id'] == $cat['cat_pid']): ?>selected="selected"<?php endif; ?>  ><?php echo str_repeat('|---', $v['level']) ?>{{$v['cat_name']}}</option>
                            <?php endforeach; ?>
                            {{--<option value="20">推荐界面</option>--}}
                        </select>
                    </td>
                </tr>

                <tr>
                    <th>标题：</th>
                    <td>
                        <input type="text" class="lg" name="cat_title" value="{{$cat['cat_title']}}">
                        <p>标题可以写30个字</p>
                    </td>
                </tr>

                <tr>
                    <th>关键词：</th>
                    <td>
                        <input type="text" class="lg" name="cat_keywords" value="{{$cat['cat_keywords']}}">
                        <p>可以写30个字</p>
                    </td>


                <tr>
                    <th>分类描述：</th>
                    <td>
                        <input type="text" class="lg" name="cat_desc" value="{{$cat['cat_desc']}}">
                        <p>可以写30个字</p>
                    </td>
                </tr>

                <tr>
                    <th>分类排行：</th>
                    <td>
                        <input type="text" class="sm" name="cat_order" value="{{$cat['cat_order']}}">
                        <span><i class="fa fa-exclamation-circle yellow"></i>请输入整数</span>
                    </td>
                </tr>


                {{--<tr>--}}
                {{--<th>作者：</th>--}}
                {{--<td>--}}
                {{--<input type="text" name="">--}}
                {{--<span><i class="fa fa-exclamation-circle yellow"></i>这里是默认长度</span>--}}
                {{--</td>--}}
                {{--</tr>--}}

                {{--<tr>--}}
                {{--<th><i class="require">*</i>缩略图：</th>--}}
                {{--<td><input type="file" name=""></td>--}}
                {{--</tr>--}}
                {{--<tr>--}}
                {{--<th>单选框：</th>--}}
                {{--<td>--}}
                {{--<label for=""><input type="radio" name="">单选按钮一</label>--}}
                {{--<label for=""><input type="radio" name="">单选按钮二</label>--}}
                {{--</td>--}}
                {{--</tr>--}}
                {{--<tr>--}}
                {{--<th>复选框：</th>--}}
                {{--<td>--}}
                {{--<label for=""><input type="checkbox" name="">复选框一</label>--}}
                {{--<label for=""><input type="checkbox" name="">复选框二</label>--}}
                {{--</td>--}}
                {{--</tr>--}}
                {{--<tr>--}}
                {{--<th>描述：</th>--}}
                {{--<td>--}}
                {{--<textarea name="discription"></textarea>--}}
                {{--</td>--}}
                {{--</tr>--}}
                {{--<tr>--}}
                {{--<th>详细内容：</th>--}}
                {{--<td>--}}
                {{--<textarea class="lg" name="content"></textarea>--}}
                {{--<p>标题可以写30个字</p>--}}
                {{--</td>--}}
                {{--</tr>--}}
                {{--<tr>--}}
                {{--<th></th>--}}


                <td>
                    <input type="submit" value="提交">
                    <input type="button" class="back" onclick="history.go(-1)" value="返回">
                </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>

@endsection