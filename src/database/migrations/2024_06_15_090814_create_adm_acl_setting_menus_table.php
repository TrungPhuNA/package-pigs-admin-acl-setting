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
        Schema::create('setting_menus_sidebar', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("icon")->nullable();
            $table->integer("parent_id")->default(0)->index();
            $table->string("link_value")->nullable();
            $table->tinyInteger("type")->default(1);
            $table->integer("sort")->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting_menus_sidebar');
    }
};
