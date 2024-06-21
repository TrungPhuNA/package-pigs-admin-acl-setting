<?php

namespace Pigs\AdminAclSetting\Http\Controllers\Setting;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Pigs\AdminAclSetting\Http\Requests\AdmAclPermissionRequest;
use Pigs\AdminAclSetting\Models\AdmAclPage;

class AdminAclSettingPageController extends Controller
{
    public function index()
    {
        $pages = AdmAclPage::orderByDesc('id')
            ->paginate(20);

        $viewData = [
            'pages' => $pages
        ];

        return view('adm_acl_setting::pages.page.index', $viewData);
    }

    public function create(Request $request)
    {
        return view('adm_acl_setting::pages.page.create');
    }

    public function store(Request $request)
    {
        try {
            $data = $request->except('_token');
            $data['created_at'] = Carbon::now();
            AdmAclPage::create($data);
        }catch (\Exception $exception) {
            Log::error("ERROR => AdminAclSettingPageController@store => ". $exception->getMessage());
            return redirect()->route('get.adm_acl_setting.page.create');
        }
        return redirect()->route('get.adm_acl_setting.page.index');
    }

    public function edit($id)
    {
        $page = AdmAclPage::findOrFail($id);
        return view('adm_acl_setting::pages.page.update', compact('page'));
    }

    public function update(Request $request, $id) {
        try {
            $data = $request->except('_token');
            $data['updated_at'] = Carbon::now();

            AdmAclPage::find($id)->update($data);
        }catch (\Exception $exception) {
            Log::error("ERROR => AdminAclSettingPageController@store => ". $exception->getMessage());
            return redirect()->route('get.adm_acl_setting.page.update', $id);
        }
        return redirect()->route('get.adm_acl_setting.page.index');
    }

    public function delete(Request $request, $id) {
        try {
            $page = AdmAclPage::findOrFail($id);
            if ($page) {
                $page->delete();
            }

        }catch (\Exception $exception) {
            Log::error("ERROR => AdminAclSettingPageController@delete => ". $exception->getMessage());
        }

        return redirect()->route('get.adm_acl_setting.page.index');
    }
}
