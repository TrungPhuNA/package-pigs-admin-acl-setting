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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("slug")->unique();
            $table->string("description")->nullable();
            $table->tinyInteger("status")->default(1);
            $table->timestamps();
        });
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("slug")->unique();
            $table->string("method")->default("GET");
            $table->string("group")->nullable();
            $table->integer("sort")->default(1);
            $table->string("description")->nullable();
            $table->tinyInteger("status")->default(1);
            $table->timestamps();
        });

        Schema::create('roles_permissions', function (Blueprint $table) {
            $table->id();
            $table->integer("role_id")->index();
            $table->integer("permission_id")->index();
        });

        Schema::create('accounts_roles', function (Blueprint $table) {
            $table->id();
            $table->integer("account_id")->index();
            $table->integer("role_id")->index();
        });
        Schema::create('accounts_permission', function (Blueprint $table) {
            $table->id();
            $table->integer("account_id")->index();
            $table->integer("permission_id")->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('roles_permissions');
        Schema::dropIfExists('accounts_roles');
        Schema::dropIfExists('accounts_permission');
    }
};
