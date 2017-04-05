<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/4/4
 * Time: 10:09
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Model\Category;
use Illuminate\Support\Facades\Input;

class ArticleController extends BaseController {

    public function index(){

    }

    public function add(){
        if($input = Input::all()){
            var_dump($input);
        }
        $catList0 = Category::orderBy('cat_order','asc')->get();
        $catList= (new Category)->tree($catList0,0,0);
        return view('admin/Article/add')->with('catList',$catList);
    }

}