@extends('home/layout/home')
@section('info')
    <meta name="keywords" content="个人博客" />
    <meta name="description" content="" />
@endsection
@section('content')
    <article class="blogs">
        <h1 class="t_nav">
            {{--<span>您当前的位置：<a href="{{url('/')}}">首页</a>&nbsp;&gt;&nbsp;<a href="/news/s/">慢生活</a>&nbsp;&gt;&nbsp;<a href="{{url('cate/'.$arti['cat_id'])}}">{{$arti['cat_name']}}</a></span>--}}
            <a href="{{url('/')}}" class="n1">网站首页</a><a href="{{url('cat/'.$arti['cat_id'])}}" class="n2">{{$arti['cat_name']}}</a></h1>
    <div class="index_about">
        <h2 class="c_titile">{{$arti['arti_title']}}</h2>
        <p class="box_c"><span class="d_time">发布时间：{{date('Y-m-d',$arti['arti_time'])}}</span><span>编辑：{{$arti['arti_editor']}}</span><span>查看次数：{{$arti['arti_view']}}</span></p>
        <ul class="infos">
            {!! $arti['arti_content'] !!}

        </ul>
        <div class="keybq">
            <p><span>关键字词</span>：{{$arti['arti_tag']}}</p>

        </div>
        <div class="ad"> </div>
        <div class="nextinfo">
            <?php if(empty($pre)): ?>
                <p>没有上一篇了</p>
                <?php else: ?>
            <p>上一篇：<a href="{{url('arti/'.$pre['arti_id'])}}">{{$pre['arti_title']}}</a></p>
                <?php endif; ?>


                <?php if(empty($next)): ?>
                <p>没有下一篇了</p>
                <?php else: ?>
            <p>下一篇：<a href="{{url('arti/'.$next['arti_id'])}}">{{$next['arti_title']}}</a></p>
                <?php endif; ?>
        </div>
        <div class="otherlink">
            <h2>相关文章</h2>
            <ul>
                <?php foreach($relate as $k =>$v): ?>
                <li><a href="{{url('arti/'.$v['arti_id'])}}" title="{{$v['arti_title']}}">{{$v['arti_title']}}</a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
  @endsection;