<?php

namespace Pigs\AdminAclSetting\Command;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Pigs\AdminAclSetting\Models\Permission;

class AclSeedPermissionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'adm-acl:seed-permission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed permission';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("========= INIT ======");
        $permissions = [
            [
                "name"        => "full",
                "group"       => "full",
                "method"      => "other",
                "description" => "Toàn quyền"
            ],
            [
                "name"        => "get.adm_acl_setting.permission.index",
                "group"       => "permission",
                "method"      => "GET",
                "description" => "Danh sách quyền"
            ],
            [
                "name"        => "get.adm_acl_setting.permission.create",
                "group"       => "permission",
                "method"      => "GET",
                "description" => "Render view thêm mới quyền"
            ],
            [
                "name"        => "get.adm_acl_setting.permission.store",
                "group"       => "permission",
                "method"      => "POST",
                "description" => "Thêm mới quyền"
            ],
            [
                "name"        => "get.adm_acl_setting.permission.update",
                "group"       => "permission",
                "method"      => "GET",
                "description" => "Cập nhật quyền"
            ],
            [
                "name"        => "get.adm_acl_setting.permission.delete",
                "group"       => "permission",
                "method"      => "GET",
                "description" => "Xoá nhật quyền"
            ],
            [
                "name"        => "get.adm_acl_setting.role.index",
                "group"       => "role",
                "method"      => "GET",
                "description" => "Danh sách nhóm quyền"
            ],
            [
                "name"        => "get.adm_acl_setting.role.create",
                "group"       => "role",
                "method"      => "GET",
                "description" => "Render view tạo nhóm quyền"
            ],
            [
                "name"        => "get.adm_acl_setting.role.store",
                "group"       => "role",
                "method"      => "POST",
                "description" => "Tạo nhóm quyền"
            ],
            [
                "name"        => "get.adm_acl_setting.role.update",
                "group"       => "role",
                "method"      => "GET",
                "description" => "Cập nhật nhóm quyền"
            ],
            [
                "name"        => "get.adm_acl_setting.role.delete",
                "group"       => "role",
                "method"      => "GET",
                "description" => "Xoá  nhóm quyền"
            ],
            [
                "name"        => "get.adm_acl_setting.user.index",
                "group"       => "user",
                "method"      => "GET",
                "description" => "Danh sách thành viên"
            ],
            [
                "name"        => "get.adm_acl_setting.user.create",
                "group"       => "user",
                "method"      => "GET",
                "description" => "Render view thêm mới thành viên"
            ],
            [
                "name"        => "get.adm_acl_setting.user.store",
                "group"       => "user",
                "method"      => "POST",
                "description" => "Thêm mới thành viên"
            ],
            [
                "name"        => "get.adm_acl_setting.user.update",
                "group"       => "user",
                "method"      => "GET",
                "description" => "Cập nhật thành viên"
            ],
            [
                "name"        => "get.adm_acl_setting.user.delete",
                "group"       => "user",
                "method"      => "GET",
                "description" => "Xoá thành viên"
            ],
            [
                "name"        => "get.adm_acl_setting.tag.index",
                "group"       => "tag",
                "method"      => "GET",
                "description" => "Danh sách từ khoá"
            ],
            [
                "name"        => "get.adm_acl_setting.tag.create",
                "group"       => "tag",
                "method"      => "POST",
                "description" => "Thêm mới từ khoá"
            ],
            [
                "name"        => "get.adm_acl_setting.tag.update",
                "group"       => "tag",
                "method"      => "GET",
                "description" => "Cập nhật từ khoá"
            ],
            [
                "name"        => "get.adm_acl_setting.tag.delete",
                "group"       => "tag",
                "method"      => "GET",
                "description" => "Xoá từ khoá"
            ],
            [
                "name"        => "get.adm_acl_setting.menu.index",
                "group"       => "menu",
                "method"      => "GET",
                "description" => "Danh sách menu"
            ],
            [
                "name"        => "get.adm_acl_setting.menu.create",
                "group"       => "menu",
                "method"      => "POST",
                "description" => "Thêm mới menu"
            ],
            [
                "name"        => "get.adm_acl_setting.menu.update",
                "group"       => "menu",
                "method"      => "GET",
                "description" => "Cập nhật menu"
            ],
            [
                "name"        => "get.adm_acl_setting.menu.delete",
                "group"       => "menu",
                "method"      => "GET",
                "description" => "Xoá từ menu"
            ],
            [
                "name"        => "get.adm_acl_setting.article.index",
                "group"       => "article",
                "method"      => "GET",
                "description" => "Danh sách bài viết"
            ],
            [
                "name"        => "get.adm_acl_setting.article.create",
                "group"       => "article",
                "method"      => "POST",
                "description" => "Thêm mới bài viết"
            ],
            [
                "name"        => "get.adm_acl_setting.article.update",
                "group"       => "article",
                "method"      => "GET",
                "description" => "Cập nhật bài viết"
            ],
            [
                "name"        => "get.adm_acl_setting.article.delete",
                "group"       => "article",
                "method"      => "GET",
                "description" => "Xoá từ bài viết"
            ],
        ];
        foreach ($permissions as $item) {
            $this->warn("============= PERMISSION : ". $item['name']);
            $item["slug"]= Str::slug($item['name']);
            $check = Permission::where("slug", $item['slug'])->first();
            if(!$check) {
                Permission::create($item);
            }
        }
    }
}
