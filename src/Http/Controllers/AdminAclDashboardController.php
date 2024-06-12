<?php

namespace Pigs\AdminAclSetting\Http\Controllers;

use Illuminate\Routing\Controller;

class AdminAclDashboardController extends Controller
{
    public function index()
    {
        return view('adm_acl_setting::index');
    }
}
