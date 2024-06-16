<?php

namespace Pigs\AdminAclSetting\Http\Controllers\Setting;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Pigs\AdminAclSetting\Models\SettingWebsite;

class AdminAclSettingController extends Controller
{
    public function index()
    {
        $settingWebsite = SettingWebsite::first();
        $viewData = [
            'setting' => $settingWebsite
        ];
        return view('adm_acl_setting::pages.setting.dashboard', $viewData ?? []);
    }

    public function general(Request $request)
    {
        $settingWebsite = SettingWebsite::first();
        $viewData = [
            'setting' => $settingWebsite
        ];
        return view('adm_acl_setting::pages.setting.general', $viewData ?? []);
    }

    public function insertOrUpdateSetting(Request $request)
    {
        try {
            $data = $request->except("_token");
            $settingWebsite = SettingWebsite::first();
            if (!$settingWebsite) {
                SettingWebsite::insert($data);
            }else {
                $settingWebsite->update($data);
            }
            return redirect()->route('get.adm_acl_setting.setting.index');
        } catch (\Exception $exception) {
            Log::error("=========== ". json_encode($exception->getMessage()));
            return redirect()->back();
        }
    }
}
