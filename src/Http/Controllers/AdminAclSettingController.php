<?php

namespace Pigs\AdminAclSetting\Http\Controllers;

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
        return view('adm_acl_setting::pages.setting.index', $viewData ?? []);
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
            return redirect()->route('adm_acl_setting.setting.index');
        } catch (\Exception $exception) {
            Log::error("=========== ". json_encode($exception->getMessage()));
            return redirect()->back();
        }
    }
}
