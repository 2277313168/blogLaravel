<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/4/2
 * Time: 17:26
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\BaseController;

class IndexController extends BaseController  {
    public function index(){
//        var_dump($_SERVER);die;
        return view('admin/index');
    }

    public function info(){
        return view('admin/info');
    }
}