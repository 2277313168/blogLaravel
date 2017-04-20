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


// 引入鉴权类
use Qiniu\Auth;
// 引入上传类
use Qiniu\Storage\UploadManager;
use Qiniu\Storage\BucketManager;


class BaseController extends Controller
{
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

    //上传图片到服务器
//    public function upload(){
//        $file = Input::file('Filedata');
//        if( $file->isValid() ){  //判断文件是否有效
//            $realPath=$file->getRealPath();                 //缓存在tmp文件夹下临时文件的绝对路径
//            $entension=$file->getClientOriginalExtension();  //上传文件的后缀
//
//            $newName = date('YmdHms').mt_rand(100,999).'.'.$entension; //年月日+时分秒+3位的随机数，以保证文件命名不同
//            $path = $file->move(base_path().'\storage\uploads',$newName);
//            return 'storage/uploads'.'/'.$newName;
//        }
//    }

    //上传图片到七牛
    //多幅图片上传，自动调用upload多次
    public function upload()
    {
        $file = Input::file('Filedata');


        require_once __DIR__ .'/../../../vendor/Qiniu_sdk/autoload.php';

        // 需要填写你的 Access Key 和 Secret Key
        $accessKey = '3UqPa31k1QlsFpnPl3zIbSMb4KJh_SQy3PCXdTCp';
        $secretKey = 'mGmv7e_dm4zfr0LFF6pyljwdG97-vRKITe6Bm4u-';

        // 构建鉴权对象
        $auth = new Auth($accessKey, $secretKey);

        // 要上传的空间
        $bucket = 'blogimages';

        // 生成上传 Token
        $token = $auth->uploadToken($bucket);

        // 要上传文件的本地路径
        $filePath = $file->getRealPath();

        // 上传到七牛后保存的文件名
        $key = date('YmdHis').'_'.mt_rand(100,999);

        // 初始化 UploadManager 对象并进行文件的上传。
        $uploadMgr = new UploadManager();

        // 调用 UploadManager 的 putFile 方法进行文件的上传。
        list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);

        if ($err !== null) {
            //var_dump($err);
           $data = 0;
        } else {
            $data = $key;
        }
        return $data;
    }


    public function deleteQiniu($key){

        require_once __DIR__ .'/../../../vendor/Qiniu_sdk/autoload.php';

        // 需要填写你的 Access Key 和 Secret Key
        $accessKey = '3UqPa31k1QlsFpnPl3zIbSMb4KJh_SQy3PCXdTCp';
        $secretKey = 'mGmv7e_dm4zfr0LFF6pyljwdG97-vRKITe6Bm4u-';

        //初始化Auth状态：
        $auth = new Auth($accessKey, $secretKey);

        //初始化BucketManager
        $bucketMgr = new BucketManager($auth);

        //你要测试的空间， 并且这个key在你空间中存在
        $bucket =  'blogimages';
        //$key = 'php-logo.png';

        //删除$bucket 中的文件 $key
        $err = $bucketMgr->delete($bucket, $key);

//        if ($err !== null) {
//            var_dump($err);
//        } else {
//            echo "Success!";
//        }

    }

}