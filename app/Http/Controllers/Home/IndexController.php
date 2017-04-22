<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/4/22
 * Time: 10:18
 */
namespace App\Http\Controllers\Home;

class IndexController extends BaseController {

    public function index(){
        return view('home/index');
    }

    public function artiList(){

        return view('home/list');
    }

    public function artiNew(){

        return view('home/new');
    }


}