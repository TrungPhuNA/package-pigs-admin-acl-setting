<?php

namespace Pigs\AdminAclSetting\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Pigs\AdminAclSetting\Models\Account;


class AdminAclLoginController extends Controller
{
    public function login()
    {
        return view('adm_acl_setting::pages.auth.login');
    }

    public function postLogin(Request $request)
    {
        $credentials = [
            'email'    => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->route('get.adm_acl_setting.dashboard');
        }

        return redirect()->back();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('get.adm_acl_setting.login');
    }
}
