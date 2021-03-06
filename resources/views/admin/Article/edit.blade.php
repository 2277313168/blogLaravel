@extends('admin/layout/layout1')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">文章管理</a> &raquo; 添加文章
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
        {{--<a href="{{url('cat/add')}}"><i class="fa fa-plus"></i>新增文章</a>--}}
        {{--<a href="#"><i class="fa fa-recycle"></i>批量删除</a>--}}
        {{--<a href="#"><i class="fa fa-refresh"></i>更新排序</a>--}}
        {{--</div>--}}
        {{--</div>--}}
    </div>
    <!--结果集标题与导航组件 结束-->




    <div class="result_wrap">

        <form action="{{url('arti/edit/'.$arti['arti_id'])}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th><i class="require">*</i>文章标题：</th>
                    <td>
                        <input type="text" class="lg" name="arti_title" value="{{$arti['arti_title']}}">
                        <span><i class="fa fa-exclamation-circle yellow"></i>文章标题必须填写</span>
                    </td>
                </tr>

                <tr>
                    <th width="120">类别：</th>
                    <td>
                        <select name="cat_id">
                            <?php foreach($catList as $k=>$v): ?>
                            <option value="{{$v['cat_id']}}"
                            <?php if($v['cat_id'] == $arti['cat_id']): ?>
                            selected = 'selected'
                                    <?php endif; ?>
                            ><?php echo str_repeat('|---',$v['level']); ?>{{$v['cat_name']}}</option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <th>编者：</th>
                    <td>
                        <input type="text" name="arti_editor" value="{{$arti['arti_editor']}}">
                    </td>
                </tr>

                <tr>
                    <th>标签：</th>
                    <td>
                        <input type="text" class="lg" name="arti_tag" value="{{$arti['arti_tag']}}">
                        <p>可以写30个字</p>
                    </td>


                <tr>
                    <th>文章描述：</th>
                    <td>
                        <textarea name="arti_desc" >{{$arti['arti_desc']}}</textarea>
                        <p>可以写30个字</p>
                    </td>
                </tr>

                <tr id="keyInput">
                </tr>

                <tr>
                <th>缩略图：</th>
                <td>
                    <script src="{{asset('resources/org/uploadify/jquery.uploadify.min.js')}}" type="text/javascript"></script>
                    <link rel="stylesheet" type="text/css" href="{{asset('resources/org/uploadify/uploadify.css')}}">



                    <input id="file_upload" name="file_upload" type="file" multiple="true">

                    {{--<span style="border-left: 2px;"></span>--}}


                    <script type="text/javascript">
                        <?php $timestamp = time();?>
                        $(function() {
                            $('#file_upload').uploadify({
                                'buttonText'   : '上传图片',
                                'formData'     : {
                                    'timestamp' : '<?php echo $timestamp;?>',
                                    '_token'     : "{{csrf_token()}}"
                                },
                                'swf'      : "{{asset('resources/org/uploadify/uploadify.swf')}}",
                                'uploader' :  "{{url('base/upload')}}",
                                'onUploadSuccess' : function(file, data, response) {
                                    if(data == 0){
                                        alert('上传失败');
                                    }else{
                                        //上传成功后执行的ajax命令
                                        //alert(data);
                                        $('input[name=arti_thumb]').val(data);
                                        var src_data = "http://onyvwg7xz.bkt.clouddn.com/"+data ;
                                        //alert(src_data);
                                        var htmlData = '';
                                        htmlData += '<span  class="arti_thumb_span" style="border-left: 2px;">';
                                        htmlData +=  '<input name="arti_thumb[]" value="'+data+'"  type="hidden" />';
                                        htmlData += '<img class="arti_thumb_img" src=" ' + src_data+ '  " style="max-height: 80px;max-width: 60px"  />';
                                        htmlData += '<input type="button" onclick="deleteImg('+data+')"  value="删除图片"  />.';
                                        htmlData += '</span>';


                                        $('td[id=tr_img]').append(htmlData);
                                    }

                                    $('input[name=arti_thumb]').val(data);



                                }
                            });
                        });
                    </script>

                    <style>
                        .uploadify{display:inline-block;}
                        .uploadify-button{border:none; border-radius:5px; margin-top:8px;}
                        table.add_tab tr td span.uploadify-button-text{color: #FFF; margin:0;}
                    </style>

                </td>

                </tr>
                    <td></td>
                <td id="tr_img" >
                    <?php if(json_decode($arti['arti_thumb']) != NULL): ?>
                    <?php foreach (json_decode($arti['arti_thumb']) as $k=>$v): ?>
                    <?php $src_img = "http://onyvwg7xz.bkt.clouddn.com/".str_replace(' ','',$v) ; ?>
                        <span  class="arti_thumb_span" style="border-left: 2px;">
                        <img class='arti_thumb_img' src="{{$src_img}}"  style="max-height: 60px;max-width: 40px"  />
                        <input name="arti_thumb[]" value="<?php echo str_replace(' ','',$v)?>"  type="hidden" />
                        <input type="button" onclick="deleteImg(this)"  id="{{$arti['arti_id']}}"  key="{{str_replace(' ','',$v) }}" value="删除图片"  />
                         </span>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </td>

                <tr>
                    <th>内容：</th>
                    <td>
                        <textarea id='arti_content' name="arti_content">{{$arti['arti_content']}}</textarea>

                        <script>
                            UE.getEditor('arti_content', {
                                "initialFrameWidth" : "80%",
                                "initialFrameHeight" : 600,
                                "maximumWords" : 15000
                            });
                        </script>
                        <style>
                            .edui-default{line-height: 28px;}
                            div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
                            {overflow: hidden; height:20px;}
                            div.edui-box{overflow: hidden; height:22px;}
                        </style>
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

        <script>
            function deleteImg(obj) {
                var key = $(obj).attr('key');
                var id = $(obj).attr('id');

                alert(id);
                alert(key);
                $.ajax({
                    {{--url : "{{url('base/deleteQiniu').'/'}}"+key ,--}}
                    url : "{{url('arti/ajaxDeleteImg/')}}",
                    type : 'post',
                    data : {
                        '_token': '{{csrf_token()}}',
                        'id' : id,
                        'key' : key
                    },
                    dataType : 'Json',
                    success :function (data) {
                        if(data == true){
                            var spanObj = $(this).parent('.arti_thumb_span');
                            alert($(spanObj).attr(class));
                            $(spanObj).empty();
                        }
                    }

                })
            }
        </script>

    </div>

@endsection