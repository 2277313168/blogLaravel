<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/4/22
 * Time: 10:18
 */
namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use App\Http\Model\Category;

class IndexController extends BaseController {

    public function index(){
        //热门文章
        $hot = Article::orderBy('arti_view','desc')->take(6)->get();

        //推荐文章
        $reco = Article::orderBy('arti_time','desc')->paginate(5);

        //最新列表
        $new = Article::orderBy('arti_time','desc')->take(7)->get();

        return view('home/index')->with('hot',$hot)->with('reco',$reco)->with('new',$new);
    }



    public function artiCat($cat_id){
        //浏览次数加1
        Category::where('cat_id','=',$cat_id)->increment('cat_view',1);

        $cat = Category::find($cat_id);
        $subCats= Category::where('cat_pid',$cat_id)->get();

        $catArr=[];
        $catArr[0] = $cat_id;
        foreach($subCats as $k=>$v){
            $catArr[$k+1] = $v['cat_id'];
        }

       $arti = Article::whereIn('cat_id',$catArr)->orderBy('arti_time','desc')->paginate(5);
//        $arti = Article::Join('category','article.cat_id','=','category.cat_id')->whereIn('cat_id',$catArr)->orderBy('arti_time','desc')->paginate(5);


        return view('home/artiCat')->with('arti',$arti)->with('cat',$cat)->with('subCats',$subCats);
    }




    public function artiNew($arti_id){
//        $arti0 = Article::Join('category','article.cat_id','=','category.cat_id')->where('arti_id',$arti_id)->get(); //得到的是数组
//        var_dump($arti0);
        $arti = Article::Join('category','article.cat_id','=','category.cat_id')->where('arti_id',$arti_id)->first();

        $preArti = Article::where('cat_id',$arti['cat_id'])
            ->where(function ($query) use ($arti_id){
                $query->where('arti_id','>',$arti_id);
            })->orderBy('arti_id','asc')->first();

        $nextArti = Article::where('cat_id','=',$arti['cat_id'])
            ->where(function ($query) use ($arti_id){
            $query->where('arti_id','<',$arti_id);
        })->orderBy('arti_id','desc')->first();


        //相关文章
        $relateArti = Article::where('cat_id','=',$arti['cat_id'])->orderBy('arti_time','desc')->take(6)->get();


        //浏览次数加1
        Article::where('arti_id',$arti_id)->increment('arti_view',1);

        return view('home/new')->with('arti',$arti)->with('pre',$preArti)->with('next',$nextArti)->with('relate',$relateArti);
    }


}