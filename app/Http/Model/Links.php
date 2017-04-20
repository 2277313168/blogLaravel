<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/4/19
 * Time: 15:48
 */
namespace App\Http\Model;
use Illuminate\Database\Eloquent\Model;

class Links extends Model{
    protected $table = 'links';
    protected $primaryKey = 'links_id';
    protected $guarded=[];

    public $timestamps = false;
}