<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/4/2
 * Time: 10:56
 */
namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

    protected $table='user';
    protected $primaryKey='user_id';

    //public $timestamps = false;

}