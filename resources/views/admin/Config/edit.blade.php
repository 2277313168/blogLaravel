@extends('admin/layout/layout1')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">配置项管理</a> &raquo; 添加配置项
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
        {{--<a href="{{url('cat/add')}}"><i class="fa fa-plus"></i>新增配置项</a>--}}
        {{--<a href="#"><i class="fa fa-recycle"></i>批量删除</a>--}}
        {{--<a href="#"><i class="fa fa-refresh"></i>更新排序</a>--}}
        {{--</div>--}}
        {{--</div>--}}
    </div>
    <!--结果集标题与导航组件 结束-->




    <div class="result_wrap">

        <form action="{{url('conf/edit/'.$conf["conf_id"])}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th><i class="require">*</i>标题：</th>
                    <td>
                        <input type="text" name="conf_title" size="50px" value="{{$conf['conf_title']}}">
                        <span><i class="fa fa-exclamation-circle yellow"></i>配置项标题必须填写</span>
                    </td>
                </tr>

                <tr>
                    <th><i class="require">*</i>变量名：</th>
                    <td>
                        <input type="text" name="conf_name" size="50px" value="{{$conf['conf_name']}}">
                        <span><i class="fa fa-exclamation-circle yellow"></i>配置项名称必须填写</span>
                    </td>
                </tr>

                <tr>
                    <th>类型：</th>
                    <td>
                        <input type="radio" name="conf_type" value="input"  onclick="changeType()"  <?php if($conf['conf_type'] == 'input'): ?>checked="checked" <?php endif; ?> />input输入框　　　
                        <input type="radio" name="conf_type" value="textarea" onclick="changeType()" <?php if($conf['conf_type'] == 'textarea'): ?>checked="checked" <?php endif; ?> />textarea文本框　　　
                        <input type="radio" name="conf_type" value="radio" onclick="changeType()"<?php if($conf['conf_type'] == 'radio'): ?>checked="checked" <?php endif; ?>  />radio单选框　　　

                    </td>
                </tr>

                <tr class="conf_value">
                    <th>radio单选框的选项</th>
                    <td>
                        <input type="text" name="conf_value" value="{{$conf['conf_value']}}" size="60px">
                        <p><i class="fa fa-exclamation-circle yellow"></i>只有在类型为radio时才需要填写；1|开启，0|关闭</p>
                    </td>
                </tr>

                <tr>
                    <th>配置项排序：</th>
                    <td>
                        <input type="text" name="conf_order" value="{{$conf['conf_order']}}" size="3px">
                    </td>
                </tr>

                <tr>
                    <th>配置项说明：</th>
                    <td>
                        <textarea name="conf_desc" cols="5" rows="15">{{$conf['conf_desc']}}</textarea>
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
        changeType();
        function changeType() {
            var type = $('input[name=conf_type]:checked').val();
            if(type == 'radio'){
                $('.conf_value').show();
            }else{
               $('.conf_value').hide();
            }

        }

    </script>

@endsection