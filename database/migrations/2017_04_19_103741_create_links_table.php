<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
//            $table->engine = "MyISAM" ;
            $table->increments('links_id');
            $table->string('links_name')->default('')->comment('//友情链接名称');
            $table->string('links_desc')->default('')->comment('//友情链接描述');
            $table->string('links_url')->default('')->comment('//链接地址');
            $table->integer('links_order')->default(0)->comment('//排序');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
