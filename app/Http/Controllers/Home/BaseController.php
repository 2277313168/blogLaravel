<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/4/22
 * Time: 10:17
 */
namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use App\Http\Model\Category;
use App\Http\Model\Links;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

class BaseController extends Controller {

    public function __construct()
    {
        //导航
//        $cat = (new Category)->getFather(Category::all());
//        View::share('navs',$cat);
        $links = Links::all();
        View::share('navs',$links);

        //最新文章列表
        $new = Article::orderBy('arti_time','desc')->take(8)->get();
        View::share('new',$new);

        //点击排行
        $dianji = Article::orderBy('arti_view','desc')->take(5)->get();
        View::share('dianji',$dianji);


    }
}