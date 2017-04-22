<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/4/20
 * Time: 11:35
 */
namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Config extends Model {
    protected $table = 'config';
    protected $primaryKey = 'conf_id';
    protected $guarded = [];

    public $timestamps =false;
}