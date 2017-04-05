<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/4/3
 * Time: 9:49
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Model\Category;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CategoryController extends BaseController
{

    public function index()
    {
        $catList0 = Category::orderBy('cat_order', 'asc')->get();
        $catList = (new Category)->tree($catList0, $pid = 0);
        return view('admin/category/index')->with('data', $catList);
    }

    public function add()
    {
        if ($input = Input::all()) {
            $rules = [
                'cat_name' => 'required'
            ];
            $msg = [
                'cat_name.required' => '请输入分类名称'
            ];
            $validate = Validator::make($input, $rules, $msg);

            if ($validate->passes()) {
                unset($input['_token']);
                Category::insert($input);
                return redirect('cat/index');
            } else {
                return back()->withInput()->withErrors($validate);
            }

        }

        $catList0 = Category::all();
        $catList = (new Category)->tree($catList0, $pid = 0, $level = 0);
        return view('admin/category/add')->with('catList', $catList);
    }

    public function edit($catId)
    {
        $cat = Category::find($catId);
        if ($input = Input::all()) {
            unset($input['_token']);
            // (new Category)->update($input); //不能这样实例化，否则会新建一条数据
            $cat->update($input);  //不能用save
            return redirect('cat/index');

        }


        $catList0 = Category::all();
        $catList = (new Category)->tree($catList0);

        return view('admin/category/edit')->with('catList', $catList)->with('cat', $cat);
    }


    public function delete($catId)
    {
        $cat = Category::find($catId);
        $child = (new Category)->tree(Category::all(), $catId);
        if (empty($child)) {
            if ($cat->delete()) {
                $data = [
                    'ok' => 1,
                    'msg' => '删除成功'
                ];

            } else {
                $data = [
                    'ok' => 0,
                    'msg' => '删除失败'
                ];
            }

        } else {
            $data = [
                'ok' => 0,
                'msg' => '只能删除叶子节点'
            ];
        }
        return json_encode($data);
    }



    public function changeOrder()
    {
        $input = Input::all();
        $cat = Category::find($input['catId']);
        $cat['cat_order'] = $input['order'];
        $ok = $cat->save();
        if ($ok) {
            $data['ok'] = 1;
            $data['msg'] = '修改成功';
        } else {
            $data['ok'] = 0;
            $data['msg'] = '修改失败';
        }
        return json_encode($data);
    }

}