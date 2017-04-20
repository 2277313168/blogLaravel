<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/4/4
 * Time: 10:09
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Model\Article;
use App\Http\Model\Category;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ArticleController extends BaseController {

    public function index(){
        $data = Article::orderBy('arti_id','desc')-> paginate(5);
        return view('admin/Article/index')->with('artiList',$data);
    }

    public function add(){
        if($input = Input::all()){
   //         var_dump($input);
            $rules =[
                'arti_title' => 'required',
                'arti_content' => 'required'
            ];
            $msg = [
                'arti_title.required' => '标题名称不能为空',
                'arti_content.required' => '文章内容不能为空'
            ];
            $validator = Validator::make($input,$rules,$msg);
            if($validator->passes()){
                unset($input['_token']);
                $input['arti_time'] = time();

                if(! isset($input['arti_thumb'])){
                    $input['arti_thumb'] = NULL;
                }else{
                    $input['arti_thumb']=json_encode($input['arti_thumb']);
                }
                Article::insert($input);
                return redirect('arti/index');
            }else{
                foreach($input['arti_thumb'] as $k=>$v){
                   $this->deleteQiniu($v);
                }
                return back()->withErrors($validator);
            }

        }
        $catList0 = Category::orderBy('cat_order','asc')->get();
        $catList= (new Category)->tree($catList0,0,0);
        return view('admin/Article/add')->with('catList',$catList);
    }

    public function edit($id){
        $arti = Article::find($id);
        if($input = Input::all()){
            $rules =[
                'arti_title' => 'required',
                'arti_content' => 'required'
            ];
            $msg = [
                'arti_title.required' => '标题名称不能为空',
                'arti_content.required' => '分类名称不能为空'
            ];
            $validator = Validator::make($input,$rules,$msg);

            if($validator->passes()){
                unset($input['_token']);
                $input['arti_time'] = time();

                if(! isset($input['arti_thumb'])){
                    $input['arti_thumb'] = NULL;
                }else{
                    $input['arti_thumb']=json_encode($input['arti_thumb']);
                }
                $arti->update($input);
                return redirect('arti/index');
            }else{
                return back()->withErrors($validator);
            }
        }


        $catList0 = Category::orderBy('cat_order','asc')->get();
        $catList= (new Category)->tree($catList0,0,0);
        return view('admin/Article/edit')->with('catList',$catList)->with('arti',$arti);
    }

    public function ajaxDeleteImg(){
        $post = Input::all();
        $arti = Article::find($post['id']);
        $arr = json_decode($arti['arti_thumb']);
        foreach($arr as $k=>$v){
            if($v == $post['key']){
                unset($arr[$k]);
            }
        }
        $arti['arti_thumb'] = json_encode($arr);
        $res = $arti->update();
        $this->deleteQiniu($post['key']);

        return json_encode($res);

    }

    public function delete($id){
        $arti = Article::find($id);
        $keyArr = json_decode($arti['arti_thumb']);
        if(! empty($keyArr)){
            foreach($keyArr as $k=>$v ){
                $this->deleteQiniu($v);
            }
        }


        if($arti->delete()){
            $data = 1;
        }else{
            $data = 0;
        }
        return json_decode($data);

    }

}