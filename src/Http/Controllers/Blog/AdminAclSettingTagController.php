<?php

namespace Pigs\AdminAclSetting\Http\Controllers\Blog;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Pigs\AdminAclSetting\Http\Requests\AdmAclTagRequest;

class AdminAclSettingTagController extends Controller
{
    public function index(Request $request)
    {
        try {
            $tags = DB::table(config('adm_acl_setting_config.blog.table.tags'))->orderByDesc('id')
                ->paginate($request->page_size ?? 20);

            $viewData = [
                'tags'  => $tags,
                "query" => $request->query()
            ];

            return view('adm_acl_setting::pages.blog.tag.index', $viewData);
        } catch (\Exception $exception) {
            Log::error("[AdminAclSettingTagController][index] === [Message] === ".
                $exception->getMessage()." === [Line] === ".
                $exception->getLine());
        }
    }

    public function create(Request $request) {
        return view('adm_acl_setting::pages.blog.tag.create');
    }

    public function store(AdmAclTagRequest $request)
    {
        try {
            $data = $request->except("_token");
            $data['slug'] = Str::slug($request->name);
            $data["created_at"] = Carbon::now();
            $data["title_seo"] = $request->name;
            DB::table(config('adm_acl_setting_config.blog.table.tags'))->insert($data);
            return redirect()->route('get.adm_acl_setting.tag.index');
        } catch (\Exception $exception) {
            Log::error("[BlogAdminTagController][store] === [Message] === ".
                $exception->getMessage()." === [Line] === ".
                $exception->getLine());
        }
        return redirect()->back();
    }

    public function edit(Request $request, $id) {
        $tag = DB::table(config('adm_acl_setting_config.blog.table.tags'))->where("id", $id)->first();
        return view('adm_acl_setting::pages.blog.tag.update', compact('tag'));
    }

    public function update(AdmAclTagRequest $request, $id)
    {
        try {
            $data = $request->except("_token");
            $data['slug'] = Str::slug($request->name);
            $data["created_at"] = Carbon::now();
            $data["title_seo"] = $request->name;
            DB::table(config('adm_acl_setting_config.blog.table.tags'))->where("id", $id)->update($data);
            return redirect()->route('get.adm_acl_setting.tag.index');
        } catch (\Exception $exception) {
            Log::error("[BlogAdminTagController][store] === [Message] === ".
                $exception->getMessage()." === [Line] === ".
                $exception->getLine());
        }
        return redirect()->back();
    }

    public function delete(Request $request, $id)
    {
        try {
            $tag =DB::table(config('adm_acl_setting_config.blog.table.tags'))->where("id", $id)->delete();
            return redirect()->route('get.adm_acl_setting.tag.index');
        } catch (\Exception $exception) {
            Log::error("[BlogAdminTagController][delete] === [Message] === ".
                $exception->getMessage()." === [Line] === ".
                $exception->getLine());
        }
    }
}
