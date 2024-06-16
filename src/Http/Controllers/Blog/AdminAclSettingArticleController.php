<?php

namespace Pigs\AdminAclSetting\Http\Controllers\Blog;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Pigs\BlogAdmin\Enums\EnumAdmBlog;

class AdminAclSettingArticleController extends Controller
{
    public function index(Request $request)
    {
        try {
            $articles = DB::table(config('adm_acl_setting_config.blog.table.articles'))->orderByDesc('id')
                ->paginate($request->page_size ?? 20);

            $viewData = [
                'articles' => $articles,
                "query"    => $request->query()
            ];

            return view('adm_acl_setting::pages.blog.article.index', $viewData);
        } catch (\Exception $exception) {
            Log::error("[BlogAdminArticlesController][index] === [Message] === ".
                $exception->getMessage()." === [Line] === ".
                $exception->getLine());
        }
    }

    public function create(Request $request)
    {
        try {
            $menus = DB::table(config('adm_acl_setting_config.blog.table.menu'))->where("status",
                EnumAdmBlog::STATUS_PUBLISHED)->get();
            $tags = DB::table(config('adm_acl_setting_config.blog.table.tags'))->where("status",
                EnumAdmBlog::STATUS_PUBLISHED)->get();
            $viewData = [
                "menus"     => $menus,
                "tags"      => $tags,
                "tagActive" => []
            ];
            return view('adm_acl_setting::pages.blog.article.create', $viewData);
        } catch (\Exception $exception) {
            Log::error("[BlogAdminArticlesController][store] === [Message] === ".
                $exception->getMessage()." === [Line] === ".
                $exception->getLine());
        }
    }

    public function edit(Request $request, $id)
    {
        $article = DB::table(config('adm_acl_setting_config.blog.table.articles'))->where("id", $id)->first();

        $menus = DB::table(config('adm_acl_setting_config.blog.table.menu'))->where("status",
            EnumAdmBlog::STATUS_PUBLISHED)->get();

        $tags = DB::table(config('adm_acl_setting_config.blog.table.tags'))->where("status",
            EnumAdmBlog::STATUS_PUBLISHED)->get();
        $tagActive = DB::table(config('adm_acl_setting_config.blog.table.articles_tags'))->where("article_id", $id)
            ->pluck("tag_id")->toArray();

        $viewData = [
            "menus"     => $menus,
            "tags"      => $tags,
            "article"   => $article,
            "tagActive" => $tagActive,
        ];
        return view('adm_acl_setting::pages.blog.article.update', $viewData);
    }

    public function store(Request $request)
    {
        try {
            $data = $request->except("_token", "tags");
            $data['slug'] = Str::slug($request->name);
            $data["created_at"] = Carbon::now();
            $data["title_seo"] = $request->name;
            $data["description_seo"] = $request->description;
            $idInsert = DB::table(config('adm_acl_setting_config.blog.table.articles'))->insertGetId($data);
            if ($idInsert) {
                $tags = $request->tags ?? [];
                if (!empty($tags)) {
                    foreach ($tags as $item) {
                        DB::table(config('adm_acl_setting_config.blog.table.articles_tags'))->insert([
                            "article_id" => $idInsert,
                            "tag_id"     => $item,
                            "created_at" => Carbon::now()
                        ]);
                    }
                }
            }
            return redirect()->route('get.adm_acl_setting.article.index');
        } catch (\Exception $exception) {
            Log::error("[BlogAdminArticlesController][store] === [Message] === ".
                $exception->getMessage()." === [Line] === ".
                $exception->getLine());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->except("_token", "tags");
            $data['slug'] = Str::slug($request->name);
            $data["created_at"] = Carbon::now();
            $data["title_seo"] = $request->name;
            $data["description_seo"] = $request->description;

            $check = DB::table(config('adm_acl_setting_config.blog.table.articles'))->where("id", $id)->update($data);
            if ($check) {
                $tags = $request->tags ?? [];
                if (!empty($tags)) {
                    DB::table(config('adm_acl_setting_config.blog.table.articles_tags'))->where([
                        "article_id" => $id,
                    ])->delete();
                    foreach ($tags as $item) {
                        DB::table(config('adm_acl_setting_config.blog.table.articles_tags'))->insert([
                            "article_id" => $id,
                            "tag_id"     => $item,
                            "created_at" => Carbon::now()
                        ]);
                    }
                }
            }
            return redirect()->route('get.adm_acl_setting.article.index');
        } catch (\Exception $exception) {
            Log::error("[BlogAdminArticlesController][store] === [Message] === ".
                $exception->getMessage()." === [Line] === ".
                $exception->getLine());
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            DB::table(config('adm_acl_setting_config.blog.table.articles'))->where("id", $id)->delete();
            return redirect()->route('get.adm_acl_setting.article.index');
        } catch (\Exception $exception) {
            Log::error("[BlogAdminArticlesController][delete] === [Message] === ".
                $exception->getMessage()." === [Line] === ".
                $exception->getLine());
        }
    }
}
