<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/4/1
 * Time: 10:02
 */
namespace App\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;


class BaseController extends Controller  {
//    public function __construct()
//{
//    //parent::__construct();
//
//    if(session('admin') == null){
//        var_dump(session('admin'));
//        echo 'baseController';
//        return redirect('admin/login');
//    }
//}

    //上传图片
    public function upload(){
        $file = Input::file('Filedata');
        if( $file->isValid() ){  //判断文件是否有效
            $realPath=$file->getRealPath();                 //缓存在tmp文件夹下临时文件的绝对路径
            $entension=$file->getClientOriginalExtension();  //上传文件的后缀

            $newName = date('YmdHms').mt_rand(100,999).'.'.$entension; //年月日+时分秒+3位的随机数，以保证文件命名不同
            $path = $file->move(base_path().'\storage\uploads',$newName);
            return 'storage/uploads'.'/'.$newName;
        }
    }

}