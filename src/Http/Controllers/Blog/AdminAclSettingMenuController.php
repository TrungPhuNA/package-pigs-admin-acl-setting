<?php

namespace Pigs\AdminAclSetting\Http\Controllers\Blog;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Pigs\AdminAclSetting\Http\Requests\AdmAclMenuRequest;

class AdminAclSettingMenuController extends Controller
{
    public function index(Request $request)
    {
        try {
            $tags = DB::table(config('adm_acl_setting_config.blog.table.menu'))->orderByDesc('id')
                ->paginate($request->page_size ?? 20);

            $route = route('get.adm_acl_setting.menu.create');
            $viewData = [
                'tags'  => $tags,
                'route' => $route,
                "query" => $request->query()
            ];

            return view('adm_acl_setting::pages.blog.menu.index', $viewData);
        } catch (\Exception $exception) {
            Log::error("[AdminAclSettingMenuController][index] === [Message] === ".
                $exception->getMessage()." === [Line] === ".
                $exception->getLine());
        }
    }

    public function create(Request $request)
    {
        return view('adm_acl_setting::pages.blog.menu.create');
    }

    public function store(AdmAclMenuRequest $request)
    {
        try {
            $data = $request->except("_token");
            $data['slug'] = Str::slug($request->name);
            $data["created_at"] = Carbon::now();
            $data["title_seo"] = $request->name;
            DB::table(config('adm_acl_setting_config.blog.table.menu'))->insert($data);
            return redirect()->route('get.adm_acl_setting.menu.index');
        } catch (\Exception $exception) {
            Log::error("[AdminAclSettingMenuController][store] === [Message] === ".
                $exception->getMessage()." === [Line] === ".
                $exception->getLine());
        }

        return redirect()->back();
    }

    public function edit(Request $request, $id)
    {
        $tags = DB::table(config('adm_acl_setting_config.blog.table.menu'))->orderByDesc('id')
            ->paginate($request->page_size ?? 20);

        $route = route('get.adm_acl_setting.menu.update', $id);

        $menu = DB::table(config('adm_acl_setting_config.blog.table.menu'))->where("id", $id)->first();
        $viewData = [
            "tags" => $tags,
            "route" => $route,
            "menu" => $menu
        ];
        return view('adm_acl_setting::pages.blog.menu.update', $viewData);
    }

    public function update(AdmAclMenuRequest $request, $id)
    {
        try {
            $data = $request->except("_token");
            $data['slug'] = Str::slug($request->name);
            $data["created_at"] = Carbon::now();
            $data["title_seo"] = $request->name;
            DB::table(config('adm_acl_setting_config.blog.table.menu'))->where("id", $id)->update($data);
            return redirect()->route('get.adm_acl_setting.menu.index');
        } catch (\Exception $exception) {
            Log::error("[AdminAclSettingMenuController][store] === [Message] === ".
                $exception->getMessage()." === [Line] === ".
                $exception->getLine());
        }
        return redirect()->back();
    }

    public function delete(Request $request, $id)
    {
        try {
            DB::table(config('adm_acl_setting_config.blog.table.menu'))->where("id", $id)->delete();
            return redirect()->route('get.adm_acl_setting.menu.index');
        } catch (\Exception $exception) {
            Log::error("[AdminAclSettingMenuController][delete] === [Message] === ".
                $exception->getMessage()." === [Line] === ".
                $exception->getLine());
        }
        return redirect()->back();
    }
}
