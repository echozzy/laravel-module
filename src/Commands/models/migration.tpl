<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    //提交
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cat_id')->comment('文章分类ID');
            $table->string('title','150')->comment('标题');
            $table->string('author','50')->nullable()->comment('作者');
            $table->string('thumb','150')->nullable()->comment('缩略图');
            $table->text('content')->nullable()->comment('内容');
            $table->string('keywords','255')->comment('seo keywords');
            $table->string('description','255')->comment('简介描述');
            $table->tinyInteger('is_show')->default(1)->comment('是否显示;1显示;0不显示');
            $table->tinyInteger('is_recommend')->default(0)->comment('是否推荐;1:推荐;0:不推荐');
            $table->unsignedInteger('clicks')->comment('查看次数,点击数');
            $table->unsignedInteger('likes')->comment('点赞数');
            $table->unsignedInteger('favorites')->comment('收藏数');
            $table->unsignedInteger('comment_count')->comment('评论数');
            $table->timestamps();
        });
    }

    //回滚
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
