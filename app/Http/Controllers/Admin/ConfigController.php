<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/4/20
 * Time: 11:18
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Model\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ConfigController extends BaseController {

    public function index(){
        $data = Config::orderBy('conf_order','asc')->get();
        foreach($data as $k=>$v){
            $html = '';
            if($v['conf_type'] == 'input'){
                $html .= '<input name="conf_content[]" size="50px" value=" '.$v['conf_content'].'" />' ;
            }else if($v['conf_type'] == 'textarea'){
                $html .= '<textarea name="conf_content[]" size="50px" value="'.$v['conf_content'].'" />' ;
                $html .= $v['conf_content'] ;
                $html .= '</textarea>';
            }else{
                $arr = explode('，',$v['conf_value']);
                $str='';
                foreach ($arr as $k1=>$v1){
                    $arr0 = explode('|',$v1);
                    $c='';
                    if($v["conf_content"] == $arr0[0]){
                        $c='checked';
                    }
                    $str .='<input type="radio" name="conf_content[]" '.$c.' value="'.$arr0[0].'">'.$arr0[1].'　　　';
                }
                $html .= $str;
            }
           $v['html'] = $html;
        }
        return view('admin/Config/index')->with('data',$data);
    }

    public function add(){
        if($input = Input::all()){
            $rules=[
                'conf_title' => 'required',
                'conf_name' => 'required'
            ];
            $msg=[
                'conf_title.required' => '请输入配置项标题',
                'conf_name.required' => '请输入配置项变量名'
            ];
            $validate = Validator::make($input,$rules,$msg);
            if($validate->passes()){
                unset($input['_token']);
                Config::insert($input);
                return redirect('conf/index');
            }else{
                return back()->withErrors($validate);
            }
        }

        return view('admin/Config/add');
    }

    public function edit($id){
        $conf = Config::find($id);
        if($input = Input::all()){
            $rules=[
                'conf_title' => 'required',
                'conf_name' => 'required'
            ];
            $msg=[
                'conf_title.required' => '请输入配置项标题',
                'conf_name.required' => '请输入配置项变量名'
            ];
            $validate = Validator::make($input,$rules,$msg);
            if($validate->passes()){
                $conf->update($input);
//                $this->putFile();
                return redirect('conf/index');
            }else{
                return back()->withErrors($validate);
            }
        }
        return view('admin/Config/edit')->with('conf',$conf);
    }

    public function delete($id){
        $conf = Config::find($id);
        if($conf->delete()){
            $data=1;
        }else{
            $data =0;
        }
        return json_encode($data);
    }

    public function changeContent(){
        if($input = Input::all()){
            foreach($input['conf_id'] as $k=>$v){
                $conf = Config::find($v);
                $conf['conf_content'] = $input['conf_content'][$k];
                $conf->update();
//                $this->putFile();
            }
            return redirect('conf/index');
        }
    }

    public function ajaxChangeOrder(){
        $input = Input::all();
        $conf = Config::find($input['id']);
        $conf['conf_order'] = $input['order'];
        if($conf->update()){
            $data = 1;
        }else{
            $data = 0;
        }
        return json_encode($data);
    }

    public function putFile(){
        $path = base_path().'\config\web.php';
        $conf = Config::pluck('conf_content','conf_name')->all();
        $data = '<?php return '. var_export($conf,true) .';';    //var_export()数组转字符串

        //echo \Illuminate\Support\Facades\Config::get('web.web_title');  //配置项的读取
        file_put_contents($path,$data);
    }

}