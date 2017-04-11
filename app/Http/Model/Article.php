<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/4/10
 * Time: 20:21
 */
namespace App\Http\Model;
use Illuminate\Database\Eloquent\Model;

class Article extends Model {
    protected $table = 'article';
    protected $primaryKey = 'arti_id';
    protected $guarded =[];

    public $timestamps = false;
}