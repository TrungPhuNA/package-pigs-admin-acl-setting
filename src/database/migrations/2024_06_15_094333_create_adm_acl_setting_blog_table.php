<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(config('adm_acl_setting_config.blog.table.menu'), function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->unique();
            $table->tinyInteger('status')->default(1);
            $table->integer('parent_id')->default(0)->index();
            $table->string('description')->nullable();
            $table->text('content')->nullable();
            $table->string('title_seo')->nullable();
            $table->string('description_seo')->nullable();
            $table->string('image_seo')->nullable();
            $table->tinyInteger('index')->default(1);
            $table->timestamps();
        });

        Schema::create(config('adm_acl_setting_config.blog.table.tags'), function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->unique();
            $table->tinyInteger('status')->default(1);
            $table->integer('parent_id')->default(0)->index();
            $table->string('description')->nullable();
            $table->text('content')->nullable();
            $table->string('title_seo')->nullable();
            $table->string('description_seo')->nullable();
            $table->string('image_seo')->nullable();
            $table->tinyInteger('index')->default(1);
            $table->timestamps();
        });
        Schema::create(config('adm_acl_setting_config.blog.table.articles'), function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->unique();
            $table->tinyInteger('status')->default(1);
            $table->integer('parent_id')->default(0)->index();
            $table->string('description')->nullable();
            $table->text('content')->nullable();
            $table->integer('menu_id')->default(0)->index();
            $table->string('title_seo')->nullable();
            $table->string('description_seo')->nullable();
            $table->string('image_seo')->nullable();
            $table->tinyInteger('index')->default(1);
            $table->timestamps();
        });
        Schema::create(config('adm_acl_setting_config.blog.table.articles_tags'), function (Blueprint $table) {
            $table->id();
            $table->integer('tag_id')->default(0);
            $table->integer('article_id')->default(0);
            $table->unique(['tag_id', 'article_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(config('adm_acl_setting_config.blog.table.menu'));
        Schema::dropIfExists(config('adm_acl_setting_config.blog.table.tags'));
        Schema::dropIfExists(config('adm_acl_setting_config.blog.table.articles'));
        Schema::dropIfExists(config('adm_acl_setting_config.blog.table.articles_tags'));
    }
};
