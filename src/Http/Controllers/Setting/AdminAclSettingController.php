<?php

namespace Pigs\AdminAclSetting\Http\Controllers\Setting;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Pigs\AdminAclSetting\Http\Requests\AdmAclSettingEmailRequest;
use Pigs\AdminAclSetting\Models\SettingWebsite;
use Illuminate\Support\Facades\Mail;

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

    public function email()
    {
        $setting = SettingWebsite::first();
        $viewData = [
            'email' => $setting
        ];
        return view('adm_acl_setting::pages.setting.email', $viewData ?? []);
    }

    public function insertOrUpdateEmail(AdmAclSettingEmailRequest $request){
        try {
            $data = $request->except("_token");
            $settingWebsite = SettingWebsite::first();
            if (!$settingWebsite) {
                SettingWebsite::insert($data);
            }else {
                $settingWebsite->update($data);
            }
            return redirect()->route('get.adm_acl_setting.setting.email');
        } catch (\Exception $exception) {
            Log::error("=========== ". json_encode($exception->getMessage()));
            return redirect()->back();
        }
    }

    public function testSendEmail(Request $request)
    {
        try{
            // Ghi log thông tin email
            Log::info('Sending email with the following configuration:', [
                'from' => config('mail.from.address'),
                'username' => config('mail.username'),
                'password' => config('mail.password'),
                'mailer' => config('mail.mailer'),
                'host' => config('mail.host'),
                'port' => config('mail.port'),
                'encryption' => config('mail.encryption'),
            ]);

            Mail::raw('Hệ thống test gủi email, xin cảm ơn', function ($message) {
                $message->to('codethue94@gmail.com')
                    ->subject('[Phú Phan] '. Carbon::now()->toString());
            });
        }catch (\Exception $exception) {
            Log::error("=========== ". json_encode($exception->getMessage()));
        }
        return redirect()->back();
    }
}
