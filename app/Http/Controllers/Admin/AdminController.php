<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/4/1
 * Time: 10:01
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Model\Admin;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

require_once 'resources/org/verifyCode/Code.class.php';

class AdminController extends BaseController
{

    public function login()
    {
        if ($input = Input::all()) {
            $code = new \Code;
            if ($code->get() == strtoupper($input['code'])) {
                $admin = Admin::where(['admin_name' => $input['adminName']])->first();

                if ($admin) {
                    if (Crypt::decrypt($admin['password']) == $input['password']) {
                        session(['admin' => $admin]);
                        return redirect('index/index');
                    }
                }
                    return back()->with('msg', '用户名或密码错误');


            } else {
                return back()->with('msg', '验证码错误');
            }

        } else {
            return view('admin/login');
        }

    }

    public function logout(){
        session(['admin'=>null]);
        return redirect('admin/login');
    }

    public function changePsw(){
        if($input = Input::all()){
            $rules = [
                'password_o'=>'required',
                'password'=>  'required|between:3,12|confirmed'
            ];
            $message = [
                'password_o.required'=>'请输入原始密码！',
                'password.required'=>'请输入新密码！',
                'password.between'=>'密码长度必须在3-12位！',
                'password.confirmed'=>'确认密码与新密码不一致！'
            ];

            $validator = Validator::make($input,$rules,$message);
            if($validator->passes()){
                $adminS = session('admin');
                $admin = Admin::where(['admin_id' => $adminS['admin_id']])->first();

                if(Crypt::decrypt($admin['password']) == $input['password_o']){
                    $admin['password'] = Crypt::encrypt($input['password']);
                    $admin->save(); //update亦可
                    return back()->with('msg1','密码修改成功！');
                }else{
                   // return back()->with('errors','原始密码输入错误！');
                   // var_dump($errors);die;
                    return back()->with('msg1','原密码错误！');

                }
            }else{
                return back()->withErrors($validator);
            }

        }else{
            return view('admin/psw');
        }

    }

    public function verifyCode()
    {
        //必须添加路由，才能显示
        $code = new \Code;
        $code->make();
    }



}