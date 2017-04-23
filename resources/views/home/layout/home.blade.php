<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{\Illuminate\Support\Facades\Config::get('web.web_title')}}</title>
    @yield('info')
    <link href="{{asset('resources/views/home/css/base.css')}}" rel="stylesheet">
    <link href="{{asset('resources/views/home/css/index.css')}}" rel="stylesheet">
    <link href="{{asset('resources/views/home/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('resources/views/home/css/new.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{asset('resources/views/home/js/modernizr.js')}}"></script>
    <![endif]-->
</head>
<body>
<header>
    <div id="logo"><a href="{{url('/')}}"></a></div>
    <nav class="topnav" id="topnav">
        <?php foreach ($navs as $k=>$v): ?>
        <a href="{{$v['links_url']}}"><span>{{$v['links_name']}}</span><span class="en">{{$v['links_desc']}}</span></a>
            <?php endforeach; ?>
    </nav>
</header>

@yield('content')

<aside class="right">
    @yield('rnav')
    <!-- Baidu Button BEGIN -->
    <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
    <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script>
    <script type="text/javascript" id="bdshell_js"></script>
    <script type="text/javascript">
        document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
    </script>
    <!-- Baidu Button END -->
    <div style="float: left;" class="weather"><iframe width="250" scrolling="no" height="60" frameborder="0" allowtransparency="true" src="http://i.tianqi.com/index.php?c=code&id=12&icon=1&num=1"></iframe></div>
    <div class="news">
        <h3>
            <p>最新<span>文章</span></p>
        </h3>
        <ul class="rank">
            <?php foreach($new as $k=>$v): ?>
            <li><a href="{{url('arti/'.$v['arti_id'])}}" title="" target="_blank">{{$v['arti_title']}}</a></li>
            <?php endforeach; ?>
        </ul>
        <h3 class="ph">
            <p>点击<span>排行</span></p>
        </h3>
        <ul class="paih">
            <?php foreach($dianji as $k=>$v): ?>
                <li><a href="{{url('arti/'.$v['arti_id'])}}" title="" target="_blank">{{$v['arti_title']}}</a></li>
                <?php endforeach; ?>
        </ul>
        <h3 class="links">
            <p>友情<span>链接</span></p>
        </h3>
        <ul class="website">
            {{--<li><a href="http://www.houdunwang.com">后盾网</a></li>--}}
            {{--<li><a href="http://bbs.houdunwang.com">后盾论坛</a></li>--}}
        </ul>
    </div>

</aside>
</article>
<footer>
    <p>Design by 张文婷 <a href="http://www.miitbeian.gov.cn/" target="_blank">http://www.baidu.com</a> <a href="/">{{\Illuminate\Support\Facades\Config::get('web.web_count')}}</a></p>
</footer>
{{--<script src="{{asset('resources/views/home/js/silder.js')}}"></script>--}}
</body>
</html>
