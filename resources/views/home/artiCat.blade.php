@extends('home/layout/home')
@section('info')
    <meta name="keywords" content="个人博客" />
    {{--<meta name="description" content="寻梦主题的个人博客模板，优雅、稳重、大气,低调。" />--}}
@endsection
@section('content')
<article class="blogs">
    <h1 class="t_nav"><span>{{$cat['cat_title']}}</span>
        <a href="{{url('/')}}" class="n1">网站首页</a><a href="{{url('cat/'.$cat['cat_id'])}}" class="n2">{{$cat['cat_name']}}</a></h1>
    <div class="newblog left">
        <?php foreach($arti as $k=>$v): ?>
        <h2>{{$v['arti_title']}}</h2>
        <p class="dateview"><span>发布时间：{{$v['arti_time']}}</span><span>作者：{{$v['arti_editor']}}</span><span>分类：[<a href="/news/life/">{{$cat['cat_name']}}</a>]</span></p>
        <figure><img src="<?php $arr = json_decode($v['arti_thumb']); ?><?php echo 'http://onyvwg7xz.bkt.clouddn.com/'.$arr[0] ?>"></figure>
        <ul class="nlist">
            <p>{{$v['arti_desc']}}</p>
            <a title="" href="{{url('arti/'.$v['arti_id'])}}" target="_blank" class="readmore">阅读全文>></a>
        </ul>
        <div class="line"></div>
            <?php endforeach; ?>

        <div class="blank"></div>

        <div class="page">

         {{$arti->links()}}


        </div>
    </div>
   @endsection

@section('rnav')
        <div class="rnav">
            <ul>
                <?php foreach ($subCats as $k=>$v): ?>
                <li class="rnav{{$k+1}}"><a href="{{url('cat/'.$v['cat_id'])}}" target="_blank">{{$v['cat_name']}}</a></li>
               <?php endforeach; ?>
            </ul>
        </div>
@endsection