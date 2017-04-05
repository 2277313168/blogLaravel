<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/4/3
 * Time: 10:03
 */
namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    protected $table = 'category';
    protected $primaryKey = 'cat_id';
    protected $guarded=[];  //MassAssignmentException

    public $timestamps = false; //不加这个，save会出错

    public function tree($arr,$pid=0,$level=0){
        static $res = array();
        foreach($arr as $k=>$v){
            if($v['cat_pid'] == $pid){
                $v['level'] = $level;
                $res[] = $v;
                $this->tree($arr,$v['cat_id'],$level+1 );
            }
        }
        return $res;
    }


}