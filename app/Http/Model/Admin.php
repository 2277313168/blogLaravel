<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/4/2
 * Time: 11:12
 */
namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model {
    protected $table='admin';
    protected $primaryKey='admin_id';
    protected $guarded=[];

    public $timestamps = false; //不加这个，update会出错

}