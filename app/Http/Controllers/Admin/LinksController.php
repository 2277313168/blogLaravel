<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/4/19
 * Time: 15:46
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\BaseController;
use App\Http\Model\Links;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


class LinksController extends BaseController{

    public function add(){
        if($input = Input::all()){
            $rules=[
                'links_name' => 'required',
                'links_url'  => 'required'
            ];
            $msg=[
                'links_name.required' => '链接名称必填',
                'links_url.required' => '链接名称必填',
            ];
            $validate = Validator::make($input,$rules,$msg);

            if($validate->passes()){
                unset($input['_token']);
                Links::insert($input);
                return redirect('links/index');
            }else{
                return back()->withErrors($validate);
            }

        }

        return view('admin/links/add');
    }

    public function index(){
        $links = Links::orderBy('links_order','asc')->get();

        return view('admin/links/index')->with('links',$links);
    }

    public function edit($id){
        $links=Links::find($id);
        if($input = Input::all()){
            $rules=[
                'links_name' => 'required',
                'links_url'  => 'required'
            ];
            $msg=[
                'links_name.required' => '链接名称必填',
                'links_url.required' => '链接名称必填',
            ];
            $validate = Validator::make($input,$rules,$msg);
            if($validate->passes()){
                $links->update($input);
                return redirect('links/index');
            }else{
                return back()->withErrors($validate);
            }
        }


        return view('admin/links/edit')->with('links',$links);
    }


    public function delete($id){
        $links=Links::find($id);
        if($links->delete()){
            $data=1;
        }else{
            $data=0;
        }
        return json_encode($data);
    }



    public function ajaxChangeOrder(){
        $input = Input::all();
        $link = Links::find($input['id']);
        $link['links_order'] = $input['order'];
        $ok = $link->save();
        return json_encode($ok);
    }


}