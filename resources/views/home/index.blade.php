@extends('home/layout/home')
@section('info')
    <meta name="keywords" content="{{\Illuminate\Support\Facades\Config::get('web.keywords')}}" />
    {{--<meta name="description" content="寻梦主题的个人博客模板，优雅、稳重、大气,低调。" />--}}
@endsection
@section('content')
<div class="banner">
    <section class="box">
        <ul class="texts">
            <p>打了死结的青春，捆死一颗苍白绝望的灵魂。</p>
            <p>为自己掘一个坟墓来葬心，红尘一梦，不再追寻。</p>
            <p>加了锁的青春，不会再因谁而推开心门。</p>
        </ul>
        <div class="avatar"><a href="#"><span>张文婷</span></a> </div>
    </section>
</div>
<div class="template">
    <div class="box">
        <h3>
            <p><span>最热</span>文章</p>
        </h3>
        <ul>
            <?php foreach($hot as $k=>$v):  ?>
            <li><a href="{{url('arti/'.$v['arti_id'])}}"  target="_blank"><img  src="<?php $arr = json_decode($v['arti_thumb']); ?><?php echo 'http://onyvwg7xz.bkt.clouddn.com/'.$arr[0] ?>"></a><span>{{$v['arti_title']}}</span></li>
                <?php endforeach; ?>
            {{--<li><a href="/" target="_blank"><img src="images/02.jpg"></a><span>黑色质感时间轴html5个人博客模板</span></li>--}}
            {{--<li><a href="/"  target="_blank"><img src="images/03.jpg"></a><span>Green绿色小清新的夏天-个人博客模板</span></li>--}}
            {{--<li><a href="/" target="_blank"><img src="images/04.jpg"></a><span>女生清新个人博客网站模板</span></li>--}}
            {{--<li><a href="/"  target="_blank"><img src="images/02.jpg"></a><span>黑色质感时间轴html5个人博客模板</span></li>--}}
            {{--<li><a href="/"  target="_blank"><img src="images/03.jpg"></a><span>Green绿色小清新的夏天-个人博客模板</span></li>--}}
        </ul>
    </div>
</div>
<article>
    <h2 class="title_tj">
        <p>文章<span>推荐</span></p>
    </h2>
    <div class="bloglist left">
        <?php foreach($reco as $k=>$v): ?>
        <h3>{{$v['arti_title']}}</h3>
        <figure><img src="<?php $arr = json_decode($v['arti_thumb']); ?><?php echo 'http://onyvwg7xz.bkt.clouddn.com/'.$arr[0] ?>"></figure>
        <ul>
            <p>{{$v['arti_desc']}}</p>
            <a title="/" href="{{url('arti/'.$v['arti_id'])}}" target="_blank" class="readmore">阅读全文>></a>
        </ul>
        <p class="dateview"><span><?php echo "&nbsp;" ?>{{ date('Y-m-d',$v['arti_time'])}}</span><span>作者：{{$v['arti_editor']}}</span></p>
       <?php endforeach; ?>

            <div class="page">
                {{$reco->links()}}
            </div>

    </div>
 @endsection