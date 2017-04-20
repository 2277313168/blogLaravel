<?php

use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('links')->insert([

                [
                    'links_name' => '西电睿思',
                    'links_desc' => '爱生活，爱西电，爱睿思',
                    'links_url' => 'http://rs.xidian.edu.cn/portal.php',
                    'links_order' => 1,
                ],
                [
                    'links_name' => '七牛',
                    'links_desc' => '七牛云存储开发者中心',
                    'links_url' => 'https://portal.qiniu.com/bucket/blogimages/resource',
                    'links_order' => 2,
                ]

            ]
        );
    }
}
